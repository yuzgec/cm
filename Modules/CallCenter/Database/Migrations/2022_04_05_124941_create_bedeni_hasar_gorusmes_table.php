<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBedeniHasarGorusmesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bedeni_hasar_gorusmes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->bigInteger('user_id');
            $table->bigInteger('dosya_id');
            $table->string('telefon');
            $table->text('detay');
            $table->dateTime('tarih')->nullable();
            $table->integer('sonuc');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bedeni_hasar_gorusmes');
    }
}
