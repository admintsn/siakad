<?php

namespace App\Filament\Walisantri\Resources;

use App\Filament\Walisantri\Resources\DataSantriResource\Pages;
use App\Filament\Walisantri\Resources\DataSantriResource\RelationManagers;
use App\Models\DataSantri;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DataSantriResource extends Resource
{
    protected static ?string $model = DataSantri::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListDataSantris::route('/'),
            'create' => Pages\CreateDataSantri::route('/create'),
            'view' => Pages\ViewDataSantri::route('/{record}'),
            'edit' => Pages\EditDataSantri::route('/{record}/edit'),
        ];
    }
}
