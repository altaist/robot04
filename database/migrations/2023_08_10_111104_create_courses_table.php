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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('title', 256);
            $table->unsignedInteger('product_id')->nullable();
            $table->string('is_online')->default(false)->comment('Online or offline');
            $table->tinyInteger('state')->default(0);
            $table->unsignedSmallInteger('max_users_num')->default(0);
            $table->json('info')->nullable();
            $table->json('schedule');
            $table->timestamp('date_from')->nullable();
            $table->timestamp('date_to')->nullable();
            $table->timestamp('date_sign_to')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
