<?php

namespace App\Livewire;

use App\Models\SampleFrame\Location;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Livewire\Component;

class LocationSubmissionsEntry extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    protected string $view = 'infolists.components.location-submissions-entry';

    public function table(Table $table): Table
    {
        return $table
            ->query(Location::query())
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('submissions_count')
                    ->counts('submissions'),
            ]);
    }

}
