<?php

namespace App\Filament\Admin\Resources\NomorSuratResource\RelationManagers;

use App\Filament\Admin\Resources\NomorSuratResource;
use App\Models\JenisSurat;
use App\Models\KelasSantri;
use App\Models\LembagaSurat;
use App\Models\NomorSurat;
use App\Models\Qism;
use App\Models\Santri;
use App\Models\TahunBerjalan;
use App\Models\Tahunhberjalan;
use App\Models\Tahunmberjalan;
use App\Models\TujuanSurat;
use App\Models\Walisantri;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Table;
use Guava\FilamentModalRelationManagers\Concerns\CanBeEmbeddedInModals;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Carbon;

class NomorSuratsRelationManager extends RelationManager
{
    protected static string $relationship = 'nomorSurats';

    use CanBeEmbeddedInModals;

    public function form(Form $form): Form
    {
        return ($form)
            ->schema([
                Section::make('Tanggal dan Nomor Urut')
                    ->schema([

                        Grid::make(4)
                            ->schema([

                                DatePicker::make('tanggal_surat')
                                    ->label('Tanggal')
                                    ->required()
                                    ->live()
                                    ->afterStateUpdated(function (Set $set, $state, $record, RelationManager $livewire) {

                                        $latest = NomorSurat::latest()->first();

                                        $inputm = Carbon::parse($state)->month;

                                        $thb = Tahunhberjalan::where('is_active', true)->first();
                                        $tmb = Tahunmberjalan::where('is_active', true)->first();

                                        $statusak = Walisantri::where('id', $livewire->getOwnerRecord()->walisantri_id)->first();

                                        $tahunberjalanaktif = TahunBerjalan::where('is_active', 1)->first();
                                        $ts = TahunBerjalan::where('tb', $tahunberjalanaktif->ts)->first();

                                        $qism = KelasSantri::where('santri_id', $livewire->getOwnerRecord()->id)
                                            ->where('tahun_berjalan_id', $tahunberjalanaktif->id)->first();

                                        // dd(Carbon::parse($state)->month, Carbon::parse($latest->tanggal_surat)->month);
                                        if ($latest == null) {
                                            $set('nomor', sprintf("%03d", 1));

                                            $set('lembaga_surat_id', 1);
                                            $set('qism_id', $qism->qism_id);

                                            $set('bulan_masehi', Carbon::parse($state)->month);
                                            $set('tahunhberjalan_id', $thb->id);
                                            $set('tahunmberjalan_id', $tmb->id);

                                            $set('tujuan_surat_id', 2);

                                            $set('santri_id', $livewire->getOwnerRecord()->id);

                                            $set('nama_manual', $livewire->getOwnerRecord()->nama_lengkap);
                                            $set('nik_manual', $livewire->getOwnerRecord()->nik);
                                            $set('tempat_lahir_manual', $livewire->getOwnerRecord()->tempat_lahir);
                                            $set('tanggal_lahir_manual', $livewire->getOwnerRecord()->tanggal_lahir);
                                            $set('nama_ayah_manual', $livewire->getOwnerRecord()->walisantri->ak_nama_lengkap);
                                            $set('nama_ibu_manual', $livewire->getOwnerRecord()->walisantri->ik_nama_lengkap);
                                            $set('is_active', 1);
                                            $set('source', 1);

                                            if ($statusak->ak_status_id == 1) {
                                                return ($set('alamat_surat', $statusak->al_ak_alamat . ' RT ' . $statusak->al_ak_rt . '/RW ' . $statusak->al_ak_rw . ' ' . $statusak->al_ak_kelurahan->kelurahan . ', ' . $statusak->al_ak_kecamatan->kecamatan . ', ' . $statusak->al_ak_kabupaten->kabupaten . ', ' . $statusak->al_ak_provinsi->provinsi . ' ' . $statusak->al_ak_kodepos));
                                            } elseif ($statusak->ak_status_id != 1) {
                                                return ($set('alamat_surat', $statusak->al_ik_alamat . ' RT ' . $statusak->al_ik_rt . '/RW ' . $statusak->al_ik_rw . ' ' . $statusak->al_ik_kelurahan->kelurahan . ', ' . $statusak->al_ik_kecamatan->kecamatan . ', ' . $statusak->al_ik_kabupaten->kabupaten . ', ' . $statusak->al_ik_provinsi->provinsi . ' ' . $statusak->al_ik_kodepos));
                                            }
                                        } else {

                                            $latestm = Carbon::parse($latest->tanggal_surat)->month;
                                            if ($inputm == $latestm) {

                                                $set('nomor', sprintf("%03d", $latest->nomor + 1));

                                                $set('lembaga_surat_id', 1);
                                                $set('qism_id', $qism->qism_id);

                                                $set('bulan_masehi', Carbon::parse($state)->month);
                                                $set('tahunhberjalan_id', $thb->id);
                                                $set('tahunmberjalan_id', $tmb->id);

                                                $set('tujuan_surat_id', 2);

                                                $set('santri_id', $livewire->getOwnerRecord()->id);

                                                $set('nama_manual', $livewire->getOwnerRecord()->nama_lengkap);
                                                $set('nik_manual', $livewire->getOwnerRecord()->nik);
                                                $set('tempat_lahir_manual', $livewire->getOwnerRecord()->tempat_lahir);
                                                $set('tanggal_lahir_manual', $livewire->getOwnerRecord()->tanggal_lahir);
                                                $set('nama_ayah_manual', $livewire->getOwnerRecord()->walisantri->ak_nama_lengkap);
                                                $set('nama_ibu_manual', $livewire->getOwnerRecord()->walisantri->ik_nama_lengkap);
                                                $set('is_active', 1);
                                                $set('source', 1);

                                                if ($statusak->ak_status_id == 1) {
                                                    return ($set('alamat_surat', $statusak->al_ak_alamat . ' RT ' . $statusak->al_ak_rt . '/RW ' . $statusak->al_ak_rw . ' ' . $statusak->al_ak_kelurahan->kelurahan . ', ' . $statusak->al_ak_kecamatan->kecamatan . ', ' . $statusak->al_ak_kabupaten->kabupaten . ', ' . $statusak->al_ak_provinsi->provinsi . ' ' . $statusak->al_ak_kodepos));
                                                } elseif ($statusak->ak_status_id != 1) {
                                                    return ($set('alamat_surat', $statusak->al_ik_alamat . ' RT ' . $statusak->al_ik_rt . '/RW ' . $statusak->al_ik_rw . ' ' . $statusak->al_ik_kelurahan->kelurahan . ', ' . $statusak->al_ik_kecamatan->kecamatan . ', ' . $statusak->al_ik_kabupaten->kabupaten . ', ' . $statusak->al_ik_provinsi->provinsi . ' ' . $statusak->al_ik_kodepos));
                                                }
                                            } elseif ($inputm <> $latestm) {

                                                $set('nomor', sprintf("%03d", 1));

                                                $set('lembaga_surat_id', 1);
                                                $set('qism_id', $qism->qism_id);

                                                $set('bulan_masehi', Carbon::parse($state)->month);
                                                $set('tahunhberjalan_id', $thb->id);
                                                $set('tahunmberjalan_id', $tmb->id);

                                                $set('tujuan_surat_id', 2);

                                                $set('santri_id', $livewire->getOwnerRecord()->id);

                                                $set('nama_manual', $livewire->getOwnerRecord()->nama_lengkap);
                                                $set('nik_manual', $livewire->getOwnerRecord()->nik);
                                                $set('tempat_lahir_manual', $livewire->getOwnerRecord()->tempat_lahir);
                                                $set('tanggal_lahir_manual', $livewire->getOwnerRecord()->tanggal_lahir);
                                                $set('nama_ayah_manual', $livewire->getOwnerRecord()->walisantri->ak_nama_lengkap);
                                                $set('nama_ibu_manual', $livewire->getOwnerRecord()->walisantri->ik_nama_lengkap);
                                                $set('is_active', 1);
                                                $set('source', 1);

                                                if ($statusak->ak_status_id == 1) {
                                                    return ($set('alamat_surat', $statusak->al_ak_alamat . ' RT ' . $statusak->al_ak_rt . '/RW ' . $statusak->al_ak_rw . ' ' . $statusak->al_ak_kelurahan->kelurahan . ', ' . $statusak->al_ak_kecamatan->kecamatan . ', ' . $statusak->al_ak_kabupaten->kabupaten . ', ' . $statusak->al_ak_provinsi->provinsi . ' ' . $statusak->al_ak_kodepos));
                                                } elseif ($statusak->ak_status_id != 1) {
                                                    return ($set('alamat_surat', $statusak->al_ik_alamat . ' RT ' . $statusak->al_ik_rt . '/RW ' . $statusak->al_ik_rw . ' ' . $statusak->al_ik_kelurahan->kelurahan . ', ' . $statusak->al_ik_kecamatan->kecamatan . ', ' . $statusak->al_ik_kabupaten->kabupaten . ', ' . $statusak->al_ik_provinsi->provinsi . ' ' . $statusak->al_ik_kodepos));
                                                }
                                            }
                                        }
                                    }),

                                TextInput::make('nomor')
                                    ->label('Nomor urut')
                                    ->required(),

                                Hidden::make('source'),

                            ]),

                        Grid::make(4)
                            ->schema([

                                Select::make('tahunhberjalan_id')
                                    ->label('Tahun Hijriah')
                                    ->options(Tahunhberjalan::whereIsActive(1)->pluck('tahunhberjalan', 'id'))
                                    ->required()
                                    ->disabled()
                                    ->dehydrated(),

                                TextInput::make('bulan_masehi')
                                    ->label('Bulan Masehi')
                                    ->required()
                                    ->disabled()
                                    ->dehydrated(),

                                Select::make('tahunmberjalan_id')
                                    ->label('Tahun Masehi')
                                    ->options(Tahunmberjalan::whereIsActive(1)->pluck('tahunmberjalan', 'id'))
                                    ->required()
                                    ->disabled()
                                    ->dehydrated(),

                            ]),

                        Grid::make(4)
                            ->schema([

                                Select::make('tujuan_surat_id')
                                    ->label('Tujuan Surat')
                                    ->options(TujuanSurat::whereIsActive(1)->pluck('tujuan_surat', 'id'))
                                    ->required(),

                                Select::make('jenis_surat_id')
                                    ->label('Jenis Surat')
                                    ->live()
                                    ->options(JenisSurat::whereIsActive(1)->pluck('jenis_surat', 'id'))
                                    ->afterStateUpdated(function (Get $get, Set $set, $state) {

                                        $tahun = Carbon::parse($get('tanggal_surat'))->year;
                                        $bulan = Carbon::parse($get('tanggal_surat'))->month;
                                        $tanggal = Carbon::parse($get('tanggal_surat'))->day;
                                        $nomor = $get('nomor');
                                        $lembaga = LembagaSurat::whereId($get('lembaga_surat_id'))->first();
                                        $qism = Qism::whereId($get('qism_id'))->first();
                                        $jenis = JenisSurat::whereId($get('jenis_surat_id'))->first();
                                        $tahunh = Tahunhberjalan::whereId($get('tahunhberjalan_id'))->first();
                                        $tahunm = Tahunmberjalan::whereId($get('tahunmberjalan_id'))->first();

                                        $set('nomor_surat', $nomor . '/' . $lembaga->lembaga_surat . '.' . $qism->kode_surat . '/' . $jenis->kode . '/' . $tahunh->tahunhberjalan . '/' . $bulan . '/' . $tahunm->tahunmberjalan);
                                        $set('perihal_surat', $jenis->jenis_surat);
                                        $set('nama_file', $tahun . '.' . sprintf("%02d", $bulan) . '.' . sprintf("%02d", $tanggal) . ' ' . $lembaga->lembaga_surat . '-' . $qism->abbr_qism . ' ' . $jenis->jenis_surat . ' ' . $get('nama_manual'));
                                    })
                                    ->required(),
                            ]),

                    ])
                    ->compact(),

                Section::make('Rincian Surat')
                    ->schema([

                        Grid::make(4)
                            ->schema([

                                Select::make('lembaga_surat_id')
                                    ->label('Lembaga')
                                    ->default(1)
                                    ->options(LembagaSurat::whereIsActive(1)->pluck('lembaga_surat', 'id'))
                                    ->required(),

                                Select::make('qism_id')
                                    ->label('Qism')
                                    ->options(Qism::all()->pluck('abbr_qism', 'id'))
                                    ->required(),

                            ]),

                        Grid::make(4)
                            ->schema([

                                Select::make('santri_id')
                                    ->label('Santri')
                                    ->options(Santri::all()->pluck('nama_lengkap', 'id')),

                            ]),

                        Grid::make(4)
                            ->schema([

                                TextInput::make('nama_manual')
                                    ->label('Nama'),

                                TextInput::make('nik_manual')
                                    ->label('NIK'),

                            ]),

                        Grid::make(4)
                            ->schema([

                                TextInput::make('tempat_lahir_manual')
                                    ->label('Tempat Lahir'),


                                TextInput::make('tanggal_lahir_manual')
                                    ->label('Tanggal Lahir'),

                            ]),

                        Grid::make(4)
                            ->schema([

                                TextInput::make('nama_ayah_manual')
                                    ->label('Nama Ayah'),

                                TextInput::make('nama_ibu_manual')
                                    ->label('Nama Ibu'),

                            ]),

                        Grid::make()
                            ->schema([

                                Textarea::make('alamat_surat')
                                    ->label('Alamat Surat')
                                    // ->required()
                                    // ->disabled()
                                    ->dehydrated(),

                            ]),

                    ])->compact(),

                Section::make('Nomor Surat dan Perihal')
                    ->schema([

                        Grid::make(4)
                            ->schema([

                                TextInput::make('nomor_surat')
                                    ->label('Nomor Surat')
                                    ->required(),

                            ]),

                        Grid::make(2)
                            ->schema([

                                TextInput::make('perihal_surat')
                                    ->label('Perihal Surat')
                                    ->required(),

                            ]),

                        Grid::make(2)
                            ->schema([

                                TextInput::make('nama_file')
                                    ->label('Nama File')
                                    ->required(),

                            ]),

                    ])->compact(),

                Section::make('Status')
                    ->schema([

                        Grid::make(2)
                            ->schema([

                                ToggleButtons::make('is_active')
                                    ->label('Active?')
                                    ->boolean()
                                    ->grouped()
                                    ->default(1),

                            ]),
                    ])->collapsible()
                    ->compact(),
            ]);
    }

    public function table(Table $table): Table
    {
        return NomorSuratResource::table($table)
            ->recordTitleAttribute('nomor_surat')
            // ->inverseRelationship('qismDetails')
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label('New Nomor Surat')
                    ->modalCloseButton(false)
                    ->modalHeading(' ')
                    ->modalWidth('full')
                    ->button()
                    ->closeModalByClickingAway(false),
            ])
            ->actions([
                ActionGroup::make([
                    Tables\Actions\EditAction::make()
                        ->label('Edit')
                        ->modalCloseButton(false)
                        ->modalHeading(' ')
                        ->modalWidth('full')
                        ->closeModalByClickingAway(false),
                    Tables\Actions\DeleteAction::make(),
                ])
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
