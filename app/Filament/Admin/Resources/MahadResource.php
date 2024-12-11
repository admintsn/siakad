<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\MahadResource\Pages;
use App\Filament\Admin\Resources\MahadResource\RelationManagers;
use App\Models\Mahad;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
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

class MahadResource extends Resource
{
    protected static ?string $model = Mahad::class;

    public static function canViewAny(): bool
    {
        return auth()->user()->id == 1;
    }

    protected static ?string $modelLabel = 'Mahad';

    protected static ?string $pluralModelLabel = 'Mahad';

    protected static ?string $navigationLabel = 'Mahad';

    // protected static ?int $navigationSort = 800000000;

    // protected static ?string $navigationIcon = 'heroicon-o-Mahads';

    // protected static ?string $cluster = ManageMahad::class;

    public static function form(Form $form): Form
    {
        return $form

            ->schema(static::MahadFormSchema());
    }

    public static function MahadFormSchema(): array
    {
        return [

            Section::make('Mahad')
                ->schema([

                    Grid::make(4)
                        ->schema([

                            TextInput::make('mahad')
                                ->label('Mahad')
                                ->required(),

                        ]),

                    Grid::make(4)
                        ->schema([

                            TextInput::make('nsp')
                                ->label('NSPP')
                                ->required(),

                        ]),

                ])
                ->compact(),

            Section::make('Alamat')
                ->schema([

                    // Grid::make(4)
                    //     ->schema([

                    //         TextInput::make('mahad')
                    //             ->label('Mahad')
                    //             ->required(),

                    //     ]),

                    //     Grid::make(4)
                    //     ->schema([

                    //         TextInput::make('nsp')
                    //             ->label('NSPN')
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

                ColumnGroup::make('Mahad', [

                    TextColumn::make('mahad')
                        ->label('Mahad')
                        ->searchable(isIndividual: true, isGlobal: false)
                        ->copyable()
                        ->copyableState(function ($state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->sortable(),

                    TextColumn::make('nsp')
                        ->label('NSPP')
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

                        TextConstraint::make('mahad')
                            ->label('Mahad')
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
            'index' => Pages\ListMahads::route('/'),
            'create' => Pages\CreateMahad::route('/create'),
            'view' => Pages\ViewMahad::route('/{record}'),
            'edit' => Pages\EditMahad::route('/{record}/edit'),
        ];
    }
}
