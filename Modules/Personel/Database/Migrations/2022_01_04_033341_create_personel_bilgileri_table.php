<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonelBilgileriTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personel_bilgileri', function (Blueprint $table) {
            $table->id();
            $table->foreignId('personel_id')->references('id')->on('personel')->onDelete('cascade');
            $table->string('kisisel_eposta')->nullable();
            $table->string('kisisel_telefon')->nullable();
            $table->date('ise_baslama_tarihi')->nullable();
            $table->string('unvan')->nullable();
            $table->string('erisim_turu')->nullable();
            $table->string('sozlesme_turu')->nullable();
            $table->string('personel_grubu')->nullable();
            $table->string('medeni_hal')->nullable();
            $table->string('cinsiyet')->nullable();
            $table->string('engel_derecesi')->nullable();
            $table->string('uyrugu')->nullable();
            $table->string('cocuk_sayisi')->nullable();
            $table->string('askerlik_durumu')->nullable();
            $table->string('kan_grubu')->nullable();
            $table->string('egitim_durumu')->nullable();
            $table->string('mezuniyet')->nullable();
            $table->string('mezun_okul')->nullable();

            $table->longText('adres')->nullable();
            $table->string('adres_telefon')->nullable();
            $table->string('adres_ulke')->nullable();
            $table->string('adres_sehir')->nullable();
            $table->string('adres_postakodu')->nullable();
            $table->string('banka_adi')->nullable();
            $table->string('banka_hesap_tipi')->nullable();
            $table->string('banka_hesap_no')->nullable();
            $table->string('banka_iban')->nullable();

            $table->string('acil_kisi')->nullable();
            $table->string('acil_yakinlik')->nullable();
            $table->string('acil_telefon')->nullable();

            $table->string('sosyalmedya_adi')->nullable();
            $table->string('sosyalmedya_baglanti')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personel_bilgileri');
    }
}
