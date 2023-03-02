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
        Schema::create('lectures', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
            $table->text('description');
            $table->unsignedInteger('sort');
            $table->unsignedBigInteger('course_plan_id');
            $table->index('course_plan_id', 'lectures_course_plans_idx');
            $table->foreign('course_plan_id', 'lectures_course_plans_fk')->on('course_plans')->references('id');

        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lectures');
    }
};
