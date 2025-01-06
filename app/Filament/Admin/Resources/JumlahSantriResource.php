<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Clusters\Report;
use App\Filament\Admin\Resources\JumlahSantriResource\Pages;
use App\Filament\Admin\Resources\JumlahSantriResource\RelationManagers;
use App\Filament\Exports\JumlahSantriExporter;
use App\Filament\Imports\JumlahSantriImporter;
use App\Models\JumlahSantri;
use App\Models\KelasSantri;
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

class JumlahSantriResource extends Resource
{
    protected static ?string $model = JumlahSantri::class;

    public static function canViewAny(): bool
    {
        return auth()->user()->mudirqism !== null;
    }

    protected static ?string $modelLabel = 'Jumlah Santri';

    protected static ?string $pluralModelLabel = 'Jumlah Santri';

    protected static ?string $navigationLabel = 'Jumlah Santri';

    protected static ?int $navigationSort = 500000000;

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

                ImportAction::make()
                    ->label('Import')
                    ->importer(JumlahSantriImporter::class)
            ])
            ->actions([])
            ->bulkActions([

                ExportBulkAction::make()
                    ->label('Export')
                    ->exporter(JumlahSantriExporter::class),

                BulkAction::make('refresh')
                    ->label(__('Refresh'))
                    ->color('info')
                    ->action(fn(Collection $records, array $data) => $records->each(
                        function ($record) {

                            $tahunberjalanaktif = TahunBerjalan::where('is_active', 1)->first();

                            $tapaa = KelasSantri::whereHas('statussantri', function ($query) {
                                $query->where('status', 'Aktif');
                            })
                                ->where('tahun_berjalan_id', $tahunberjalanaktif->id)
                                ->where('qism_detail_id', 1)
                                ->where('kelas_id', 7)->count();

                            $tapab = KelasSantri::whereHas('statussantri', function ($query) {
                                $query->where('status', 'Aktif');
                            })
                                ->where('tahun_berjalan_id', $tahunberjalanaktif->id)
                                ->where('qism_detail_id', 1)
                                ->where('kelas_id', 8)->count();

                            $tapia = KelasSantri::whereHas('statussantri', function ($query) {
                                $query->where('status', 'Aktif');
                            })
                                ->where('tahun_berjalan_id', $tahunberjalanaktif->id)
                                ->where('qism_detail_id', 2)
                                ->where('kelas_id', 7)->count();

                            $tapib = KelasSantri::whereHas('statussantri', function ($query) {
                                $query->where('status', 'Aktif');
                            })
                                ->where('tahun_berjalan_id', $tahunberjalanaktif->id)
                                ->where('qism_detail_id', 2)
                                ->where('kelas_id', 8)->count();

                            $ptpa1 = KelasSantri::whereHas('statussantri', function ($query) {
                                $query->where('status', 'Aktif');
                            })
                                ->where('tahun_berjalan_id', $tahunberjalanaktif->id)
                                ->where('qism_detail_id', 3)
                                ->where('kelas_id', 1)->count();

                            $ptpa1 = KelasSantri::whereHas('statussantri', function ($query) {
                                $query->where('status', 'Aktif');
                            })
                                ->where('tahun_berjalan_id', $tahunberjalanaktif->id)
                                ->where('qism_detail_id', 3)
                                ->where('kelas_id', 1)->count();

                            $ptpa2 = KelasSantri::whereHas('statussantri', function ($query) {
                                $query->where('status', 'Aktif');
                            })
                                ->where('tahun_berjalan_id', $tahunberjalanaktif->id)
                                ->where('qism_detail_id', 3)
                                ->where('kelas_id', 2)->count();

                            $ptpa3 = KelasSantri::whereHas('statussantri', function ($query) {
                                $query->where('status', 'Aktif');
                            })
                                ->where('tahun_berjalan_id', $tahunberjalanaktif->id)
                                ->where('qism_detail_id', 3)
                                ->where('kelas_id', 3)->count();

                            $ptpa4 = KelasSantri::whereHas('statussantri', function ($query) {
                                $query->where('status', 'Aktif');
                            })
                                ->where('tahun_berjalan_id', $tahunberjalanaktif->id)
                                ->where('qism_detail_id', 3)
                                ->where('kelas_id', 4)->count();

                            $ptpa5 = KelasSantri::whereHas('statussantri', function ($query) {
                                $query->where('status', 'Aktif');
                            })
                                ->where('tahun_berjalan_id', $tahunberjalanaktif->id)
                                ->where('qism_detail_id', 3)
                                ->where('kelas_id', 5)->count();

                            $ptpa6 = KelasSantri::whereHas('statussantri', function ($query) {
                                $query->where('status', 'Aktif');
                            })
                                ->where('tahun_berjalan_id', $tahunberjalanaktif->id)
                                ->where('qism_detail_id', 3)
                                ->where('kelas_id', 6)->count();

                            $ptpi1 = KelasSantri::whereHas('statussantri', function ($query) {
                                $query->where('status', 'Aktif');
                            })
                                ->where('tahun_berjalan_id', $tahunberjalanaktif->id)
                                ->where('qism_detail_id', 4)
                                ->where('kelas_id', 1)->count();

                            $ptpi1 = KelasSantri::whereHas('statussantri', function ($query) {
                                $query->where('status', 'Aktif');
                            })
                                ->where('tahun_berjalan_id', $tahunberjalanaktif->id)
                                ->where('qism_detail_id', 4)
                                ->where('kelas_id', 1)->count();

                            $ptpi2 = KelasSantri::whereHas('statussantri', function ($query) {
                                $query->where('status', 'Aktif');
                            })
                                ->where('tahun_berjalan_id', $tahunberjalanaktif->id)
                                ->where('qism_detail_id', 4)
                                ->where('kelas_id', 2)->count();

                            $ptpi3 = KelasSantri::whereHas('statussantri', function ($query) {
                                $query->where('status', 'Aktif');
                            })
                                ->where('tahun_berjalan_id', $tahunberjalanaktif->id)
                                ->where('qism_detail_id', 4)
                                ->where('kelas_id', 3)->count();

                            $ptpi4 = KelasSantri::whereHas('statussantri', function ($query) {
                                $query->where('status', 'Aktif');
                            })
                                ->where('tahun_berjalan_id', $tahunberjalanaktif->id)
                                ->where('qism_detail_id', 4)
                                ->where('kelas_id', 4)->count();

                            $ptpi5 = KelasSantri::whereHas('statussantri', function ($query) {
                                $query->where('status', 'Aktif');
                            })
                                ->where('tahun_berjalan_id', $tahunberjalanaktif->id)
                                ->where('qism_detail_id', 4)
                                ->where('kelas_id', 5)->count();

                            $ptpi6 = KelasSantri::whereHas('statussantri', function ($query) {
                                $query->where('status', 'Aktif');
                            })
                                ->where('tahun_berjalan_id', $tahunberjalanaktif->id)
                                ->where('qism_detail_id', 4)
                                ->where('kelas_id', 6)->count();

                            $tqpa1 = KelasSantri::whereHas('statussantri', function ($query) {
                                $query->where('status', 'Aktif');
                            })
                                ->where('tahun_berjalan_id', $tahunberjalanaktif->id)
                                ->where('qism_detail_id', 5)
                                ->where('kelas_id', 1)->count();

                            $tqpa2 = KelasSantri::whereHas('statussantri', function ($query) {
                                $query->where('status', 'Aktif');
                            })
                                ->where('tahun_berjalan_id', $tahunberjalanaktif->id)
                                ->where('qism_detail_id', 5)
                                ->where('kelas_id', 2)->count();

                            $tqpa3 = KelasSantri::whereHas('statussantri', function ($query) {
                                $query->where('status', 'Aktif');
                            })
                                ->where('tahun_berjalan_id', $tahunberjalanaktif->id)
                                ->where('qism_detail_id', 5)
                                ->where('kelas_id', 3)->count();

                            $tqpi1 = KelasSantri::whereHas('statussantri', function ($query) {
                                $query->where('status', 'Aktif');
                            })
                                ->where('tahun_berjalan_id', $tahunberjalanaktif->id)
                                ->where('qism_detail_id', 6)
                                ->where('kelas_id', 1)->count();

                            $tqpi2 = KelasSantri::whereHas('statussantri', function ($query) {
                                $query->where('status', 'Aktif');
                            })
                                ->where('tahun_berjalan_id', $tahunberjalanaktif->id)
                                ->where('qism_detail_id', 6)
                                ->where('kelas_id', 2)->count();

                            $idd1 = KelasSantri::whereHas('statussantri', function ($query) {
                                $query->where('status', 'Aktif');
                            })
                                ->where('tahun_berjalan_id', $tahunberjalanaktif->id)
                                ->where('qism_detail_id', 7)
                                ->where('kelas_id', 1)->count();

                            $mtw = KelasSantri::whereHas('statussantri', function ($query) {
                                $query->where('status', 'Aktif');
                            })
                                ->where('tahun_berjalan_id', $tahunberjalanaktif->id)
                                ->where('qism_detail_id', 8)
                                ->where('kelas_id', 9)->count();

                            $tna = KelasSantri::whereHas('statussantri', function ($query) {
                                $query->where('status', 'Aktif');
                            })
                                ->where('tahun_berjalan_id', $tahunberjalanaktif->id)
                                ->where('qism_detail_id', 9)
                                ->where('kelas_id', 7)->count();

                            $tnb = KelasSantri::whereHas('statussantri', function ($query) {
                                $query->where('status', 'Aktif');
                            })
                                ->where('tahun_berjalan_id', $tahunberjalanaktif->id)
                                ->where('qism_detail_id', 9)
                                ->where('kelas_id', 8)->count();

                            // $cekqism = $record->qism_id;

                            // switch (true) {
                            //     case ($cekqism === 1):

                            $jumlahsantri = JumlahSantri::where('qism_id', 1)->where('kelas_id', 7)->first();
                            $jumlahsantri->putra = $tapaa;
                            $jumlahsantri->save();

                            $jumlahsantri = JumlahSantri::where('qism_id', 1)->where('kelas_id', 8)->first();
                            $jumlahsantri->putra = $tapab;
                            $jumlahsantri->save();

                            $jumlahsantri = JumlahSantri::where('qism_id', 1)->where('kelas_id', 7)->first();
                            $jumlahsantri->putri = $tapia;
                            $jumlahsantri->save();

                            $jumlahsantri = JumlahSantri::where('qism_id', 1)->where('kelas_id', 8)->first();
                            $jumlahsantri->putri = $tapib;
                            $jumlahsantri->save();

                            $jumlahsantri = JumlahSantri::where('qism_id', 1)->where('kelas_id', 7)->first();
                            $jumlahsantri->total = $tapaa + $tapia;
                            $jumlahsantri->save();

                            $jumlahsantri = JumlahSantri::where('qism_id', 1)->where('kelas_id', 8)->first();
                            $jumlahsantri->total = $tapab + $tapib;
                            $jumlahsantri->save();

                            $jumlahsantri = JumlahSantri::where('qism_id', 2)->where('kelas_id', 1)->first();
                            $jumlahsantri->putra = $ptpa1;
                            $jumlahsantri->save();

                            $jumlahsantri = JumlahSantri::where('qism_id', 2)->where('kelas_id', 2)->first();
                            $jumlahsantri->putra = $ptpa2;
                            $jumlahsantri->save();

                            $jumlahsantri = JumlahSantri::where('qism_id', 2)->where('kelas_id', 3)->first();
                            $jumlahsantri->putra = $ptpa3;
                            $jumlahsantri->save();

                            $jumlahsantri = JumlahSantri::where('qism_id', 2)->where('kelas_id', 4)->first();
                            $jumlahsantri->putra = $ptpa4;
                            $jumlahsantri->save();

                            $jumlahsantri = JumlahSantri::where('qism_id', 2)->where('kelas_id', 5)->first();
                            $jumlahsantri->putra = $ptpa5;
                            $jumlahsantri->save();

                            $jumlahsantri = JumlahSantri::where('qism_id', 2)->where('kelas_id', 6)->first();
                            $jumlahsantri->putra = $ptpa6;
                            $jumlahsantri->save();

                            $jumlahsantri = JumlahSantri::where('qism_id', 2)->where('kelas_id', 1)->first();
                            $jumlahsantri->putri = $ptpi1;
                            $jumlahsantri->save();

                            $jumlahsantri = JumlahSantri::where('qism_id', 2)->where('kelas_id', 2)->first();
                            $jumlahsantri->putri = $ptpi2;
                            $jumlahsantri->save();

                            $jumlahsantri = JumlahSantri::where('qism_id', 2)->where('kelas_id', 3)->first();
                            $jumlahsantri->putri = $ptpi3;
                            $jumlahsantri->save();

                            $jumlahsantri = JumlahSantri::where('qism_id', 2)->where('kelas_id', 4)->first();
                            $jumlahsantri->putri = $ptpi4;
                            $jumlahsantri->save();

                            $jumlahsantri = JumlahSantri::where('qism_id', 2)->where('kelas_id', 5)->first();
                            $jumlahsantri->putri = $ptpi5;
                            $jumlahsantri->save();

                            $jumlahsantri = JumlahSantri::where('qism_id', 2)->where('kelas_id', 6)->first();
                            $jumlahsantri->putri = $ptpi6;
                            $jumlahsantri->save();

                            $jumlahsantri = JumlahSantri::where('qism_id', 2)->where('kelas_id', 1)->first();
                            $jumlahsantri->total = $ptpa1 + $ptpi1;
                            $jumlahsantri->save();

                            $jumlahsantri = JumlahSantri::where('qism_id', 2)->where('kelas_id', 2)->first();
                            $jumlahsantri->total = $ptpa2 + $ptpi2;
                            $jumlahsantri->save();

                            $jumlahsantri = JumlahSantri::where('qism_id', 2)->where('kelas_id', 3)->first();
                            $jumlahsantri->total = $ptpa3 + $ptpi3;
                            $jumlahsantri->save();

                            $jumlahsantri = JumlahSantri::where('qism_id', 2)->where('kelas_id', 4)->first();
                            $jumlahsantri->total = $ptpa4 + $ptpi4;
                            $jumlahsantri->save();

                            $jumlahsantri = JumlahSantri::where('qism_id', 2)->where('kelas_id', 5)->first();
                            $jumlahsantri->total = $ptpa5 + $ptpi5;
                            $jumlahsantri->save();

                            $jumlahsantri = JumlahSantri::where('qism_id', 2)->where('kelas_id', 6)->first();
                            $jumlahsantri->total = $ptpa6 + $ptpi6;
                            $jumlahsantri->save();


                            $jumlahsantri = JumlahSantri::where('qism_id', 3)->where('kelas_id', 1)->first();
                            $jumlahsantri->putra = $tqpa1;
                            $jumlahsantri->save();

                            $jumlahsantri = JumlahSantri::where('qism_id', 3)->where('kelas_id', 2)->first();
                            $jumlahsantri->putra = $tqpa2;
                            $jumlahsantri->save();

                            $jumlahsantri = JumlahSantri::where('qism_id', 3)->where('kelas_id', 3)->first();
                            $jumlahsantri->putra = $tqpa3;
                            $jumlahsantri->save();

                            $jumlahsantri = JumlahSantri::where('qism_id', 3)->where('kelas_id', 1)->first();
                            $jumlahsantri->putri = $tqpi1;
                            $jumlahsantri->save();

                            $jumlahsantri = JumlahSantri::where('qism_id', 3)->where('kelas_id', 2)->first();
                            $jumlahsantri->putri = $tqpi2;
                            $jumlahsantri->save();

                            $jumlahsantri = JumlahSantri::where('qism_id', 3)->where('kelas_id', 3)->first();
                            $jumlahsantri->putri = 0;
                            $jumlahsantri->save();

                            $jumlahsantri = JumlahSantri::where('qism_id', 3)->where('kelas_id', 1)->first();
                            $jumlahsantri->total = $tqpa1 + $tqpi1;
                            $jumlahsantri->save();

                            $jumlahsantri = JumlahSantri::where('qism_id', 3)->where('kelas_id', 2)->first();
                            $jumlahsantri->total = $tqpa2 + $tqpi2;
                            $jumlahsantri->save();

                            $jumlahsantri = JumlahSantri::where('qism_id', 3)->where('kelas_id', 3)->first();
                            $jumlahsantri->total = $tqpa3 + 0;
                            $jumlahsantri->save();

                            $jumlahsantri = JumlahSantri::where('qism_id', 4)->where('kelas_id', 1)->first();
                            $jumlahsantri->putra = $idd1;
                            $jumlahsantri->save();

                            $jumlahsantri = JumlahSantri::where('qism_id', 4)->where('kelas_id', 1)->first();
                            $jumlahsantri->putri = 0;
                            $jumlahsantri->save();

                            $jumlahsantri = JumlahSantri::where('qism_id', 4)->where('kelas_id', 1)->first();
                            $jumlahsantri->total = $idd1 + 0;
                            $jumlahsantri->save();

                            $jumlahsantri = JumlahSantri::where('qism_id', 5)->where('kelas_id', 9)->first();
                            $jumlahsantri->putra = 0;
                            $jumlahsantri->save();

                            $jumlahsantri = JumlahSantri::where('qism_id', 5)->where('kelas_id', 9)->first();
                            $jumlahsantri->putri = $mtw;
                            $jumlahsantri->save();

                            $jumlahsantri = JumlahSantri::where('qism_id', 5)->where('kelas_id', 9)->first();
                            $jumlahsantri->total = 0 + $mtw;
                            $jumlahsantri->save();

                            $jumlahsantri = JumlahSantri::where('qism_id', 6)->where('kelas_id', 7)->first();
                            $jumlahsantri->putra = 0;
                            $jumlahsantri->save();

                            $jumlahsantri = JumlahSantri::where('qism_id', 6)->where('kelas_id', 8)->first();
                            $jumlahsantri->putra = 0;
                            $jumlahsantri->save();

                            $jumlahsantri = JumlahSantri::where('qism_id', 6)->where('kelas_id', 7)->first();
                            $jumlahsantri->putri = $tna;
                            $jumlahsantri->save();

                            $jumlahsantri = JumlahSantri::where('qism_id', 6)->where('kelas_id', 8)->first();
                            $jumlahsantri->putri = $tnb;
                            $jumlahsantri->save();

                            $jumlahsantri = JumlahSantri::where('qism_id', 6)->where('kelas_id', 7)->first();
                            $jumlahsantri->total = 0 + $tna;
                            $jumlahsantri->save();

                            $jumlahsantri = JumlahSantri::where('qism_id', 6)->where('kelas_id', 8)->first();
                            $jumlahsantri->total = 0 + $tnb;
                            $jumlahsantri->save();



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
            'index' => Pages\ListJumlahSantris::route('/'),
            'create' => Pages\CreateJumlahSantri::route('/create'),
            'view' => Pages\ViewJumlahSantri::route('/{record}'),
            'edit' => Pages\EditJumlahSantri::route('/{record}/edit'),
        ];
    }
}
