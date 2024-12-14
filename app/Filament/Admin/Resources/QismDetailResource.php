<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\QismDetailResource\Pages;
use App\Filament\Admin\Resources\QismDetailResource\RelationManagers;
use App\Models\Qism;
use App\Models\QismDetail;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Columns\ColumnGroup;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\QueryBuilder;
use Filament\Tables\Filters\QueryBuilder\Constraints\BooleanConstraint;
use Filament\Tables\Filters\QueryBuilder\Constraints\DateConstraint;
use Filament\Tables\Filters\QueryBuilder\Constraints\TextConstraint;
use Filament\Tables\Table;
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

    // protected static ?int $navigationSort = 800000000;

    // protected static ?string $navigationIcon = 'heroicon-o-Qism Details';

    // protected static ?string $cluster = ManageQism Detail::class;

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

                            Select::make('qism_id')
                                ->label('Qism')
                                ->options(Qism::whereIsActive(1)->pluck('abbr_qism', 'id'))
                                ->required(),

                        ]),

                    Grid::make(4)
                        ->schema([

                            TextInput::make('abbr_qism_detail')
                                ->label('Qism Detail')
                                ->required(),

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
                                ->required(),

                        ]),

                    Grid::make(4)
                        ->schema([

                            ToggleButtons::make('qism_detail_s')
                                ->label('Qism Selanjutnya')
                                ->options(QismDetail::whereIsActive(1)->pluck('abbr_qism_detail', 'id'))
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
                        ->sortable(),

                ]),

                ColumnGroup::make('Status', [

                    IconColumn::make('is_active')
                        ->label('Status')
                        ->boolean()
                        ->sortable(),

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

                        TextConstraint::make('abbr_qism')
                            ->label('Qism')
                            ->nullable(),

                        TextConstraint::make('qism')
                            ->label('Nama')
                            ->nullable(),

                        TextConstraint::make('kode_qism')
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
            ])
            ->actions([
                ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                ]),


            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
        ];
    }
}
