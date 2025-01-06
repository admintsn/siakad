<?php

namespace App\Filament\Tsn\Resources;

use App\Filament\Tsn\Resources\PendaftarNaikQismResource\Pages;
use App\Filament\Tsn\Resources\PendaftarNaikQismResource\RelationManagers;
use App\Models\PendaftarNaikQism;
use App\Models\Santri;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PendaftarNaikQismResource extends Resource
{
    protected static ?string $model = Santri::class;

    public static function canViewAny(): bool
    {
        return auth()->user()->id == 1;
    }

    protected static ?string $modelLabel = 'Pendaftar Santri Lama';

    protected static ?string $pluralModelLabel = 'Pendaftar Santri Lama';

    protected static ?string $navigationLabel = 'Pendaftar Santri Lama';

    protected static ?int $navigationSort = 500000000;

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
            'index' => Pages\ListPendaftarNaikQisms::route('/'),
            'create' => Pages\CreatePendaftarNaikQism::route('/create'),
            'view' => Pages\ViewPendaftarNaikQism::route('/{record}'),
            'edit' => Pages\EditPendaftarNaikQism::route('/{record}/edit'),
        ];
    }
}
