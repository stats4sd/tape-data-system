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
        Schema::create('drinks_form_drink_repeat', function (Blueprint $table) {
            $table->id();

            // specify columns to be imported from ODK form repeat group
            // for those columns existed in repeat group but not existed in table, they will not be imported into database
            $table->string('odk_id');
            $table->string('drink_comment');
            $table->integer('drink_notes_count');
            $table->integer('drink_nested_count');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('drinks_form_drink_repeat');
    }
};
