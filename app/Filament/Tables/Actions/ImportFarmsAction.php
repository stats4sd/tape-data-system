<?php

namespace App\Filament\Tables\Actions;

use Closure;
use App\Models\Import;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Facades\Filament;
use App\Services\HelperService;
use App\Models\SampleFrame\Farm;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\SampleFrame\FarmGroup;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\HeadingRowImport;
use App\Models\SampleFrame\FarmGrouping;
use App\Models\SampleFrame\LocationLevel;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\CheckboxList;
use EightyNine\ExcelImport\ExcelImportAction;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

/**
 * Custom action to import farms from an Excel file.
 * The action provides a modal popup to allow the user to upload an Excel file, and then map the columns to key variables.
 */
class ImportFarmsAction extends ExcelImportAction
{
    protected function setUp(): void
    {
        parent::setUp();

        $this
            ->modalWidth('3xl')
            ->modalDescription('Import Farms from an Excel file. The first worksheet of the Excel file should contain the data to import. The first row of the worksheet should contain the column headings. You must have already created or imported the locations and groups that the farms will be associated with.');

    }

    protected function getDefaultForm(): array
    {
        $groups= FarmGrouping::all()->where('owner_id', HelperService::getSelectedTeam()->id)->pluck('name', 'id')->toArray();

        return [
            FileUpload::make('upload')
                ->label(fn ($livewire) => str($livewire->getTable()->getPluralModelLabel())->title() . ' Excel Data')
                ->helperText('Please make sure your data is in the first worksheet of the Excel file, and that the first row contains the column headers.')
                ->disk($this->getDisk())
                ->columns()
                ->required()
                ->live()
                ->preserveFilenames()
                ->afterStateUpdated(function (?TemporaryUploadedFile $state, Set $set) {
                    $headings = (new HeadingRowImport())->toArray($state?->getRealPath());

                    // $headings is an array(sheets) of arrays(headers)
                    // We only want the first sheet
                    $headings = $headings[0][0];

                    $set('header_columns', $headings ?? []);
                }),

            Hidden::make('header_columns')
                ->default(['na' => '~~upload a file to see the column headers~~'])
                ->live(),

            Section::make('Location')
                ->schema([
                    Select::make('location_level_id')
                        ->label('Which location level are the farms linked to?')
                        ->options(
                            LocationLevel::where('has_farms', true)->get()->pluck('name', 'id')
                        )
                        ->placeholder('Select a location level')
                        ->helperText('For many sampling strategies, this will be obvious (the lowest level. It may be less obvious when there are different hierarchies of locations in different places.')
                        ->live(),

                    Select::make('location_code_column')
                        ->options(fn (Get $get) => $get('header_columns'))
                        ->label(fn (Get $get) => 'Which column contains the ' . (LocationLevel::find($get('location_level_id'))?->name ?? 'location') . ' unique code?')
                        ->placeholder('Select a column'),
                ]),

            Section::make('Groups')
                ->schema(array_map(function ($name, $id) {
                    return Select::make("grouping_{$id}_column")
                                ->label("Which column indicates the farm grouping $name?")
                                ->placeholder('Select a column')
                                ->options(fn (Get $get) => $get('header_columns'));
                        }, array_values($groups), array_keys($groups))),

            Section::make('Farm Information')
                ->columns(1)
                ->schema([
                    Select::make('farm_code_column')
                        ->label('Which column contains the farm unique code?')
                        ->placeholder('Select a column')
                        ->helperText('e.g. farm_id or farm_code')
                        ->live()
                        ->options(fn (Get $get) => $get('header_columns')),

                    Select::make('ag_system_code_column')
                        ->label('Which column contains the agricultural system unique code?')
                        ->placeholder('Select a column')
                        ->helperText('Farms can be linked to a system later if it is not currently known')
                        ->live()
                        ->options(fn (Get $get) => $get('header_columns')),

                    CheckboxList::make('farm_identifiers')
                        ->label('Are there any additional columns that contain identifiers for the farm? Tick all that apply.')
                        ->helperText('For example: family name, farm name, telephone numbers, etc. These are columns that can be useful for enumerators or project team members to identify the farm, but that should not be shared outside the project for data protection purposes.')
                        ->options(fn (Get $get): array => $get('header_columns'))
                        ->disableOptionWhen(
                            fn (string $value, Get $get): bool => $value === (string)$get('farm_code_column') ||
                                collect($get('farm_properties'))->contains($value) ||
                                $value === 'na'
                        )
                        ->live()
                        ->columnSpanFull(),

                    CheckboxList::make('farm_properties')
                        ->label('Are there any additional columns that contain properties of the farm? Tick all that apply.')
                        ->helperText('These are not identifiers, but are properties of the farm that are useful for analysis. For example: size of the farm, year of first engagement, etc. These are columns that can potentially be shared outside the project for analysis purposes.')
                        ->options(fn (Get $get) => $get('header_columns'))
                        ->disableOptionWhen(
                            fn (string $value, Get $get): bool => $value === (string)$get('farm_code_column') ||
                                collect($get('farm_identifiers'))->contains($value) ||
                                $value === 'na'
                        )
                        ->live()
                        ->columnSpanFull(),

                    Hidden::make('owner_id')
                        ->default(Filament::getTenant()->id),
                    Hidden::make('owner_type')
                        ->default('App\Models\Team'),

                ]),

            Hidden::make('user_id')
                ->default(auth()->id()),
        ];
    }

    public function action(Closure|string|null $action): static
    {
        if ($action !== 'importData') {
            throw new \RuntimeException('You cannot override the action for this plugin');
        }

        $this->action = $this->importData();

        return $this;
    }

    public function importData(): Closure
    {
        return function (array $data, $livewire): bool {

            // create import record - for review and error tracking by users
            $import = Import::create([
                'team_id' => Filament::getTenant()->id,
                'model_type' => Farm::class,
            ]);

            $import->addMedia(Storage::path($data['upload']))->toMediaCollection();

            $data['import_id'] = $import->id;

            // setup importer
            $importObject = new $this->importClass($data);

            // run import
            Excel::import($importObject, $import->getFirstMediaPath());

            return true;
        };
    }
}
