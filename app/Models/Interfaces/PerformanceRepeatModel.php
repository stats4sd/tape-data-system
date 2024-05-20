<?php

namespace App\Models\Interfaces;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

interface PerformanceRepeatModel
{
    // Things that should be on all models, but are useful for the export to know about
    public function getTable();
    public static function query();



    public function mainSurvey(): BelongsTo;
    public function submission(): BelongsTo;

}
