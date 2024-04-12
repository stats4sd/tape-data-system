<?php

namespace Database\Seeders\DatasetSeeders;

use App\Models\Dataset;
use App\Models\LookupTables\Crop;
use App\Models\LookupTables\CropProduct;
use App\Services\HelperService;
use Illuminate\Database\Seeder;

class CropProductDatasetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $dataset = Dataset::create([
            'name' => 'Crop Products',
            'primary_key' => 'code',
            'entity_model' => CropProduct::class,
            'lookup_table' => true,
        ]);

        $cropProductsForImport = HelperService::importCsvFileToCollection(storage_path('loading_data/crop_products.csv'));

        foreach($cropProductsForImport as $cropProductForImport) {

            $crop = Crop::create([
                'name' => $cropProductForImport['name'],
                'label' => $cropProductForImport['label_english']
            ]);
        }
    }
}
