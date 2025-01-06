<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Clusters\ConfigImtihan;
use App\Filament\Admin\Resources\MapelResource\Pages;
use App\Filament\Admin\Resources\MapelResource\RelationManagers;
use App\Filament\Exports\MapelExporter;
use App\Filament\Imports\MapelImporter;
use App\Models\JenisSoal;
use App\Models\KategoriSoal;
use App\Models\Mapel;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\SubNavigationPosition;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Actions\ExportBulkAction;
use Filament\Tables\Actions\ImportAction;
use Filament\Tables\Columns\CheckboxColumn;
use Filament\Tables\Columns\ColumnGroup;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\QueryBuilder;
use Filament\Tables\Filters\QueryBuilder\Constraints\BooleanConstraint;
use Filament\Tables\Filters\QueryBuilder\Constraints\DateConstraint;
use Filament\Tables\Filters\QueryBuilder\Constraints\SelectConstraint;
use Filament\Tables\Filters\QueryBuilder\Constraints\TextConstraint;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Collection;

class MapelResource extends Resource
{
    protected static ?string $model = Mapel::class;

    public static function canViewAny(): bool
    {
        return auth()->user()->id == 1;
    }

    protected static ?string $modelLabel = 'Mapel';

    protected static ?string $pluralModelLabel = 'Mapel';

    protected static ?string $navigationLabel = 'Mapel';

    protected static ?int $navigationSort = 805000100;

    // protected static ?string $navigationIcon = 'heroicon-o-Qisms';

    protected static ?string $cluster = ConfigImtihan::class;

    // protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    public static function form(Form $form): Form
    {
        return $form

            ->schema(static::MapelFormSchema());
    }

    public static function MapelFormSchema(): array
    {
        return [

            Section::make('Mapel')
                ->schema([

                    Grid::make(4)
                        ->schema([

                            TextInput::make('mapel')
                                ->label('Mapel')
                                ->required()
                                ->unique(Mapel::class, ignoreRecord: true),

                        ]),

                    // Grid::make(4)
                    //     ->schema([

                    //         ToggleButtons::make('jenis_soal_id')
                    //             ->label('Jenis Soal')
                    //             ->inline()
                    //             ->options(JenisSoal::whereIsActive(1)->pluck('jenis_soal', 'id'))
                    //             ->required(),

                    //     ]),

                    // Grid::make(4)
                    //     ->schema([

                    //         ToggleButtons::make('kategori_soal_id')
                    //             ->label('Kategori Soal')
                    //             ->inline()
                    //             ->options(KategoriSoal::whereIsActive(1)->pluck('kategori', 'id'))
                    //             ->required(),

                    //     ]),
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

                ColumnGroup::make('Mapel', [

                    TextColumn::make('mapel')
                        ->label('Mapel')
                        ->searchable(isIndividual: true, isGlobal: false)
                        ->copyable()
                        ->copyableState(function ($state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->sortable(),

                    // TextColumn::make('jenisSoal.jenis_soal')
                    //     ->label('Jenis Soal')
                    //     ->searchable(isIndividual: true, isGlobal: false)
                    //     ->copyable()
                    //     ->copyableState(function ($state) {
                    //         return ($state);
                    //     })
                    //     ->copyMessage('Tersalin')
                    //     ->sortable(),

                    // SelectColumn::make('kategori_soal_id')
                    //     ->label('Kategori Soal')
                    //     // ->searchable(isIndividual: true, isGlobal: false)
                    //     // ->copyable()
                    //     // ->copyableState(function ($state) {
                    //     //     return ($state);
                    //     // })
                    //     // ->copyMessage('Tersalin')
                    //     ->options(KategoriSoal::whereIsActive(1)->pluck('kategori', 'id'))
                    //     ->sortable(),

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

                        TextConstraint::make('mapel')
                            ->label('Mapel')
                            ->nullable(),

                        // SelectConstraint::make('jenis_soal_id')
                        //     ->label('Jenis Soal')
                        //     ->options(JenisSoal::whereIsActive(1)->pluck('jenis_soal', 'id'))
                        //     ->nullable(),

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
                    ->importer(MapelImporter::class)
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
                    ->exporter(MapelExporter::class),

                // BulkAction::make('hifdz')
                //     ->label('Set Hifdz')
                //     ->action(fn(Collection $records, array $data) => $records->each(
                //         function ($record) {

                //             Mapel::where('id', $record->id)
                //                 ->update(['jenis_soal_id' => 1]);

                //             Notification::make()
                //                 // ->success()
                //                 ->title('Saved')
                //                 ->iconColor('success')
                //                 // ->persistent()
                //                 ->color('success')
                //                 ->send();
                //         }
                //     ))
                //     ->deselectRecordsAfterCompletion(),

                // BulkAction::make('lainnya')
                //     ->label('Set Lainnya')
                //     ->action(fn(Collection $records, array $data) => $records->each(
                //         function ($record) {

                //             Mapel::where('id', $record->id)
                //                 ->update(['jenis_soal_id' => 2]);

                //             Notification::make()
                //                 // ->success()
                //                 ->title('Saved')
                //                 ->iconColor('success')
                //                 // ->persistent()
                //                 ->color('success')
                //                 ->send();
                //         }
                //     ))
                //     ->deselectRecordsAfterCompletion(),

                // BulkAction::make('raporta')
                //     ->label('Set Rapor TA')
                //     ->action(fn(Collection $records, array $data) => $records->each(
                //         function ($record) {

                //             Mapel::where('id', $record->id)
                //                 ->update(['jenis_soal_id' => 3]);

                //             Notification::make()
                //                 // ->success()
                //                 ->title('Saved')
                //                 ->iconColor('success')
                //                 // ->persistent()
                //                 ->color('success')
                //                 ->send();
                //         }
                //     ))
                //     ->deselectRecordsAfterCompletion(),

                // BulkAction::make('tulislisan')
                //     ->label('Set Tulis/Lisan')
                //     ->action(fn(Collection $records, array $data) => $records->each(
                //         function ($record) {

                //             Mapel::where('id', $record->id)
                //                 ->update(['jenis_soal_id' => 4]);

                //             Notification::make()
                //                 // ->success()
                //                 ->title('Saved')
                //                 ->iconColor('success')
                //                 // ->persistent()
                //                 ->color('success')
                //                 ->send();
                //         }
                //     ))
                //     ->deselectRecordsAfterCompletion(),

                BulkAction::make('setaktif')
                    ->label('Set Aktif')
                    ->action(fn(Collection $records, array $data) => $records->each(
                        function ($record) {

                            Mapel::where('id', $record->id)
                                ->update(['is_active' => true]);

                            Notification::make()
                                // ->success()
                                ->title('Saved')
                                ->iconColor('success')
                                // ->persistent()
                                ->color('success')
                                ->send();
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
            'index' => Pages\ListMapels::route('/'),
            'create' => Pages\CreateMapel::route('/create'),
            'view' => Pages\ViewMapel::route('/{record}'),
            'edit' => Pages\EditMapel::route('/{record}/edit'),
        ];
    }
}
