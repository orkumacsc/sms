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
        Schema::create('result_positions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('student_id')->nullable()->unsiged();
            $table->bigInteger('class_id')->nullable()->unsiged();
            $table->bigInteger('classarm_id')->nullable()->unsiged();
            $table->float('obtained_marks')->nullable()->unsiged();
            $table->float('average')->nullable()->unsiged();
            $table->bigInteger('class_position')->nullable()->unsiged();
            $table->bigInteger('session_id')->nullable()->unsiged();
            $table->bigInteger('term_id')->nullable()->unsiged();
            $table->integer('computed_by')->nullable()->unsiged();
            $table->integer('updated_by')->nullable()->unsiged();            
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
        Schema::dropIfExists('result_positions');
    }
};
