<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Forms\Components\MultiSelect;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use App\Models\SocialAccountProduct;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\SocialAccountProductResource\Pages;
use App\Filament\Resources\SocialAccountProductResource\RelationManagers;
use App\Filament\Resources\SocialAccountProductResource\Pages\EditSocialAccountProduct;
use App\Filament\Resources\SocialAccountProductResource\Pages\ListSocialAccountProducts;
use App\Filament\Resources\SocialAccountProductResource\Pages\CreateSocialAccountProduct;
use Awcodes\Curator\Components\Forms\CuratorPicker;
use Filament\Forms\Set;
use Illuminate\Support\Str;

// Sử dụng để tạo slug từ name
use Filament\Forms\Components\Card;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tab;

class SocialAccountProductResource extends Resource
{
    protected static ?string $model = SocialAccountProduct::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    // Thay đổi tên và icon
    protected static ?string $label = 'Sản phẩm tài khoản xã hội';
    protected static ?string $pluralLabel = 'Sản phẩm tài khoản xã hội';

    protected static ?string $navigationLabel = 'Sản phẩm tài khoản';
    protected static ?string $navigationGroup = 'Tài khoản';

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
                                        $existingSlug = \App\Models\SocialAccountProduct::where('slug', $slug)->exists();
                                        $counter = 1;
                                        $newSlug = $slug;

                                        // Nếu tồn tại slug, tiếp tục thêm hậu tố "-1", "-2",... cho đến khi tìm thấy slug chưa tồn tại
                                        while ($existingSlug) {
                                            $newSlug = $slug . '-' . $counter;
                                            $existingSlug = \App\Models\SocialAccountProduct::where('slug', $newSlug)->exists();
                                            $counter++;
                                        }

