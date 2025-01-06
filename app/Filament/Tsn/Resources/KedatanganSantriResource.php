<?php

namespace App\Filament\Tsn\Resources;

use App\Filament\Tsn\Resources\KedatanganSantriResource\Pages;
use App\Filament\Tsn\Resources\KedatanganSantriResource\RelationManagers;
use App\Models\KedatanganSantri;
use App\Models\Walisantri;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class KedatanganSantriResource extends Resource
{
    protected static ?string $model = Walisantri::class;

    public static function canViewAny(): bool
    {
        return auth()->user()->id == 1;
    }

    protected static ?string $modelLabel = 'Kedatangan Santri';

    protected static ?string $pluralModelLabel = 'Kedatangan Santri';

    protected static ?string $navigationLabel = 'Kedatangan Santri';

    protected static ?int $navigationSort = 500000100;

    // protected static ?string $navigationIcon = 'heroicon-o-Qisms';

    // protected static ?string $cluster = ConfigLembaga::class;

    protected static ?string $navigationGroup = 'PSB';

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
            'index' => Pages\ListKedatanganSantris::route('/'),
            'create' => Pages\CreateKedatanganSantri::route('/create'),
            'view' => Pages\ViewKedatanganSantri::route('/{record}'),
            'edit' => Pages\EditKedatanganSantri::route('/{record}/edit'),
        ];
    }
}
