<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBinlistTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('binlist', function (Blueprint $table) {
            $table->id();
            $table->integer('bin')->index();
            $table->integer('banka_kodu')->nullable();
            $table->string('banka_adi')->nullable();
            $table->string('type')->nullable();
            $table->string('sub_type')->nullable();
            $table->string('virtual')->nullable();
            $table->string('prepaid')->nullable();
            $table->index(["banka_kodu","banka_adi"]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('binlist');
    }
}
