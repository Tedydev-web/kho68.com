<?php

namespace App\Filament\Resources\UserResource\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ActiveUsers extends BaseWidget
{
    protected static string $view = 'filament.resources.user-resource.widgets.active-users';

    public function getActiveUsers(): int
    {
        return \App\Models\User::where('status', 'active')->count();
    }
}
