<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('entities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dataset_id')->constrained('datasets');
            $table->foreignId('parent_id')->constrained('entities')->cascadeOnDelete()->cascadeOnUpdate();
            $table->nullableMorphs('owner');
            $table->nullableMorphs('model');
            $table->foreignId('submission_id')->constrained('submissions')->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });

    }

    public function down(): void
    {
        Schema::dropIfExists('entities');
    }
};
