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
        Schema::create('marks_registers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('student_id')->unsiged()->nullable();
            $table->bigInteger('class_id')->unsiged()->nullable();
            $table->bigInteger('arm_id')->unsiged()->nullable();
            $table->bigInteger('subject_id')->unsiged()->nullable();
            $table->float('scores')->nullable();
            $table->bigInteger('session_id')->unsiged()->nullable();
            $table->bigInteger('term_id')->unsiged()->nullable();
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
        Schema::dropIfExists('marks_registers');
    }
};
