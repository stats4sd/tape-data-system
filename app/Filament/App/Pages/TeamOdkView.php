<?php

namespace App\Filament\App\Pages;

use App\Models\Team;
use App\Services\HelperService;
use Awcodes\Shout\Components\ShoutEntry;
use Filament\Actions\Action;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Infolists\Components\ViewEntry;
use Filament\Infolists\Concerns\InteractsWithInfolists;
use Filament\Infolists\Contracts\HasInfolists;
use Filament\Infolists\Infolist;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ViewColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Facades\Auth;

class TeamOdkView extends Page implements HasTable, HasInfolists
{
    use InteractsWithTable;
    use InteractsWithForms;
    use InteractsWithInfolists;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.app.pages.team-odk-view';

    protected function getHeaderActions(): array
    {
        return [
            Action::make('Do Something!')
                ->action(fn () => Notification::make('You did something!')
                    ->title('You did something!')->sendToDatabase(Auth::user())->success()->broadcast(Auth::user())),
        ];
    }

    public function getRecord(): Team
    {
        return HelperService::getSelectedTeam();
    }

    public function infolist(Infolist $infolist): Infolist
    {
        ray(HelperService::getSelectedTeam()->load('odkProject.appUsers')->toArray());

        return $infolist
            ->state(HelperService::getSelectedTeam()->toArray())
            ->schema([
                ShoutEntry::make('information')
                    ->color('secondary')
                    ->icon('')
                    ->content('Fugiat dolor voluptate mollit. Lorem elit exercitation aute non exercitation labore labore sint non quis nulla qui. Cillum ad nostrud irure incididunt laboris proident incididunt ex est qui. In commodo duis magna qui quis veniam ad enim nulla tempor pariatur cupidatat laboris officia.'),
                ViewEntry::make('odk_project')
                    ->view('filament-odk-link::filament.infolists.components.team-qr-code'),

            ]);
    }


    public function table(Table $table): Table
    {
        return $table
            ->relationship(fn (): MorphMany => HelperService::getSelectedTeam()->xlsforms())
            ->inverseRelationship('owner')
            ->recordTitleAttribute('title')
            ->columns([
                TextColumn::make('title')
                    ->grow(false),
                TextColumn::make('status'),
                ViewColumn::make('team_datasets_required')
                    ->view('filament-odk-link::filament.tables.columns.team-datasets-required'),
                TextColumn::make('submissions_count')->counts('submissions')
                    ->label('No. of Submissions'),
            ])
            ->filters([
                //
            ])
//            ->headerActions([
//                CreateAction::make()
//                    ->label('Add Xlsform to Team')
//                    ->after(function (Xlsform $record) {
//
//                        $odkLinkService = app()->make(OdkLinkService::class);
//
//                        if (!$record->xlsfile) {
//                            $record->syncWithTemplate();
//                        }
//
//                        UpdateXlsformTitleInFile::dispatchSync($record);
//
//                        $record->refresh();
//                        $record->deployDraft($odkLinkService);
//
//                    }),
//            ])
//            ->actions([
//
//                // add Publish button
//                Action::make('publish')
//                    ->label('Publish')
//                    ->icon('heroicon-m-arrow-up-tray')
//                    ->requiresConfirmation()
//                    ->action(function (Xlsform $record) {
//                        $odkLinkService = app()->make(OdkLinkService::class);
//
//                        // create draft if there is no draft yet
//                        if (!$record->has_draft) {
//                            $odkLinkService->createDraftForm($record);
//                        }
//
//                        // call API to publish form in ODK central
//                        $odkLinkService->publishForm($record);
//                    }),
//
//                // add Pull Submissions button
//                Action::make('pull_submissions')
//                    ->label('Pull Submissions')
//                    ->icon('heroicon-m-arrow-down-tray')
//                    ->action(function (Xlsform $record) {
//                        $odkLinkService = app()->make(OdkLinkService::class);
//
//                        // call API to pull submissions from ODK central
//                        $odkLinkService->getSubmissions($record);
//                    }),
//
//                Action::make('update_to_latest_template_version')
//                    ->label('Update The form definition')
//                    ->action(function (Xlsform $record) {
//                        $record->syncWithTemplate();
//                        $record->refresh();
//
//                        Notification::make('update_success')
//                            ->title('Success!')
//                            ->body("The form {$record->title} is now using the latest xlsform uploaded to this platform")
//                            ->color('success')
//                            ->send();
//                    }),
//
//                // add Pull Submissions button
//                Action::make('export')
//                    ->label('Export')
//                    ->icon('heroicon-m-document-arrow-down')
//                    ->action(function (Xlsform $record) {
//                        $odkLinkService = app()->make(OdkLinkService::class);
//
//                        // call API to export data as excel file
//                        // P.S. use return to trigger file download in browser
//                        return $odkLinkService->exportAsExcelFile($record);
//                    }),
//
//                ViewAction::make(),
//                EditAction::make(),
//                DeleteAction::make(),
//            ])
            ->bulkActions([
            ]);
    }

}
