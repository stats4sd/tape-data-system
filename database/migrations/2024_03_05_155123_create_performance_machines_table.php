<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('performance_machines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('performance_assessment_id')->constrained('performances')->cascadeOnDelete()->cascadeOnUpdate();

            $table->text('mname')->nullable();
            $table->integer('mowned')->nullable();
            $table->decimal('mprice', 20, 2)->nullable();
            $table->decimal('myused', 20, 2)->nullable();
            $table->decimal('myplan', 20, 2)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('performance_machines');
    }
};
