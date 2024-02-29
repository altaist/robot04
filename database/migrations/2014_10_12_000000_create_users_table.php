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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();

            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('phone')->nullable();
            $table->timestamp('birthday')->nullable();
            $table->json('extra')->nullable();
            $table->unsignedInteger('parent_id')->nullable();
            $table->unsignedBigInteger('org_id')->default(0);
            $table->string('ref_key', 32)->unique();
            $table->string('external_key', 6)->unique();
            $table->string('skud_key', 32)->nullable();
            $table->tinyInteger('role_id')->default(0);
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
