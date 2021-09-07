<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCheckListDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('check_list_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('checklist_id');
            $table->text('reference')->nullable();
            $table->text('question')->nullable();
            $table->text('answer')->nullable();
            $table->text('special_note')->nullable();
            $table->text('audit')->nullable();
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
        Schema::dropIfExists('check_list_details');
    }
}
