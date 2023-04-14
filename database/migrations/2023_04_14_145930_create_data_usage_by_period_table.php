<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_usage_by_period', function (Blueprint $table) {
            $table->text('username');
            $table->timestampTz('period_start');
            $table->timestampTz('period_end')->nullable();
            $table->bigInteger('acctinputoctets')->nullable();
            $table->bigInteger('acctoutputoctets')->nullable();
            $table->timestamps();
            $table->primary(['username', 'period_start']);
        });
        DB::statement('CREATE INDEX data_usage_by_period_pkey_period_end ON data_usage_by_period(period_end);');
        DB::statement("
        CREATE OR REPLACE FUNCTION fr_new_data_usage_period ()
        RETURNS void
        LANGUAGE plpgsql
        AS $$
        DECLARE v_start timestamp;
        DECLARE v_end timestamp;
        BEGIN

            SELECT COALESCE(MAX(period_end) + INTERVAL '1 SECOND', TO_TIMESTAMP(0)) INTO v_start FROM data_usage_by_period;
            SELECT DATE_TRUNC('second',CURRENT_TIMESTAMP) INTO v_end;

            INSERT INTO data_usage_by_period (username, period_start, period_end, acctinputoctets, acctoutputoctets)
            SELECT *
            FROM (
                SELECT
                    username,
                    v_start,
                    v_end,
                    SUM(acctinputoctets) AS acctinputoctets,
                    SUM(acctoutputoctets) AS acctoutputoctets
                FROM ((
                    SELECT
                        username, acctinputoctets, acctoutputoctets
                    FROM
                        radacct
                    WHERE
                        acctstoptime > v_start
                ) UNION ALL (
                    SELECT
                        username, acctinputoctets, acctoutputoctets
                    FROM
                        radacct
                    WHERE
                        acctstoptime IS NULL
                )) AS a
                GROUP BY
                    username
            ) AS s
            ON CONFLICT ON CONSTRAINT data_usage_by_period_pkey
            DO UPDATE
                SET
                    acctinputoctets = data_usage_by_period.acctinputoctets + EXCLUDED.acctinputoctets,
                    acctoutputoctets = data_usage_by_period.acctoutputoctets + EXCLUDED.acctoutputoctets,
                    period_end = v_end;

            INSERT INTO data_usage_by_period (username, period_start, period_end, acctinputoctets, acctoutputoctets)
            SELECT *
            FROM (
                SELECT
                    username,
                    v_end + INTERVAL '1 SECOND',
                    NULL::timestamp,
                    0 - SUM(acctinputoctets),
                    0 - SUM(acctoutputoctets)
                FROM
                    radacct
                WHERE
                    acctstoptime IS NULL
                GROUP BY
                    username
            ) AS s;

        END
        $$;
        ");

        DB::statement("
        CREATE VIEW radacct_with_reloads AS
        SELECT
            a.*,
            COALESCE(a.AcctStopTime,
                CASE WHEN a.AcctStartTime < n.ReloadTime THEN n.ReloadTime END
            ) AS AcctStopTime_With_Reloads,
            COALESCE(a.AcctSessionTime,
                CASE WHEN a.AcctStopTime IS NULL AND a.AcctStartTime < n.ReloadTime THEN
                    EXTRACT(EPOCH FROM (n.ReloadTime - a.AcctStartTime))
                END
            ) AS AcctSessionTime_With_Reloads
        FROM radacct a
        LEFT OUTER JOIN nasreload n USING (nasipaddress);
        ");

        DB::statement("
        CREATE OR REPLACE PROCEDURE fr_radacct_close_after_reload ()
        LANGUAGE plpgsql
        AS $$

        DECLARE v_a bigint;
        DECLARE v_z bigint;
        DECLARE v_updated bigint DEFAULT 0;
        DECLARE v_last_report bigint DEFAULT 0;
        DECLARE v_now bigint;
        DECLARE v_last boolean DEFAULT false;
        DECLARE v_rowcount integer;

        DECLARE v_batch_size CONSTANT integer := 2500;

        BEGIN

        SELECT MIN(RadAcctId) INTO v_a FROM radacct WHERE AcctStopTime IS NULL;

        LOOP

            v_z := NULL;
            SELECT RadAcctId INTO v_z FROM radacct WHERE RadAcctId > v_a ORDER BY RadAcctId OFFSET v_batch_size LIMIT 1;

            IF v_z IS NULL THEN
                SELECT MAX(RadAcctId) INTO v_z FROM radacct;
                v_last := true;
            END IF;

            UPDATE radacct a
            SET
                AcctStopTime = n.reloadtime,
                AcctSessionTime = EXTRACT(EPOCH FROM (n.ReloadTime - a.AcctStartTime)),
                AcctTerminateCause = 'NAS reboot'
            FROM nasreload n
            WHERE
                a.NASIPAddress = n.NASIPAddress
                AND RadAcctId BETWEEN v_a AND v_z
                AND AcctStopTime IS NULL
                AND AcctStartTime < n.ReloadTime;

            GET DIAGNOSTICS v_rowcount := ROW_COUNT;
            v_updated := v_updated + v_rowcount;

            COMMIT;     -- Make the update visible

            v_a := v_z + 1;
            SELECT EXTRACT(EPOCH FROM CURRENT_TIMESTAMP) INTO v_now;
            IF v_last_report != v_now OR v_last THEN
                RAISE NOTICE 'RadAcctID: %; Sessions closed: %', v_z, v_updated;
                v_last_report := v_now;
            END IF;

            EXIT WHEN v_last;

        END LOOP;

        END
        $$;

        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data_usage_by_period');
    }
};
