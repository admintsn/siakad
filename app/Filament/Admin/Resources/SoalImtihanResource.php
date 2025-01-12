<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\SoalImtihanResource\Pages;
use App\Filament\Admin\Resources\SoalImtihanResource\RelationManagers;
use App\Filament\Exports\SoalImtihanExporter;
use App\Filament\Imports\SoalImtihanImporter;
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
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\ExportBulkAction;
use Filament\Tables\Actions\ImportAction;
use Filament\Tables\Actions\ReplicateAction;
use Filament\Tables\Columns\CheckboxColumn;
use Filament\Tables\Columns\ColumnGroup;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\TextInputColumn;
use Filament\Tables\Enums\ActionsPosition;
use Filament\Tables\Filters\QueryBuilder;
use Filament\Tables\Filters\QueryBuilder\Constraints\BooleanConstraint;
use Filament\Tables\Filters\QueryBuilder\Constraints\DateConstraint;
use Filament\Tables\Filters\QueryBuilder\Constraints\SelectConstraint;
use Filament\Tables\Filters\QueryBuilder\Constraints\TextConstraint;
use Filament\Tables\Grouping\Group;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Collection;
use Illuminate\Support\HtmlString;
use Illuminate\Validation\Rules\Unique;

class SoalImtihanResource extends Resource
{
    protected static ?string $model = Nilai::class;

    public static function canCreate(): bool
    {
        return auth()->user()->id == 1;
    }

    public static function canEdit(Model $record): bool
    {
        return auth()->user()->id == 1;
    }

    public static function canDeleteAny(): bool
    {
        return auth()->user()->id == 1;
        // return false;
    }

    protected static ?string $modelLabel = 'Soal Imtihan';

    protected static ?string $pluralModelLabel = 'Soal Imtihan';

    protected static ?string $navigationLabel = 'Soal Imtihan';

    protected static ?int $navigationSort = 400000050;

    // protected static ?string $navigationIcon = 'heroicon-o-Qisms';

    // protected static ?string $cluster = Imtihan::class;

    protected static ?string $navigationGroup = 'Imtihan';

    // protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    public static function form(Form $form): Form
    {

        return DataImtihanResource::form($form);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('kode_soal')
                    ->label('Kode Soal')
                    ->copyable()
                    ->copyableState(function ($state) {
                        return ($state);
                    })
                    ->copyMessage('Tersalin'),

                TextColumn::make('qismDetail.abbr_qism_detail')
                    ->label('Qism')
                    ->hidden()
                    ->alignCenter()
                    ->sortable(),

                TextColumn::make('kelas.abbr_kelas')
                    ->label('Kelas')
                    ->alignCenter()
                    ->sortable(),

                // TextInputColumn::make('kelas_internal')
                //     ->label('Kelas Internal')
                //     ->alignCenter()
                //     ->extraAttributes([
                //         'style' => 'max-width:70px'
                //     ])
                //     ->sortable(),

                TextColumn::make('kelas_internal')
                    ->label('Kelas Internal')
                    ->alignCenter()
                    ->extraAttributes([
                        'style' => 'max-width:70px'
                    ])
                    ->sortable(),

                TextColumn::make('mapel.mapel')
                    ->label('Mapel')
                    ->sortable(),

                TextColumn::make('pengajar.nama')
                    ->label('Nama Pengajar')
                    ->sortable(),

                // SelectColumn::make('pengajar_id')
                //     ->label('Nama Pengajar')
                //     ->options(Pengajar::all()->pluck('nama', 'id'))
                //     ->sortable()
                //     ->searchable()
                //     ->hidden(!auth()->user()->id === 1 || !auth()->user()->id === 2)
                //     ->placeholder('Pilih Pengajar')
                //     ->extraAttributes([
                //         'style' => 'min-width:230px'
                //     ]),

                SelectColumn::make('staff_admin_id')
                    ->label('PIC')
                    ->options(StaffAdmin::all()->pluck('nama_staff', 'id'))
                    ->sortable()
                    ->placeholder('Pilih')
                    ->extraAttributes([
                        'style' => 'min-width:70px'
                    ]),

                TextColumn::make('soal_dari_ustadz')
                    ->label('Draft Soal')
                    ->formatStateUsing(fn(string $state): string => __("Lihat"))
                    // ->limit(1)
                    ->icon('heroicon-s-eye')
                    ->iconColor('success')
                    ->alignCenter()
                    ->url(function (Model $record) {
                        return ($record->soal_dari_ustadz);
                    })
                    ->badge()
                    ->color('gray')
                    ->openUrlInNewTab(),

                CheckboxColumn::make('status_soal')
                    ->label('Status Soal')
                    ->extraAttributes([
                        'style' => 'max-width:70px'
                    ])
                    ->alignCenter(),

                TextColumn::make('soal_siap_print')
                    ->label('Soal')
                    ->formatStateUsing(fn(string $state): string => __("Lihat"))
                    // ->limit(1)
                    ->icon('heroicon-s-eye')
                    ->iconColor('success')
                    ->alignCenter()
                    ->url(function (Model $record) {
                        return ($record->soal_siap_print);
                    })
                    ->badge()
                    ->color('gray')
                    ->openUrlInNewTab(),

                TextInputColumn::make('jumlah_print')
                    ->label('Jumlah Santri')
                    ->alignCenter()
                    ->extraAttributes([
                        'style' => 'max-width:70px'
                    ])
                    ->disabled(auth()->user()->id <> 1),

                // TextColumn::make('jumlah_print')
                //     ->label('Jumlah Santri')
                //     ->alignCenter()
                //     ->extraAttributes([
                //         'style' => 'max-width:70px'
                //     ]),

                TextColumn::make('total_print')
                    ->label('Jumlah Print')
                    ->getStateUsing(function (Model $record): float {
                        if ($record->jumlah_print === null) {
                            return 0;
                        } elseif ($record->jumlah_print !== null) {
                            return $record->jumlah_print + 1;
                        }
                    })
                    ->alignCenter(),

                CheckboxColumn::make('status_print')
                    ->label('Status Print')
                    ->alignCenter(),
            ])
            ->groups([
                Group::make('qismDetail.abbr_qism_detail')
                    ->titlePrefixedWithLabel(false)
            ])

            ->defaultGroup('qismDetail.abbr_qism_detail')
            ->defaultSort('kode_soal')
            ->recordUrl(null)
            ->searchOnBlur()
            ->paginated(false)
            ->striped()
            ->filters([
                QueryBuilder::make()
                    ->constraintPickerColumns(1)
                    ->constraints([

                        TextConstraint::make('kode_soal')
                            ->label('Kode Soal')
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

                        BooleanConstraint::make('status_soal')
                            ->label('Status Soal')
                            ->icon(false)
                            ->nullable(),

                        BooleanConstraint::make('status_print')
                            ->label('Status Print')
                            ->icon(false)
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
            ->actions([
                ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),

                    Action::make('reset_jumlah_print')
                        ->label(__('Reset Jumlah Print'))
                        // ->button()
                        // ->outlined()
                        ->icon('heroicon-o-arrow-path')
                        // ->color('primary')
                        ->requiresConfirmation()
                        ->modalIcon('heroicon-o-exclamation-triangle')
                        ->modalIconColor('danger')
                        ->modalHeading(new HtmlString('Reset Jumlah Print?'))
                        ->modalDescription('Setelah klik tombol "Simpan", maka jumlah print akan ter-reset sesuai jumlah santri per kelas')
                        ->modalSubmitActionLabel('Simpan')
                        ->visible(auth()->user()->id == 1 || auth()->user()->id == 2)
                        ->action(function (Model $record) {

                            if ($record->kelas_internal === null) {
                                $santri = KelasSantri::whereHas('statussantri', function ($query) {
                                    $query->where('status', 'Aktif');
                                })
                                    ->where('qism_detail_id', $record->qism_detail_id)
                                    ->where('tahun_berjalan_id', $record->tahun_berjalan_id)
                                    ->where('kelas_id', $record->kelas_id)
                                    ->count();


                                $data['jumlah_print'] = $santri;
                                $record->update($data);

                                return $record;
                            } elseif ($record->kelas_internal !== null) {

                                $santri = KelasSantri::whereHas('statussantri', function ($query) {
                                    $query->where('status', 'Aktif');
                                })
                                    ->where('qism_detail_id', $record->qism_detail_id)
                                    ->where('tahun_berjalan_id', $record->tahun_berjalan_id)
                                    ->where('kelas_internal', $record->kelas_internal)
                                    ->count();


                                $data['jumlah_print'] = $santri;
                                $record->update($data);

                                return $record;
                            }
                        }),
                ])->visible(auth()->user()->id == 1 || auth()->user()->id == 2),

            ], position: ActionsPosition::BeforeCells)
            ->groupingSettingsHidden();
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
            'index' => Pages\ListSoalImtihans::route('/'),
            'create' => Pages\CreateSoalImtihan::route('/create'),
            'view' => Pages\ViewSoalImtihan::route('/{record}'),
            'edit' => Pages\EditSoalImtihan::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {

        $tb = TahunBerjalan::where('is_active', 1)->first();
        $sm = SemesterBerjalan::where('is_active', 1)->first();

        return parent::getEloquentQuery()->where('is_soal', true)->where('tahun_berjalan_id', $tb->id)->where('semester_berjalan_id', $sm->id);
    }
}
