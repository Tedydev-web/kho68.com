<?php
namespace App\Filament\Resources\DashboardResource\Widgets;

use App\Models\Order;
use Filament\Widgets\BarChartWidget;
use Carbon\Carbon;

class OrderCountChart extends BarChartWidget
{
    protected static ?string $heading = 'Số lượng đơn hàng theo ngày';

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

        // Lấy số lượng đơn hàng trong khoảng thời gian được chọn
        $orders = Order::whereBetween('created_at', [$startDate, $endDate])->get();

        // Nhóm và đếm số lượng đơn hàng theo ngày
        $orderCountData = $orders->groupBy(function ($order) {
            return Carbon::parse($order->created_at)->format('d-m-Y');
        })->map(function ($dayOrders) {
            return $dayOrders->count();
        });

        // Trả về dữ liệu cho biểu đồ cột
        return [
            'datasets' => [
                [
                    'label' => 'Số lượng đơn hàng theo ngày',
                    'data' => $orderCountData->values(),
                    'backgroundColor' => 'rgba(54, 162, 235, 0.6)',
                    'borderColor' => 'rgba(54, 162, 235, 1)',
                    'borderWidth' => 1,
                ],
            ],
            'labels' => $orderCountData->keys(),
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
