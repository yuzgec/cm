<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBorclusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('borclus', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('unvan');
            $table->string('tc')->nullable();
            $table->text('adres')->nullable();
            $table->string('il')->nullable();
            $table->string('ilce')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('borclus');
    }
}
