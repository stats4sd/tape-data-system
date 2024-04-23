<?php

namespace Database\Seeders\DatasetSeeders;

use App\Models\Dataset;
use App\Models\LookupTables\Animal;
use App\Services\HelperService;
use Illuminate\Database\Seeder;

class AnimalDatasetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $dataset = Dataset::create([
            'name' => 'Animals',
            'primary_key' => 'code',
            'entity_model' => Animal::class,
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

        $animalsForImport = HelperService::importCsvFileToCollection(storage_path('loading_data/animals.csv'));

        foreach ($animalsForImport as $animalForImport) {

            $animal = Animal::create([
                'name' => $animalForImport['name'],
                'label' => $animalForImport['label_english']
            ]);
        }
    }
}
