<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVaryantTable extends Migration
{
    public function up()
    {
        Schema::create('varyant', function (Blueprint $table) {
            $table->id();
            $table->integer('parent_id')->nullable();
            $table->string('varyant_adi');
        });
    }
    public function down()
    {
        Schema::dropIfExists('varyant');
    }
}
