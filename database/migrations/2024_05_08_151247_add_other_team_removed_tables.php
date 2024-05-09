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
        Schema::create('animal_product_team_removed', function (Blueprint $table) {
            $table->id();
            $table->foreignId('team_id');
            $table->foreignId('animal_product_id');
            $table->timestamps();
        });

        Schema::create('crop_team_removed', function (Blueprint $table) {
            $table->id();
            $table->foreignId('team_id');
            $table->foreignId('crop_id');
            $table->timestamps();
        });

        Schema::create('crop_product_team_removed', function (Blueprint $table) {
            $table->id();
            $table->foreignId('team_id');
            $table->foreignId('crop_product_id');
            $table->timestamps();
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
