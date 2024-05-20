<?php

namespace App\Exports;

use App\Models\CaetScale;
use App\Models\LookupTables\Animal;
use App\Models\LookupTables\AnimalProduct;
use App\Models\LookupTables\Crop;
use App\Models\LookupTables\CropProduct;
use App\Models\LookupTables\Enumerator;
use App\Models\LookupTables\Unit;
use App\Models\XlsformChoice;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use Maatwebsite\Excel\Concerns\WithTitle;

class ChoiceListExport implements FromCollection, WithMapping, WithStrictNullComparison, WithTitle, WithHeadings
{
    public function __construct()
    {
    }

    public function collection(): Collection
    {
        $commonChoices = XlsformChoice::select(['list_name', 'name', 'label'])
            ->get();

        // area_units
        $areaUnits = Unit::whereHas('unitType', function ($query) {
            $query->where('name', 'area');
        })
            ->select(['name', 'label'])
            ->get()
            ->map(fn (Unit $unit) => [
                'list_name' => 'area_units',
                'name' => $unit->name,
                'label' => $unit->label,
            ]);
        ;

        // weight_units
        $weightUnits = Unit::whereHas('unitType', function ($query) {
            $query->where('name', 'weight');
        })
            ->select(['name', 'label'])
            ->get()
            ->map(fn (Unit $unit) => [
                'list_name' => 'weight_units',
                'name' => $unit->name,
                'label' => $unit->label,
            ]);

        // enumerators
        $enumerators = Enumerator::select(['name', 'label'])
            ->get()
            ->map(fn (Enumerator $enumerator) => [
                'list_name' => 'enumerators',
                'name' => $enumerator->name,
                'label' => $enumerator->label,
            ]);

        // crops
        $crops = Crop::select(['name', 'label'])
            ->get()
            ->map(fn (Crop $crop) => [
                'list_name' => 'crops',
                'name' => $crop->name,
                'label' => $crop->label,
            ]);

        // crop_products
        $cropProduct = CropProduct::select(['name', 'label'])
            ->get()
            ->map(fn (CropProduct $cropProduct) => [
                'list_name' => 'crop_products',
                'name' => $cropProduct->name,
                'label' => $cropProduct->label,
            ]);

        // animals
        $animals = Animal::select(['name', 'label'])
            ->get()
            ->map(fn (Animal $animal) => [
                'list_name' => 'animals',
                'name' => $animal->name,
                'label' => $animal->label,
            ]);

        // animal_products
        $animalProducts = AnimalProduct::select(['name', 'label'])
            ->get()
            ->map(fn (AnimalProduct $animalProduct) => [
                'list_name' => 'animal_products',
                'name' => $animalProduct->name,
                'label' => $animalProduct->label,
            ]);

        $caetScales = CaetScale::with('caetIndex.caetElement')
            ->get()
            ->map(fn (CaetScale $caetScale) => [
                'list_name' => $caetScale->caetIndex->xlsform_name,
                'name' => $caetScale->score,
                'label' => $caetScale->definition,
            ]);

        return $commonChoices
            ->concat($areaUnits)
            ->concat($weightUnits)
            ->concat($enumerators)
            ->concat($crops)
            ->concat($cropProduct)
            ->concat($animals)
            ->concat($animalProducts)
            ->concat($caetScales);


    }

    public function headings(): array
    {
        return [
            'list_name',
            'name',
            'label',
        ];
    }

    public function map($row): array
    {
        return [
            $row['list_name'],
            $row['name'],
            $row['label'],
        ];
    }

    public function title(): string
    {
        return 'choice_lists';
    }
}
