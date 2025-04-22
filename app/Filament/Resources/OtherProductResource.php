<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OtherProductResource\Pages;
use App\Filament\Resources\OtherProductResource\RelationManagers;
use App\Models\OtherProduct;
use App\Models\SocialAccountProduct;
use Awcodes\Curator\Components\Forms\CuratorPicker;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class OtherProductResource extends Resource
{
    protected static ?string $model = OtherProduct::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    // Thay đổi tên và icon
    protected static ?string $label = 'Sản phẩm khác';
    protected static ?string $pluralLabel = 'Sản phẩm khác';
    protected static ?string $navigationLabel = 'Sản phẩm khác';
    protected static ?string $navigationGroup = 'Khác';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Section for basic information
                Section::make('Thông tin cơ bản')
                    ->schema([
                        Grid::make(2) // 2 columns layout
                            ->schema([
                                TextInput::make('name')
                                    ->label('Tên sản phẩm')
                                    ->required()
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(function ($state, Set $set) {
                                        // Tạo slug từ name
                                        $slug = Str::slug($state);

                                        // Kiểm tra slug trùng lặp trong database và thêm hậu tố nếu cần
                                        $existingSlug = \App\Models\OtherProduct::where('slug', $slug)->exists();
                                        $counter = 1;
                                        $newSlug = $slug;

                                        // Nếu tồn tại slug, tiếp tục thêm hậu tố "-1", "-2",... cho đến khi tìm thấy slug chưa tồn tại
                                        while ($existingSlug) {
                                            $newSlug = $slug . '-' . $counter;
                                            $existingSlug = \App\Models\OtherProduct::where('slug', $newSlug)->exists();
                                            $counter++;
                                        }

                                        // Đặt giá trị slug cuối cùng
                                        $set('slug', $newSlug);
                                    }),

                                TextInput::make('slug')
                                    ->label('Slug')
                                    ->unique(OtherProduct::class, 'slug', ignoreRecord: true)
                                    ->required()
                                    ->dehydrated(),
                            ]),
                        CuratorPicker::make('thumbnail')
                            ->label('Ảnh đại diện')
                            ->directory('OtherProduct')
                            ->nullable()
                            ->required(),

                        Select::make('category_id')
                            ->label('Danh mục')
                            ->options(function () {
                                return \App\Models\Category::pluck('name', 'id');
                            })
                            ->required()
                            ->placeholder('Chọn danh mục'),

                    ]),

                // Section for inventory
                Section::make('Quản lý kho')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('stock')
                                    ->label('Tồn kho')
                                    ->numeric()
                                    ->default(0),

                                TextInput::make('sold_quantity')
                                    ->label('Đã bán')
                                    ->numeric()
                                    ->default(0),
                            ]),
                    ]),

                // Section for pricing and content
                Section::make('Giá và Nội dung')
                    ->schema([
                        TextInput::make('price')
                            ->prefix('vnd')
                            ->label('Giá sản phẩm')
                            ->numeric()
                            ->nullable(),

                        RichEditor::make('description')
                            ->label('Mô tả sản phẩm')
                            ->nullable(),
                    ]),
                Section::make('Bộ sưu tập ảnh')
                    ->schema(components: [
                        Repeater::make('gallery')
                            ->label('Thêm ảnh vào bộ sưu tập')
                            ->schema(components: [
                                FileUpload::make('image')
                                    ->image()
                                    ->label(label: 'Ảnh')
                                    ->directory('OtherProduct/gallery')
                                    ->rules('mimes:jpeg,jpg,png,gif,webp')
                            ])
                            ->collapsible(),
                    ])
                    ->columns(1),

                Section::make('Link & Yêu cầu hệ thống')
                    ->schema([
                        TextInput::make('demo_link')
                            ->label('Link demo sản phẩm')
                            ->url()
                            ->nullable(),

                        TextInput::make('download_link')
                            ->label('Link tải về sản phẩm')
                            ->url()
                            ->nullable(),

                        RichEditor::make('system_requirements')
                            ->label('Yêu cầu hệ thống')
                            ->nullable(),
                    ])
                    ->columns(1),
                Section::make('Dữ liệu tài khoản và trạng thái')
                    ->schema([
                        Select::make('status')
                            ->label('Trạng thái')
                            ->options([
                                'active' => 'Hiển thị',
                                'inactive' => 'Ẩn',
                            ])
                            ->default('active') // Giá trị mặc định
                            ->required(),

                        Textarea::make('additional_data')
                            ->label('Dữ liệu sản phẩm')
                            ->placeholder('Nhập thông tin bổ sung cho sản phẩm')
                            ->nullable(), // Trường này không bắt buộc
                    ])
                    ->columns(1),


            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('Tên sản phẩm')->searchable(),
                TextColumn::make('price')
                    ->label('Giá')
                    ->sortable()
                    ->searchable()
                    ->money('VND'),
                Tables\Columns\BadgeColumn::make('stock')
                    ->label('Tồn kho')
                    ->sortable()
                    ->color('primary'),
                Tables\Columns\BadgeColumn::make('sold_quantity')
                    ->label('Đã bán')
                    ->sortable()
                    ->color('primary'),
            ])
            ->filters([
                Tables\Filters\Filter::make('has_stock')
                    ->label('Còn hàng')
                    ->query(fn(Builder $query) => $query->where('stock', '>', 0)),

                Tables\Filters\Filter::make('on_sale')
                    ->label('Có giảm giá')
                    ->query(fn(Builder $query) => $query->whereNotNull('price')),

                Tables\Filters\Filter::make('high_stock')
                    ->label('Tồn kho trên 100')
                    ->query(fn(Builder $query) => $query->where('stock', '>', 100)),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\BulkAction::make('setInStock')
                        ->label('Đặt tồn kho cho sản phẩm')
                        ->action(fn($records) => $records->each->update(['stock' => 100])),
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
            'index' => Pages\ListOtherProducts::route('/'),
            'create' => Pages\CreateOtherProduct::route('/create'),
            'edit' => Pages\EditOtherProduct::route('/{record}/edit'),
        ];
    }
    public static function getNavigationBadge(): ?string
    {
        // Lấy tổng số lượng sản phẩm khác
        return (string) OtherProduct::count();
    }

    public static function getNavigationBadgeColor(): ?string
    {
        // Thay đổi màu của badge dựa trên số lượng sản phẩm
        $productCount = OtherProduct::count();

        if ($productCount > 100) {
            return 'success';  // Xanh lá nếu số lượng sản phẩm trên 100
        } elseif ($productCount > 50) {
            return 'warning';  // Vàng nếu số lượng sản phẩm từ 51 đến 100
        } else {
            return 'primary';  // Xanh dương nếu số lượng sản phẩm dưới 50
        }
    }
}
