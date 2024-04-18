<?php

namespace Database\Seeders\DatasetSeeders;

use App\Models\Dataset;
use App\Models\LookupTables\Enumerator;
use App\Services\HelperService;
use Illuminate\Database\Seeder;

class EnumeratorDatasetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $dataset = Dataset::create([
            'name' => 'Enumerators',
            'primary_key' => 'name',
            'entity_model' => Enumerator::class,
            'lookup_table' => true,
        ]);

        $animalsForImport = HelperService::importCsvFileToCollection(storage_path('loading_data/enumerators.csv'));

        foreach ($animalsForImport as $animalForImport) {

            $animal = Enumerator::create([
                'name' => $animalForImport['name'],
                'label' => $animalForImport['label']
            ]);
        }
    }
}
