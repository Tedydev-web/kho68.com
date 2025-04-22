<?php

namespace App\Filament\Resources\DashboardResource\Widgets;

use App\Models\Category as ModelsCategory;
use Category;
use Filament\Widgets\StatsOverviewWidget\Card;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class CategoryStatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Card::make('Tổng số danh mục', ModelsCategory::count())
            ->description('Số lượng danh mục hiện có.')
            ->color('success'),

        Card::make('Danh mục active', ModelsCategory::where('status', 'active')->count())
            ->description('Số lượng danh mục đang hiển thị.')
            ->color('primary'),

        Card::make('Danh mục inactive', ModelsCategory::where('status', 'inactive')->count())
            ->description('Số lượng danh mục đang ẩn.')
            ->color('warning'),

        Card::make('Danh mục có trên 10 sản phẩm', ModelsCategory::has('products', '>', 10)->count())
            ->description('Danh mục có số lượng sản phẩm lớn hơn 10.')
            ->color('info'),
        ];
    }
}
