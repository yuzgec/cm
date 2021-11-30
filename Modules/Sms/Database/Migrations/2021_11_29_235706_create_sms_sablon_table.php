<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmsSablonTable extends Migration
{

    public function up()
    {
        Schema::create('sms_sablon', function (Blueprint $table) {
            $table->id();
            $table->string('sms_sablon_adi');
            $table->longText('sms_sablon')->nullable();
            $table->boolean('durum')->default(1);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sms_sablon');
    }
}
