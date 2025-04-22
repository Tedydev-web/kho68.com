<?php

namespace App\Filament\Resources\DashboardResource\Widgets;

use App\Models\CourseModule;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class CourseModuleStatsOverview extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            Card::make('Tổng số bài học', CourseModule::count())
                ->description('Tất cả bài học')
                ->color('primary'),

            Card::make('Bài học có video', CourseModule::whereNotNull('video_url')->count())
                ->description('Bài học có video đính kèm')
                ->color('success'),

            Card::make('Bài học không có video', CourseModule::whereNull('video_url')->count())
                ->description('Bài học chưa có video')
                ->color('danger'),
        ];
    }
}
