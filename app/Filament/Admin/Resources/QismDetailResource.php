<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Clusters\ConfigLembaga;
use App\Filament\Admin\Resources\QismDetailResource\Pages;
use App\Filament\Admin\Resources\QismDetailResource\Pages\ManageMapel;
use App\Filament\Admin\Resources\QismDetailResource\RelationManagers;
use App\Filament\Admin\Resources\QismDetailResource\RelationManagers\MapelsRelationManager;
use App\Filament\Exports\QismDetailExporter;
use App\Filament\Imports\QismDetailImporter;
use App\Models\Jeniskelamin;
use App\Models\Mapel;
use App\Models\Qism;
use App\Models\QismDetail;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Pages\SubNavigationPosition;
use Filament\Resources\Resource;
use Filament\Support\Enums\ActionSize;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\ExportBulkAction;
use Filament\Tables\Actions\ImportAction;
use Filament\Tables\Columns\CheckboxColumn;
use Filament\Tables\Columns\ColumnGroup;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\QueryBuilder;
use Filament\Tables\Filters\QueryBuilder\Constraints\BooleanConstraint;
use Filament\Tables\Filters\QueryBuilder\Constraints\DateConstraint;
use Filament\Tables\Filters\QueryBuilder\Constraints\SelectConstraint;
use Filament\Tables\Filters\QueryBuilder\Constraints\TextConstraint;
use Filament\Tables\Table;
use Guava\FilamentModalRelationManagers\Actions\Table\RelationManagerAction;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class QismDetailResource extends Resource
{
    protected static ?string $model = QismDetail::class;

    public static function canViewAny(): bool
    {
        return auth()->user()->id == 1;
    }

    protected static ?string $modelLabel = 'Qism Detail';

    protected static ?string $pluralModelLabel = 'Qism Detail';

    protected static ?string $navigationLabel = 'Qism Detail';

    protected static ?int $navigationSort = 800000050;

    // protected static ?string $navigationParentItem = 'Mahad';

    // protected static ?string $navigationGroup = 'Configs';

    // protected static ?string $navigationIcon = 'heroicon-o-Qisms';

    protected static ?string $cluster = ConfigLembaga::class;

    // protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    public static function form(Form $form): Form
    {
        return $form

            ->schema(static::QismDetailFormSchema());
    }

    public static function QismDetailFormSchema(): array
    {
        return [

            Section::make('Qism Detail')
                ->schema([

                    Grid::make(4)
                        ->schema([

                            ToggleButtons::make('qism_id')
                                ->label('Qism')
                                ->inline()
                                ->options(Qism::whereIsActive(1)->pluck('abbr_qism', 'id'))
                                ->required(),

                        ]),

                    Grid::make(4)
                        ->schema([

                            TextInput::make('abbr_qism_detail')
                                ->label('Qism Detail')
                                ->required()
                                ->unique(QismDetail::class, ignoreRecord: true),

                        ]),

                    Grid::make(4)
                        ->schema([

                            TextInput::make('qism_detail')
                                ->label('Desc')
                                ->required(),

                        ]),

                    Grid::make(4)
                        ->schema([

                            TextInput::make('kode_qism_detail')
                                ->label('Kode Qism')
                                ->required()
                                ->unique(QismDetail::class, ignoreRecord: true),

                        ]),

                    Grid::make(4)
                        ->schema([

                            ToggleButtons::make('jeniskelamin_id')
                                ->label('Jenis Kelamin')
                                ->inline()
                                ->required()
                                ->options(Jeniskelamin::whereIsActive(1)->pluck('jeniskelamin', 'id')),

                        ]),

                    Grid::make(4)
                        ->schema([

                            ToggleButtons::make('qism_detail_id')
                                ->label('Qism Selanjutanya')
                                ->inline()
                                ->options(QismDetail::whereIsActive(1)->pluck('abbr_qism_detail', 'id')),

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

                ColumnGroup::make('Qism Detail', [

                    TextColumn::make('qism.abbr_qism')
                        ->label('Qism')
                        ->searchable(isIndividual: true, isGlobal: false)
                        ->copyable()
                        ->copyableState(function ($state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->sortable(),

                    TextColumn::make('abbr_qism_detail')
                        ->label('Qism Detail')
                        ->searchable(isIndividual: true, isGlobal: false)
                        ->copyable()
                        ->copyableState(function ($state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->sortable(),

                    TextColumn::make('qism_detail')
                        ->label('Desc')
                        ->searchable(isIndividual: true, isGlobal: false)
                        ->copyable()
                        ->copyableState(function ($state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->sortable(),

                    TextColumn::make('kode_qism_detail')
                        ->label('Kode Qism Detail')
                        ->searchable(isIndividual: true, isGlobal: false)
                        ->copyable()
                        ->copyableState(function ($state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->sortable()
                        ->alignCenter(),

                    TextColumn::make('jeniskelamin.jeniskelamin')
                        ->label('Jenis Kelamin')
                        ->searchable(isIndividual: true, isGlobal: false)
                        ->copyable()
                        ->copyableState(function ($state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->sortable(),

                    TextColumn::make('qismDetail.abbr_qism_detail')
                        ->label('Qism Detail Selanjutnya')
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

                        TextConstraint::make('abbr_qism_detail')
                            ->label('Qism Detail')
                            ->nullable(),

                        TextConstraint::make('qism_detail')
                            ->label('Nama')
                            ->nullable(),

                        TextConstraint::make('kode_qism_detail')
                            ->label('Kode')
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
                    ->importer(QismDetailImporter::class)
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
                    ->exporter(QismDetailExporter::class),

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
            'index' => Pages\ListQismDetails::route('/'),
            'create' => Pages\CreateQismDetail::route('/create'),
            'view' => Pages\ViewQismDetail::route('/{record}'),
            'edit' => Pages\EditQismDetail::route('/{record}/edit'),
            // 'managemapel' => Pages\ManageMapel::route('/{record}/mapel'),
        ];
    }

    // public static function getRecordSubNavigation(Page $page): array
    // {
    //     return $page->generateNavigationItems([
    //         ManageMapel::class,
    //     ]);
    // }
}
