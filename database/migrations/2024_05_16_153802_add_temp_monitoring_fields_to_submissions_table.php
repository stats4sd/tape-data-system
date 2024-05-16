<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Temporary - or bespoke?
        Schema::table('submissions', function (Blueprint $table) {
            $table->string('enumerator')->nullable();
            $table->string('deviceid')->nullable();
            // specifically making this an integer as it might be -99;
            $table->integer('farm_id')->nullable();
            $table->foreignId('location_id')->nullable();
            $table->boolean('consent')->nullable();
            $table->boolean('respondent_available')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('submissions', function (Blueprint $table) {
            $table->dropColumn('enumerator');
            $table->dropColumn('deviceid');
            $table->dropColumn('farm_id');
            $table->dropColumn('location_id');
            $table->dropColumn('consent');
            $table->dropColumn('respondent_available');
        });
    }
};
