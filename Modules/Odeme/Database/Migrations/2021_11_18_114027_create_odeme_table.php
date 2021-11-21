<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOdemeTable extends Migration
{

    public function up()
    {
        Schema::create('odeme', function (Blueprint $table) {
            $table->id();
            $table->integer('islem_id')->nullable();
            $table->integer('personel_id');
            $table->bigInteger('dekont_id')->nullable();
            $table->string('dosya_no')->nullable();
            $table->string('tckn')->nullable();
            $table->string('ad_soyad')->nullable();
            $table->integer('odeme_turu')->default(1);
            $table->decimal('odeme_tutari',10,2)->nullable();
            $table->decimal('odeme_komisyon',10,2)->nullable();
            $table->integer('kart_no')->nullable();
            $table->string('odeme_durumu')->nullable();
            $table->string('aciklama')->nullable();
            $table->boolean('odeme_cevap');
            $table->string('odeme_hata_mesaji')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('odeme');
    }
}
