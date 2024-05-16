<?php

namespace App\Exports;

use App\Models\SurveyData\Performance\PerformanceActivity;
use App\Models\SurveyData\Performance\PerformanceAnimal;
use App\Models\SurveyData\Performance\PerformanceAnimalProduct;
use App\Models\SurveyData\Performance\PerformanceChemicalPesticide;
use App\Models\SurveyData\Performance\PerformanceCrop;
use App\Models\SurveyData\Performance\PerformanceCropProduct;
use App\Models\SurveyData\Performance\PerformanceMachine;
use App\Models\SurveyData\Performance\PerformanceOrganicPesticide;
use App\Models\SurveyData\Performance\PerformanceYouthEmigrant;
use App\Models\SurveyData\Performance\PerformanceYouthFemale;
use App\Models\SurveyData\Performance\PerformanceYouthMale;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class MainSurveyExport implements WithMultipleSheets
{
    public function sheets(): array
    {
        $sheets = [];

        $sheets[] = new DataDictionaryExport();
        $sheets[] = new ChoiceListExport();

        //  $sheets[] = new CalculatedIndicatorExport();
        $sheets[] = new MainSurveySheetExport();

        $sheets[] = new PerformanceExport(model: new PerformanceCrop());
        $sheets[] = new PerformanceExport(model: new PerformanceCropProduct());
        $sheets[] = new PerformanceExport(model: new PerformanceAnimal());
        $sheets[] = new PerformanceExport(model: new PerformanceAnimalProduct());
        $sheets[] = new PerformanceExport(model: new PerformanceActivity());
        $sheets[] = new PerformanceExport(model: new PerformanceMachine());
        $sheets[] = new PerformanceExport(model: new PerformanceChemicalPesticide());
        $sheets[] = new PerformanceExport(model: new PerformanceOrganicPesticide());
        $sheets[] = new PerformanceExport(model: new PerformanceYouthEmigrant());
        $sheets[] = new PerformanceExport(model: new PerformanceYouthMale());
        $sheets[] = new PerformanceExport(model: new PerformanceYouthFemale());

        return $sheets;
    }

}
