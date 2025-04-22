<?php

namespace App\Filament\Resources\DashboardResource\Widgets;

use App\Models\Order;
use App\Models\User; // Thêm model User
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class OrderStats extends BaseWidget
{
    protected function getCards(): array
    {
        // Lấy tổng số người dùng
        $totalUsers = User::count();

        $totalOrders = Order::count();
        $totalRevenue = Order::sum('total');

        // So sánh với tháng trước (hoặc khoảng thời gian khác)
        $lastMonthOrders = Order::whereBetween('created_at', [now()->subMonth()->startOfMonth(), now()->subMonth()->endOfMonth()])->count();
        $currentMonthOrders = Order::whereBetween('created_at', [now()->startOfMonth(), now()->endOfMonth()])->count();

        $percentageChange = $lastMonthOrders > 0
            ? (($currentMonthOrders - $lastMonthOrders) / $lastMonthOrders) * 100
            : 100;

        return [
            // Thêm card cho số lượng người dùng
            Card::make('Tổng số người dùng', $totalUsers)
                ->description('Số lượng người dùng hiện tại')
                ->descriptionIcon('heroicon-s-user-group')
                ->color('primary'), // Màu cho card này

            // Card cho tổng đơn hàng
            Card::make('Tổng đơn hàng', $totalOrders)
                ->description('So với tháng trước')
                ->descriptionIcon($percentageChange > 0 ? 'heroicon-s-arrow-trending-up' : 'heroicon-s-arrow-trending-down')
                ->color($percentageChange > 0 ? 'success' : 'danger') // màu xanh nếu tăng, đỏ nếu giảm
                ->description($percentageChange . '%'),

            // Card cho tổng doanh thu
            Card::make('Tổng doanh thu', number_format($totalRevenue) . ' VND')
                ->description('Tổng doanh thu tất cả đơn hàng')
                ->descriptionIcon('heroicon-s-currency-dollar')
                ->color('primary'),
        ];
    }
}
