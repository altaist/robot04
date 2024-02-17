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
        Schema::create('orgs', function (Blueprint $table) {
            $table->id();
            $table->string('title', 256)->comment('Company name');
            $table->string('summary', 256)->comment('Company summary');
            $table->string('description', 1024)->nullable()->comment('Company description');
            $table->string('img')->nullable()->comment('Company default img');
            $table->json('info')->nullable()->comment('Company content');
            $table->string('url');
            $table->string('email');
            $table->string('phone');
            $table->string('person_name');
            $table->string('person_email');
            $table->string('person_phone');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orgs');
    }
};
