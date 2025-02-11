<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\UpdateStatusNaikQismResource\Pages;
use App\Filament\Admin\Resources\UpdateStatusNaikQismResource\RelationManagers;
use App\Models\Kelas;
use App\Models\KelasSantri;
use App\Models\QismDetail;
use App\Models\QismDetailHasKelas;
use App\Models\Santri;
use App\Models\TahunAjaran;
use App\Models\TahunAjaranAktif;
use App\Models\TahunBerjalan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\TextInputColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class UpdateStatusNaikQismResource extends Resource
{
    protected static ?string $model = KelasSantri::class;

    public static function canViewAny(): bool
    {
        return auth()->user()->id == 1 || auth()->user()->id == 2;
    }

    protected static ?string $modelLabel = 'Update Santri Naik Qism';

    protected static ?string $pluralModelLabel = 'Update Santri Naik Qism';

    protected static ?string $navigationLabel = 'Update Santri Naik Qism';

    protected static ?int $navigationSort = 200000000;

    // protected static ?string $navigationIcon = 'heroicon-o-Qisms';

    // protected static ?string $cluster = Kesantrian::class;

    protected static ?string $navigationGroup = 'PSB';

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
                TextColumn::make('santri.id')
                    ->label('Nama')
                    ->searchable(isIndividual: true, isGlobal: false)
                    ->sortable(),

                TextColumn::make('santri.nism')
                    ->label('NISM')
                    ->searchable(isIndividual: true, isGlobal: false)
                    ->sortable(),

                TextInputColumn::make('santri.kartu_keluarga')
                    ->label('KK')
                    ->searchable(isIndividual: true, isGlobal: false)
                    ->sortable(),

                TextColumn::make('santri.nama_lengkap')
                    ->label('Nama')
                    ->searchable(isIndividual: true, isGlobal: false)
                    ->sortable(),

                TextColumn::make('santri.jeniskelamin.jeniskelamin')
                    ->label('Jenis Kelamin')
                    ->searchable(isIndividual: true, isGlobal: false)
                    ->sortable(),

                TextColumn::make('qism_detail.abbr_qism_detail')
                    ->label('Qism')
                    ->searchable(isIndividual: true, isGlobal: false)
                    ->sortable(),
                TextColumn::make('kelas.kelas')
                    ->label('Kelas')
                    ->searchable(isIndividual: true, isGlobal: false)
                    ->sortable(),

                TextColumn::make('santri.jenisPendaftar.jenis_pendaftar')
                    ->label('Mendaftar')
                    ->searchable(isIndividual: true, isGlobal: false)
                    ->sortable(),
            ])
            ->groups([
                'qism_detail.abbr_qism_detail',
            ])
            ->defaultGroup('qism_detail.abbr_qism_detail')
            ->filters([
                SelectFilter::make('qism_detail_id')
                    ->label('Qism')
                    ->multiple()
                    ->options(QismDetail::all()->pluck('abbr_qism_detail', 'id')),

                SelectFilter::make('kelas_id')
                    ->label('Kelas')
                    ->multiple()
                    ->options(Kelas::all()->pluck('kelas', 'id')),
            ])
            ->actions([
                // Tables\Actions\ViewAction::make(),
                // Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkAction::make('naikqism')
                    ->label(__('Naik Qism'))
                    ->color('info')
                    ->requiresConfirmation()
                    ->modalIcon('heroicon-o-check-circle')
                    ->modalIconColor('info')
                    ->modalHeading('Ubah Status Santri sebagai Pendaftar Naik Qism?')
                    ->modalDescription('Setelah klik tombol "Simpan", maka status akan berubah')
                    ->modalSubmitActionLabel('Simpan')
                    ->action(fn(Collection $records, array $data) => $records->each(function ($record) {

                        $naikqism = QismDetailHasKelas::where('qism_id', $record->qism_id)
                            ->where('qism_detail_id', $record->qism_detail_id)
                            ->where('kelas_id', $record->kelas_id)->first();

                        $tahunberjalanaktif = TahunBerjalan::where('is_active', 1)->first();
                        $ts = TahunBerjalan::where('tb', $tahunberjalanaktif->ts)->first();

                        $taaktif = TahunAjaranAktif::where('is_active', true)->where('qism_id', $naikqism->qism_s)->first();

                        $tasel = TahunAjaran::where('id', $taaktif->tahun_ajaran_id)->first();

                        if ($naikqism->terakhir == true) {

                            if ($record->is_mustamiah == true) {

                                $santri = Santri::where('id', $record->santri_id)->first();
                                $santri->tahun_berjalan_id = $ts->id;
                                $santri->tahun_ajaran_id = $tasel->tahun_ajaran_id;
                                $santri->qism_id = $record->qism_id;
                                $santri->qism_detail_id = $record->qism_detail_id;
                                $santri->kelas_id = $record->kelas_id;
                                $santri->jenis_pendaftar_id = 2;
                                $santri->qism = null;
                                $santri->qism_tujuan = null;
                                $santri->qism_detail = null;
                                $santri->qism_detail_tujuan = null;
                                $santri->kelas = null;
                                $santri->kelas_tujuan = null;
                                $santri->naikqism = null;
                                $santri->daftarnaikqism = 'Belum Mendaftar';
                                $santri->tahap = null;
                                $santri->status_tahap = null;
                                $santri->deskripsitahap = null;
                                $santri->jenispendaftar = null;
                                $santri->tahap_pendaftaran_id = null;
                                $santri->status_pendaftaran_id = null;
                                $santri->ps_kadm_status_id = null;
                                $santri->file_kk = null;
                                $santri->file_akte = null;
                                $santri->file_srs = null;
                                $santri->file_ijz = null;
                                $santri->file_kk = null;
                                $santri->file_skt = null;
                                $santri->file_skuasa = null;
                                $santri->file_cvd = null;
                                $santri->file_spkm = null;
                                $santri->file_pka = null;
                                $santri->file_ktmu = null;
                                $santri->file_ktmp = null;

                                $santri->save();

                                Notification::make()
                                    ->success()
                                    ->title('Status Ananda telah diupdate')
                                    ->icon('heroicon-o-check-circle')
                                    // ->persistent()
                                    ->color('Success')
                                    // ->actions([
                                    //     Action::make('view')
                                    //         ->button(),
                                    //     Action::make('undo')
                                    //         ->color('secondary'),
                                    // ])
                                    ->send();
                            } elseif ($record->is_mustamiah != true) {

                                $santri = Santri::where('id', $record->santri_id)->first();
                                $santri->tahun_berjalan_id = $ts->id;
                                $santri->tahun_ajaran_id = $tasel->tahun_ajaran_id;
                                $santri->qism_id = $naikqism->qism_s;
                                $santri->qism_detail_id = $naikqism->qism_detail_s;
                                $santri->kelas_id = $naikqism->kelas_s;
                                $santri->jenis_pendaftar_id = 2;
                                $santri->qism = null;
                                $santri->qism_tujuan = null;
                                $santri->qism_detail = null;
                                $santri->qism_detail_tujuan = null;
                                $santri->kelas = null;
                                $santri->kelas_tujuan = null;
                                $santri->naikqism = null;
                                $santri->daftarnaikqism = 'Belum Mendaftar';
                                $santri->tahap = null;
                                $santri->status_tahap = null;
                                $santri->deskripsitahap = null;
                                $santri->jenispendaftar = null;
                                $santri->tahap_pendaftaran_id = null;
                                $santri->status_pendaftaran_id = null;
                                $santri->ps_kadm_status_id = null;
                                $santri->file_kk = null;
                                $santri->file_akte = null;
                                $santri->file_srs = null;
                                $santri->file_ijz = null;
                                $santri->file_kk = null;
                                $santri->file_skt = null;
                                $santri->file_skuasa = null;
                                $santri->file_cvd = null;
                                $santri->file_spkm = null;
                                $santri->file_pka = null;
                                $santri->file_ktmu = null;
                                $santri->file_ktmp = null;

                                $santri->save();

                                Notification::make()
                                    ->success()
                                    ->title('Status Ananda telah diupdate')
                                    ->icon('heroicon-o-check-circle')
                                    // ->persistent()
                                    ->color('Success')
                                    // ->actions([
                                    //     Action::make('view')
                                    //         ->button(),
                                    //     Action::make('undo')
                                    //         ->color('secondary'),
                                    // ])
                                    ->send();
                            }
                        } else {
                            Notification::make()
                                // ->success()
                                ->title('Belum saatnya naik qism')
                                // ->persistent()
                                ->color('Warning')
                                ->send();
                        }
                    }))->deselectRecordsAfterCompletion()
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
            'index' => Pages\ListUpdateStatusNaikQisms::route('/'),
            'create' => Pages\CreateUpdateStatusNaikQism::route('/create'),
            'view' => Pages\ViewUpdateStatusNaikQism::route('/{record}'),
            'edit' => Pages\EditUpdateStatusNaikQism::route('/{record}/edit'),
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
