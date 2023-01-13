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
            $table->unsignedBigInteger('time_room_id');
            $table->unsignedBigInteger('academic_year_id');

            $table->foreign('lecturer_plot_id')->references('lecturer_plot_id')->on('lecturer_plots');
            $table->foreign('time_room_id')->references('time_room_id')->on('time_rooms');
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
