<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->increments('id');
            $table->string('schedule_date');
            $table->string('schedule_time');
            $table->integer('auditor_id');
            $table->integer('auditee_id');
            $table->integer('standard_id');
            $table->integer('standard_detail_id');
            $table->string('semester_period');
            $table->string('academic_year');
            $table->integer('member_one');
            $table->integer('member_two');
            $table->integer('status');
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
        Schema::dropIfExists('schedules');
    }
}
