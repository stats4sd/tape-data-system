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
        Schema::create('caet_indices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('caet_element_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('xlsform_name');
            $table->string('name');
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('caet_indices');
    }
};
