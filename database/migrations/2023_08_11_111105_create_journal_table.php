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
        Schema::create('journal', function (Blueprint $table) {
            $table->unsignedInteger('user_id')->index()->comment('User id');
            $table->unsignedInteger('course_id')->nullable()->comment('Course id');
            $table->unsignedInteger('lesson_id')->nullable()->comment('Lesson id');
            $table->unsignedTinyInteger('state')->default(0);
            $table->unsignedTinyInteger('result_rating')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('journal');
    }
};
