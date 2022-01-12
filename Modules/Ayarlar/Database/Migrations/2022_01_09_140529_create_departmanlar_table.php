<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepartmanlarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('departmanlar', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
            $table->bigInteger('sube_id')->nullable();
            $table->bigInteger('yonetici')->nullable();
            $table->time('mesai_baslangic')->nullable();
            $table->time('mesai_bitis')->nullable();
            $table->string('renk')->default('#6c757d');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('departmanlar');
    }
}
