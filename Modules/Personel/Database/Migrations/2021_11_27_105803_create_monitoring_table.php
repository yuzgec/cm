<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMonitoringTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monitoring', function (Blueprint $table) {
            Schema::create('monitoring', function (Blueprint $table) {
                $table->id();
                $table->timestamps();
                $table->integer('TerminalID')->nullable();
                $table->datetime('Eventtime')->nullable();
                $table->integer('SicilID')->nullable();
                $table->string('UserID')->nullable();
                $table->integer('EventCode')->nullable();
                $table->string('Description')->nullable();
            });
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('monitoring');
    }
}
