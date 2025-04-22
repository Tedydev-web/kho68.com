<?php

    namespace App\Filament\Resources;

    use App\Filament\Resources\CategoryResource\Pages;
    use App\Filament\Resources\CategoryResource\RelationManagers;
    use App\Models\Category;
    use Filament\Forms\Components\Grid;
    use Filament\Forms\Components\Section;
    use Filament\Forms\Components\Select;
    use Filament\Forms\Components\TextInput;
    use Filament\Forms\Form;
    use Filament\Forms\Get;
    use Filament\Forms\Set;
    use Filament\Resources\Resource;
    use Filament\Tables;
    use Filament\Tables\Columns\BadgeColumn;
    use Filament\Tables\Columns\TextColumn;
    use Filament\Tables\Filters\Filter;
    use Filament\Tables\Table;
    use Illuminate\Database\Eloquent\Builder;
    use Illuminate\Support\Str;
    use Livewire\Livewire;


    class CategoryResource extends Resource
    {
        protected static ?string $model = Category::class;

        protected static ?string $navigationLabel = 'Danh mục (menu)';
        protected static ?string $navigationIcon = 'heroicon-o-folder';
        protected static ?string $pluralLabel = 'Danh mục (menu)';

        public static function form(Form $form): Form
        {
            return $form
                ->schema([
                    Section::make('Thông tin cơ bản')
                        ->description('Nhập thông tin cơ bản của danh mục')
                        ->schema([
                            Grid::make(2) // Two-column layout
                            ->schema([
                                TextInput::make('name')
                                    ->label('Tên danh mục')
                                    ->placeholder('Nhập tên danh mục...')
                                    ->required()
                                    ->maxLength(255)
                                    ->reactive()
                                    ->debounce(1000)
                                    ->helperText('Tên của danh mục phải không vượt quá 255 ký tự.')
                                    ->afterStateUpdated(function ($state, Get $get, Set $set) {
                                        if (!$get('slug')) {
                                            // Tạo slug từ name
                                            $slug = Str::slug($state);

                                            // Kiểm tra slug trùng lặp trong database và thêm hậu tố nếu cần
                                            $existingSlug = \App\Models\Category::where('slug', $slug)->exists();
                                            $counter = 1;
                                            $newSlug = $slug;

                                            // Nếu tồn tại slug, tiếp tục thêm hậu tố "-1", "-2",... cho đến khi tìm thấy slug chưa tồn tại
                                            while ($existingSlug) {
                                                $newSlug = $slug . '-' . $counter;
                                                $existingSlug = \App\Models\Category::where('slug', $newSlug)->exists();
                                                $counter++;
                                            }

                                            // Đặt giá trị slug cuối cùng
                                            $set('slug', $newSlug);
                                        }
                                    }),

                                TextInput::make('slug')
                                    ->label('Slug')
                                    ->placeholder('Nhập slug hoặc để tự động tạo...')
                                    ->helperText('Slug sẽ tự động tạo từ tên nếu bạn không nhập thủ công. Có thể chỉnh sửa.')
                                    ->required()
                                    ->maxLength(255)
                                    ->lazy(),
                            ]),
                        ])
                        ->columns(2), // Two-column grid for better layout

                    Section::make('Thiết lập chuyên mục')
                        ->description('Cấu hình các thuộc tính bổ sung cho danh mục')
                        ->schema([
                            Grid::make(2)
                                ->schema([
                                    Select::make('parent_id')
                                        ->label('Danh mục cha')
                                        ->options(function () {
                                            return self::buildCategoryTree();
                                        })
                                        ->placeholder('Chọn danh mục cha nếu có...')
                                        ->nullable()
                                        ->helperText('Danh mục này sẽ là con của danh mục đã chọn.'),

                                    Select::make('status')
                                        ->label('Trạng thái')
                                        ->options([
                                            'active' => 'Hoạt động',
                                            'inactive' => 'Không hoạt động',
                                        ])
                                        ->default('active')
                                        ->required()
                                        ->helperText('Chọn trạng thái hoạt động của danh mục.'),
                                ]),
                        ])
                        ->columns(2), // Two-column grid for better layout
                ]);
        }

        public static function table(Table $table): Table
        {
            return $table
                ->columns([
                    TextColumn::make('name')->sortable()->searchable(),
                    TextColumn::make('parent.name')->label('Danh mục Cha'),
                    BadgeColumn::make('status')->sortable()->label('Trạng thái')
                        ->formatStateUsing(function ($state) {
                            return $state === 'active' ? 'Hiển thị' : 'Ẩn';
                        })
                        ->colors([
                            'success' => 'active',
                            'danger' => 'inactive',
                        ]),
                ])
                ->filters([
                    // Filter theo trạng thái active/inactive
                    Tables\Filters\SelectFilter::make('status')
                        ->label('Lọc theo trạng thái')
                        ->options([
                            'active' => 'Hiển thị',
                            'inactive' => 'Ẩn',
                        ]),

                    // Filter tìm kiếm theo tên
                    Filter::make('name')
                        ->label('Tìm kiếm theo tên')
                        ->query(fn (Builder $query, $state) => $query->where('name', 'like', "%{$state}%")),
                ])
                ->actions([
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
                'index' => Pages\ListCategories::route('/'),
                'create' => Pages\CreateCategory::route('/create'),
                'edit' => Pages\EditCategory::route('/{record}/edit'),
            ];
        }

        // cấu trúc tree view select option category cha
        protected static function buildCategoryTree($parentId = null, $prefix = '')
        {
            $categories = Category::where('parent_id', $parentId)->get();
            $tree = [];

            foreach ($categories as $category) {
                $tree[$category->id] = $prefix . $category->name;
                $tree += self::buildCategoryTree($category->id, $prefix . '— ');
            }

            return $tree;
        }

        protected function afterCreate(): void
        {
            $categoryId = $this->record->id;

            Livewire::test(\App\Livewire\CreateCategoryPage::class, ['categoryId' => $categoryId])
                ->call('createPage');


        }
        public static function getNavigationBadge(): ?string
        {
            // Lấy tổng số lượng danh mục có hơn 10 sản phẩm
            $categoriesWithMoreThan10Products = Category::count();

            // Lấy tổng số lượng danh mục có hơn 20 sản phẩm
            $categoriesWithMoreThan20Products = Category::count();

            // Lấy tổng số lượng danh mục có hơn 50 sản phẩm
            $categoriesWithMoreThan50Products = Category::count();

            // Hiển thị số lượng danh mục dựa vào các mốc 50, 20, và 10 sản phẩm
            if ($categoriesWithMoreThan50Products > 0) {
                return $categoriesWithMoreThan50Products;
            } elseif ($categoriesWithMoreThan20Products > 0) {
                return $categoriesWithMoreThan20Products;
            } else {
                return $categoriesWithMoreThan10Products;
            }
        }

        public static function getNavigationBadgeColor(): ?string
        {
            // Thay đổi màu badge dựa trên số lượng sản phẩm trong danh mục
            $categoriesWithMoreThan50Products = Category::has('products', '>', 50)->count();
            $categoriesWithMoreThan20Products = Category::has('products', '>', count: 20)->count();

            if ($categoriesWithMoreThan50Products > 0) {
                return 'success';  // Màu xanh lá khi có hơn 50 sản phẩm
            } elseif ($categoriesWithMoreThan20Products > 0) {
                return 'warning';  // Màu vàng khi có hơn 20 sản phẩm
            } else {
                return 'primary';  // Màu xanh khi có hơn 10 sản phẩm
            }
        }


    }
