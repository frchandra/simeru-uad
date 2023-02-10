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
        Schema::create('offered_sub_classes', function (Blueprint $table) {
            $table->id('offered_sub_class_id');
            $table->unsignedBigInteger('sub_class_id');
            $table->unsignedBigInteger('academic_year_id');

            $table->foreign('sub_class_id')->references('sub_class_id')->on('sub_classes');
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
        Schema::dropIfExists('offered_sub_classes');
    }
};
