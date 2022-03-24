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
            $table->string('klasor')->nullable();
            $table->string('foy_no')->nullable();
            $table->date('takip_tarihi')->nullable();
            $table->string('alacakli_adi')->nullable();
            $table->string('borclu_adi')->nullable();
            $table->string('tc')->nullable();
            $table->string('borclu_tc')->nullable();
            $table->string('icra_dosya_no')->nullable();
            $table->string('icra_mudurlugu')->nullable();
            $table->string('form_turu')->nullable();
            $table->double('alacak')->nullable();
            $table->string('para_birimi')->nullable();
            $table->string('telefon1')->nullable();
            $table->string('telefon2')->nullable();
            $table->string('telefon3')->nullable();
            $table->string('telefon4')->nullable();
            $table->string('telefon5')->nullable();
            $table->string('foy_durumu')->nullable();
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
