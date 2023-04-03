<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('radacct', function (Blueprint $table) {
            $table->bigIncrements('radacctid');
            $table->text('acctsessionid');
            $table->text('acctuniqueid')->unique('radacct_acctuniqueid_key');
            $table->text('username')->nullable();
            $table->text('realm')->nullable();
            $table->ipAddress('nasipaddress');
            $table->text('nasportid')->nullable();
            $table->text('nasporttype')->nullable();
            $table->timestampTz('acctstarttime')->nullable();
            $table->timestampTz('acctupdatetime')->nullable();
            $table->timestampTz('acctstoptime')->nullable();
            $table->bigInteger('acctinterval')->nullable();
            $table->bigInteger('acctsessiontime')->nullable();
            $table->text('acctauthentic')->nullable();
            $table->text('connectinfo_start')->nullable();
            $table->text('connectinfo_stop')->nullable();
            $table->bigInteger('acctinputoctets')->nullable();
            $table->bigInteger('acctoutputoctets')->nullable();
            $table->text('calledstationid')->nullable();
            $table->text('callingstationid')->nullable();
            $table->text('acctterminatecause')->nullable();
            $table->text('servicetype')->nullable();
            $table->text('framedprotocol')->nullable();
            $table->text('framedipaddress')->nullable();
            $table->text('framedipv6address')->nullable();
            $table->text('framedipv6prefix')->nullable();
            $table->text('framedinterfaceid')->nullable();
            $table->ipAddress('delegatedipv6prefix')->nullable();
            $table->text('class')->nullable();
            $table->timestamps();
        });
        DB::statement('CREATE UNIQUE INDEX radacct_whoson on radacct (AcctStartTime, nasipaddress)');
        DB::statement('CREATE INDEX radacct_active_session_idx ON radacct (AcctUniqueId) WHERE AcctStopTime IS NULL');
        DB::statement('CREATE INDEX radacct_session_idx ON radacct (AcctUniqueId)');
        DB::statement('CREATE INDEX radacct_active_user_idx ON radacct (AcctSessionId, UserName, NASIPAddress) WHERE AcctStopTime IS NULL');
        DB::statement('CREATE INDEX radacct_bulk_close ON radacct (NASIPAddress, AcctStartTime) WHERE AcctStopTime IS NULL');
        DB::statement('CREATE INDEX radacct_start_user_idx ON radacct (AcctStartTime, UserName)');
        DB::statement('CREATE INDEX radacct_stop_user_idx ON radacct (AcctStopTime, UserName)');
        DB::statement('CREATE INDEX radacct_calss_idx ON radacct (Class)');

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('radacct');
    }
};
