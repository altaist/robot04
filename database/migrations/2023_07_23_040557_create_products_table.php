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
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            $table->string('title', 256)->comment('Product name');
            $table->string('summary', 256)->comment('Product summary');
            $table->string('description', 1024)->nullable()->comment('Product description');
            $table->string('img')->nullable()->comment('Product default img');
            $table->json('json_data')->nullable()->comment('Product content');

            $table->unsignedInteger('parent_id')->nullable()->comment('Parent product');
            $table->unsignedInteger('author_id')->nullable()->comment('Product author');
            $table->unsignedInteger('org_id')->nullable()->comment('Product organization');
            $table->unsignedSmallInteger('category_id')->nullable()->comment('Product category');
            $table->unsignedSmallInteger('state')->nullable()->comment('Product state');
            $table->boolean('is_available')->nullable()->comment('Product available');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
