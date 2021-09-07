<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStandardDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('standard_documents', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('standard_detail_id');
            $table->string('no_document');
            $table->string('document');
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
        Schema::dropIfExists('standard_documents');
    }
}
