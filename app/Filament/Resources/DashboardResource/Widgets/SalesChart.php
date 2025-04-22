<?php

namespace App\Filament\Resources\DashboardResource\Widgets;

use App\Models\Order;
use Filament\Widgets\LineChartWidget;
use Carbon\Carbon;

class SalesChart extends LineChartWidget
{
    protected static ?string $heading = 'Doanh thu theo ngày';

    protected function getData(): array
    {
        // Lấy giá trị của bộ lọc (nếu không có, mặc định là 'month')
        $activeFilter = $this->filter ?? 'month';

        // Thiết lập khoảng thời gian dựa vào bộ lọc được chọn
        switch ($activeFilter) {
            case 'today':
                $startDate = Carbon::today();
                $endDate = Carbon::tomorrow();
                break;
            case 'week':
                $startDate = Carbon::now()->startOfWeek();
                $endDate = Carbon::now()->endOfWeek();
                break;
            case 'year':
                $startDate = Carbon::now()->startOfYear();
                $endDate = Carbon::now()->endOfYear();
                break;
            case 'month':
            default:
                $startDate = Carbon::now()->startOfMonth();
                $endDate = Carbon::now()->endOfMonth();
                break;
        }

        // Lấy đơn hàng trong khoảng thời gian được chọn
        $orders = Order::whereBetween('created_at', [$startDate, $endDate])->get();

        // Nhóm và tính tổng doanh thu theo ngày
        $salesData = $orders->groupBy(function ($order) {
            return Carbon::parse($order->created_at)->format('d-m-Y');
        })->map(function ($dayOrders) {
            return $dayOrders->sum('total');
        });

        // Trả về dữ liệu cho biểu đồ
        return [
            'datasets' => [
                [
                    'label' => 'Doanh thu theo ngày',
                    'data' => $salesData->values(),
                ],
            ],
            'labels' => $salesData->keys(),
        ];
    }

    // Cấu hình bộ lọc để chọn khoảng thời gian
    protected function getFilters(): ?array
    {
        return [
            'today' => 'Hôm nay',
            'week' => 'Tuần này',
            'month' => 'Tháng này',
            'year' => 'Năm này',
        ];
    }
}
