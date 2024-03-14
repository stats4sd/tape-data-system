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
        Schema::create('performance_animals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('performance_assessment_id')->constrained('performances')->cascadeOnDelete()->cascadeOnUpdate();

            $table->foreignId('an_id');
            $table->text('an_label')->nullable();
            $table->text('aname_other')->nullable();

            $table->integer('arais')->nullaable();
            $table->integer('aborn')->nullaable();
            $table->integer('adied')->nullaable();
            $table->integer('abreed')->nullaable();
            $table->integer('aslaughter')->nullaable();
            $table->integer('abuy')->nullaable();
            $table->integer('aqsold')->nullaable();

            $table->decimal('apg', 20, 2)->nullable();
            $table->integer('aqgift')->nullable();
            $table->decimal('feedexp', 20, 2)->nullable();
            $table->decimal('vetexp', 20, 2)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('performance_animals');
    }
};
