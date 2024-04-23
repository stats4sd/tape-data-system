<?php

namespace Database\Seeders\DatasetSeeders;

use App\Models\Dataset;
use App\Models\LookupTables\Crop;
use App\Services\HelperService;
use Illuminate\Database\Seeder;

class CropDatasetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $dataset = Dataset::create([
            'name' => 'Crops',
            'primary_key' => 'code',
            'entity_model' => Crop::class,
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

        $cropsForImport = HelperService::importCsvFileToCollection(storage_path('loading_data/crops.csv'));

        foreach ($cropsForImport as $cropForImport) {

            $crop = Crop::create([
                'name' => $cropForImport['name'],
                'label' => $cropForImport['label_english']
            ]);
        }
    }
}
