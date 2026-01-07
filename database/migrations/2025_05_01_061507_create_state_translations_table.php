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
        Schema::create('state_translations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('state_id'); // Foreign key
            $table->string('locale'); // Language code
            $table->string('state_name'); // Translated state name
            $table->string('state_slug')->nullable(); // Translated state slug
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('state_translations');
    }
};
