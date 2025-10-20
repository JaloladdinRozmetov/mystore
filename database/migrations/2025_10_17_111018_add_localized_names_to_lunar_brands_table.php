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
        $brandClass = class_exists(\App\Models\Brand::class)
            ? \App\Models\Brand::class
            : \Lunar\Models\Brand::class;

        $brandsTable = (new $brandClass)->getTable();

        if (Schema::hasTable($brandsTable)) {
            Schema::table($brandsTable, function (Blueprint $table) use ($brandsTable) {
                if (!Schema::hasColumn($brandsTable, 'name_ru')) {
                    $table->string('name_ru')->nullable()->after('name');
                }
                if (!Schema::hasColumn($brandsTable, 'name_uz')) {
                    $table->string('name_uz')->nullable()->after('name_ru');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $brandClass = class_exists(\App\Models\Brand::class)
            ? \App\Models\Brand::class
            : \Lunar\Models\Brand::class;

        $brandsTable = (new $brandClass)->getTable();

        if (Schema::hasTable($brandsTable)) {
            Schema::table($brandsTable, function (Blueprint $table) use ($brandsTable) {
                if (Schema::hasColumn($brandsTable, 'name_ru')) $table->dropColumn('name_ru');
                if (Schema::hasColumn($brandsTable, 'name_uz')) $table->dropColumn('name_uz');
            });
        }
    }
};
