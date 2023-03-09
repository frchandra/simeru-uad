<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id('schedule_id');

            $table->unsignedBigInteger('lecturer_plot_id');
            $table->unsignedBigInteger('room_time_id');
            $table->unsignedBigInteger('academic_year_id');

            $table->unsignedBigInteger('lecturer_id');
            $table->unsignedBigInteger('sub_class_id');
            $table->unsignedBigInteger('sub_class_semester');
            $table->unsignedBigInteger('room_id');
            $table->unsignedBigInteger('time_id');

            $table->string('color_data')->nullable();

            $table->foreign('lecturer_plot_id')->references('lecturer_plot_id')->on('lecturer_plots');
            $table->foreign('lecturer_id')->references('lecturer_id')->on('lecturer_plots')->onUpdate('cascade');
            $table->foreign('room_time_id')->references('room_time_id')->on('room_times');
            $table->foreign('academic_year_id')->references('academic_year_id')->on('academic_years');

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
};
