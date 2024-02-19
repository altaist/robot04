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
        Schema::create('course_user', function (Blueprint $table) {
            $table->unsignedInteger('course_id')->index()->comment('Course id');
            $table->unsignedInteger('user_id')->index()->comment('User id');
            $table->tinyInteger('role_id')->default(0);
            $table->unsignedTinyInteger('state')->default(0);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('course_id')->references('id')->on('courses');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_user');
    }
};
