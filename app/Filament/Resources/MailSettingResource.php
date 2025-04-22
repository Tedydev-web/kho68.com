<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MailSettingResource\Pages;
use App\Filament\Resources\MailSettingResource\RelationManagers;
use App\Models\MailSetting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MailSettingResource extends Resource
{
    protected static ?string $model = MailSetting::class;

    protected static ?string $navigationIcon = 'heroicon-o-envelope';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('mailer')
                    ->default('smtp'),
                Forms\Components\TextInput::make('host')
                    ->default('smtp.gmail.com'),
                Forms\Components\TextInput::make('port')
                    ->integer()
                    ->default(587),
                Forms\Components\TextInput::make('username'),
                Forms\Components\TextInput::make('password')
                    ->password(),
                Forms\Components\TextInput::make('encryption')
                    ->default('tls'),
                Forms\Components\TextInput::make('from_address')
                    ->email(),
                Forms\Components\TextInput::make('from_name'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('mailer'),
                Tables\Columns\TextColumn::make('host'),
                Tables\Columns\TextColumn::make('port'),
                Tables\Columns\TextColumn::make('username'),
                Tables\Columns\TextColumn::make('encryption'),
                Tables\Columns\TextColumn::make('from_address'),
                Tables\Columns\TextColumn::make('from_name'),
            ])
            ->filters([
                //
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
            'index' => Pages\ListMailSettings::route('/'),
            'create' => Pages\CreateMailSetting::route('/create'),
            'edit' => Pages\EditMailSetting::route('/{record}/edit'),
        ];
    }
}
