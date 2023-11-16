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
        Schema::create('school_assessments', function (Blueprint $table) {
            $table->id();
            $table->integer('ass_type_id')->nullable()->unsigned();
            $table->foreign('ass_type_id')->references('id')->on('assessment_types')->onDelete('cascade');
            $table->float('ass_scores')->nullable();
            $table->integer('class_id')->nullable()->unsigned();
            $table->foreign('class_id')->references('id')->on('school_classes')->onDelete('cascade');
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
        Schema::dropIfExists('school_assessments');
    }
};
