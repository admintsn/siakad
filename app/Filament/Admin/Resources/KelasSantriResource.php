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
                    // ->searchable(isIndividual: true)
                    ->toggleable()
                    ->toggledHiddenByDefault(true)
                    ->sortable(),

                TextColumn::make('santri.nism')
                    ->label('NISM')
                    // ->searchable(isIndividual: true)
                    ->extraAttributes([
                        'style' => 'width:150px'
                    ])
                    ->sortable(),

                SelectColumn::make('qism_detail_id')
                    ->label('Qism Detail')
                    ->options(QismDetail::whereIsActive(1)->pluck('abbr_qism_detail', 'id'))
                    // ->searchable(isIndividual: true)
                    ->sortable()
                    ->disabled(auth()->user()->id <> 1)
                    ->extraAttributes([
                        'style' => 'min-width:150px'
                    ]),

                SelectColumn::make('kelas_id')
                    ->label('Kelas')
                    ->options(Kelas::whereIsActive(1)->pluck('kelas', 'id'))
                    // ->searchable(isIndividual: true)
                    ->sortable()
                    ->disabled(auth()->user()->id <> 1)
                    ->extraAttributes([
                        'style' => 'min-width:150px'
                    ]),

                TextInputColumn::make('kelas_internal')
                    ->label('Kelas Internal')
                    // ->searchable(isIndividual: true)
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
                    // ->searchable(isIndividual: true)
                    ->toggleable()
                    // ->toggledHiddenByDefault(true)
                    ->extraAttributes([
                        'style' => 'width:150px'
                    ])
                    ->sortable(),

                TextColumn::make('santri.nama_lengkap')
                    ->label('Santri')
                    ->searchable(isIndividual: true, isGlobal: false)
                    ->sortable(),

                TextColumn::make('walisantri.ak_nama_lengkap')
                    ->label('Nama Walisantri')
                    // ->searchable(isIndividual: true)
                    ->sortable(),

                SelectColumn::make('tahun_berjalan_id')
                    ->label('Tahun Berjalan')
                    ->options(TahunBerjalan::whereIsActive(1)->pluck('tb', 'id'))
                    // ->searchable(isIndividual: true)
                    ->sortable()
                    ->disabled(auth()->user()->id <> 1)
                    ->extraAttributes([
                        'style' => 'min-width:200px'
                    ]),

                SelectColumn::make('tahun_ajaran_id')
                    ->label('Tahun Ajaran')
                    ->options(TahunAjaran::whereIsActive(1)->pluck('abbr_ta', 'id'))
                    // ->searchable(isIndividual: true)
                    ->sortable()
                    ->disabled(auth()->user()->id <> 1)
                    ->extraAttributes([
                        'style' => 'min-width:200px'
                    ]),

                SelectColumn::make('semester_berjalan_id')
                    ->label('Semester Berjalan')
                    ->options(SemesterBerjalan::whereIsActive(1)->pluck('semester_berjalan', 'id'))
                    // ->searchable(isIndividual: true)
                    ->sortable()
                    ->disabled(auth()->user()->id <> 1)
                    ->extraAttributes([
                        'style' => 'min-width:200px'
                    ]),

                TextInputColumn::make('kelas_internal_barab')
                    ->label('Kelas Internal Bahasa Arab')
                    // ->searchable(isIndividual: true)
                    ->toggleable()
                    // ->toggledHiddenByDefault(true)
                    ->extraAttributes([
                        'style' => 'width:150px'
                    ])
                    ->sortable(),

                TextInputColumn::make('kelas_internal_matematika')
                    ->label('Kelas Internal Matematika')
                    // ->searchable(isIndividual: true)
                    ->toggleable()
                    // ->toggledHiddenByDefault(true)
                    ->extraAttributes([
                        'style' => 'width:150px'
                    ])
                    ->sortable(),

            ])
            ->recordUrl(null)
            ->defaultSort('santri.nama_lengkap')
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
                            ->nullable(),

                        SelectConstraint::make('kelas_id')
                            ->label('Kelas')
                            ->options(Kelas::whereIsActive(1)->pluck('kelas', 'id'))
                            ->nullable(),

                        TextConstraint::make('nama_lengkap_santri')
                            ->relationship(
                                name: 'santri',
                                titleAttribute: 'nama_lengkap',
                            ),

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
