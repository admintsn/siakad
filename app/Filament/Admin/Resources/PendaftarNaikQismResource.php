<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\PendaftarNaikQismResource\Pages;
use App\Filament\Admin\Resources\PendaftarNaikQismResource\RelationManagers;
use App\Models\Kelas;
use App\Models\KelasSantri;
use App\Models\NismPerTahun;
use App\Models\PendaftarNaikQism;
use App\Models\Qism;
use App\Models\QismDetail;
use App\Models\Santri;
use App\Models\Semester;
use App\Models\SemesterBerjalan;
use App\Models\StatusPendaftaran;
use App\Models\StatusSantri;
use App\Models\TahapPendaftaran;
use App\Models\TahunAjaranAktif;
use App\Models\TahunBerjalan;
use App\Models\User;
use App\Models\Walisantri;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Support\Enums\FontWeight;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\ActionsPosition;
use Filament\Tables\Filters\QueryBuilder;
use Filament\Tables\Filters\QueryBuilder\Constraints\SelectConstraint;
use Filament\Tables\Filters\QueryBuilder\Constraints\TextConstraint;
use Filament\Tables\Grouping\Group;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;

class PendaftarNaikQismResource extends Resource
{
    protected static ?string $model = Santri::class;

    public static function canViewAny(): bool
    {
        return auth()->user()->mudirqism !== null;
    }

    protected static ?string $modelLabel = 'Pendaftar Naik Qism';

    protected static ?string $pluralModelLabel = 'Pendaftar Naik Qism';

    protected static ?string $navigationLabel = 'Pendaftar Naik Qism';

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

                TextColumn::make('file_skt')
                    ->label('2. Surat Keterangan Taklim')
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

                TextColumn::make('file_spkm')
                    ->label('3. Surat Pernyataan Kesanggupan')
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
                    ->label('4. Surat Permohonan Keringanan Administrasi')
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
                    ->label('5. Surat Keterangan Tidak Mampu (U)')
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
                    ->label('6. Surat Keterangan Tidak Mampu (P)')
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
                    ->label('7. Surat Keterangan Sehat dari RS/Puskesmas/Klinik')
                    ->description(fn(): string => 'Surat Keterangan Sehat', position: 'above')
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
                Group::make('qism_detail_id')
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
            ], position: ActionsPosition::BeforeCells)
            ->bulkActions([

                Tables\Actions\BulkAction::make('diterima')
                    ->label(__('Diterima'))
                    ->color('success')
                    ->requiresConfirmation()
                    ->modalIcon('heroicon-o-check-circle')
                    ->modalIconColor('success')
                    ->modalHeading('Ubah Status menjadi "Diterima naik qism?"')
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

                            $kelassantri = new KelasSantri();

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

                            $statusantri = StatusSantri::where('santri_id', $record->id)->first();
                            $statusantri->stat_santri_id = 3;
                            $statusantri->keterangan_status_santri_id = null;
                            $statusantri->save();

                            $statususer = User::where('username', $record->kartu_keluarga)->first();
                            $statususer->is_active = 1;
                            $statususer->save();

                            $data['status_pendaftaran_id'] = 2;
                            $data['tahap_pendaftaran_id'] = 2;
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

                Tables\Actions\BulkAction::make('tidakditerima')
                    ->label(__('Tidak Diterima'))
                    ->color('danger')
                    ->requiresConfirmation()
                    ->modalIcon('heroicon-o-exclamation-triangle')
                    ->modalIconColor('danger')
                    ->modalHeading('Ubah Status menjadi "Tidak diterima naik qism?"')
                    ->modalDescription('Setelah klik tombol "Simpan", maka status akan berubah')
                    ->modalSubmitActionLabel('Simpan')
                    ->action(fn(Collection $records, array $data) => $records->each(
                        function ($record) {

                            $santris = Santri::where('kartu_keluarga', $record->kartu_keluarga)->pluck('id');

                            $statusantri = StatusSantri::where('santri_id', $record->id)->first();
                            $statusantri->stat_santri_id = 4;
                            $statusantri->keterangan_status_santri_id = 3;
                            $statusantri->save();

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
                        }
                    ))
                    ->deselectRecordsAfterCompletion(),

            ])
            ->checkIfRecordIsSelectableUsing(

                fn(Model $record): bool => $record->status_pendaftaran_id != 2,
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
