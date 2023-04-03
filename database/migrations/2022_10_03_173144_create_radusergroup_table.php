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
        Schema::create('radusergroup', function (Blueprint $table) {
            $table->id();
            $table->text('username')->default('');
            $table->text('groupname')->default('');
            $table->integer('priority')->default(0);
            $table->timestamps();
        });
        DB::statement('CREATE INDEX radusergroup_UserName ON radusergroup (UserName)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('radusergroup');
    }
};
