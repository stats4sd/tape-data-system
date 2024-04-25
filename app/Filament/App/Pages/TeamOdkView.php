<?php

namespace App\Filament\App\Pages;

use App\Models\Team;
use App\Services\HelperService;
use Awcodes\Shout\Components\Shout;
use Filament\Actions\Action;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Infolists\Components\ViewEntry;
use Filament\Infolists\Concerns\InteractsWithInfolists;
use Filament\Infolists\Contracts\HasInfolists;
use Filament\Infolists\Infolist;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Tables\Actions\Action as TableAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Facades\Auth;
use Stats4sd\FilamentOdkLink\Models\OdkLink\Xlsform;
use Stats4sd\FilamentOdkLink\Services\OdkLinkService;

class TeamOdkView extends Page implements HasTable, HasInfolists
{
    use InteractsWithTable;
    use InteractsWithForms;
    use InteractsWithInfolists;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.app.pages.team-odk-view';

    protected ?string $heading = "ODK Form Management";

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
        $team = HelperService::getSelectedTeam()->load('odkProject.appUsers');

        return $infolist
            ->state($team->toArray())
            ->schema([
                ViewEntry::make('odk_qr_code')
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
                TextColumn::make('live_submissions_count')
                    ->label('No. of Submissions'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                \Filament\Tables\Actions\Action::make('create-temp')
                    ->color('gray')
                    ->label('Add a new ODK form')
                    ->modalFooterActions([
                        Action::make('ok')
                            ->label('Return')
                            ->close()
                    ])
                    ->form([
                        Shout::make('note')
                            ->type('danger')
                            ->content('Note - at present this feature is not available. All team forms are centrally managed by the system administrators in collaboration with the team leaders. In the future, this will allow teams to have multiple TAPE survey forms active at the same time, for example a standard TAPE and a "TAPE National" survey, or 2 surveys to allow conducting Steps 1 and 2 at different times.')
                    ])
            ])
            ->actions([

                // add Publish button
                TableAction::make('publish')
                    ->label('Publish')
                    ->icon('heroicon-m-arrow-up-tray')
                    ->visible(fn(Xlsform $record) => !$record->is_active)
                    ->requiresConfirmation()
                    ->action(function (Xlsform $record) {

                        $odkLinkService = app()->make(OdkLinkService::class);

                        // create draft if there is no draft yet
                        if (!$record->has_draft) {
                            $odkLinkService->createDraftForm($record);
                        }

                        // call API to publish form in ODK central
                        $odkLinkService->publishForm($record);
                    }),
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
                TableAction::make('update_published_version')
                    ->visible(fn(Xlsform $record) => !$record->has_latest_template)
                    ->label('Deploy Updates')
                    ->action(function (Xlsform $record) {

                        $record->syncWithTemplate();
                        $record->refresh();

                        Notification::make('update_success')
                            ->title('Success!')
                            ->body("The form {$record->title} is now using the latest xlsform uploaded to this platform")
                            ->color('success')
                            ->send();
                    }),

                TableAction::make('update_team_data')
                    ->label('Publish Latest Lookup Data')
                    ->visible(fn(Xlsform $record) => !$record->has_latest_media)
                ->action(function (Xlsform $record) {
                    $record->publishForm(app()->make(OdkLinkService::class));

                    Notification::make('update_success')
                        ->title('Success!')
                        ->body("The form {$record->title} now has the latest lookup data entered into the platform by your team.")
                        ->color('success')
                        ->send();
                })
//
//                // add Pull Submissions button
//                TableAction::make('export')
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
            ])
            ->bulkActions([
            ]);
    }

}
