<?php

namespace App\Filament\Resources\DashboardResource\Widgets;

use App\Models\SocialAccountProduct;
use App\Models\WordpressProduct;
use App\Models\Course;
use App\Models\OtherProduct;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class ProductStats extends BaseWidget
{
    protected function getCards(): array
    {
        $totalSocialAccounts = SocialAccountProduct::count();
        $totalWordpressProducts = WordpressProduct::count() ?? null;
        $totalCourses = Course::count();
        $totalOtherProducts = OtherProduct::count();

        return [
            Card::make('Sản phẩm Social Account', $totalSocialAccounts)
                ->description('Tổng số sản phẩm Social Account')
                ->descriptionIcon('heroicon-s-user-group') // Icon từ Heroicons
                ->color('primary') // Màu xanh dương

                ->chart([5, 10, 7, 15, 19, 10, 12]) // Thêm biểu đồ mini
                ->chartColor('success'), // Màu biểu đồ mini là xanh

            Card::make('Sản phẩm Wordpress', $totalWordpressProducts)
                ->description('Tổng số sản phẩm Wordpress')
                ->descriptionIcon('heroicon-s-globe-alt') // Icon từ Heroicons
                ->color('success') // Màu xanh lá
                ->chart([8, 11, 5, 14, 17, 6, 9])
                ->chartColor('danger'), // Màu biểu đồ mini là đỏ

            Card::make('Sản phẩm Course', $totalCourses)
                ->description('Tổng số sản phẩm khóa học')
                ->descriptionIcon('heroicon-s-book-open') // Icon từ Heroicons
                ->color('info') // Màu xanh nhạt
                ->chart([6, 9, 4, 11, 15, 8, 7])
                ->chartColor('primary'), // Màu biểu đồ mini là xanh dương

            Card::make('Sản phẩm Khác', $totalOtherProducts)
                ->description('Tổng số sản phẩm khác')
                ->descriptionIcon('heroicon-s-archive-box') // Icon từ Heroicons
                ->color('warning') // Màu vàng
                ->chart([3, 5, 2, 8, 12, 4, 6])
                ->chartColor('warning'), // Màu biểu đồ mini là vàng
        ];
    }
}
