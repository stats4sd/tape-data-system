<?php

namespace App\Models\SurveyData;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Stats4sd\FilamentOdkLink\Models\OdkLink\Submission;

class MainSurvey extends Model
{
    protected $table = 'main_surveys';

    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];


    public function submission(): BelongsTo
    {
        return $this->belongsTo(Submission::class, 'submission_id', 'id');
    }

}
