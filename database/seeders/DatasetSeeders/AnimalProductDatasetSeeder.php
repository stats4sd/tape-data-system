<?php

namespace Database\Seeders\DatasetSeeders;

use App\Models\Dataset;
use App\Models\Traits\AnimalProduct;
use App\Services\HelperService;
use Illuminate\Database\Seeder;

class AnimalProductDatasetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $dataset = Dataset::create([
            'name' => 'Animal Products',
            'primary_key' => 'code',
            'entity_model' => AnimalProduct::class,
            'lookup_table' => true,
        ]);

        $AnimalProductsForImport = HelperService::importCsvFileToCollection(storage_path('loading_data/animal_products.csv'));

        foreach($AnimalProductsForImport as $animalProductForImport) {

            $animalProduct = AnimalProduct::create([
                'name' => $animalProductForImport['name'],
                'label' => $animalProductForImport['label_english']
            ]);
        }
    }
}
