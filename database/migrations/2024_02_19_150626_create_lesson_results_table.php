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
        Schema::create('lesson_results', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('lesson_id')->index();
            $table->unsignedInteger('user_id')->index();
            $table->unsignedTinyInteger('result_rating')->default(0);
            $table->json('json_data')->nullable();
            $table->string('comments')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lesson_results');
    }
};
