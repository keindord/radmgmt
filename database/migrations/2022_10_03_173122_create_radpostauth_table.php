<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Query\Expression;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('radpostauth', function (Blueprint $table) {
            $table->id();
            $table->text('username');
            $table->text('pass')->nullable();
            $table->text('reply')->nullable();
            $table->text('calledstationid')->nullable();
            $table->text('callingstationid')->nullable();
            $table->timestampTz('authdate')->default(new Expression('now()'));
            $table->text('class')->nullable();
            $table->timestamps();
        });
        DB::statement('CREATE INDEX radpostauth_username_idx ON radpostauth (username)');
        DB::statement('CREATE INDEX radpostauth_class_idx ON radpostauth (Class)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('radpostauth');
    }
};
