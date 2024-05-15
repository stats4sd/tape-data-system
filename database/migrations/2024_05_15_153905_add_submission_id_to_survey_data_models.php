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
        Schema::table('main_surveys', function (Blueprint $table) {
            $table->foreignId('submission_id')->nullable();
        });

        Schema::table('performance_activities', function (Blueprint $table) {
            $table->foreignId('submission_id')->nullable();
        });

        Schema::table('performance_animal_products', function (Blueprint $table) {
            $table->foreignId('submission_id')->nullable();
        });

        Schema::table('performance_animals', function (Blueprint $table) {
            $table->foreignId('submission_id')->nullable();
        });

        Schema::table('performance_chemical_pesticides', function (Blueprint $table) {
            $table->foreignId('submission_id')->nullable();
        });

        Schema::table('performance_crop_products', function (Blueprint $table) {
            $table->foreignId('submission_id')->nullable();
        });

        Schema::table('performance_crops', function (Blueprint $table) {
            $table->foreignId('submission_id')->nullable();
        });

        Schema::table('performance_machines', function (Blueprint $table) {
            $table->foreignId('submission_id')->nullable();
        });

        Schema::table('performance_organic_pesticides', function (Blueprint $table) {
            $table->foreignId('submission_id')->nullable();
        });

        Schema::table('performance_youth_emigrants', function (Blueprint $table) {
            $table->foreignId('submission_id')->nullable();
        });

        Schema::table('performance_youth_males', function (Blueprint $table) {
            $table->foreignId('submission_id')->nullable();
        });

        Schema::table('performance_youth_females', function (Blueprint $table) {
            $table->foreignId('submission_id')->nullable();
        });


    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('survey_data_models', function (Blueprint $table) {
            //
        });
    }
};
