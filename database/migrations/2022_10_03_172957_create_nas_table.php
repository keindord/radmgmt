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
        Schema::create('nas', function (Blueprint $table) {
            $table->id();
            $table->text('nasname');
            $table->text('shortname');
            $table->text('type')->default('other');
            $table->integer('ports')->nullable();
            $table->text('secret');
            $table->text('server')->nullable();
            $table->text('community')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });
        DB::statement('CREATE INDEX nas_nasname ON nas (nasname)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nas');
    }
};
