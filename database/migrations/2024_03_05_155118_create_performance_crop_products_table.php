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
        Schema::create('performance_crop_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('performance_assessment_id')->constrained('performances')->cascadeOnDelete()->cascadeOnUpdate();

            $table->integer('cfp_id')->nullable();
            $table->text('cfpname_other')->nullable();
            $table->text('cfpunmeas')->nullable();
            $table->text('cfpunmeas_other')->nullable();
            $table->decimal('cfpprod', 20, 2)->nullable();
            $table->decimal('cfpqsold', 20, 2)->nullable();
            $table->decimal('cfppg', 20, 2)->nullable();
            $table->decimal('cfpgift', 20, 2)->nullable();
            $table->text('cfp_label')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('performance_crop_products');
    }
};
