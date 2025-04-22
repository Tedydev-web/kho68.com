<?php

namespace App\Filament\Resources\DashboardResource\Widgets;

use App\Models\Transaction;
use Filament\Widgets\TableWidget as BaseWidget;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;

class RecentDeposits extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';

    protected function getTableQuery(): Builder
    {
        // Lấy 5 giao dịch nạp tiền mới nhất (type: deposit)
        return Transaction::query()
            ->where('type', 'deposit')
            ->latest()
            ->limit(5);
    }

    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('id')
                ->label('Mã giao dịch')
                ->sortable(),
            Tables\Columns\TextColumn::make('user.name')
                ->label('Người dùng')
                ->sortable(),
            Tables\Columns\TextColumn::make('amount')
                ->label('Số tiền')
                ->formatStateUsing(fn($state) => number_format($state, 0, ',', '.') . ' VND')
                ->sortable(),
            Tables\Columns\TextColumn::make('status')
                ->label('Trạng thái')
                ->sortable(),
            Tables\Columns\TextColumn::make('created_at')
                ->label('Ngày giao dịch')
                ->date('d-m-Y H:i')
                ->sortable(),
        ];
    }
}
