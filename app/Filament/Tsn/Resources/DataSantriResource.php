<?php

namespace App\Filament\Tsn\Resources;

use App\Filament\Tsn\Resources\DataSantriResource\Pages;
use App\Filament\Tsn\Resources\DataSantriResource\RelationManagers;
use App\Models\DataSantri;
use App\Models\KelasSantri;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DataSantriResource extends Resource
{
    protected static ?string $model = KelasSantri::class;

    public static function canViewAny(): bool
    {
        return auth()->user()->id == 1;
    }

    protected static ?string $modelLabel = 'Data Santri';

    protected static ?string $pluralModelLabel = 'Data Santri';

    protected static ?string $navigationLabel = 'Data Santri';

    protected static ?int $navigationSort = 600000000;

    // protected static ?string $navigationIcon = 'heroicon-o-Qisms';

    // protected static ?string $cluster = ConfigLembaga::class;

    protected static ?string $navigationGroup = 'Data Santri';

    // protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

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
