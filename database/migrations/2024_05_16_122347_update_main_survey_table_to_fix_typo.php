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
        Schema::table('main_surveys', function (Blueprint $table) {
            $table->decimal('averself-, 20, 2suff-empowerment', 20, 2)->nullable()->change();
            $table->renameColumn('averself-, 20, 2suff-empowerment', 'averself-suff-empowerment');

        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('fix_typo', function (Blueprint $table) {
            //
        });
    }
};
