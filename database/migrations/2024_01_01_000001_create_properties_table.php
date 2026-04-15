<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('century', 20)->nullable();         // e.g. "Siglo XV"
            $table->string('tagline')->nullable();             // Short subtitle
            $table->text('description')->nullable();           // Medium description
            $table->longText('long_description')->nullable();  // Full page description
            $table->unsignedSmallInteger('guests')->default(0);
            $table->unsignedSmallInteger('bedrooms')->default(0);
            $table->unsignedSmallInteger('bathrooms')->default(0);
            $table->string('image_url')->nullable();           // Main hero image
            $table->json('gallery_images')->nullable();        // Array of image URLs
            $table->json('amenities')->nullable();             // Array of amenity strings
            $table->string('location')->nullable();            // e.g. "Korčula, Croacia"
            $table->boolean('is_published')->default(false);
            $table->boolean('is_coming_soon')->default(false);
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
