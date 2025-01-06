<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\PendaftarSantriBaruResource\Pages;
use App\Filament\Admin\Resources\PendaftarSantriBaruResource\RelationManagers;
use App\Models\PendaftarSantriBaru;
use App\Models\Santri;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PendaftarSantriBaruResource extends Resource
{
    protected static ?string $model = Santri::class;

    public static function canViewAny(): bool
    {
        return auth()->user()->mudirqism !== null;
    }

    protected static ?string $modelLabel = 'Pendaftar Santri Baru';

    protected static ?string $pluralModelLabel = 'Pendaftar Santri Baru';

    protected static ?string $navigationLabel = 'Pendaftar Santri Baru';

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
            'index' => Pages\ListPendaftarSantriBarus::route('/'),
            'create' => Pages\CreatePendaftarSantriBaru::route('/create'),
            'view' => Pages\ViewPendaftarSantriBaru::route('/{record}'),
            'edit' => Pages\EditPendaftarSantriBaru::route('/{record}/edit'),
        ];
    }
}
