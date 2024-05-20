<?php

namespace App\Models\SurveyData;

use App\Models\SampleFrame\Farm;
<<<<<<< HEAD
use App\Models\SampleFrame\Location;
=======
>>>>>>> dev
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Stats4sd\FilamentOdkLink\Models\OdkLink\Submission;

class MainSurvey extends Model
{
    protected $table = 'main_surveys';

    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];


    public function submission(): BelongsTo
    {
        return $this->belongsTo(Submission::class, 'submission_id', 'id');
    }

<<<<<<< HEAD
    public function farm(): BelongsTo
=======
    // Link to repeat groups
    public function performanceActivities(): HasMany
    {
        return $this->hasMany(Performance\PerformanceActivity::class, 'main_survey_id', 'id');
    }

    public function performanceAnimals(): HasMany
    {
        return $this->hasMany(Performance\PerformanceAnimal::class, 'main_survey_id', 'id');
    }

    public function performanceAnimalProducts(): HasMany
    {
        return $this->hasMany(Performance\PerformanceAnimalProduct::class, 'main_survey_id', 'id');
    }

    public function performanceChemicalPesticides(): HasMany
    {
        return $this->hasMany(Performance\PerformanceChemicalPesticide::class, 'main_survey_id', 'id');
    }

    public function performanceCrops(): HasMany
    {
        return $this->hasMany(Performance\PerformanceCrop::class, 'main_survey_id', 'id');
    }

    public function performanceCropProducts(): HasMany
    {
        return $this->hasMany(Performance\PerformanceCropProduct::class, 'main_survey_id', 'id');
    }

    public function performanceMachines(): HasMany
    {
        return $this->hasMany(Performance\PerformanceMachine::class, 'main_survey_id', 'id');
    }

    public function performanceOrganicPesticides(): HasMany
    {
        return $this->hasMany(Performance\PerformanceOrganicPesticide::class, 'main_survey_id', 'id');
    }

    public function performanceYouthEmigrants(): HasMany
    {
        return $this->hasMany(Performance\PerformanceYouthEmigrant::class, 'main_survey_id', 'id');
    }

    public function performanceYouthFemales(): HasMany
    {
        return $this->hasMany(Performance\PerformanceYouthFemale::class, 'main_survey_id', 'id');
    }

    public function performanceYouthMales(): HasMany
    {
        return $this->hasMany(Performance\PerformanceYouthMale::class, 'main_survey_id', 'id');
    }

    public function farm()
>>>>>>> dev
    {
        return $this->belongsTo(Farm::class, 'farm_id', 'id');
    }

<<<<<<< HEAD
    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class, 'final_location_id', 'id');
    }

=======
>>>>>>> dev
}
