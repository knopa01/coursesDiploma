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
        Schema::create('student_course_tasks', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->dateTime('done_date')->nullable();
            $table->unsignedBigInteger('student_course_id');
            $table->unsignedBigInteger('contents_id');
            $table->index('student_course_id', 'student_course_task_student_course_idx');
            $table->foreign('student_course_id', 'student_course_task_student_course_fk')->on('student_courses')->references('id')->onDelete('cascade')->onUpdate('cascade');
            $table->index('contents_id', 'student_course_task_contents_idx');
            $table->foreign('contents_id', 'student_course_task_contents_fk')->on('contents')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_course_tasks');
    }
};
