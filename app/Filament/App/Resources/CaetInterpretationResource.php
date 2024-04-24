<?php

namespace App\Filament\App\Resources;

use App\Filament\App\Resources\CaetInterpretationResource\Pages;
use App\Filament\Traits\IsLookupListResource;
use App\Models\CaetInterpretation;
use Awcodes\Shout\Components\Shout;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\HtmlString;

class CaetInterpretationResource extends Resource
{
    use isLookupListResource;

    protected static ?string $model = CaetInterpretation::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'CAET';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Shout::make('info')
                    ->content(fn(CaetInterpretation $record) => "Add a contextualised interpretation for the index {$record->caetIndex->name} of the element {$record->caetIndex->caetElement->name}."),
                Shout::make('scale')
                    ->color('secondary')
                    ->icon('')
                    ->content(fn(CaetInterpretation $record) => new HtmlString("
                        <h5 class='text-lg font-bold'>Rubric for scoring the index</h5>
                        <ul>
                            {$record->caetIndex->caetScales->filter(fn($scale): bool => ($scale->score*2) % 2 === 0)->map(fn($scale): string => "<li>{$scale->definition}</li>")->join('')}
                        </ul>
")),
                Textarea::make('interpretation')
                    ->label('Add Contextualised Interpretation - this will be shown to enumerators within the ODK form as a reminder.')
            ])
            ->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('caetIndex.caetElement.name')->label('Element'),
                Tables\Columns\TextColumn::make('caetIndex.name')->label('Index'),
                Tables\Columns\IconColumn::make('has_contextualised_interpretation')->label('Has Contextualised Interpretation?')
                ->boolean(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->modalHeading(fn(CaetInterpretation $record) => "CAET: {$record->caetIndex->caetElement->name} - {$record->caetIndex->name}"),
            ])
            ->bulkActions([
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCaetInterpretations::route('/'),
        ];
    }
}
