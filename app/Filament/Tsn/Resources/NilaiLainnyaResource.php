<?php

namespace App\Filament\Tsn\Resources;

use App\Filament\Tsn\Resources\NilaiLainnyaResource\Pages;
use App\Filament\Tsn\Resources\NilaiLainnyaResource\RelationManagers;
use App\Models\Nilai;
use App\Models\NilaiLainnya;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class NilaiLainnyaResource extends Resource
{
    protected static ?string $model = Nilai::class;

    public static function canViewAny(): bool
    {

        if (auth()->user()->id === 1 || auth()->user()->id === 2) {
            return true;
        } else {

            $cek = Nilai::whereHas('pengajar', function ($query) {
                $query->where('user_id', Auth::user()->id);
            })
                ->where('jenis_soal_id', 2)->count();

            if ($cek !== 0) {

                return true;
            } else {

                return false;
            }
        }
    }

    protected static ?string $modelLabel = 'Nilai Lainnya';

    protected static ?string $pluralModelLabel = 'Nilai Lainnya';

    protected static ?string $navigationLabel = 'Nilai Lainnya';

    protected static ?int $navigationSort = 700000150;

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
            'index' => Pages\ListNilaiLainnyas::route('/'),
            'create' => Pages\CreateNilaiLainnya::route('/create'),
            'view' => Pages\ViewNilaiLainnya::route('/{record}'),
            'edit' => Pages\EditNilaiLainnya::route('/{record}/edit'),
        ];
    }
}
