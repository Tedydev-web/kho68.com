<?php

namespace App\Filament\Resources\DashboardResource\Widgets;

use App\Models\Course;
use Filament\Widgets\StatsOverviewWidget\Card;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class CourseStatsOverview extends BaseWidget
{
    protected static ?string $heading = 'Giao Dịch Nạp Tiền Gần Đây'; // Tiêu đề widget

    protected function getStats(): array
    {
        return [
            Card::make('Tổng số khóa học', Course::count())
                ->description('Tất cả các khóa học')
                ->color('primary'),

            Card::make('Khóa học đang hoạt động', Course::where('status', 'active')->count())
                ->description('Khóa học hiện đang hoạt động')
                ->color('success'),

            Card::make('Khóa học có khuyến mãi', Course::whereNotNull('sale_price')->count())
                ->description('Khóa học có giảm giá')
                ->color('info'),
        ];
    }
}
