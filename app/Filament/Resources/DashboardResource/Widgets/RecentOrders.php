<?php

namespace App\Filament\Resources\DashboardResource\Widgets;

use App\Models\Order;
use Filament\Widgets\TableWidget as BaseWidget;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;

class RecentOrders extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';

    protected function getTableQuery(): Builder
    {
        // Lấy 5 đơn hàng gần đây nhất
        return Order::query()->latest()->limit(5);
    }

    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('id')
                ->label('Mã đơn hàng')
                ->sortable(),
            Tables\Columns\TextColumn::make('user.name')
                ->label('Người dùng')
                ->sortable(),
            Tables\Columns\TextColumn::make('total')
                ->label('Tổng tiền')
                ->formatStateUsing(fn($state) => number_format($state, 0, ',', '.') . ' VND')
                ->sortable(),
            Tables\Columns\TextColumn::make('status')
                ->label('Trạng thái')
                ->sortable(),
            Tables\Columns\TextColumn::make('created_at')
                ->label('Ngày đặt hàng')
                ->date('d-m-Y H:i')
                ->sortable(),
        ];
    }
}
