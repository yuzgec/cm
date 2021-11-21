<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMesaiTable extends Migration
{

    public function up()
    {
        Schema::create('mesai', function (Blueprint $table) {
            
            $table->id();
            $table->string('mesai_adi');
            $table->time('mesai_giris')->nullable();
            $table->time('mesai_cikis')->nullable();

        });
    }

    public function down()
    {
        Schema::dropIfExists('mesai');
    }
}
