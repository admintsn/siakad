<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Clusters\ConfigImtihan;
use App\Filament\Admin\Resources\MapelQismResource\Pages;
use App\Filament\Admin\Resources\MapelQismResource\RelationManagers;
use App\Filament\Exports\MapelQismExporter;
use App\Filament\Imports\MapelQismImporter;
use App\Models\JenisSoal;
use App\Models\KategoriSoal;
use App\Models\Mapel;
use App\Models\MapelQism;
use App\Models\Qism;
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

class MapelQismResource extends Resource
{
    protected static ?string $model = MapelQism::class;

    public static function canViewAny(): bool
    {
        return auth()->user()->id == 1;
    }

    protected static ?string $modelLabel = 'Mapel per Qism';

    protected static ?string $pluralModelLabel = 'Mapel per Qism';

    protected static ?string $navigationLabel = 'Mapel per Qism';

    protected static ?int $navigationSort = 805000150;

    // protected static ?string $navigationParentItem = 'Mahad';

    // protected static ?string $navigationGroup = 'Configs';

    // protected static ?string $navigationIcon = 'heroicon-o-Qisms';

    protected static ?string $cluster = ConfigImtihan::class;

    // protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    public static function form(Form $form): Form
    {
        return $form

            ->schema(static::MapelQismFormSchema());
    }

    public static function MapelQismFormSchema(): array
    {
        return [

            Section::make('Mapel per Qism')
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

                            Select::make('mapel_id')
                                ->label('Mapel')
                                ->options(Mapel::whereIsActive(1)->pluck('mapel', 'id'))
                                ->searchable()
                                ->required(),

                        ]),

                    Grid::make()
                        ->schema([

                            ToggleButtons::make('jenis_soal_id')
                                ->label('Jenis Soal')
                                ->inline()
                                ->options(JenisSoal::whereIsActive(1)->pluck('jenis_soal', 'id'))
                                ->required(),

                        ])->columnSpanFull(),

                    Grid::make()
                        ->schema([

                            ToggleButtons::make('kategori_soal_id')
                                ->label('Kategori Soal')
                                ->inline()
                                ->options(KategoriSoal::whereIsActive(1)->pluck('kategori', 'id'))
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

                ColumnGroup::make('Mapel per Qism', [

                    TextColumn::make('qism.abbr_qism')
                        ->label('Qism')
                        ->searchable(isIndividual: true, isGlobal: false)
                        ->copyable()
                        ->copyableState(function ($state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->sortable(),

                    TextColumn::make('mapel.mapel')
                        ->label('Mapel')
                        ->searchable(isIndividual: true, isGlobal: false)
                        ->copyable()
                        ->copyableState(function ($state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->sortable(),

                    TextColumn::make('jenisSoal.jenis_soal')
                        ->label('Jenis Soal')
                        ->searchable(isIndividual: true, isGlobal: false)
                        ->copyable()
                        ->copyableState(function ($state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->sortable(),

                    TextColumn::make('kategoriSoal.kategori')
                        ->label('Kategori Soal')
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

                        SelectConstraint::make('mapel_id')
                            ->label('Mapel')
                            ->options(Mapel::whereIsActive(1)->pluck('mapel', 'id'))
                            ->nullable(),

                        SelectConstraint::make('jenis_soal_id')
                            ->label('Jenis Soal')
                            ->options(JenisSoal::whereIsActive(1)->pluck('jenis_soal', 'id'))
                            ->nullable(),

                        SelectConstraint::make('kategori_soal_id')
                            ->label('Kategori SOal')
                            ->options(KategoriSoal::whereIsActive(1)->pluck('kategori', 'id'))
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
                    ->importer(MapelQismImporter::class)
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
                    ->exporter(MapelQismExporter::class),

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
            'index' => Pages\ListMapelQisms::route('/'),
            'create' => Pages\CreateMapelQism::route('/create'),
            'view' => Pages\ViewMapelQism::route('/{record}'),
            'edit' => Pages\EditMapelQism::route('/{record}/edit'),
        ];
    }
}
