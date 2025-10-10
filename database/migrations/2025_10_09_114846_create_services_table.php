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
        Schema::create('services', function (Blueprint $table) {
            $table->id();

            // Slug & status
            $table->string('slug')->unique();
            $table->boolean('is_active')->default(true)->index();
            $table->unsignedSmallInteger('sort_order')->default(0)->index();

            // Optional schedule
            $table->timestamp('published_at')->nullable()->index();

            // Translated fields (simple per-locale approach)
            $table->string('title_uz', 255);
            $table->string('title_ru', 255)->nullable();
            $table->string('title_en', 255)->nullable();

            $table->string('excerpt_uz', 500)->nullable();
            $table->string('excerpt_ru', 500)->nullable();
            $table->string('excerpt_en', 500)->nullable();

            $table->text('content_uz')->nullable();
            $table->text('content_ru')->nullable();
            $table->text('content_en')->nullable();

            // Media helpers (optional)
            $table->string('icon')->nullable();   // e.g. "fa-solid fa-phone"

            $table->timestamps();
            $table->softDeletes();

            // helpful index for lookups
            $table->index(['slug', 'is_active']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
