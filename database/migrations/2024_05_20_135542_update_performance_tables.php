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

        Schema::table('performance_activities', function (Blueprint $table) {
            $table->dropForeign('performance_activities_performance_assessment_id_foreign');
            $table->renameColumn('performance_assessment_id', 'main_survey_id');
        });

        Schema::table('performance_activities', function (Blueprint $table) {
            $table->foreignId('main_survey_id')->nullable()->change();
        });

        Schema::table('performance_animals', function (Blueprint $table) {
            $table->dropForeign('performance_animals_performance_assessment_id_foreign');
            $table->renameColumn('performance_assessment_id', 'main_survey_id');
        });

        Schema::table('performance_animals', function (Blueprint $table) {
            $table->foreignId('main_survey_id')->nullable()->change();
        });

        Schema::table('performance_animal_products', function (Blueprint $table) {
            $table->dropForeign('performance_animal_products_performance_assessment_id_foreign');
            $table->renameColumn('performance_assessment_id', 'main_survey_id');
        });

        Schema::table('performance_animal_products', function (Blueprint $table) {
            $table->foreignId('main_survey_id')->nullable()->change();
        });

        Schema::table('performance_crops', function (Blueprint $table) {
            $table->dropForeign('performance_crops_performance_assessment_id_foreign');
            $table->renameColumn('performance_assessment_id', 'main_survey_id');
        });

        Schema::table('performance_crops', function (Blueprint $table) {
            $table->foreignId('main_survey_id')->nullable()->change();
        });

        Schema::table('performance_crop_products', function (Blueprint $table) {
            $table->dropForeign('performance_crop_products_performance_assessment_id_foreign');
            $table->renameColumn('performance_assessment_id', 'main_survey_id');
        });

        Schema::table('performance_crop_products', function (Blueprint $table) {
            $table->foreignId('main_survey_id')->nullable()->change();
        });

        Schema::table('performance_chemical_pesticides', function (Blueprint $table) {
            $table->dropForeign('performance_chem_pest_id_foreign');
            $table->renameColumn('performance_assessment_id', 'main_survey_id');
        });

        Schema::table('performance_chemical_pesticides', function (Blueprint $table) {
            $table->foreignId('main_survey_id')->nullable()->change();
        });

        Schema::table('performance_machines', function (Blueprint $table) {
            $table->dropForeign('performance_machines_performance_assessment_id_foreign');
            $table->renameColumn('performance_assessment_id', 'main_survey_id');
        });

        Schema::table('performance_machines', function (Blueprint $table) {
            $table->foreignId('main_survey_id')->nullable()->change();
        });

        Schema::table('performance_organic_pesticides', function (Blueprint $table) {
            $table->dropForeign('performance_org_pest_id_foreign');
            $table->renameColumn('performance_assessment_id', 'main_survey_id');
        });

        Schema::table('performance_organic_pesticides', function (Blueprint $table) {
            $table->foreignId('main_survey_id')->nullable()->change();
        });

        Schema::table('performance_youth_emigrants', function (Blueprint $table) {
            $table->dropForeign('performance_youth_emigrants_performance_assessment_id_foreign');
            $table->renameColumn('performance_assessment_id', 'main_survey_id');
        });

        Schema::table('performance_youth_emigrants', function (Blueprint $table) {
            $table->foreignId('main_survey_id')->nullable()->change();
        });

        Schema::table('performance_youth_females', function (Blueprint $table) {
            $table->dropForeign('performance_youth_females_performance_assessment_id_foreign');
            $table->renameColumn('performance_assessment_id', 'main_survey_id');
        });

        Schema::table('performance_youth_females', function (Blueprint $table) {
            $table->foreignId('main_survey_id')->nullable()->change();
        });

        Schema::table('performance_youth_males', function (Blueprint $table) {
            $table->dropForeign('performance_youth_males_performance_assessment_id_foreign');
            $table->renameColumn('performance_assessment_id', 'main_survey_id');
        });

        Schema::table('performance_youth_males', function (Blueprint $table) {
            $table->foreignId('main_survey_id')->nullable()->change();
        }});


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
