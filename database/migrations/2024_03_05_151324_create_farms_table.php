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
        Schema::create('farms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('team_id')->nullable()->constrained()->nullOnDelete()->cascadeOnUpdate();
            $table->foreignId('site_id')->nullable()->constrained()->nullOnDelete()->cascadeOnUpdate();
            $table->string('team_code'); // should be unique per team

            // identifiers
            $table->json('identifiers')->nullable(); // identifiers - by default, we consider this personally identifying information of the farm.

            // location
            $table->decimal('latitude', 11, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->integer('altitude')->nullable();

            $table->boolean('replacement')->default(false)->comment('Is this farm considered a "replacement" in the context of the survey sample?');
            $table->json('properties')->nullable(); // other properties;


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('farms');
    }
};
