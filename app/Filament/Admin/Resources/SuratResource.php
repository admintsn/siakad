<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\NomorSuratResource\RelationManagers\NomorSuratsRelationManager;
use App\Filament\Admin\Resources\SuratResource\Pages;
use App\Filament\Admin\Resources\SuratResource\RelationManagers;
use App\Filament\Exports\NomorSuratExporter;
use App\Filament\Imports\NomorSuratImporter;
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
use Carbon\Carbon;
use Carbon\Month;
use Filament\Actions\StaticAction;
use Filament\Forms;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Pages\SubNavigationPosition;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\ExportBulkAction;
use Filament\Tables\Actions\ImportAction;
use Filament\Tables\Columns\CheckboxColumn;
use Filament\Tables\Columns\ColumnGroup;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\QueryBuilder;
use Filament\Tables\Filters\QueryBuilder\Constraints\BooleanConstraint;
use Filament\Tables\Filters\QueryBuilder\Constraints\DateConstraint;
use Filament\Tables\Filters\QueryBuilder\Constraints\SelectConstraint;
use Filament\Tables\Filters\QueryBuilder\Constraints\TextConstraint;
use Filament\Tables\Table;
use Guava\FilamentModalRelationManagers\Actions\Table\RelationManagerAction;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Date;

class SuratResource extends Resource
{
    protected static ?string $model = Santri::class;

    public static function canViewAny(): bool
    {
        return auth()->user()->mudirqism !== null;
    }

    protected static ?string $modelLabel = 'Nomor Surat';

    protected static ?string $pluralModelLabel = 'Nomor Surat';

    protected static ?string $navigationLabel = 'Nomor Surat';

    protected static ?int $navigationSort = 600000000;

    // protected static ?string $navigationIcon = 'heroicon-o-Qisms';

    // protected static ?string $cluster = ConfigLembaga::class;

    protected static ?string $navigationGroup = 'Nomor Surat';

    // protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    public static function form(Form $form): Form
    {
        return $form

            ->schema(static::NomorSuratFormSchema());
    }

