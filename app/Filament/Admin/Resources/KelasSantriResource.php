<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\KelasSantriResource\Pages;
use App\Filament\Admin\Resources\KelasSantriResource\RelationManagers;
use App\Filament\Exports\KelasSantriExporter;
use App\Models\Kelas;
use App\Models\KelasSantri;
use App\Models\Qism;
use App\Models\QismDetail;
use App\Models\Sem;
use App\Models\SemesterBerjalan;
use App\Models\TahunAjaran;
use App\Models\TahunBerjalan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\ExportBulkAction;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\TextInputColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class KelasSantriResource extends Resource
{
    protected static ?string $model = KelasSantri::class;

    public static function canViewAny(): bool
    {
        return auth()->user()->id == 1;
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
                    ->searchable(isIndividual: true)
                    ->toggleable()
                    ->toggledHiddenByDefault(true)
                    ->sortable(),

                TextColumn::make('santri.nism')
                    ->label('Santri-NISM')
                    ->searchable(isIndividual: true)
                    ->extraAttributes([
                        'style' => 'width:150px'
                    ])
                    ->sortable(),

                SelectColumn::make('qism_detail_id')
                    ->label('Qism Detail')
                    ->options(QismDetail::whereIsActive(1)->pluck('abbr_qism_detail', 'id'))
                    ->searchable(isIndividual: true)
                    ->sortable()
                    ->extraAttributes([
                        'style' => 'min-width:150px'
                    ]),

                SelectColumn::make('kelas_id')
                    ->label('Kelas')
                    ->options(Kelas::whereIsActive(1)->pluck('kelas', 'id'))
                    ->searchable(isIndividual: true)
                    ->sortable()
                    ->extraAttributes([
                        'style' => 'min-width:150px'
                    ]),

                TextInputColumn::make('kelas_internal')
                    ->label('Kelas Internal')
                    ->searchable(isIndividual: true)
                    ->toggleable()
                    // ->toggledHiddenByDefault(true)
                    ->extraAttributes([
                        'style' => 'width:150px'
                    ])
                    ->sortable(),

                TextInputColumn::make('kelas_internal_barab')
                    ->label('Kelas Internal Bahasa Arab')
                    ->searchable(isIndividual: true)
                    ->toggleable()
                    // ->toggledHiddenByDefault(true)
                    ->extraAttributes([
                        'style' => 'width:150px'
                    ])
                    ->sortable(),

                TextInputColumn::make('kelas_internal_matematika')
                    ->label('Kelas Internal Matematika')
                    ->searchable(isIndividual: true)
                    ->toggleable()
                    // ->toggledHiddenByDefault(true)
                    ->extraAttributes([
                        'style' => 'width:150px'
                    ])
                    ->sortable(),

                TextInputColumn::make('halaqoh')
                    ->label('Halaqoh')
                    ->searchable(isIndividual: true)
                    ->toggleable()
                    // ->toggledHiddenByDefault(true)
                    ->extraAttributes([
                        'style' => 'width:150px'
                    ])
                    ->sortable(),

                TextColumn::make('santri.nama_lengkap')
                    ->label('Santri')
                    ->searchable(isIndividual: true)
                    ->sortable(),

                TextColumn::make('walisantri.ak_nama_lengkap')
                    ->label('Nama Walisantri')
                    ->searchable(isIndividual: true)
                    ->sortable(),

                TextColumn::make('walisantri.user.id')
                    ->label('User ID')
                    ->searchable(isIndividual: true)
                    ->toggleable()
                    ->toggledHiddenByDefault(true)
                    ->sortable(),

                TextInputColumn::make('walisantri.user.username')
                    ->label('Username')
                    ->searchable(isIndividual: true)
                    ->toggleable()
                    ->toggledHiddenByDefault(true)
                    ->extraAttributes([
                        'style' => 'width:200px'
                    ])
                    ->sortable(),

                TextColumn::make('user.tsnunique')
                    ->label('tsnunique')
                    ->searchable(isIndividual: true)
                    ->toggleable()
                    ->toggledHiddenByDefault(true)
                    ->sortable(),

                TextColumn::make('walisantri.ak_nama_kunyah')
                    ->label('Nama Hijroh')
                    ->searchable(isIndividual: true)
                    ->toggleable()
                    ->toggledHiddenByDefault(true)
                    ->sortable(),

                TextInputColumn::make('kartu_keluarga')
                    ->label('KelasSantri-KK')
                    ->searchable(isIndividual: true)
                    ->extraAttributes([
                        'style' => 'width:200px'
                    ])
                    ->sortable(),

                SelectColumn::make('tahun_berjalan_id')
                    ->label('Tahun Berjalan')
                    ->options(TahunBerjalan::whereIsActive(1)->pluck('tb', 'id'))
                    ->searchable(isIndividual: true)
                    ->sortable()
                    ->extraAttributes([
                        'style' => 'min-width:200px'
                    ]),

                SelectColumn::make('tahun_ajaran_id')
                    ->label('Tahun Ajaran')
                    ->options(TahunAjaran::whereIsActive(1)->pluck('abbr_ta', 'id'))
                    ->searchable(isIndividual: true)
                    ->sortable()
                    ->extraAttributes([
                        'style' => 'min-width:200px'
                    ]),

                SelectColumn::make('semester_berjalan_id')
                    ->label('Semester Berjalan')
                    ->options(SemesterBerjalan::whereIsActive(1)->pluck('semester_berjalan', 'id'))
                    ->searchable(isIndividual: true)
                    ->sortable()
                    ->extraAttributes([
                        'style' => 'min-width:200px'
                    ]),

                SelectColumn::make('semester_id')
                    ->label('Semester')
                    ->options(Sem::whereIsActive(1)->pluck('semester', 'id'))
                    ->searchable(isIndividual: true)
                    ->sortable()
                    ->extraAttributes([
                        'style' => 'min-width:200px'
                    ]),

                SelectColumn::make('qism_id')
                    ->label('Qism')
                    ->options(Qism::whereIsActive(1)->pluck('abbr_qism', 'id'))
                    ->searchable(isIndividual: true)
                    ->sortable()
                    ->extraAttributes([
                        'style' => 'min-width:200px'
                    ]),



                TextColumn::make('walisantri_id')
                    ->label('Walisantri ID')
                    ->searchable(isIndividual: true)
                    ->toggleable()
                    ->toggledHiddenByDefault(true)
                    ->sortable(),

                TextInputColumn::make('walisantri.ak_no_kk')
                    ->label('Walisantri-KK')
                    ->searchable(isIndividual: true)
                    ->toggleable()
                    ->toggledHiddenByDefault(true)
                    ->extraAttributes([
                        'style' => 'width:200px'
                    ])
                    ->sortable(),
            ])
            ->filters([
                //
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
                    ->exporter(KelasSantriExporter::class),

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
}
