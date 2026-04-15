<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contact_inquiries', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone', 30)->nullable();
            $table->foreignId('property_id')->nullable()->constrained()->nullOnDelete();
            $table->date('arrival_date')->nullable();
            $table->date('departure_date')->nullable();
            $table->unsignedSmallInteger('guests')->nullable();
            $table->text('message');
            $table->enum('inquiry_type', ['rental', 'wedding', 'dossier', 'other'])->default('rental');
            $table->enum('status', ['pending', 'replied', 'closed'])->default('pending');
            $table->string('ip_address', 45)->nullable();
            $table->text('notes')->nullable(); // Admin notes
            $table->timestamps();

            $table->index('status');
            $table->index('email');
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contact_inquiries');
    }
};
