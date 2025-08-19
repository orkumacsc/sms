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
        Schema::create('discipline_arms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('departments_id')->constrained('departments')->onDelete('cascade');
            $table->foreignId('school_arms_id')->constrained('school_arms')->onDelete('cascade');
            $table->integer('max_capacity')->default(50);
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
        Schema::dropIfExists('discipline_arms');
    }
};
