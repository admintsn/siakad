<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\DataKeringananResource\Pages;
use App\Filament\Admin\Resources\DataKeringananResource\RelationManagers;
use App\Models\DataKeringanan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DataKeringananResource extends Resource
{
    protected static ?string $model = DataKeringanan::class;

    public static function canViewAny(): bool
    {
        return auth()->user()->id == 1;
    }

    protected static ?string $modelLabel = 'Update Santri Naik Qism';

    protected static ?string $pluralModelLabel = 'Update Santri Naik Qism';

    protected static ?string $navigationLabel = 'Update Santri Naik Qism';

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
            'index' => Pages\ListDataKeringanans::route('/'),
            'create' => Pages\CreateDataKeringanan::route('/create'),
            'view' => Pages\ViewDataKeringanan::route('/{record}'),
            'edit' => Pages\EditDataKeringanan::route('/{record}/edit'),
        ];
    }
}
