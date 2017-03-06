<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCluOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clu_order', function(Blueprint $table){

            $table->increments('id');
            $table->dateTime('date');
            $table->string('description');
            $table->integer('stage_id')->unsigned();
            $table->foreign('stage_id')->references('id')->on('clu_stage')->onDelete('cascade');
            $table->integer('store_id')->unsigned();            
            $table->foreign('store_id')->references('id')->on('clu_store')->onDelete('cascade');
            $table->boolean('active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('clu_order');
    }
}
