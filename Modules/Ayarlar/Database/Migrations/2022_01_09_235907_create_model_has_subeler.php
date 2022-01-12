<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModelHasSubeler extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('model_has_subeler', function (Blueprint $table) {
            $table->unsignedBigInteger('sube_id');
            $table->unsignedBigInteger('user_id');
            $table->index(['user_id'], 'model_has_subeler_user_id_index');

            $table->foreign('sube_id')
                ->references('id')
                ->on('subeler')
                ->onDelete('cascade');
            $table->primary(['sube_id','user_id'], 'model_has_subeler_sube_primary');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('');
    }
}
