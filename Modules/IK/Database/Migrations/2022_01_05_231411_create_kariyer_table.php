<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKariyerTable extends Migration
{

    public function up()
    {
        Schema::create('kariyer', function (Blueprint $table) {
            $table->id();
            $table->foreignId('personel_id')->references('id')->on('personel')->onDelete('cascade');
            $table->string('depertman')->nullable();
            $table->string('baslangic_tarihi')->nullable();
            $table->string('bitis_tarihi')->nullable();
            $table->integer('calisma_sekli')->nullable();
            $table->integer('holding')->nullable();
            $table->integer('sirket')->nullable();
            $table->integer('yonetici')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kariyer');
    }
}
