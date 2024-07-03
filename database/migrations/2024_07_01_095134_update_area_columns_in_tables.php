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
        Schema::table('main_surveys', function (Blueprint $table) {
            $table->decimal('area', 24, 6)->nullable()->change();
            $table->decimal('area_ha', 24, 6)->nullable()->change();
            $table->decimal('area_natural_veg', 24, 6)->nullable()->change();
            $table->decimal('area_natural_veg_ha', 24, 6)->nullable()->change();
            $table->decimal('area_permanent_pasture', 24, 6)->nullable()->change();
            $table->decimal('area_permanent_pasture_ha', 24, 6)->nullable()->change();
            $table->decimal('area_common_pasture', 24, 6)->nullable()->change();
            $table->decimal('area_common_pasture_ha', 24, 6)->nullable()->change();
        });

        Schema::table('performance_chemical_pesticides', function (Blueprint $table) {
            $table->decimal('cparea', 24, 6)->nullable()->change();
            $table->decimal('cparea_ha', 24, 6)->nullable()->change();
        });

        Schema::table('performance_crops', function (Blueprint $table) {
            $table->decimal('cland', 24, 6)->nullable()->change();
            $table->decimal('cland_ha', 24, 6)->nullable()->change();
        });

        Schema::table('performance_organic_pesticides', function (Blueprint $table) {
            $table->decimal('coarea1', 24, 6)->nullable()->change();
            $table->decimal('coarea1_ha', 24, 6)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    }
};
