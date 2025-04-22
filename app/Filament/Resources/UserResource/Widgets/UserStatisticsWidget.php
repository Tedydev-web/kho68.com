<?php

namespace App\Filament\Resources\UserResource\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

use App\Models\User;
use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget\Card;
use Filament\Widgets\TableWidget as BaseTableWidget;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
class UserStatisticsWidget extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            Card::make('Tổng số người dùng', User::count())
                ->description('Tổng số người dùng trong hệ thống')
                ->icon('heroicon-o-users'),

            Card::make('Người dùng mới hôm nay', User::whereDate('created_at', Carbon::today())->count())
                ->description('Số người dùng đăng ký hôm nay')
                ->icon('heroicon-o-user-add'),
        ];
    }

    protected function getTableQuery()
    {
        return User::with('wallet')
            ->orderByDesc('wallet.balance')
            ->limit(5);
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('name')
                ->label('Tên người dùng'),

            TextColumn::make('wallet.balance')
                ->label('Số dư ví')
                ->money('VND', true),
        ];
    }

    public function table(): BaseTableWidget
    {
        return new BaseTableWidget([
            'title' => 'Top Users by Wallet Balance',
            'columns' => $this->getTableColumns(),
            'query' => $this->getTableQuery(),
        ]);
    }
}
