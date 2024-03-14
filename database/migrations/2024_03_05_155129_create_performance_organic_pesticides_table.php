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
        Schema::create('performance_organic_pesticides', function (Blueprint $table) {
            $table->id();
            $table->foreignId('performance_assessment_id')->constrained(
                table: 'performances',
                indexName: 'performance_org_pest_id_foreign'
            )->cascadeOnDelete()->cascadeOnUpdate();

            $table->text('coname1')->nullable();
            $table->text('cosource1')->nullable();
            $table->integer('cotox')->nullable();
            $table->decimal('coused1', 20, 2)->nullable();
            $table->text('comeas1')->nullable();
            $table->integer('cospray')->nullable();
            $table->decimal('coarea1', 20, 2)->nullable();
            $table->decimal('coarea1_ha', 20, 2)->nullable();
            $table->text('copest')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('performance_organic_pesticides');
    }
};
