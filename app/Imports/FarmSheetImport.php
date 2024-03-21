<?php

namespace App\Imports;

use App\Models\SampleFrame\Farm;
use App\Models\SampleFrame\Location;
use App\Models\SampleFrame\LocationLevel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use Maatwebsite\Excel\Concerns\WithUpserts;

class FarmSheetImport implements ShouldQueue, SkipsEmptyRows, ToModel, WithBatchInserts, WithCalculatedFormulas, WithChunkReading, WithHeadingRow, WithStrictNullComparison, WithUpserts
{
    public function __construct(public array $data)
    {
    }

    public function model(array $row): Farm
    {
        $locationLevel = LocationLevel::find($this->data['location_level_id']);

        $headers = $this->data['header_columns'];

        $locationCodeColumn = $headers[$this->data['location_code_column']];
        $farmCodeColumn = $headers[$this->data['farm_code_column']];
        $farmNameColumn = $headers[$this->data['farm_name_column']];

        $location = Location::firstWhere('code', $row[$locationCodeColumn]);

        // TODO: handle Identifiers and Properties

        return new Farm([
            'location_id' => $location->id,
            'code' => $row[$farmCodeColumn],
            'name' => $row[$farmNameColumn],
        ]);
    }

    public function batchSize(): int
    {
        return 1000;
    }

    public function chunkSize(): int
    {
        return 1000;
    }

    public function uniqueBy(): array
    {
        return ['code'];
    }
}