    public static function NomorSuratFormSchema(): array
    {
        return [

            Section::make('Tanggal dan Nomor Urut')
                ->schema([

                    Grid::make(4)
                        ->schema([

                            DatePicker::make('tanggal_surat')
                                ->label('Tanggal')
                                ->required()
                                ->live()
                                ->afterStateUpdated(function (Set $set, $state, $record) {

                                    $latest = NomorSurat::latest()->first();

                                    $inputm = Carbon::parse($state)->month;

                                    $thb = Tahunhberjalan::where('is_active', true)->first();
                                    $tmb = Tahunmberjalan::where('is_active', true)->first();

                                    $statusak = Walisantri::where('id', $record->walisantri_id)->first();

                                    $tahunberjalanaktif = TahunBerjalan::where('is_active', 1)->first();
                                    $ts = TahunBerjalan::where('tb', $tahunberjalanaktif->ts)->first();

                                    $qism = KelasSantri::where('santri_id', $record->id)
                                        ->where('tahun_berjalan_id', $tahunberjalanaktif->id)->first();

                                    // dd(Carbon::parse($state)->month, Carbon::parse($latest->tanggal_surat)->month);
                                    if ($latest == null) {
                                        $set('nomor', sprintf("%03d", 1));

                                        $set('lembaga_surat_id', 1);
                                        $set('qism_id', $qism->qism_id);

                                        $set('bulan_masehi', Carbon::parse($state)->month);
                                        $set('tahunhberjalan_id', $thb->id);
                                        $set('tahunmberjalan_id', $tmb->id);

                                        $set('santri_id', $record->id);

                                        $set('nama_manual', $record->nama_lengkap);
                                        $set('nik_manual', $record->nik);
                                        $set('tempat_lahir_manual', $record->tempat_lahir);
                                        $set('tanggal_lahir_manual', $record->tanggal_lahir);
                                        $set('nama_ayah_manual', $record->walisantri->ak_nama_lengkap);
                                        $set('nama_ibu_manual', $record->walisantri->ik_nama_lengkap);
                                        $set('is_active', 1);

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

                                            $set('santri_id', $record->id);

                                            $set('nama_manual', $record->nama_lengkap);
                                            $set('nik_manual', $record->nik);
                                            $set('tempat_lahir_manual', $record->tempat_lahir);
                                            $set('tanggal_lahir_manual', $record->tanggal_lahir);
                                            $set('nama_ayah_manual', $record->walisantri->ak_nama_lengkap);
                                            $set('nama_ibu_manual', $record->walisantri->ik_nama_lengkap);
                                            $set('is_active', 1);

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

                                            $set('santri_id', $record->id);

                                            $set('nama_manual', $record->nama_lengkap);
                                            $set('nik_manual', $record->nik);
                                            $set('tempat_lahir_manual', $record->tempat_lahir);
                                            $set('tanggal_lahir_manual', $record->tanggal_lahir);
                                            $set('nama_ayah_manual', $record->walisantri->ak_nama_lengkap);
                                            $set('nama_ibu_manual', $record->walisantri->ik_nama_lengkap);
                                            $set('is_active', 1);

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
                                    $set('nama_file', $tahun . '.' . $bulan . '.' . $tanggal . ' ' . $lembaga->lembaga_surat . '-' . $qism->abbr_qism . ' ' . $jenis->jenis_surat . ' ' . $get('nama_manual'));
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

                            TextInput::make('tempat_lahir')
                                ->label('Tempat Lahir'),


                            TextInput::make('tanggal_lahir')
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

        ];
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                ColumnGroup::make('Santri', [

                    TextColumn::make('kelasSantris.qism_detail.abbr_qism_detail')
                        ->label('Qism')
                        ->searchable(isIndividual: true, isGlobal: false)
                        ->listWithLineBreaks()
                        ->sortable(),

                    TextColumn::make('kelasSantris.kelas.kelas')
                        ->label('Kelas')
                        ->searchable(isIndividual: true, isGlobal: false)
                        ->listWithLineBreaks()
                        ->sortable(),

                    TextColumn::make('nama_lengkap')
                        ->label('Nama')
                        ->searchable(isIndividual: true, isGlobal: false)
                        ->sortable()
                        ->copyable()
                        ->copyableState(function (Model $record, $state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->copyMessageDuration(1500),

                    TextColumn::make('nism')
                        ->label('NISM')
                        ->searchable(isIndividual: true, isGlobal: false)
                        ->sortable()
                        ->copyable()
                        ->copyableState(function (Model $record, $state) {
                            return ('510035210133' . $state);
                        })
                        ->copyMessage('Tersalin')
                        ->copyMessageDuration(1500),

                    TextColumn::make('nik')
                        ->label('NIK')
                        ->searchable(isIndividual: true, isGlobal: false)
                        // ->toggleable(isToggledHiddenByDefault: true)
                        // ->toggleable()
                        ->sortable()
                        ->copyable()
                        ->copyableState(function (Model $record, $state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->copyMessageDuration(1500),

                    TextColumn::make('tempat_lahir')
                        ->label('Tempat Lahir')
                        ->searchable(isIndividual: true, isGlobal: false)
                        // ->toggleable(isToggledHiddenByDefault: true)
                        // ->toggleable()
                        ->sortable()
                        ->copyable()
                        ->copyableState(function (Model $record, $state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->copyMessageDuration(1500),

                    TextColumn::make('tanggal_lahir')
                        ->label('Tanggal Lahir')
                        // ->date()
                        ->searchable(isIndividual: true, isGlobal: false)
                        // ->toggleable(isToggledHiddenByDefault: true)
                        // ->toggleable()
                        ->sortable()
                        ->copyable()
                        ->copyableState(function (Model $record, $state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->copyMessageDuration(1500),

                    TextColumn::make('jeniskelamin.jeniskelamin')
                        ->label('Jenis Kelamin')
                        ->searchable(isIndividual: true, isGlobal: false)
                        // ->toggleable(isToggledHiddenByDefault: true)
                        // ->toggleable()
                        ->sortable()
                        ->copyable()
                        ->copyableState(function (Model $record, $state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->copyMessageDuration(1500),

                    TextColumn::make('kartu_keluarga')
                        ->label('Kartu Keluarga')
                        ->searchable(isIndividual: true, isGlobal: false)
                        // ->toggleable(isToggledHiddenByDefault: true)
                        // ->toggleable()
                        ->sortable()
                        ->copyable()
                        ->copyableState(function (Model $record, $state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->copyMessageDuration(1500),

                    TextColumn::make('walisantri.ak_nama_lengkap')
                        ->label('Nama Ayah Kandung')
                        ->searchable(isIndividual: true, isGlobal: false)
                        // ->toggleable(isToggledHiddenByDefault: true)
                        // ->toggleable()
                        ->sortable()
                        ->copyable()
                        ->copyableState(function (Model $record, $state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->copyMessageDuration(1500),

                    TextColumn::make('walisantri.ak_nik')
                        ->label('NIK Ayah Kandung')
                        ->searchable(isIndividual: true, isGlobal: false)
                        // ->toggleable(isToggledHiddenByDefault: true)
                        // ->toggleable()
                        ->sortable()
                        ->copyable()
                        ->copyableState(function (Model $record, $state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->copyMessageDuration(1500),

                    TextColumn::make('walisantri.ak_nomor_handphone')
                        ->label('Handphone Ayah Kandung')
                        ->searchable(isIndividual: true, isGlobal: false)
                        // ->toggleable(isToggledHiddenByDefault: true)
                        // ->toggleable()
                        ->sortable()
                        ->copyable()
                        ->copyableState(function (Model $record, $state) {
                            return ('62' . $state);
                        })
                        ->copyMessage('Tersalin')
                        ->copyMessageDuration(1500),

                    TextColumn::make('walisantri.ik_nama_lengkap')
                        ->label('Nama Ibu Kandung')
                        ->searchable(isIndividual: true, isGlobal: false)
                        // ->toggleable(isToggledHiddenByDefault: true)
                        // ->toggleable()
                        ->sortable()
                        ->copyable()
                        ->copyableState(function (Model $record, $state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->copyMessageDuration(1500),

                    TextColumn::make('walisantri.ik_nik')
                        ->label('NIK Ibu Kandung')
                        ->searchable(isIndividual: true, isGlobal: false)
                        // ->toggleable(isToggledHiddenByDefault: true)
                        // ->toggleable()
                        ->sortable()
                        ->copyable()
                        ->copyableState(function (Model $record, $state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->copyMessageDuration(1500),

                    TextColumn::make('walisantri.ik_nomor_handphone')
                        ->label('Handphone Ibu Kandung')
                        ->searchable(isIndividual: true, isGlobal: false)
                        // ->toggleable(isToggledHiddenByDefault: true)
                        // ->toggleable()
                        ->sortable()
                        ->copyable()
                        ->copyableState(function (Model $record, $state) {
                            return ('62' . $state);
                        })
                        ->copyMessage('Tersalin')
                        ->copyMessageDuration(1500),

                    TextColumn::make('walisantri.w_hubungan.hubungan_wali')
                        ->label('Hubungan Wali')
                        ->searchable(isIndividual: true, isGlobal: false)
                        // ->toggleable(isToggledHiddenByDefault: true)
                        // ->toggleable()
                        ->sortable()
                        ->copyable()
                        ->copyableState(function (Model $record, $state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->copyMessageDuration(1500),

                    TextColumn::make('walisantri.w_nama_lengkap')
                        ->label('Nama Wali')
                        ->searchable(isIndividual: true, isGlobal: false)
                        // ->toggleable(isToggledHiddenByDefault: true)
                        // ->toggleable()
                        ->sortable()
                        ->copyable()
                        ->copyableState(function (Model $record, $state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->copyMessageDuration(1500),

                    TextColumn::make('walisantri.w_nik')
                        ->label('NIK Wali')
                        ->searchable(isIndividual: true, isGlobal: false)
                        // ->toggleable(isToggledHiddenByDefault: true)
                        // ->toggleable()
                        ->sortable()
                        ->copyable()
                        ->copyableState(function (Model $record, $state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->copyMessageDuration(1500),

                    TextColumn::make('walisantri.w_nomor_handphone')
                        ->label('Handphone Wali')
                        ->searchable(isIndividual: true, isGlobal: false)
                        // ->toggleable(isToggledHiddenByDefault: true)
                        // ->toggleable()
                        ->sortable()
                        ->copyable()
                        ->copyableState(function (Model $record, $state) {
                            return ('62' . $state);
                        })
                        ->copyMessage('Tersalin')
                        ->copyMessageDuration(1500),

                    TextColumn::make('alamatsurat')
                        ->label('Alamat Surat')
                        ->default('Belum Lengkap')
                        ->searchable(isIndividual: true, isGlobal: false)
                        // ->toggleable(isToggledHiddenByDefault: true)
                        ->formatStateUsing(function (Model $record) {
                            $statusak = Walisantri::where('id', $record->walisantri_id)->first();

                            if ($statusak->ak_status_id == 1) {
                                return ($statusak->al_ak_alamat . ' RT ' . $statusak->al_ak_rt . '/RW ' . $statusak->al_ak_rw . ' ' . $statusak->al_ak_kelurahan->kelurahan . ', ' . $statusak->al_ak_kecamatan->kecamatan . ', ' . $statusak->al_ak_kabupaten->kabupaten . ', ' . $statusak->al_ak_provinsi->provinsi . ' ' . $statusak->al_ak_kodepos);
                            } elseif ($statusak->ak_status_id != 1) {
                                return ($statusak->al_ik_alamat . ' RT ' . $statusak->al_ik_rt . '/RW ' . $statusak->al_ik_rw . ' ' . $statusak->al_ik_kelurahan->kelurahan . ', ' . $statusak->al_ik_kecamatan->kecamatan . ', ' . $statusak->al_ik_kabupaten->kabupaten . ', ' . $statusak->al_ik_provinsi->provinsi . ' ' . $statusak->al_ik_kodepos);
                            }
                        })
                        ->copyable()
                        ->copyableState(function ($state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->copyMessageDuration(1500),

                    TextColumn::make('walisantri.al_ak_provinsi.provinsi')
                        ->label('Provinsi')
                        ->searchable(isIndividual: true, isGlobal: false)
                        // ->toggleable(isToggledHiddenByDefault: true)
                        // ->toggleable()
                        ->sortable()
                        ->copyable()
                        ->copyableState(function (Model $record, $state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->copyMessageDuration(1500),

                    TextColumn::make('walisantri.al_ak_kabupaten.kabupaten')
                        ->label('Kabupaten')
                        ->searchable(isIndividual: true, isGlobal: false)
                        // ->toggleable(isToggledHiddenByDefault: true)
                        // ->toggleable()
                        ->sortable()
                        ->copyable()
                        ->copyableState(function (Model $record, $state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->copyMessageDuration(1500),

                    TextColumn::make('walisantri.al_ak_kecamatan.kecamatan')
                        ->label('Kecamatan')
                        ->searchable(isIndividual: true, isGlobal: false)
                        // ->toggleable(isToggledHiddenByDefault: true)
                        // ->toggleable()
                        ->sortable()
                        ->copyable()
                        ->copyableState(function (Model $record, $state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->copyMessageDuration(1500),

                    TextColumn::make('walisantri.al_ak_kelurahan.kelurahan')
                        ->label('Kelurahan')
                        ->searchable(isIndividual: true, isGlobal: false)
                        // ->toggleable(isToggledHiddenByDefault: true)
                        // ->toggleable()
                        ->sortable()
                        ->copyable()
                        ->copyableState(function (Model $record, $state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->copyMessageDuration(1500),

                    TextColumn::make('walisantri.al_ak_rt')
                        ->label('RT')
                        ->searchable(isIndividual: true, isGlobal: false)
                        // ->toggleable(isToggledHiddenByDefault: true)
                        // ->toggleable()
                        ->sortable()
                        ->copyable()
                        ->copyableState(function (Model $record, $state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->copyMessageDuration(1500),

                    TextColumn::make('walisantri.al_ak_rw')
                        ->label('RW')
                        ->searchable(isIndividual: true, isGlobal: false)
                        // ->toggleable(isToggledHiddenByDefault: true)
                        // ->toggleable()
                        ->sortable()
                        ->copyable()
                        ->copyableState(function (Model $record, $state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->copyMessageDuration(1500),

                    TextColumn::make('walisantri.al_ak_alamat')
                        ->label('Alamat')
                        ->searchable(isIndividual: true, isGlobal: false)
                        // ->toggleable(isToggledHiddenByDefault: true)
                        // ->toggleable()
                        ->sortable()
                        ->copyable()
                        ->copyableState(function (Model $record, $state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->copyMessageDuration(1500),

                    TextColumn::make('walisantri.al_ak_kodepos')
                        ->label('Kodepos')
                        ->searchable(isIndividual: true, isGlobal: false)
                        // ->toggleable(isToggledHiddenByDefault: true)
                        // ->toggleable()
                        ->sortable()
                        ->copyable()
                        ->copyableState(function (Model $record, $state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->copyMessageDuration(1500),

                ]),


            ])
            ->recordUrl(null)
            ->extremePaginationLinks()
            ->defaultPaginationPageOption(5)
            ->searchOnBlur()
            // ->filters([
            //     QueryBuilder::make()
            //         ->constraintPickerColumns(1)
            //         ->constraints([

            //             // SelectConstraint::make('qism_id')
            //             //     ->label('Qism')
            //             //     ->options(Qism::whereIsActive(1)->pluck('abbr_qism', 'id'))
            //             //     ->nullable(),

            //             // SelectConstraint::make('qism_detail_id')
            //             //     ->label('Qism Detail')
            //             //     ->options(QismDetail::whereIsActive(1)->pluck('abbr_qism_detail', 'id'))
            //             //     ->nullable(),

            //             // SelectConstraint::make('kelas_id')
            //             //     ->label('Kelas')
            //             //     ->options(Kelas::whereIsActive(1)->pluck('kelas', 'id'))
            //             //     ->nullable(),

            //             BooleanConstraint::make('terakhir')
            //                 ->label('Status')
            //                 ->icon(false)
            //                 ->nullable(),

            //             BooleanConstraint::make('is_active')
            //                 ->label('Status')
            //                 ->icon(false)
            //                 ->nullable(),

            //             TextConstraint::make('created_by')
            //                 ->label('Created by')
            //                 ->icon(false)
            //                 ->nullable(),

            //             TextConstraint::make('updated_by')
            //                 ->label('Updated by')
            //                 ->icon(false)
            //                 ->nullable(),

            //             DateConstraint::make('created_at')
            //                 ->icon(false)
            //                 ->nullable(),

            //             DateConstraint::make('updated_at')
            //                 ->icon(false)
            //                 ->nullable(),

            //         ]),
            // ])
            ->headerActions([
                // Tables\Actions\CreateAction::make(),

                // ImportAction::make()
                //     ->label('Import')
                //     ->importer(NomorSuratImporter::class)
            ])
            ->actions([
                // ActionGroup::make([
                //     // Tables\Actions\ViewAction::make(),
                //     // Tables\Actions\EditAction::make(),
                //     // Tables\Actions\DeleteAction::make(),
                // ]),

                RelationManagerAction::make('nomorsurat')
                    ->label('Create Nomor Surat')
                    ->modalCloseButton(false)
                    ->modalWidth('full')
                    ->closeModalByClickingAway(false)
                    ->closeModalByEscaping(false)
                    ->button()
                    ->outlined()
                    ->color('info')
                    ->icon('heroicon-o-hashtag')
                    ->modalSubmitActionLabel('Simpan')
                    ->modalCancelAction(fn(StaticAction $action) => $action->label('Batal'))
                    ->relationManager(NomorSuratsRelationManager::make()),


            ])
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
            'index' => Pages\ListSurats::route('/'),
            'create' => Pages\CreateSurat::route('/create'),
            'view' => Pages\ViewSurat::route('/{record}'),
            'edit' => Pages\EditSurat::route('/{record}/edit'),
        ];
    }
}
