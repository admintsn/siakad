<?php

namespace App\Filament\Tsn\Resources;

use App\Filament\Tsn\Resources\NilaiTulisLisanResource\Pages;
use App\Filament\Tsn\Resources\NilaiTulisLisanResource\RelationManagers;
use App\Models\Nilai;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class NilaiTulisLisanResource extends Resource
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
                ->where('jenis_soal_id', 4)->count();

            if ($cek !== 0) {

                return true;
            } else {

                return false;
            }
        }
    }

    protected static ?string $modelLabel = 'Nilai Tulis/Lisan';

    protected static ?string $pluralModelLabel = 'Nilai Tulis/Lisan';

    protected static ?string $navigationLabel = 'Nilai Tulis/Lisan';

    protected static ?int $navigationSort = 700000000;

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
            'index' => Pages\ListNilaiTulisLisans::route('/'),
            'create' => Pages\CreateNilaiTulisLisan::route('/create'),
            'view' => Pages\ViewNilaiTulisLisan::route('/{record}'),
            'edit' => Pages\EditNilaiTulisLisan::route('/{record}/edit'),
        ];
    }
}
