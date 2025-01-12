<?php

namespace App\Filament\Tsn\Resources;

use App\Filament\Admin\Resources\PendaftarSantriBaruResource as ResourcesPendaftarSantriBaruResource;
use App\Filament\Tsn\Resources\PendaftarSantriBaruResource\Pages;
use App\Filament\Tsn\Resources\PendaftarSantriBaruResource\RelationManagers;
use App\Models\PendaftarSantriBaru;
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

    protected static ?int $navigationSort = 500000050;

    // protected static ?string $navigationIcon = 'heroicon-o-Qisms';

    // protected static ?string $cluster = ConfigLembaga::class;

    protected static ?string $navigationGroup = 'PSB';

    // protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    public static function form(Form $form): Form
    {
        return ResourcesPendaftarSantriBaruResource::form($form);
    }

    public static function table(Table $table): Table
    {
        return ResourcesPendaftarSantriBaruResource::table($table);
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

    public static function getEloquentQuery(): Builder
    {
        $tahunberjalanaktif = TahunBerjalan::where('is_active', 1)->first();
        $ts = TahunBerjalan::where('tb', $tahunberjalanaktif->ts)->first();

        return parent::getEloquentQuery()->whereIn('qism_id', Auth::user()->mudirqism)
            ->where('jenis_pendaftar_id', 1)
            ->where('tahun_berjalan_id', $ts->id);
    }
}
