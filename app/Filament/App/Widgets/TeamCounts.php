<?php

namespace App\Filament\App\Widgets;

use App\Models\Team;
use Filament\Facades\Filament;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Database\Eloquent\Model;

class TeamCounts extends BaseWidget
{
    protected static ?int $sort = 2;

    /**
     * @return ?Team
     */
    public function getRecord(): ?Model
    {
        return Filament::getTenant();
    }


    protected function getStats(): array
    {

        $team = $this->getRecord();

        if(!$team) {
            return [];
        }

        return [
            Stat::make('Team Farms', $team->farms()->count()),
            Stat::make('Total Farms Surveyed', $team->farms()->whereHas('caetAssessments')->count()),
        ];

    }
}
