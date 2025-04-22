<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DownloadHistoryResource\Pages;
use App\Filament\Resources\DownloadHistoryResource\RelationManagers;
use App\Models\DownloadHistory;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DownloadHistoryResource extends Resource
{
    protected static ?string $model = DownloadHistory::class;
    protected static ?string $navigationLabel = 'Danh sách tải xuống';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Quản lý tải xuống';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\Select::make('user_id')
            ->label('User')
            ->options(User::whereNotNull('name')->pluck('name', 'id')) // Ensure only valid names are included
            ->required(),
            Forms\Components\TextInput::make('file_id')
                ->label('File ID')
                ->required(),

            Forms\Components\TextInput::make('ip_address')
                ->label('IP Address')
                ->nullable(),

            Forms\Components\DateTimePicker::make('downloaded_at')
                ->label('Downloaded At')
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            Tables\Columns\TextColumn::make('user.name')->label('User'),
            Tables\Columns\TextColumn::make('file_id')->label('File ID'),
            Tables\Columns\TextColumn::make('ip_address')->label('IP Address'),
            Tables\Columns\TextColumn::make('downloaded_at')->label('Downloaded At')->dateTime(),
        ])

            ->filters([
                //
            ])
            ->actions([
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
            'index' => Pages\ListDownloadHistories::route('/'),
            'create' => Pages\CreateDownloadHistory::route('/create'),
            'edit' => Pages\EditDownloadHistory::route('/{record}/edit'),
        ];
    }
}
