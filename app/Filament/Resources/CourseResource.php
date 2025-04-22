<?php

    namespace App\Filament\Resources;

    use Filament\Forms;
    use Filament\Tables;
    use App\Models\Course;
    use Filament\Forms\Set;
    use Filament\Forms\Form;
    use Filament\Tables\Table;
    use Illuminate\Support\Str;
    use Filament\Resources\Resource;
    use Filament\Forms\Components\Select;
    use Filament\Forms\Components\Section;
    use Filament\Tables\Actions\EditAction;
    use Filament\Tables\Columns\TextColumn;
    use Filament\Forms\Components\TextInput;
    use Filament\Tables\Columns\ImageColumn;

    use Filament\Forms\Components\FileUpload;
    use Filament\Forms\Components\RichEditor;
    use Illuminate\Database\Eloquent\Builder;
    use Filament\Tables\Actions\BulkActionGroup;
    use Filament\Tables\Actions\DeleteBulkAction;
    use App\Filament\Resources\CourseResource\Pages;
    use Illuminate\Database\Eloquent\SoftDeletingScope;
    use App\Filament\Resources\CourseResource\Pages\EditCourse;
    use App\Filament\Resources\CourseResource\RelationManagers;
    use App\Filament\Resources\CourseResource\Pages\ListCourses;
    use App\Filament\Resources\CourseResource\Pages\CreateCourse;
use Awcodes\Curator\Components\Forms\CuratorPicker;
use Filament\Forms\Components\Grid;
    use Filament\Tables\Filters\SelectFilter;
    use Illuminate\Database\Eloquent\Collection;

    class CourseResource extends Resource
    {
        protected static ?string $model = Course::class;

        protected static ?string $navigationLabel = 'Khóa học';
        protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
        protected static ?string $navigationGroup = 'Quản lý khóa học';

        public static function form(Form $form): Form
        {
            return $form->schema([
                Section::make('Thông tin khóa học')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('title')
                                    ->label('Tên khóa học')
                                    ->required()
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(function ($state, Set $set) {
                                        // Tạo slug từ name
                                        $slug = Str::slug($state);

                                        // Kiểm tra slug trùng lặp trong database và thêm hậu tố nếu cần
                                        $existingSlug = \App\Models\Course::where('slug', $slug)->exists();
                                        $counter = 1;
                                        $newSlug = $slug;

                                        // Nếu tồn tại slug, tiếp tục thêm hậu tố "-1", "-2",... cho đến khi tìm thấy slug chưa tồn tại
                                        while ($existingSlug) {
                                            $newSlug = $slug . '-' . $counter;
                                            $existingSlug = \App\Models\Course::where('slug', $newSlug)->exists();
                                            $counter++;
                                        }

                                        // Đặt giá trị slug cuối cùng
                                        $set('slug', $newSlug);
                                    }),

                                TextInput::make('slug')
                                    ->label('Slug')
                                    ->unique(Course::class, 'slug', ignoreRecord: true)
                                    ->required()
                                    ->disabled()
                                    ->dehydrated(),
                                Select::make('category_id')
                                    ->label('Danh mục')
                                    ->relationship('category', 'name') // Liên kết với bảng categories qua trường 'name'
                                    ->required(),
                            ]),

                            CuratorPicker::make(name: 'image')
                                ->label('Ảnh đại diện')
                                ->directory('media'),

                        RichEditor::make('short_description')
                            ->label('Mô tả ngắn')
                            ->extraInputAttributes([ "style"=> "max-height: 400px; overflow: scroll"])
                            ->nullable(),

                        RichEditor::make('long_description')
                            ->label('Mô tả chi tiết')
                            ->extraInputAttributes(["style" => "max-height: 400px; overflow: scroll"])

                            ->nullable(),

                        Grid::make(2)
                            ->schema([
                                TextInput::make('price')
                                    ->label('Giá')
                                    ->numeric()
                                    ->prefix('VND'),

                                TextInput::make('sale_price')
                                    ->label('Giá khuyến mãi')
                                    ->numeric()
                                    ->prefix('VND')
                                    ->nullable(),
                            ]),

                        TextInput::make('instructor')
                            ->label('Giảng viên')
                            ->nullable(),

                        TextInput::make('duration')
                            ->label('Thời lượng')
                            ->placeholder('3 giờ 02 phút')
                            ->nullable(),

                        Select::make('level')
                            ->label('Cấp độ khóa học')
                            ->options([
                                'Tất cả các cấp độ' => 'Tất cả các cấp độ',
                                'Dễ' => 'Dễ',
                                'Trung bình' => 'Trung bình',
                                'Khó' => 'Khó',
                            ])
                            ->default('Tất cả các cấp độ')
                            ->nullable(),

                        Select::make('status')
                            ->label('Trạng thái')
                            ->options([
                                'active' => 'Hoạt động',
                                'inactive' => 'Không hoạt động',
                                'draft' => 'Bản nháp',
                            ])
                            ->default('active'),
                    ]),
            ]);
        }

        public static function table(Table $table): Table
        {
            return $table
                ->columns([
                    TextColumn::make('title')->label('Tên khóa học')->searchable(),
                    Tables\Columns\BadgeColumn::make('category.name')
                        ->label('Danh mục')
                        ->sortable()
                        ->colors([
                            'primary',
                        ]),
                    TextColumn::make('price')->label('Giá')->money('VND'),
                    TextColumn::make('sale_price')->label('Giá khuyến mãi')->money('VND'),
                    Tables\Columns\BadgeColumn::make('status')
                        ->label('Trạng thái')
                        ->colors([
                            'success' => 'active',
                            'danger' => 'inactive',
                            'warning' => 'draft',
                        ])
                        ->formatStateUsing(fn ($state) => match ($state) {
                            'active' => 'Hiển thị',
                            'inactive' => 'Ẩn',
                            'draft' => 'Bản nháp',
                            default => $state,
                        }),
                ])
                ->filters([
                    SelectFilter::make('status')
                        ->label('Trạng thái')
                        ->options([
                            'active' => 'Hiển thị',
                            'inactive' => 'Ẩn',
                            'draft' => 'Bản nháp',
                        ]),

                    Tables\Filters\Filter::make('has_sale_price')
                        ->label('Có khuyến mãi')
                        ->query(fn(Builder $query) => $query->whereNotNull('sale_price')),

                    Tables\Filters\Filter::make('high_price')
                        ->label('Giá trên 1 triệu')
                        ->query(fn(Builder $query) => $query->where('price', '>', 1000000)),
                ])
                ->actions([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                    Tables\Actions\ViewAction::make()->label('Xem chi tiết'),
                ])
                ->bulkActions([
                    BulkActionGroup::make([
                        Tables\Actions\DeleteBulkAction::make(),
                        Tables\Actions\BulkAction::make('publish')
                            ->label('Publish Selected')
                            ->action(fn(Collection $records) => $records->each->update(['status' => 'active'])),
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
                'index' => Pages\ListCourses::route('/'),
                'create' => Pages\CreateCourse::route('/create'),
                'edit' => Pages\EditCourse::route('/{record}/edit'),
            ];
        }

        public static function getNavigationBadge(): ?string
        {
            return (string)Course::count();
        }

    }
