<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReviewResource\Pages;
use App\Models\Review;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class ReviewResource extends Resource
{
    protected static ?string $model = Review::class;

    protected static ?string $navigationIcon = 'heroicon-o-star';

    protected static ?string $label = 'Đánh giá';

    protected static ?string $navigationLabel = 'Đánh giá';

    protected static ?string $pluralLabel = 'Đánh giá';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Thông tin người dùng')
                ->schema([
                    Forms\Components\Select::make('user_id')
                        ->label('Tên người dùng')
                        ->relationship('user', 'name')
                        ->searchable()
                        ->required(),
                ]),

            Forms\Components\Section::make('Nội dung đánh giá')
                ->schema([
                    Forms\Components\Textarea::make('comment')
                        ->label('Nhận xét')
                        ->required(),

                    Forms\Components\TextInput::make('rating')
                        ->label('Đánh giá')
                        ->required()
                        ->numeric()
                        ->minValue(1)
                        ->maxValue(5),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')->label('Tên người dùng'),
                TextColumn::make('reviewable')
                ->label('Tên sản phẩm') // Bạn có thể thay đổi nhãn nếu cần
                ->formatStateUsing(function ($state, $record) {
                    // Kiểm tra loại sản phẩm và lấy tên hoặc tiêu đề sản phẩm
                    $product = null;

                    switch ($record->reviewable_type) {
                        case 'App\Models\SocialAccountProduct':
                            $product = \App\Models\SocialAccountProduct::find($record->reviewable_id);
                            break;
                        case 'App\Models\WordpressProduct':
                            $product = \App\Models\WordpressProduct::find($record->reviewable_id);
                            break;
                        case 'App\Models\Course':
                            $product = \App\Models\Course::find($record->reviewable_id);
                            break;
                        case 'App\Models\OtherProduct':
                            $product = \App\Models\OtherProduct::find($record->reviewable_id);
                            break;
                    }

                    // Kiểm tra xem sản phẩm có tồn tại hay không và trả về tên hoặc tiêu đề
                    if ($product) {
                        return $product->title ?? $product->name ?? 'Sản phẩm không xác định'; // Trả về title nếu có, nếu không thì về name
                    }

                    return 'Sản phẩm không xác định'; // Trả về giá trị mặc định nếu không tìm thấy sản phẩm
                }),


                BadgeColumn::make('rating')
                    ->label('Đánh giá')
                    ->formatStateUsing(function ($state) {
                        return str_repeat('⭐', $state);
                    }),
                TextColumn::make('comment')
                ->searchable()
                ->label('Nhận xét'),
                TextColumn::make('created_at')->label('Ngày tạo')->date(),
            ])
            ->filters([
                // SelectFilter::make('user')
                //     ->relationship('user', 'name')
                //     ->label('Người dùng'),
                Filter::make('created_at')
                    ->form([
                        Forms\Components\DatePicker::make('created_from')
                            ->label('Từ ngày'),
                        Forms\Components\DatePicker::make('created_until')
                            ->label('Đến ngày'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    })
                    ->label('Ngày tạo'),
                // SelectFilter::make('rating')
                //     ->options([
                //         '1' => '1 sao',
                //         '2' => '2 sao',
                //         '3' => '3 sao',
                //         '4' => '4 sao',
                //         '5' => '5 sao',
                //     ])
                //     ->label('Đánh giá'),
            ])
            ->actions([
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListReviews::route('/'),
            'create' => Pages\CreateReview::route('/create'),
            'edit' => Pages\EditReview::route('/{record}/edit'),
        ];
    }
}
