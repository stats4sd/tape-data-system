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

        $dataset->variables()
            ->createMany([
                [
                    'name' => 'name',
                    'label' => 'Enumerator Name',
                ],
                [
                    'name' => 'label',
                    'label' => 'The enumerator label as it will appear in the ODK form',
                ],
            ]);

        $enumeratorsForImport = HelperService::importCsvFileToCollection(storage_path('loading_data/enumerators.csv'));

        foreach ($enumeratorsForImport as $enumeratorForImport) {

            $enumerator = Enumerator::create([
                'name' => $enumeratorForImport['name'],
                'label' => $enumeratorForImport['label']
            ]);
        }
    }
}
