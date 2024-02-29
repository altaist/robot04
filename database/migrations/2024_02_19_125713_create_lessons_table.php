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
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('course_id');
            $table->unsignedInteger('teacher_id');
            $table->string('title')->nullable();
            $table->json('extra')->nullable();
            $table->timestamp('date_start')->nullable();
            $table->dateTime('date_started_at')->nullable();
            $table->unsignedTinyInteger('teacher_rating')->default(0);
            $table->unsignedTinyInteger('students_rating')->default(0);
            $table->text('comment')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lessons');
    }
};
