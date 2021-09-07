<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStandardDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('standard_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('standard_id');
            $table->string('standard_details');
            $table->string('no_document');
            $table->tinyInteger('dlt')->default(0); //1 permanent 2 general
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
        Schema::dropIfExists('standard_details');
    }
}
