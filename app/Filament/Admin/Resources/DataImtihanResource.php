<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Clusters\Imtihan;
use App\Filament\Admin\Resources\DataImtihanResource\Pages;
use App\Filament\Admin\Resources\DataImtihanResource\RelationManagers;
use App\Filament\Exports\DataImtihanExporter;
use App\Filament\Exports\NilaiExporter;
use App\Filament\Imports\DataImtihanImporter;
use App\Models\DataImtihan;
use App\Models\JenisSoal;
use App\Models\KategoriSoal;
use App\Models\Kelas;
use App\Models\KelasSantri;
use App\Models\Mahad;
use App\Models\Mapel;
use App\Models\MapelQism;
use App\Models\Nilai;
use App\Models\Pengajar;
use App\Models\Qism;
use App\Models\QismDetail;
use App\Models\QismDetailHasKelas;
use App\Models\Sem;
use App\Models\Semester;
use App\Models\SemesterBerjalan;
use App\Models\StaffAdmin;
use App\Models\TahunAjaran;
use App\Models\TahunAjaranAktif;
use App\Models\TahunBerjalan;
use Filament\Forms;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Notifications\Notification;
use Filament\Pages\SubNavigationPosition;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\ExportBulkAction;
use Filament\Tables\Actions\ImportAction;
use Filament\Tables\Actions\ReplicateAction;
use Filament\Tables\Columns\CheckboxColumn;
use Filament\Tables\Columns\ColumnGroup;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\TextInputColumn;
use Filament\Tables\Filters\QueryBuilder;
use Filament\Tables\Filters\QueryBuilder\Constraints\BooleanConstraint;
use Filament\Tables\Filters\QueryBuilder\Constraints\DateConstraint;
use Filament\Tables\Filters\QueryBuilder\Constraints\SelectConstraint;
use Filament\Tables\Filters\QueryBuilder\Constraints\TextConstraint;
use Filament\Tables\Grouping\Group;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Collection;
use Illuminate\Validation\Rules\Unique;

class DataImtihanResource extends Resource
{
    protected static ?string $model = Nilai::class;

    public static function canViewAny(): bool
    {
        return auth()->user()->id == 1 || auth()->user()->id == 2;
    }

    public static function canCreate(): bool
    {
        return auth()->user()->id == 1;
    }

    // public static function canEdit(Model $record): bool
    // {
    //     return auth()->user()->id == 1;
    // }

    public static function canDeleteAny(): bool
    {
        return auth()->user()->id == 1;
        // return false;
    }

    protected static ?string $modelLabel = 'Data Imtihan';

    protected static ?string $pluralModelLabel = 'Data Imtihan';

    protected static ?string $navigationLabel = 'Data Imtihan';

    protected static ?int $navigationSort = 400000000;

    // protected static ?string $navigationIcon = 'heroicon-o-Qisms';

    // protected static ?string $cluster = Imtihan::class;

    protected static ?string $navigationGroup = 'Imtihan';

    // protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    public static function form(Form $form): Form
    {
        return $form

            ->schema(static::DataImtihanFormSchema());
    }

