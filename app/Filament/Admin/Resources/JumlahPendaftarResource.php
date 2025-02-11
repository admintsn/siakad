<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\JumlahPendaftarResource\Pages;
use App\Filament\Admin\Resources\JumlahPendaftarResource\RelationManagers;
use App\Models\JumlahPendaftar;
use App\Models\Santri;
use App\Models\TahunBerjalan;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Form;
use Filament\Pages\SubNavigationPosition;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Actions\ExportBulkAction;
use Filament\Tables\Actions\ImportAction;
use Filament\Tables\Columns\CheckboxColumn;
use Filament\Tables\Columns\ColumnGroup;
use Filament\Tables\Columns\Summarizers\Sum;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\QueryBuilder;
use Filament\Tables\Filters\QueryBuilder\Constraints\BooleanConstraint;
use Filament\Tables\Filters\QueryBuilder\Constraints\DateConstraint;
use Filament\Tables\Filters\QueryBuilder\Constraints\TextConstraint;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Collection;

class JumlahPendaftarResource extends Resource
{
    protected static ?string $model = JumlahPendaftar::class;

    public static function canViewAny(): bool
    {
        return auth()->user()->mudirqism !== null;
    }

    protected static ?string $modelLabel = 'Jumlah Pendaftar';

    protected static ?string $pluralModelLabel = 'Jumlah Pendaftar';

    protected static ?string $navigationLabel = 'Jumlah Pendaftar';

    protected static ?int $navigationSort = 500000010;

    // protected static ?string $navigationIcon = 'heroicon-o-Qisms';

    // protected static ?string $cluster = Report::class;

    protected static ?string $navigationGroup = 'Report';

    // protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordUrl(null)
            ->defaultPaginationPageOption('25')
            ->searchOnBlur()
            ->columns([

                TextColumn::make('qism.qism')
                    ->searchable(),

                TextColumn::make('kelas.kelas')
                    ->searchable(),

                TextColumn::make('putra')
                    ->numeric()
                    ->sortable()
                    ->summarize(Sum::make()->label('')),

                TextColumn::make('putri')
                    ->numeric()
                    ->sortable()
                    ->summarize(Sum::make()->label('')),

                TextColumn::make('total')
                    ->numeric()
                    ->sortable()
                    ->summarize(Sum::make()->label('')),

                TextColumn::make('putra_diterima')
                    ->numeric()
                    ->sortable()
                    ->summarize(Sum::make()->label('')),

                TextColumn::make('putri_diterima')
                    ->numeric()
                    ->sortable()
                    ->summarize(Sum::make()->label('')),

                TextColumn::make('total_diterima')
                    ->numeric()
                    ->sortable()
                    ->summarize(Sum::make()->label('')),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->defaultGroup('qism_id')
            ->filters([
                QueryBuilder::make()
                    ->constraintPickerColumns(1)
                    ->constraints([

                        TextConstraint::make('qism.abbr_qism')
                            ->label('Qism')
                            ->nullable(),

                        TextConstraint::make('kelas.kelas')
                            ->label('Kelas')
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

                // ImportAction::make()
                //     ->label('Import')
                //     ->importer(JumlahSantriImporter::class)
            ])
            ->actions([])
            ->bulkActions([

                // ExportBulkAction::make()
                //     ->label('Export')
                //     ->exporter(JumlahSantriExporter::class),

                BulkAction::make('refresh')
                    ->label(__('Refresh'))
                    ->color('info')
                    ->action(fn(Collection $records, array $data) => $records->each(
                        function ($record) {

                            $tahunberjalanaktif = TahunBerjalan::where('is_active', 1)->first();
                            $ts = TahunBerjalan::where('tb', $tahunberjalanaktif->ts)->first();

                            $tapaa = Santri::where('jenis_pendaftar_id', 1)
                                ->where('tahun_berjalan_id', $ts->id)
                                ->where('qism_detail_id', 1)
                                ->where('kelas_id', 7)->count();

                            $tapab = Santri::where('jenis_pendaftar_id', 1)
                                ->where('tahun_berjalan_id', $ts->id)
                                ->where('qism_detail_id', 1)
                                ->where('kelas_id', 8)->count();

                            $tapia = Santri::where('jenis_pendaftar_id', 1)
                                ->where('tahun_berjalan_id', $ts->id)
                                ->where('qism_detail_id', 2)
                                ->where('kelas_id', 7)->count();

                            $tapib = Santri::where('jenis_pendaftar_id', 1)
                                ->where('tahun_berjalan_id', $ts->id)
                                ->where('qism_detail_id', 2)
                                ->where('kelas_id', 8)->count();

                            $ptpa1 = Santri::where('jenis_pendaftar_id', 1)
                                ->where('tahun_berjalan_id', $ts->id)
                                ->where('qism_detail_id', 3)
                                ->where('kelas_id', 1)->count();

                            $ptpa1 = Santri::where('jenis_pendaftar_id', 1)
                                ->where('tahun_berjalan_id', $ts->id)
                                ->where('qism_detail_id', 3)
                                ->where('kelas_id', 1)->count();

                            $ptpa2 = Santri::where('jenis_pendaftar_id', 1)
                                ->where('tahun_berjalan_id', $ts->id)
                                ->where('qism_detail_id', 3)
                                ->where('kelas_id', 2)->count();

                            $ptpa3 = Santri::where('jenis_pendaftar_id', 1)
                                ->where('tahun_berjalan_id', $ts->id)
                                ->where('qism_detail_id', 3)
                                ->where('kelas_id', 3)->count();

                            $ptpa4 = Santri::where('jenis_pendaftar_id', 1)
                                ->where('tahun_berjalan_id', $ts->id)
                                ->where('qism_detail_id', 3)
                                ->where('kelas_id', 4)->count();

                            $ptpa5 = Santri::where('jenis_pendaftar_id', 1)
                                ->where('tahun_berjalan_id', $ts->id)
                                ->where('qism_detail_id', 3)
                                ->where('kelas_id', 5)->count();

                            $ptpa6 = Santri::where('jenis_pendaftar_id', 1)
                                ->where('tahun_berjalan_id', $ts->id)
                                ->where('qism_detail_id', 3)
                                ->where('kelas_id', 6)->count();

                            $ptpi1 = Santri::where('jenis_pendaftar_id', 1)
                                ->where('tahun_berjalan_id', $ts->id)
                                ->where('qism_detail_id', 4)
                                ->where('kelas_id', 1)->count();

                            $ptpi1 = Santri::where('jenis_pendaftar_id', 1)
                                ->where('tahun_berjalan_id', $ts->id)
                                ->where('qism_detail_id', 4)
                                ->where('kelas_id', 1)->count();

                            $ptpi2 = Santri::where('jenis_pendaftar_id', 1)
                                ->where('tahun_berjalan_id', $ts->id)
                                ->where('qism_detail_id', 4)
                                ->where('kelas_id', 2)->count();

                            $ptpi3 = Santri::where('jenis_pendaftar_id', 1)
                                ->where('tahun_berjalan_id', $ts->id)
                                ->where('qism_detail_id', 4)
                                ->where('kelas_id', 3)->count();

                            $ptpi4 = Santri::where('jenis_pendaftar_id', 1)
                                ->where('tahun_berjalan_id', $ts->id)
                                ->where('qism_detail_id', 4)
                                ->where('kelas_id', 4)->count();

                            $ptpi5 = Santri::where('jenis_pendaftar_id', 1)
                                ->where('tahun_berjalan_id', $ts->id)
                                ->where('qism_detail_id', 4)
                                ->where('kelas_id', 5)->count();

                            $ptpi6 = Santri::where('jenis_pendaftar_id', 1)
                                ->where('tahun_berjalan_id', $ts->id)
                                ->where('qism_detail_id', 4)
                                ->where('kelas_id', 6)->count();

                            $tqpa1 = Santri::where('jenis_pendaftar_id', 1)
                                ->where('tahun_berjalan_id', $ts->id)
                                ->where('qism_detail_id', 5)
                                ->where('kelas_id', 1)->count();

                            $tqpa2 = Santri::where('jenis_pendaftar_id', 1)
                                ->where('tahun_berjalan_id', $ts->id)
                                ->where('qism_detail_id', 5)
                                ->where('kelas_id', 2)->count();

                            $tqpa3 = Santri::where('jenis_pendaftar_id', 1)
                                ->where('tahun_berjalan_id', $ts->id)
                                ->where('qism_detail_id', 5)
                                ->where('kelas_id', 3)->count();

                            $tqpi1 = Santri::where('jenis_pendaftar_id', 1)
                                ->where('tahun_berjalan_id', $ts->id)
                                ->where('qism_detail_id', 6)
                                ->where('kelas_id', 1)->count();

                            $tqpi2 = Santri::where('jenis_pendaftar_id', 1)
                                ->where('tahun_berjalan_id', $ts->id)
                                ->where('qism_detail_id', 6)
                                ->where('kelas_id', 2)->count();

                            $idd1 = Santri::where('jenis_pendaftar_id', 1)
                                ->where('tahun_berjalan_id', $ts->id)
                                ->where('qism_detail_id', 7)
                                ->where('kelas_id', 1)->count();

                            $mtw = Santri::where('jenis_pendaftar_id', 1)
                                ->where('tahun_berjalan_id', $ts->id)
                                ->where('qism_detail_id', 8)
                                ->where('kelas_id', 9)->count();

                            $tna = Santri::where('jenis_pendaftar_id', 1)
                                ->where('tahun_berjalan_id', $ts->id)
                                ->where('qism_detail_id', 9)
                                ->where('kelas_id', 7)->count();

                            $tnb = Santri::where('jenis_pendaftar_id', 1)
                                ->where('tahun_berjalan_id', $ts->id)
                                ->where('qism_detail_id', 9)
                                ->where('kelas_id', 8)->count();

                            //start diterima

                            $dtapaa = Santri::where('jenis_pendaftar_id', 1)
                                ->whereIn('status_pendaftaran_id', [2, 4])
                                ->where('tahun_berjalan_id', $ts->id)
                                ->where('qism_detail_id', 1)
                                ->where('kelas_id', 7)->count();

                            $dtapab = Santri::where('jenis_pendaftar_id', 1)
                                ->whereIn('status_pendaftaran_id', [2, 4])
                                ->where('tahun_berjalan_id', $ts->id)
                                ->where('qism_detail_id', 1)
                                ->where('kelas_id', 8)->count();

                            $dtapia = Santri::where('jenis_pendaftar_id', 1)
                                ->whereIn('status_pendaftaran_id', [2, 4])
                                ->where('tahun_berjalan_id', $ts->id)
                                ->where('qism_detail_id', 2)
                                ->where('kelas_id', 7)->count();

                            $dtapib = Santri::where('jenis_pendaftar_id', 1)
                                ->whereIn('status_pendaftaran_id', [2, 4])
                                ->where('tahun_berjalan_id', $ts->id)
                                ->where('qism_detail_id', 2)
                                ->where('kelas_id', 8)->count();

                            $dptpa1 = Santri::where('jenis_pendaftar_id', 1)
                                ->whereIn('status_pendaftaran_id', [2, 4])
                                ->where('tahun_berjalan_id', $ts->id)
                                ->where('qism_detail_id', 3)
                                ->where('kelas_id', 1)->count();

                            $dptpa1 = Santri::where('jenis_pendaftar_id', 1)
                                ->whereIn('status_pendaftaran_id', [2, 4])
                                ->where('tahun_berjalan_id', $ts->id)
                                ->where('qism_detail_id', 3)
                                ->where('kelas_id', 1)->count();

                            $dptpa2 = Santri::where('jenis_pendaftar_id', 1)
                                ->whereIn('status_pendaftaran_id', [2, 4])
                                ->where('tahun_berjalan_id', $ts->id)
                                ->where('qism_detail_id', 3)
                                ->where('kelas_id', 2)->count();

                            $dptpa3 = Santri::where('jenis_pendaftar_id', 1)
                                ->whereIn('status_pendaftaran_id', [2, 4])
                                ->where('tahun_berjalan_id', $ts->id)
                                ->where('qism_detail_id', 3)
                                ->where('kelas_id', 3)->count();

                            $dptpa4 = Santri::where('jenis_pendaftar_id', 1)
                                ->whereIn('status_pendaftaran_id', [2, 4])
                                ->where('tahun_berjalan_id', $ts->id)
                                ->where('qism_detail_id', 3)
                                ->where('kelas_id', 4)->count();

                            $dptpa5 = Santri::where('jenis_pendaftar_id', 1)
                                ->whereIn('status_pendaftaran_id', [2, 4])
                                ->where('tahun_berjalan_id', $ts->id)
                                ->where('qism_detail_id', 3)
                                ->where('kelas_id', 5)->count();

                            $dptpa6 = Santri::where('jenis_pendaftar_id', 1)
                                ->whereIn('status_pendaftaran_id', [2, 4])
                                ->where('tahun_berjalan_id', $ts->id)
                                ->where('qism_detail_id', 3)
                                ->where('kelas_id', 6)->count();

                            $dptpi1 = Santri::where('jenis_pendaftar_id', 1)
                                ->whereIn('status_pendaftaran_id', [2, 4])
                                ->where('tahun_berjalan_id', $ts->id)
                                ->where('qism_detail_id', 4)
                                ->where('kelas_id', 1)->count();

                            $dptpi1 = Santri::where('jenis_pendaftar_id', 1)
                                ->whereIn('status_pendaftaran_id', [2, 4])
                                ->where('tahun_berjalan_id', $ts->id)
                                ->where('qism_detail_id', 4)
                                ->where('kelas_id', 1)->count();

                            $dptpi2 = Santri::where('jenis_pendaftar_id', 1)
                                ->whereIn('status_pendaftaran_id', [2, 4])
                                ->where('tahun_berjalan_id', $ts->id)
                                ->where('qism_detail_id', 4)
                                ->where('kelas_id', 2)->count();

                            $dptpi3 = Santri::where('jenis_pendaftar_id', 1)
                                ->whereIn('status_pendaftaran_id', [2, 4])
                                ->where('tahun_berjalan_id', $ts->id)
                                ->where('qism_detail_id', 4)
                                ->where('kelas_id', 3)->count();

                            $dptpi4 = Santri::where('jenis_pendaftar_id', 1)
                                ->whereIn('status_pendaftaran_id', [2, 4])
                                ->where('tahun_berjalan_id', $ts->id)
                                ->where('qism_detail_id', 4)
                                ->where('kelas_id', 4)->count();

                            $dptpi5 = Santri::where('jenis_pendaftar_id', 1)
                                ->whereIn('status_pendaftaran_id', [2, 4])
                                ->where('tahun_berjalan_id', $ts->id)
                                ->where('qism_detail_id', 4)
                                ->where('kelas_id', 5)->count();

                            $dptpi6 = Santri::where('jenis_pendaftar_id', 1)
                                ->whereIn('status_pendaftaran_id', [2, 4])
                                ->where('tahun_berjalan_id', $ts->id)
                                ->where('qism_detail_id', 4)
                                ->where('kelas_id', 6)->count();

                            $dtqpa1 = Santri::where('jenis_pendaftar_id', 1)
                                ->whereIn('status_pendaftaran_id', [2, 4])
                                ->where('tahun_berjalan_id', $ts->id)
                                ->where('qism_detail_id', 5)
                                ->where('kelas_id', 1)->count();

                            $dtqpa2 = Santri::where('jenis_pendaftar_id', 1)
                                ->whereIn('status_pendaftaran_id', [2, 4])
                                ->where('tahun_berjalan_id', $ts->id)
                                ->where('qism_detail_id', 5)
                                ->where('kelas_id', 2)->count();

                            $dtqpa3 = Santri::where('jenis_pendaftar_id', 1)
                                ->whereIn('status_pendaftaran_id', [2, 4])
                                ->where('tahun_berjalan_id', $ts->id)
                                ->where('qism_detail_id', 5)
                                ->where('kelas_id', 3)->count();

                            $dtqpi1 = Santri::where('jenis_pendaftar_id', 1)
                                ->whereIn('status_pendaftaran_id', [2, 4])
                                ->where('tahun_berjalan_id', $ts->id)
                                ->where('qism_detail_id', 6)
                                ->where('kelas_id', 1)->count();

                            $dtqpi2 = Santri::where('jenis_pendaftar_id', 1)
                                ->whereIn('status_pendaftaran_id', [2, 4])
                                ->where('tahun_berjalan_id', $ts->id)
                                ->where('qism_detail_id', 6)
                                ->where('kelas_id', 2)->count();

                            $didd1 = Santri::where('jenis_pendaftar_id', 1)
                                ->whereIn('status_pendaftaran_id', [2, 4])
                                ->where('tahun_berjalan_id', $ts->id)
                                ->where('qism_detail_id', 7)
                                ->where('kelas_id', 1)->count();

                            $dmtw = Santri::where('jenis_pendaftar_id', 1)
                                ->whereIn('status_pendaftaran_id', [2, 4])
                                ->where('tahun_berjalan_id', $ts->id)
                                ->where('qism_detail_id', 8)
                                ->where('kelas_id', 9)->count();

                            $dtna = Santri::where('jenis_pendaftar_id', 1)
                                ->whereIn('status_pendaftaran_id', [2, 4])
                                ->where('tahun_berjalan_id', $ts->id)
                                ->where('qism_detail_id', 9)
                                ->where('kelas_id', 7)->count();

                            $dtnb = Santri::where('jenis_pendaftar_id', 1)
                                ->whereIn('status_pendaftaran_id', [2, 4])
                                ->where('tahun_berjalan_id', $ts->id)
                                ->where('qism_detail_id', 9)
                                ->where('kelas_id', 8)->count();

                            // $cekqism = $record->qism_id;

                            // switch (true) {
                            //     case ($cekqism === 1):

                            $jumlahpendaftar = JumlahPendaftar::where('qism_id', 1)->where('kelas_id', 7)->first();
                            $jumlahpendaftar->putra = $tapaa;
                            $jumlahpendaftar->putra_diterima = $dtapaa;
                            $jumlahpendaftar->save();

                            $jumlahpendaftar = JumlahPendaftar::where('qism_id', 1)->where('kelas_id', 8)->first();
                            $jumlahpendaftar->putra = $tapab;
                            $jumlahpendaftar->putra_diterima = $dtapab;
                            $jumlahpendaftar->save();

                            $jumlahpendaftar = JumlahPendaftar::where('qism_id', 1)->where('kelas_id', 7)->first();
                            $jumlahpendaftar->putri = $tapia;
                            $jumlahpendaftar->putri_diterima = $dtapia;
                            $jumlahpendaftar->save();

                            $jumlahpendaftar = JumlahPendaftar::where('qism_id', 1)->where('kelas_id', 8)->first();
                            $jumlahpendaftar->putri = $tapib;
                            $jumlahpendaftar->putri_diterima = $dtapib;
                            $jumlahpendaftar->save();

                            $jumlahpendaftar = JumlahPendaftar::where('qism_id', 1)->where('kelas_id', 7)->first();
                            $jumlahpendaftar->total = $tapaa + $tapia;
                            $jumlahpendaftar->total_diterima = $dtapaa + $dtapia;
                            $jumlahpendaftar->save();

                            $jumlahpendaftar = JumlahPendaftar::where('qism_id', 1)->where('kelas_id', 8)->first();
                            $jumlahpendaftar->total = $tapab + $tapib;
                            $jumlahpendaftar->total_diterima = $dtapab + $dtapib;
                            $jumlahpendaftar->save();

                            $jumlahpendaftar = JumlahPendaftar::where('qism_id', 2)->where('kelas_id', 1)->first();
                            $jumlahpendaftar->putra = $ptpa1;
                            $jumlahpendaftar->putra_diterima = $dptpa1;
                            $jumlahpendaftar->save();

                            $jumlahpendaftar = JumlahPendaftar::where('qism_id', 2)->where('kelas_id', 2)->first();
                            $jumlahpendaftar->putra = $ptpa2;
                            $jumlahpendaftar->putra_diterima = $dptpa2;
                            $jumlahpendaftar->save();

                            $jumlahpendaftar = JumlahPendaftar::where('qism_id', 2)->where('kelas_id', 3)->first();
                            $jumlahpendaftar->putra = $ptpa3;
                            $jumlahpendaftar->putra_diterima = $dptpa3;
                            $jumlahpendaftar->save();

                            $jumlahpendaftar = JumlahPendaftar::where('qism_id', 2)->where('kelas_id', 4)->first();
                            $jumlahpendaftar->putra = $ptpa4;
                            $jumlahpendaftar->putra_diterima = $dptpa4;
                            $jumlahpendaftar->save();

                            $jumlahpendaftar = JumlahPendaftar::where('qism_id', 2)->where('kelas_id', 5)->first();
                            $jumlahpendaftar->putra = $ptpa5;
                            $jumlahpendaftar->putra_diterima = $dptpa5;
                            $jumlahpendaftar->save();

                            $jumlahpendaftar = JumlahPendaftar::where('qism_id', 2)->where('kelas_id', 6)->first();
                            $jumlahpendaftar->putra = $ptpa6;
                            $jumlahpendaftar->putra_diterima = $dptpa6;
                            $jumlahpendaftar->save();

                            $jumlahpendaftar = JumlahPendaftar::where('qism_id', 2)->where('kelas_id', 1)->first();
                            $jumlahpendaftar->putri = $ptpi1;
                            $jumlahpendaftar->putri_diterima = $dptpi1;
                            $jumlahpendaftar->save();

                            $jumlahpendaftar = JumlahPendaftar::where('qism_id', 2)->where('kelas_id', 2)->first();
                            $jumlahpendaftar->putri = $ptpi2;
                            $jumlahpendaftar->putri_diterima = $dptpi2;
                            $jumlahpendaftar->save();

                            $jumlahpendaftar = JumlahPendaftar::where('qism_id', 2)->where('kelas_id', 3)->first();
                            $jumlahpendaftar->putri = $ptpi3;
                            $jumlahpendaftar->putri_diterima = $dptpi3;
                            $jumlahpendaftar->save();

                            $jumlahpendaftar = JumlahPendaftar::where('qism_id', 2)->where('kelas_id', 4)->first();
                            $jumlahpendaftar->putri = $ptpi4;
                            $jumlahpendaftar->putri_diterima = $dptpi4;
                            $jumlahpendaftar->save();

                            $jumlahpendaftar = JumlahPendaftar::where('qism_id', 2)->where('kelas_id', 5)->first();
                            $jumlahpendaftar->putri = $ptpi5;
                            $jumlahpendaftar->putri_diterima = $dptpi5;
                            $jumlahpendaftar->save();

                            $jumlahpendaftar = JumlahPendaftar::where('qism_id', 2)->where('kelas_id', 6)->first();
                            $jumlahpendaftar->putri = $ptpi6;
                            $jumlahpendaftar->putri_diterima = $dptpi6;
                            $jumlahpendaftar->save();

                            $jumlahpendaftar = JumlahPendaftar::where('qism_id', 2)->where('kelas_id', 1)->first();
                            $jumlahpendaftar->total = $ptpa1 + $ptpi1;
                            $jumlahpendaftar->total_diterima = $dptpa1 + $dptpi1;
                            $jumlahpendaftar->save();

                            $jumlahpendaftar = JumlahPendaftar::where('qism_id', 2)->where('kelas_id', 2)->first();
                            $jumlahpendaftar->total = $ptpa2 + $ptpi2;
                            $jumlahpendaftar->total_diterima = $dptpa2 + $dptpi2;
                            $jumlahpendaftar->save();

                            $jumlahpendaftar = JumlahPendaftar::where('qism_id', 2)->where('kelas_id', 3)->first();
                            $jumlahpendaftar->total = $ptpa3 + $ptpi3;
                            $jumlahpendaftar->total_diterima = $dptpa3 + $dptpi3;
                            $jumlahpendaftar->save();

                            $jumlahpendaftar = JumlahPendaftar::where('qism_id', 2)->where('kelas_id', 4)->first();
                            $jumlahpendaftar->total = $ptpa4 + $ptpi4;
                            $jumlahpendaftar->total_diterima = $dptpa4 + $dptpi4;
                            $jumlahpendaftar->save();

                            $jumlahpendaftar = JumlahPendaftar::where('qism_id', 2)->where('kelas_id', 5)->first();
                            $jumlahpendaftar->total = $ptpa5 + $ptpi5;
                            $jumlahpendaftar->total_diterima = $dptpa5 + $dptpi5;
                            $jumlahpendaftar->save();

                            $jumlahpendaftar = JumlahPendaftar::where('qism_id', 2)->where('kelas_id', 6)->first();
                            $jumlahpendaftar->total = $ptpa6 + $ptpi6;
                            $jumlahpendaftar->total_diterima = $dptpa6 + $dptpi6;
                            $jumlahpendaftar->save();


                            $jumlahpendaftar = JumlahPendaftar::where('qism_id', 3)->where('kelas_id', 1)->first();
                            $jumlahpendaftar->putra = $tqpa1;
                            $jumlahpendaftar->putra_diterima = $tqpa1;
                            $jumlahpendaftar->save();

                            $jumlahpendaftar = JumlahPendaftar::where('qism_id', 3)->where('kelas_id', 2)->first();
                            $jumlahpendaftar->putra = $tqpa2;
                            $jumlahpendaftar->putra_diterima = $tqpa2;
                            $jumlahpendaftar->save();

                            $jumlahpendaftar = JumlahPendaftar::where('qism_id', 3)->where('kelas_id', 3)->first();
                            $jumlahpendaftar->putra = $tqpa3;
                            $jumlahpendaftar->putra_diterima = $tqpa3;
                            $jumlahpendaftar->save();

                            $jumlahpendaftar = JumlahPendaftar::where('qism_id', 3)->where('kelas_id', 1)->first();
                            $jumlahpendaftar->putri = $tqpi1;
                            $jumlahpendaftar->putri_diterima = $dtqpi1;
                            $jumlahpendaftar->save();

                            $jumlahpendaftar = JumlahPendaftar::where('qism_id', 3)->where('kelas_id', 2)->first();
                            $jumlahpendaftar->putri = $tqpi2;
                            $jumlahpendaftar->putri_diterima = $dtqpi2;
                            $jumlahpendaftar->save();

                            $jumlahpendaftar = JumlahPendaftar::where('qism_id', 3)->where('kelas_id', 3)->first();
                            $jumlahpendaftar->putri = 0;
                            $jumlahpendaftar->putri_diterima = 0;
                            $jumlahpendaftar->save();

                            $jumlahpendaftar = JumlahPendaftar::where('qism_id', 3)->where('kelas_id', 1)->first();
                            $jumlahpendaftar->total = $tqpa1 + $tqpi1;
                            $jumlahpendaftar->total_diterima = $dtqpa1 + $dtqpi1;
                            $jumlahpendaftar->save();

                            $jumlahpendaftar = JumlahPendaftar::where('qism_id', 3)->where('kelas_id', 2)->first();
                            $jumlahpendaftar->total = $tqpa2 + $tqpi2;
                            $jumlahpendaftar->total_diterima = $dtqpa2 + $dtqpi2;
                            $jumlahpendaftar->save();

                            $jumlahpendaftar = JumlahPendaftar::where('qism_id', 3)->where('kelas_id', 3)->first();
                            $jumlahpendaftar->total = $tqpa3 + 0;
                            $jumlahpendaftar->total_diterima = $dtqpa3 + 0;
                            $jumlahpendaftar->save();

                            $jumlahpendaftar = JumlahPendaftar::where('qism_id', 4)->where('kelas_id', 1)->first();
                            $jumlahpendaftar->putra = $idd1;
                            $jumlahpendaftar->putra_diterima = $didd1;
                            $jumlahpendaftar->save();

                            $jumlahpendaftar = JumlahPendaftar::where('qism_id', 4)->where('kelas_id', 1)->first();
                            $jumlahpendaftar->putri = 0;
                            $jumlahpendaftar->putri_diterima = 0;
                            $jumlahpendaftar->save();

                            $jumlahpendaftar = JumlahPendaftar::where('qism_id', 4)->where('kelas_id', 1)->first();
                            $jumlahpendaftar->total = $idd1 + 0;
                            $jumlahpendaftar->total_diterima = $didd1 + 0;
                            $jumlahpendaftar->save();

                            $jumlahpendaftar = JumlahPendaftar::where('qism_id', 5)->where('kelas_id', 9)->first();
                            $jumlahpendaftar->putra = 0;
                            $jumlahpendaftar->putra_diterima = 0;
                            $jumlahpendaftar->save();

                            $jumlahpendaftar = JumlahPendaftar::where('qism_id', 5)->where('kelas_id', 9)->first();
                            $jumlahpendaftar->putri = $mtw;
                            $jumlahpendaftar->putri_diterima = $dmtw;
                            $jumlahpendaftar->save();

                            $jumlahpendaftar = JumlahPendaftar::where('qism_id', 5)->where('kelas_id', 9)->first();
                            $jumlahpendaftar->total = 0 + $mtw;
                            $jumlahpendaftar->total_diterima = 0 + $dmtw;
                            $jumlahpendaftar->save();

                            $jumlahpendaftar = JumlahPendaftar::where('qism_id', 6)->where('kelas_id', 7)->first();
                            $jumlahpendaftar->putra = 0;
                            $jumlahpendaftar->putra_diterima = 0;
                            $jumlahpendaftar->save();

                            $jumlahpendaftar = JumlahPendaftar::where('qism_id', 6)->where('kelas_id', 8)->first();
                            $jumlahpendaftar->putra = 0;
                            $jumlahpendaftar->putra_diterima = 0;
                            $jumlahpendaftar->save();

                            $jumlahpendaftar = JumlahPendaftar::where('qism_id', 6)->where('kelas_id', 7)->first();
                            $jumlahpendaftar->putri = $tna;
                            $jumlahpendaftar->putri_diterima = $dtna;
                            $jumlahpendaftar->save();

                            $jumlahpendaftar = JumlahPendaftar::where('qism_id', 6)->where('kelas_id', 8)->first();
                            $jumlahpendaftar->putri = $tnb;
                            $jumlahpendaftar->putri_diterima = $dtnb;
                            $jumlahpendaftar->save();

                            $jumlahpendaftar = JumlahPendaftar::where('qism_id', 6)->where('kelas_id', 7)->first();
                            $jumlahpendaftar->total = 0 + $tna;
                            $jumlahpendaftar->total_diterima = 0 + $dtna;
                            $jumlahpendaftar->save();

                            $jumlahpendaftar = JumlahPendaftar::where('qism_id', 6)->where('kelas_id', 8)->first();
                            $jumlahpendaftar->total = 0 + $tnb;
                            $jumlahpendaftar->total_diterima = 0 + $dtnb;
                            $jumlahpendaftar->save();



                            // Notification::make()
                            //     ->success()
                            //     ->title('Status Ananda telah diupdate')
                            //     ->persistent()
                            //     ->color('Success')
                            //     ->send();
                        }
                    ))
                    ->deselectRecordsAfterCompletion(),

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
            'index' => Pages\ListJumlahPendaftars::route('/'),
            'create' => Pages\CreateJumlahPendaftar::route('/create'),
            'view' => Pages\ViewJumlahPendaftar::route('/{record}'),
            'edit' => Pages\EditJumlahPendaftar::route('/{record}/edit'),
        ];
    }
}
