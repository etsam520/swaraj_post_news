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
        Schema::create('ads', function (Blueprint $table) {
             $table->id();
            $table->string('title');
            $table->string('link')->nullable(); // For the ad URL
            $table->text('description')->nullable(); // For the ad content
            $table->string('cover_image'); // To store the path to the image
            $table->boolean('status')->default(true); // 1 for active, 0 for inactive
            // If you decide to use the city field, uncomment this and adjust as needed
            // $table->foreignId('city_id')->nullable()->constrained('cities')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ads');
    }

};
