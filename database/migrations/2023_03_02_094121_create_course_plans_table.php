<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('course_plans', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('course_id');
            $table->index('course_id', 'course_plans_course_idx');
            $table->foreign('course_id', 'course_plans_course_fk')->on('courses')->references('id');



        });
        


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_plans');
    }
};
