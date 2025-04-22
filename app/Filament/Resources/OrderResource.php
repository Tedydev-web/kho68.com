<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Models\User;
use App\Models\OrderItem;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Repeater;
use App\Models\SocialAccountProduct;
use App\Models\Course;
use App\Models\CourseModule;
use App\Models\WordpressProduct;
use App\Models\OtherProduct;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Grid;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\Filter;
use Filament\Widgets\StatsOverviewWidget\Card;
use Filament\Widgets\StatsOverviewWidget;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';

    protected static ?string $label = 'Đơn hàng';

    protected static ?string $navigationLabel = 'Đơn hàng';

    protected static ?string $pluralLabel = 'Đơn hàng';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(3)
                    ->schema([
                        Section::make('Sản phẩm của đơn hàng')
                            ->schema([
                                Repeater::make('items')
    ->label('Sản phẩm trong đơn hàng')
    ->relationship('items')
    ->schema([
        TextInput::make('course_product')
            ->label('Sản phẩm khóa học')
            ->disabled()
            ->visible(fn($record) => $record && $record->courseProduct !== null)
            ->afterStateHydrated(function ($component, $state, $record) {
                if ($record && $record->courseProduct) {
                    $component->state($record->courseProduct->title);
                }
            }),

        TextInput::make('social_account_product')
            ->label('Sản phẩm tài khoản mạng xã hội')
            ->disabled()
            ->visible(fn($record) => $record && $record->socialAccountProduct !== null)
            ->afterStateHydrated(function ($component, $state, $record) {
                if ($record && $record->socialAccountProduct) {
                    $component->state($record->socialAccountProduct->data_account);
                }
            }),

        TextInput::make('wordpress_product')
            ->label('Sản phẩm Wordpress')
            ->disabled()
            ->visible(fn($record) => $record && $record->wordpressProduct !== null)
            ->afterStateHydrated(function ($component, $state, $record) {
                if ($record && $record->wordpressProduct) {
                    $component->state($record->wordpressProduct->name);
                }
            }),

        TextInput::make('other_product')
            ->label('Sản phẩm khác')
            ->disabled()
            ->visible(fn($record) => $record && $record->otherProduct !== null)
            ->afterStateHydrated(function ($component, $state, $record) {
                if ($record && $record->otherProduct) {
                    $component->state($record->otherProduct->name);
                }
            }),

        TextInput::make('quantity')
            ->label('Số lượng')
            ->numeric()
            ->default(1)
            ->required(),

        TextInput::make('price')
            ->label('Giá')
            ->numeric()
            ->required(),
    ])
    ->required()
    ->columnSpan('full')

                            ])
                            ->columnSpan(2),
                        Section::make('Thông tin đơn hàng')
                            ->schema([
                                Select::make('user_id')
                                ->label('Người dùng')
                                ->relationship('user', 'name')
                                ->required()
                                ->afterStateHydrated(function ($state, callable $set) {
                                    if (is_null($state)) {
                                        $set('user_id', null); // Hoặc một giá trị mặc định nếu cần
                                    }
                                })
                                ->options(User::all()->pluck('name', 'id')->filter(fn($name) => !is_null($name))), // Lọc ra các tên không null


                                TextInput::make('total')
                                    ->label('Tổng tiền')
                                    ->numeric()
                                    ->required(),

                                Select::make('status')
                                    ->label('Trạng thái')
                                    ->options([
                                        'pending' => 'Pending',
                                        'complete' => 'Complete',
                                        'cancelled' => 'Cancelled',
                                    ])
                                    ->required(),

                                TextInput::make('payment_method')
                                    ->label('Phương thức thanh toán'),

                                TextInput::make('discount_code')
                                    ->label('Mã giảm giá'),

                                TextInput::make('discount_amount')
                                    ->label('Số tiền giảm giá')
                                    ->numeric(),
                            ])
                            ->columnSpan(1),
                    ])
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            TextColumn::make('id')
                ->label('ID')
                ->searchable(), // Cho phép tìm kiếm theo ID
            TextColumn::make('user.name')
                ->label('Người dùng')
                ->searchable(), // Cho phép tìm kiếm theo tên người dùng
            TextColumn::make('total')
                ->label('Tổng tiền')
                ->money('VND')
                ->searchable(), // Cho phép tìm kiếm theo tổng tiền
            TextColumn::make('status')
                ->label('Trạng thái')
                ->searchable(), // Cho phép tìm kiếm theo trạng thái
            TextColumn::make('items')
                ->label('Chi tiết sản phẩm')
                ->getStateUsing(function ($record) {
                    $productList = $record->items->map(function ($item) {
                        $productName = $item->courseProduct?->title ??
                            $item->socialAccountProduct?->data_account ??
                            $item->wordpressProduct?->name ??
                            $item->otherProduct?->name ?? 'Không xác định';
                        return "<li>{$item->quantity} x {$productName}</li>";
                    })->join('');
                    return "<ul>{$productList}</ul>";
                })
                ->html(),
            Tables\Columns\BadgeColumn::make('total_quantity')
                ->label('Tổng số lượng sản phẩm')
                ->getStateUsing(fn($record) => $record->getTotalQuantityAttribute())
                ->colors([
                    'primary',
                ]),
        ])
        ->filters([

            Filter::make('total_quantity')
                ->form([
                    Forms\Components\TextInput::make('min_quantity')
                        ->label('Số lượng tối thiểu')
                        ->numeric(),
                    Forms\Components\TextInput::make('max_quantity')
                        ->label('Số lượng tối đa')
                        ->numeric(),
                ])
                ->query(function (Builder $query, array $data): Builder {
                    return $query
                        ->when(
                            $data['min_quantity'],
                            fn (Builder $query, $min): Builder => $query->whereHas('items', function ($query) use ($min) {
                                $query->selectRaw('order_id, SUM(quantity) as total_quantity')
                                    ->groupBy('order_id')
                                    ->havingRaw('SUM(quantity) >= ?', [$min]);
                            })
                        )
                        ->when(
                            $data['max_quantity'],
                            fn (Builder $query, $max): Builder => $query->whereHas('items', function ($query) use ($max) {
                                $query->selectRaw('order_id, SUM(quantity) as total_quantity')
                                    ->groupBy('order_id')
                                    ->havingRaw('SUM(quantity) <= ?', [$max]);
                            })
                        );
                }),
            Filter::make('total')
                ->form([
                    Forms\Components\TextInput::make('min_total')
                        ->label('Tổng tiền tối thiểu')
                        ->numeric(),
                    Forms\Components\TextInput::make('max_total')
                        ->label('Tổng tiền tối đa')
                        ->numeric(),
                ])
                ->query(function (Builder $query, array $data): Builder {
                    return $query
                        ->when(
                            $data['min_total'],
                            fn (Builder $query, $min): Builder => $query->where('total', '>=', $min)
                        )
                        ->when(
                            $data['max_total'],
                            fn (Builder $query, $max): Builder => $query->where('total', '<=', $max)
                        );
                }),
        ])
        ->actions([
            Tables\Actions\ViewAction::make(),
            Tables\Actions\EditAction::make(),
        ])
        ->bulkActions([
            Tables\Actions\BulkActionGroup::make([
                Tables\Actions\DeleteBulkAction::make(),
            ]),
        ]);

    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        // Lấy tổng số đơn hàng
        return (string) Order::count();
    }

    public static function getWidgets(): array
    {
        return [
            OrderStats::class,
        ];
    }
}

class OrderStats extends StatsOverviewWidget
{
    protected function getCards(): array
    {
        $totalOrders = Order::count();
        $totalRevenue = Order::sum('total');

        return [
            Card::make('Tổng số đơn hàng', $totalOrders),
            Card::make('Tổng doanh thu', number_format($totalRevenue) . ' VND'),
        ];
    }
}
