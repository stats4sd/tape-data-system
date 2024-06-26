<?php

namespace App\Exports;

use App\Models\Interfaces\PerformanceRepeatModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;

class PerformanceExport implements FromQuery, WithTitle, WithHeadings, WithMapping, WithStrictNullComparison
{
    public string $title;
    public array $fields;

    public function __construct(
        public PerformanceRepeatModel $model,
        public array $excludedColumns = ['id', 'created_at', 'updated_at', 'main_survey_id'],
    ) {
        $tableName = (new $model())->getTable();

        $this->title = Str::title($tableName);

        // get all columns from a database table, exclude specific columns
        $this->fields = array_diff(DB::getSchemaBuilder()->getColumnListing($tableName), $excludedColumns);
    }

    public function query()
    {
        // add performance ID into the query so we can correctly get the related data;
        return $this->model::query()->select(array_merge($this->fields))
            ->with('mainSurvey.farm');
    }

    public function title(): string
    {
        return $this->title;
    }

    public function headings(): array
    {
        $headings = collect($this->fields);

        $headings = $headings->prepend('farm_code');
        $headings = $headings->prepend('farm_id');
        $headings = $headings->prepend('main_survey_id');

        return $headings->toArray();
    }

    public function map($row): array
    {
        $map = collect($this->fields)
            ->map(fn ($field) => $row[$field]);

        $map = $map->prepend($row->mainSurvey->farm->team_code);
        $map = $map->prepend($row->mainSurvey->farm_id);
        $map = $map->prepend($row->main_survey_id);

        return $map->toArray();
    }
}
