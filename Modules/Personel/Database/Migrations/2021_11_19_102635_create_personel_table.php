<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonelTable extends Migration
{

    public function up()
    {
        Schema::create('personel', function (Blueprint $table) {
            $table->id();
            $table->integer('mesai_id');
            $table->string('adsoyad');
            $table->string('telefon');
            $table->string('email');
            $table->string('tckn')->nullable();
            $table->string('foto')->nullable();
            $table->boolean('durum')->default(1);
            
            $table->timestamps();
        });
    }

 
    public function down()
    {
        Schema::dropIfExists('personel');
    }
}
