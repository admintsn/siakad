<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\CekKkResource\Pages;
use App\Filament\Admin\Resources\CekKkResource\RelationManagers;
use App\Models\CekKk;
use App\Models\Santri;
use App\Models\User;
use App\Models\Walisantri;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\TextInputColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Collection;

class CekKkResource extends Resource
{
    protected static ?string $model = Santri::class;

    public static function canViewAny(): bool
    {
        return auth()->user()->id == 1;
    }

    protected static ?string $modelLabel = 'Cek Kartu Keluarga';

    protected static ?string $pluralModelLabel = 'Cek Kartu Keluarga';

    protected static ?string $navigationLabel = 'Cek Kartu Keluarga';

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

                TextInputColumn::make('walisantri.user.name')
                    ->label('users.name')
                    ->searchable(isIndividual: true, isGlobal: false)
                    ->sortable(),

                TextInputColumn::make('walisantri.user.username')
                    ->label('users.username')
                    ->searchable(isIndividual: true, isGlobal: false)
                    ->sortable(),

                TextInputColumn::make('walisantri.kartu_keluarga_santri')
                    ->label('walisantris.kartu_keluarga_santri')
                    ->searchable(isIndividual: true, isGlobal: false)
                    ->sortable(),

                TextInputColumn::make('walisantri.nama_kpl_kel_santri')
                    ->label('walisantris.nama_kpl_kel_santri')
                    ->searchable(isIndividual: true, isGlobal: false)
                    ->sortable(),

                TextInputColumn::make('nama_lengkap')
                    ->label('santris.nama_lengkap')
                    ->searchable(isIndividual: true, isGlobal: false)
                    ->sortable(),

                TextInputColumn::make('nik')
                    ->label('santris.nik')
                    ->searchable(isIndividual: true, isGlobal: false)
                    ->sortable(),

                TextInputColumn::make('kartu_keluarga')
                    ->label('santris.kartu_keluarga')
                    ->searchable(isIndividual: true, isGlobal: false)
                    ->sortable(),

                TextInputColumn::make('nama_kpl_kel')
                    ->label('santris.nama_kpl_kel')
                    ->searchable(isIndividual: true, isGlobal: false)
                    ->sortable(),

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
            'index' => Pages\ListCekKks::route('/'),
            'create' => Pages\CreateCekKk::route('/create'),
            'edit' => Pages\EditCekKk::route('/{record}/edit'),
        ];
    }
}
