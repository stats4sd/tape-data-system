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
        Schema::create('data_dictionary_entries', function (Blueprint $table) {
            $table->id();
            $table->string('worksheet')->nullable();
            $table->string('survey_section')->nullable();
            $table->string('variable')->nullable();
            $table->text('label_question')->nullable();
            $table->string('type')->nullable();
            $table->string('code_list')->nullable();
            $table->boolean('sub_heading')->default(false);
            $table->boolean('end_of_section')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_dictionaries');
    }
};
