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
        Schema::create('performance_chemical_pesticides', function (Blueprint $table) {
            $table->id();
            $table->foreignId('performance_assessment_id')->constrained(
                table: 'performances',
                indexName: 'performance_chem_pest_id_foreign'
            )->cascadeOnDelete()->cascadeOnUpdate();

            $table->text('cpname')->nullable();

            $table->integer('cptox')->nullable();
            $table->decimal('cpused', 20, 2)->nullable();
            $table->text('cpmeas')->nullable();
            $table->integer('cpspray')->nullable();
            $table->decimal('cparea', 20, 2)->nullable();
            $table->decimal('cparea_ha', 20, 2)->nullable();
            $table->text('cppest')->nullable();
            $table->text('cpcrop')->nullable();


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('performance_chemical_pesticides');
    }
};
