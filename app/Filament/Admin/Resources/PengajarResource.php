<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\PengajarResource\Pages;
use App\Filament\Admin\Resources\PengajarResource\RelationManagers;
use App\Filament\Exports\PengajarExporter;
use App\Filament\Imports\PengajarImporter;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\Kodepos;
use App\Models\Pengajar;
use App\Models\Provinsi;
use App\Models\Statuskepegawaian;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Radio;
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
use Filament\Tables\Filters\QueryBuilder\Constraints\TextConstraint;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Collection;
use Illuminate\Support\HtmlString;
use Schmeits\FilamentCharacterCounter\Forms\Components\TextInput as ComponentsTextInput;
use Illuminate\Support\Str;

class PengajarResource extends Resource
{
    protected static ?string $model = Pengajar::class;

    public static function canViewAny(): bool
    {
        return auth()->user()->id == 1 || auth()->user()->id == 2;
    }

    protected static ?string $modelLabel = 'Pengajar';

    protected static ?string $pluralModelLabel = 'Pengajar';

    protected static ?string $navigationLabel = 'Pengajar';

    protected static ?int $navigationSort = 900000100;

    // protected static ?string $navigationIcon = 'heroicon-o-Qisms';

    // protected static ?string $cluster = User::class;

    protected static ?string $navigationGroup = 'Users';

    // protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    public static function form(Form $form): Form
    {
        return $form

            ->schema(static::PengajarFormSchema());
    }

