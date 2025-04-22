<?php

namespace App\Filament\Resources\UserResource\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TotalUsers extends BaseWidget
{
    protected static string $view = 'filament.resources.user-resource.widgets.total-users';

    public function getTotalUsers(): int
    {
        return \App\Models\User::count();
    }
}
