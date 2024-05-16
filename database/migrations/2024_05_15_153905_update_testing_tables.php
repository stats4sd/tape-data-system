<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('drinks_form_main', function (Blueprint $table) {
            $table->dropColumn('odk_id');
            $table->foreignId('submission_id')->nullable();
        });

        Schema::table('drinks_form_drink_repeat', function (Blueprint $table) {
            $table->dropColumn('odk_id');
            $table->foreignId('submission_id')->nullable();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    }
};
