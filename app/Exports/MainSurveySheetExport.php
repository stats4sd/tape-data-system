<?php

namespace App\Exports;

use App\Models\SurveyData\MainSurvey;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use Maatwebsite\Excel\Concerns\WithTitle;

class MainSurveySheetExport implements FromCollection, WithHeadings, WithTitle, WithMapping, WithStrictNullComparison
{
    public array $mainSurveyFields;

    public function __construct()
    {
        $mainSurveyTable = (new MainSurvey())->getTable();

        $this->mainSurveyFields = array_diff(DB::getSchemaBuilder()
            ->getColumnListing($mainSurveyTable), [
                'id',
                'created_at',
                'updated_at',
                'yeswomenhh', // not needed in output
                'farm_id', // manually added into the start of the output
                'final_location_id', // manually added into the start of the output
            ]);
    }

    public function collection(): Collection
    {
        return MainSurvey::with([
            'farm',
            'farm.location.locationLevel',
        ])->get();
    }

    public function map($row): array
    {
        $data = [
            $row->farm_id,
            $row->farm->team_code,
            $row->farm->location->locationLevel->name,
            $row->farm->location->name,
        ];

        $mainSurveyData = $row->only($this->mainSurveyFields);

        return array_merge($data, $mainSurveyData);
    }

    public function headings(): array
    {
        return [
            'farm_id',
            'team_code',
            'location_level',
            'location_name',
            ...$this->mainSurveyFields,
        ];
    }

    public function title(): string
    {
        return 'Main_Survey';
    }
}
