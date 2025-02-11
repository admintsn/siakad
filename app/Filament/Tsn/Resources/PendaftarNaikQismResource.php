<?php

namespace App\Filament\Tsn\Resources;

use App\Filament\Admin\Resources\PendaftarNaikQismResource as ResourcesPendaftarNaikQismResource;
use App\Filament\Tsn\Resources\PendaftarNaikQismResource\Pages;
use App\Filament\Tsn\Resources\PendaftarNaikQismResource\RelationManagers;
use App\Models\PendaftarNaikQism;
use App\Models\Santri;
use App\Models\TahunBerjalan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class PendaftarNaikQismResource extends Resource
{
    protected static ?string $model = Santri::class;

    public static function canViewAny(): bool
    {
        return auth()->user()->mudirqism !== null;
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
        return ResourcesPendaftarNaikQismResource::form($form);
    }

    public static function table(Table $table): Table
    {
        return ResourcesPendaftarNaikQismResource::table($table);
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

    public static function getEloquentQuery(): Builder
    {
        $tahunberjalanaktif = TahunBerjalan::where('is_active', 1)->first();
        $ts = TahunBerjalan::where('tb', $tahunberjalanaktif->ts)->first();

        return parent::getEloquentQuery()->whereIn('qism_id', Auth::user()->mudirqism)
            ->where('jenis_pendaftar_id', 2)
            ->where('tahun_berjalan_id', $ts->id)
            ->where('daftarnaikqism', 'Mendaftar');
    }
}
