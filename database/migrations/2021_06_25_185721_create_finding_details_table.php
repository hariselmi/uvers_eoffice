<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFindingDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('finding_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('finding_id');
            $table->text('category')->nullable();
            $table->text('reference')->nullable();
            $table->text('statement')->nullable();
            $table->text('answer')->nullable();
            $table->text('reason')->nullable();
            $table->integer('findings_location')->nullable();
            $table->text('findings_evidence')->nullable();
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
        Schema::dropIfExists('finding_details');
    }
}
