<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\KelasSantriResource\Pages;
use App\Filament\Admin\Resources\KelasSantriResource\RelationManagers;
use App\Filament\Exports\DataSantriExporter;
use App\Filament\Exports\KelasSantriExporter;
use App\Models\Kelas;
use App\Models\KelasSantri;
use App\Models\Qism;
use App\Models\QismDetail;
use App\Models\QismDetailHasKelas;
use App\Models\Santri;
use App\Models\Sem;
use App\Models\SemesterBerjalan;
use App\Models\TahunAjaran;
use App\Models\TahunAjaranAktif;
use App\Models\TahunBerjalan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\ExportBulkAction;
use Filament\Tables\Columns\CheckboxColumn;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\TextInputColumn;
use Filament\Tables\Filters\QueryBuilder;
use Filament\Tables\Filters\QueryBuilder\Constraints\BooleanConstraint;
use Filament\Tables\Filters\QueryBuilder\Constraints\DateConstraint;
use Filament\Tables\Filters\QueryBuilder\Constraints\SelectConstraint;
use Filament\Tables\Filters\QueryBuilder\Constraints\TextConstraint;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class KelasSantriResource extends Resource
{
    protected static ?string $model = KelasSantri::class;

    public static function canViewAny(): bool
    {
        return auth()->user()->id == 1 || auth()->user()->id == 2;
    }

    protected static ?string $modelLabel = 'Kelas Santri';

    protected static ?string $pluralModelLabel = 'Kelas Santri';

    protected static ?string $navigationLabel = 'Kelas Santri';

    protected static ?int $navigationSort = 300000100;

    // protected static ?string $navigationIcon = 'heroicon-o-Qisms';

    // protected static ?string $cluster = Kesantrian::class;

    protected static ?string $navigationGroup = 'Data Santri';

    // protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('santri_id')
                    ->label('Santri ID')
                    ->searchable(isIndividual: true, isGlobal: false)
                    ->toggleable()
                    ->toggledHiddenByDefault(true)
                    ->sortable(),

                TextColumn::make('santri.nism')
                    ->label('NISM')
                    ->searchable(isIndividual: true, isGlobal: false)
                    ->extraAttributes([
                        'style' => 'width:150px'
                    ])
                    ->sortable(),

                SelectColumn::make('qism_detail_id')
                    ->label('Qism Detail')
                    ->options(QismDetail::whereIsActive(1)->pluck('abbr_qism_detail', 'id'))
                    ->searchable(isIndividual: true, isGlobal: false)
                    ->sortable(query: function (Builder $query, string $direction): Builder {
                        return $query
                            ->orderBy('qism_detail_id', $direction)
                            ->orderBy('kelas_id', $direction)
                            ->orderBy('nama_lengkap', $direction);
                    })
                    ->disabled(auth()->user()->id <> 1)
                    ->extraAttributes([
                        'style' => 'min-width:150px'
                    ]),

                SelectColumn::make('kelas_id')
                    ->label('Kelas')
                    ->options(Kelas::whereIsActive(1)->pluck('kelas', 'id'))
                    ->searchable(isIndividual: true, isGlobal: false)
                    ->sortable()
                    ->disabled(auth()->user()->id <> 1)
                    ->extraAttributes([
                        'style' => 'min-width:150px'
                    ]),

                TextInputColumn::make('kelas_internal')
                    ->label('Kelas Internal')
                    ->searchable(isIndividual: true, isGlobal: false)
                    ->toggleable()
                    // ->toggledHiddenByDefault(true)
                    ->extraAttributes([
                        'style' => 'width:150px'
                    ])
                    ->sortable(),

                CheckboxColumn::make('is_mustamiah')
                    ->label('Mustamiah?')
                    ->alignCenter(),

                TextInputColumn::make('halaqoh')
                    ->label('Halaqoh')
                    ->searchable(isIndividual: true, isGlobal: false)
                    ->toggleable()
                    // ->toggledHiddenByDefault(true)
                    ->extraAttributes([
                        'style' => 'width:150px'
                    ])
                    ->sortable(),

                TextColumn::make('nama_lengkap')
                    ->label('Santri')
                    ->searchable(isIndividual: true, isGlobal: false)
                    ->sortable(),

                TextInputColumn::make('kode_nomor_rapor')
                    ->label('Kode Nomor Rapor')
                    ->searchable(isIndividual: true, isGlobal: false)
                    ->toggleable()
                    // ->toggledHiddenByDefault(true)
                    ->extraAttributes([
                        'style' => 'width:150px'
                    ])
                    ->sortable(),

                TextInputColumn::make('nomor_rapor')
                    ->label('Nomor Rapor')
                    ->searchable(isIndividual: true, isGlobal: false)
                    ->toggleable()
                    // ->toggledHiddenByDefault(true)
                    ->extraAttributes([
                        'style' => 'width:150px'
                    ])
                    ->sortable(),

                TextInputColumn::make('kode_nomor_ijazah')
                    ->label('Kode Nomor Ijazah')
                    ->searchable(isIndividual: true, isGlobal: false)
                    ->toggleable()
                    // ->toggledHiddenByDefault(true)
                    ->extraAttributes([
                        'style' => 'width:150px'
                    ])
                    ->sortable(),

                TextInputColumn::make('nomor_ijazah')
                    ->label('Nomor Ijazah')
                    ->searchable(isIndividual: true, isGlobal: false)
                    ->toggleable()
                    // ->toggledHiddenByDefault(true)
                    ->extraAttributes([
                        'style' => 'width:150px'
                    ])
                    ->sortable(),

                TextColumn::make('walisantri.ak_nama_lengkap')
                    ->label('Nama Walisantri')
                    ->searchable(isIndividual: true, isGlobal: false)
                    ->sortable(),

                SelectColumn::make('tahun_berjalan_id')
                    ->label('Tahun Berjalan')
                    ->options(TahunBerjalan::whereIsActive(1)->pluck('tb', 'id'))
                    ->searchable(isIndividual: true, isGlobal: false)
                    ->sortable()
                    ->disabled(auth()->user()->id <> 1)
                    ->extraAttributes([
                        'style' => 'min-width:200px'
                    ]),

                SelectColumn::make('tahun_ajaran_id')
                    ->label('Tahun Ajaran')
                    ->options(TahunAjaran::whereIsActive(1)->pluck('abbr_ta', 'id'))
                    ->searchable(isIndividual: true, isGlobal: false)
                    ->sortable()
                    ->disabled(auth()->user()->id <> 1)
                    ->extraAttributes([
                        'style' => 'min-width:200px'
                    ]),

                SelectColumn::make('semester_berjalan_id')
                    ->label('Semester Berjalan')
                    ->options(SemesterBerjalan::whereIsActive(1)->pluck('semester_berjalan', 'id'))
                    ->searchable(isIndividual: true, isGlobal: false)
                    ->sortable()
                    ->disabled(auth()->user()->id <> 1)
                    ->extraAttributes([
                        'style' => 'min-width:200px'
                    ]),

                TextInputColumn::make('kelas_internal_barab')
                    ->label('Kelas Internal Bahasa Arab')
                    ->searchable(isIndividual: true, isGlobal: false)
                    ->toggleable()
                    // ->toggledHiddenByDefault(true)
                    ->extraAttributes([
                        'style' => 'width:150px'
                    ])
                    ->sortable(),

                TextInputColumn::make('kelas_internal_matematika')
                    ->label('Kelas Internal Matematika')
                    ->searchable(isIndividual: true, isGlobal: false)
                    ->toggleable()
                    // ->toggledHiddenByDefault(true)
                    ->extraAttributes([
                        'style' => 'width:150px'
                    ])
                    ->sortable(),

            ])
            ->recordUrl(null)
            ->defaultSort('nama_lengkap')
            ->searchOnBlur()
            ->filters([
                QueryBuilder::make()
                    ->constraintPickerColumns(1)
                    ->constraints([

                        // SelectConstraint::make('qism_id')
                        //     ->label('Qism')
                        //     ->options(Qism::whereIsActive(1)->pluck('abbr_qism', 'id'))
                        //     ->nullable(),

                        SelectConstraint::make('qism_detail_id')
                            ->label('Qism Detail')
                            ->options(QismDetail::whereIsActive(1)->pluck('abbr_qism_detail', 'id'))
                            ->multiple()
                            ->nullable(),

                        SelectConstraint::make('kelas_id')
                            ->label('Kelas')
                            ->options(Kelas::whereIsActive(1)->pluck('kelas', 'id'))
                            ->multiple()
                            ->nullable(),

                        TextConstraint::make('nama_lengkap')
                            ->label('Nama Santri')
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
            ->headerActions([
                // Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                // ActionGroup::make([
                //     Tables\Actions\ViewAction::make(),
                //     Tables\Actions\EditAction::make(),
                //     Tables\Actions\DeleteAction::make(),
                // ]),


            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),

                ExportBulkAction::make()
                    ->label('Export')
                    ->exporter(DataSantriExporter::class),

                Tables\Actions\BulkAction::make('kodenomorraporijazah')
                    ->label(__('Kode Nomor Rapor dan Ijazah'))
                    ->color('info')
                    ->requiresConfirmation()
                    ->modalIcon('heroicon-o-check-circle')
                    ->modalIconColor('success')
                    ->modalHeading('Generate Kode Nomor Rapor dan Ijazah?')
                    ->modalSubmitActionLabel('Simpan')
                    ->action(fn(Collection $records, array $data) => $records->each(
                        function ($record) {

                            $q = Qism::where('id', $record->qism_id)->first();
                            $kt = QismDetailHasKelas::where('qism_id', $record->qism_id)
                                ->where('qism_detail_id', $record->qism_detail_id)
                                ->where('kelas_id', $record->kelas_id)->first();

                            // dd($kt->terakhir);
                            $ta = TahunAjaran::where('id', $record->tahun_ajaran_id)->first();

                            $taaktif = TahunAjaranAktif::where('qism_id', $record->qism_id)
                                ->where('tahun_ajaran_id', $record->tahun_ajaran_id)
                                ->where('is_active', 1)->first();

                            $sm = Sem::where('id', $taaktif->semester_id)->first();

                            $raporterakhir = KelasSantri::max('nomor_rapor');
                            $ijazahterakhir = KelasSantri::max('nomor_ijazah');

                            // dd($q->id, $ta->abbr_ta, $sm->id, $raporterakhir, $ijazahterakhir);

                            if ($kt->terakhir == null) {

                                // dd('1');

                                if ($record->nomor_rapor != null) {
                                    return;
                                } elseif ($record->nomor_rapor == null) {

                                    if ($raporterakhir ==  null) {
                                        $data['kode_nomor_rapor'] = 'R' . $q->id . '' . $ta->abbr_ta . '' . $sm->id;
                                        $data['nomor_rapor'] = 1;
                                        $record->update($data);
                                        return $record;
                                    } elseif ($raporterakhir !=  null) {
                                        $data['kode_nomor_rapor'] = 'R' . $q->id . '' . $ta->abbr_ta . '' . $sm->id;
                                        $data['nomor_rapor'] = $raporterakhir + 1;
                                        $record->update($data);
                                        return $record;
                                    }
                                }
                            } elseif ($kt->terakhir != null) {

                                if ($record->nomor_rapor != null) {
                                    return;
                                } elseif ($record->nomor_rapor == null) {

                                    if ($raporterakhir ==  null) {
                                        $data['kode_nomor_rapor'] = 'R' . $q->id . '' . $ta->abbr_ta . '' . $sm->id;
                                        $data['kode_nomor_ijazah'] = 'I' . $q->id . '' . $ta->abbr_ta;
                                        $data['nomor_rapor'] = 1;
                                        $data['nomor_ijazah'] = 1;
                                        $record->update($data);
                                        return $record;
                                    } elseif ($raporterakhir !=  null) {
                                        $data['kode_nomor_rapor'] = 'R' . $q->id . '' . $ta->abbr_ta . '' . $sm->id;
                                        $data['kode_nomor_ijazah'] = 'I' . $q->id . '' . $ta->abbr_ta;
                                        $data['nomor_rapor'] = $raporterakhir + 1;
                                        $data['nomor_ijazah'] = $ijazahterakhir + 1;
                                        $record->update($data);
                                        return $record;
                                    }
                                }
                            }
                        }
                    )),

                Tables\Actions\BulkAction::make('hapuskodenomorraporijazah')
                    ->label(__('Hapus Kode Nomor Rapor dan Ijazah'))
                    ->color('danger')
                    ->requiresConfirmation()
                    ->modalIcon('heroicon-o-check-circle')
                    ->modalIconColor('danger')
                    ->modalHeading('Hapus Kode Nomor Rapor dan Ijazah?')
                    ->modalSubmitActionLabel('Simpan')
                    ->action(fn(Collection $records, array $data) => $records->each(
                        function ($record) {

                            $data['kode_nomor_rapor'] = null;
                            $data['kode_nomor_ijazah'] = null;
                            $data['nomor_rapor'] = null;
                            $data['nomor_ijazah'] = null;
                            $record->update($data);
                            return $record;
                        }
                    )),

                Tables\Actions\BulkAction::make('kodenomorrapor')
                    ->label(__('Kode Nomor Rapor'))
                    ->color('info')
                    ->requiresConfirmation()
                    ->modalIcon('heroicon-o-check-circle')
                    ->modalIconColor('success')
                    ->modalHeading('Generate Kode Nomor Rapor?')
                    ->modalSubmitActionLabel('Simpan')
                    ->action(fn(Collection $records, array $data) => $records->each(
                        function ($record) {

                            $q = Qism::where('id', $record->qism_id)->first();
                            $ta = TahunAjaran::where('id', $record->tahun_ajaran_id)->first();

                            $taaktif = TahunAjaranAktif::where('qism_id', $record->qism_id)
                                ->where('tahun_ajaran_id', $record->tahun_ajaran_id)
                                ->where('is_active', 1)->first();

                            $sm = Sem::where('id', $taaktif->semester_id)->first();

                            $raporterakhir = KelasSantri::max('nomor_rapor');
                            $ijazahterakhir = KelasSantri::max('nomor_ijazah');

                            // dd($q->id, $ta->abbr_ta, $sm->id, $raporterakhir, $ijazahterakhir);

                            if ($record->nomor_rapor != null) {
                                return;
                            } elseif ($record->nomor_rapor == null) {

                                if ($raporterakhir ==  null) {
                                    $data['kode_nomor_rapor'] = 'R' . $q->id . '' . $ta->abbr_ta . '' . $sm->id;
                                    $data['nomor_rapor'] = 1;
                                    $record->update($data);
                                    return $record;
                                } elseif ($raporterakhir !=  null) {
                                    $data['kode_nomor_rapor'] = 'R' . $q->id . '' . $ta->abbr_ta . '' . $sm->id;
                                    $data['nomor_rapor'] = $raporterakhir + 1;
                                    $record->update($data);
                                    return $record;
                                }
                            }
                        }
                    )),

                Tables\Actions\BulkAction::make('hapuskodenomorrapor')
                    ->label(__('Hapus Kode Nomor Rapor'))
                    ->color('danger')
                    ->requiresConfirmation()
                    ->modalIcon('heroicon-o-check-circle')
                    ->modalIconColor('danger')
                    ->modalHeading('Hapus Kode Nomor Rapor?')
                    ->modalSubmitActionLabel('Simpan')
                    ->action(fn(Collection $records, array $data) => $records->each(
                        function ($record) {

                            $data['kode_nomor_rapor'] = null;
                            $data['nomor_rapor'] = null;
                            $record->update($data);
                            return $record;
                        }
                    )),

                Tables\Actions\BulkAction::make('kodenomorijazah')
                    ->label(__('Kode Nomor Ijazah'))
                    ->color('info')
                    ->requiresConfirmation()
                    ->modalIcon('heroicon-o-check-circle')
                    ->modalIconColor('success')
                    ->modalHeading('Generate Kode Nomor Ijazah?')
                    ->modalSubmitActionLabel('Simpan')
                    ->action(fn(Collection $records, array $data) => $records->each(
                        function ($record) {

                            $q = Qism::where('id', $record->qism_id)->first();
                            $kt = QismDetailHasKelas::where('qism_id', $record->qism_id)
                                ->where('qism_detail_id', $record->qism_detail_id)
                                ->where('kelas_id', $record->kelas_id)->first();

                            // dd($kt->terakhir);
                            $ta = TahunAjaran::where('id', $record->tahun_ajaran_id)->first();

                            $taaktif = TahunAjaranAktif::where('qism_id', $record->qism_id)
                                ->where('tahun_ajaran_id', $record->tahun_ajaran_id)
                                ->where('is_active', 1)->first();

                            $sm = Sem::where('id', $taaktif->semester_id)->first();

                            $raporterakhir = KelasSantri::max('nomor_rapor');
                            $ijazahterakhir = KelasSantri::max('nomor_ijazah');

                            // dd($q->id, $ta->abbr_ta, $sm->id, $raporterakhir, $ijazahterakhir);

                            if ($kt->terakhir == null) {

                                return;
                            } elseif ($kt->terakhir != null) {

                                if ($record->nomor_ijazah != null) {
                                    return;
                                } elseif ($record->nomor_ijazah == null) {

                                    if ($ijazahterakhir ==  null) {
                                        $data['kode_nomor_ijazah'] = 'I' . $q->id . '' . $ta->abbr_ta;
                                        $data['nomor_ijazah'] = 1;
                                        $record->update($data);
                                        return $record;
                                    } elseif ($ijazahterakhir !=  null) {
                                        $data['kode_nomor_ijazah'] = 'I' . $q->id . '' . $ta->abbr_ta;
                                        $data['nomor_ijazah'] = $ijazahterakhir + 1;
                                        $record->update($data);
                                        return $record;
                                    }
                                }
                            }
                        }
                    )),

                Tables\Actions\BulkAction::make('hapuskodenomorijazah')
                    ->label(__('Hapus Kode Nomor Ijazah'))
                    ->color('danger')
                    ->requiresConfirmation()
                    ->modalIcon('heroicon-o-check-circle')
                    ->modalIconColor('danger')
                    ->modalHeading('Hapus Kode Nomor Ijazah?')
                    ->modalSubmitActionLabel('Simpan')
                    ->action(fn(Collection $records, array $data) => $records->each(
                        function ($record) {

                            $data['kode_nomor_ijazah'] = null;
                            $data['nomor_ijazah'] = null;
                            $record->update($data);
                            return $record;
                        }
                    )),

                Tables\Actions\BulkAction::make('updatenamalengkap')
                    ->label(__('Update Nama'))
                    ->color('warning')
                    ->requiresConfirmation()
                    ->modalIcon('heroicon-o-check-circle')
                    ->modalIconColor('danger')
                    ->modalHeading('Update Nama?')
                    ->modalSubmitActionLabel('Simpan')
                    ->action(fn(Collection $records, array $data) => $records->each(
                        function ($record) {

                            $nama = Santri::where('id', $record->santri_id)->first();

                            $data['nama_lengkap'] = $nama->nama_lengkap;
                            $record->update($data);
                            return $record;
                        }
                    )),

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
            'index' => Pages\ListKelasSantris::route('/'),
            'create' => Pages\CreateKelasSantri::route('/create'),
            'view' => Pages\ViewKelasSantri::route('/{record}'),
            'edit' => Pages\EditKelasSantri::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {

        $tahunberjalanaktif = TahunBerjalan::where('is_active', 1)->first();
        $ts = TahunBerjalan::where('tb', $tahunberjalanaktif->ts)->first();

        return parent::getEloquentQuery()->where('tahun_berjalan_id', $tahunberjalanaktif->id)
            ->whereIn('qism_id', Auth::user()->mudirqism)->whereHas('statussantri', function ($query) {
                $query->where('stat_santri_id', 3);
            });
    }
}
