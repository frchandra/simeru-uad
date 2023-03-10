<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lecturer_plots', function (Blueprint $table) {
            $table->id('lecturer_plot_id');
            $table->unsignedBigInteger('lecturer_id')->nullable();
            $table->unsignedBigInteger('sub_class_id');
            $table->unsignedBigInteger('academic_year_id');
            $table->boolean('is_held');

            $table->foreign('lecturer_id')->references('lecturer_id')->on('lecturers');
            $table->foreign('sub_class_id')->references('sub_class_id')->on('sub_classes');
            $table->foreign('academic_year_Id')->references('academic_year_Id')->on('academic_years');

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
        Schema::dropIfExists('lecturer_plots');
    }
};