    public static function DataImtihanFormSchema(): array
    {
        return [

            Section::make('Informasi Data')
                ->schema([

                    Grid::make(20)
                        ->schema([

                            Checkbox::make('is_soal')
                                ->label('Soal'),

                            Checkbox::make('is_nilai')
                                ->label('Nilai'),

                        ]),

                ])
                ->compact(),

            Section::make('Data Imtihan')
                ->schema([

                    Hidden::make('mahad_id')
                        ->default('1'),

                    Grid::make(4)
                        ->schema([

                            Select::make('qism_id')
                                ->label('Qism')
                                ->options(Qism::all()->pluck('qism', 'id'))
                                ->native(false)
                                ->live()
                                ->afterStateUpdated(function (Get $get, Set $set, $state) {

                                    $ta_aktif = TahunAjaranAktif::where('qism_id', $state)
                                        ->where('is_active', 1)
                                        ->first();

                                    $tb_aktif = TahunBerjalan::where('is_active', 1)->first();

                                    $sb_aktif = SemesterBerjalan::where('is_active', 1)->first();

                                    $set('tahun_ajaran_id', $ta_aktif->tahun_ajaran_id);
                                    $set('semester_id', $ta_aktif->semester_id);
                                    $set('tahun_berjalan_id', $tb_aktif->id);
                                    $set('semester_berjalan_id', $sb_aktif->id);
                                }),

                            Select::make('qism_detail_id')
                                ->label('Qism Detail')
                                ->options(fn(Get $get): Collection => QismDetail::query()
                                    ->where('qism_id', $get('qism_id'))
                                    ->pluck('abbr_qism_detail', 'id'))
                                ->native(false),

                            Select::make('kelas_id')
                                ->label('Kelas')
                                ->options(function (Get $get) {
                                    return (QismDetailHasKelas::where('qism_detail_id', $get('qism_detail_id'))->pluck('kelas', 'kelas_id'));
                                })
                                ->native(false),

                            TextInput::make('kelas_internal')
                                ->label('Kelas Internal'),
                        ]),

                    Grid::make(4)
                        ->schema([

                            Select::make('tahun_berjalan_id')
                                ->label('Tahun Berjalan')
                                ->options(TahunBerjalan::whereIsActive(1)->pluck('tb', 'id'))
                                ->disabled()
                                ->dehydrated()
                                ->native(false),

                            Select::make('semester_berjalan_id')
                                ->label('Semester Berjalan')
                                ->options(SemesterBerjalan::whereIsActive(1)->pluck('semester_berjalan', 'id'))
                                ->disabled()
                                ->dehydrated()
                                ->native(false),

                            Select::make('tahun_ajaran_id')
                                ->label('Tahun Ajaran')
                                ->options(TahunAjaran::whereIsActive(1)->pluck('abbr_ta', 'id'))
                                ->disabled()
                                ->dehydrated()
                                ->native(false),

                            Select::make('semester_id')
                                ->label('Semester')
                                ->options(Sem::whereIsActive(1)->pluck('semester', 'id'))
                                ->disabled()
                                ->dehydrated()
                                ->native(false),
                        ]),

                    Grid::make(4)
                        ->schema([

                            Select::make('mapel_id')
                                ->label('Mapel')
                                ->options(Mapel::all()->pluck('mapel', 'id'))
                                ->options(function (Get $get) {

                                    $mapel = MapelQism::where('qism_id', $get('qism_id'))->pluck('mapel_id')->toArray();

                                    return (Mapel::whereIsActive(1)->whereIn('id', $mapel)->pluck('mapel', 'id'));
                                })
                                ->native(false)
                                ->searchable()
                                ->live()
                                ->afterStateUpdated(function (Get $get, Set $set, $state) {

                                    $getqismdetail = QismDetail::where('id', $get('qism_detail_id'))->first();
                                    $qismdetail = $getqismdetail->abbr_qism_detail;

                                    $gettahunajaran = TahunAjaran::where('id', $get('tahun_ajaran_id'))->first();
                                    $tahunajaran = $gettahunajaran->abbr_ta;

                                    $gettahunberjalan = $get('tahun_berjalan');

                                    $getkelas = Kelas::where('id', $get('kelas_id'))->first();
                                    // $kelas = $getkelas->abbr_kelas;

                                    $getkelass = $get('kelas_id');
                                    $getkelasinternal = $get('kelas_internal');

                                    // dd($getkelasinternal);

                                    $getsemester = Sem::where('id', $get('semester_id'))->first();
                                    $semester = $getsemester->abbr_semester;

                                    $jenissoal = MapelQism::where('qism_id', $get('qism_id'))->where('mapel_id', $state)->first();
                                    $kategorisoal = MapelQism::where('qism_id', $get('qism_id'))->where('mapel_id', $state)->first();

                                    $set('jenis_soal_id', $jenissoal->jenis_soal_id);
                                    $set('kategori_soal_id', $kategorisoal->kategori_soal_id);

                                    if ($get('mapel_id') !== null) {

                                        if ($getkelasinternal === null) {

                                            $getmapel = Mapel::where('id', $get('mapel_id'))->first();
                                            $mapel = $getmapel->mapel;

                                            if ($getkelass === null) {
                                                $kodesoal = $qismdetail . "-" . $tahunajaran . "-" . $semester . "-" . $mapel;

                                                $set('kode_soal', $kodesoal);

                                                $jumlahsantri = KelasSantri::whereHas('statussantri', function ($query) {
                                                    $query->where('status', 'Aktif');
                                                })
                                                    ->where('qism_detail_id', $get('qism_detail_id'))
                                                    ->where('tahun_berjalan_id', $get('tahun_berjalan_id'))
                                                    ->count();

                                                $set('jumlah_print', $jumlahsantri);
                                            } elseif ($getkelass !== null) {

                                                $kodesoal = $qismdetail . "-" . $tahunajaran . "-" . $semester . "-" . $getkelas->abbr_kelas . "-" . $mapel;

                                                $set('kode_soal', $kodesoal);

                                                $jumlahsantri = KelasSantri::whereHas('statussantri', function ($query) {
                                                    $query->where('status', 'Aktif');
                                                })
                                                    ->where('qism_detail_id', $get('qism_detail_id'))
                                                    ->where('tahun_berjalan_id', $get('tahun_berjalan_id'))
                                                    ->where('kelas_id', $get('kelas_id'))
                                                    ->count();

                                                $set('jumlah_print', $jumlahsantri);
                                            }
                                        } elseif ($getkelasinternal !== null) {
                                            $getmapel = Mapel::where('id', $get('mapel_id'))->first();
                                            $mapel = $getmapel->mapel;

                                            $kodesoal = $qismdetail . "-" . $tahunajaran . "-" . $semester . "-" . $getkelasinternal . "-" . $mapel;

                                            $set('kode_soal', $kodesoal);

                                            $jumlahsantri = KelasSantri::whereHas('statussantri', function ($query) {
                                                $query->where('status', 'Aktif');
                                            })
                                                ->where('qism_detail_id', $get('qism_detail_id'))
                                                ->where('tahun_berjalan_id', $get('tahun_berjalan_id'))
                                                ->where('kelas_internal', $get('kelas_internal'))
                                                ->count();

                                            $set('jumlah_print', $jumlahsantri);
                                        }
                                    } else {
                                        return;
                                    }
                                }),

                            Select::make('jenis_soal_id')
                                ->label('Jenis Soal')
                                ->options(JenisSoal::whereIsActive(1)->pluck('jenis_soal', 'id'))
                                ->disabled()
                                ->dehydrated()
                                ->required()
                                ->native(false),

                            Select::make('kategori_soal_id')
                                ->label('Kategori')
                                ->options(KategoriSoal::whereIsActive(1)->pluck('kategori', 'id'))
                                ->disabled()
                                ->dehydrated()
                                ->required()
                                ->native(false),

                        ]),

                    Grid::make(4)
                        ->schema([

                            TextInput::make('kode_soal')
                                ->unique(Nilai::class, modifyRuleUsing: function (Unique $rule, Get $get) {

                                    return $rule->where('pengajar_id', $get('pengajar_id'));
                                }, ignoreRecord: true),

                            TextInput::make('soal_dari_ustadz'),

                        ]),

                    Grid::make(4)
                        ->schema([

                            TextInput::make('soal_siap_print'),

                            TextInput::make('jumlah_print'),
                        ]),

                    Grid::make(4)
                        ->schema([
                            TextInput::make('file_nilai'),

                            TextInput::make('keterangan_nilai')
                                ->label('Keterangan Nilai'),

                        ]),

                    Grid::make(4)
                        ->schema([

                            Select::make('pengajar_id')
                                ->label('Pengajar')
                                ->options(Pengajar::whereIsActive(1)->pluck('nama', 'id'))
                                ->unique(Nilai::class, modifyRuleUsing: function (Unique $rule, Get $get) {

                                    return $rule->where('kode_soal', $get('kode_soal'));
                                }, ignoreRecord: true)
                                ->searchable()
                                ->native(false),

                            ToggleButtons::make('staff_admin_id')
                                ->label('PIC')
                                ->inline()
                                ->options(StaffAdmin::all()->pluck('nama_staff', 'id')),
                        ])

                ])
                ->compact(),

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

                ColumnGroup::make('Data Imtihan', [

                    CheckboxColumn::make('is_soal')
                        ->label('Soal')
                        ->alignCenter(),

                    CheckboxColumn::make('is_nilai')
                        ->label('Nilai')
                        ->alignCenter(),

                    TextInputColumn::make('soal_dari_ustadz')
                        ->label('Draft Soal'),

                    TextInputColumn::make('soal_siap_print')
                        ->label('Link Soal'),

                    TextInputColumn::make('file_nilai')
                        ->label('Link Nilai'),

                    CheckboxColumn::make('is_nilai_selesai')
                        ->label('Status N')
                        ->alignCenter(),

                    SelectColumn::make('pengajar_id')
                        ->label('Nama Pengajar')
                        ->options(Pengajar::where('is_active', 1)->pluck('nama', 'id'))
                        ->sortable()
                        ->searchable(isIndividual: true)
                        ->hidden(!auth()->user()->id === 1 || !auth()->user()->id === 2)
                        ->placeholder('Pilih Pengajar')
                        ->extraAttributes([
                            'style' => 'min-width:250px'
                        ]),

                    TextInputColumn::make('kode_soal')
                        ->label('Kode Soal')
                        ->extraAttributes([
                            'style' => 'min-width:250px'
                        ]),

                    SelectColumn::make('qism_id')
                        ->label('Qism')
                        ->options(Qism::all()->pluck('abbr_qism', 'id'))
                        ->sortable()
                        ->extraAttributes([
                            'style' => 'min-width:250px'
                        ]),

                    SelectColumn::make('qism_detail_id')
                        ->label('Qism Detail')
                        ->options(QismDetail::all()->pluck('abbr_qism_detail', 'id'))
                        ->sortable()
                        ->extraAttributes([
                            'style' => 'min-width:250px'
                        ]),

                    SelectColumn::make('kelas_id')
                        ->label('Kelas')
                        ->options(Kelas::all()->pluck('kelas', 'id'))
                        ->sortable()
                        ->extraAttributes([
                            'style' => 'min-width:250px'
                        ]),

                    TextInputColumn::make('kelas_internal')
                        ->label('Kelas Internal')
                        ->alignCenter()
                        ->searchable(isIndividual: true)
                        ->extraAttributes([
                            'style' => 'min-width:250px'
                        ])
                        ->sortable(),

                    TextInputColumn::make('jumlah_print')
                        ->label('Jumlah Print')
                        ->extraAttributes([
                            'style' => 'min-width:250px'
                        ]),

                    SelectColumn::make('tahun_berjalan_id')
                        ->label('Tahun Berjalan')
                        ->options(TahunBerjalan::all()->pluck('tb', 'id'))
                        ->sortable()
                        ->extraAttributes([
                            'style' => 'min-width:250px'
                        ]),

                    SelectColumn::make('semester_berjalan_id')
                        ->label('Semester Berjalan')
                        ->options(SemesterBerjalan::all()->pluck('semester_berjalan', 'id'))
                        ->sortable()
                        ->extraAttributes([
                            'style' => 'min-width:250px'
                        ]),

                    SelectColumn::make('tahun_ajaran_id')
                        ->label('Tahun Ajaran')
                        ->options(TahunAjaran::all()->pluck('abbr_ta', 'id'))
                        ->sortable()
                        ->extraAttributes([
                            'style' => 'min-width:250px'
                        ]),

                    SelectColumn::make('semester_id')
                        ->label('Semester')
                        ->options(Sem::all()->pluck('semester', 'id'))
                        ->sortable()
                        ->extraAttributes([
                            'style' => 'min-width:250px'
                        ]),

                    SelectColumn::make('mapel_id')
                        ->label('Mapel')
                        ->options(Mapel::all()->pluck('mapel', 'id'))
                        ->sortable()
                        ->searchable(isIndividual: true)
                        ->extraAttributes([
                            'style' => 'min-width:250px'
                        ]),

                    SelectColumn::make('jenis_soal_id')
                        ->label('Jenis Soal')
                        ->options(JenisSoal::all()->pluck('jenis_soal', 'id'))
                        ->sortable()
                        ->extraAttributes([
                            'style' => 'min-width:250px'
                        ]),

                    SelectColumn::make('kategori_soal_id')
                        ->label('Kategori Soal')
                        ->options(KategoriSoal::all()->pluck('kategori', 'id'))
                        ->sortable()
                        ->extraAttributes([
                            'style' => 'min-width:250px'
                        ]),

                    TextInputColumn::make('keterangan_nilai')
                        ->label('Keterangan Nilai')
                        ->extraAttributes([
                            'style' => 'min-width:250px'
                        ]),

                    SelectColumn::make('staff_admin_id')
                        ->label('Staff Admin')
                        ->options(StaffAdmin::all()->pluck('nama_staff', 'id'))
                        ->sortable()
                        ->extraAttributes([
                            'style' => 'min-width:250px'
                        ]),

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
            ->groups([
                Group::make('jenisSoal.jenis_soal')
                    ->titlePrefixedWithLabel(false),
                Group::make('qismDetail.id')
                    ->titlePrefixedWithLabel(false)
            ])
            ->defaultGroup('qismDetail.id')
            ->defaultSort('kode_soal')
            ->recordUrl(null)
            ->searchOnBlur()
            ->extremePaginationLinks()
            ->defaultPaginationPageOption(5)
            ->filters([
                QueryBuilder::make()
                    ->constraintPickerColumns(1)
                    ->constraints([

                        BooleanConstraint::make('is_soal')
                            ->label('Soal')
                            ->icon(false)
                            ->nullable(),

                        BooleanConstraint::make('is_nilai')
                            ->label('Nilai')
                            ->icon(false)
                            ->nullable(),

                        BooleanConstraint::make('is_nilai_selesai')
                            ->label('Nilai Selesai')
                            ->icon(false)
                            ->nullable(),

                        SelectConstraint::make('qism_id')
                            ->label('Qism')
                            ->options(Qism::all()->pluck('abbr_qism', 'id'))
                            ->multiple()
                            ->nullable(),

                        SelectConstraint::make('qism_detail_id')
                            ->label('Qism Detail')
                            ->options(QismDetail::all()->pluck('abbr_qism_detail', 'id'))
                            ->multiple()
                            ->nullable(),

                        SelectConstraint::make('kelas_id')
                            ->label('Kelas')
                            ->options(Kelas::all()->pluck('kelas', 'id'))
                            ->multiple()
                            ->nullable(),

                        TextConstraint::make('kelas_internal')
                            ->label('Kelas Internal')
                            ->icon(false)
                            ->nullable(),

                        TextConstraint::make('jumlah_print')
                            ->label('Jumlah Print')
                            ->icon(false)
                            ->nullable(),

                        SelectConstraint::make('tahun_berjalan_id')
                            ->label('Tahun Berjalan')
                            ->options(TahunBerjalan::all()->pluck('tb', 'id'))
                            ->multiple()
                            ->nullable(),

                        SelectConstraint::make('semester_berjalan_id')
                            ->label('Semester Berjalan')
                            ->options(SemesterBerjalan::all()->pluck('semester_berjalan', 'id'))
                            ->multiple()
                            ->nullable(),

                        SelectConstraint::make('tahun_ajaran_id')
                            ->label('Tahun Ajaran')
                            ->options(TahunAjaran::all()->pluck('abbr_ta', 'id'))
                            ->multiple()
                            ->nullable(),

                        SelectConstraint::make('semester_id')
                            ->label('Semester')
                            ->options(Sem::all()->pluck('semester', 'id'))
                            ->multiple()
                            ->nullable(),

                        SelectConstraint::make('mapel_id')
                            ->label('Mapel')
                            ->options(Mapel::all()->pluck('mapel', 'id'))
                            ->multiple()
                            ->nullable(),

                        SelectConstraint::make('jenis_soal_id')
                            ->label('Jenis Soal')
                            ->options(JenisSoal::all()->pluck('jenis_soal', 'id'))
                            ->multiple()
                            ->nullable(),

                        SelectConstraint::make('kategori_soal_id')
                            ->label('Kategori Soal')
                            ->options(KategoriSoal::all()->pluck('kategori', 'id'))
                            ->multiple()
                            ->nullable(),

                        TextConstraint::make('keterangan_nilai')
                            ->label('Keterangan Nilai')
                            ->icon(false)
                            ->nullable(),

                        SelectConstraint::make('pengajar_id')
                            ->label('Nama Pengajar')
                            ->options(Pengajar::all()->pluck('nama', 'id'))
                            ->multiple()
                            ->nullable(),

                        SelectConstraint::make('staff_admin_id')
                            ->label('Staff Admin')
                            ->options(StaffAdmin::all()->pluck('nama_staff', 'id'))
                            ->multiple()
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
                    ->importer(DataImtihanImporter::class)
            ])
            ->actions([
                ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ]),
                ReplicateAction::make()
                    ->hiddenLabel()
                    ->form(static::DataImtihanFormSchema())
                    ->modalWidth('full'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),

                Tables\Actions\BulkAction::make('soal')
                    ->label(__('Soal'))
                    ->color('success')
                    // ->requiresConfirmation()
                    // ->modalIcon('heroicon-o-check-circle')
                    // ->modalIconColor('success')
                    // ->modalHeading('Tandai Data sebagai Soal?')
                    // ->modalDescription('Setelah klik tombol "Simpan", maka status akan berubah')
                    // ->modalSubmitActionLabel('Simpan')
                    ->action(fn(Collection $records, array $data) => $records->each(
                        function ($record) {

                            $data['is_soal'] = 1;
                            $record->update($data);

                            return $record;

                            Notification::make()
                                ->success()
                                ->title('Data telah diubah')
                                ->persistent()
                                ->color('Success')
                                ->send();
                        }
                    ))
                    ->deselectRecordsAfterCompletion(),

                Tables\Actions\BulkAction::make('resetsoal')
                    ->label(__('Reset Soal'))
                    ->color('gray')
                    // ->requiresConfirmation()
                    // ->modalIcon('heroicon-o-arrow-path')
                    // ->modalIconColor('gray')
                    // ->modalHeading(new HtmlString('Reset tanda Soal?'))
                    // ->modalDescription('Setelah klik tombol "Simpan", maka status akan berubah')
                    // ->modalSubmitActionLabel('Simpan')
                    ->action(fn(Collection $records, array $data) => $records->each(
                        function ($record) {

                            $data['is_soal'] = 0;
                            $record->update($data);

                            return $record;

                            Notification::make()
                                ->success()
                                ->title('Status Ananda telah diupdate')
                                ->persistent()
                                ->color('Success')
                                ->send();
                        }
                    ))->deselectRecordsAfterCompletion(),

                Tables\Actions\BulkAction::make('nilai')
                    ->label(__('Nilai'))
                    ->color('success')
                    // ->requiresConfirmation()
                    // ->modalIcon('heroicon-o-check-circle')
                    // ->modalIconColor('success')
                    // ->modalHeading('Tandai Data sebagai Nilai?')
                    // ->modalDescription('Setelah klik tombol "Simpan", maka status akan berubah')
                    // ->modalSubmitActionLabel('Simpan')
                    ->action(fn(Collection $records, array $data) => $records->each(
                        function ($record) {

                            $data['is_nilai'] = 1;
                            $record->update($data);

                            return $record;

                            Notification::make()
                                ->success()
                                ->title('Data telah diubah')
                                ->persistent()
                                ->color('Success')
                                ->send();
                        }
                    ))
                    ->deselectRecordsAfterCompletion(),

                Tables\Actions\BulkAction::make('resetnilai')
                    ->label(__('Reset Nilai'))
                    ->color('gray')
                    // ->requiresConfirmation()
                    // ->modalIcon('heroicon-o-arrow-path')
                    // ->modalIconColor('gray')
                    // ->modalHeading(new HtmlString('Reset tanda Nilai?'))
                    // ->modalDescription('Setelah klik tombol "Simpan", maka status akan berubah')
                    // ->modalSubmitActionLabel('Simpan')
                    ->action(fn(Collection $records, array $data) => $records->each(
                        function ($record) {

                            $data['is_nilai'] = 0;
                            $record->update($data);

                            return $record;

                            Notification::make()
                                ->success()
                                ->title('Status Ananda telah diupdate')
                                ->persistent()
                                ->color('Success')
                                ->send();
                        }
                    ))->deselectRecordsAfterCompletion(),

                Tables\Actions\BulkAction::make('soalnilai')
                    ->label(__('Soal & Nilai'))
                    ->color('success')
                    // ->requiresConfirmation()
                    // ->modalIcon('heroicon-o-check-circle')
                    // ->modalIconColor('success')
                    // ->modalHeading('Tandai Data sebagai Soal?')
                    // ->modalDescription('Setelah klik tombol "Simpan", maka status akan berubah')
                    // ->modalSubmitActionLabel('Simpan')
                    ->action(fn(Collection $records, array $data) => $records->each(
                        function ($record) {

                            $data['is_soal'] = 1;
                            $data['is_nilai'] = 1;
                            $record->update($data);

                            return $record;

                            Notification::make()
                                ->success()
                                ->title('Data telah diubah')
                                ->persistent()
                                ->color('Success')
                                ->send();
                        }
                    ))
                    ->deselectRecordsAfterCompletion(),

                Tables\Actions\BulkAction::make('resetsoalnilai')
                    ->label(__('Reset Soal & Nilai'))
                    ->color('gray')
                    // ->requiresConfirmation()
                    // ->modalIcon('heroicon-o-arrow-path')
                    // ->modalIconColor('gray')
                    // ->modalHeading(new HtmlString('Reset tanda Soal?'))
                    // ->modalDescription('Setelah klik tombol "Simpan", maka status akan berubah')
                    // ->modalSubmitActionLabel('Simpan')
                    ->action(fn(Collection $records, array $data) => $records->each(
                        function ($record) {

                            $data['is_soal'] = 0;
                            $data['is_nilai'] = 0;
                            $record->update($data);

                            return $record;

                            Notification::make()
                                ->success()
                                ->title('Status Ananda telah diupdate')
                                ->persistent()
                                ->color('Success')
                                ->send();
                        }
                    ))->deselectRecordsAfterCompletion(),

                ExportBulkAction::make()
                    ->label('Export')
                    ->exporter(NilaiExporter::class),

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
            'index' => Pages\ListDataImtihans::route('/'),
            'create' => Pages\CreateDataImtihan::route('/create'),
            'view' => Pages\ViewDataImtihan::route('/{record}'),
            'edit' => Pages\EditDataImtihan::route('/{record}/edit'),
        ];
    }
}
