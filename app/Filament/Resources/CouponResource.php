<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CouponResource\Pages;
use App\Filament\Resources\CouponResource\RelationManagers;
use App\Models\Coupon;
use DateTime;
use Filament\Actions\Action as ActionsAction;
use Filament\Actions\Modal\Actions\Action;
use Filament\Forms;
use Filament\Forms\Components\Actions\Action as ComponentsActionsAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CouponResource extends Resource
{
    protected static ?string $model = Coupon::class;

    protected static ?string $navigationIcon = 'heroicon-o-ticket';
    protected static ?string $navigationLabel = 'Mã giảm giá';
    protected static ?string $slug = 'coupons';
    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            // Section cho thông tin mã giảm giá
            Forms\Components\Section::make('Thông tin mã giảm giá')
                ->schema([
                    Forms\Components\Grid::make()
                        ->columns(2) // Số cột
                        ->schema([
                            Forms\Components\TextInput::make('code')
                                ->required()
                                ->unique(ignoreRecord: true)
                                ->label('Mã coupon')
                                ->placeholder('Nhập mã coupon'),

                            Forms\Components\Select::make('discount_type')
                                ->required()
                                ->options([
                                    'fixed' => 'Giảm giá cố định',
                                    'percentage' => 'Giảm giá theo phần trăm',
                                ])
                                ->label('Loại giảm giá')
                                ->placeholder('Chọn loại giảm giá'),
                        ]),
                ])
                ->columnSpan(2), // Chiếm toàn bộ chiều rộng của cột

            // Section cho thông tin giảm giá
            Forms\Components\Section::make('Thông tin giảm giá')
                ->schema([
                    Forms\Components\Grid::make()
                        ->columns(2) // Số cột
                        ->schema([
                            Forms\Components\TextInput::make('discount_amount')
                                ->required()
                                ->numeric()
                                ->label('Số tiền giảm')
                                ->placeholder('Nhập số tiền giảm'),

                            Forms\Components\DateTimePicker::make('start_date')
                                ->nullable()
                                ->label('Ngày bắt đầu')
                                ->placeholder('Chọn ngày bắt đầu'),

                            Forms\Components\DateTimePicker::make('end_date')
                                ->nullable()
                                ->label('Ngày kết thúc')
                                ->placeholder('Chọn ngày kết thúc'),

                            Forms\Components\TextInput::make('usage_limit')
                                ->required()
                                ->numeric()
                                ->label('Giới hạn sử dụng')
                                ->placeholder('Nhập giới hạn sử dụng'),
                        ]),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            Tables\Columns\TextColumn::make('code')
            ->searchable()
            ->label('Mã coupon'),
            Tables\Columns\TextColumn::make('discount_amount')
            ->searchable()
            ->label('Số tiền giảm'),
            Tables\Columns\TextColumn::make('discount_type')
            ->searchable()
            ->label('Loại giảm giá'),
            Tables\Columns\TextColumn::make('start_date')->label('Ngày bắt đầu'),
            Tables\Columns\TextColumn::make('end_date')->label('Ngày kết thúc'),
            Tables\Columns\TextColumn::make('usage_limit')->label('Giới hạn sử dụng'),
        ])
        ->filters([
            // Filter by Discount Type
            Tables\Filters\SelectFilter::make('discount_type')
                ->options([
                    'fixed' => 'Giảm giá cố định',
                    'percent' => 'Giảm giá phần trăm',
                ])
                ->label('Loại giảm giá'),

            // Filter by Start Date
            Tables\Filters\Filter::make('start_date')
                ->form([
                    Forms\Components\DatePicker::make('start_date')->label('Ngày bắt đầu từ')
                ])
                ->query(function ($query, array $data) {
                    return $query->when($data['start_date'], fn ($query, $date) => $query->whereDate('start_date', '>=', $date));
                })
                ->label('Lọc theo ngày bắt đầu'),

            // Filter by End Date
            Tables\Filters\Filter::make('end_date')
                ->form([
                    Forms\Components\DatePicker::make('end_date')->label('Ngày kết thúc đến'),
                ])
                ->query(function ($query, array $data) {
                    return $query->when($data['end_date'], fn ($query, $date) => $query->whereDate('end_date', '<=', $date));
                })
                ->label('Lọc theo ngày kết thúc'),
        ])
        ->actions([
            Tables\Actions\ViewAction::make(),
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListCoupons::route('/'),
            'create' => Pages\CreateCoupon::route('/create'),
            'edit' => Pages\EditCoupon::route('/{record}/edit'),
        ];
    }

}
