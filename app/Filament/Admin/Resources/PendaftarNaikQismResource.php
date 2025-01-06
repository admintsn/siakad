<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\PendaftarNaikQismResource\Pages;
use App\Filament\Admin\Resources\PendaftarNaikQismResource\RelationManagers;
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
        return auth()->user()->mudirqism !== null;
    }

    protected static ?string $modelLabel = 'Pendaftar Naik Qism';

    protected static ?string $pluralModelLabel = 'Pendaftar Naik Qism';

    protected static ?string $navigationLabel = 'Pendaftar Naik Qism';

    protected static ?int $navigationSort = 200000000;

    // protected static ?string $navigationIcon = 'heroicon-o-Qisms';

    // protected static ?string $cluster = Kesantrian::class;

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
