<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\CourseModule;
use Filament\Resources\Resource;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\CourseModuleResource\Pages;
use App\Filament\Resources\CourseModuleResource\RelationManagers;
use Filament\Forms\Components\Select;
use Filament\Forms\Set;
use Str;

class CourseModuleResource extends Resource
{
    protected static ?string $model = CourseModule::class;

    protected static ?string $navigationLabel = 'Bài học';
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationGroup = 'Quản lý khóa học';

    protected static ?string $label = 'Bài học';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make('Thông tin bài học')
                ->schema([

                    Grid::make(2)
                        ->schema([
                            TextInput::make('title')
                                ->label('Tên bài học')
                                ->required()
                                ->live(onBlur: true)
                                    ->afterStateUpdated(function ($state, Set $set) {
                                        // Tạo slug từ name
                                        $slug = Str::slug($state);

                                        // Kiểm tra slug trùng lặp trong database và thêm hậu tố nếu cần
                                        $existingSlug = \App\Models\CourseModule::where('slug', $slug)->exists();
                                        $counter = 1;
                                        $newSlug = $slug;

                                        // Nếu tồn tại slug, tiếp tục thêm hậu tố "-1", "-2",... cho đến khi tìm thấy slug chưa tồn tại
                                        while ($existingSlug) {
                                            $newSlug = $slug . '-' . $counter;
                                            $existingSlug = \App\Models\CourseModule::where('slug', $newSlug)->exists();
                                            $counter++;
                                        }

                                        // Đặt giá trị slug cuối cùng
                                        $set('slug', $newSlug);
                                    }),
                                    TextInput::make('slug')
                                    ->label('Slug')
                                    ->unique(CourseModule::class, 'slug', ignoreRecord: true)
                                    ->required()
                                    ->disabled()
                                    ->dehydrated(),
                            TextInput::make('order')
                                ->label('Thứ tự')
                                ->numeric()
                                ->hidden()
                                ->dehydrated()
                                ->default(0),
                                Select::make('course_id')
                                ->label('Khóa học')
                                ->relationship('course', 'title') // Lấy danh sách từ bảng courses
                                ->required(),
                        ]),

                    RichEditor::make('content')
                        ->label('Nội dung')
                        ->nullable(),

                    TextInput::make('download_link')
                        ->label('Link tài liệu')
                        ->nullable(),

                    TextInput::make('video_url')
                        ->label('Link video')
                        ->nullable(),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            TextColumn::make('course.title')->label('Khóa học')->sortable()->searchable(),
            TextColumn::make('title')->label('Tên bài học')->searchable(),
            // TextColumn::make('video_url')->label('Link video')->searchable(),
            // TextColumn::make('download_link')->label('Link tài liệu')->searchable(),
            // TextColumn::make('order')->label('Thứ tự')->sortable(),
            // TextColumn::make('created_at')->label('Ngày tạo')->dateTime()->sortable(),
            // TextColumn::make('updated_at')->label('Ngày cập nhật')->dateTime()->sortable(),
        ])
        ->filters([
            Tables\Filters\SelectFilter::make('course')
                ->relationship('course', 'title')
                ->label('Khóa học'),

            Tables\Filters\Filter::make('has_video')
                ->label('Bài học có video')
                ->query(fn (Builder $query) => $query->whereNotNull('video_url')),

            Tables\Filters\Filter::make('no_video')
                ->label('Bài học không có video')
                ->query(fn (Builder $query) => $query->whereNull('video_url')),

            Tables\Filters\Filter::make('recent')
                ->label('Bài học mới nhất')
                ->query(fn (Builder $query) => $query->orderBy('created_at', 'desc')->limit(10)),
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
            'index' => Pages\ListCourseModules::route('/'),
            'create' => Pages\CreateCourseModule::route('/create'),
            'edit' => Pages\EditCourseModule::route('/{record}/edit'),
        ];
    }
    public static function getNavigationBadge(): ?string
{
    return (string) CourseModule::count();
}

}
