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
        Schema::create('performance_crops', function (Blueprint $table) {
            $table->id();
            $table->foreignId('performance_assessment_id')->constrained('performances')->cascadeOnDelete()->cascadeOnUpdate();

            $table->text('cname_id')->nullable();
            $table->text('cname_label')->nullable();
            $table->text('other_crop')->nullable();
            $table->integer('c_wunit')->nullable();
            $table->decimal('cprod', 20, 2)->nullable();
            $table->decimal('cprod_kg', 20, 2)->nullable();
            $table->decimal('cqsold', 20, 2)->nullable();
            $table->decimal('cqsold_kg', 20, 2)->nullable();
            $table->decimal('cpg', 20, 2)->nullable();
            $table->decimal('cpg_per_kg', 20, 2)->nullable();
            $table->decimal('cgift', 20, 2)->nullable();
            $table->decimal('cgift_kg', 20, 2)->nullable();
            $table->decimal('cland', 20, 2)->nullable();
            $table->decimal('cland_ha', 20, 2)->nullable();
            $table->integer('cvar')->nullable();


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('performance_crops');
    }
};
