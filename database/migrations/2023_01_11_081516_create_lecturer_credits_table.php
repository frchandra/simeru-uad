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
    public function up(){
        Schema::create('lecturer_credits', function (Blueprint $table) {
            $table->id('lecturer_credit_id');
            $table->unsignedBigInteger('lecturer_id');
            $table->unsignedBigInteger('academic_year_id');

            $table->unsignedSmallInteger('credit');
            $table->unsignedSmallInteger('sub_class_count');

            $table->foreign('lecturer_id')->references('lecturer_id')->on('lecturers');
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
        Schema::dropIfExists('lecturer_credits');
    }
};
