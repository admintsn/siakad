<?php

namespace App\Filament\Tsn\Resources;

use App\Filament\Tsn\Resources\NilaiHafalanResource\Pages;
use App\Filament\Tsn\Resources\NilaiHafalanResource\RelationManagers;
use App\Models\Nilai;
use App\Models\NilaiHafalan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class NilaiHafalanResource extends Resource
{
    protected static ?string $model = Nilai::class;

    public static function canViewAny(): bool
    {
        return auth()->user()->id == 1;
    }

    protected static ?string $modelLabel = 'Nilai Hafalan';

    protected static ?string $pluralModelLabel = 'Nilai Hafalan';

    protected static ?string $navigationLabel = 'Nilai Hafalan';

    protected static ?int $navigationSort = 700000050;

    // protected static ?string $navigationIcon = 'heroicon-o-Qisms';

    // protected static ?string $cluster = ConfigLembaga::class;

    protected static ?string $navigationGroup = 'Nilai Imtihan';

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
            'index' => Pages\ListNilaiHafalans::route('/'),
            'create' => Pages\CreateNilaiHafalan::route('/create'),
            'view' => Pages\ViewNilaiHafalan::route('/{record}'),
            'edit' => Pages\EditNilaiHafalan::route('/{record}/edit'),
        ];
    }
}
