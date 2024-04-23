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
        Schema::create('caet_scales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('caet_index_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->decimal('score', 2, 1);
            $table->text('definition');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('caet_scales');
    }
};
