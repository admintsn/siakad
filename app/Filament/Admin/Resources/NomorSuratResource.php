<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\NomorSuratResource\Pages;
use App\Filament\Admin\Resources\NomorSuratResource\RelationManagers;
use App\Filament\Exports\NomorSuratExporter;
use App\Filament\Imports\NomorSuratImporter;
use App\Models\JenisSurat;
use App\Models\LembagaSurat;
use App\Models\NomorSurat;
use App\Models\Qism;
use App\Models\Santri;
use App\Models\Tahunhberjalan;
use App\Models\Tahunmberjalan;
use App\Models\TujuanSurat;
use App\Models\Walisantri;
use Carbon\Carbon;
use Carbon\Month;
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
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Date;

class NomorSuratResource extends Resource
{
    protected static ?string $model = NomorSurat::class;

    public static function canViewAny(): bool
    {
        return auth()->user()->id == 0;
    }

    protected static ?string $modelLabel = 'Nomor Surat LAMA';

    protected static ?string $pluralModelLabel = 'Nomor Surat LAMA';

    protected static ?string $navigationLabel = 'Nomor Surat LAMA';

    protected static ?int $navigationSort = 600000001;

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
                                ->afterStateUpdated(function (Set $set, $state) {

                                    $latest = NomorSurat::latest()->first();

                                    $inputm = Carbon::parse($state)->month;

                                    // dd(Carbon::parse($state)->month, Carbon::parse($latest->tanggal_surat)->month);
                                    if ($latest == null) {
                                        $set('nomor', sprintf("%03d", 1));
                                        $set('bulan_masehi', Carbon::parse($state)->month);
                                    } else {

                                        $latestm = Carbon::parse($latest->tanggal_surat)->month;
                                        if ($inputm == $latestm) {

                                            $set('nomor', sprintf("%03d", $latest->nomor + 1));
                                            $set('bulan_masehi', Carbon::parse($state)->month);
                                        } elseif ($inputm <> $latestm) {

                                            $set('nomor', sprintf("%03d", 1));
                                            $set('bulan_masehi', Carbon::parse($state)->month);
                                        }
                                    }
                                }),

