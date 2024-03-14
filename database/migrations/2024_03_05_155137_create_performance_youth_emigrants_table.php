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
        Schema::create('performance_youth_emigrants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('performance_assessment_id')->constrained('performances')->cascadeOnDelete()->cascadeOnUpdate();

            $table->integer('y_emig_sex')->nullable();
            $table->integer('y_emig_where')->nullable();
            $table->text('y_emig_why')->nullable();
            $table->text('y_emig_why_other')->nullable();
            $table->integer('y_emig_return')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('performance_youth_emigrants');
    }
};
