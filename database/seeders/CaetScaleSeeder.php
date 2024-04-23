<?php

namespace Database\Seeders;

use App\Models\CaetIndex;
use App\Services\HelperService;
use Illuminate\Database\Seeder;

class CaetScaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $scalesToImport = HelperService::importCsvFileToCollection(
            storage_path('loading_data/scales.csv')
        );

        // filter for only the english versions (doesn't matter which language is used; we just only want 1 copy of each scale item).

        $scalesToImport = $scalesToImport->filter(function ($scale) {
            return $scale['language'] === 'en';
        });

        $indices = CaetIndex::all();

        foreach ($scalesToImport as $scaleToImport) {

            // match the index with the xlsform_name
            $index = $indices->where('xlsform_name', $scaleToImport['xlsform_name'])->first();

            if (!$index) {
                throw new \RuntimeException('Index not found for scale: ' . $scaleToImport['name'] . ' with xlsform_name: ' . $scaleToImport['xlsform_name'] . ' in the caet_indices table. Please add the index first.');
            }

            $index->caetScales()->create([
                'score' => $scaleToImport['score'],
                'definition' => $scaleToImport['definition'],
            ]);
        }


    }
}
