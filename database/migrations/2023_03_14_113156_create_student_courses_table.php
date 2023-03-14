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
        Schema::create('student_courses', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->dateTime('done_date')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('course_id');
            $table->index('user_id', 'student_courses_users_idx');
            $table->foreign('user_id', 'student_courses_users_fk')->on('users')->references('id')->onDelete('cascade');
            $table->index('course_id', 'student_courses_courses_idx');
            $table->foreign('course_id', 'student_courses_courses_fk')->on('courses')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_courses');
    }
};
