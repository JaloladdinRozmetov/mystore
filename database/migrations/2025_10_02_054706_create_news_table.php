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
        Schema::create('news', function (Blueprint $t) {
            $t->id();
            $t->foreignId('author_id')->constrained('users')->cascadeOnDelete();

            // Uzbek (required)
            $t->string('title_uz');          // NOT NULL
            $t->string('excerpt_uz');        // NOT NULL
            $t->longText('description_uz');  // NOT NULL

            // Russian (optional if you want)
            $t->string('title_ru')->nullable();
            $t->string('excerpt_ru')->nullable();
            $t->longText('description_ru')->nullable();

            // English (optional if you want)
            $t->string('title_en')->nullable();
            $t->string('excerpt_en')->nullable();
            $t->longText('description_en')->nullable();

            $t->string('slug', 220)->unique();
            $t->enum('status', ['draft','published'])->default('draft');
            $t->timestamp('published_at')->nullable();

            $t->timestamps();
            $t->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news');
    }
};
