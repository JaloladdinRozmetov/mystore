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
        Schema::table('lunar_product_types', function (Blueprint $table) {
            if (!Schema::hasColumn('lunar_product_types', 'name_ru')) {
                $table->string('name_ru')->nullable()->after('name');
            }
            if (!Schema::hasColumn('lunar_product_types', 'name_uz')) {
                $table->string('name_uz')->nullable()->after('name_ru');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lunar_product_types', function (Blueprint $table) {
            if (Schema::hasColumn('lunar_product_types', 'name_ru')) {
                $table->dropColumn('name_ru');
            }
            if (Schema::hasColumn('lunar_product_types', 'name_uz')) {
                $table->dropColumn('name_uz');
            }
        });
    }
};
