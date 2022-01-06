<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIzinKurallariTable extends Migration
{

    public function up()
    {
        Schema::create('izin_kurallari', function (Blueprint $table) {

            $table->id();
            $table->string('izin_adi');
            $table->longText('izin_aciklama')->nullable();
            $table->string('hakedis')->nullable();
            $table->string('hakedis_sikligi')->nullable();
            $table->integer('izin_enaz')->nullable();
            $table->integer('izin_encok')->nullable();
            $table->string('izin_turu')->nullable();
            $table->string('izin_limit')->nullable();
            $table->integer('izin_gun')->nullable();
            $table->integer('izin_hesaplama_sekli')->nullable();
            $table->boolean('aciklama_zorunlulugu')->nullable();
            $table->boolean('yerine_bakacak_kisi')->nullable();
            $table->boolean('bekleme_suresi')->nullable();
            $table->boolean('calisma_takvimini_gecersiz_kilma')->nullable();
            $table->boolean('takvimde_goster')->nullable();
            $table->boolean('durum')->default(1);
        });
    }

    public function down()
    {
        Schema::dropIfExists('izin_kurallari');
    }
}
