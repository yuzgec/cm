<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIzinlerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('izinler', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->bigInteger('user_id');
            $table->integer('tur');
            $table->float('gun');
            $table->dateTime('baslangic');
            $table->dateTime('bitis');
            $table->text('aciklama')->nullable();
            $table->bigInteger('yerine_bakacak')->nullable();
            $table->dateTime('donus');
            $table->boolean('durum')->default(0);
            $table->json('onaylar');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('izinler');
    }
}
