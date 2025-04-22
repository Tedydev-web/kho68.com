<?php

namespace App\Filament\Resources\DashboardResource\Widgets;

use App\Models\OtherProduct;
use Filament\Widgets\StatsOverviewWidget\Card;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class OtherProductStatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Card::make('Tổng sản phẩm', OtherProduct::count())
                ->description('Tổng số sản phẩm khác')
                ->color('primary'),

            Card::make('Sản phẩm đã bán', OtherProduct::sum('sold_quantity'))
                ->description('Số lượng sản phẩm đã bán')
                ->color('success'),

            Card::make('Tồn kho', OtherProduct::sum('stock'))
                ->description('Số lượng sản phẩm trong kho')
                ->color('warning'),
        ];
    }
}
