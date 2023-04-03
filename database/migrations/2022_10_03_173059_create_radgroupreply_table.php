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
        Schema::create('radgroupreply', function (Blueprint $table) {
            $table->id();
            $table->text('groupname')->default('');
            $table->text('attribute')->default('');
            $table->string('op', 2 )->default('==');
            $table->text('value')->default('');
            $table->timestamps();
        });
        DB::statement('CREATE INDEX radgroupreply_groupname ON radgroupreply (GroupName,Attribute)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('radgroupreply');
    }
};
