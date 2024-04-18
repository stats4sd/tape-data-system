<?php

namespace App\Filament\App\Pages;

use App\Filament\App\Clusters\LookupTables;
use App\Filament\App\Resources\FarmResource;
use App\Filament\App\Resources\SiteResource;
use App\Filament\App\Widgets\TeamCounts;
use App\Models\Team;
use App\Services\HelperService;
use Filament\Pages\Page;

class TeamDashboard extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected ?string $maxContentWidth = '7xl';
    protected static string $view = 'filament.pages.team-dashboard';

    public function getRecord(): Team
    {
        return HelperService::getSelectedTeam();
    }

    public function getHeading(): string|\Illuminate\Contracts\Support\Htmlable
    {
        return $this->getRecord()->name . ' - Summary Page';
    }

    protected function getSummaryWidgets(): array
    {
        return [
            TeamCounts::class,
        ];
    }

    public function getTeamActions(): array
    {

        $step = $this->getRecord()->currentStep();

        return match ($step) {
            1 => $this->getMidSurveyActions(),
            2, 3 => $this->getPostSurveyActions(),
            default => $this->getPreSurveyActions(),
        };
    }

    private function getPreSurveyActions(): array
    {
        return [
            [
                'title' => 'Step 0 - Site & System',
                'description' => 'Describe the geographical site(s) and agricultural systems in which the farms exist.',
                'url' => SiteResource::getUrl('index'),
                'button_text' => 'Review Sites',
            ],
            [
                'title' => 'Prep: Sampling of Farms',
                'description' => 'The Survey works best when you know in advance which farms you are visiting.',
                'url' => FarmResource::getUrl('index'),
                'button_text' => 'Upload / Manage Farm List',
            ],
            [
                'title' => 'Prep: Survey Context',
                'description' => 'Add local units, crops, and locally relevant interpretations to the survey',
                'url' => LookupTables::getUrl(),
                'button_text' => 'Add Local Context',
            ],
            [
                'title' => 'Prep: Test Survey',
                'description' => 'Test the survey in full before starting the live data collection',
                'url' => '#',
                'button_text' => 'Test Survey',
            ],
        ];
    }

    private function getMidSurveyActions(): array
    {
        return [
            [
                'title' => 'Step 0 - Site & System',
                'description' => 'Describe or update the geographical site(s) and agricultural systems in which the farms exist.',
                'url' => '#',
                'button_text' => 'Review Sites',
            ],
            [
                'title' => 'Monitor Survey',
                'description' => 'Describe the geographical site(s) and agricultural systems in which the farms exist.',
                'url' => '#',
                'button_text' => 'Review Sites',
            ],
            [
                'title' => 'Download Current Data',
                'description' => 'Download the full dataset collected to-date for more detailed exploration and review.',
                'url' => '#',
                'button_text' => 'Download Data to Excel',
            ],
        ];

    }

    private function getPostSurveyActions(): array
    {
        return [
            [
                'title' => 'Step 0 - Site & System',
                'description' => 'Describe or update the geographical site(s) and agricultural systems in which the farms exist.',
                'url' => '#',
                'button_text' => 'Review Sites',
            ],
            [
                'title' => 'Download Survey Data',
                'description' => 'Download the full dataset collected for more detailed exploration and review.',
                'url' => '#',
                'button_text' => 'Download Data to Excel',
            ],
            [
                'title' => 'Download Summary Report',
                'description' => 'Download an automatically generated report of the survey results.',
                'url' => '#',
                'button_text' => 'Download Report (zip)',
            ],
        ];
    }
}
