<?php

    namespace App\Filament\Resources;

    use App\Filament\Resources\WebsiteSettingResource\Pages;
    use App\Filament\Resources\WebsiteSettingResource\RelationManagers;
    use App\Models\WebsiteSetting;
use Awcodes\Curator\Components\Forms\CuratorPicker;
use Filament\Forms;
    use Filament\Forms\Components\Grid;
    use Filament\Forms\Form;
    use Filament\Resources\Resource;
    use Filament\Tables;
    use Filament\Tables\Table;
    use Illuminate\Database\Eloquent\Builder;
    use Illuminate\Database\Eloquent\SoftDeletingScope;
    use Filament\Tables\Columns\TextColumn;
    use Filament\Forms\Components\TextInput;
    use Filament\Forms\Components\Textarea;
    use Filament\Forms\Components\ImageUpload;
    use Filament\Forms\Components\FileUpload;

    class WebsiteSettingResource extends Resource
    {
        protected static ?string $model = WebsiteSetting::class;

        protected static ?string $navigationIcon = 'heroicon-o-cog';
        protected static ?string $navigationLabel = 'Cài đặt website';
        protected static ?string $pluralLabel = 'Cài đặt website';

        public static function getNavigationUrl(): string
        {
            return url('/k68-admin/website-settings/1/edit');
        }

        public static function form(Form $form): Form
        {
            return $form
            ->schema([
                \Filament\Forms\Components\Section::make('Thông tin chung') // Section cho thông tin chung
                    ->schema([
                        \Filament\Forms\Components\Grid::make(2) // Chia thành 2 cột
                            ->schema([
                                \Filament\Forms\Components\TextInput::make('email')
                                    ->label('Email')
                                    ->required()
                                    ->email()
                                    ->placeholder('Nhập địa chỉ email')
                                    ->helperText('Địa chỉ email của người dùng.'),

                                \Filament\Forms\Components\TextInput::make('support_phone')
                                    ->label('Số điện thoại')
                                    ->maxLength(20)
                                    ->placeholder('Nhập số điện thoại')
                                    ->helperText('Số điện thoại hỗ trợ liên hệ.'),
                                    CuratorPicker::make('logo')

                                    ->label('Logo trang web')
                                    ->directory('SettingWebsite')
                                    ->nullable()
                                    ->helperText('Tải lên logo của trang web.'),

                                    CuratorPicker::make('favicon')
                                    ->label('Favicon trang web')
                                    ->directory('SettingWebsite')
                                    ->nullable()
                                    ->helperText('Tải lên favicon cho trang web.'),

                                \Filament\Forms\Components\TextInput::make('site_name')
                                    ->label('Tên website')
                                    ->required()
                                    ->placeholder('Nhập tên website')
                                    ->helperText('Tên hiển thị của trang web.'),

                                \Filament\Forms\Components\Textarea::make('site_description')
                                    ->label('Mô tả website')
                                    ->nullable()
                                    ->placeholder('Nhập mô tả cho trang web')
                                    ->helperText('Mô tả ngắn gọn về nội dung của trang web.'),

                                \Filament\Forms\Components\Textarea::make('site_keywords')
                                    ->label('Từ khóa')
                                    ->nullable()
                                    ->placeholder('Nhập từ khóa cho SEO')
                                    ->helperText('Các từ khóa liên quan đến trang web.'),

                                \Filament\Forms\Components\TextInput::make('site_author')
                                    ->label('Site Author')
                                    ->hidden()
                                    ->nullable()
                                    ->helperText('Tên tác giả của trang web.'),

                            // \Filament\Forms\Components\Textarea::make('address')
                            //         ->label('Địa chỉ')
                            //         ->nullable(),
                                    \Filament\Forms\Components\TextInput::make('download_limit')
                                    ->label('Giới hạn lượt tải')
                                    ->required()
                                    ->numeric()
                                    ->placeholder('Nhập giới hạn lượt tải')
                                    ->helperText('Số lần tải tối đa cho phép.'),

                                \Filament\Forms\Components\TextInput::make('timeframe_hours')
                                    ->label('Khoảng thời gian (giờ)')
                                    ->required()
                                    ->numeric()
                                    ->placeholder('Nhập khoảng thời gian')
                                    ->helperText('Thời gian trong giờ để giới hạn lượt tải.'),
                            ]),
                    ]),

                \Filament\Forms\Components\Section::make('Chính sách') // Section cho chính sách
                    ->schema([
                        \Filament\Forms\Components\RichEditor::make('payment_policy')
                            ->label('Chính sách thanh toán')
                            ->nullable()
                            ->extraAttributes([
                                'style' => 'min-height: 400px; max-height: 600px; overflow-y: auto;',
                            ])
                            ->helperText('Mô tả chính sách thanh toán của bạn.'),

                        \Filament\Forms\Components\RichEditor::make('warranty_policy')
                            ->label('Chính sách bảo hành')
                            ->nullable()
                            ->extraAttributes([
                                'style' => 'min-height: 400px; max-height: 600px; overflow-y: auto;',
                            ])
                            ->helperText('Mô tả chính sách bảo hành của bạn.'),

                        \Filament\Forms\Components\RichEditor::make('privacy_policy')
                            ->label('Chính sách bảo mật')
                            ->nullable()
                            ->extraAttributes([
                                'style' => 'min-height: 400px; max-height: 600px; overflow-y: auto;',
                            ])
                            ->helperText('Mô tả chính sách bảo mật của bạn.'),
                    ]),
            ]);
        }

        public static function table(Table $table): Table
        {
            return $table
                ->columns([
                    TextColumn::make('site_name')
                        ->label('Site Name'),
                    TextColumn::make('email')
                        ->label('Email'),
                    TextColumn::make('support_phone')
                        ->label('Support Phone'),
                ])
                ->filters([])
                ->headerActions([])
                ->bulkActions([])
                ->filters([
                    //
                ])
                ->actions([
                    Tables\Actions\EditAction::make(),
                ])
                ->bulkActions([
                    Tables\Actions\BulkActionGroup::make([
                        Tables\Actions\DeleteBulkAction::make(),
                    ])
                    ,
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
                'index' => Pages\ListWebsiteSettings::route('/'),
                'create' => Pages\CreateWebsiteSetting::route('/create'),
                'edit' => Pages\EditWebsiteSetting::route('/{record}/edit'),
            ];
        }
    }
