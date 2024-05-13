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
        Schema::create('drinks_form_main', function (Blueprint $table) {
            $table->id();

            // specify columns to be imported from ODK form root item
            // for those columns existed in root item but not existed in table, they will not be imported into database
            $table->string('odk_id');
            $table->string('name');
            $table->integer('age');
            $table->string('faculty');
            $table->string('status');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('drinks_form_main');
    }
};
