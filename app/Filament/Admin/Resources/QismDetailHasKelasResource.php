<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Clusters\ConfigLembaga;
use App\Filament\Admin\Resources\QismDetailHasKelasResource\Pages;
use App\Filament\Admin\Resources\QismDetailHasKelasResource\RelationManagers;
use App\Filament\Exports\QismDetailHasKelasExporter;
use App\Filament\Imports\QismDetailHasKelasImporter;
use App\Models\Kelas;
use App\Models\Qism;
use App\Models\QismDetail;
use App\Models\QismDetailHasKelas;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
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
use Illuminate\Database\Eloquent\SoftDeletingScope;

class QismDetailHasKelasResource extends Resource
{
    protected static ?string $model = QismDetailHasKelas::class;

    public static function canViewAny(): bool
    {
        return auth()->user()->id == 1;
    }

    protected static ?string $modelLabel = 'Qism Detail has Kelas';

    protected static ?string $pluralModelLabel = 'Qism Detail has Kelas';

    protected static ?string $navigationLabel = 'Qism Detail has Kelas';

    protected static ?int $navigationSort = 800000150;

    // protected static ?string $navigationIcon = 'heroicon-o-Qisms';

    protected static ?string $cluster = ConfigLembaga::class;

    // protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    public static function form(Form $form): Form
    {
        return $form

            ->schema(static::QismDetailHasKelasFormSchema());
    }

    public static function QismDetailHasKelasFormSchema(): array
    {
        return [

            Section::make('Qism Detail has Kelas')
                ->schema([

                    Grid::make(4)
                        ->schema([

                            ToggleButtons::make('qism_id')
                                ->label('Qism')
                                ->inline()
                                ->options(Qism::whereIsActive(1)->pluck('abbr_qism', 'id'))
                                ->live()
                                ->required(),

                        ]),

                    Grid::make(4)
                        ->schema([

                            ToggleButtons::make('qism_detail_id')
                                ->label('Qism Detail')
                                ->inline()
                                ->options(function (Get $get) {

                                    $qism = $get('qism_id');

                                    return (QismDetail::whereIsActive(1)->where('qism_id', $qism)->pluck('abbr_qism_detail', 'id'));
                                })
                                ->required(),

                        ]),

                    Grid::make(4)
                        ->schema([

                            ToggleButtons::make('kelas_id')
                                ->label('Kelas')
                                ->inline()
                                ->options(Kelas::whereIsActive(1)->pluck('kelas', 'id'))
                                ->afterStateUpdated(function (Set $set, $state) {

                                    $kelas = Kelas::where('id', $state)->first();

                                    $set('kelas', $kelas->kelas);
                                })
                                ->live()
                                ->required(),

                        ]),

                    Grid::make(4)
                        ->schema([

                            TextInput::make('kelas')
                                ->label('Kelas')
                                ->required(),

                        ]),


                ])
                ->compact(),

            Section::make('Status Kelas Terakhir')
                ->schema([

                    Grid::make(2)
                        ->schema([

                            ToggleButtons::make('terakhir')
                                ->label('Kelas Terakhir?')
                                ->boolean()
                                ->grouped()
                                ->default(true),

                        ]),
                ])->collapsible()
                ->compact(),

            Section::make('Qism Detail Selanjutnya')
                ->schema([

                    Grid::make(4)
                        ->schema([

                            ToggleButtons::make('qism_s')
                                ->label('Qism Selanjutnya')
                                ->inline()
                                ->options(Qism::whereIsActive(1)->pluck('abbr_qism', 'id'))
                                ->live()
                                ->required(),

                        ]),

                    Grid::make(4)
                        ->schema([

                            ToggleButtons::make('qism_detail_s')
                                ->label('Qism Detail Selanjutnya')
                                ->inline()
                                ->options(function (Get $get) {

                                    $qisms = $get('qism_s');

                                    return (QismDetail::whereIsActive(1)->where('qism_id', $qisms)->pluck('abbr_qism_detail', 'id'));
                                })
                                ->required(),

                        ]),

                    Grid::make(4)
                        ->schema([

                            ToggleButtons::make('kelas_s')
                                ->label('Kelas Selanjutnya')
                                ->inline()
                                ->options(Kelas::whereIsActive(1)->pluck('kelas', 'id'))
                                ->required(),

                        ]),

                ])
                ->compact(),

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

                ColumnGroup::make('Qism Detail has Kelas', [

                    TextColumn::make('qism.abbr_qism')
                        ->label('Qism')
                        ->searchable(isIndividual: true, isGlobal: false)
                        ->copyable()
                        ->copyableState(function ($state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->sortable(),

                    TextColumn::make('qismDetail.abbr_qism_detail')
                        ->label('Qism Detail')
                        ->searchable(isIndividual: true, isGlobal: false)
                        ->copyable()
                        ->copyableState(function ($state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->sortable(),

                    TextColumn::make('kelas.kelas')
                        ->label('Kelas')
                        ->searchable(isIndividual: true, isGlobal: false)
                        ->copyable()
                        ->copyableState(function ($state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->sortable(),

                ]),

                ColumnGroup::make('Terakhir?', [

                    CheckboxColumn::make('terakhir')
                        ->label('Terakhir?')
                        ->sortable()
                        ->alignCenter(),

                ]),

                ColumnGroup::make('Qism Selanjutnya', [

                    TextColumn::make('qism_ss.abbr_qism')
                        ->label('Qism Selanjutnya')
                        ->searchable(isIndividual: true, isGlobal: false)
                        ->copyable()
                        ->copyableState(function ($state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->sortable(),

                    TextColumn::make('qismDetail_ss.abbr_qism_detail')
                        ->label('Qism Detail Selanjutnya')
                        ->searchable(isIndividual: true, isGlobal: false)
                        ->copyable()
                        ->copyableState(function ($state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->sortable(),

                    TextColumn::make('kelas_ss.kelas')
                        ->label('Kelas Selanjutnya')
                        ->searchable(isIndividual: true, isGlobal: false)
                        ->copyable()
                        ->copyableState(function ($state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->sortable(),

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
                    ->importer(QismDetailHasKelasImporter::class)
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
                    ->exporter(QismDetailHasKelasExporter::class),

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
            'index' => Pages\ListQismDetailHasKelas::route('/'),
            'create' => Pages\CreateQismDetailHasKelas::route('/create'),
            'view' => Pages\ViewQismDetailHasKelas::route('/{record}'),
            'edit' => Pages\EditQismDetailHasKelas::route('/{record}/edit'),
        ];
    }
}
