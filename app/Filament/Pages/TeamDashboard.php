<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\TeamCounts;
use App\Models\Team;
use Filament\Facades\Filament;
use Filament\Pages\Page;
use Illuminate\Database\Eloquent\Model;

class TeamDashboard extends Page
{

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected ?string $maxContentWidth = '7xl';

    /**
     * @return Team
     */
    public function getRecord(): Model
    {
        return Filament::getTenant();
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

        switch ($step) {
            case 0:
                return $this->getPreSurveyActions();
                break;

            case 1:
                return $this->getMidSurveyActions();
                break;

            case 3:
                return $this->getPostSurveyActions();

        }
    }

    protected static string $view = 'filament.pages.team-dashboard';

    private function getPreSurveyActions(): array
    {
        return [
            [
                'title' => 'Step 0 - Site & System',
                'description' => 'Describe the geographical site(s) and agricultural systems in which the farms exist.',
                'url' => '#',
                'button_text' => 'Review Sites',
            ],
            [
                'title' => 'Prep: Sampling of Farms',
                'description' => 'The Survey works best when you know in advance which farms you are visiting.',
                'url' => '#',
                'button_text' => 'Upload / Manage Farm List',
            ],
            [
                'title' => 'Prep: Survey Context',
                'description' => 'Add local units, crops, and locally relevant interpretations to the survey',
                'url' => '#',
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
