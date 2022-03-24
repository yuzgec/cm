<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDosyalarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dosyalar', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->bigInteger('grup');
            $table->bigInteger('alacakli_id');
            $table->bigInteger('borclu_id');
            $table->bigInteger('icra_mudurlugu');
            $table->bigInteger('form_turu');
            $table->bigInteger('foy_durumu');
            $table->date('takip_tarihi')->nullable();
            $table->string('foy_no')->nullable();
            $table->string('icra_dosya_no')->nullable();
            $table->double('tutar');
            $table->json('telefonlar')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dosyalar');
    }
}
