<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBedeniHasarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bedeni_hasar', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('vaka_turu')->nullable();
            $table->string('sube')->nullable();
            $table->string('hastane')->nullable();
            $table->string('yetkili')->nullable();
            $table->date('m_tarihi')->nullable();
            $table->string('hasta')->nullable();
            $table->string('tc')->nullable();
            $table->string('telefon1')->nullable();
            $table->string('telefon2')->nullable();
            $table->text('bilgi')->nullable();
            $table->string('adli_muayene')->nullable();
            $table->string('parti_ismi')->nullable();
            $table->string('il')->nullable();
            $table->string('kaynak')->nullable();
            $table->string('hastane_bolum')->nullable();
            $table->string('tedavi_turu')->nullable();
            $table->text('ikamet_adresi')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bedeni_hasar');
    }
}
