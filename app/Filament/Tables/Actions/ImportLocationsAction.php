<?php

namespace App\Filament\Tables\Actions;

use App\Models\Import;
use App\Models\SampleFrame\Location;
use Closure;
use EightyNine\ExcelImport\ExcelImportAction;
use Filament\Facades\Filament;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Illuminate\Support\Facades\Storage;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\HeadingRowImport;
use App\Models\Team;

class ImportLocationsAction extends ExcelImportAction
{
    protected function setUp(): void
    {
        parent::setUp();

        $this
            ->modalWidth('3xl')
            ->modalDescription('Import Locations from an Excel file. The first worksheet of the Excel file should contain the data to import. The first row of the worksheet should contain the column headings.');
    }

    protected function getDefaultForm(): array
    {
        return [
            FileUpload::make('upload')
                ->label(fn ($livewire) => str($livewire->getRecord()->name)->plural()->title() . ' ' . 'Excel Data')
                ->disk($this->getDisk())
                ->columns()
                ->required()
                ->live()
                ->afterStateUpdated(function (?TemporaryUploadedFile $state, Set $set) {
                    $headings = (new HeadingRowImport())->toArray($state->getRealPath());

                    // $headings is an array(sheets) of arrays(headers)
                    // We only want the first sheet
                    $headings = $headings[0][0];

                    $set('header_columns', $headings ?? []);
                }),

            Section::make('Column Mapping')
                ->columns(2)
                ->schema(function ($livewire) {
                    $currentLevel = $livewire->getRecord();
                    $parents = collect([]);

                    while ($currentLevel->parent) {
                        $parents->push($currentLevel->parent);
                        $currentLevel = $currentLevel->parent;
                    }

                    $parentQuestions = $parents->reverse()->map(callback: function ($parent) {
                        return collect([
                            Select::make("parent_{$parent->id}_code_column")
                                ->label(fn ($livewire) => "Which column contains the {$parent->name} unique code?")
                                ->options(fn (Get $get) => $get('header_columns'))
                                ->notIn(['na'])
                                ->required(),
                            Select::make("parent_{$parent->id}_name_column")
                                ->label(fn ($livewire) => "Which column contains the {$parent->name} name?")
                                ->options(fn (Get $get) => $get('header_columns'))
                                ->notIn(['na'])
                                ->required(),
                        ]);
                    })->flatten();

                    $currentLevelQuestions = collect([
                        Select::make('code_column')
                            ->label(fn ($livewire) => "Which column contains the {$livewire->getRecord()->name} unique code?")
                            ->options(fn (Get $get) => $get('header_columns'))
                            ->notIn(['na'])
                            ->required(),
                        Select::make('name_column')
                            ->label(fn ($livewire) => "Which column contains the {$livewire->getRecord()->name} name?")
                            ->options(fn (Get $get) => $get('header_columns'))
                            ->notIn(['na'])
                            ->required(),
                    ]);

                    return $parentQuestions->merge($currentLevelQuestions)->toArray();
                }),

            Select::make('override')
                ->label('Do you want to replace all locations with this import? (This will delete all existing locations from all location levels!)')
                ->options([
                    'no' => 'No',
                    'yes' => 'Yes',
                ])
                ->helperText('If you select "No", all existing locations will be kept. If you select "Yes", all existing locations will be deleted and replaced with the data from this import.')
                ->default('no'),

            Hidden::make('header_columns')
                ->default(['na' => '~~upload a file to see the headers~~'])
                ->live(),
            Hidden::make('level')
                ->default(fn ($livewire) => $livewire->getRecord()),
            Hidden::make('user_id')
                ->default(fn () => auth()->id()),
            Hidden::make('owner_id')
                ->default(Filament::getTenant()->id),
            Hidden::make('owner_type')
            ->default(Team::class),
        ];
    }

    public function action(Closure|string|null $action): static
    {
        if ($action !== 'importData') {
            throw new \RuntimeException('You\'re unable to override the action for this plugin');
        }

        $this->action = $this->importData();

        return $this;
    }

    private function importData(): Closure
    {
        return function (array $data, $livewire): bool {

            if($data['override'] === 'yes') {
                Location::where('owner_id', Filament::getTenant()->id)->delete();
            }


            $import = Import::create([
                'team_id' => Filament::getTenant()->id,
                'model_type' => Location::class,
            ]);

            $import->addMedia(Storage::path($data['upload']))->toMediaCollection();

            $data['import_id'] = $import->id;

            $importObject = new $this->importClass($data);

            Excel::import($importObject, $import->getFirstMediaPath());

            return true;
        };
    }
}
