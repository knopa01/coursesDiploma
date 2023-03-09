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
        Schema::create('contents', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('type_of_content');
            $table->string('name');
            $table->text('description');
            $table->unsignedInteger('sort');
            $table->unsignedBigInteger('course_id');
            $table->index('course_id', 'contents_courses_idx');
            $table->foreign('course_id', 'contents_courses_fk')->on('courses')->references('id');

        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contents');
    }
};