                            TextInput::make('nomor')
                                ->label('Nomor urut')
                                ->required(),

                        ]),

                ])->compact(),

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

                    Grid::make(2)
                        ->schema([

                            Select::make('santri_id')
                                ->label('Santri')
                                ->searchable()
                                ->live()
                                ->options(Santri::all()->pluck('nama_lengkap', 'id')),
                                // ->afterStateUpdated(function (Get $get, Set $set, $state) {

                                //     $santri = Santri::where('id', $state)->first();
                                //     $ws = Walisantri::where('id', $santri->walisantri_id)->first();
                                //     $statusak = $ws->status_ak_id;

                                //     if ($statusak == 1) {
                                //         return ($set('alamat_surat', $ws->al_ak_alamat . ' RT ' . $ws->al_ak_rt . '/RW ' . $ws->al_ak_rw . ' ' . $ws->al_ak_kelurahan->kelurahan . ', ' . $ws->al_ak_kecamatan->kecamatan . ', ' . $ws->al_ak_kabupaten->kabupaten . ', ' . $ws->al_ak_provinsi->provinsi . ' ' . $ws->al_ak_kodepos));
                                //     } elseif ($statusak != 1) {
                                //         return ($set('alamat_surat', $ws->al_ik_alamat . ' RT ' . $ws->al_ik_rt . '/RW ' . $ws->al_ik_rw . ' ' . $ws->al_ik_kelurahan->kelurahan . ', ' . $ws->al_ik_kecamatan->kecamatan . ', ' . $ws->al_ik_kabupaten->kabupaten . ', ' . $ws->al_ik_provinsi->provinsi . ' ' . $ws->al_ik_kodepos));
                                //     }
                                // }),

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

                                    $nomor = $get('nomor');
                                    $lembaga = LembagaSurat::whereId($get('lembaga_surat_id'))->first();
                                    $qism = Qism::whereId($get('qism_id'))->first();
                                    $jenis = JenisSurat::whereId($get('jenis_surat_id'))->first();
                                    $tahunh = Tahunhberjalan::whereId($get('tahunhberjalan_id'))->first();
                                    $bulan = Carbon::parse($get('tanggal_surat'))->month;
                                    $tahunm = Tahunmberjalan::whereId($get('tahunmberjalan_id'))->first();

                                    $set('nomor_surat', $nomor . '/' . $lembaga->lembaga_surat . '.' . $qism->kode_surat . '/' . $jenis->kode . '/' . $tahunh->tahunhberjalan . '/' . $bulan . '/' . $tahunm->tahunmberjalan);
                                })
                                ->required(),
                        ]),
                ])->compact(),

            Section::make('Tahun Surat')
                ->schema([


                    Grid::make(4)
                        ->schema([

                            Select::make('tahunhberjalan_id')
                                ->label('Tahun Hijriah')
                                ->default(function () {

                                    return Tahunhberjalan::where('is_active', true)->first()->id;
                                })
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
                                ->default(function () {

                                    return Tahunmberjalan::where('is_active', true)->first()->id;
                                })
                                ->options(Tahunmberjalan::whereIsActive(1)->pluck('tahunmberjalan', 'id'))
                                ->required()
                                ->disabled()
                                ->dehydrated(),

                        ]),



                ])
                ->compact(),

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

                ])->compact(),

            Section::make('Alamat Surat')
                ->schema([

                    Grid::make()
                        ->schema([

                            Textarea::make('alamat_surat')
                                ->label('Alamat Surat')
                                // ->required()
                                // ->disabled()
                                ->dehydrated(),

                        ]),

                ])->compact(),

            // Section::make('Status Surat')
            //     ->schema([

            //         Grid::make(7)
            //             ->schema([

            //                 Checkbox::make('is_confirmed')
            //                     ->label('Telah Konfirmasi?'),

            //             ]),

            //         Grid::make(7)
            //             ->schema([

            //                 Checkbox::make('is_printed')
            //                     ->label('Diprint?'),

            //             ]),

            //         Grid::make(7)
            //             ->schema([

            //                 Checkbox::make('is_signed')
            //                     ->label('Tandatangan?'),

            //             ]),

            //         Grid::make(7)
            //             ->schema([

            //                 Checkbox::make('is_scanned')
            //                     ->label('Discan?'),

            //             ]),

            //         Grid::make(7)
            //             ->schema([

            //                 Checkbox::make('is_sent')
            //                     ->label('Diserahkan?'),

            //             ]),

            //         Grid::make(7)
            //             ->schema([

            //                 Checkbox::make('is_needrevise')
            //                     ->label('Perlu direvisi?'),

            //             ]),

            //         Grid::make(7)
            //             ->schema([

            //                 Checkbox::make('is_revised')
            //                     ->label('Telah direvisi?'),

            //             ]),

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

                ColumnGroup::make('Tanggal dan Nomor Urut', [

                    TextColumn::make('tanggal_surat')
                        ->label('Tanggal Surat')
                        ->searchable(isIndividual: true, isGlobal: false)
                        ->copyable()
                        ->copyableState(function ($state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->sortable(),

                    TextColumn::make('nomor')
                        ->label('Nomor Urut')
                        ->searchable(isIndividual: true, isGlobal: false)
                        ->copyable()
                        ->copyableState(function ($state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->sortable(),

                ]),

                ColumnGroup::make('Rincian Surat', [

                    TextColumn::make('lembagaSurat.lembaga_surat')
                        ->label('Lembaga')
                        ->searchable(isIndividual: true, isGlobal: false)
                        ->copyable()
                        ->copyableState(function ($state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->sortable(),

                    TextColumn::make('qism.abbr_qism')
                        ->label('Qism')
                        ->searchable(isIndividual: true, isGlobal: false)
                        ->copyable()
                        ->copyableState(function ($state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->sortable(),

                    TextColumn::make('santri.nama_lengkap')
                        ->label('Santri')
                        ->searchable(isIndividual: true, isGlobal: false)
                        ->copyable()
                        ->copyableState(function ($state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->sortable(),

                    TextColumn::make('tujuanSurat.tujuan_surat')
                        ->label('Tujuan')
                        ->searchable(isIndividual: true, isGlobal: false)
                        ->copyable()
                        ->copyableState(function ($state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->sortable(),

                    TextColumn::make('jenisSurat.jenis_surat')
                        ->label('Jenis')
                        ->searchable(isIndividual: true, isGlobal: false)
                        ->copyable()
                        ->copyableState(function ($state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->sortable(),

                ]),

                ColumnGroup::make('Tahun Surat', [

                    TextColumn::make('tahunhberjalan.tahunhberjalan')
                        ->label('Tahun Hijriah')
                        ->searchable(isIndividual: true, isGlobal: false)
                        ->copyable()
                        ->copyableState(function ($state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->sortable(),

                    TextColumn::make('bulan_masehi')
                        ->label('Bulan Masehi')
                        ->searchable(isIndividual: true, isGlobal: false)
                        ->copyable()
                        ->copyableState(function ($state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->sortable(),

                    TextColumn::make('tahunmberjalan.tahunmberjalan')
                        ->label('Tahun Masehi')
                        ->searchable(isIndividual: true, isGlobal: false)
                        ->copyable()
                        ->copyableState(function ($state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->sortable(),

                ]),

                ColumnGroup::make('Nomor Surat dan Perihal', [

                    TextColumn::make('nomor_surat')
                        ->label('Nomor Surat')
                        ->searchable(isIndividual: true, isGlobal: false)
                        ->copyable()
                        ->copyableState(function ($state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->sortable(),

                    TextColumn::make('perihal_surat')
                        ->label('Perihal Surat')
                        ->searchable(isIndividual: true, isGlobal: false)
                        ->copyable()
                        ->copyableState(function ($state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->sortable(),

                ]),

                ColumnGroup::make('Data Santri', [

                    TextColumn::make('santri.nik')
                        ->label('NIK')
                        ->searchable(isIndividual: true, isGlobal: false)
                        ->copyable()
                        ->copyableState(function ($state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->sortable(),

                    TextColumn::make('alamat_surat')
                        ->label('Alamat Surat')
                        ->searchable(isIndividual: true, isGlobal: false)
                        ->copyable()
                        ->copyableState(function ($state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->sortable(),

                ]),

                ColumnGroup::make('File Surat', [

                    TextColumn::make('file_raw')
                        ->label('Surat perlu ttd')
                        ->formatStateUsing(fn(string $state): string => __("Surat perlu ttd"))
                        ->icon('heroicon-s-pencil-square')
                        ->iconColor('success')
                        ->alignCenter()
                        ->url(function (Model $record) {
                            if ($record->file_raw !== null) {

                                return ($record->file_raw);
                            }
                        })
                        ->badge()
                        ->color('info')
                        ->openUrlInNewTab(),

                    TextColumn::make('file_signed')
                        ->label('Surat ttd')
                        ->formatStateUsing(fn(string $state): string => __("Surat telah ttd"))
                        ->icon('heroicon-s-pencil-square')
                        ->iconColor('success')
                        ->alignCenter()
                        ->url(function (Model $record) {
                            if ($record->file_signed !== null) {

                                return ($record->file_signed);
                            }
                        })
                        ->badge()
                        ->color('info')
                        ->openUrlInNewTab(),



                ]),

                ColumnGroup::make('Status Surat', [

                    CheckboxColumn::make('is_confirmed')
                        ->label('Status Konfirmasi')
                        ->sortable()
                        ->alignCenter(),

                    CheckboxColumn::make('is_printed')
                        ->label('Status Print')
                        ->sortable()
                        ->alignCenter(),

                    CheckboxColumn::make('is_signed')
                        ->label('Status Ttd')
                        ->sortable()
                        ->alignCenter(),

                    CheckboxColumn::make('is_scanned')
                        ->label('Status Scan')
                        ->sortable()
                        ->alignCenter(),

                    CheckboxColumn::make('is_sent')
                        ->label('Status Diserahkan')
                        ->sortable()
                        ->alignCenter(),

                    CheckboxColumn::make('is_needrevise')
                        ->label('Perlu Revisi')
                        ->sortable()
                        ->alignCenter(),

                    CheckboxColumn::make('is_revised')
                        ->label('Telah Direvisi')
                        ->sortable()
                        ->alignCenter(),

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

                        // SelectConstraint::make('qism_id')
                        //     ->label('Qism')
                        //     ->options(Qism::whereIsActive(1)->pluck('abbr_qism', 'id'))
                        //     ->nullable(),

                        // SelectConstraint::make('qism_detail_id')
                        //     ->label('Qism Detail')
                        //     ->options(QismDetail::whereIsActive(1)->pluck('abbr_qism_detail', 'id'))
                        //     ->nullable(),

                        // SelectConstraint::make('kelas_id')
                        //     ->label('Kelas')
                        //     ->options(Kelas::whereIsActive(1)->pluck('kelas', 'id'))
                        //     ->nullable(),

                        BooleanConstraint::make('terakhir')
                            ->label('Status')
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
                Tables\Actions\CreateAction::make(),

                ImportAction::make()
                    ->label('Import')
                    ->importer(NomorSuratImporter::class)
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
                    ->exporter(NomorSuratExporter::class),

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
            'index' => Pages\ListNomorSurats::route('/'),
            'create' => Pages\CreateNomorSurat::route('/create'),
            'view' => Pages\ViewNomorSurat::route('/{record}'),
            'edit' => Pages\EditNomorSurat::route('/{record}/edit'),
        ];
    }
}
