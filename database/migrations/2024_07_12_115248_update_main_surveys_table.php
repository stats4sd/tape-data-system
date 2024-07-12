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
            // GPS location
            $table->decimal('accuracy', 9, 4)->nullable()->after('respondent_phone');
            $table->integer('altitude')->nullable()->after('respondent_phone');
            $table->decimal('longitude', 11, 8)->nullable()->after('respondent_phone');
            $table->decimal('latitude', 11, 8)->nullable()->after('respondent_phone');

            $table->dropColumn('gps_loc');
        });

        Schema::table('farms', function (Blueprint $table) {
            // GPS location
            $table->decimal('accuracy', 9, 4)->nullable()->after('altitude');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
