<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\StatusSantriResource\Pages;
use App\Filament\Admin\Resources\StatusSantriResource\RelationManagers;
use App\Models\StatusSantri;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StatusSantriResource extends Resource
{
    protected static ?string $model = StatusSantri::class;

    public static function canViewAny(): bool
    {
        return auth()->user()->id == 1;
    }

    protected static ?string $modelLabel = 'Status Santri';

    protected static ?string $pluralModelLabel = 'Status Santri';

    protected static ?string $navigationLabel = 'Status Santri';

    protected static ?int $navigationSort = 300000050;

    // protected static ?string $navigationIcon = 'heroicon-o-Qisms';

    // protected static ?string $cluster = Kesantrian::class;

    protected static ?string $navigationGroup = 'Data Santri';

    // protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('santri_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('status')
                    ->maxLength(255),
                Forms\Components\TextInput::make('ket_status')
                    ->maxLength(255),
                Forms\Components\TextInput::make('keterangan_status_santri_id')
                    ->numeric(),
                Forms\Components\TextInput::make('naikqism')
                    ->maxLength(50),
                Forms\Components\DatePicker::make('tanggalupdate'),
                Forms\Components\Toggle::make('is_active')
                    ->required(),
                Forms\Components\TextInput::make('created_by')
                    ->maxLength(255),
                Forms\Components\TextInput::make('updated_by')
                    ->maxLength(255),
                Forms\Components\TextInput::make('stat_santri_id')
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('santri.nama_lengkap')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('statSantri.stat_santri')
                    ->searchable(),
                Tables\Columns\TextColumn::make('kks.keterangan')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_by')
                    ->searchable(),
                Tables\Columns\TextColumn::make('updated_by')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([])
            ->actions([])
            ->bulkActions([]);
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
            'index' => Pages\ListStatusSantris::route('/'),
            'create' => Pages\CreateStatusSantri::route('/create'),
            'view' => Pages\ViewStatusSantri::route('/{record}'),
            'edit' => Pages\EditStatusSantri::route('/{record}/edit'),
        ];
    }
}
