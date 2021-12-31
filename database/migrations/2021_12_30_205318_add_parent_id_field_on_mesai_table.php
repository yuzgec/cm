<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddParentIdFieldOnMesaiTable extends Migration
{

    public function up()
    {
        Schema::table('mesai', function (Blueprint $table) {
            $table->string('mesai_renk')->nullable()->after('mesai_cikis');
            $table->string('mesai_yonetici')->nullable()->after('mesai_renk');
        });
    }


    public function down()
    {
        Schema::table('mesai', function (Blueprint $table) {
            //
        });
    }
}
