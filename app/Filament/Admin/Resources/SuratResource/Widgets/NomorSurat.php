<?php

namespace App\Filament\Admin\Resources\SuratResource\Widgets;

use App\Filament\Exports\NomorSuratExporter;
use App\Models\JenisSurat;
use App\Models\KelasSantri;
use App\Models\LembagaSurat;
use App\Models\NomorSurat as ModelsNomorSurat;
use App\Models\Qism;
use App\Models\Santri;
use App\Models\TahunBerjalan;
use App\Models\Tahunhberjalan;
use App\Models\Tahunmberjalan;
use App\Models\TujuanSurat;
use App\Models\Walisantri;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
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
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Date;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\RelationManagers\RelationManager;
use Guava\FilamentModalRelationManagers\Concerns\CanBeEmbeddedInModals;
use Illuminate\Support\Carbon;
use Schmeits\FilamentCharacterCounter\Forms\Components\TextInput as ComponentsTextInput;

class NomorSurat extends BaseWidget
{

    protected int | string | array $columnSpan = 'full';

    // protected $listeners = ['updateNomorSurat' => '$refresh'];

    // protected static ?string $pollingInterval = '1s';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                ModelsNomorSurat::where('id', '<>', null)
            )
            ->heading('Gunakan tombol ini jika tidak ada data santri/nama')
            ->extremePaginationLinks()
            ->defaultPaginationPageOption(5)
            // ->poll('1s')
            ->columns([

                TextColumn::make('id')
                    ->label('ID')
                    ->copyable()
                    ->copyableState(function ($state) {
                        return ($state);
                    })
                    ->copyMessage('Tersalin')
                    ->width('1%')
                    ->sortable(),

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

                ]),

                ColumnGroup::make('Rincian Surat', [

                    TextColumn::make('jenisSurat.jenis_surat')
                        ->label('Jenis')
                        ->searchable(isIndividual: true, isGlobal: false)
                        ->copyable()
                        ->copyableState(function ($state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->sortable(),

                    TextColumn::make('nama_manual')
                        ->label('Nama')
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

                    TextColumn::make('nama_file')
                        ->label('Nama File')
                        ->searchable(isIndividual: true, isGlobal: false)
                        ->copyable()
                        ->copyableState(function ($state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->sortable(),

                ]),

                ColumnGroup::make('Data Surat', [

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

                    TextColumn::make('nik_manual')
                        ->label('NIK')
                        ->searchable(isIndividual: true, isGlobal: false)
                        ->copyable()
                        ->copyableState(function ($state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->sortable(),

                    TextColumn::make('tempat_lahir_manual')
                        ->label('Tempat Lahir')
                        ->searchable(isIndividual: true, isGlobal: false)
                        ->copyable()
                        ->copyableState(function ($state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->sortable(),

                    TextColumn::make('tanggal_lahir_manual')
                        ->label('Tanggal Lahir')
                        ->searchable(isIndividual: true, isGlobal: false)
                        ->copyable()
                        ->copyableState(function ($state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->sortable(),

                    TextColumn::make('nama_ayah_manual')
                        ->label('Nama Ayah')
                        ->searchable(isIndividual: true, isGlobal: false)
                        ->copyable()
                        ->copyableState(function ($state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->sortable(),

                    TextColumn::make('nama_ibu_manual')
                        ->label('Nama Ibu')
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

                ColumnGroup::make('Tahun Surat', [

                    TextColumn::make('nomor')
                        ->label('Nomor Urut')
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
            // ->filters([
            //     QueryBuilder::make()
            //         ->constraintPickerColumns(1)
            //         ->constraints([

            //             // SelectConstraint::make('qism_id')
            //             //     ->label('Qism')
            //             //     ->options(Qism::whereIsActive(1)->pluck('abbr_qism', 'id'))
            //             //     ->nullable(),

            //             // SelectConstraint::make('qism_detail_id')
            //             //     ->label('Qism Detail')
            //             //     ->options(QismDetail::whereIsActive(1)->pluck('abbr_qism_detail', 'id'))
            //             //     ->nullable(),

            //             // SelectConstraint::make('kelas_id')
            //             //     ->label('Kelas')
            //             //     ->options(Kelas::whereIsActive(1)->pluck('kelas', 'id'))
            //             //     ->nullable(),

            //             BooleanConstraint::make('terakhir')
            //                 ->label('Status')
            //                 ->icon(false)
            //                 ->nullable(),

            //             BooleanConstraint::make('is_active')
            //                 ->label('Status')
            //                 ->icon(false)
            //                 ->nullable(),

            //             TextConstraint::make('created_by')
            //                 ->label('Created by')
            //                 ->icon(false)
            //                 ->nullable(),

            //             TextConstraint::make('updated_by')
            //                 ->label('Updated by')
            //                 ->icon(false)
            //                 ->nullable(),

            //             DateConstraint::make('created_at')
            //                 ->icon(false)
            //                 ->nullable(),

            //             DateConstraint::make('updated_at')
            //                 ->icon(false)
            //                 ->nullable(),

            //         ]),
            // ])
            ->headerActions([

                Tables\Actions\CreateAction::make()
                    ->label('New Nomor Surat')
                    ->modalWidth('full')
                    ->form([
                        Section::make('Tanggal dan Nomor Urut')
                            ->schema([

                                Grid::make(4)
                                    ->schema([

                                        DatePicker::make('tanggal_surat')
                                            ->label('Tanggal')
                                            ->required()
                                            ->live()
                                            ->afterStateUpdated(function (Set $set, $state, $record) {

                                                $latest = ModelsNomorSurat::latest()->first();

                                                $inputm = Carbon::parse($state)->month;

                                                $thb = Tahunhberjalan::where('is_active', true)->first();
                                                $tmb = Tahunmberjalan::where('is_active', true)->first();

                                                $tahunberjalanaktif = TahunBerjalan::where('is_active', 1)->first();
                                                $ts = TahunBerjalan::where('tb', $tahunberjalanaktif->ts)->first();

                                                // dd(Carbon::parse($state)->month, Carbon::parse($latest->tanggal_surat)->month);
                                                if ($latest == null) {
                                                    $set('nomor', sprintf("%03d", 1));

                                                    $set('lembaga_surat_id', 1);

                                                    $set('bulan_masehi', Carbon::parse($state)->month);
                                                    $set('tahunhberjalan_id', $thb->id);
                                                    $set('tahunmberjalan_id', $tmb->id);

                                                    $set('tujuan_surat_id', 2);

                                                    $set('is_active', 1);
                                                    $set('source', 2);
                                                } else {

                                                    $latestm = Carbon::parse($latest->tanggal_surat)->month;
                                                    if ($inputm == $latestm) {

                                                        $set('nomor', sprintf("%03d", $latest->nomor + 1));

                                                        $set('lembaga_surat_id', 1);

                                                        $set('bulan_masehi', Carbon::parse($state)->month);
                                                        $set('tahunhberjalan_id', $thb->id);
                                                        $set('tahunmberjalan_id', $tmb->id);

                                                        $set('tujuan_surat_id', 2);

                                                        $set('is_active', 1);
                                                        $set('source', 2);
                                                    } elseif ($inputm <> $latestm) {

                                                        $set('nomor', sprintf("%03d", 1));

                                                        $set('lembaga_surat_id', 1);

                                                        $set('bulan_masehi', Carbon::parse($state)->month);
                                                        $set('tahunhberjalan_id', $thb->id);
                                                        $set('tahunmberjalan_id', $tmb->id);

                                                        $set('tujuan_surat_id', 2);

                                                        $set('is_active', 1);
                                                        $set('source', 2);
                                                    }
                                                }
                                            }),

                                        TextInput::make('nomor')
                                            ->label('Nomor urut')
                                            ->required(),

                                        Hidden::make('source'),

                                    ]),

                                Grid::make(4)
                                    ->schema([

                                        Select::make('tahunhberjalan_id')
                                            ->label('Tahun Hijriah')
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
                                            ->options(Tahunmberjalan::whereIsActive(1)->pluck('tahunmberjalan', 'id'))
                                            ->required()
                                            ->disabled()
                                            ->dehydrated(),

                                    ]),

                            ])
                            ->compact(),

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
                                            ->options(Qism::all()->pluck('abbr_qism', 'id')),

                                    ]),

                                Grid::make(4)
                                    ->schema([

                                        Select::make('santri_id')
                                            ->label('Santri')
                                            ->options(Santri::all()->pluck('nama_lengkap', 'id'))
                                            ->disabled(),

                                    ]),

                                Grid::make(4)
                                    ->schema([

                                        TextInput::make('nama_manual')
                                            ->label('Nama'),

                                        ComponentsTextInput::make('nik_manual')
                                            ->label('NIK')
                                            ->length(16),

                                    ]),

                                Grid::make(4)
                                    ->schema([

                                        TextInput::make('tempat_lahir_manual')
                                            ->label('Tempat Lahir'),


                                        DatePicker::make('tanggal_lahir_manual')
                                            ->label('Tanggal Lahir')
                                            ->native(false),

                                    ]),

                                Grid::make(4)
                                    ->schema([

                                        TextInput::make('nama_ayah_manual')
                                            ->label('Nama Ayah'),

                                        TextInput::make('nama_ibu_manual')
                                            ->label('Nama Ibu'),

                                    ]),

                                Grid::make()
                                    ->schema([

                                        Textarea::make('alamat_surat')
                                            ->label('Alamat Surat')
                                            // ->required()
                                            // ->disabled()
                                            ->dehydrated(),

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

                                                $tahun = Carbon::parse($get('tanggal_surat'))->year;
                                                $bulan = Carbon::parse($get('tanggal_surat'))->month;
                                                $tanggal = Carbon::parse($get('tanggal_surat'))->day;
                                                $nomor = $get('nomor');
                                                $lembaga = LembagaSurat::whereId($get('lembaga_surat_id'))->first();
                                                $qism = Qism::whereId($get('qism_id'))->first();
                                                $jenis = JenisSurat::whereId($get('jenis_surat_id'))->first();
                                                $tahunh = Tahunhberjalan::whereId($get('tahunhberjalan_id'))->first();
                                                $tahunm = Tahunmberjalan::whereId($get('tahunmberjalan_id'))->first();

                                                $set('nomor_surat', $nomor . '/' . $lembaga->lembaga_surat . '.' . $qism->kode_surat . '/' . $jenis->kode . '/' . $tahunh->tahunhberjalan . '/' . $bulan . '/' . $tahunm->tahunmberjalan);
                                                $set('perihal_surat', $jenis->jenis_surat);
                                                $set('nama_file', $tahun . '.' . sprintf("%02d", $bulan) . '.' . $tanggal . ' ' . $lembaga->lembaga_surat . '-' . $qism->abbr_qism . ' ' . $jenis->jenis_surat . ' ' . $get('nama_manual'));
                                            })
                                            ->required(),
                                    ]),

                            ])->compact(),

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

                                Grid::make(2)
                                    ->schema([

                                        TextInput::make('nama_file')
                                            ->label('Nama File')
                                            ->required(),

                                    ]),

                            ])->compact(),

                        Section::make('Status')
                            ->schema([

                                Grid::make(2)
                                    ->schema([

                                        ToggleButtons::make('is_active')
                                            ->label('Active?')
                                            ->boolean()
                                            ->grouped()
                                            ->default(1),

                                    ]),
                            ])->collapsible()
                            ->compact(),
                    ]),

                Action::make('refresh')
                    ->label('Refresh')
                    ->button()
                    ->outlined()
                    ->color('info')

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

                // ExportBulkAction::make()
                //     ->label('Export')
                //     ->exporter(NomorSuratExporter::class),

            ]);
    }
}
