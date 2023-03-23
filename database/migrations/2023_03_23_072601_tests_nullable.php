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
        Schema::table('tests', function (Blueprint $table) {
            $table->string('test_input')->nullable()->change();
            $table->string('test_output')->nullable()->change();

        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
