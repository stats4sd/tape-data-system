<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('animal_products', function (Blueprint $table) {
            $table->renameColumn('quantity_sold_max', 'sold_max');
            $table->renameColumn('quantity_given_max', 'given_max');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('animal_products', function (Blueprint $table) {
            //
        });
    }
};
