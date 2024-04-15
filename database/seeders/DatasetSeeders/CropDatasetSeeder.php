<?php

namespace Database\Seeders\DatasetSeeders;

use App\Models\Dataset;
use App\Models\Traits\Crop;
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

        $cropsForImport = HelperService::importCsvFileToCollection(storage_path('loading_data/crops.csv'));

        foreach($cropsForImport as $cropForImport) {

            $crop = Crop::create([
                'name' => $cropForImport['name'],
                'label' => $cropForImport['label_english']
            ]);
        }
    }
}
