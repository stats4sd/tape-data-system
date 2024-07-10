<?php

namespace App\Exports;

use App\Models\SurveyData\Performance\PerformanceActivity;
use App\Models\SurveyData\Performance\PerformanceAnimal;
use App\Models\SurveyData\Performance\PerformanceAnimalProduct;
use App\Models\SurveyData\Performance\PerformanceCrop;
use App\Models\SurveyData\Performance\PerformanceCropProduct;
use App\Models\SurveyData\Performance\PerformanceMachine;
use App\Models\SurveyData\Performance\PerformanceOrganicPesticide;
use App\Models\SurveyData\Performance\PerformanceYouthFemale;
use App\Models\SurveyData\Performance\PerformanceYouthMale;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class ExcelExport implements WithMultipleSheets
{

    public function __construct(public Collection $collection)
    {
    }

    public function sheets(): array
    {
        $sheets = [];

        // There are 3 sheets with select-multiples. For those, we use the generic ExcelSheetExport and pass the appropriate collection.

        $sheets[] = new ExcelSheetExport($this->collection['Main_Survey'], 'Main_Survey');
        $sheets[] = new ExcelSheetExport($this->collection['Performances_Chemical_Pesticides'], 'Performances_Chemical_Pesticides');
        $sheets[] = new ExcelSheetExport($this->collection['Performances_Youth_Emigrants'], 'Performances_Youth_Emigrants');


        return $sheets;
    }
}
