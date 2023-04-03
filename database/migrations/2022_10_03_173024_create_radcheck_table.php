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
        Schema::create('radcheck', function (Blueprint $table) {
            $table->id();
            $table->text('username')->default('');
            $table->text('attribute')->default('');
            $table->string('op', 2 )->default('==');
            $table->text('value')->default('');
            $table->timestamps();
        });
        DB::statement('CREATE INDEX radcheck_UserName ON radcheck (UserName,Attribute)');
        //DB::statement('-- CREATE INDEX radcheck_UserName_lower ON radcheck (lower(UserName),Attribute)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('radcheck');
    }
};
