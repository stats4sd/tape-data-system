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
        Schema::create('xlsform_choices', function (Blueprint $table) {
            $table->id();
            $table->string('list_name');
            $table->foreign('list_name')->references('list_name')->on('xlsform_choice_lists')->onDelete('cascade')->onUpdate('cascade');
            $table->string('name');
            $table->text('label')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('xlsform_choices');
    }
};
