<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModelHasDepartmanlar extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('model_has_departmanlar', function (Blueprint $table) {
            $table->unsignedBigInteger('departman_id');
            $table->unsignedBigInteger('user_id');
            $table->index(['user_id'], 'model_has_departmanlar_user_id_index');

            $table->foreign('departman_id')
                ->references('id')
                ->on('departmanlar')
                ->onDelete('cascade');
            $table->primary(['departman_id','user_id'], 'model_has_departmanlar_departman_primary');
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