                                        // Đặt giá trị slug cuối cùng
                                        $set('slug', $newSlug);
                                    }),


                                TextInput::make('slug')
                                    ->label('Slug')
                                    ->unique(SocialAccountProduct::class, 'slug', ignoreRecord: true)
                                    ->required()
                                    ->disabled() // Người dùng không chỉnh sửa trực tiếp
                                    ->dehydrated(),

                                Select::make('category')
                                    ->label('Danh mục')
                                    ->relationship('category', 'name')
                                    ->placeholder('-- Chọn danh mục --')
                                    ->required(),
                                Select::make('country')
                                    ->label('Quốc gia')
                                    ->options([
                                        'af' => 'Afghanistan',
                                        'al' => 'Albania',
                                        'dz' => 'Algeria',
                                        'as' => 'American Samoa',
                                        'ad' => 'Andorra',
                                        'ao' => 'Angola',
                                        'ai' => 'Anguilla',
                                        'aq' => 'Antarctica',
                                        'ag' => 'Antigua and Barbuda',
                                        'ar' => 'Argentina',
                                        'am' => 'Armenia',
                                        'aw' => 'Aruba',
                                        'au' => 'Australia',
                                        'at' => 'Austria',
                                        'az' => 'Azerbaijan',
                                        'bs' => 'Bahamas',
                                        'bh' => 'Bahrain',
                                        'bd' => 'Bangladesh',
                                        'bb' => 'Barbados',
                                        'by' => 'Belarus',
                                        'be' => 'Belgium',
                                        'bz' => 'Belize',
                                        'bj' => 'Benin',
                                        'bm' => 'Bermuda',
                                        'bt' => 'Bhutan',
                                        'bo' => 'Bolivia',
                                        'bq' => 'Bonaire, Sint Eustatius and Saba',
                                        'ba' => 'Bosnia and Herzegovina',
                                        'bw' => 'Botswana',
                                        'bv' => 'Bouvet Island',
                                        'br' => 'Brazil',
                                        'io' => 'British Indian Ocean Territory',
                                        'bn' => 'Brunei Darussalam',
                                        'bg' => 'Bulgaria',
                                        'bf' => 'Burkina Faso',
                                        'bi' => 'Burundi',
                                        'cv' => 'Cabo Verde',
                                        'kh' => 'Cambodia',
                                        'cm' => 'Cameroon',
                                        'ca' => 'Canada',
                                        'ky' => 'Cayman Islands',
                                        'cf' => 'Central African Republic',
                                        'td' => 'Chad',
                                        'cl' => 'Chile',
                                        'cn' => 'China',
                                        'cx' => 'Christmas Island',
                                        'cc' => 'Cocos (Keeling) Islands',
                                        'co' => 'Colombia',
                                        'km' => 'Comoros',
                                        'cg' => 'Congo',
                                        'cd' => 'Congo, Democratic Republic of the',
                                        'ck' => 'Cook Islands',
                                        'cr' => 'Costa Rica',
                                        'hr' => 'Croatia',
                                        'cu' => 'Cuba',
                                        'cw' => 'Curaçao',
                                        'cy' => 'Cyprus',
                                        'cz' => 'Czech Republic',
                                        'dk' => 'Denmark',
                                        'dj' => 'Djibouti',
                                        'dm' => 'Dominica',
                                        'do' => 'Dominican Republic',
                                        'ec' => 'Ecuador',
                                        'eg' => 'Egypt',
                                        'sv' => 'El Salvador',
                                        'gq' => 'Equatorial Guinea',
                                        'er' => 'Eritrea',
                                        'ee' => 'Estonia',
                                        'sz' => 'Eswatini',
                                        'et' => 'Ethiopia',
                                        'fk' => 'Falkland Islands (Malvinas)',
                                        'fo' => 'Faroe Islands',
                                        'fj' => 'Fiji',
                                        'fi' => 'Finland',
                                        'fr' => 'France',
                                        'gf' => 'French Guiana',
                                        'pf' => 'French Polynesia',
                                        'tf' => 'French Southern Territories',
                                        'ga' => 'Gabon',
                                        'gm' => 'Gambia',
                                        'ge' => 'Georgia',
                                        'de' => 'Germany',
                                        'gh' => 'Ghana',
                                        'gi' => 'Gibraltar',
                                        'gr' => 'Greece',
                                        'gl' => 'Greenland',
                                        'gd' => 'Grenada',
                                        'gp' => 'Guadeloupe',
                                        'gu' => 'Guam',
                                        'gt' => 'Guatemala',
                                        'gg' => 'Guernsey',
                                        'gn' => 'Guinea',
                                        'gw' => 'Guinea-Bissau',
                                        'gy' => 'Guyana',
                                        'ht' => 'Haiti',
                                        'hm' => 'Heard Island and McDonald Islands',
                                        'hn' => 'Honduras',
                                        'hk' => 'Hong Kong',
                                        'hu' => 'Hungary',
                                        'is' => 'Iceland',
                                        'in' => 'India',
                                        'id' => 'Indonesia',
                                        'ir' => 'Iran',
                                        'iq' => 'Iraq',
                                        'ie' => 'Ireland',
                                        'im' => 'Isle of Man',
                                        'il' => 'Israel',
                                        'it' => 'Italy',
                                        'jm' => 'Jamaica',
                                        'jp' => 'Japan',
                                        'je' => 'Jersey',
                                        'jo' => 'Jordan',
                                        'kz' => 'Kazakhstan',
                                        'ke' => 'Kenya',
                                        'ki' => 'Kiribati',
                                        'kp' => 'Korea (North)',
                                        'kr' => 'Korea (South)',
                                        'kw' => 'Kuwait',
                                        'kg' => 'Kyrgyzstan',
                                        'la' => 'Lao People\'s Democratic Republic',
                                        'lv' => 'Latvia',
                                        'lb' => 'Lebanon',
                                        'ls' => 'Lesotho',
                                        'lr' => 'Liberia',
                                        'ly' => 'Libya',
                                        'li' => 'Liechtenstein',
                                        'lt' => 'Lithuania',
                                        'lu' => 'Luxembourg',
                                        'mo' => 'Macao',
                                        'mg' => 'Madagascar',
                                        'mw' => 'Malawi',
                                        'my' => 'Malaysia',
                                        'mv' => 'Maldives',
                                        'ml' => 'Mali',
                                        'mt' => 'Malta',
                                        'mh' => 'Marshall Islands',
                                        'mq' => 'Martinique',
                                        'mr' => 'Mauritania',
                                        'mu' => 'Mauritius',
                                        'yt' => 'Mayotte',
                                        'mx' => 'Mexico',
                                        'fm' => 'Micronesia',
                                        'md' => 'Moldova',
                                        'mc' => 'Monaco',
                                        'mn' => 'Mongolia',
                                        'me' => 'Montenegro',
                                        'ms' => 'Montserrat',
                                        'ma' => 'Morocco',
                                        'mz' => 'Mozambique',
                                        'mm' => 'Myanmar',
                                        'na' => 'Namibia',
                                        'nr' => 'Nauru',
                                        'np' => 'Nepal',
                                        'nl' => 'Netherlands',
                                        'nc' => 'New Caledonia',
                                        'nz' => 'New Zealand',
                                        'ni' => 'Nicaragua',
                                        'ne' => 'Niger',
                                        'ng' => 'Nigeria',
                                        'nu' => 'Niue',
                                        'nf' => 'Norfolk Island',
                                        'mp' => 'Northern Mariana Islands',
                                        'no' => 'Norway',
                                        'om' => 'Oman',
                                        'pk' => 'Pakistan',
                                        'pw' => 'Palau',
                                        'ps' => 'Palestine, State of',
                                        'pa' => 'Panama',
                                        'pg' => 'Papua New Guinea',
                                        'py' => 'Paraguay',
                                        'pe' => 'Peru',
                                        'ph' => 'Philippines',
                                        'pn' => 'Pitcairn',
                                        'pl' => 'Poland',
                                        'pt' => 'Portugal',
                                        'pr' => 'Puerto Rico',
                                        'qa' => 'Qatar',
                                        're' => 'Réunion',
                                        'ro' => 'Romania',
                                        'ru' => 'Russia',
                                        'rw' => 'Rwanda',
                                        'bl' => 'Saint Barthélemy',
                                        'sh' => 'Saint Helena, Ascension and Tristan da Cunha',
                                        'kn' => 'Saint Kitts and Nevis',
                                        'lc' => 'Saint Lucia',
                                        'mf' => 'Saint Martin (French part)',
                                        'sx' => 'Sint Maarten (Dutch part)',
                                        'sg' => 'Singapore',
                                        'sk' => 'Slovakia',
                                        'si' => 'Slovenia',
                                        'sb' => 'Solomon Islands',
                                        'so' => 'Somalia',
                                        'za' => 'South Africa',
                                        'gs' => 'South Georgia and the South Sandwich Islands',
                                        'ss' => 'South Sudan',
                                        'es' => 'Spain',
                                        'lk' => 'Sri Lanka',
                                        'sd' => 'Sudan',
                                        'sr' => 'Suriname',
                                        'sj' => 'Svalbard and Jan Mayen',
                                        'sz' => 'Swaziland',
                                        'se' => 'Sweden',
                                        'ch' => 'Switzerland',
                                        'sy' => 'Syrian Arab Republic',
                                        'tw' => 'Taiwan',
                                        'tj' => 'Tajikistan',
                                        'tz' => 'Tanzania',
                                        'th' => 'Thailand',
                                        'tl' => 'Timor-Leste',
                                        'tg' => 'Togo',
                                        'tk' => 'Tokelau',
                                        'to' => 'Tonga',
                                        'tt' => 'Trinidad and Tobago',
                                        'tn' => 'Tunisia',
                                        'tr' => 'Turkey',
                                        'tm' => 'Turkmenistan',
                                        'tc' => 'Turks and Caicos Islands',
                                        'tv' => 'Tuvalu',
                                        'ug' => 'Uganda',
                                        'ua' => 'Ukraine',
                                        'ae' => 'United Arab Emirates',
                                        'gb' => 'United Kingdom',
                                        'us' => 'United States',
                                        'uy' => 'Uruguay',
                                        'uz' => 'Uzbekistan',
                                        'vu' => 'Vanuatu',
                                        've' => 'Venezuela',
                                        'vn' => 'Việt Nam',
                                        'wf' => 'Wallis and Futuna',
                                        'eh' => 'Western Sahara',
                                        'ye' => 'Yemen',
                                        'zm' => 'Zambia',
                                        'zw' => 'Zimbabwe',
                                    ])
                                    ->required()
                                    //                                    ->searchable()
                                    ->placeholder('Chọn quốc gia')
                                    ->default('vn')
                                    ->nullable()
                            ]),

                        CuratorPicker::make('thumbnail')
                            ->label('Ảnh đại diện')
                            ->directory('Social')
                            ->nullable()
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

                                TextInput::make('sold')
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

                        RichEditor::make('short_content')
                            ->label('Mô tả ngắn gọn')
                            ->extraInputAttributes([ "style"=> "max-height: 400px; overflow: scroll"])

                            ->nullable(),

                        RichEditor::make('long_content')
                            ->label('Mô tả chi tiết')
                            ->extraInputAttributes([ "style"=> "max-height: 400px; overflow: scroll"])

                            ->nullable(),
                    ]),

                // Section for account data
                Section::make('Dữ liệu tài khoản')
                    ->schema([
                        TextInput::make('data_account')
                            ->label('Dữ liệu tài khoản')
                            ->nullable(),

                        // Select::make('social_account_id')
                        //     ->label('Tài khoản xã hội')
                        //     ->relationship('socialAccount', 'name')
                        //     ->required(),
                    ]),

                // Section for attributes
                Section::make('Thuộc tính sản phẩm')
                    ->schema([
                        Repeater::make('attributes')
                            ->relationship('attributes') // Liên kết với model SocialAccountProductAttribute
                            ->label('Thuộc tính sản phẩm')
                            ->schema([
                                TextInput::make('attribute_name')
                                    ->label('Tên thuộc tính')
                                    ->required(),

                                TextInput::make('additional_price')
                                    ->label('Giá bán')
                                    ->prefix('vnd')
                                    ->numeric()
                                    ->default(0),
                                TextInput::make('quantity')
                                    ->label('Tồn kho')
                                    ->numeric()
                                    ->default(0),
                                Select::make('status')
                                    ->label('Trạng thái')
                                    ->options([
                                        'inactive' => 'Ẩn',
                                        'active' => 'Hiện',
                                        // 'draft' => 'Bản nháp',
                                    ])
                                    ->default('inactive')
                                    ->required(),
                                Textarea::make('account_data')
                                    ->label('Account Data')
                                    ->placeholder('Enter account data as JSON')
                                    ->rows(5)
                                    ->required(),


                            ])
                            ->columns(2)
                            ->createItemButtonLabel('Thêm thuộc tính'),

                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('thumbnail')
                    ->label('Ảnh đại diện')
                    ->toggleable()
                    ->url(fn(SocialAccountProduct $record) => $record->getFirstMediaUrl('Social'))
                    ->openUrlInNewTab(),

                Tables\Columns\TextColumn::make('name')
                    ->label('Tên')
                    ->searchable()
                    ->sortable()
                    ->wrap(),

                // Tables\Columns\TextColumn::make('stock')
                //     ->label('Kho')
                //     ->toggleable()
                //     ->sortable(),

                // Tables\Columns\TextColumn::make('sold')
                //     ->label('Đã bán')
                //     ->toggleable()
                //     ->sortable(),

                // Tables\Columns\TextColumn::make('social_account.name')
                //     ->label('Tài khoản xã hội')
                //     ->toggleable()
                //     ->sortable(),

                Tables\Columns\BadgeColumn::make('category.name')
                    ->label('Danh mục')
                    ->sortable()
                    ->toggleable()
                    ->color('primary'),

                // Tables\Columns\TextColumn::make('status')
                //     ->label('Trạng thái')
                //     ->toggleable()
                //     ->sortable(),
            ])
            ->filters([
                //
            ])
            ->searchable() // Thêm dòng này để kích hoạt search bar
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
    public static function getGloballySearchableAttributes(): array
    {
        return ['name', 'slug',];
    }
    public static function getNavigationBadge(): ?string
    {
        return (string)SocialAccountProduct::count();
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
            'index' => Pages\ListSocialAccountProducts::route('/'),
            'create' => Pages\CreateSocialAccountProduct::route('/create'),
            'edit' => Pages\EditSocialAccountProduct::route('/{record}/edit'),
        ];
    }
}
