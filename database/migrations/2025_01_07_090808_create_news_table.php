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
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id'); // Foreign key to the category
            $table->unsignedBigInteger('city_id'); // Foreign key to the category
            $table->enum('status', ['draft', 'publish','pending','reject'])->default('pending');
            $table->json('tags'); // Store tags as a JSON array
            $table->string('thumbnail');
            $table->string('cover_photo')->nullable();
            $table->string('image');
            $table->string('video_link')->nullable();
            $table->boolean('is_breaking')->default(false);
            $table->integer('created_by');
            $table->integer('approved_by')->nullable();
            $table->boolean('is_draft')->default(true); // Indicates if the news is a draft
            $table->timestamp('publish_at')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->timestamps();
            $table->softDeletes();

            // Foreign key constraint for category
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
        });

        // Create news_translations table for multilingual support
        Schema::create('news_translations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('news_id');
            $table->string('locale'); // Language code
            $table->string('headline');
            $table->text('quote');
            $table->text('details');
            $table->string('slug');
            $table->timestamps();

            // Ensure unique translation for each locale
            $table->unique(['news_id', 'locale']);
            $table->foreign('news_id')->references('id')->on('news')->onDelete('cascade');
        });

        // Create news_gallery table for image gallery
        Schema::create('news_gallery', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('news_id');
            $table->string('image_path');
            $table->timestamps();

            $table->foreign('news_id')->references('id')->on('news')->onDelete('cascade');
        });



    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news_gallery');
        Schema::dropIfExists('news_translations');
        Schema::dropIfExists('news');
    }
};