    public static function PengajarFormSchema(): array
    {
        return [

            // Section::make('Pengajar')
            //     ->schema([

            //         Placeholder::make('')
            //             ->content(function (Model $record) {
            //                 return (new HtmlString('<div><p class="text-3xl"><strong>' . $record->nama . '</strong></p></div>'));
            //             }),


            //         //DATA DIRI
            //         Section::make('')
            //             ->schema([

            //                 //DATA DIRI
            //                 Placeholder::make('')
            //                     ->content(new HtmlString('<div class="border-b"><p class="text-lg strong"><strong>DATA DIRI</strong></p></div>')),

            //                 Grid::make(3)
            //                     ->schema([

            //                         TextInput::make('gelar_depan')
            //                             ->label('Gelar Depan')
            //                             ->helperText(new HtmlString('Contoh: <strong>Prof. Dr.</strong>')),

            //                         TextInput::make('nama_lengkap')
            //                             ->label('Nama Lengkap')
            //                             ->hint('Isi sesuai dengan KK')
            //                             ->hintColor('danger')
            //                             ->required(),

            //                         TextInput::make('gelar_belakang')
            //                             ->label('Gelar Belakang')
            //                             ->helperText(new HtmlString('Contoh: <strong>S.pd M.pd</strong>')),

            //                     ]),



            //                 TextInput::make('nik')
            //                     ->label('NIK')
            //                     ->hint('Isi sesuai dengan KK')
            //                     ->hintColor('danger')
            //                     ->length(16)
            //                     ->required(),

            //                 Grid::make(2)
            //                     ->schema([

            //                         TextInput::make('status_kepegawaian')
            //                             ->label('Status Kepegawaian')
            //                             ->disabled(),

            //                         DatePicker::make('tmt_pegawai')
            //                             ->label('Terhitung Mulai Tanggal')
            //                             ->helperText('Tanggal mulai bertugas')
            //                             ->required()
            //                             ->format('d/m/Y')
            //                             ->displayFormat('d/m/Y')
            //                             ->closeOnDateSelection()
            //                             ->native(false),

            //                     ]),

            //                 Grid::make(2)
            //                     ->schema([

            //                         TextInput::make('hp')
            //                             ->label('No. Handphone')
            //                             ->helperText('Contoh: 6282187782223')
            //                             ->tel()
            //                             ->telRegex('/^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\.\/0-9]*$/')
            //                             ->required(),

            //                         TextInput::make('email')
            //                             ->label('Email')
            //                             ->email(),

            //                     ]),

            //                 TextInput::make('npwp')
            //                     ->label('NPWP'),

            //                 Radio::make('jenis_kelamin')
            //                     ->label('Jenis Kelamin')
            //                     ->options([
            //                         'Laki-laki' => 'Laki-laki',
            //                         'Perempuan' => 'Perempuan',
            //                     ])
            //                     ->required()
            //                     ->inline(),

            //                 Grid::make(2)
            //                     ->schema([

            //                         TextInput::make('tempat_lahir')
            //                             ->label('Tempat Lahir')
            //                             ->hint('Isi sesuai dengan KK')
            //                             ->hintColor('danger')
            //                             ->required(),

            //                         DatePicker::make('tanggal_lahir')
            //                             ->label('Tanggal Lahir')
            //                             ->hint('Isi sesuai dengan KK')
            //                             ->required()
            //                             ->format('d/m/Y')
            //                             ->displayFormat('d/m/Y')
            //                             ->closeOnDateSelection()
            //                             ->native(false),

            //                     ]),

            //                 TextInput::make('agama')
            //                     ->label('Agama')
            //                     ->disabled(),

            //                 Select::make('golongan_darah')
            //                     ->label('Golongan Darah')
            //                     ->placeholder('Pilih Golongan Darah')
            //                     ->options([
            //                         'Golongan Darah A' => 'Golongan Darah A',
            //                         'Golongan Darah B' => 'Golongan Darah B',
            //                         'Golongan Darah AB' => 'Golongan Darah AB',
            //                         'Golongan Darah O' => 'Golongan Darah O',
            //                     ])
            //                     ->native(false),

            //                 Grid::make(3)
            //                     ->schema([

            //                         Select::make('pendidikan_terakhir')
            //                             ->label('Pendidikan Terakhir')
            //                             ->placeholder('Pilih Pendidikan Terakhir')
            //                             ->options([
            //                                 'SD/Sederajat' => 'SD/Sederajat',
            //                                 'SMP/Sederajat' => 'SMP/Sederajat',
            //                                 'SMA/Sederajat' => 'SMA/Sederajat',
            //                                 'D1' => 'D1',
            //                                 'D2' => 'D2',
            //                                 'D3' => 'D3',
            //                                 'D4/S1' => 'D4/S1',
            //                                 'S2' => 'S2',
            //                                 'S3' => 'S3',
            //                                 'Tidak Memiliki Pendidikan Formal' => 'Tidak Memiliki Pendidikan Formal',
            //                                 'M1' => 'M1',
            //                                 'M2' => 'M2',
            //                                 'M3' => 'M3',
            //                             ])
            //                             ->required()
            //                             ->native(false),

            //                         TextInput::make('prodi_terakhir')
            //                             ->label('Prodi Terakhir'),

            //                         DatePicker::make('tanggal_ijazah')
            //                             ->label('Tanggal Ijazah')
            //                             ->format('d/m/Y')
            //                             ->displayFormat('d/m/Y')
            //                             ->closeOnDateSelection()
            //                             ->native(false),

            //                     ]),

            //             ])
            //             ->compact()
            //             ->columnSpanFull(),


            //         //INFORMASI TEMPAT TINGGAL
            //         Section::make('')
            //             ->schema([

            //                 //DATA DIRI
            //                 Placeholder::make('')
            //                     ->content(new HtmlString('<div class="border-b"><p class="text-lg strong"><strong>INFORMASI TEMPAT TINGGAL</strong></p></div>')),

            //                 Select::make('status_tempat_tinggal')
            //                     ->label('Status Tempat Tinggal')
            //                     ->placeholder('Pilih Status Tempat Tinggal')
            //                     ->options([
            //                         'Milik Sendiri' => 'Milik Sendiri',
            //                         'Rumah Orang Tua' => 'Rumah Orang Tua',
            //                         'Rumah Saudara/kerabat' => 'Rumah Saudara/kerabat',
            //                         'Rumah Dinas' => 'Rumah Dinas',
            //                         'Sewa/kontrak' => 'Sewa/kontrak',
            //                         'Lainnya' => 'Lainnya',
            //                     ])
            //                     ->required()
            //                     ->native(false),

            //                 Grid::make(2)
            //                     ->schema([

            //                         Select::make('provinsi_id')
            //                             ->label('Provinsi')
            //                             ->placeholder('Pilih Provinsi')
            //                             ->options(Provinsi::all()->pluck('provinsi', 'id'))
            //                             ->searchable()
            //                             ->required()
            //                             ->live()
            //                             ->native(false)
            //                             ->hint('Isi sesuai dengan KK')
            //                             ->hintColor('danger')
            //                             ->afterStateUpdated(function (Set $set) {
            //                                 $set('kabupaten_id', null);
            //                                 $set('kecamatan_id', null);
            //                                 $set('kelurahan_id', null);
            //                                 $set('kodepos', null);
            //                             }),

            //                         Select::make('kabupaten_id')
            //                             ->label('Kabupaten')
            //                             ->placeholder('Pilih Kabupaten')
            //                             ->options(fn(Get $get): Collection => Kabupaten::query()
            //                                 ->where('provinsi_id', $get('provinsi_id'))
            //                                 ->pluck('kabupaten', 'id'))
            //                             ->searchable()
            //                             ->required()
            //                             ->live()
            //                             ->native(false)
            //                             ->hint('Isi sesuai dengan KK')
            //                             ->hintColor('danger'),

            //                         Select::make('kecamatan_id')
            //                             ->label('Kecamatan')
            //                             ->placeholder('Pilih Kecamatan')
            //                             ->options(fn(Get $get): Collection => Kecamatan::query()
            //                                 ->where('kabupaten_id', $get('kabupaten_id'))
            //                                 ->pluck('kecamatan', 'id'))
            //                             ->searchable()
            //                             ->required()
            //                             ->live()
            //                             ->native(false)
            //                             ->hint('Isi sesuai dengan KK')
            //                             ->hintColor('danger'),

            //                         Select::make('kelurahan_id')
            //                             ->label('Kelurahan')
            //                             ->placeholder('Pilih Kelurahan')
            //                             ->options(fn(Get $get): Collection => Kelurahan::query()
            //                                 ->where('kecamatan_id', $get('kecamatan_id'))
            //                                 ->pluck('kelurahan', 'id'))
            //                             ->searchable()
            //                             ->required()
            //                             ->live()
            //                             ->native(false)
            //                             ->hint('Isi sesuai dengan KK')
            //                             ->hintColor('danger')
            //                             ->afterStateUpdated(function (Get $get, ?string $state, Set $set, ?string $old) {

            //                                 if (($get('kodepos') ?? '') !== Str::slug($old)) {
            //                                     return;
            //                                 }

            //                                 $kodepos = Kodepos::where('kelurahan_id', $state)->get('kodepos');

            //                                 $state = $kodepos;

            //                                 foreach ($state as $state) {
            //                                     $set('kodepos', Str::substr($state, 12, 5));
            //                                 }
            //                             }),


            //                         TextInput::make('rt')
            //                             ->label('RT')
            //                             ->required()
            //                             ->hint('Isi sesuai dengan KK')
            //                             ->hintColor('danger'),

            //                         TextInput::make('rw')
            //                             ->label('RW')
            //                             ->required()
            //                             ->hint('Isi sesuai dengan KK')
            //                             ->hintColor('danger'),

            //                         Textarea::make('alamat')
            //                             ->label('Alamat')
            //                             ->required()
            //                             ->columnSpanFull()
            //                             ->hint('Isi sesuai dengan KK')
            //                             ->hintColor('danger'),

            //                         TextInput::make('kodepos')
            //                             ->label('Kodepos')
            //                             ->disabled()
            //                             ->required()
            //                             ->dehydrated(),
            //                     ]),

            //                 Grid::make(3)
            //                     ->schema([

            //                         Select::make('transportasi')
            //                             ->label('Transportasi ke Pondok Pesantren')
            //                             ->options([
            //                                 'Jalan kaki' => 'Jalan kaki',
            //                                 'Sepeda' => 'Sepeda',
            //                                 'Sepeda Motor' => 'Sepeda Motor',
            //                                 'Mobil Pribadi' => 'Mobil Pribadi',
            //                                 'Antar Jemput Sekolah' => 'Antar Jemput Sekolah',
            //                                 'Angkutan Umum' => 'Angkutan Umum',
            //                                 'Perahu/Sampan' => 'Perahu/Sampan',
            //                                 'Lainnya' => 'Lainnya',
            //                             ])
            //                             ->required()
            //                             ->native(false),

            //                         Select::make('jarak')
            //                             ->label('Jarak tempat tinggal ke Pondok Pesantren')
            //                             ->options([
            //                                 'Kurang dari 5 km' => 'Kurang dari 5 km',
            //                                 'Antara 5 - 10 Km' => 'Antara 5 - 10 Km',
            //                                 'Antara 11 - 20 Km' => 'Antara 11 - 20 Km',
            //                                 'Antara 21 - 30 Km' => 'Antara 21 - 30 Km',
            //                                 'Lebih dari 30 Km' => 'Lebih dari 30 Km',
            //                             ])
            //                             ->required()
            //                             ->native(false),



            //                         Select::make('waktu_tempuh')
            //                             ->label('Waktu tempuh ke Pondok Pesantren')
            //                             ->options([
            //                                 '1 - 10 menit' => '1 - 10 menit',
            //                                 '10 - 19 menit' => '10 - 19 menit',
            //                                 '20 - 29 menit' => '20 - 29 menit',
            //                                 '30 - 39 menit' => '30 - 39 menit',
            //                                 '1 - 2 jam' => '1 - 2 jam',
            //                                 '> 2 jam' => '> 2 jam',
            //                             ])
            //                             ->required()
            //                             ->native(false),
            //                     ]),







            //             ])
            //             ->compact()
            //             ->columnSpanFull(),


            //         //INFORMASI KELUARGA
            //         Section::make('')
            //             ->schema([

            //                 //DATA DIRI
            //                 Placeholder::make('')
            //                     ->content(new HtmlString('<div class="border-b"><p class="text-lg strong"><strong>INFORMASI KELUARGA</strong></p></div>')),

            //                 TextInput::make('nama_ibu_kandung')
            //                     ->label('Nama Ibu Kandung')
            //                     ->hint('Isi sesuai dengan KK')
            //                     ->hintColor('danger')
            //                     ->required(),

            //                 Placeholder::make('')
            //                     ->content(new HtmlString('<div class="border-b"><p class="text-lg strong"><strong>STATUS PERKAWINAN</strong></p></div>')),

            //                 Radio::make('status_perkawinan')
            //                     ->label('Status Perkawinan')
            //                     ->options([
            //                         'Kawin' => 'Kawin',
            //                         'Belum Kawin' => 'Belum Kawin',
            //                         'Duda/Janda' => 'Duda/Janda',
            //                     ])
            //                     ->required()
            //                     ->inline(),

            //                 TextInput::make('nomor_kk')
            //                     ->label('Nomor KK')
            //                     ->hint('Isi sesuai dengan KK')
            //                     ->hintColor('danger')
            //                     ->length(16)
            //                     ->required(),

            //             ])
            //             ->compact()
            //             ->columnSpanFull(),

            //         //DATA BANK
            //         Section::make('')
            //             ->schema([

            //                 //DATA DIRI
            //                 Placeholder::make('')
            //                     ->content(new HtmlString('<div class="border-b"><p class="text-lg strong"><strong>DATA BANK</strong></p></div>')),

            //                 Grid::make(2)
            //                     ->schema([

            //                         TextInput::make('no_rekening')
            //                             ->label('No Rekening'),

            //                         TextInput::make('nama_rekening')
            //                             ->label('Nama Rekening'),

            //                         TextInput::make('nama_bank')
            //                             ->label('Nama Bank'),

            //                         TextInput::make('cabang_bank')
            //                             ->label('Cabang Bank'),
            //                     ]),

            //             ])
            //             ->compact()
            //             ->columnSpanFull(),

            //         //TUGAS UTAMA
            //         Section::make('')
            //             ->schema([

            //                 Placeholder::make('')
            //                     ->content(new HtmlString('<div class="border-b"><p class="text-lg strong"><strong>TUGAS UTAMA</strong></p></div>')),

            //                 Select::make('tugas_utama')
            //                     ->label('Tugas Utama')
            //                     ->options([
            //                         'Pengemudi' => 'Pengemudi',
            //                         'Tenaga Keamanan' => 'Tenaga Keamanan',
            //                         'Lainnya' => 'Lainnya',
            //                         'Tenaga Administrasi' => 'Tenaga Administrasi',
            //                         'Tenaga Pendidik' => 'Tenaga Pendidik',
            //                         'Tenaga Perpustakaan' => 'Tenaga Perpustakaan',
            //                         'Tenaga Laboratorium' => 'Tenaga Laboratorium',
            //                         'Tenaga Kebersihan' => 'Tenaga Kebersihan',
            //                         'Penjaga Sekolah/Pesuruh' => 'Penjaga Sekolah/Pesuruh',
            //                     ])
            //                     ->required()
            //                     ->native(false),

            //                 Placeholder::make('')
            //                     ->content(new HtmlString('<div class="border-b"><p class="text-lg strong"><strong>TUGAS TAMBAHAN</strong></p></div>')),

            //                 Select::make('tugas_tambahan')
            //                     ->label('Tugas Tambahan')
            //                     ->options([
            //                         'Pengemudi' => 'Pengemudi',
            //                         'Tenaga Keamanan' => 'Tenaga Keamanan',
            //                         'Lainnya' => 'Lainnya',
            //                         'Tenaga Administrasi' => 'Tenaga Administrasi',
            //                         'Tenaga Pendidik' => 'Tenaga Pendidik',
            //                         'Tenaga Perpustakaan' => 'Tenaga Perpustakaan',
            //                         'Tenaga Laboratorium' => 'Tenaga Laboratorium',
            //                         'Tenaga Kebersihan' => 'Tenaga Kebersihan',
            //                         'Penjaga Sekolah/Pesuruh' => 'Penjaga Sekolah/Pesuruh',
            //                     ])
            //                     ->native(false),


            //             ])
            //             ->compact()
            //             ->columnSpanFull(),

            //     ])
            //     ->compact(),

            Section::make('Status')
                ->schema([

                    Grid::make(2)
                        ->schema([

                            ToggleButtons::make('is_active')
                                ->label('Active?')
                                ->boolean()
                                ->grouped()
                                ->default(true),

                        ]),
                ])->collapsible()
                ->compact(),

        ];
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                ColumnGroup::make('Pengajar', [

                    TextColumn::make('nama_staff')
                        ->label('Pengajar')
                        ->searchable(isIndividual: true, isGlobal: false)
                        ->copyable()
                        ->copyableState(function ($state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->sortable(),

                    TextColumn::make('user.username')
                        ->label('User')
                        ->searchable(isIndividual: true, isGlobal: false)
                        ->copyable()
                        ->copyableState(function ($state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->sortable(),

                ]),

                ColumnGroup::make('Status', [

                    CheckboxColumn::make('is_active')
                        ->label('Status')
                        ->sortable()
                        ->alignCenter(),

                ]),

                ColumnGroup::make('Logs', [

                    TextColumn::make('created_by')
                        ->label('Created by')
                        ->copyable()
                        ->copyableState(function ($state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->sortable(),

                    TextColumn::make('updated_by')
                        ->label('Updated by')
                        ->copyable()
                        ->copyableState(function ($state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->sortable(),

                    TextColumn::make('created_at')
                        ->dateTime()
                        ->sortable()
                        ->toggleable(isToggledHiddenByDefault: true),

                    TextColumn::make('updated_at')
                        ->dateTime()
                        ->sortable()
                        ->toggleable(isToggledHiddenByDefault: true),

                ]),
            ])
            ->recordUrl(null)
            ->searchOnBlur()
            ->filters([
                QueryBuilder::make()
                    ->constraintPickerColumns(1)
                    ->constraints([

                        TextConstraint::make('nama_staff')
                            ->label('Pengajar')
                            ->nullable(),

                        BooleanConstraint::make('is_active')
                            ->label('Status')
                            ->icon(false)
                            ->nullable(),

                        TextConstraint::make('created_by')
                            ->label('Created by')
                            ->icon(false)
                            ->nullable(),

                        TextConstraint::make('updated_by')
                            ->label('Updated by')
                            ->icon(false)
                            ->nullable(),

                        DateConstraint::make('created_at')
                            ->icon(false)
                            ->nullable(),

                        DateConstraint::make('updated_at')
                            ->icon(false)
                            ->nullable(),

                    ]),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),

                ImportAction::make()
                    ->label('Import')
                    ->importer(PengajarImporter::class)
            ])
            ->actions([
                ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ]),


            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),

                ExportBulkAction::make()
                    ->label('Export')
                    ->exporter(PengajarExporter::class),

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
            'index' => Pages\ListPengajars::route('/'),
            'create' => Pages\CreatePengajar::route('/create'),
            'view' => Pages\ViewPengajar::route('/{record}'),
            'edit' => Pages\EditPengajar::route('/{record}/edit'),
        ];
    }
}
