<?php

namespace App\Imports;

use App\Models\SampleFrame\Location;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use Maatwebsite\Excel\Concerns\WithUpserts;

class LocationSheetImport implements ShouldQueue, SkipsEmptyRows, ToModel, WithBatchInserts, WithCalculatedFormulas, WithChunkReading, WithHeadingRow, WithStrictNullComparison, WithUpserts
{
    protected Collection $parentIds;

    public function __construct(public array $data)
    {
        $data['code_column'] = $data['header_columns'][$data['code_column']];
        $data['name_column'] = $data['header_columns'][$data['name_column']];

        $keys = collect(array_keys($data));

        $parentColumns = $keys->filter(fn ($key) => str_starts_with($key, 'parent_'));

        foreach ($parentColumns as $parentColumn) {
            $data[$parentColumn] = $data['header_columns'][$data[$parentColumn]] ?? null;
        }

        $this->parentIds = $parentColumns->filter(fn ($key) => str_contains($key, '_code'))
            ->map(fn ($key) => str_replace(['parent_', '_code_column'], '', $key));

        $this->data = $data;

    }

    public function model(array $row)
    {
        $locationLevel = $this->data['level'];

        $currentParent = null;

        ray($row);
        ray($this->data);

        // go through parents in order from highest to lowest. Ensure all parents exist in the database (and create them if they do not)
        foreach ($this->parentIds as $parentId) {
            Location::upsert(
                values: [
                    'team_id' => $this->data['team_id'],
                    'code' => $row[$this->data["parent_{$parentId}_code_column"]],
                    'name' => $row[$this->data["parent_{$parentId}_name_column"]],
                    'location_level_id' => $parentId,
                    'parent_id' => $currentParent?->id,
                ],
                uniqueBy: 'code'
            );

            $currentParent = Location::where('code', $row[$this->data["parent_{$parentId}_code_column"]])->first();
        }

        // return the new (or updated) location Model for the current row.
        return new Location([
            'team_id' => $this->data['team_id'],
            'location_level_id' => $locationLevel->id,
            'parent_id' => $currentParent?->id ?? null,
            'code' => $row[$this->data['code_column']],
            'name' => $row[$this->data['name_column']],
        ]);

    }

    public function uniqueBy(): string
    {
        return 'code';
    }

    public function batchSize(): int
    {
        return 1000;
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}
