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
        Schema::create('room_time_helpers', function (Blueprint $table) {
            $table->id('room_time_helper_id');
            $table->unsignedBigInteger('time_id');
            $table->unsignedBigInteger('room_id');
            $table->unsignedBigInteger('academic_year_id');

            $table->boolean('is_occupied');
            $table->boolean('is_possible');

            $table->foreign('time_id')->references('time_id')->on('times');
            $table->foreign('room_id')->references('room_id')->on('rooms')->onDelete('cascade');
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
        Schema::dropIfExists('room_time_helpers');
    }
};
