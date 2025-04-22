<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WordpressProductResource\Pages;
use App\Filament\Resources\WordpressProductResource\RelationManagers;
use App\Models\WordpressProduct;
use Awcodes\Curator\Components\Forms\CuratorPicker;
use Filament\Forms;
use Filament\Forms\Components\BaseFileUpload;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class WordpressProductResource extends Resource
{
    protected static ?string $model = WordpressProduct::class;

    protected static ?string $navigationIcon = 'heroicon-o-window';
    protected static ?string $navigationLabel = 'Sản phẩm Wordpress';
    protected static ?string $navigationGroup = 'Wordpress';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                \Filament\Forms\Components\Section::make('Thông tin sản phẩm')
                    ->schema([
                        \Filament\Forms\Components\Grid::make(2)
                            ->schema([
                                \Filament\Forms\Components\Select::make('category_id')
                                    ->label('Danh mục')
                                    ->relationship('category', 'name')

                                    ->required()
                                    ->helperText('Chọn danh mục cho sản phẩm.'),

                                \Filament\Forms\Components\TextInput::make('name')
                                    ->label('Tên sản phẩm')
                                    ->required()
                                    ->live(onBlur: true)
                                    ->placeholder('Nhập tên sản phẩm')
                                    ->helperText('Tên đầy đủ của sản phẩm.')
                                    ->afterStateUpdated(function ($state, Set $set) {
                                        // Tạo slug từ tên
                                        $slug = Str::slug($state);

                                        // Kiểm tra slug trùng lặp trong cơ sở dữ liệu và thêm hậu tố nếu cần
                                        $existingSlug = \App\Models\WordpressProduct::where('slug', $slug)->exists();
                                        $counter = 1;
                                        $newSlug = $slug;

                                        // Nếu tồn tại slug, tiếp tục thêm hậu tố "-1", "-2",... cho đến khi tìm thấy slug chưa tồn tại
                                        while ($existingSlug) {
                                            $newSlug = $slug . '-' . $counter;
                                            $existingSlug = \App\Models\WordpressProduct::where('slug', $newSlug)->exists();
                                            $counter++;
                                        }

                                        // Đặt giá trị slug cuối cùng
                                        $set('slug', $newSlug);
                                    }),

                                \Filament\Forms\Components\TextInput::make('slug')
                                    ->label('Đường dẫn tĩnh')
                                    ->required()
                                    ->helperText('Đường dẫn tĩnh được tự động tạo từ tên sản phẩm.'),

                                \Filament\Forms\Components\TextInput::make('sku')
                                    ->label('Mã sản phẩm')
                                    ->default(fn() => 'K68-' . strtoupper(Str::random(6)))
                                    ->required()
                                    ->helperText('Mã sản phẩm duy nhất (SKU).'),

                                \Filament\Forms\Components\TextInput::make('price')
                                    ->label('Giá')
                                    ->required()
                                    ->numeric()
                                    ->helperText('Giá sản phẩm.'),

                                \Filament\Forms\Components\TextInput::make('sale_price')
                                    ->label('Giá khuyến mãi')
                                    ->numeric()
                                    ->helperText('Giá sản phẩm khi có khuyến mãi.'),

                                \Filament\Forms\Components\TextInput::make('sold')
                                    ->label('Số lượng đã bán')
                                    ->numeric()
                                    ->helperText('Số lượng sản phẩm đã bán.'),

                                \Filament\Forms\Components\TextInput::make('version')
                                    ->label('Phiên bản')
                                    ->helperText('Phiên bản của sản phẩm.'),

                                \Filament\Forms\Components\RichEditor::make('short_content')
                                    ->label('Mô tả ngắn')
                                    ->extraAttributes([
                                        'style' => 'min-height: 200px; max-height: 400px; overflow-y: auto;',
                                    ])
                                    ->helperText('Mô tả ngắn về sản phẩm.'),

                                \Filament\Forms\Components\RichEditor::make('long_content')
                                    ->label('Mô tả chi tiết')
                                    ->extraAttributes([
                                        'style' => 'min-height: 200px; max-height: 400px; overflow-y: auto;',
                                    ])
                                    ->helperText('Mô tả chi tiết về sản phẩm.'),

                                \Filament\Forms\Components\TextInput::make('demo')
                                    ->label('Liên kết demo')
                                    ->url()
                                    ->helperText('Liên kết đến trang demo của sản phẩm.'),

                                TextInput::make('download_link')
                                    ->label('Liên kết tải về')
                                    ->url()
                                    ->helperText('Liên kết tải về sản phẩm.'),


                                \Filament\Forms\Components\TextInput::make('system_requirements')
                                    ->label('Yêu cầu hệ thống')
                                    ->helperText('Yêu cầu hệ thống để chạy sản phẩm.'),

                                \Filament\Forms\Components\TextInput::make('license_key')
                                    ->label('Khóa bản quyền')
                                    ->helperText('Khóa bản quyền của sản phẩm.'),

                                \Filament\Forms\Components\DatePicker::make('license_expiration_date')
                                    ->label('Ngày hết hạn bản quyền')
                                    ->helperText('Ngày hết hạn của khóa bản quyền.'),

                                \Filament\Forms\Components\Select::make('status')
                                    ->label('Trạng thái')
                                    ->options([
                                        'active' => 'Hiện',
                                        'inactive' => 'Ẩn',
                                        // 'draft' => 'Bản nháp',
                                    ])
                                    ->default('draft')
                                    ->helperText('Trạng thái của sản phẩm.'),

                                // Nhóm hai trường ảnh và đặt chúng trong một cột
                                \Filament\Forms\Components\Group::make([
                                    CuratorPicker::make('image')
                                        ->label('Hình ảnh nổi bật')
                                        ->directory('Wordpress')
                                        ->default(fn($record) => $record ? $record->image : null)
                                        ->required()
                                        ->helperText('Hình ảnh chính của sản phẩm.'),

                                    CuratorPicker::make('gallery')
                                        ->label('Thư viện hình ảnh')
                                        ->multiple()
                                        ->directory('Wordpress')
                                        ->default(fn($record) => $record ? $record->gallery : null)
                                        ->helperText('Tải lên nhiều hình ảnh cho sản phẩm.'),
                                ]),
                            ])->columns(1),
                    ])

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('Tên')->sortable()->searchable(),
                Tables\Columns\BadgeColumn::make('category.name')
                    ->label('Danh mục')
                    ->sortable()
                    ->searchable()
                    ->color('primary'),
                TextColumn::make('price')->label('Giá')->sortable()->searchable()->money('VND'),
                Tables\Columns\BadgeColumn::make('status')
                    ->label('Trạng thái')
                    ->sortable()
                    ->searchable()
                    ->colors([
                        'success' => 'active',
                        'danger' => 'inactive',
                        'warning' => 'draft',
                    ])
                    ->formatStateUsing(function ($state) {
                        if ($state === 'active') {
                            return 'Hiển thị';
                        } elseif ($state === 'inactive') {
                            return 'Ẩn';
                        } else {
                            return 'Bản nháp';
                        }
                    }),
                TextColumn::make('sold')->label('Đã bán')->sortable()->searchable(),
                // TextColumn::make('created_at')->label('Ngày tạo')->dateTime('d/m/Y H:i:s'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category')
                    ->relationship('category', 'name')
                    ->label('Danh mục'),
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'active' => 'Hiển thị',
                        'inactive' => 'Ẩn',
                        'draft' => 'Bản nháp',
                    ])
                    ->label('Trạng thái'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()->label('Xóa'),
                ]),
            ])
            ->defaultSort('name', 'asc')
            ->reorderable('name');
    }
    public static function getNavigationBadge(): ?string
    {
        return (string)WordpressProduct::count();
    }
    public static function getGloballySearchableAttributes(): array
    {
        return ['name', 'slug',  'category.name'];
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
            'index' => Pages\ListWordpressProducts::route('/'),
            'create' => Pages\CreateWordpressProduct::route('/create'),
            'edit' => Pages\EditWordpressProduct::route('/{record}/edit'),
        ];
    }
}
