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
        Schema::create('performance_animal_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('performance_assessment_id')->constrained('performances')->cascadeOnDelete()->cascadeOnUpdate();

            $table->foreignId('ap_id'); // TODO - add a bunch of these lookup tables as lookup tables...

            $table->text('apname_other')->nullable();
            $table->text('apunmeas')->nullable();
            $table->text('apunmeasoth')->nullable();
            $table->text('ap_label')->nullable();

            $table->decimal('approd', 20, 2)->nullable();
            $table->decimal('apqsold', 20, 2)->nullable();
            $table->decimal('appg', 20, 2)->nullable();
            $table->decimal('apgift', 20, 2)->nullable();


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('performance_animal_products');
    }
};
