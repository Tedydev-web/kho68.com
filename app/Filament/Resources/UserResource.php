<?php

    namespace App\Filament\Resources;

    use App\Filament\Resources\UserResource\Pages;
    use App\Filament\Resources\UserResource\RelationManagers;
    use App\Models\User;
    use App\Models\UserDetail;
    use Carbon\Carbon;
    use DeepCopy\Filter\Filter;
    use Filament\Actions\DeleteAction;
    use Filament\Actions\EditAction;
    use Filament\Actions\ViewAction;
    use Filament\Forms;
    use Filament\Forms\Form;
    use Filament\Resources\Resource;
    use Filament\Tables;
    use Filament\Tables\Actions\BulkActionGroup;
    use Filament\Tables\Actions\DeleteBulkAction;
    use Filament\Tables\Columns\BadgeColumn;
    use Filament\Tables\Table;
    use Illuminate\Database\Eloquent\Builder;
    use Illuminate\Database\Eloquent\SoftDeletingScope;
    use Filament\Tables\Columns\TextColumn;
    use Filament\Tables\Filters\SelectFilter;
    use Illuminate\Support\Carbon as SupportCarbon;
    use Illuminate\Support\Facades\Hash;


    class UserResource extends Resource
    {
        protected static ?string $model = User::class;

        protected static ?string $navigationIcon = 'heroicon-o-user';
        protected static ?string $navigationLabel = 'Quản lý người dùng';
//        private $record;

        public static function form(Form $form): Form
        {
            return $form
                ->schema([
                    \Filament\Forms\Components\Section::make('Thông tin tài khoản')
                        ->description('Vui lòng điền các thông tin tài khoản cần thiết.')
                        ->schema([
                            \Filament\Forms\Components\Grid::make(2) // Chia thành 2 cột
                            ->schema([
                                \Filament\Forms\Components\TextInput::make('userDetail.username')
                                    ->label('Tên tài khoản')
                                    ->required()
                                    ->nullable()
                                    ->default(fn($record) => $record ? $record->userDetail->username ?? null : null)
                                    ->helperText('Tên tài khoản của người dùng.'),

                                \Filament\Forms\Components\TextInput::make('name')
                                    ->label('Tên người dùng')
                                    ->required()
                                    ->nullable()
                                    ->helperText('Tên đầy đủ của người dùng.'),

                                    \Filament\Forms\Components\TextInput::make('email')
                                    ->label('Email')
                                    ->email()
                                    ->unique('users', 'email') // Bảng và cột trong cơ sở dữ liệu
                                    ->validationAttribute('email') // Chỉ định thuộc tính liên quan đến thông báo lỗi
                                    ->required()
                                    ->helperText('Địa chỉ email để người dùng nhận thông báo.')
                                    ->validationMessages([
                                        'unique' => 'Email đã được sử dụng, vui lòng dùng email khác.', // Thông báo lỗi tuỳ chỉnh
                                        'required' => 'Email là bắt buộc.',
                                        'email' => 'Vui lòng nhập đúng định dạng email.'
                                    ]),


                                \Filament\Forms\Components\TextInput::make('password')
                                    ->password()
                                    ->label('Mật khẩu')
                                    ->dehydrateStateUsing(fn($state) => filled($state) ? \Illuminate\Support\Facades\Hash::make($state) : null)
                                    ->required(condition: fn($livewire) => $livewire instanceof \App\Filament\Resources\UserResource\Pages\CreateUser)
                                    ->helperText('Mật khẩu cần có ít nhất 8 ký tự.'),

                                \Filament\Forms\Components\TextInput::make('userDetail.phone')
                                    ->label('Số điện thoại')
                                    ->nullable()
                                    ->helperText('Số điện thoại liên lạc của người dùng.'),

                                \Filament\Forms\Components\TextInput::make('userDetail.fullname')
                                    ->label('Họ và tên')
                                    ->nullable()
                                    ->helperText('Họ và tên đầy đủ của người dùng.'),
                            ]),

                            \Filament\Forms\Components\Select::make('roles')
                                ->relationship('roles', 'name')
                                ->multiple()
                                ->preload()
                                ->searchable()
                                ->label('Vai trò')
                                ->helperText('Chọn một hoặc nhiều vai trò cho người dùng.'),
                        ]),
                ]);
        }

        public static function table(Table $table): Table
        {
            return $table
                ->columns([
                    TextColumn::make('name')
                        ->label('Tên')
                        ->searchable() // Allow searching by name
                        ->sortable()   // Enable sorting on the 'name' column
                        ->limit(30),   // Truncate long names for better display

                    TextColumn::make('email')
                        ->label('Email')
                        ->searchable() // Allow searching by email
                        ->sortable(),  // Enable sorting on the 'email' column

                    BadgeColumn::make('roles')
                        ->label('Vai trò')
                        ->formatStateUsing(function ($record) {
                            // Get the roles and format them as a comma-separated string
                            return $record->roles->pluck('name')->implode(', ');
                        })
                        ->sortable(),  // Sorting won't directly work on the relationship
                    // Sorting by roles will require a custom query if needed

                    TextColumn::make('created_at')
                        ->label('Ngày tạo')
                        ->dateTime()  // Display the date and time in a readable format
                        ->sortable(), // Enable sorting on the 'created_at' column
                ])

                ->actions([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),

                ])
                ->bulkActions([
                    BulkActionGroup::make([
                        DeleteBulkAction::make(), // Bulk delete option
                    ]),
                ])
                ->filters([
                    SelectFilter::make('roles')
                        ->relationship('roles', 'name')
                        ->multiple()
                        ->label('Vai trò')
                ])
                ->defaultSort('created_at', 'desc'); // Default sorting by 'created_at' in descending order
        }

        protected function beforeSave($data)
        {
            $userDetailData = [
                'phone' => $data['userDetail']['phone'] ?? null,
                'fullname' => $data['userDetail']['fullname'] ?? null,
                'role' => $data['userDetail']['role'] ?? null,
            ];

            if ($this->record->userDetail) {
                // Update existing userDetail
                $this->record->userDetail->update($userDetailData);
            } else {
                // Create new userDetail

                UserDetail::create(array_merge($userDetailData, [
                    'user_id' => $this->record->id,
                    'username' => $data['username'] ?? null,
                    'ip_address' => $data['ip_address'] ?? null,
                ]));


            }
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
                'index' => Pages\ListUsers::route('/'),
                'create' => Pages\CreateUser::route('/create'),
                'edit' => Pages\EditUser::route('/{record}/edit'),
            ];
        }


    }
