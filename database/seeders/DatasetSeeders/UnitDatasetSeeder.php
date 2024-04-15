<?php

namespace Database\Seeders\DatasetSeeders;

use App\Models\Dataset;
use App\Models\LookupTables\Unit;
use App\Services\HelperService;
use Illuminate\Database\Seeder;

class UnitDatasetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $dataset = Dataset::create([
            'name' => 'Units',
            'primary_key' => 'code',
            'entity_model' => Unit::class,
            'lookup_table' => true,
        ]);

        $unitsForImport = HelperService::importCsvFileToCollection(storage_path('loading_data/units.csv'));

        foreach($unitsForImport as $unitForImport) {

            $unit = Unit::create([
                'name' => $unitForImport['name'],
                'label' => $unitForImport['label'],
                'unit_type_id' => $unitForImport['unit_type_id'],
                'conversion_rate' => $unitForImport['conversion_rate'],
            ]);
        }
    }
}
