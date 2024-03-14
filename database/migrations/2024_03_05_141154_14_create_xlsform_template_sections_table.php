<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('xlsform_template_sections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dataset_id')->nullable()->constrained('datasets')->nullOnDelete()->cascadeOnUpdate();
            $table->foreignId('xlsform_template_id')->constrained('xlsform_templates')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('parent_id')->nullable()->constrained('xlsform_template_sections')->nullOnDelete()->cascadeOnUpdate();
            $table->string('structure_item')->comment('which schema structure item (group or repeat / root) is this dataset linked to in the form?');
            $table->boolean('is_repeat')->default(false)->comment('Is this dataset linked to a repeat_group structure item?');
            $table->json('schema')->nullable();
            $table->boolean('is_current')->default(true)->comment('Is this section in the current version of the template? If False, the section used to exist in a previous version, and should remain in the database for historical purposes');
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('xlsform_template_sections');
    }
};
