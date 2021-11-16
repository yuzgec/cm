<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{

    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('telefon')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('depertman')->nullable();
            $table->string('password');
            $table->boolean('durum')->nullable();
            $table->string('profil_foto')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }
   
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
