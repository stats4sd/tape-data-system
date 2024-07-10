<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToArray;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ExcelSheetImport implements ToCollection, WithHeadingRow, SkipsEmptyRows
{
    public function collection(Collection $collection): Collection
    {
        return $collection;
    }

}
