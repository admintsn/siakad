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
use Illuminate\Support\Facades\Auth;
use App\Models\AnandaBerada;
use App\Models\BersediaTidak;
use App\Models\Cita;
use App\Models\Hafalan;
use App\Models\Hobi;
use App\Models\Jarakpp;
use App\Models\Jeniskelamin;
use App\Models\Kabupaten;
use App\Models\KebutuhanDisabilitas;
use App\Models\KebutuhanKhusus;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\Kewarganegaraan;
use App\Models\Kodepos;
use App\Models\MedsosAnanda;
use App\Models\MembiayaiSekolah;
use App\Models\MendaftarKeinginan;
use App\Models\MukimTidak;
use App\Models\Provinsi;
use App\Models\Qism;
use App\Models\QismDetail;
use App\Models\QismDetailHasKelas;
use App\Models\Semester;
use App\Models\StatusAdmPendaftar;
use App\Models\StatusTempatTinggal;
use App\Models\TahunAjaran;
use App\Models\TahunAjaranAktif;
use App\Models\TahunBerjalan;
use App\Models\Transpp;
use App\Models\Waktutempuh;
use App\Models\Walisantri;
use App\Models\YaTidak;
use App\Models\HubunganWali;
use App\Models\Kelas;
use App\Models\KelasSantri;
use App\Models\NismPerTahun;
use App\Models\PekerjaanUtamaWalisantri;
use App\Models\PendidikanTerakhirWalisantri;
use App\Models\PenghasilanWalisantri;
use App\Models\SemesterBerjalan;
use App\Models\Statuskepemilikanrumah;
use App\Models\StatusPendaftaran;
use App\Models\StatusSantri;
use App\Models\StatusWalisantri;
use App\Models\TahapPendaftaran;
use App\Models\User;
use Carbon\Carbon;
use Closure;
use Filament\Actions\StaticAction;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Wizard\Step;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Columns\TextColumn;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\Layout\Grid as TableGrid;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\ToggleButtons;
use Filament\Support\Enums\FontWeight;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Columns\TextInputColumn;
use Filament\Tables\Enums\ActionsPosition;
use Filament\Tables\Filters\QueryBuilder;
use Filament\Tables\Filters\QueryBuilder\Constraints\SelectConstraint;
use Filament\Tables\Filters\QueryBuilder\Constraints\TextConstraint;
use Filament\Tables\Grouping\Group as GroupingGroup;
use Illuminate\Database\Eloquent\Model;
use Schmeits\FilamentCharacterCounter\Forms\Components\TextInput as ComponentsTextInput;

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

                Tabs::make('Tabs')
                    ->tabs([


                        Tabs\Tab::make('Walisantri')
                            ->schema([

                                Group::make()
                                    ->relationship('walisantri')
                                    ->schema([
                                        Section::make('Informasi Pendaftar')
                                            ->schema([
                                                Grid::make(4)
                                                    ->schema([
                                                        TextInput::make('kartu_keluarga_santri')
                                                            ->label('Nomor Kartu Keluarga')
                                                            ->disabled(),

                                                        TextInput::make('nama_kpl_kel_santri')
                                                            ->label('Nama Kepala Keluarga')
                                                            ->required(),
                                                    ]),

                                                Grid::make(4)
                                                    ->schema([

                                                        TextInput::make('hp_komunikasi')
                                                            ->label('No Handphone walisantri untuk komunikasi')
                                                            ->helperText('Contoh: 82187782223')
                                                            // ->mask('82187782223')
                                                            ->prefix('+62')
                                                            ->tel()
                                                            ->telRegex('/^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\.\/0-9]*$/')
                                                            ->required(),

                                                    ]),

                                            ])->compact(),

                                        //AYAH KANDUNG
                                        Section::make('A. AYAH KANDUNG')
                                            ->schema([

                                                Grid::make(4)
                                                    ->schema([

                                                        ToggleButtons::make('ak_nama_lengkap_sama_id')
                                                            ->label('Apakah Nama sama dengan Nama Kepala Keluarga?')
                                                            ->live()
                                                            ->inline()
                                                            ->grouped()
                                                            ->boolean()
                                                            ->options(YaTidak::whereIsActive(1)->pluck('ya_tidak', 'id'))
                                                            // ->hidden(fn (Get $get) =>
                                                            // $get('ak_status_id') != 1)
                                                            ->afterStateUpdated(function (Get $get, Set $set) {

                                                                if ($get('ak_nama_lengkap_sama_id') == 1) {
                                                                    $set('ak_nama_lengkap', $get('nama_kpl_kel_santri'));
                                                                    $set('ik_nama_lengkap_sama_id_id', 2);
                                                                    $set('ik_nama_lengkap', null);
                                                                    $set('w_nama_lengkap_sama_id_id', 2);
                                                                    $set('w_nama_lengkap', null);
                                                                } else {
                                                                    $set('ak_nama_lengkap', null);
                                                                }
                                                            })->columnSpanFull(),

                                                        TextInput::make('ak_nama_lengkap')
                                                            ->label('Nama Lengkap')
                                                            ->hint('Isi sesuai dengan KK')
                                                            ->hintColor('danger')
                                                            ->required()
                                                            // ->disabled(fn (Get $get) =>
                                                            // $get('ak_nama_lengkap_sama') == 1)
                                                            ->dehydrated(),

                                                    ]),

                                                Grid::make(2)
                                                    ->schema([

                                                        Placeholder::make('')
                                                            ->content(new HtmlString('<div class="border-b">
                                                    <p class="text-lg">A.01 STATUS AYAH KANDUNG</p>
                                                </div>')),

                                                    ]),

                                                Grid::make(4)
                                                    ->schema([

                                                        ToggleButtons::make('ak_status_id')
                                                            ->label('Status')
                                                            // ->placeholder('Pilih Status')
                                                            ->options(StatusWalisantri::whereIsActive(1)->pluck('status_walisantri', 'id'))
                                                            ->required()
                                                            ->inline()
                                                            ->live()
                                                            ->afterStateUpdated(function (Get $get, Set $set) {

                                                                if ($get('ak_status_id') == 1) {
                                                                    $set('ak_kewarganegaraan_id', 1);
                                                                }
                                                            }),
                                                        // ->native(false),

                                                    ]),

                                                Grid::make(4)
                                                    ->hidden(fn(Get $get) =>
                                                    $get('ak_status_id') != 1)
                                                    ->schema([

                                                        TextInput::make('ak_nama_kunyah')
                                                            ->label('Nama Hijroh/Islami/Panggilan')
                                                            ->required(),
                                                    ]),

                                                Grid::make(4)
                                                    ->hidden(fn(Get $get) =>
                                                    $get('ak_status_id') != 1)
                                                    ->schema([

                                                        ToggleButtons::make('ak_kewarganegaraan_id')
                                                            ->label('Kewarganegaraan')
                                                            // ->placeholder('Pilih Kewarganegaraan')
                                                            ->inline()
                                                            ->default(1)
                                                            ->options(Kewarganegaraan::whereIsActive(1)->pluck('kewarganegaraan', 'id'))
                                                            ->required()
                                                            ->live(),
                                                        // ->native(false),

                                                    ]),

                                                Grid::make(4)
                                                    ->hidden(fn(Get $get) =>
                                                    $get('ak_kewarganegaraan_id') != 1 ||
                                                        $get('ak_status_id') != 1)
                                                    ->schema([

                                                        ComponentsTextInput::make('ak_nik')
                                                            ->label('NIK')
                                                            ->hint('Isi sesuai dengan KK')
                                                            ->hintColor('danger')
                                                            ->regex('/^[0-9]*$/')
                                                            ->length(16)
                                                            ->maxLength(16)
                                                            ->required(),

                                                    ]),

                                                Grid::make(4)
                                                    ->hidden(fn(Get $get) =>
                                                    $get('ak_kewarganegaraan_id') != 2 ||
                                                        $get('ak_status_id') != 1)
                                                    ->schema([

                                                        TextInput::make('ak_asal_negara')
                                                            ->label('Asal Negara')
                                                            ->required(),


                                                        TextInput::make('ak_kitas')
                                                            ->label('KITAS')
                                                            ->hint('Nomor Izin Tinggal (KITAS)')
                                                            ->hintColor('danger')
                                                            ->required(),
                                                    ]),

                                                Grid::make(4)
                                                    ->hidden(fn(Get $get) =>
                                                    $get('ak_status_id') != 1)
                                                    ->schema([

                                                        TextInput::make('ak_tempat_lahir')
                                                            ->label('Tempat Lahir')
                                                            ->hint('Isi sesuai dengan KK')
                                                            ->hintColor('danger')
                                                            ->required(),


                                                        DatePicker::make('ak_tanggal_lahir')
                                                            ->label('Tanggal Lahir')
                                                            ->hint('Isi sesuai dengan KK')
                                                            ->hintColor('danger')
                                                            ->required()
                                                            // ->format('dd/mm/yyyy')
                                                            ->displayFormat('d M Y')
                                                            ->maxDate(now())
                                                            // ->native(false)
                                                            ->closeOnDateSelection(),
                                                    ]),

                                                Grid::make(6)
                                                    ->hidden(fn(Get $get) =>
                                                    $get('ak_status_id') != 1)
                                                    ->schema([

                                                        Select::make('ak_pend_terakhir_id')
                                                            ->label('Pendidikan Terakhir')
                                                            ->placeholder('Pilih Pendidikan Terakhir')
                                                            ->options(PendidikanTerakhirWalisantri::whereIsActive(1)->pluck('pendidikan_terakhir_walisantri', 'id'))
                                                            // ->searchable()
                                                            ->required()
                                                            ->native(false),

                                                        Select::make('ak_pekerjaan_utama_id')
                                                            ->label('Pekerjaan Utama')
                                                            ->placeholder('Pilih Pekerjaan Utama')
                                                            ->options(PekerjaanUtamaWalisantri::whereIsActive(1)->pluck('pekerjaan_utama_walisantri', 'id'))
                                                            // ->searchable()
                                                            ->required()
                                                            ->native(false),

                                                        Select::make('ak_pghsln_rt_id')
                                                            ->label('Penghasilan Rata-Rata')
                                                            ->placeholder('Pilih Penghasilan Rata-Rata')
                                                            ->options(PenghasilanWalisantri::whereIsActive(1)->pluck('penghasilan_walisantri', 'id'))
                                                            // ->searchable()
                                                            ->required()
                                                            ->native(false),
                                                    ]),

                                                Grid::make(4)
                                                    ->hidden(fn(Get $get) =>
                                                    $get('ak_status_id') != 1)
                                                    ->schema([

                                                        ToggleButtons::make('ak_tdk_hp_id')
                                                            ->label('Apakah memiliki nomor handphone?')
                                                            ->live()
                                                            ->inline()
                                                            ->grouped()
                                                            ->boolean()
                                                            ->options(YaTidak::whereIsActive(1)->pluck('ya_tidak', 'id'))
                                                            ->afterStateUpdated(function (Get $get, Set $set) {

                                                                if ($get('ak_tdk_hp_id') == 2) {
                                                                    $set('ak_nomor_handphone_sama_id', null);
                                                                    $set('ak_nomor_handphone', null);
                                                                }
                                                            }),

                                                    ]),

                                                Grid::make(4)
                                                    ->hidden(fn(Get $get) =>
                                                    $get('ak_tdk_hp_id') != 1 ||
                                                        $get('ak_status_id') != 1)
                                                    ->schema([


                                                        ToggleButtons::make('ak_nomor_handphone_sama_id')
                                                            ->label('Apakah nomor handphone sama dengan Pendaftar?')
                                                            ->live()
                                                            ->inline()
                                                            ->grouped()
                                                            ->boolean()
                                                            ->options(YaTidak::whereIsActive(1)->pluck('ya_tidak', 'id'))
                                                            ->afterStateUpdated(function (Get $get, Set $set) {

                                                                if ($get('ak_nomor_handphone_sama_id') == 1) {
                                                                    $set('ak_nomor_handphone', $get('hp_komunikasi'));
                                                                    $set('ik_nomor_handphone_sama_id', 2);
                                                                    $set('ik_nomor_handphone', null);
                                                                    $set('w_nomor_handphone_sama_id', 2);
                                                                    $set('w_nomor_handphone', null);
                                                                } else {
                                                                    $set('ak_nomor_handphone', null);
                                                                }
                                                            })->columnSpanFull(),

                                                        TextInput::make('ak_nomor_handphone')
                                                            ->label('No. Handphone')
                                                            ->helperText('Contoh: 82187782223')
                                                            ->prefix('+62')
                                                            ->tel()
                                                            ->telRegex('/^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\.\/0-9]*$/')
                                                            ->required()
                                                            // ->disabled(fn (Get $get) =>
                                                            // $get('ak_nomor_handphone_sama_id') == 1)
                                                            ->dehydrated(),
                                                    ]),

                                                Grid::make(2)
                                                    ->hidden(fn(Get $get) =>
                                                    $get('ak_status_id') != 1)
                                                    ->schema([

                                                        Placeholder::make('')
                                                            ->content(new HtmlString('<div class="border-b">
                                         <p class="text-lg">Kajian yang diikuti</p>
                                     </div>')),
                                                    ]),

                                                Grid::make(2)
                                                    ->hidden(fn(Get $get) =>
                                                    $get('ak_status_id') != 1)
                                                    ->schema([

                                                        Textarea::make('ak_ustadz_kajian')
                                                            ->label('Ustadz yang mengisi kajian')
                                                            ->required(),

                                                    ]),

                                                Grid::make(2)
                                                    ->hidden(fn(Get $get) =>
                                                    $get('ak_status_id') != 1)
                                                    ->schema([

                                                        TextArea::make('ak_tempat_kajian')
                                                            ->label('Tempat kajian yang diikuti')
                                                            ->required(),

                                                    ]),

                                                // KARTU KELUARGA AYAH KANDUNG
                                                Grid::make(2)
                                                    ->hidden(fn(Get $get) =>
                                                    $get('ak_status_id') != 1)
                                                    ->schema([
                                                        Placeholder::make('')
                                                            ->content(new HtmlString('<div class="border-b">
                                    <p class="text-lg">A.02 KARTU KELUARGA</p>
                                    <p class="text-lg">AYAH KANDUNG</p>
                                       </div>')),
                                                    ]),

                                                Grid::make(4)
                                                    ->hidden(fn(Get $get) =>
                                                    $get('ak_status_id') != 1)
                                                    ->schema([

                                                        ToggleButtons::make('ak_kk_sama_pendaftar_id')
                                                            ->label('Apakah KK dan Nama Kepala Keluarga sama dengan Pendaftar?')
                                                            ->live()
                                                            ->inline()
                                                            ->grouped()
                                                            ->boolean()
                                                            ->options(YaTidak::whereIsActive(1)->pluck('ya_tidak', 'id'))
                                                            ->afterStateUpdated(function (Get $get, Set $set) {

                                                                if ($get('ak_kk_sama_pendaftar_id') == 1) {
                                                                    $set('ak_no_kk', $get('kartu_keluarga_santri'));
                                                                    $set('ak_kep_kel_kk', $get('nama_kpl_kel_santri'));
                                                                    $set('ik_kk_sama_pendaftar_id', 2);
                                                                    $set('ik_no_kk', null);
                                                                    $set('ik_kep_kel_kk', null);
                                                                    $set('w_kk_sama_pendaftar_id', 2);
                                                                    $set('w_no_kk', null);
                                                                    $set('w_kep_kel_kk', null);
                                                                } else {
                                                                    $set('ak_no_kk', null);
                                                                    $set('ak_kep_kel_kk', null);
                                                                }
                                                            })->columnSpanFull(),
                                                    ]),

                                                Grid::make(4)
                                                    ->hidden(fn(Get $get) =>
                                                    $get('ak_status_id') != 1)
                                                    ->schema([

                                                        ComponentsTextInput::make('ak_no_kk')
                                                            ->label('No. KK Ayah Kandung')
                                                            ->hint('Isi sesuai dengan KK')
                                                            ->hintColor('danger')
                                                            ->length(16)
                                                            ->maxLength(16)
                                                            ->required()
                                                            ->regex('/^[0-9]*$/')
                                                            // ->disabled(fn (Get $get) =>
                                                            // $get('ak_kk_sama_pendaftar_id') == 1)
                                                            ->dehydrated(),

                                                        TextInput::make('ak_kep_kel_kk')
                                                            ->label('Nama Kepala Keluarga')
                                                            ->hint('Isi sesuai dengan KK')
                                                            ->hintColor('danger')
                                                            ->required()
                                                            // ->disabled(fn (Get $get) =>
                                                            // $get('ak_kk_sama_pendaftar_id') == 1)
                                                            ->dehydrated(),
                                                    ]),

                                                // ALAMAT AYAH KANDUNG
                                                Grid::make(2)
                                                    ->hidden(fn(Get $get) =>
                                                    $get('ak_status_id') != 1)
                                                    ->schema([
                                                        Placeholder::make('')
                                                            ->content(new HtmlString('<div class="border-b">
                                                    <p class="text-lg">A.03 TEMPAT TINGGAL DOMISILI</p>
                                                    <p class="text-lg">AYAH KANDUNG</p>
                                                </div>')),
                                                    ]),

                                                Grid::make(4)
                                                    ->hidden(fn(Get $get) =>
                                                    $get('ak_status_id') != 1)
                                                    ->schema([

                                                        ToggleButtons::make('al_ak_tgldi_ln_id')
                                                            ->label('Apakah tinggal di luar negeri?')
                                                            ->live()
                                                            ->inline()
                                                            ->grouped()
                                                            ->boolean()
                                                            ->options(YaTidak::whereIsActive(1)->pluck('ya_tidak', 'id'))
                                                    ]),

                                                Grid::make(2)
                                                    ->hidden(fn(Get $get) =>
                                                    $get('al_ak_tgldi_ln_id') != 1)
                                                    ->schema([

                                                        Textarea::make('al_ak_almt_ln')
                                                            ->label('Alamat Luar Negeri')
                                                            ->required(),
                                                    ]),

                                                Grid::make(4)
                                                    ->hidden(fn(Get $get) =>
                                                    $get('al_ak_tgldi_ln_id') != 2 ||
                                                        $get('ak_status_id') != 1)
                                                    ->schema([

                                                        Select::make('al_ak_stts_rmh_id')
                                                            ->label('Status Kepemilikan Rumah')
                                                            ->placeholder('Pilih Status Kepemilikan Rumah')
                                                            ->options(Statuskepemilikanrumah::whereIsActive(1)->pluck('status_kepemilikan_rumah', 'id'))
                                                            // ->searchable()
                                                            ->required()
                                                            ->native(false),

                                                    ]),

                                                Grid::make(4)
                                                    ->hidden(fn(Get $get) =>
                                                    $get('al_ak_tgldi_ln_id') != 2 ||
                                                        $get('ak_status_id') != 1)
                                                    ->schema([

                                                        Select::make('al_ak_provinsi_id')
                                                            ->label('Provinsi')
                                                            ->placeholder('Pilih Provinsi')
                                                            ->options(Provinsi::all()->pluck('provinsi', 'id'))
                                                            // ->searchable()
                                                            ->required()
                                                            ->live()
                                                            ->native(false)
                                                            ->afterStateUpdated(function (Set $set) {
                                                                $set('al_ak_kabupaten_id', null);
                                                                $set('al_ak_kecamatan_id', null);
                                                                $set('al_ak_kelurahan_id', null);
                                                                $set('al_ak_kodepos', null);
                                                            }),

                                                        Select::make('al_ak_kabupaten_id')
                                                            ->label('Kabupaten')
                                                            ->placeholder('Pilih Kabupaten')
                                                            ->options(fn(Get $get): Collection => Kabupaten::query()
                                                                ->where('provinsi_id', $get('al_ak_provinsi_id'))
                                                                ->pluck('kabupaten', 'id'))
                                                            // ->searchable()
                                                            ->required()
                                                            ->live()
                                                            ->native(false),

                                                    ]),

                                                Grid::make(4)
                                                    ->hidden(fn(Get $get) =>
                                                    $get('al_ak_tgldi_ln_id') != 2 ||
                                                        $get('ak_status_id') != 1)
                                                    ->schema([

                                                        Select::make('al_ak_kecamatan_id')
                                                            ->label('Kecamatan')
                                                            ->placeholder('Pilih Kecamatan')
                                                            ->options(fn(Get $get): Collection => Kecamatan::query()
                                                                ->where('kabupaten_id', $get('al_ak_kabupaten_id'))
                                                                ->pluck('kecamatan', 'id'))
                                                            // ->searchable()
                                                            ->required()
                                                            ->live()
                                                            ->native(false),

                                                        Select::make('al_ak_kelurahan_id')
                                                            ->label('Kelurahan')
                                                            ->placeholder('Pilih Kelurahan')
                                                            ->options(fn(Get $get): Collection => Kelurahan::query()
                                                                ->where('kecamatan_id', $get('al_ak_kecamatan_id'))
                                                                ->pluck('kelurahan', 'id'))
                                                            // ->searchable()
                                                            ->required()
                                                            ->live()
                                                            ->native(false)
                                                            ->afterStateUpdated(function (Get $get, ?string $state, Set $set, ?string $old) {

                                                                if (($get('al_ak_kodepos') ?? '') !== Str::slug($old)) {
                                                                    return;
                                                                }

                                                                $kodepos = Kodepos::where('kelurahan_id', $state)->get('kodepos');

                                                                $state = $kodepos;

                                                                foreach ($state as $state) {
                                                                    $set('al_ak_kodepos', Str::substr($state, 12, 5));
                                                                }
                                                            }),
                                                    ]),

                                                Grid::make(4)
                                                    ->hidden(fn(Get $get) =>
                                                    $get('al_ak_tgldi_ln_id') != 2 ||
                                                        $get('ak_status_id') != 1)
                                                    ->schema([

                                                        TextInput::make('al_ak_kodepos')
                                                            ->label('Kodepos')
                                                            ->disabled()
                                                            ->required()
                                                            ->dehydrated(),
                                                    ]),

                                                Grid::make(4)
                                                    ->hidden(fn(Get $get) =>
                                                    $get('al_ak_tgldi_ln_id') != 2 ||
                                                        $get('ak_status_id') != 1)
                                                    ->schema([


                                                        TextInput::make('al_ak_rt')
                                                            ->label('RT')
                                                            ->helperText('Isi 0 jika tidak ada RT/RW')
                                                            ->required()
                                                            ->disabled(fn(Get $get) =>
                                                            $get('al_ak_kodepos') == null)
                                                            ->numeric(),

                                                        TextInput::make('al_ak_rw')
                                                            ->label('RW')
                                                            ->helperText('Isi 0 jika tidak ada RT/RW')
                                                            ->required()
                                                            ->disabled(fn(Get $get) =>
                                                            $get('al_ak_kodepos') == null)
                                                            ->numeric(),
                                                    ]),

                                                Grid::make(2)
                                                    ->hidden(fn(Get $get) =>
                                                    $get('al_ak_tgldi_ln_id') != 2 ||
                                                        $get('ak_status_id') != 1)
                                                    ->schema([
                                                        Textarea::make('al_ak_alamat')
                                                            ->label('Alamat')
                                                            ->disabled(fn(Get $get) =>
                                                            $get('al_ak_kodepos') == null)
                                                            ->required(),
                                                    ]),

                                            ])->compact(),


                                        // //IBU KANDUNG
                                        Section::make('B. IBU KANDUNG')
                                            ->schema([

                                                Grid::make(4)
                                                    ->schema([

                                                        ToggleButtons::make('ik_nama_lengkap_sama_id')
                                                            ->label('Apakah Nama sama dengan Nama Kepala Keluarga?')
                                                            ->live()
                                                            ->inline()
                                                            ->grouped()
                                                            ->boolean()
                                                            ->options(YaTidak::whereIsActive(1)->pluck('ya_tidak', 'id'))
                                                            ->hidden(fn(Get $get) =>
                                                            $get('ak_nama_lengkap_sama_id') != 2)
                                                            ->afterStateUpdated(function (Get $get, Set $set) {

                                                                if ($get('ik_nama_lengkap_sama_id') == 1) {
                                                                    $set('ik_nama_lengkap', $get('nama_kpl_kel_santri'));
                                                                    $set('w_nama_lengkap_sama_id', 2);
                                                                    $set('w_nama_lengkap', null);
                                                                } else {
                                                                    $set('ik_nama_lengkap', null);
                                                                }
                                                            })->columnSpanFull(),

                                                        TextInput::make('ik_nama_lengkap')
                                                            ->label('Nama Lengkap')
                                                            ->hint('Isi sesuai dengan KK')
                                                            ->hintColor('danger')
                                                            ->required()
                                                            // ->disabled(fn (Get $get) =>
                                                            // $get('ik_nama_lengkap_sama_id') == 1)
                                                            ->dehydrated(),

                                                    ]),

                                                Grid::make(2)
                                                    ->schema([

                                                        Placeholder::make('')
                                                            ->content(new HtmlString('<div class="border-b">
                                                    <p class="text-lg">B.01 STATUS IBU KANDUNG</p>
                                                </div>')),
                                                    ]),

                                                Grid::make(4)
                                                    ->schema([

                                                        ToggleButtons::make('ik_status_id')
                                                            ->label('Status')
                                                            // ->placeholder('Pilih Status')
                                                            ->options(StatusWalisantri::whereIsActive(1)->pluck('status_walisantri', 'id'))
                                                            ->required()
                                                            ->inline()
                                                            ->live()
                                                            ->afterStateUpdated(function (Get $get, Set $set) {

                                                                if ($get('ik_status_id') == 1) {
                                                                    $set('ik_kewarganegaraan_id', 1);
                                                                }
                                                            }),
                                                        // ->native(false),

                                                    ]),

                                                Grid::make(4)
                                                    ->hidden(fn(Get $get) =>
                                                    $get('ik_status_id') != 1)
                                                    ->schema([

                                                        TextInput::make('ik_nama_kunyah')
                                                            ->label('Nama Hijroh/Islami/Panggilan')
                                                            ->required(),

                                                    ]),

                                                Grid::make(4)
                                                    ->hidden(fn(Get $get) =>
                                                    $get('ik_status_id') != 1)
                                                    ->schema([

                                                        ToggleButtons::make('ik_kewarganegaraan_id')
                                                            ->label('Kewarganegaraan')
                                                            // ->placeholder('Pilih Kewarganegaraan')
                                                            ->inline()
                                                            ->options(Kewarganegaraan::whereIsActive(1)->pluck('kewarganegaraan', 'id'))
                                                            ->default(1),
                                                        // ->native(false)

                                                    ]),

                                                Grid::make(4)
                                                    ->hidden(fn(Get $get) =>
                                                    $get('ik_kewarganegaraan_id') != 1 ||
                                                        $get('ik_status_id') != 1)
                                                    ->schema([

                                                        ComponentsTextInput::make('ik_nik')
                                                            ->label('NIK')
                                                            ->hint('Isi sesuai dengan KK')
                                                            ->hintColor('danger')
                                                            ->regex('/^[0-9]*$/')
                                                            ->length(16)
                                                            ->maxLength(16)
                                                            ->required(),

                                                    ]),

                                                Grid::make(4)
                                                    ->hidden(fn(Get $get) =>
                                                    $get('ik_kewarganegaraan_id') != 2 ||
                                                        $get('ik_status_id') != 1)
                                                    ->schema([

                                                        TextInput::make('ik_asal_negara')
                                                            ->label('Asal Negara')
                                                            ->required(),

                                                        TextInput::make('ik_kitas')
                                                            ->label('KITAS')
                                                            ->hint('Nomor Izin Tinggal (KITAS)')
                                                            ->hintColor('danger')
                                                            ->required(),
                                                    ]),

                                                Grid::make(4)
                                                    ->hidden(fn(Get $get) =>
                                                    $get('ik_status_id') != 1)
                                                    ->schema([

                                                        TextInput::make('ik_tempat_lahir')
                                                            ->label('Tempat Lahir')
                                                            ->hint('Isi sesuai dengan KK')
                                                            ->hintColor('danger')
                                                            ->required(),

                                                        DatePicker::make('ik_tanggal_lahir')
                                                            ->label('Tanggal Lahir')
                                                            ->hint('Isi sesuai dengan KK')
                                                            ->hintColor('danger')
                                                            ->required()
                                                            // ->format('dd/mm/yyyy')
                                                            ->displayFormat('d M Y')
                                                            ->maxDate(now())
                                                            // ->native(false)
                                                            ->closeOnDateSelection(),
                                                    ]),

                                                Grid::make(6)
                                                    ->hidden(fn(Get $get) =>
                                                    $get('ik_status_id') != 1)
                                                    ->schema([

                                                        Select::make('ik_pend_terakhir_id')
                                                            ->label('Pendidikan Terakhir')
                                                            ->placeholder('Pilih Pendidikan Terakhir')
                                                            ->options(PendidikanTerakhirWalisantri::whereIsActive(1)->pluck('pendidikan_terakhir_walisantri', 'id'))
                                                            // ->searchable()
                                                            ->required()
                                                            ->native(false),

                                                        Select::make('ik_pekerjaan_utama_id')
                                                            ->label('Pekerjaan Utama')
                                                            ->placeholder('Pilih Pekerjaan Utama')
                                                            ->options(PekerjaanUtamaWalisantri::whereIsActive(1)->pluck('pekerjaan_utama_walisantri', 'id'))
                                                            // ->searchable()
                                                            ->required()
                                                            ->native(false),

                                                        Select::make('ik_pghsln_rt_id')
                                                            ->label('Penghasilan Rata-Rata')
                                                            ->placeholder('Pilih Penghasilan Rata-Rata')
                                                            ->options(PenghasilanWalisantri::whereIsActive(1)->pluck('penghasilan_walisantri', 'id'))
                                                            // ->searchable()
                                                            ->required()
                                                            ->native(false),
                                                    ]),

                                                Grid::make(4)
                                                    ->hidden(fn(Get $get) =>
                                                    $get('ik_status_id') != 1)
                                                    ->schema([

                                                        ToggleButtons::make('ik_tdk_hp_id')
                                                            ->label('Apakah memiliki nomor handphone?')
                                                            ->live()
                                                            ->inline()
                                                            ->grouped()
                                                            ->boolean()
                                                            ->options(YaTidak::whereIsActive(1)->pluck('ya_tidak', 'id'))

                                                    ]),

                                                Grid::make(4)
                                                    ->schema([

                                                        ToggleButtons::make('ik_nomor_handphone_sama_id')
                                                            ->label('Apakah nomor handphone sama dengan Pendaftar?')
                                                            ->live()
                                                            ->inline()
                                                            ->grouped()
                                                            ->boolean()
                                                            ->options(YaTidak::whereIsActive(1)->pluck('ya_tidak', 'id'))

                                                            ->hidden(fn(Get $get) =>
                                                            $get('ik_tdk_hp_id') != 1 ||
                                                                $get('ak_nomor_handphone_sama_id') != 2 ||
                                                                $get('ik_status_id') != 1)
                                                            ->afterStateUpdated(function (Get $get, Set $set) {

                                                                if ($get('ik_nomor_handphone_sama_id') == 1) {
                                                                    $set('ik_nomor_handphone', $get('hp_komunikasi'));
                                                                    $set('w_nomor_handphone', null);
                                                                } else {
                                                                    $set('ik_nomor_handphone', null);
                                                                }
                                                            })->columnSpanFull(),

                                                        TextInput::make('ik_nomor_handphone')
                                                            ->label('No. Handphone')
                                                            ->helperText('Contoh: 82187782223')
                                                            ->prefix('+62')
                                                            ->tel()
                                                            ->telRegex('/^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\.\/0-9]*$/')
                                                            ->required()
                                                            // ->disabled(fn (Get $get) =>
                                                            // $get('ik_nomor_handphone_sama_id') == 1)
                                                            ->dehydrated()
                                                            ->hidden(fn(Get $get) =>
                                                            $get('ik_tdk_hp_id') != 1 ||
                                                                $get('ik_status_id') != 1),
                                                    ]),

                                                Grid::make(2)
                                                    ->hidden(fn(Get $get) =>
                                                    $get('ik_status_id') != 1)
                                                    ->schema([

                                                        Placeholder::make('')
                                                            ->content(new HtmlString('<div class="border-b">
                                         <p class="text-lg">Kajian yang diikuti</p>
                                     </div>')),

                                                    ]),

                                                Grid::make(2)
                                                    ->hidden(fn(Get $get) =>
                                                    $get('ik_status_id') != 1)
                                                    ->schema([

                                                        Textarea::make('ik_ustadz_kajian')
                                                            ->label('Ustadz yang mengisi kajian')
                                                            ->required(),

                                                    ]),

                                                Grid::make(2)
                                                    ->hidden(fn(Get $get) =>
                                                    $get('ik_status_id') != 1)
                                                    ->schema([

                                                        TextArea::make('ik_tempat_kajian')
                                                            ->label('Tempat kajian yang diikuti')
                                                            ->required(),

                                                    ]),

                                                // KARTU KELUARGA IBU KANDUNG
                                                Grid::make(2)
                                                    ->schema([
                                                        Placeholder::make('')
                                                            ->content(new HtmlString('<div class="border-b">
                                <p class="text-lg">B.02 KARTU KELUARGA</p>
                                <p class="text-lg">IBU KANDUNG</p>
                                </div>')),

                                                    ])

                                                    ->hidden(fn(Get $get) =>
                                                    $get('ik_status_id') != 1),

                                                Grid::make(4)
                                                    ->schema([

                                                        ToggleButtons::make('ik_kk_sama_ak_id')
                                                            ->label('Apakah KK Ibu Kandung sama dengan KK Ayah Kandung?')
                                                            ->live()
                                                            ->inline()
                                                            ->grouped()
                                                            ->boolean()
                                                            ->options(function (Get $get) {

                                                                if ($get('ak_status_id') != 1) {

                                                                    return ([
                                                                        2 => 'Tidak',
                                                                    ]);
                                                                } else {
                                                                    return ([
                                                                        1 => 'Ya',
                                                                        2 => 'Tidak',
                                                                    ]);
                                                                }
                                                            })
                                                            ->afterStateUpdated(function (Get $get, Set $set) {
                                                                $sama = $get('ik_kk_sama_ak_id');
                                                                $set('al_ik_sama_ak_id', $sama);

                                                                if ($get('ik_kk_sama_ak_id') == 1) {
                                                                    $set('al_ik_sama_ak_id', 1);
                                                                }
                                                            })
                                                            ->hidden(fn(Get $get) =>
                                                            $get('ik_status_id') != 1),

                                                        ToggleButtons::make('al_ik_sama_ak_id')
                                                            ->label('Alamat sama dengan Ayah Kandung')
                                                            ->helperText('Untuk mengubah alamat, silakan mengubah status KK Ibu kandung')
                                                            ->disabled()
                                                            ->live()
                                                            ->inline()
                                                            ->grouped()
                                                            ->boolean()
                                                            ->options(YaTidak::whereIsActive(1)->pluck('ya_tidak', 'id'))
                                                            ->hidden(fn(Get $get) =>
                                                            $get('ik_status_id') != 1),

                                                        ToggleButtons::make('ik_kk_sama_pendaftar_id')
                                                            ->label('Apakah KK dan Nama Kepala Keluarga sama dengan Pendaftar?')
                                                            ->live()
                                                            ->inline()
                                                            ->grouped()
                                                            ->boolean()
                                                            ->options(YaTidak::whereIsActive(1)->pluck('ya_tidak', 'id'))
                                                            ->hidden(fn(Get $get) =>
                                                            $get('ik_kk_sama_ak_id') != 2 ||
                                                                $get('ak_kk_sama_pendaftar_id') != 2 ||
                                                                $get('ik_status_id') != 1)
                                                            ->afterStateUpdated(function (Get $get, Set $set) {

                                                                if ($get('ik_kk_sama_pendaftar_id') == 1) {
                                                                    $set('ik_no_kk', $get('kartu_keluarga_santri'));
                                                                    $set('ik_kep_kel_kk', $get('nama_kpl_kel_santri'));
                                                                    $set('w_kk_sama_pendaftar_id', 2);
                                                                    $set('w_no_kk', null);
                                                                    $set('w_kep_kel_kk', null);
                                                                } else {
                                                                    $set('ik_no_kk', null);
                                                                    $set('ik_kep_kel_kk', null);
                                                                }
                                                            })->columnSpanFull(),

                                                    ]),

                                                Grid::make(4)
                                                    ->hidden(fn(Get $get) =>
                                                    $get('ik_kk_sama_ak_id') != 2 ||
                                                        $get('ik_status_id') != 1)
                                                    ->schema([

                                                        ComponentsTextInput::make('ik_no_kk')
                                                            ->label('No. KK Ibu Kandung')
                                                            ->hint('Isi sesuai dengan KK')
                                                            ->hintColor('danger')
                                                            ->length(16)
                                                            ->maxLength(16)
                                                            ->regex('/^[0-9]*$/')
                                                            ->required()
                                                            // ->disabled(fn (Get $get) =>
                                                            // $get('ik_kk_sama_pendaftar_id') == 1)
                                                            ->dehydrated(),

                                                        TextInput::make('ik_kep_kel_kk')
                                                            ->label('Nama Kepala Keluarga')
                                                            ->hint('Isi sesuai dengan KK')
                                                            ->hintColor('danger')
                                                            ->required()
                                                            // ->disabled(fn (Get $get) =>
                                                            // $get('ik_kk_sama_pendaftar_id') == 1)
                                                            ->dehydrated(),

                                                    ]),


                                                // ALAMAT IBU KANDUNG
                                                Grid::make(2)
                                                    ->schema([
                                                        Placeholder::make('')
                                                            ->content(new HtmlString('<div class="border-b">
                                                    <p class="text-lg">B.03 TEMPAT TINGGAL DOMISILI</p>
                                                    <p class="text-lg">IBU KANDUNG</p>
                                                </div>')),
                                                    ])->hidden(fn(Get $get) =>
                                                    $get('ik_kk_sama_ak_id') == null ||
                                                        $get('ik_kk_sama_ak_id') != 2 ||
                                                        $get('ik_status_id') != 1),

                                                Grid::make(4)
                                                    ->schema([

                                                        ToggleButtons::make('al_ik_tgldi_ln_id')
                                                            ->label('Apakah tinggal di luar negeri?')
                                                            ->live()
                                                            ->inline()
                                                            ->grouped()
                                                            ->boolean()
                                                            ->options(YaTidak::whereIsActive(1)->pluck('ya_tidak', 'id'))
                                                            ->hidden(fn(Get $get) =>
                                                            $get('ik_kk_sama_ak_id') != 2 ||
                                                                $get('ik_status_id') != 1),

                                                    ]),

                                                Grid::make(2)
                                                    ->schema([

                                                        Textarea::make('al_ik_almt_ln')
                                                            ->label('Alamat Luar Negeri')
                                                            ->required()
                                                            ->hidden(fn(Get $get) =>
                                                            $get('ik_kk_sama_ak_id') != 2 ||
                                                                $get('al_ik_tgldi_ln_id') != 1 ||
                                                                $get('ik_status_id') != 1),

                                                    ]),

                                                Grid::make(4)
                                                    ->schema([

                                                        Select::make('al_ik_stts_rmh_id')
                                                            ->label('Status Kepemilikan Rumah')
                                                            ->placeholder('Pilih Status Kepemilikan Rumah')
                                                            ->options(Statuskepemilikanrumah::whereIsActive(1)->pluck('status_kepemilikan_rumah', 'id'))
                                                            // ->searchable()
                                                            ->required()
                                                            ->native(false)
                                                            ->hidden(fn(Get $get) =>
                                                            $get('ik_kk_sama_ak_id') != 2 ||
                                                                $get('al_ik_tgldi_ln_id') != 2 ||
                                                                $get('ik_status_id') != 1),

                                                    ]),

                                                Grid::make(4)
                                                    ->schema([

                                                        Select::make('al_ik_provinsi_id')
                                                            ->label('Provinsi')
                                                            ->placeholder('Pilih Provinsi')
                                                            ->options(Provinsi::all()->pluck('provinsi', 'id'))
                                                            // ->searchable()
                                                            ->required()
                                                            ->live()
                                                            ->native(false)
                                                            ->hidden(fn(Get $get) =>
                                                            $get('ik_kk_sama_ak_id') != 2 ||
                                                                $get('al_ik_tgldi_ln_id') != 2 ||
                                                                $get('ik_status_id') != 1)
                                                            ->afterStateUpdated(function (Set $set) {
                                                                $set('al_ik_kabupaten_id', null);
                                                                $set('al_ik_kecamatan_id', null);
                                                                $set('al_ik_kelurahan_id', null);
                                                                $set('al_ik_kodepos', null);
                                                            }),

                                                        Select::make('al_ik_kabupaten_id')
                                                            ->label('Kabupaten')
                                                            ->placeholder('Pilih Kabupaten')
                                                            ->options(fn(Get $get): Collection => Kabupaten::query()
                                                                ->where('provinsi_id', $get('al_ik_provinsi_id'))
                                                                ->pluck('kabupaten', 'id'))
                                                            // ->searchable()
                                                            ->required()
                                                            ->live()
                                                            ->native(false)
                                                            ->hidden(fn(Get $get) =>
                                                            $get('ik_kk_sama_ak_id') != 2 ||
                                                                $get('al_ik_tgldi_ln_id') != 2 ||
                                                                $get('ik_status_id') != 1),

                                                    ]),

                                                Grid::make(4)
                                                    ->schema([

                                                        Select::make('al_ik_kecamatan_id')
                                                            ->label('Kecamatan')
                                                            ->placeholder('Pilih Kecamatan')
                                                            ->options(fn(Get $get): Collection => Kecamatan::query()
                                                                ->where('kabupaten_id', $get('al_ik_kabupaten_id'))
                                                                ->pluck('kecamatan', 'id'))
                                                            // ->searchable()
                                                            ->required()
                                                            ->live()
                                                            ->native(false)
                                                            ->hidden(fn(Get $get) =>
                                                            $get('ik_kk_sama_ak_id') != 2 ||
                                                                $get('al_ik_tgldi_ln_id') != 2 ||
                                                                $get('ik_status_id') != 1),

                                                        Select::make('al_ik_kelurahan_id')
                                                            ->label('Kelurahan')
                                                            ->placeholder('Pilih Kelurahan')
                                                            ->options(fn(Get $get): Collection => Kelurahan::query()
                                                                ->where('kecamatan_id', $get('al_ik_kecamatan_id'))
                                                                ->pluck('kelurahan', 'id'))
                                                            // ->searchable()
                                                            ->required()
                                                            ->live()
                                                            ->native(false)
                                                            ->hidden(fn(Get $get) =>
                                                            $get('ik_kk_sama_ak_id') != 2 ||
                                                                $get('al_ik_tgldi_ln_id') != 2 ||
                                                                $get('ik_status_id') != 1)
                                                            ->afterStateUpdated(function (Get $get, ?string $state, Set $set, ?string $old) {

                                                                if (($get('al_ik_kodepos') ?? '') !== Str::slug($old)) {
                                                                    return;
                                                                }

                                                                $kodepos = Kodepos::where('kelurahan_id', $state)->get('kodepos');

                                                                $state = $kodepos;

                                                                foreach ($state as $state) {
                                                                    $set('al_ik_kodepos', Str::substr($state, 12, 5));
                                                                }
                                                            }),
                                                    ]),

                                                Grid::make(4)
                                                    ->schema([

                                                        TextInput::make('al_ik_kodepos')
                                                            ->label('Kodepos')
                                                            ->disabled()
                                                            ->required()
                                                            ->dehydrated()
                                                            ->hidden(fn(Get $get) =>
                                                            $get('ik_kk_sama_ak_id') != 2 ||
                                                                $get('al_ik_tgldi_ln_id') != 2 ||
                                                                $get('ik_status_id') != 1),
                                                    ]),

                                                Grid::make(4)
                                                    ->schema([


                                                        TextInput::make('al_ik_rt')
                                                            ->label('RT')
                                                            ->helperText('Isi 0 jika tidak ada RT/RW')
                                                            ->required()
                                                            ->numeric()
                                                            ->disabled(fn(Get $get) =>
                                                            $get('al_ik_kodepos') == null)
                                                            ->hidden(fn(Get $get) =>
                                                            $get('ik_kk_sama_ak_id') != 2 ||
                                                                $get('al_ik_tgldi_ln_id') != 2 ||
                                                                $get('ik_status_id') != 1),

                                                        TextInput::make('al_ik_rw')
                                                            ->label('RW')
                                                            ->helperText('Isi 0 jika tidak ada RT/RW')
                                                            ->required()
                                                            ->numeric()
                                                            ->disabled(fn(Get $get) =>
                                                            $get('al_ik_kodepos') == null)
                                                            ->hidden(fn(Get $get) =>
                                                            $get('ik_kk_sama_ak_id') != 2 ||
                                                                $get('al_ik_tgldi_ln_id') != 2 ||
                                                                $get('ik_status_id') != 1),

                                                    ]),

                                                Grid::make(2)
                                                    ->schema([

                                                        Textarea::make('al_ik_alamat')
                                                            ->label('Alamat')
                                                            ->required()
                                                            ->disabled(fn(Get $get) =>
                                                            $get('al_ik_kodepos') == null)
                                                            ->hidden(fn(Get $get) =>
                                                            $get('ik_kk_sama_ak_id') != 2 ||
                                                                $get('al_ik_tgldi_ln_id') != 2 ||
                                                                $get('ik_status_id') != 1),

                                                    ]),

                                            ])->compact(),

                                        // WALI

                                        Section::make('C. WALI')
                                            ->schema([

                                                Grid::make(2)
                                                    ->schema([

                                                        ToggleButtons::make('w_status_id')
                                                            ->label('Status')
                                                            // ->placeholder('Pilih Status')
                                                            ->inline()
                                                            ->options(function (Get $get) {

                                                                if (($get('ak_status_id') == 1 && $get('ik_status_id') == 1)) {
                                                                    return ([
                                                                        1 => 'Sama dengan ayah kandung',
                                                                        2 => 'Sama dengan ibu kandung',
                                                                        3 => 'Lainnya'
                                                                    ]);
                                                                } elseif (($get('ak_status_id') == 1 && $get('ik_status_id') !== 1)) {
                                                                    return ([
                                                                        1 => 'Sama dengan ayah kandung',
                                                                        3 => 'Lainnya'
                                                                    ]);
                                                                } elseif (($get('ak_status_id') !== 1 && $get('ik_status_id') == 1)) {
                                                                    return ([
                                                                        2 => 'Sama dengan ibu kandung',
                                                                        3 => 'Lainnya'
                                                                    ]);
                                                                } elseif (($get('ak_status_id') !== 1 && $get('ik_status_id') !== 1)) {
                                                                    return ([
                                                                        3 => 'Lainnya'
                                                                    ]);
                                                                }
                                                            })
                                                            ->required()
                                                            ->live()
                                                            ->afterStateUpdated(function (Get $get, Set $set) {

                                                                if ($get('w_status_id') == 3) {
                                                                    $set('w_kewarganegaraan_id', 1);
                                                                }
                                                            }),
                                                        // ->native(false),

                                                    ]),

                                                Grid::make(2)

                                                    ->hidden(fn(Get $get) =>
                                                    $get('w_status_id') != 3)
                                                    ->schema([

                                                        Placeholder::make('')
                                                            ->content(new HtmlString('<div class="border-b">
                                                    <p class="text-lg">C.01 STATUS WALI</p>
                                                </div>')),

                                                    ]),

                                                Grid::make(4)
                                                    ->schema([

                                                        Select::make('w_hubungan_id')
                                                            ->label('Hubungan wali dengan calon santri')
                                                            ->placeholder('Pilih Hubungan')
                                                            ->options(HubunganWali::whereIsActive(1)->pluck('hubungan_wali', 'id'))
                                                            ->required()
                                                            ->native(false)
                                                            ->hidden(fn(Get $get) =>
                                                            $get('w_status_id') != 3),

                                                    ]),

                                                Grid::make(4)
                                                    ->schema([

                                                        ToggleButtons::make('w_nama_lengkap_sama_id')
                                                            ->label('Apakah Nama sama dengan Nama Kepala Keluarga?')
                                                            ->live()
                                                            ->inline()
                                                            ->grouped()
                                                            ->boolean()
                                                            ->options(YaTidak::whereIsActive(1)->pluck('ya_tidak', 'id'))
                                                            ->hidden(fn(Get $get) =>
                                                            $get('w_status_id') != 3 ||
                                                                $get('ak_nama_lengkap_sama_id') != 2 ||
                                                                $get('ik_nama_lengkap_sama_id') != 2)
                                                            ->afterStateUpdated(function (Get $get, Set $set) {

                                                                if ($get('w_nama_lengkap_sama_id') == 1) {
                                                                    $set('w_nama_lengkap', $get('nama_kpl_kel_santri'));
                                                                } else {
                                                                    $set('w_nama_lengkap', null);
                                                                }
                                                            })->columnSpanFull(),

                                                        TextInput::make('w_nama_lengkap')
                                                            ->label('Nama Lengkap')
                                                            ->hint('Isi sesuai dengan KK')
                                                            ->hintColor('danger')
                                                            ->required()
                                                            // ->disabled(fn (Get $get) =>
                                                            // $get('w_nama_lengkap_sama_id') == 1)
                                                            ->dehydrated()
                                                            ->hidden(fn(Get $get) =>
                                                            $get('w_status_id') != 3),

                                                    ]),

                                                Grid::make(4)
                                                    ->schema([

                                                        TextInput::make('w_nama_kunyah')
                                                            ->label('Nama Hijroh/Islami/Panggilan')
                                                            ->required()
                                                            ->hidden(fn(Get $get) =>
                                                            $get('w_status_id') != 3),

                                                    ]),

                                                Grid::make(4)
                                                    ->schema([

                                                        ToggleButtons::make('w_kewarganegaraan_id')
                                                            ->label('Kewarganegaraan')
                                                            // ->placeholder('Pilih Kewarganegaraan')
                                                            ->inline()
                                                            ->options(Kewarganegaraan::whereIsActive(1)->pluck('kewarganegaraan', 'id'))
                                                            ->default(1)
                                                            ->live()
                                                            // ->native(false)
                                                            ->hidden(fn(Get $get) =>
                                                            $get('w_status_id') != 3),

                                                    ]),

                                                Grid::make(4)
                                                    ->schema([

                                                        ComponentsTextInput::make('w_nik')
                                                            ->label('NIK')
                                                            ->hint('Isi sesuai dengan KK')
                                                            ->hintColor('danger')
                                                            ->regex('/^[0-9]*$/')
                                                            ->length(16)
                                                            ->maxLength(16)
                                                            ->required()
                                                            ->hidden(fn(Get $get) =>
                                                            $get('w_kewarganegaraan_id') != 1 ||
                                                                $get('w_status_id') != 3),

                                                    ]),

                                                Grid::make(4)
                                                    ->schema([

                                                        TextInput::make('w_asal_negara')
                                                            ->label('Asal Negara')
                                                            ->required()
                                                            ->hidden(fn(Get $get) =>
                                                            $get('w_kewarganegaraan_id') != 2 ||
                                                                $get('w_status_id') != 3),

                                                        TextInput::make('w_kitas')
                                                            ->label('KITAS')
                                                            ->hint('Nomor Izin Tinggal (KITAS)')
                                                            ->hintColor('danger')
                                                            ->required()
                                                            ->hidden(fn(Get $get) =>
                                                            $get('w_kewarganegaraan_id') != 2 ||
                                                                $get('w_status_id') != 3),
                                                    ]),

                                                Grid::make(4)
                                                    ->schema([

                                                        TextInput::make('w_tempat_lahir')
                                                            ->label('Tempat Lahir')
                                                            ->hint('Isi sesuai dengan KK')
                                                            ->hintColor('danger')
                                                            ->required()
                                                            ->hidden(fn(Get $get) =>
                                                            $get('w_status_id') != 3),

                                                        DatePicker::make('w_tanggal_lahir')
                                                            ->label('Tanggal Lahir')
                                                            ->hint('Isi sesuai dengan KK')
                                                            ->hintColor('danger')
                                                            ->maxDate(now())
                                                            ->required()
                                                            // ->format('dd/mm/yyyy')
                                                            ->displayFormat('d M Y')
                                                            // ->native(false)
                                                            ->closeOnDateSelection()
                                                            ->hidden(fn(Get $get) =>
                                                            $get('w_status_id') != 3),
                                                    ]),

                                                Grid::make(6)
                                                    ->schema([

                                                        Select::make('w_pend_terakhir_id')
                                                            ->label('Pendidikan Terakhir')
                                                            ->placeholder('Pilih Pendidikan Terakhir')
                                                            ->options(PendidikanTerakhirWalisantri::whereIsActive(1)->pluck('pendidikan_terakhir_walisantri', 'id'))
                                                            // ->searchable()
                                                            ->required()
                                                            ->native(false)
                                                            ->hidden(fn(Get $get) =>
                                                            $get('w_status_id') != 3),

                                                        Select::make('w_pekerjaan_utama_id')
                                                            ->label('Pekerjaan Utama')
                                                            ->placeholder('Pilih Pekerjaan Utama')
                                                            ->options(PekerjaanUtamaWalisantri::whereIsActive(1)->pluck('pekerjaan_utama_walisantri', 'id'))
                                                            // ->searchable()
                                                            ->required()
                                                            ->native(false)
                                                            ->hidden(fn(Get $get) =>
                                                            $get('w_status_id') != 3),

                                                        Select::make('w_pghsln_rt_id')
                                                            ->label('Penghasilan Rata-Rata')
                                                            ->placeholder('Pilih Penghasilan Rata-Rata')
                                                            ->options(PenghasilanWalisantri::whereIsActive(1)->pluck('penghasilan_walisantri', 'id'))
                                                            // ->searchable()
                                                            ->required()
                                                            ->native(false)
                                                            ->hidden(fn(Get $get) =>
                                                            $get('w_status_id') != 3),
                                                    ]),

                                                Grid::make(4)
                                                    ->schema([

                                                        ToggleButtons::make('w_tdk_hp_id')
                                                            ->label('Apakah memiliki nomor handphone?')
                                                            ->live()
                                                            ->inline()
                                                            ->grouped()
                                                            ->boolean()
                                                            ->options(YaTidak::whereIsActive(1)->pluck('ya_tidak', 'id'))
                                                            ->hidden(fn(Get $get) =>
                                                            $get('w_status_id') != 3),

                                                    ]),

                                                Grid::make(4)
                                                    ->schema([

                                                        ToggleButtons::make('w_nomor_handphone_sama_id')
                                                            ->label('Apakah nomor handphone sama dengan Pendaftar?')
                                                            ->live()
                                                            ->inline()
                                                            ->grouped()
                                                            ->boolean()
                                                            ->options(YaTidak::whereIsActive(1)->pluck('ya_tidak', 'id'))
                                                            ->hidden(fn(Get $get) =>
                                                            $get('w_tdk_hp_id') != 1 ||
                                                                $get('ak_nomor_handphone_sama_id') != 2 ||
                                                                $get('ik_nomor_handphone_sama_id') != 2 ||
                                                                $get('w_status_id') != 3)
                                                            ->afterStateUpdated(function (Get $get, Set $set) {

                                                                if ($get('w_nomor_handphone_sama_id') == 1) {
                                                                    $set('w_nomor_handphone', $get('hp_komunikasi'));
                                                                } else {
                                                                    $set('w_nomor_handphone', null);
                                                                }
                                                            })->columnSpanFull(),

                                                        TextInput::make('w_nomor_handphone')
                                                            ->label('No. Handphone')
                                                            ->helperText('Contoh: 82187782223')
                                                            // ->mask('82187782223')
                                                            ->prefix('+62')
                                                            ->tel()
                                                            ->telRegex('/^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\.\/0-9]*$/')
                                                            ->required()
                                                            // ->disabled(fn (Get $get) =>
                                                            // $get('w_nomor_handphone_sama_id') == 1)
                                                            ->dehydrated()
                                                            ->hidden(fn(Get $get) =>
                                                            $get('w_tdk_hp_id') != 1 ||
                                                                $get('w_status_id') != 3),
                                                    ]),

                                                Grid::make(2)
                                                    ->schema([

                                                        Placeholder::make('')
                                                            ->content(new HtmlString('<div class="border-b">
                                         <p class="text-lg">Kajian yang diikuti</p>
                                     </div>'))
                                                            ->hidden(fn(Get $get) =>
                                                            $get('w_status_id') != 3),

                                                    ]),

                                                Grid::make(2)
                                                    ->schema([

                                                        Textarea::make('w_ustadz_kajian')
                                                            ->label('Ustadz yang mengisi kajian')
                                                            ->required()
                                                            // ->default('4232')
                                                            ->hidden(fn(Get $get) =>
                                                            $get('w_status_id') != 3),

                                                    ]),

                                                Grid::make(2)
                                                    ->schema([

                                                        TextArea::make('w_tempat_kajian')
                                                            ->label('Tempat kajian yang diikuti')
                                                            ->required()
                                                            // ->default('4232')
                                                            ->hidden(fn(Get $get) =>
                                                            $get('w_status_id') != 3),

                                                    ]),

                                                // KARTU KELUARGA WALI
                                                Grid::make(2)
                                                    ->schema([
                                                        Placeholder::make('')
                                                            ->content(new HtmlString('<div class="border-b">
                                    <p class="text-lg">C.02 KARTU KELUARGA</p>
                                    <p class="text-lg">WALI</p>
                                </div>'))
                                                            ->hidden(fn(Get $get) =>
                                                            $get('w_status_id') != 3),
                                                    ]),

                                                Grid::make(4)
                                                    ->schema([

                                                        ToggleButtons::make('w_kk_sama_pendaftar_id')
                                                            ->label('Apakah KK dan Nama Kepala Keluarga sama dengan Pendaftar?')
                                                            ->live()
                                                            ->inline()
                                                            ->grouped()
                                                            ->boolean()
                                                            ->options(YaTidak::whereIsActive(1)->pluck('ya_tidak', 'id'))
                                                            ->hidden(fn(Get $get) =>
                                                            $get('ak_kk_sama_pendaftar_id') != 2 ||
                                                                $get('ik_kk_sama_pendaftar_id') != 2 ||
                                                                $get('w_status_id') != 3)
                                                            ->afterStateUpdated(function (Get $get, Set $set) {

                                                                if ($get('w_kk_sama_pendaftar_id') == 1) {
                                                                    $set('w_no_kk', $get('kartu_keluarga_santri'));
                                                                    $set('w_kep_kel_kk', $get('nama_kpl_kel_santri'));
                                                                } else {
                                                                    $set('w_no_kk', null);
                                                                    $set('w_kep_kel_kk', null);
                                                                }
                                                            })->columnSpanFull(),
                                                    ]),

                                                Grid::make(4)
                                                    ->schema([

                                                        ComponentsTextInput::make('w_no_kk')
                                                            ->label('No. KK Wali')
                                                            ->hint('Isi sesuai dengan KK')
                                                            ->hintColor('danger')
                                                            ->length(16)
                                                            ->maxLength(16)
                                                            ->required()
                                                            ->regex('/^[0-9]*$/')
                                                            // ->disabled(fn (Get $get) =>
                                                            // $get('w_kk_sama_pendaftar_id') == 1)
                                                            ->dehydrated()
                                                            ->hidden(fn(Get $get) =>
                                                            $get('w_status_id') != 3),

                                                        TextInput::make('w_kep_kel_kk')
                                                            ->label('Nama Kepala Keluarga')
                                                            ->hint('Isi sesuai dengan KK')
                                                            ->hintColor('danger')
                                                            ->required()
                                                            // ->disabled(fn (Get $get) =>
                                                            // $get('w_kk_sama_pendaftar_id') == 1)
                                                            ->dehydrated()
                                                            ->hidden(fn(Get $get) =>
                                                            $get('w_status_id') != 3),
                                                    ]),


                                                // ALAMAT WALI
                                                Grid::make(2)
                                                    ->schema([
                                                        Placeholder::make('')
                                                            ->content(new HtmlString('<div class="border-b">
                                                    <p class="text-lg">C.03 TEMPAT TINGGAL DOMISILI</p>
                                                    <p class="text-lg">WALI</p>
                                                </div>'))
                                                            ->hidden(fn(Get $get) =>
                                                            $get('w_status_id') != 3),
                                                    ]),

                                                Grid::make(4)
                                                    ->schema([

                                                        ToggleButtons::make('al_w_tgldi_ln_id')
                                                            ->label('Apakah tinggal di luar negeri?')
                                                            ->live()
                                                            ->inline()
                                                            ->grouped()
                                                            ->boolean()
                                                            ->options(YaTidak::whereIsActive(1)->pluck('ya_tidak', 'id'))
                                                            ->hidden(fn(Get $get) =>
                                                            $get('w_status_id') != 3),

                                                    ]),

                                                Grid::make(2)
                                                    ->schema([

                                                        Textarea::make('al_w_almt_ln')
                                                            ->label('Alamat Luar Negeri')
                                                            ->required()
                                                            ->hidden(fn(Get $get) =>
                                                            $get('al_w_tgldi_ln_id') != 1),

                                                    ]),

                                                Grid::make(4)
                                                    ->schema([

                                                        Select::make('al_w_stts_rmh_id')
                                                            ->label('Status Kepemilikan Rumah')
                                                            ->placeholder('Pilih Status Kepemilikan Rumah')
                                                            ->options(Statuskepemilikanrumah::whereIsActive(1)->pluck('status_kepemilikan_rumah', 'id'))
                                                            // ->searchable()
                                                            ->required()
                                                            ->native(false)
                                                            ->hidden(fn(Get $get) =>
                                                            $get('al_w_tgldi_ln_id') != 2 ||
                                                                $get('w_status_id') != 3),

                                                    ]),

                                                Grid::make(4)
                                                    ->schema([

                                                        Select::make('al_w_provinsi_id')
                                                            ->label('Provinsi')
                                                            ->placeholder('Pilih Provinsi')
                                                            ->options(Provinsi::all()->pluck('provinsi', 'id'))
                                                            // ->searchable()
                                                            ->required()
                                                            ->live()
                                                            ->native(false)
                                                            ->hidden(fn(Get $get) =>
                                                            $get('al_w_tgldi_ln_id') != 2 ||
                                                                $get('w_status_id') != 3)
                                                            ->afterStateUpdated(function (Set $set) {
                                                                $set('al_w_kabupaten_id', null);
                                                                $set('al_w_kecamatan_id', null);
                                                                $set('al_w_kelurahan_id', null);
                                                                $set('al_w_kodepos', null);
                                                            }),

                                                        Select::make('al_w_kabupaten_id')
                                                            ->label('Kabupaten')
                                                            ->placeholder('Pilih Kabupaten')
                                                            ->options(fn(Get $get): Collection => Kabupaten::query()
                                                                ->where('provinsi_id', $get('al_w_provinsi_id'))
                                                                ->pluck('kabupaten', 'id'))
                                                            // ->searchable()
                                                            ->required()
                                                            ->live()
                                                            ->native(false)
                                                            ->hidden(fn(Get $get) =>
                                                            $get('al_w_tgldi_ln_id') != 2 ||
                                                                $get('w_status_id') != 3),

                                                    ]),

                                                Grid::make(4)
                                                    ->schema([

                                                        Select::make('al_w_kecamatan_id')
                                                            ->label('Kecamatan')
                                                            ->placeholder('Pilih Kecamatan')
                                                            ->options(fn(Get $get): Collection => Kecamatan::query()
                                                                ->where('kabupaten_id', $get('al_w_kabupaten_id'))
                                                                ->pluck('kecamatan', 'id'))
                                                            // ->searchable()
                                                            ->required()
                                                            ->live()
                                                            ->native(false)
                                                            ->hidden(fn(Get $get) =>
                                                            $get('al_w_tgldi_ln_id') != 2 ||
                                                                $get('w_status_id') != 3),

                                                        Select::make('al_w_kelurahan_id')
                                                            ->label('Kelurahan')
                                                            ->placeholder('Pilih Kelurahan')
                                                            ->options(fn(Get $get): Collection => Kelurahan::query()
                                                                ->where('kecamatan_id', $get('al_w_kecamatan_id'))
                                                                ->pluck('kelurahan', 'id'))
                                                            // ->searchable()
                                                            ->required()
                                                            ->live()
                                                            ->native(false)
                                                            ->hidden(fn(Get $get) =>
                                                            $get('al_w_tgldi_ln_id') != 2 ||
                                                                $get('w_status_id') != 3)
                                                            ->afterStateUpdated(function (Get $get, ?string $state, Set $set, ?string $old) {

                                                                if (($get('al_w_kodepos') ?? '') !== Str::slug($old)) {
                                                                    return;
                                                                }

                                                                $kodepos = Kodepos::where('kelurahan_id', $state)->get('kodepos');

                                                                $state = $kodepos;

                                                                foreach ($state as $state) {
                                                                    $set('al_w_kodepos', Str::substr($state, 12, 5));
                                                                }
                                                            }),

                                                    ]),

                                                Grid::make(4)
                                                    ->schema([

                                                        TextInput::make('al_w_kodepos')
                                                            ->label('Kodepos')
                                                            ->disabled()
                                                            ->required()
                                                            ->dehydrated()
                                                            ->hidden(fn(Get $get) =>
                                                            $get('al_w_tgldi_ln_id') != 2 ||
                                                                $get('w_status_id') != 3),
                                                    ]),

                                                Grid::make(4)
                                                    ->schema([


                                                        TextInput::make('al_w_rt')
                                                            ->label('RT')
                                                            ->helperText('Isi 0 jika tidak ada RT/RW')
                                                            ->required()
                                                            ->numeric()
                                                            ->disabled(fn(Get $get) =>
                                                            $get('al_w_kodepos') == null)
                                                            ->hidden(fn(Get $get) =>
                                                            $get('al_w_tgldi_ln_id') != 2 ||
                                                                $get('w_status_id') != 3),

                                                        TextInput::make('al_w_rw')
                                                            ->label('RW')
                                                            ->helperText('Isi 0 jika tidak ada RT/RW')
                                                            ->required()
                                                            ->numeric()
                                                            ->disabled(fn(Get $get) =>
                                                            $get('al_w_kodepos') == null)
                                                            ->hidden(fn(Get $get) =>
                                                            $get('al_w_tgldi_ln_id') != 2 ||
                                                                $get('w_status_id') != 3),

                                                    ]),

                                                Grid::make(2)
                                                    ->schema([

                                                        Textarea::make('al_w_alamat')
                                                            ->label('Alamat')
                                                            ->required()
                                                            ->disabled(fn(Get $get) =>
                                                            $get('al_w_kodepos') == null)
                                                            ->hidden(fn(Get $get) =>
                                                            $get('al_w_tgldi_ln_id') != 2 ||
                                                                $get('w_status_id') != 3),

                                                    ]),



                                            ])->compact()
                                        // ->collapsed(fn (Get $get): bool => $get('is_collapse')),
                                    ])
                                // end of action steps
                            ]),
                        // end of Walisantri Tab

                        Tabs\Tab::make('Calon Santri')
                            ->schema([
                                Section::make('1. DATA AWAL')
                                    ->schema([
                                        Hidden::make('tahap_pendaftaran_id')
                                            ->default(1),

                                        Hidden::make('jenis_pendaftar_id')
                                            ->default(1),

                                        Hidden::make('s_emis4')
                                            ->default(1),

                                        Hidden::make('walisantri_id')
                                            ->default(function (Get $get, ?string $state, Set $set) {

                                                $walisantri_id = Walisantri::where('kartu_keluarga_santri', Auth::user()->username)->first();

                                                return ($walisantri_id->id);
                                            }),


                                        Placeholder::make('')
                                            ->content(new HtmlString('<div class="border-b">
                                                    <p class="text-lg">1. DATA AWAL</p>
                                                </div>')),

                                        Group::make()
                                            ->relationship('statussantri')
                                            ->schema([
                                                Hidden::make('stat_santri_id')
                                                    ->default(1),
                                            ]),

                                        Grid::make(4)
                                            ->schema([

                                                Select::make('qism_id')
                                                    ->label('Qism yang dituju')
                                                    ->placeholder('Pilih Qism yang dituju')
                                                    ->options(Qism::whereIsActive(1)->pluck('qism', 'id'))
                                                    ->live()
                                                    ->required()
                                                    ->native(false)
                                                    ->afterStateUpdated(function (Get $get, ?string $state, Set $set) {

                                                        // $qism = Qism::where('id', $get('qism_id'))->first();

                                                        $taaktif = TahunAjaranAktif::where('is_active', true)->where('qism_id', $get('qism_id'))->first();

                                                        $tasel = TahunAjaran::where('id', $taaktif->tahun_ajaran_id)->first();

                                                        $set('tahun_ajaran_id', $tasel->tahun_ajaran_id);
                                                        $set('qism_detail_id', null);
                                                        $set('kelas_id', null);
                                                    }),

                                            ]),

                                        Grid::make(4)
                                            ->schema([

                                                ToggleButtons::make('qism_detail_id')
                                                    ->label('Putra/Putri')
                                                    ->inline()
                                                    ->options(function (Get $get) {

                                                        return (QismDetail::where('qism_id', $get('qism_id'))->pluck('jeniskelamin', 'id'));
                                                    })
                                                    ->required()
                                                    ->live()
                                                    ->afterStateUpdated(function (Get $get, ?string $state, Set $set) {

                                                        $jkqism = QismDetail::where('id', $state)->first();

                                                        $set('jeniskelamin_id', $jkqism->jeniskelamin_id);
                                                    }),

                                            ]),

                                        Grid::make(4)
                                            ->schema([

                                                Select::make('kelas_id')
                                                    ->label('Kelas yang dituju')
                                                    ->placeholder('Pilih Kelas')
                                                    ->native(false)
                                                    ->live()
                                                    ->required()
                                                    ->options(function (Get $get) {

                                                        return (QismDetailHasKelas::where('qism_detail_id', $get('qism_detail_id'))->pluck('kelas', 'kelas_id'));
                                                    })
                                                    ->disabled(fn(Get $get) =>
                                                    $get('qism_detail_id') == null),
                                            ]),

                                        Grid::make(4)
                                            ->schema([

                                                Select::make('tahun_ajaran_id')
                                                    ->label('Tahun Ajaran')
                                                    ->disabled()
                                                    ->dehydrated()
                                                    ->required()
                                                    ->options(TahunAjaran::all()->pluck('ta', 'id'))
                                                    ->native(false),

                                            ]),


                                        Placeholder::make('')
                                            ->content(new HtmlString('<div class="border-b">
                                    </div>')),

                                        Grid::make(2)
                                            ->schema([

                                                ToggleButtons::make('kartu_keluarga_sama_id')
                                                    ->label('Kartu Keluarga sama dengan')
                                                    ->required()
                                                    ->inline()
                                                    ->live()
                                                    ->options(function (Get $get) {

                                                        $walisantri_id = $get('walisantri_id');

                                                        $status = Walisantri::where('id', $walisantri_id)->first();
                                                        // dd($status->ak_no_kk !== null);

                                                        if ($status->ak_status_id == 1 && $status->ik_status_id == 1 && $status->w_status_id == 3) {

                                                            return ([
                                                                1 => 'KK sama dengan Ayah Kandung',
                                                                2 => 'KK sama dengan Ibu Kandung',
                                                                3 => 'KK sama dengan Wali',
                                                                4 => 'KK sendiri',
                                                            ]);
                                                        } elseif ($status->ak_status_id == 1 && $status->ik_status_id == 1 && $status->w_status_id != 3) {

                                                            return ([
                                                                1 => 'KK sama dengan Ayah Kandung',
                                                                2 => 'KK sama dengan Ibu Kandung',
                                                                4 => 'KK sendiri',
                                                            ]);
                                                        } elseif ($status->ak_status_id == 1 && $status->ik_status_id != 1 && $status->w_status_id != 3) {

                                                            return ([
                                                                1 => 'KK sama dengan Ayah Kandung',
                                                                4 => 'KK sendiri',
                                                            ]);
                                                        } elseif ($status->ak_status_id == 1 && $status->ik_status_id != 1 && $status->w_status_id == 3) {

                                                            return ([
                                                                1 => 'KK sama dengan Ayah Kandung',
                                                                3 => 'KK sama dengan Wali',
                                                                4 => 'KK sendiri',
                                                            ]);
                                                        } elseif ($status->ak_status_id != 1 && $status->ik_status_id == 1 && $status->w_status_id == 3) {

                                                            return ([
                                                                2 => 'KK sama dengan Ibu Kandung',
                                                                3 => 'KK sama dengan Wali',
                                                                4 => 'KK sendiri',
                                                            ]);
                                                        } elseif ($status->ak_status_id != 1 && $status->ik_status_id != 1 && $status->w_status_id == 3) {

                                                            return ([
                                                                3 => 'KK sama dengan Wali',
                                                                4 => 'KK sendiri',
                                                            ]);
                                                        } elseif ($status->ak_status_id != 1 && $status->ik_status_id == 1 && $status->w_status_id != 3) {

                                                            return ([
                                                                2 => 'KK sama dengan Ibu Kandung',
                                                                4 => 'KK sendiri',
                                                            ]);
                                                        }
                                                    })
                                                    ->afterStateUpdated(function (Get $get, Set $set) {

                                                        $walisantri_id = $get('walisantri_id');

                                                        $walisantri = Walisantri::where('id', $walisantri_id)->first();

                                                        if ($get('kartu_keluarga_sama_id') == 1) {

                                                            $set('kartu_keluarga', $walisantri->ak_no_kk);
                                                            $set('nama_kpl_kel', $walisantri->ak_kep_kel_kk);
                                                        } elseif ($get('kartu_keluarga_sama_id') == 2) {

                                                            $set('kartu_keluarga', $walisantri->ik_no_kk);
                                                            $set('nama_kpl_kel', $walisantri->ik_kep_kel_kk);
                                                        } elseif ($get('kartu_keluarga_sama_id') == 3) {

                                                            $set('kartu_keluarga', $walisantri->w_no_kk);
                                                            $set('nama_kpl_kel', $walisantri->w_kep_kel_kk);
                                                        } elseif ($get('kartu_keluarga_sama_id') == 4) {

                                                            $set('kartu_keluarga', null);
                                                            $set('nama_kpl_kel', null);
                                                        }
                                                    }),

                                            ]),

                                        Grid::make(4)
                                            ->schema([

                                                TextInput::make('kartu_keluarga')
                                                    ->label('Nomor KK Calon Santri')
                                                    ->length(16)
                                                    ->required()
                                                    // ->disabled(fn (Get $get) =>
                                                    // $get('kartu_keluarga_sama') !== 'KK Sendiri')
                                                    ->dehydrated(),

                                                TextInput::make('nama_kpl_kel')
                                                    ->label('Nama Kepala Keluarga')
                                                    ->required()
                                                    // ->disabled(fn (Get $get) =>
                                                    // $get('kartu_keluarga_sama') !== 'KK Sendiri')
                                                    ->dehydrated(),
                                            ]),

                                        Grid::make(4)
                                            ->schema([

                                                ToggleButtons::make('kewarganegaraan_id')
                                                    ->label('Kewarganegaraan')
                                                    ->inline()
                                                    ->options(Kewarganegaraan::whereIsActive(1)->pluck('kewarganegaraan', 'id'))
                                                    ->default(1)
                                                    ->live(),

                                            ]),

                                        Grid::make(4)
                                            ->schema([

                                                ComponentsTextInput::make('nik')
                                                    ->label('NIK')
                                                    ->hint('Isi sesuai dengan KK')
                                                    ->hintColor('danger')
                                                    ->regex('/^[0-9]*$/')
                                                    ->length(16)
                                                    ->maxLength(16)
                                                    ->required()
                                                    ->unique(Santri::class, 'nik', ignoreRecord: true)
                                                    //->default('3295131306822002')
                                                    ->hidden(fn(Get $get) =>
                                                    $get('kewarganegaraan_id') != 1),

                                            ]),

                                        Grid::make(4)
                                            ->schema([

                                                TextInput::make('asal_negara')
                                                    ->label('Asal Negara Calon Santri')
                                                    ->required()
                                                    //->default('asfasdad')
                                                    ->hidden(fn(Get $get) =>
                                                    $get('kewarganegaraan_id') != 2),

                                                TextInput::make('kitas')
                                                    ->label('KITAS Calon Santri')
                                                    ->hint('Nomor Izin Tinggal (KITAS)')
                                                    ->hintColor('danger')
                                                    ->required()
                                                    //->default('3295131306822002')
                                                    ->unique(Santri::class, 'kitas')
                                                    ->hidden(fn(Get $get) =>
                                                    $get('kewarganegaraan_id') != 2),

                                            ]),

                                    ]),
                                // end of step 1

                                Section::make('2. DATA SANTRI')
                                    ->schema([
                                        //SANTRI
                                        Placeholder::make('')
                                            ->content(new HtmlString('<div class="border-b">
                                                <p class="text-2xl">SANTRI</p>
                                            </div>')),

                                        Grid::make(4)
                                            ->schema([

                                                TextInput::make('nama_lengkap')
                                                    ->label('Nama Lengkap')
                                                    ->hint('Isi sesuai dengan KK')
                                                    ->hintColor('danger')
                                                    //->default('asfasdad')
                                                    ->required(),

                                            ]),

                                        Grid::make(4)
                                            ->schema([

                                                TextInput::make('nama_panggilan')
                                                    ->label('Nama Hijroh/Islami/Panggilan')
                                                    //->default('asfasdad')
                                                    ->required(),

                                            ]),

                                        Placeholder::make('')
                                            ->content(new HtmlString('<div class="border-b">
                                            </div>')),

                                        Grid::make(4)
                                            ->schema([

                                                ToggleButtons::make('jeniskelamin_id')
                                                    ->label('Jenis Kelamin')
                                                    ->inline()
                                                    ->options(Jeniskelamin::whereIsActive(1)->pluck('jeniskelamin', 'id'))
                                                    ->required()
                                                    ->disabled()
                                                    ->dehydrated(),

                                            ]),

                                        Grid::make(6)
                                            ->schema([

                                                TextInput::make('tempat_lahir')
                                                    ->label('Tempat Lahir')
                                                    ->hint('Isi sesuai dengan KK')
                                                    ->hintColor('danger')
                                                    //->default('asfasdad')
                                                    ->required(),

                                                DatePicker::make('tanggal_lahir')
                                                    ->label('Tanggal Lahir')
                                                    ->hint('Isi sesuai dengan KK')
                                                    ->hintColor('danger')
                                                    //->default('20010101')
                                                    ->required()
                                                    ->displayFormat('d M Y')
                                                    // ->native(false)
                                                    ->live(onBlur: true)
                                                    ->closeOnDateSelection()
                                                    ->afterStateUpdated(function (Set $set, $state) {
                                                        $set('umur', Carbon::parse($state)->age);
                                                    }),

                                                TextInput::make('umur')
                                                    ->label('Umur')
                                                    ->disabled()
                                                    ->dehydrated()
                                                    ->required(),

                                            ]),

                                        Placeholder::make('')
                                            ->content(new HtmlString('<div class="border-b"></div>')),

                                        Grid::make(4)
                                            ->schema([

                                                TextInput::make('anak_ke')
                                                    ->label('Anak ke-')
                                                    ->required()
                                                    //->default('3')
                                                    ->rules([
                                                        fn(Get $get): Closure => function (string $attribute, $value, Closure $fail) use ($get) {

                                                            $anakke = $get('anak_ke');
                                                            $psjumlahsaudara = $get('jumlah_saudara');
                                                            $jumlahsaudara = $psjumlahsaudara + 1;

                                                            if ($anakke > $jumlahsaudara) {
                                                                $fail("Anak ke tidak bisa lebih dari jumlah saudara + 1");
                                                            }
                                                        },
                                                    ]),

                                                TextInput::make('jumlah_saudara')
                                                    ->label('Jumlah saudara')
                                                    //->default('5')
                                                    ->required(),
                                            ]),

                                        Placeholder::make('')
                                            ->content(new HtmlString('<div class="border-b"></div>')),

                                        Grid::make(4)
                                            ->schema([

                                                TextInput::make('agama')
                                                    ->label('Agama')
                                                    ->default('Islam')
                                                    ->disabled()
                                                    ->required()
                                                    ->dehydrated(),
                                            ]),

                                        Placeholder::make('')
                                            ->content(new HtmlString('<div class="border-b"></div>')),

                                        Grid::make(4)
                                            ->schema([

                                                Select::make('cita_cita_id')
                                                    ->label('Cita-cita')
                                                    ->placeholder('Pilih Cita-cita')
                                                    ->options(Cita::whereIsActive(1)->pluck('cita', 'id'))
                                                    // ->searchable()
                                                    ->required()
                                                    ->live()
                                                    ->native(false),

                                                TextInput::make('cita_cita_lainnya')
                                                    ->label('Cita-cita Lainnya')
                                                    ->required()
                                                    //->default('asfasdad')
                                                    ->hidden(fn(Get $get) =>
                                                    $get('cita_cita_id') != 10),
                                            ]),

                                        Grid::make(4)
                                            ->schema([
                                                Select::make('hobi_id')
                                                    ->label('Hobi')
                                                    ->placeholder('Pilih Hobi')
                                                    ->options(Hobi::whereIsActive(1)->pluck('hobi', 'id'))
                                                    // ->searchable()
                                                    ->required()
                                                    //->default('Lainnya')
                                                    ->live()
                                                    ->native(false),

                                                TextInput::make('hobi_lainnya')
                                                    ->label('Hobi Lainnya')
                                                    ->required()
                                                    //->default('asfasdad')
                                                    ->hidden(fn(Get $get) =>
                                                    $get('hobi_id') != 6),

                                            ]),


                                        Placeholder::make('')
                                            ->content(new HtmlString('<div class="border-b"></div>')),

                                        Grid::make(4)
                                            ->schema([
                                                Select::make('keb_khus_id')
                                                    ->label('Kebutuhan Khusus')
                                                    ->placeholder('Pilih Kebutuhan Khusus')
                                                    ->options(KebutuhanKhusus::whereIsActive(1)->pluck('kebutuhan_khusus', 'id'))
                                                    // ->searchable()
                                                    ->required()
                                                    //->default('Lainnya')
                                                    ->live()
                                                    ->native(false),

                                                TextInput::make('keb_khus_lainnya')
                                                    ->label('Kebutuhan Khusus Lainnya')
                                                    ->required()
                                                    //->default('asfasdad')
                                                    ->hidden(fn(Get $get) =>
                                                    $get('keb_khus_id') != 6),
                                            ]),

                                        Grid::make(4)
                                            ->schema([
                                                Select::make('keb_dis_id')
                                                    ->label('Kebutuhan Disabilitas')
                                                    ->placeholder('Pilih Kebutuhan Disabilitas')
                                                    ->options(KebutuhanDisabilitas::whereIsActive(1)->pluck('kebutuhan_disabilitas', 'id'))
                                                    // ->searchable()
                                                    ->required()
                                                    //->default('Lainnya')
                                                    ->live()
                                                    ->native(false),

                                                TextInput::make('keb_dis_lainnya')
                                                    ->label('Kebutuhan Disabilitas Lainnya')
                                                    ->required()
                                                    //->default('asfasdad')
                                                    ->hidden(fn(Get $get) =>
                                                    $get('keb_dis_id') != 8),
                                            ]),

                                        Placeholder::make('')
                                            ->content(new HtmlString('<div class="border-b"></div>')),

                                        Grid::make(4)
                                            ->schema([

                                                ToggleButtons::make('tdk_hp_id')
                                                    ->label('Apakah memiliki nomor handphone?')
                                                    ->live()
                                                    ->inline()
                                                    ->grouped()
                                                    ->boolean()
                                                    ->options(YaTidak::whereIsActive(1)->pluck('ya_tidak', 'id')),

                                            ]),

                                        Grid::make(4)
                                            ->schema([

                                                TextInput::make('nomor_handphone')
                                                    ->label('No. Handphone')
                                                    ->helperText('Contoh: 82187782223')
                                                    // ->mask('82187782223')
                                                    ->prefix('+62')
                                                    ->tel()
                                                    //->default('82187782223')
                                                    ->telRegex('/^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\.\/0-9]*$/')
                                                    ->required()
                                                    ->hidden(fn(Get $get) =>
                                                    $get('tdk_hp_id') != 1),

                                            ]),

                                        Grid::make(4)
                                            ->schema([

                                                TextInput::make('email')
                                                    ->label('Email')
                                                    //->default('mail@mail.com')
                                                    ->email(),
                                            ]),

                                        Placeholder::make('')
                                            ->content(new HtmlString('<div class="border-b"></div>')),

                                        Grid::make(2)
                                            ->schema([

                                                ToggleButtons::make('ps_mendaftar_keinginan_id')
                                                    ->label('Mendaftar atas kenginginan')
                                                    ->inline()
                                                    ->options(MendaftarKeinginan::whereIsActive(1)->pluck('mendaftar_keinginan', 'id'))
                                                    ->live(),

                                            ]),

                                        Grid::make(4)
                                            ->schema([

                                                TextInput::make('ps_mendaftar_keinginan_lainnya')
                                                    ->label('Lainnya')
                                                    ->required()
                                                    //->default('asdasf')
                                                    ->hidden(fn(Get $get) =>
                                                    $get('ps_mendaftar_keinginan_id') != 4),
                                            ]),

                                        Placeholder::make('')
                                            ->content(new HtmlString('<div class="border-b"></div>')),

                                        Hidden::make('aktivitaspend_id')
                                            ->default(9),

                                        Grid::make(2)
                                            ->schema([

                                                ToggleButtons::make('bya_sklh_id')
                                                    ->label('Yang membiayai sekolah')
                                                    ->inline()
                                                    ->options(MembiayaiSekolah::whereIsActive(1)->pluck('membiayai_sekolah', 'id'))
                                                    ->live(),

                                            ]),

                                        Grid::make(4)
                                            ->schema([

                                                TextInput::make('bya_sklh_lainnya')
                                                    ->label('Yang membiayai sekolah lainnya')
                                                    ->required()
                                                    //->default('asfasdad')
                                                    ->hidden(fn(Get $get) =>
                                                    $get('bya_sklh_id') != 4),
                                            ]),

                                        Placeholder::make('')
                                            ->content(new HtmlString('<div class="border-b"></div>')),

                                        Grid::make(4)
                                            ->schema([

                                                ToggleButtons::make('belum_nisn_id')
                                                    ->label('Apakah memiliki NISN?')
                                                    ->helperText(new HtmlString('<strong>NISN</strong> adalah Nomor Induk Siswa Nasional'))
                                                    ->live()
                                                    ->inline()
                                                    ->grouped()
                                                    ->boolean()
                                                    ->options(YaTidak::whereIsActive(1)->pluck('ya_tidak', 'id')),

                                                TextInput::make('nisn')
                                                    ->label('Nomor NISN')
                                                    ->required()
                                                    //->default('2421324')
                                                    ->hidden(fn(Get $get) =>
                                                    $get('belum_nisn_id') != 1),
                                            ]),

                                        Grid::make(4)
                                            ->schema([

                                                ToggleButtons::make('nomor_kip_memiliki_id')
                                                    ->label('Apakah memiliki KIP?')
                                                    ->helperText(new HtmlString('<strong>KIP</strong> adalah Kartu Indonesia Pintar'))
                                                    ->live()
                                                    ->inline()
                                                    ->grouped()
                                                    ->boolean()
                                                    ->options(YaTidak::whereIsActive(1)->pluck('ya_tidak', 'id')),

                                                TextInput::make('nomor_kip')
                                                    ->label('Nomor KIP')
                                                    ->required()
                                                    //->default('32524324')
                                                    ->hidden(fn(Get $get) =>
                                                    $get('nomor_kip_memiliki_id') != 1),
                                            ]),

                                        Placeholder::make('')
                                            ->content(new HtmlString('<div class="border-b"></div>')),

                                        Grid::make(2)
                                            ->schema([

                                                Textarea::make('ps_peng_pend_agama')
                                                    ->label('Pengalaman pendidikan agama')
                                                    ->required(),

                                            ]),

                                        Grid::make(2)
                                            ->schema([

                                                Textarea::make('ps_peng_pend_formal')
                                                    ->label('Pengalaman pendidikan formal')
                                                    ->required(),
                                            ]),

                                        Grid::make(4)
                                            ->schema([

                                                Select::make('hafalan_id')
                                                    ->label('Hafalan')
                                                    ->placeholder('Jumlah Hafalan dalam Hitungan Juz')
                                                    ->options(Hafalan::whereIsActive(1)->pluck('hafalan', 'id'))
                                                    ->required()
                                                    ->suffix('juz')
                                                    ->hidden(fn(Get $get) =>
                                                    $get('qism_id') == 1)
                                                    ->native(false),

                                            ]),

                                        Placeholder::make('')
                                            ->content(new HtmlString('<div class="border-b"></div>')),

                                        // ALAMAT SANTRI
                                        Placeholder::make('')
                                            ->content(new HtmlString('<div class="border-b">
                                                <p class="text-lg">TEMPAT TINGGAL DOMISILI</p>
                                                <p class="text-lg">SANTRI</p>
                                            </div>')),

                                        Grid::make(2)
                                            ->schema([

                                                ToggleButtons::make('al_s_status_mukim_id')
                                                    ->label('Apakah mukim di Pondok?')
                                                    ->helperText(new HtmlString('Pilih <strong>Tidak Mukim</strong> khusus bagi pendaftar <strong>Tarbiyatul Aulaad</strong> dan <strong>Pra Tahfidz kelas 1-4</strong>'))
                                                    ->live()
                                                    ->inline()
                                                    ->required()
                                                    ->default(function (Get $get) {

                                                        $qism = $get('qism_id');

                                                        $kelas = $get('kelas_id');

                                                        if ($qism == 1) {

                                                            return 2;
                                                        } elseif ($qism == 2 && $kelas == 1) {

                                                            return 2;
                                                        } elseif ($qism == 2 && $kelas == 1) {

                                                            return 2;
                                                        } elseif ($qism == 2 && $kelas == 2) {

                                                            return 2;
                                                        } elseif ($qism == 2 && $kelas == 3) {

                                                            return 2;
                                                        } elseif ($qism == 2 && $kelas == 4) {

                                                            return 2;
                                                        } else {
                                                            return 1;
                                                        }
                                                    })
                                                    ->options(function (Get $get) {

                                                        $qism = $get('qism_id');

                                                        $kelas = $get('kelas_id');

                                                        if ($qism == 1) {

                                                            return ([
                                                                2 => 'Tidak Mukim'
                                                            ]);
                                                        } elseif ($qism == 2 && $kelas == 1) {

                                                            return ([
                                                                2 => 'Tidak Mukim',
                                                            ]);
                                                        } elseif ($qism == 2 && $kelas == 1) {

                                                            return ([
                                                                2 => 'Tidak Mukim',
                                                            ]);
                                                        } elseif ($qism == 2 && $kelas == 2) {

                                                            return ([
                                                                2 => 'Tidak Mukim',
                                                            ]);
                                                        } elseif ($qism == 2 && $kelas == 3) {

                                                            return ([
                                                                2 => 'Tidak Mukim',
                                                            ]);
                                                        } elseif ($qism == 2 && $kelas == 4) {

                                                            return ([
                                                                2 => 'Tidak Mukim',
                                                            ]);
                                                        } else {
                                                            return ([

                                                                1 => 'Mukim',
                                                            ]);
                                                        }
                                                    })
                                                    ->afterStateUpdated(function (Get $get, Set $set) {
                                                        if ($get('al_s_status_mukim_id') == 1) {

                                                            $set('al_s_stts_tptgl_id', 10);
                                                        } elseif ($get('al_s_status_mukim_id') == 2) {

                                                            $set('al_s_stts_tptgl_id', null);
                                                        }
                                                    }),

                                            ]),

                                        Grid::make(4)
                                            ->schema([

                                                Select::make('al_s_stts_tptgl_id')
                                                    ->label('Status tempat tinggal')
                                                    ->placeholder('Status tempat tinggal')
                                                    ->options(function (Get $get) {
                                                        if ($get('al_s_status_mukim_id') == 2) {
                                                            return (StatusTempatTinggal::whereIsActive(1)->pluck('status_tempat_tinggal', 'id'));
                                                        }
                                                    })
                                                    // ->searchable()
                                                    ->required()
                                                    //->default('Kontrak/Kost')
                                                    ->hidden(fn(Get $get) =>
                                                    $get('al_s_status_mukim_id') == 1)
                                                    ->live()
                                                    ->native(false)
                                                    ->dehydrated(),

                                            ]),

                                        Grid::make(4)
                                            ->schema([

                                                Select::make('al_s_provinsi_id')
                                                    ->label('Provinsi')
                                                    ->placeholder('Pilih Provinsi')
                                                    ->options(Provinsi::all()->pluck('provinsi', 'id'))
                                                    // ->searchable()
                                                    //->default('35')
                                                    ->required()
                                                    ->live()
                                                    ->native(false)
                                                    ->hidden(
                                                        fn(Get $get) =>
                                                        $get('al_s_status_mukim_id') != 2 ||
                                                            $get('al_s_stts_tptgl_id') == 1 ||
                                                            $get('al_s_stts_tptgl_id') == 2 ||
                                                            $get('al_s_stts_tptgl_id') == 3 ||
                                                            $get('al_s_stts_tptgl_id') == null
                                                    )
                                                    ->afterStateUpdated(function (Set $set) {
                                                        $set('al_s_kabupaten_id', null);
                                                        $set('al_s_kecamatan_id', null);
                                                        $set('al_s_kelurahan_id', null);
                                                        $set('al_s_kodepos', null);
                                                    }),

                                                Select::make('al_s_kabupaten_id')
                                                    ->label('Kabupaten')
                                                    ->placeholder('Pilih Kabupaten')
                                                    ->options(fn(Get $get): Collection => Kabupaten::query()
                                                        ->where('provinsi_id', $get('al_s_provinsi_id'))
                                                        ->pluck('kabupaten', 'id'))
                                                    // ->searchable()
                                                    ->required()
                                                    //->default('232')
                                                    ->live()
                                                    ->native(false)
                                                    ->hidden(
                                                        fn(Get $get) =>
                                                        $get('al_s_status_mukim_id') != 2 ||
                                                            $get('al_s_stts_tptgl_id') == 1 ||
                                                            $get('al_s_stts_tptgl_id') == 2 ||
                                                            $get('al_s_stts_tptgl_id') == 3 ||
                                                            $get('al_s_stts_tptgl_id') == null
                                                    ),

                                            ]),

                                        Grid::make(4)
                                            ->schema([

                                                Select::make('al_s_kecamatan_id')
                                                    ->label('Kecamatan')
                                                    ->placeholder('Pilih Kecamatan')
                                                    ->options(fn(Get $get): Collection => Kecamatan::query()
                                                        ->where('kabupaten_id', $get('al_s_kabupaten_id'))
                                                        ->pluck('kecamatan', 'id'))
                                                    // ->searchable()
                                                    ->required()
                                                    //->default('3617')
                                                    ->live()
                                                    ->native(false)
                                                    ->hidden(
                                                        fn(Get $get) =>
                                                        $get('al_s_status_mukim_id') != 2 ||
                                                            $get('al_s_stts_tptgl_id') == 1 ||
                                                            $get('al_s_stts_tptgl_id') == 2 ||
                                                            $get('al_s_stts_tptgl_id') == 3 ||
                                                            $get('al_s_stts_tptgl_id') == null
                                                    ),

                                                Select::make('al_s_kelurahan_id')
                                                    ->label('Kelurahan')
                                                    ->placeholder('Pilih Kelurahan')
                                                    ->options(fn(Get $get): Collection => Kelurahan::query()
                                                        ->where('kecamatan_id', $get('al_s_kecamatan_id'))
                                                        ->pluck('kelurahan', 'id'))
                                                    // ->searchable()
                                                    ->required()
                                                    //->default('45322')
                                                    ->live()
                                                    ->native(false)
                                                    ->hidden(
                                                        fn(Get $get) =>
                                                        $get('al_s_status_mukim_id') != 2 ||
                                                            $get('al_s_stts_tptgl_id') == 1 ||
                                                            $get('al_s_stts_tptgl_id') == 2 ||
                                                            $get('al_s_stts_tptgl_id') == 3 ||
                                                            $get('al_s_stts_tptgl_id') == null
                                                    )
                                                    ->afterStateUpdated(function (Get $get, ?string $state, Set $set, ?string $old) {

                                                        $kodepos = Kodepos::where('kelurahan_id', $state)->get('kodepos');

                                                        $state = $kodepos;

                                                        foreach ($state as $state) {
                                                            $set('al_s_kodepos', Str::substr($state, 12, 5));
                                                        }
                                                    }),

                                            ]),

                                        Grid::make(4)
                                            ->schema([

                                                TextInput::make('al_s_kodepos')
                                                    ->label('Kodepos')
                                                    ->disabled()
                                                    ->required()
                                                    ->dehydrated()
                                                    //->default('63264')
                                                    ->hidden(
                                                        fn(Get $get) =>
                                                        $get('al_s_status_mukim_id') != 2 ||
                                                            $get('al_s_stts_tptgl_id') == 1 ||
                                                            $get('al_s_stts_tptgl_id') == 2 ||
                                                            $get('al_s_stts_tptgl_id') == 3 ||
                                                            $get('al_s_stts_tptgl_id') == null
                                                    ),

                                            ]),

                                        Grid::make(4)
                                            ->schema([


                                                TextInput::make('al_s_rt')
                                                    ->label('RT')
                                                    ->helperText('Isi 0 jika tidak ada RT/RW')
                                                    ->required()
                                                    ->numeric()
                                                    ->disabled(fn(Get $get) =>
                                                    $get('al_s_kodepos') == null)
                                                    //->default('2')
                                                    ->hidden(
                                                        fn(Get $get) =>
                                                        $get('al_s_status_mukim_id') != 2 ||
                                                            $get('al_s_stts_tptgl_id') == 1 ||
                                                            $get('al_s_stts_tptgl_id') == 2 ||
                                                            $get('al_s_stts_tptgl_id') == 3 ||
                                                            $get('al_s_stts_tptgl_id') == null
                                                    ),

                                                TextInput::make('al_s_rw')
                                                    ->label('RW')
                                                    ->helperText('Isi 0 jika tidak ada RT/RW')
                                                    ->required()
                                                    ->numeric()
                                                    ->disabled(fn(Get $get) =>
                                                    $get('al_s_kodepos') == null)
                                                    //->default('2')
                                                    ->hidden(
                                                        fn(Get $get) =>
                                                        $get('al_s_status_mukim_id') != 2 ||
                                                            $get('al_s_stts_tptgl_id') == 1 ||
                                                            $get('al_s_stts_tptgl_id') == 2 ||
                                                            $get('al_s_stts_tptgl_id') == 3 ||
                                                            $get('al_s_stts_tptgl_id') == null
                                                    ),

                                            ]),

                                        Grid::make(2)
                                            ->schema([

                                                Textarea::make('al_s_alamat')
                                                    ->label('Alamat')
                                                    ->required()
                                                    ->disabled(fn(Get $get) =>
                                                    $get('al_s_kodepos') == null)
                                                    //->default('sdfsdasdada')
                                                    ->hidden(
                                                        fn(Get $get) =>
                                                        $get('al_s_status_mukim_id') != 2 ||
                                                            $get('al_s_stts_tptgl_id') == 1 ||
                                                            $get('al_s_stts_tptgl_id') == 2 ||
                                                            $get('al_s_stts_tptgl_id') == 3 ||
                                                            $get('al_s_stts_tptgl_id') == null
                                                    ),

                                            ]),

                                        Grid::make(4)
                                            ->schema([
                                                Select::make('al_s_jarak_id')
                                                    ->label('Jarak tempat tinggal ke Pondok Pesantren')
                                                    ->options(Jarakpp::whereIsActive(1)->pluck('jarak_kepp', 'id'))
                                                    // ->searchable()
                                                    ->required()
                                                    //->default('Kurang dari 5 km')
                                                    ->live()
                                                    ->native(false)
                                                    ->hidden(
                                                        fn(Get $get) =>
                                                        $get('al_s_status_mukim_id') != 2 ||
                                                            $get('al_s_stts_tptgl_id') == null
                                                    ),

                                                Select::make('al_s_transportasi_id')
                                                    ->label('Transportasi ke Pondok Pesantren')
                                                    ->options(Transpp::whereIsActive(1)->pluck('transportasi_kepp', 'id'))
                                                    // ->searchable()
                                                    ->required()
                                                    //->default('Ojek')
                                                    ->live()
                                                    ->native(false)
                                                    ->hidden(
                                                        fn(Get $get) =>
                                                        $get('al_s_status_mukim_id') != 2 ||
                                                            $get('al_s_stts_tptgl_id') == null
                                                    ),

                                            ]),

                                        Grid::make(4)
                                            ->schema([

                                                Select::make('al_s_waktu_tempuh_id')
                                                    ->label('Waktu tempuh ke Pondok Pesantren')
                                                    ->options(Waktutempuh::whereIsActive(1)->pluck('waktu_tempuh', 'id'))
                                                    // ->searchable()
                                                    ->required()
                                                    //->default('10 - 19 menit')
                                                    ->live()
                                                    ->native(false)
                                                    ->hidden(
                                                        fn(Get $get) =>
                                                        $get('al_s_status_mukim_id') != 2 ||
                                                            $get('al_s_stts_tptgl_id') == null
                                                    ),

                                                TextInput::make('al_s_koordinat')
                                                    ->label('Titik koordinat tempat tinggal')
                                                    //->default('sfasdadasdads')
                                                    ->hidden(
                                                        fn(Get $get) =>
                                                        $get('al_s_status_mukim_id') != 2 ||
                                                            $get('al_s_stts_tptgl_id') == null
                                                    ),
                                            ]),
                                    ]),

                                // end of Section 2

                                Section::make('3. KUESIONER KEGIATAN HARIAN')
                                    ->schema([

                                        Placeholder::make('')
                                            ->content(new HtmlString('<div class="border-b">
                                                    <p class="text-lg">KUESIONER KEGIATAN HARIAN</p>
                                                </div>')),
                                        Grid::make(2)
                                            ->schema([

                                                ToggleButtons::make('ps_kkh_keberadaan_id')
                                                    ->label('1. Di mana saat ini ananda berada?')
                                                    ->live()
                                                    ->inline()
                                                    ->options(AnandaBerada::whereIsActive(1)->pluck('ananda_berada', 'id')),
                                            ]),

                                        Grid::make(2)
                                            ->schema([

                                                TextArea::make('ps_kkh_keberadaan_nama_mhd')
                                                    ->label('Nama Mahad')
                                                    ->required()
                                                    //->default('sadads')
                                                    ->hidden(
                                                        fn(Get $get) =>
                                                        $get('ps_kkh_keberadaan_id') != 2
                                                    ),

                                            ]),

                                        Grid::make(2)
                                            ->schema([

                                                TextArea::make('ps_kkh_keberadaan_lokasi_mhd')
                                                    ->label('Lokasi Mahad')
                                                    ->required()
                                                    //->default('sadads')
                                                    ->hidden(
                                                        fn(Get $get) =>
                                                        $get('ps_kkh_keberadaan_id') != 2
                                                    ),

                                            ]),

                                        Grid::make(2)
                                            ->schema([

                                                TextArea::make('ps_kkh_keberadaan_rumah_keg')
                                                    ->label('Jika dirumah, apa kegiatan ananda selama waktu tersebut?')
                                                    //->default('asfsadsa')
                                                    ->required()
                                                    ->hidden(
                                                        fn(Get $get) =>
                                                        $get('ps_kkh_keberadaan_id') != 1
                                                    ),

                                            ]),

                                        Grid::make(2)
                                            ->schema([

                                                ToggleButtons::make('ps_kkh_fasilitas_gawai_id')
                                                    ->label('2. Apakah selama di rumah (baik bagi yg dirumah, atau bagi yang di Mahad ketika liburan), ananda difasilitasi HP atau laptop (baik dengan memiliki sendiri HP/ laptop dan yang sejenis atau dipinjami orang tua)?')
                                                    // ->helperText(new HtmlString('<strong>KIP</strong> adalah Kartu Indonesia Pintar'))
                                                    ->live()
                                                    ->inline()
                                                    ->grouped()
                                                    ->boolean()
                                                    ->options(YaTidak::whereIsActive(1)->pluck('ya_tidak', 'id')),

                                            ]),

                                        Grid::make(2)
                                            ->schema([

                                                TextArea::make('ps_kkh_fasilitas_gawai_medsos')
                                                    ->label('Apakah ananda memiliki akun medsos (media sosial)?')
                                                    ->required()
                                                    //->default('Ya')
                                                    ->hidden(
                                                        fn(Get $get) =>
                                                        $get('ps_kkh_fasilitas_gawai_id') != 1
                                                    ),

                                            ]),

                                        Grid::make(2)
                                            ->schema([

                                                TextArea::make('ps_kkh_fasilitas_gawai_medsos_daftar')
                                                    ->label('Akun medsos apa saja yang ananda miliki?')
                                                    ->required()
                                                    //->default('asfdads')
                                                    ->hidden(
                                                        fn(Get $get) =>
                                                        $get('ps_kkh_fasilitas_gawai_id') != 1
                                                    ),

                                            ]),

                                        Grid::make(2)
                                            ->schema([

                                                TextArea::make('ps_kkh_fasilitas_gawai_medsos_aktif')
                                                    ->label('Apakah akun tersebut masih aktif hingga sekarang?')
                                                    ->required()
                                                    //->default('asdafs')
                                                    ->hidden(
                                                        fn(Get $get) =>
                                                        $get('ps_kkh_fasilitas_gawai_id') != 1
                                                    ),

                                            ]),

                                        Grid::make(2)
                                            ->schema([

                                                ToggleButtons::make('ps_kkh_fasilitas_gawai_medsos_menutup_id')
                                                    ->label('Apakah bersedia menutup akun tersebut selama menjadi santri/santriwati?')
                                                    // ->helperText(new HtmlString('<strong>KIP</strong> adalah Kartu Indonesia Pintar'))
                                                    ->inline()
                                                    ->options(BersediaTidak::whereIsActive(1)->pluck('bersedia_tidak', 'id'))
                                                    ->hidden(
                                                        fn(Get $get) =>
                                                        $get('ps_kkh_fasilitas_gawai_id') != 1
                                                    ),
                                            ]),

                                        Grid::make(2)
                                            ->schema([

                                                ToggleButtons::make('ps_kkh_medsos_sering_id')
                                                    ->label('3. Dari medsos berikut, manakah yang sering digunakan ananda?')
                                                    // ->helperText(new HtmlString('<strong>KIP</strong> adalah Kartu Indonesia Pintar'))
                                                    // ->live()
                                                    ->multiple()
                                                    ->options(MedsosAnanda::whereIsActive(1)->pluck('medsos_ananda', 'id'))
                                                    ->required(),

                                            ]),

                                        Grid::make(2)
                                            ->schema([

                                                ToggleButtons::make('ps_kkh_medsos_group_id')
                                                    ->label('4. Apakah ananda tergabung dalam grup yang ada pada medsos tersebut?')
                                                    // ->helperText(new HtmlString('<strong>KIP</strong> adalah Kartu Indonesia Pintar'))
                                                    ->live()
                                                    ->inline()
                                                    ->grouped()
                                                    ->boolean()
                                                    ->options(YaTidak::whereIsActive(1)->pluck('ya_tidak', 'id')),

                                            ]),

                                        Grid::make(2)
                                            ->schema([

                                                TextArea::make('ps_kkh_medsos_group_nama')
                                                    ->label('Mohon dijelaskan nama grup dan bidang kegiatannya')
                                                    ->required()
                                                    //->default('asdadasdads')
                                                    ->hidden(
                                                        fn(Get $get) =>
                                                        $get('ps_kkh_medsos_group_id') != 1
                                                    ),

                                            ]),

                                        Grid::make(2)
                                            ->schema([

                                                TextArea::make('ps_kkh_bacaan')
                                                    ->label('5. Apa saja buku bacaan yang disukai atau sering dibaca ananda?')
                                                    ->helperText('Mohon dijelaskan jenis bacaannya')
                                                    //->default('asdads')
                                                    ->required(),

                                            ]),

                                        Grid::make(2)
                                            ->schema([

                                                TextArea::make('ps_kkh_bacaan_cara_dapat')
                                                    ->label('Bagaimana cara mendapatkan bacaan tersebut? (Via online atau membeli sendiri)')
                                                    //->default('assad')
                                                    ->required(),
                                            ]),


                                    ]),
                                // end of Section 3

                                Section::make('4. KUESIONER KESEHATAN')
                                    ->schema([

                                        Placeholder::make('')
                                            ->content(new HtmlString('<div class="border-b">
                                                    <p class="text-lg">KUESIONER KESEHATAN</p>
                                                </div>')),
                                        Grid::make(2)
                                            ->schema([

                                                ToggleButtons::make('ps_kkes_sakit_serius_id')
                                                    ->label('1. Apakah ananda pernah mengalami sakit yang cukup serius?')
                                                    ->live()
                                                    ->inline()
                                                    ->grouped()
                                                    ->boolean()
                                                    ->options(YaTidak::whereIsActive(1)->pluck('ya_tidak', 'id')),
                                            ]),

                                        Grid::make(2)
                                            ->schema([
                                                TextArea::make('ps_kkes_sakit_serius_nama_penyakit')
                                                    ->label('Jika iya, kapan dan penyakit apa?')
                                                    ->required()
                                                    //->default('asdad')
                                                    ->hidden(
                                                        fn(Get $get) =>
                                                        $get('ps_kkes_sakit_serius_id') != 1
                                                    ),

                                            ]),

                                        Grid::make(2)
                                            ->schema([

                                                ToggleButtons::make('ps_kkes_terapi_id')
                                                    ->label('2. Apakah ananda pernah atau sedang menjalani terapi kesehatan?')
                                                    ->live()
                                                    ->inline()
                                                    ->grouped()
                                                    ->boolean()
                                                    ->options(YaTidak::whereIsActive(1)->pluck('ya_tidak', 'id')),

                                            ]),

                                        Grid::make(2)
                                            ->schema([

                                                TextArea::make('ps_kkes_terapi_nama_terapi')
                                                    ->label('Jika iya, kapan dan terapi apa?')
                                                    ->required()
                                                    //->default('asdasd')
                                                    ->hidden(
                                                        fn(Get $get) =>
                                                        $get('ps_kkes_terapi_id') != 1
                                                    ),

                                            ]),

                                        Grid::make(2)
                                            ->schema([

                                                ToggleButtons::make('ps_kkes_kambuh_id')
                                                    ->label('3. Apakah ananda memiliki penyakit yang dapat/sering kambuh?')
                                                    ->live()
                                                    ->inline()
                                                    ->grouped()
                                                    ->boolean()
                                                    ->options(YaTidak::whereIsActive(1)->pluck('ya_tidak', 'id')),

                                            ]),

                                        Grid::make(2)
                                            ->schema([

                                                TextArea::make('ps_kkes_kambuh_nama_penyakit')
                                                    ->label('Jika iya, penyakit apa?')
                                                    ->required()
                                                    //->default('asdad')
                                                    ->hidden(
                                                        fn(Get $get) =>
                                                        $get('ps_kkes_kambuh_id') != 1
                                                    ),

                                            ]),

                                        Grid::make(2)
                                            ->schema([

                                                ToggleButtons::make('ps_kkes_alergi_id')
                                                    ->label('4. Apakah ananda memiliki alergi terhadap perkara-perkara tertentu?')
                                                    ->live()
                                                    ->inline()
                                                    ->grouped()
                                                    ->boolean()
                                                    ->options(YaTidak::whereIsActive(1)->pluck('ya_tidak', 'id')),

                                            ]),

                                        Grid::make(2)
                                            ->schema([

                                                TextArea::make('ps_kkes_alergi_nama_alergi')
                                                    ->label('Jika iya, sebutkan!')
                                                    ->required()
                                                    //->default('asdadsd')
                                                    ->hidden(
                                                        fn(Get $get) =>
                                                        $get('ps_kkes_alergi_id') != 1
                                                    ),

                                            ]),

                                        Grid::make(2)
                                            ->schema([

                                                ToggleButtons::make('ps_kkes_pantangan_id')
                                                    ->label('5. Apakah ananda mempunyai pantangan yang berkaitan dengan kesehatan?')
                                                    ->live()
                                                    ->inline()
                                                    ->grouped()
                                                    ->boolean()
                                                    ->options(YaTidak::whereIsActive(1)->pluck('ya_tidak', 'id')),

                                            ]),

                                        Grid::make(2)
                                            ->schema([

                                                TextArea::make('ps_kkes_pantangan_nama')
                                                    ->label('Jika iya, sebutkan dan jelaskan alasannya!')
                                                    ->required()
                                                    //->default('asdadssad')
                                                    ->hidden(
                                                        fn(Get $get) =>
                                                        $get('ps_kkes_pantangan_id') != 1
                                                    ),

                                            ]),

                                        Grid::make(2)
                                            ->schema([

                                                ToggleButtons::make('ps_kkes_psikologis_id')
                                                    ->label('6. Apakah ananda pernah mengalami gangguan psikologis (depresi dan gejala-gejalanya)?')
                                                    ->live()
                                                    ->inline()
                                                    ->grouped()
                                                    ->boolean()
                                                    ->options(YaTidak::whereIsActive(1)->pluck('ya_tidak', 'id')),

                                            ]),

                                        Grid::make(2)
                                            ->schema([

                                                TextArea::make('ps_kkes_psikologis_kapan')
                                                    ->label('Jika iya, kapan?')
                                                    ->required()
                                                    //->default('asdad')
                                                    ->hidden(
                                                        fn(Get $get) =>
                                                        $get('ps_kkes_psikologis_id') != 1
                                                    ),

                                            ]),

                                        Grid::make(2)
                                            ->schema([

                                                ToggleButtons::make('ps_kkes_gangguan_id')
                                                    ->label('7. Apakah ananda pernah mengalami gangguan jin?')
                                                    ->live()
                                                    ->inline()
                                                    ->grouped()
                                                    ->boolean()
                                                    ->options(YaTidak::whereIsActive(1)->pluck('ya_tidak', 'id')),

                                            ]),

                                        Grid::make(2)
                                            ->schema([
                                                TextArea::make('ps_kkes_gangguan_kapan')
                                                    ->label('Jika iya, kapan?')
                                                    ->required()
                                                    //->default('asdadsad')
                                                    ->hidden(
                                                        fn(Get $get) =>
                                                        $get('ps_kkes_gangguan_id') != 1
                                                    ),

                                            ]),
                                    ]),
                                // end of Section 4

                                Section::make('5. KUESIONER KEMANDIRIAN')
                                    ->hidden(function (Get $get) {
                                        $qism = $get('qism_id');
                                        $kelas = $get('kelas_id');

                                        if ($qism == 1) {
                                            return false;
                                        } elseif ($qism == 2 && $kelas == 1) {
                                            return false;
                                        } elseif ($qism == 2 && $kelas == 2) {
                                            return false;
                                        } elseif ($qism == 2 && $kelas == 3) {
                                            return false;
                                        } elseif ($qism == 2 && $kelas == 4) {
                                            return false;
                                        } else {
                                            return true;
                                        }
                                    })
                                    ->schema([

                                        Placeholder::make('')
                                            ->content(new HtmlString('<div class="border-b">
                                                    <p class="text-lg">KUESIONER KEMANDIRIAN</p>
                                                </div>')),
                                        Grid::make(2)
                                            ->schema([

                                                ToggleButtons::make('ps_kkm_bak_id')
                                                    ->label('1. Apakah ananda sudah bisa BAK sendiri?')
                                                    ->required()
                                                    ->required()
                                                    ->inline()
                                                    ->grouped()
                                                    ->boolean()
                                                    ->options(YaTidak::whereIsActive(1)->pluck('ya_tidak', 'id')),

                                            ]),

                                        Grid::make(2)
                                            ->schema([

                                                ToggleButtons::make('ps_kkm_bab_id')
                                                    ->label('2. Apakah ananda sudah bisa BAB sendiri?')
                                                    ->required()
                                                    ->inline()
                                                    ->grouped()
                                                    ->boolean()
                                                    ->options(YaTidak::whereIsActive(1)->pluck('ya_tidak', 'id')),

                                            ]),

                                        Grid::make(2)
                                            ->schema([

                                                ToggleButtons::make('ps_kkm_cebok_id')
                                                    ->label('3. Apakah ananda sudah bisa cebok sendiri?')
                                                    ->required()
                                                    ->inline()
                                                    ->grouped()
                                                    ->boolean()
                                                    ->options(YaTidak::whereIsActive(1)->pluck('ya_tidak', 'id')),

                                            ]),

                                        Grid::make(2)
                                            ->schema([

                                                ToggleButtons::make('ps_kkm_ngompol_id')
                                                    ->label('4. Apakah ananda masih mengompol?')
                                                    ->required()
                                                    ->inline()
                                                    ->grouped()
                                                    ->boolean()
                                                    ->options(YaTidak::whereIsActive(1)->pluck('ya_tidak', 'id')),

                                            ]),

                                        Grid::make(2)
                                            ->schema([

                                                ToggleButtons::make('ps_kkm_disuapin_id')
                                                    ->label('5. Apakah makan ananda masih disuapi?')
                                                    ->required()
                                                    ->inline()
                                                    ->grouped()
                                                    ->boolean()
                                                    ->options(YaTidak::whereIsActive(1)->pluck('ya_tidak', 'id')),

                                            ]),
                                    ]),
                                // end of Section 5

                                Section::make('6. KUESIONER KEMAMPUAN PEMBAYARAN ADMINISTRASI')
                                    ->schema([

                                        Placeholder::make('')
                                            ->content(new HtmlString('<div>
                                                    <p class="text-lg strong"><strong>KUESIONER KEMAMPUAN PEMBAYARAN ADMINISTRASI</strong></p>
                                                </div>')),

                                        Placeholder::make('')
                                            ->content(new HtmlString('<div class="border-b">
                                                    <p class="text-lg strong"><strong>RINCIAN BIAYA AWAL DAN SPP</strong></p>
                                                </div>')),

                                        Placeholder::make('')
                                            ->content(function (Get $get) {
                                                if ($get('qism_id') == 1) {
                                                    return (new HtmlString(
                                                        '<div class="grid grid-cols-1 justify-center">
                                                                            <div class="border rounded-xl p-4">
                                                                            <table>
                                                                                <!-- head -->
                                                                                <thead>
                                                                                    <tr class="border-b">
                                                                                        <th class="text-lg text-tsn-header" colspan="4">QISM TARBIYATUL AULAAD</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                            <!-- row 1 -->
                                                                            <tr>
                                                                                <th class="text-start">Uang Pendaftaran     </th>
                                                                                <td class="text-end">Rp.</td>
                                                                                <td class="text-end">50.000</td>
                                                                                <td class="text-end">(per tahun)</td>
                                                                            </tr>
                                                                            <!-- row 2 -->
                                                                            <tr>
                                                                                <th class="text-start">Uang Gedung      </th>
                                                                                <td class="text-end">Rp.</td>
                                                                                <td class="text-end">150.000</td>
                                                                                <td class="text-end">(per tahun)</td>
                                                                            </tr>
                                                                            <!-- row 3 -->
                                                                            <tr>
                                                                                <th class="text-start">Uang Sarpras     </th>
                                                                                <td class="text-end">Rp.</td>
                                                                                <td class="text-end">100.000</td>
                                                                                <td class="text-end">(per tahun)</td>
                                                                            </tr>
                                                                            <!-- row 4 -->
                                                                            <tr class="border-tsn-header">
                                                                                <th class="text-start">SPP*     </th>
                                                                                <td class="text-end">Rp.</td>
                                                                                <td class="text-end">75.000</td>
                                                                                <td class="text-end">(per bulan)</td>
                                                                            </tr>
                                                                            <tr class="border-t">
                                                                                <th>Total       </th>
                                                                                <td class="text-end"><strong>Rp.</strong></td>
                                                                                <td class="text-end"><strong>375.000</strong></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="text-sm" colspan="4">*Pembayaran administrasi awal termasuk SPP bulan pertama</td>
                                                                            </tr>
                                                                            </tbody>
                                                                                </table>
                                                                            </div>
                                                                            </div>'
                                                    ));
                                                } elseif ($get('qism_id') == 2) {
                                                    return (new HtmlString(
                                                        '<div class="grid grid-cols-1 justify-center">
                                                                            <div class="border rounded-xl p-4">
                                                                            <table>
                                                                                <!-- head -->
                                                                                <thead>
                                                                                    <tr class="border-b">
                                                                                        <th class="text-lg text-tsn-header" colspan="4">QISM PRA TAHFIDZ-FULLDAY (tanpa makan)</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                            <!-- row 1 -->
                                                                            <tr>
                                                                                <th class="text-start">Uang Pendaftaran     </th>
                                                                                <td class="text-end">Rp.</td>
                                                                                <td class="text-end">100.000</td>
                                                                                <td class="text-end">(per tahun)</td>
                                                                            </tr>
                                                                            <!-- row 2 -->
                                                                            <tr>
                                                                                <th class="text-start">Uang Gedung      </th>
                                                                                <td class="text-end">Rp.</td>
                                                                                <td class="text-end">400.000</td>
                                                                                <td class="text-end">(per tahun)</td>
                                                                            </tr>
                                                                            <!-- row 3 -->
                                                                            <tr>
                                                                                <th class="text-start">Uang Sarpras     </th>
                                                                                <td class="text-end">Rp.</td>
                                                                                <td class="text-end">300.000</td>
                                                                                <td class="text-end">(per tahun)</td>
                                                                            </tr>
                                                                            <!-- row 4 -->
                                                                            <tr class="border-tsn-header">
                                                                                <th class="text-start">SPP*     </th>
                                                                                <td class="text-end">Rp.</td>
                                                                                <td class="text-end">200.000</td>
                                                                                <td class="text-end">(per bulan)</td>
                                                                            </tr>
                                                                            <tr class="border-t">
                                                                                <th>Total       </th>
                                                                                <td class="text-end"><strong>Rp.</strong></td>
                                                                                <td class="text-end"><strong>1.000.000</strong></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="text-sm" colspan="4">*Pembayaran administrasi awal termasuk SPP bulan pertama</td>
                                                                            </tr>
                                                                            </tbody>
                                                                                </table>
                                                                            </div>
                                
                                                                            <br>
                                
                                                                            <div class="border rounded-xl p-4">
                                                                            <table>
                                                                                <!-- head -->
                                                                                <thead>
                                                                                    <tr class="border-b">
                                                                                        <th class="text-lg text-tsn-header" colspan="4">QISM PRA TAHFIDZ-FULLDAY (dengan makan)</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                            <!-- row 1 -->
                                                                            <tr>
                                                                                <th class="text-start">Uang Pendaftaran     </th>
                                                                                <td class="text-end">Rp.</td>
                                                                                <td class="text-end">100.000</td>
                                                                                <td class="text-end">(per tahun)</td>
                                                                            </tr>
                                                                            <!-- row 2 -->
                                                                            <tr>
                                                                                <th class="text-start">Uang Gedung      </th>
                                                                                <td class="text-end">Rp.</td>
                                                                                <td class="text-end">400.000</td>
                                                                                <td class="text-end">(per tahun)</td>
                                                                            </tr>
                                                                            <!-- row 3 -->
                                                                            <tr>
                                                                                <th class="text-start">Uang Sarpras     </th>
                                                                                <td class="text-end">Rp.</td>
                                                                                <td class="text-end">300.000</td>
                                                                                <td class="text-end">(per tahun)</td>
                                                                            </tr>
                                                                            <!-- row 4 -->
                                                                            <tr class="border-tsn-header">
                                                                                <th class="text-start">SPP*     </th>
                                                                                <td class="text-end">Rp.</td>
                                                                                <td class="text-end">300.000</td>
                                                                                <td class="text-end">(per bulan)</td>
                                                                            </tr>
                                                                            <tr class="border-t">
                                                                                <th>Total       </th>
                                                                                <td class="text-end"><strong>Rp.</strong></td>
                                                                                <td class="text-end"><strong>1.100.000</strong></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="text-sm" colspan="4">*Pembayaran administrasi awal termasuk SPP bulan pertama</td>
                                                                            </tr>
                                                                            </tbody>
                                                                                </table>
                                                                            </div>
                                
                                                                            <br>
                                
                                                                            <div class="border rounded-xl p-4">
                                                                            <table>
                                                                                <!-- head -->
                                                                                <thead>
                                                                                    <tr class="border-b">
                                                                                        <th class="text-lg text-tsn-header" colspan="4">QISM PT (menginap)</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                            <!-- row 1 -->
                                                                            <tr>
                                                                                <th class="text-start">Uang Pendaftaran     </th>
                                                                                <td class="text-end">Rp.</td>
                                                                                <td class="text-end">100.000</td>
                                                                                <td class="text-end">(per tahun)</td>
                                                                            </tr>
                                                                            <!-- row 2 -->
                                                                            <tr>
                                                                                <th class="text-start">Uang Gedung      </th>
                                                                                <td class="text-end">Rp.</td>
                                                                                <td class="text-end">400.000</td>
                                                                                <td class="text-end">(per tahun)</td>
                                                                            </tr>
                                                                            <!-- row 3 -->
                                                                            <tr>
                                                                                <th class="text-start">Uang Sarpras     </th>
                                                                                <td class="text-end">Rp.</td>
                                                                                <td class="text-end">300.000</td>
                                                                                <td class="text-end">(per tahun)</td>
                                                                            </tr>
                                                                            <!-- row 4 -->
                                                                            <tr class="border-tsn-header">
                                                                                <th class="text-start">SPP*     </th>
                                                                                <td class="text-end">Rp.</td>
                                                                                <td class="text-end">550.000</td>
                                                                                <td class="text-end">(per bulan)</td>
                                                                            </tr>
                                                                            <tr class="border-t">
                                                                                <th>Total       </th>
                                                                                <td class="text-end"><strong>Rp.</strong></td>
                                                                                <td class="text-end"><strong>1.350.000</strong></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="text-sm" colspan="4">*Pembayaran administrasi awal termasuk SPP bulan pertama</td>
                                                                            </tr>
                                                                            </tbody>
                                                                                </table>
                                                                            </div>
                                                                            </div>'
                                                    ));
                                                } elseif ($get('qism_id') != 1 || $get('qism_id') != 2) {
                                                    return (new HtmlString(
                                                        '<div class="grid grid-cols-1 justify-center">
                                                                            
                                                                            <div class="border rounded-xl p-4">
                                                                            <table>
                                                                                <!-- head -->
                                                                                <thead>
                                                                                    <tr class="border-b">
                                                                                        <th class="text-lg text-tsn-header" colspan="4">QISM TQ, IDD, MTW, TN</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                            <!-- row 1 -->
                                                                            <tr>
                                                                                <th class="text-start">Uang Pendaftaran     </th>
                                                                                <td class="text-end">Rp.</td>
                                                                                <td class="text-end">100.000</td>
                                                                                <td class="text-end">(per tahun)</td>
                                                                            </tr>
                                                                            <!-- row 2 -->
                                                                            <tr>
                                                                                <th class="text-start">Uang Gedung      </th>
                                                                                <td class="text-end">Rp.</td>
                                                                                <td class="text-end">400.000</td>
                                                                                <td class="text-end">(per tahun)</td>
                                                                            </tr>
                                                                            <!-- row 3 -->
                                                                            <tr>
                                                                                <th class="text-start">Uang Sarpras     </th>
                                                                                <td class="text-end">Rp.</td>
                                                                                <td class="text-end">300.000</td>
                                                                                <td class="text-end">(per tahun)</td>
                                                                            </tr>
                                                                            <!-- row 4 -->
                                                                            <tr class="border-tsn-header">
                                                                                <th class="text-start">SPP*     </th>
                                                                                <td class="text-end">Rp.</td>
                                                                                <td class="text-end">550.000</td>
                                                                                <td class="text-end">(per bulan)</td>
                                                                            </tr>
                                                                            <tr class="border-t">
                                                                                <th>Total       </th>
                                                                                <td class="text-end"><strong>Rp.</strong></td>
                                                                                <td class="text-end"><strong>1.350.000</strong></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="text-sm" colspan="4">*Pembayaran administrasi awal termasuk SPP bulan pertama</td>
                                                                            </tr>
                                                                            </tbody>
                                                                                </table>
                                                                            </div>
                                                                            </div>'
                                                    ));
                                                }
                                            }),


                                        Grid::make(2)
                                            ->schema([

                                                ToggleButtons::make('ps_kadm_status_id')
                                                    ->label('Status anak didik terkait dengan administrasi')
                                                    ->required()
                                                    ->live()
                                                    ->options(StatusAdmPendaftar::whereIsActive(1)->pluck('status_adm_pendaftar', 'id')),

                                            ]),

                                        Grid::make(2)
                                            ->schema([

                                                Placeholder::make('')
                                                    ->content(new HtmlString('<div class="border-b">
                                                                        <p><strong>Bersedia memenuhi persyaratan sebagai berikut:</strong></p>
                                                                    </div>'))
                                                    ->hidden(
                                                        fn(Get $get) =>
                                                        $get('ps_kadm_status_id') != 2
                                                    ),

                                            ]),

                                        Grid::make(2)
                                            ->schema([

                                                ToggleButtons::make('ps_kadm_surat_subsidi_id')
                                                    ->label('1. Wali harus membuat surat permohonan subsidi/ keringanan biaya administrasi')
                                                    ->required()
                                                    ->inline()
                                                    ->options(BersediaTidak::whereIsActive(1)->pluck('bersedia_tidak', 'id'))
                                                    ->hidden(
                                                        fn(Get $get) =>
                                                        $get('ps_kadm_status_id') != 2
                                                    ),

                                            ]),

                                        Grid::make(2)
                                            ->schema([

                                                ToggleButtons::make('ps_kadm_surat_kurang_mampu_id')
                                                    ->label('2. Wali harus menyertakan surat keterangan kurang mampu')
                                                    ->helperText(' Surat keterangan kurang mampu dari ustadz salafy setempat SERTA dari aparat pemerintah setempat, yang isinya menyatakan bahwa memang keluarga tersebut "perlu dibantu"')
                                                    ->required()
                                                    ->inline()
                                                    ->options(BersediaTidak::whereIsActive(1)->pluck('bersedia_tidak', 'id'))
                                                    ->hidden(
                                                        fn(Get $get) =>
                                                        $get('ps_kadm_status_id') != 2
                                                    ),

                                            ]),

                                        Grid::make(2)
                                            ->schema([

                                                ToggleButtons::make('ps_kadm_atur_keuangan_id')
                                                    ->label('3. Keuangan ananda akan dipegang dan diatur oleh Mahad')
                                                    ->required()
                                                    ->inline()
                                                    ->options(BersediaTidak::whereIsActive(1)->pluck('bersedia_tidak', 'id'))
                                                    ->hidden(
                                                        fn(Get $get) =>
                                                        $get('ps_kadm_status_id') != 2
                                                    ),

                                            ]),

                                        Grid::make(2)
                                            ->schema([

                                                ToggleButtons::make('ps_kadm_penentuan_subsidi_id')
                                                    ->label('4. Yang menentukan bentuk keringanan yang diberikan adalah Mahad')
                                                    ->required()
                                                    ->inline()
                                                    ->options(BersediaTidak::whereIsActive(1)->pluck('bersedia_tidak', 'id'))
                                                    ->hidden(
                                                        fn(Get $get) =>
                                                        $get('ps_kadm_status_id') != 2
                                                    ),

                                            ]),

                                        Grid::make(2)
                                            ->schema([

                                                ToggleButtons::make('ps_kadm_hidup_sederhana_id')
                                                    ->label('5. Ananda harus berpola hidup sederhana agar tidak menimbulkan pertanyaan pihak luar')
                                                    ->required()
                                                    ->inline()
                                                    ->options(BersediaTidak::whereIsActive(1)->pluck('bersedia_tidak', 'id'))
                                                    ->hidden(
                                                        fn(Get $get) =>
                                                        $get('ps_kadm_status_id') != 2
                                                    ),

                                            ]),

                                        Grid::make(2)
                                            ->schema([

                                                ToggleButtons::make('ps_kadm_kebijakan_subsidi_id')
                                                    ->label('6. Kebijakan subsidi bisa berubah sewaktu waktu')
                                                    ->required()
                                                    ->inline()
                                                    ->options(BersediaTidak::whereIsActive(1)->pluck('bersedia_tidak', 'id'))
                                                    ->hidden(
                                                        fn(Get $get) =>
                                                        $get('ps_kadm_status_id') != 2
                                                    ),

                                            ]),


                                        // end of step 6
                                    ]),

                                // end of action steps
                            ])
                    ])->columnSpanFull()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordUrl(null)
            ->defaultPaginationPageOption('10')
            ->columns([

                TextColumn::make('walisantri.nama_kpl_kel_santri')
                    ->label('Walisantri')
                    ->searchable(isIndividual: true, isGlobal: false)
                    ->sortable(),

                TextColumn::make('kartu_keluarga')
                    ->label('KK')
                    ->searchable(isIndividual: true, isGlobal: false)
                    ->visible(auth()->user()->id == 1)
                    ->sortable(),

                // TextInputColumn::make('walisantri.kartu_keluarga_santri')
                //     ->label('KK'),

                TextColumn::make('nama_lengkap')
                    ->label('Santri')
                    ->searchable(isIndividual: true, isGlobal: false)
                    ->sortable(),

                TextColumn::make('qism_detail.abbr_qism_detail')
                    ->label('Qism')
                    // ->searchable(isIndividual: true, isGlobal: false)
                    ->sortable(),

                TextColumn::make('kelas.kelas')
                    ->label('Kelas')
                    ->sortable(),

                TextColumn::make('id')
                    ->label('Hubungi Walisantri')
                    ->formatStateUsing(fn(string $state): string => __("Hubungi walisantri"))
                    ->icon('heroicon-o-chat-bubble-oval-left')
                    ->iconColor('success')
                    // ->circular()
                    ->alignCenter()
                    ->url(function ($record, $state) {

                        $walisantri = Walisantri::where('id', $record->walisantri_id)->first();

                        if ($walisantri->hp_komunikasi == null) {
                            return null;
                        } elseif ($walisantri->hp_komunikasi != null) {

                            $walisantri = Walisantri::where('id', $record->walisantri_id)->first();

                            return 'https://wa.me/62' . $walisantri->hp_komunikasi;
                        }
                    })
                    ->badge()
                    ->color('success')
                    ->openUrlInNewTab(),

                TextColumn::make('walisantri.hp_komunikasi')
                    ->label('No Walisantri')
                    ->copyable()
                    ->copyableState(function ($state) {
                        return ($state);
                    })
                    ->copyMessage('Tersalin'),

                TextColumn::make('tahapPendaftaran.tahap_pendaftaran')
                    ->label('Tahap')
                    ->sortable(),

                TextColumn::make('statusPendaftaran.status_pendaftaran')
                    ->label('Status')
                    ->sortable()
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'Lolos' => 'success',
                        'Tidak Lolos' => 'danger',
                        'Diterima' => 'success',
                        'Tidak Diterima' => 'danger',
                    }),

                TextColumn::make('walisantri.is_collapse')
                    ->label('Status Data Walisantri')
                    ->default('Belum Lengkap')
                    ->size(TextColumn\TextColumnSize::Large)
                    ->weight(FontWeight::Bold)
                    ->description(fn($record): string => "Status Data Walisantri:", position: 'above')
                    ->formatStateUsing(function (Model $record) {
                        $iscollapse = Walisantri::where('id', $record->walisantri_id)->first();
                        // dd($pendaftar->ps_kadm_status);
                        if ($iscollapse->is_collapse == false) {
                            return ('Belum lengkap');
                        } elseif ($iscollapse->is_collapse == true) {
                            return ('Lengkap');
                        }
                    })
                    ->badge()
                    ->color(function (Model $record) {
                        $iscollapse = Walisantri::where('id', $record->walisantri_id)->first();
                        // dd($pendaftar->ps_kadm_status);
                        if ($iscollapse->is_collapse == false) {
                            return ('danger');
                        } elseif ($iscollapse->is_collapse == true) {
                            return ('success');
                        }
                    }),

                TextColumn::make('s_emis4')
                    ->label('Status Data Santri')
                    ->default('Belum Lengkap')
                    ->size(TextColumn\TextColumnSize::Large)
                    ->weight(FontWeight::Bold)
                    ->description(fn($record): string => "Status Data Santri:", position: 'above')
                    ->formatStateUsing(function (Model $record) {
                        if ($record->s_emis4 == false) {
                            return ('Belum lengkap');
                        } elseif ($record->s_emis4 == true) {
                            return ('Lengkap');
                        }
                    })
                    ->badge()
                    ->color(function (Model $record) {
                        if ($record->s_emis4 == false) {
                            return ('danger');
                        } elseif ($record->s_emis4 == true) {
                            return ('success');
                        }
                    }),

                TextColumn::make('file_kk')
                    ->label('1. Kartu Keluarga')
                    ->description(fn(): string => 'Kartu Keluarga', position: 'above')
                    // ->color('white')
                    ->formatStateUsing(fn(string $state): string => __("Lihat"))
                    // ->limit(1)
                    ->icon('heroicon-s-eye')
                    ->iconColor('success')
                    // ->circular()
                    ->alignCenter()
                    ->placeholder(function (Model $record) {
                        if ($record->status_pendaftaran_id == 1 || $record->status_pendaftaran_id == 3) {

                            return (new HtmlString(''));
                        } else {
                            return (new HtmlString('Belum Upload'));
                        }
                    })
                    ->url(function (Model $record) {
                        if ($record->file_kk !== null) {

                            return ("https://psb.tsn.ponpes.id/storage/" . $record->file_kk);
                        }
                    })
                    ->badge()
                    ->color('success')
                    ->openUrlInNewTab(),

                TextColumn::make('file_akte')
                    ->label('2. Akte')
                    ->description(fn(): string => 'Akte', position: 'above')
                    // ->color('white')
                    ->formatStateUsing(fn(string $state): string => __("Lihat"))
                    // ->limit(1)
                    ->icon('heroicon-s-eye')
                    ->iconColor('success')
                    // ->circular()
                    ->alignCenter()
                    ->placeholder(function (Model $record) {
                        if ($record->status_pendaftaran_id == 1 || $record->status_pendaftaran_id == 3) {

                            return (new HtmlString(''));
                        } else {
                            return (new HtmlString('Belum Upload'));
                        }
                    })
                    ->url(function (Model $record) {
                        if ($record->file_akte !== null) {

                            return ("https://psb.tsn.ponpes.id/storage/" . $record->file_akte);
                        }
                    })
                    ->badge()
                    ->color('success')
                    ->openUrlInNewTab(),

                TextColumn::make('file_srs')
                    ->label('3. Surat Rekomendasi')
                    ->description(fn(): string => 'Surat Rekomendasi', position: 'above')
                    // ->color('white')
                    ->formatStateUsing(fn(string $state): string => __("Lihat"))
                    // ->limit(1)
                    ->icon('heroicon-s-eye')
                    ->iconColor('success')
                    // ->circular()
                    ->alignCenter()
                    ->placeholder(function (Model $record) {
                        if ($record->status_pendaftaran_id == 1 || $record->status_pendaftaran_id == 3) {

                            return (new HtmlString(''));
                        } else {
                            return (new HtmlString('Belum Upload'));
                        }
                    })
                    ->url(function (Model $record) {
                        if ($record->file_srs !== null) {

                            return ("https://psb.tsn.ponpes.id/storage/" . $record->file_srs);
                        }
                    })
                    ->badge()
                    ->color('success')
                    ->openUrlInNewTab(),

                TextColumn::make('file_ijz')
                    ->label('4. Ijazah')
                    ->description(fn(): string => 'Ijazah', position: 'above')
                    // ->color('white')
                    ->formatStateUsing(fn(string $state): string => __("Lihat"))
                    // ->limit(1)
                    ->icon('heroicon-s-eye')
                    ->iconColor('success')
                    // ->circular()
                    ->alignCenter()
                    ->placeholder(function (Model $record) {
                        if ($record->status_pendaftaran_id == 1 || $record->status_pendaftaran_id == 3) {

                            return (new HtmlString(''));
                        } else {
                            return (new HtmlString('Belum Upload'));
                        }
                    })
                    ->url(function (Model $record) {
                        if ($record->file_ijz !== null) {

                            return ("https://psb.tsn.ponpes.id/storage/" . $record->file_ijz);
                        }
                    })
                    ->badge()
                    ->color('success')
                    ->openUrlInNewTab(),

                TextColumn::make('file_skt')
                    ->label('5. Surat Keterangan Taklim')
                    ->description(fn(): string => 'Surat Keterangan Taklim', position: 'above')
                    // ->color('white')
                    ->formatStateUsing(fn(string $state): string => __("Lihat"))
                    // ->limit(1)
                    ->icon('heroicon-s-eye')
                    ->iconColor('success')
                    // ->circular()
                    ->alignCenter()
                    ->placeholder(function (Model $record) {
                        if ($record->status_pendaftaran_id == 1 || $record->status_pendaftaran_id == 3) {

                            return (new HtmlString(''));
                        } else {
                            return (new HtmlString('Belum Upload'));
                        }
                    })
                    ->url(function (Model $record) {
                        if ($record->file_skt !== null) {

                            return ("https://psb.tsn.ponpes.id/storage/" . $record->file_skt);
                        }
                    })
                    ->badge()
                    ->color('success')
                    ->openUrlInNewTab(),

                TextColumn::make('file_skuasa')
                    ->label('6. Surat Kuasa')
                    ->description(fn(): string => 'Surat Kuasa', position: 'above')
                    // ->color('white')
                    ->formatStateUsing(fn(string $state): string => __("Lihat"))
                    // ->limit(1)
                    ->icon('heroicon-s-eye')
                    ->iconColor('success')
                    // ->circular()
                    ->alignCenter()
                    ->placeholder(function (Model $record) {
                        if ($record->status_pendaftaran_id == 1 || $record->status_pendaftaran_id == 3) {

                            return (new HtmlString(''));
                        } else {
                            return (new HtmlString('Belum Upload'));
                        }
                    })
                    ->url(function (Model $record) {
                        if ($record->file_skuasa !== null) {

                            return ("https://psb.tsn.ponpes.id/storage/" . $record->file_skuasa);
                        }
                    })
                    ->badge()
                    ->color('success')
                    ->openUrlInNewTab(),

                TextColumn::make('file_spkm')
                    ->label('7. Surat Pernyataan Kesanggupan')
                    ->description(fn(): string => 'Surat Pernyataan Kesanggupan', position: 'above')
                    // ->color('white')
                    ->formatStateUsing(fn(string $state): string => __("Lihat"))
                    // ->limit(1)
                    ->icon('heroicon-s-eye')
                    ->iconColor('success')
                    // ->circular()
                    ->alignCenter()
                    ->placeholder(function (Model $record) {
                        if ($record->status_pendaftaran_id == 1 || $record->status_pendaftaran_id == 3) {

                            return (new HtmlString(''));
                        } else {
                            return (new HtmlString('Belum Upload'));
                        }
                    })
                    ->url(function (Model $record) {
                        if ($record->file_spkm !== null) {

                            return ("https://psb.tsn.ponpes.id/storage/" . $record->file_spkm);
                        }
                    })
                    ->badge()
                    ->color('success')
                    ->openUrlInNewTab(),

                TextColumn::make('file_pka')
                    ->label('8. Surat Permohonan Keringanan Administrasi')
                    ->description(fn(): string => 'Surat Permohonan Keringanan Administrasi', position: 'above')
                    // ->color('white')
                    ->formatStateUsing(fn(string $state): string => __("Lihat"))
                    // ->limit(1)
                    ->icon('heroicon-s-eye')
                    ->iconColor('success')
                    // ->circular()
                    ->alignCenter()
                    ->placeholder(function (Model $record) {
                        if ($record->status_pendaftaran_id == 1 || $record->status_pendaftaran_id == 3) {

                            return (new HtmlString(''));
                        } else {
                            return (new HtmlString('Belum Upload'));
                        }
                    })
                    ->url(function (Model $record) {
                        if ($record->file_pka !== null) {

                            return ("https://psb.tsn.ponpes.id/storage/" . $record->file_pka);
                        }
                    })
                    ->badge()
                    ->color('success')
                    ->openUrlInNewTab(),

                TextColumn::make('file_ktmu')
                    ->label('9. Surat Keterangan Tidak Mampu (U)')
                    ->description(fn(): string => 'Surat Keterangan Tidak Mampu (U)', position: 'above')
                    // ->color('white')
                    ->formatStateUsing(fn(string $state): string => __("Lihat"))
                    // ->limit(1)
                    ->icon('heroicon-s-eye')
                    ->iconColor('success')
                    // ->circular()
                    ->alignCenter()
                    ->placeholder(function (Model $record) {
                        if ($record->status_pendaftaran_id == 1 || $record->status_pendaftaran_id == 3) {

                            return (new HtmlString(''));
                        } else {
                            return (new HtmlString('Belum Upload'));
                        }
                    })
                    ->url(function (Model $record) {
                        if ($record->file_ktmu !== null) {

                            return ("https://psb.tsn.ponpes.id/storage/" . $record->file_ktmu);
                        }
                    })
                    ->badge()
                    ->color('success')
                    ->openUrlInNewTab(),

                TextColumn::make('file_ktmp')
                    ->label('10. Surat Keterangan Tidak Mampu (P)')
                    ->description(fn(): string => 'Surat Keterangan Tidak Mampu (P)', position: 'above')
                    // ->color('white')
                    ->formatStateUsing(fn(string $state): string => __("Lihat"))
                    // ->limit(1)
                    ->icon('heroicon-s-eye')
                    ->iconColor('success')
                    // ->circular()
                    ->alignCenter()
                    ->placeholder(function (Model $record) {
                        if ($record->status_pendaftaran_id == 1 || $record->status_pendaftaran_id == 3) {

                            return (new HtmlString(''));
                        } else {
                            return (new HtmlString('Belum Upload'));
                        }
                    })
                    ->url(function (Model $record) {
                        if ($record->file_ktmp !== null) {

                            return ("https://psb.tsn.ponpes.id/storage/" . $record->file_ktmp);
                        }
                    })
                    ->badge()
                    ->color('success')
                    ->openUrlInNewTab(),

                TextColumn::make('file_cvd')
                    ->label('11. Surat Keterangan Sehat dari RS/Puskesmas/Klinik')
                    ->description(fn(): string => '11. Surat Keterangan Sehat', position: 'above')
                    // ->color('white')
                    ->formatStateUsing(fn(string $state): string => __("Lihat"))
                    // ->limit(1)
                    ->icon('heroicon-s-eye')
                    ->iconColor('success')
                    // ->circular()
                    ->alignCenter()
                    ->placeholder(function (Model $record) {
                        if ($record->status_pendaftaran_id == 1 || $record->status_pendaftaran_id == 3) {

                            return (new HtmlString(''));
                        } else {
                            return (new HtmlString('Belum Upload'));
                        }
                    })
                    ->url(function (Model $record) {
                        if ($record->file_cvd !== null) {

                            return ("https://psb.tsn.ponpes.id/storage/" . $record->file_cvd);
                        }
                    })
                    ->badge()
                    ->color('success')
                    ->openUrlInNewTab(),

                TextColumn::make('umur')
                    ->label('Umur')
                    ->sortable(),

            ])
            ->groups([
                GroupingGroup::make('qism_detail_id')
                    ->titlePrefixedWithLabel(false)
            ])
            ->defaultGroup('qism_detail_id')
            ->defaultSort('nama_lengkap')
            ->groupingSettingsHidden()
            ->filters([
                QueryBuilder::make()
                    ->constraintPickerColumns(1)
                    ->constraints([

                        TextConstraint::make('nama_kpl_kel')
                            ->label('Nama Walisantri')
                            ->icon(false)
                            ->nullable(),

                        TextConstraint::make('nama_lengkap')
                            ->label('Nama Santri')
                            ->icon(false)
                            ->nullable(),

                        SelectConstraint::make('qism_id')
                            ->label('Qism')
                            ->options(Qism::whereIsActive(1)->pluck('abbr_qism', 'id'))
                            ->nullable(),

                        SelectConstraint::make('qism_detail_id')
                            ->label('Qism Detail')
                            ->options(QismDetail::whereIsActive(1)->pluck('abbr_qism_detail', 'id'))
                            ->nullable(),

                        SelectConstraint::make('kelas_id')
                            ->label('Kelas')
                            ->options(Kelas::whereIsActive(1)->pluck('kelas', 'id'))
                            ->nullable(),

                        SelectConstraint::make('tahap_pendaftaran_id')
                            ->label('Tahap Pendaftaran')
                            ->options(TahapPendaftaran::whereIsActive(1)->pluck('tahap_pendaftaran', 'id'))
                            ->nullable(),

                        SelectConstraint::make('status_pendaftaran_id')
                            ->label('Status Pendaftaran')
                            ->options(StatusPendaftaran::whereIsActive(1)->pluck('status_pendaftaran', 'id'))
                            ->nullable(),

                    ]),
            ])
            ->actions([
                ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make()
                        ->hidden(auth()->user()->id <> 1),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkAction::make('lolostahap1')
                    ->label(__('Lolos Tahap 1'))
                    ->color('success')
                    ->requiresConfirmation()
                    ->modalIcon('heroicon-o-check-circle')
                    ->modalIconColor('success')
                    ->modalHeading('Ubah Status Santri Lolos ke Tahap Selanjutnya?')
                    ->modalDescription('Setelah klik tombol "Simpan", maka status akan berubah')
                    ->modalSubmitActionLabel('Simpan')
                    ->action(fn(Collection $records, array $data) => $records->each(
                        function ($record) {

                            $statususer = User::where('id', $record->walisantri->user->id)->first();
                            $statususer->is_active = 1;
                            $statususer->save();

                            $data['status_pendaftaran_id'] = 4;
                            $data['tahap_pendaftaran_id'] = 2;
                            $data['deskripsitahap'] = 'Alhamdulillah, ananda lolos ke tahap berikutnya';
                            $record->update($data);

                            return $record;

                            Notification::make()
                                ->success()
                                ->title('Status Ananda telah diupdate')
                                // ->persistent()
                                ->color('Success')
                                ->send();
                        }
                    ))
                    ->deselectRecordsAfterCompletion(),

                Tables\Actions\BulkAction::make('tidaklolostahap1')
                    ->label(__('Tidak Lolos Tahap 1'))
                    ->color('danger')
                    ->requiresConfirmation()
                    ->modalIcon('heroicon-o-exclamation-triangle')
                    ->modalIconColor('danger')
                    ->modalHeading(new HtmlString('Ubah Status Santri <strong class="text-red">Tidak</strong> Lolos ke Tahap Selanjutnya?'))
                    ->modalDescription('Setelah klik tombol "Simpan", maka status akan berubah')
                    ->modalSubmitActionLabel('Simpan')
                    ->action(fn(Collection $records, array $data) => $records->each(
                        function ($record) {

                            $santris = Santri::where('walisantri_id', $record->walisantri_id)->pluck('id');

                            $countstatusaktif = StatusSantri::whereIn('santri_id', $santris)
                                ->where('stat_santri_id', 3)->count();

                            if ($countstatusaktif == 0) {
                                $statususer = User::where('id', $record->walisantri->user->id)->first();
                                $statususer->is_active = 0;
                                $statususer->save();

                                $data['status_pendaftaran_id'] = 3;
                                $data['tahap_pendaftaran_id'] = 1;
                                $data['deskripsitahap'] = 'Ananda tidak dapat melanjutkan ke tahap berikutnya';
                                $record->update($data);

                                return $record;
                            } else {
                                $data['status_pendaftaran_id'] = 3;
                                $data['tahap_pendaftaran_id'] = 1;
                                $data['deskripsitahap'] = 'Ananda tidak dapat melanjutkan ke tahap berikutnya';
                                $record->update($data);

                                return $record;
                            }

                            Notification::make()
                                ->success()
                                ->title('Status Ananda telah diupdate')
                                // ->persistent()
                                ->color('Success')
                                ->send();
                        }
                    ))->deselectRecordsAfterCompletion(),


                //tombol diterima
                Tables\Actions\BulkAction::make('diterima')
                    ->label(__('Diterima'))
                    ->color('success')
                    ->requiresConfirmation()
                    ->modalIcon('heroicon-o-check-circle')
                    ->modalIconColor('success')
                    ->modalHeading('Ubah Status menjadi "Diterima sebagai santri?"')
                    ->modalDescription('Setelah klik tombol "Simpan", maka status akan berubah')
                    ->modalSubmitActionLabel('Simpan')
                    ->action(fn(Collection $records, array $data) => $records->each(
                        function ($record) {

                            $tahun = Carbon::now()->year;

                            $getnismstart = NismPerTahun::where('tahun', $tahun)->first();
                            $nismstart = $getnismstart->nismstart;
                            $abbrtahun = $getnismstart->abbr_tahun;

                            $ceknismstartsantri = Santri::where('nism', $nismstart)->count();

                            $nismterakhir = Santri::where('nism', 'LIKE', $abbrtahun . '%')->max('nism');

                            $nismbaru = $nismterakhir + 1;

                            $angktahun = substr($nismstart, 0, 2);

                            // dd($tahun, $nismstart, $ceknismstartsantri, $nismterakhir, $nismbaru);

                            $cektahap = $record->tahap_pendaftaran_id;

                            $semb = SemesterBerjalan::where('is_active', 0)->first();

                            $taakt = TahunAjaranAktif::where('qism_id', $record->qism_id)->first();

                            $semid = Semester::where('id', $taakt->semester_id)->first();

                            if ($cektahap == 2) {

                                if ($ceknismstartsantri == 0) {

                                    $kelassantri = new KelasSantri;

                                    $kelassantri->santri_id = $record->id;
                                    $kelassantri->mahad_id = '1';
                                    $kelassantri->qism_id = $record->qism_id;
                                    $kelassantri->qism_detail_id = $record->qism_detail_id;
                                    $kelassantri->tahun_berjalan_id = $record->tahun_berjalan_id;
                                    $kelassantri->tahun_ajaran_id = $record->tahun_ajaran_id;
                                    $kelassantri->semester_id = $semid->sem_sel;
                                    $kelassantri->kelas_id = $record->kelas_id;
                                    $kelassantri->semester_berjalan_id = $semb->id;
                                    $kelassantri->is_active = 1;

                                    $kelassantri->save();

                                    $statussantri = new StatusSantri;

                                    $statussantri->santri_id = $record->id;
                                    $statussantri->stat_santri_id = 3;
                                    $statussantri->is_active = 1;

                                    $statussantri->save();

                                    $statususer = User::where('username', $record->kartu_keluarga)->first();
                                    $statususer->is_active = 1;
                                    $statususer->save();

                                    $data['nism'] = $nismstart;
                                    $data['status_pendaftaran_id'] = 2;
                                    $data['tahap_pendaftaran_id'] = 3;
                                    $data['angkatan_tahun'] = $angktahun;
                                    $data['deskripsitahap'] = 'Alhamdulillah, ananda diterima sebagai santri Mahad Tadzimussunnah Sine Ngawi';
                                    $record->update($data);

                                    return $record;

                                    Notification::make()
                                        ->success()
                                        ->title('Status Ananda telah diupdate')
                                        // ->persistent()
                                        ->color('Success')
                                        ->send();
                                } elseif ($ceknismstartsantri == 1) {

                                    $kelassantri = new KelasSantri;

                                    $kelassantri->santri_id = $record->id;
                                    $kelassantri->mahad_id = '1';
                                    $kelassantri->qism_id = $record->qism_id;
                                    $kelassantri->qism_detail_id = $record->qism_detail_id;
                                    $kelassantri->tahun_berjalan_id = $record->tahun_berjalan_id;
                                    $kelassantri->tahun_ajaran_id = $record->tahun_ajaran_id;
                                    $kelassantri->semester_id = $semid->sem_sel;
                                    $kelassantri->kelas_id = $record->kelas_id;
                                    $kelassantri->semester_berjalan_id = $semb->id;
                                    $kelassantri->is_active = 1;

                                    $kelassantri->save();

                                    $statussantri = new StatusSantri;

                                    $statussantri->santri_id = $record->id;
                                    $statussantri->stat_santri_id = 3;
                                    $statussantri->is_active = 1;

                                    $statussantri->save();

                                    $statususer = User::where('username', $record->kartu_keluarga)->first();
                                    $statususer->is_active = 1;
                                    $statususer->save();

                                    $data['nism'] = $nismbaru;
                                    $data['status_pendaftaran_id'] = 2;
                                    $data['tahap_pendaftaran_id'] = 3;
                                    $data['angkatan_tahun'] = $angktahun;
                                    $data['deskripsitahap'] = 'Alhamdulillah, ananda diterima sebagai santri Mahad Tadzimussunnah Sine Ngawi';
                                    $record->update($data);

                                    return $record;

                                    Notification::make()
                                        ->success()
                                        ->title('Status Ananda telah diupdate')
                                        // ->persistent()
                                        ->color('Success')
                                        ->send();
                                }
                            } elseif ($cektahap != 1) {

                                Notification::make()
                                    // ->success()
                                    ->title('Status santri masih Tahap 1 atau Status telah Diterima!')
                                    ->icon('heroicon-o-exclamation-triangle')
                                    ->iconColor('danger')
                                    // ->persistent()
                                    ->color('warning')
                                    ->send();
                            }
                        }
                    ))
                    ->deselectRecordsAfterCompletion(),

                Tables\Actions\BulkAction::make('tidakditerima')
                    ->label(__('Tidak Diterima'))
                    ->color('danger')
                    ->requiresConfirmation()
                    ->modalIcon('heroicon-o-exclamation-triangle')
                    ->modalIconColor('danger')
                    ->modalHeading('Ubah Status menjadi "Tidak diterima sebagai santri?"')
                    ->modalDescription('Setelah klik tombol "Simpan", maka status akan berubah')
                    ->modalSubmitActionLabel('Simpan')
                    ->action(fn(Collection $records, array $data) => $records->each(
                        function ($record) {

                            $cektahap = $record->tahap_pendaftaran_id;

                            // dd($cektahap);

                            if ($cektahap == 2) {

                                $santris = Santri::where('kartu_keluarga', $record->kartu_keluarga)->pluck('id');

                                $countstatusaktif = StatusSantri::whereIn('santri_id', $santris)
                                    ->where('stat_santri_id', 3)->count();

                                if ($countstatusaktif == 0) {
                                    $statususer = User::where('username', $record->kartu_keluarga)->first();
                                    $statususer->is_active = 0;
                                    $statususer->save();
                                }

                                $data['status_pendaftaran_id'] = 1;
                                $record->update($data);

                                return $record;

                                Notification::make()
                                    ->success()
                                    ->title('Status Ananda telah diupdate')
                                    // ->persistent()
                                    ->color('Success')
                                    ->send();
                            } elseif ($cektahap != 2) {
                                Notification::make()
                                    // ->success()
                                    ->title('Status santri masih Tahap 1 atau Status telah Diterima!')
                                    ->icon('heroicon-o-exclamation-triangle')
                                    ->iconColor('danger')
                                    // ->persistent()
                                    ->color('warning')
                                    ->send();
                            }
                        }
                    ))
                    ->deselectRecordsAfterCompletion(),

                Tables\Actions\BulkAction::make('reset')
                    ->label(__('Reset Status Tahap 1'))
                    ->color('gray')
                    ->requiresConfirmation()
                    ->modalIcon('heroicon-o-arrow-path')
                    ->modalIconColor('gray')
                    ->modalHeading(new HtmlString('Reset Status Santri ?'))
                    ->modalDescription('Setelah klik tombol "Simpan", maka status akan berubah')
                    ->modalSubmitActionLabel('Simpan')
                    ->visible(auth()->user()->id == 1)
                    ->action(fn(Collection $records, array $data) => $records->each(
                        function ($record) {

                            $statususer = User::where('id', $record->walisantri->user->id)->first();
                            $statususer->is_active = 1;
                            $statususer->save();

                            $data['status_pendaftaran_id'] = null;
                            $data['tahap_pendaftaran_id'] = 1;
                            $data['deskripsitahap'] = null;
                            $record->update($data);

                            return $record;

                            Notification::make()
                                ->success()
                                ->title('Status Ananda telah diupdate')
                                // ->persistent()
                                ->color('Success')
                                ->send();
                        }
                    ))->deselectRecordsAfterCompletion(),

                Tables\Actions\BulkAction::make('proper')
                    ->label(__('Proper'))
                    ->color('info')
                    ->requiresConfirmation()
                    ->modalIcon('heroicon-o-check-circle')
                    ->modalIconColor('success')
                    ->modalHeading('Ubah Status Santri Lolos ke Tahap Selanjutnya?')
                    ->modalDescription('Setelah klik tombol "Simpan", maka status akan berubah')
                    ->modalSubmitActionLabel('Simpan')
                    ->visible(auth()->user()->id == 1)
                    ->action(fn(Collection $records, array $data) => $records->each(
                        function ($record) {

                            $properws = Walisantri::where('id', $record->walisantri_id)->first();
                            $properws->nama_kpl_kel_santri = Str::ucwords(strtolower($record->walisantri->nama_kpl_kel_santri));

                            $properws->ak_nama_lengkap = Str::ucwords(strtolower($record->walisantri->ak_nama_lengkap));
                            $properws->ak_nama_kunyah = Str::ucwords(strtolower($record->walisantri->ak_nama_kunyah));
                            $properws->ak_tempat_lahir = Str::ucwords(strtolower($record->walisantri->ak_tempat_lahir));
                            $properws->ak_kep_kel_kk = Str::ucwords(strtolower($record->walisantri->ak_kep_kel_kk));

                            $properws->ik_nama_lengkap = Str::ucwords(strtolower($record->walisantri->ik_nama_lengkap));
                            $properws->ik_nama_kunyah = Str::ucwords(strtolower($record->walisantri->ik_nama_kunyah));
                            $properws->ik_tempat_lahir = Str::ucwords(strtolower($record->walisantri->ik_tempat_lahir));
                            $properws->ik_kep_kel_kk = Str::ucwords(strtolower($record->walisantri->ik_kep_kel_kk));

                            $properws->w_nama_lengkap = Str::ucwords(strtolower($record->walisantri->w_nama_lengkap));
                            $properws->w_nama_kunyah = Str::ucwords(strtolower($record->walisantri->w_nama_kunyah));
                            $properws->w_tempat_lahir = Str::ucwords(strtolower($record->walisantri->w_tempat_lahir));
                            $properws->w_kep_kel_kk = Str::ucwords(strtolower($record->walisantri->w_kep_kel_kk));

                            $properws->save();

                            $properuser = User::where('id', $record->walisantri->user->id)->first();
                            $properuser->name = Str::ucwords(strtolower($record->walisantri->user->name));
                            $properuser->save();

                            $data['nama_lengkap'] = Str::ucwords(strtolower($record->nama_lengkap));
                            $data['nama_panggilan'] = Str::ucwords(strtolower($record->nama_panggilan));
                            $data['tempat_lahir'] = Str::ucwords(strtolower($record->tempat_lahir));
                            $data['nama_kpl_kel'] = Str::ucwords(strtolower($record->nama_kpl_kel));
                            $record->update($data);

                            return $record;

                            Notification::make()
                                ->success()
                                ->title('Status Ananda telah diupdate')
                                // ->persistent()
                                ->color('Success')
                                ->send();
                        }
                    ))
                    ->deselectRecordsAfterCompletion(),

            ])
            ->checkIfRecordIsSelectableUsing(

                fn(Model $record): bool => $record->status_pendaftaran_id == 4 || $record->status_pendaftaran_id == null || auth()->user()->id == 1,
            );
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
