<?php

namespace App\Filament\Tables\Actions;

use App\Models\Import;
use App\Models\SampleFrame\Farm;
use App\Models\SampleFrame\LocationLevel;
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
            ->modalDescription('Import Farms from an Excel file. The first worksheet of the Excel file should contain the data to import. The first row of the worksheet should contain the column headings. You must have already created or imported the locations that the farms will be associated with.');

    }

    protected function getDefaultForm(): array
    {
        return [
            FileUpload::make('upload')
                ->label(fn ($livewire) => str($livewire->getTable()->getPluralModelLabel())->title() . ' Excel Data')
                ->helperText('Please make sure your data is in the first worksheet of the Excel file, and that the first row contains the column headers.')
                ->disk($this->getDisk())
                ->columns()
                ->required()
                ->live()
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

            Select::make('location_level_id')
                ->label('Which location level are the farms linked to?')
                ->options(
                    LocationLevel::where('has_farms', true)->get()->pluck('name', 'id')
                )
                ->helperText('For many sampling strategies, this will be obvious (the lowest level. It may be less obvious when there are different hierarchies of locations in different places.')
                ->live(),

            Select::make('location_code_column')
                ->options(fn (Get $get) => $get('header_columns'))
                ->label(fn (Get $get) => 'Which column contains the ' . (LocationLevel::find($get('location_level_id'))?->name ?? 'location') . ' unique code?'),

            Section::make('Farm Information')
                ->columns(2)
                ->schema([
                    Select::make('farm_code_column')
                        ->label('Which column contains the farm unique code?')
                        ->helperText('e.g. farm_id or farm_code')
                        ->options(fn (Get $get) => $get('header_columns')),

                    Select::make('farm_identifiers')
                        ->multiple()
                        ->label('Are there any additional columns that contain identifying information for the farm?')
                        ->helperText('For example: family name, farm name, telephone numbers, etc. These are columns that can be useful for enumerators or project team members to identify the farm, but that should not be shared outside the project for data protection purposes.')
                        ->options(fn (Get $get) => $get('header_columns')),

                    Select::make('farm_properties')
                        ->multiple()
                        ->label('Are there any additional columns that contain properties of the farm?')
                        ->helperText('These are not identifiers, but are properties of the farm that are useful for analysis. For example: size of the farm, year of first engagement, etc. These are columns that can potentially be shared outside the project for analysis purposes.')
                        ->options(fn (Get $get) => $get('header_columns')),

                    Hidden::make('team_id')
                        ->default(Filament::getTenant()->id)

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

            ray($data);

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
