<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        /**
         * Table to store all different published versions of the xlsform
         */
        Schema::create('xlsform_versions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('xlsform_id')->constrained('xlsforms');
            $table->string('version');
            $table->string('odk_version');

            // yes, we're keeping the schema at the template, xlsform and version level...
            $table->json('schema')->nullable();


            $table->boolean('active')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('xlsform_versions');
    }
};
