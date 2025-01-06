<?php

namespace App\Filament\Tsn\Resources;

use App\Filament\Tsn\Resources\SemuaNilaiResource\Pages;
use App\Filament\Tsn\Resources\SemuaNilaiResource\RelationManagers;
use App\Models\Nilai;
use App\Models\SemuaNilai;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SemuaNilaiResource extends Resource
{
    protected static ?string $model = Nilai::class;

    public static function canViewAny(): bool
    {
        return auth()->user()->id == 1;
    }

    protected static ?string $modelLabel = 'Semua Nilai';

    protected static ?string $pluralModelLabel = 'Semua Nilai';

    protected static ?string $navigationLabel = 'Semua Nilai';

    protected static ?int $navigationSort = 800000000;

    // protected static ?string $navigationIcon = 'heroicon-o-Qisms';

    // protected static ?string $cluster = ConfigLembaga::class;

    protected static ?string $navigationGroup = 'Menu Mudir';

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
            'index' => Pages\ListSemuaNilais::route('/'),
            'create' => Pages\CreateSemuaNilai::route('/create'),
            'view' => Pages\ViewSemuaNilai::route('/{record}'),
            'edit' => Pages\EditSemuaNilai::route('/{record}/edit'),
        ];
    }
}
