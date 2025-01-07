<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\UserResource\Pages;
use App\Filament\Admin\Resources\UserResource\RelationManagers;
use App\Filament\Exports\UserExporter;
use App\Filament\Imports\UserImporter;
use App\Models\Panelrole;
use App\Models\Qism;
use App\Models\User;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Form;
use Filament\Pages\SubNavigationPosition;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Actions\ExportBulkAction;
use Filament\Tables\Actions\ImportAction;
use Filament\Tables\Columns\CheckboxColumn;
use Filament\Tables\Columns\ColumnGroup;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\QueryBuilder;
use Filament\Tables\Filters\QueryBuilder\Constraints\BooleanConstraint;
use Filament\Tables\Filters\QueryBuilder\Constraints\DateConstraint;
use Filament\Tables\Filters\QueryBuilder\Constraints\SelectConstraint;
use Filament\Tables\Filters\QueryBuilder\Constraints\TextConstraint;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    public static function canViewAny(): bool
    {
        return auth()->user()->id == 1;
    }

    protected static ?string $modelLabel = 'User';

    protected static ?string $pluralModelLabel = 'User';

    protected static ?string $navigationLabel = 'User';

    protected static ?int $navigationSort = 900000000;

    // protected static ?string $navigationIcon = 'heroicon-o-users';

    // protected static ?string $cluster = AdminClustersUser::class;

    protected static ?string $navigationGroup = 'Users';

    // protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    public static function form(Form $form): Form
    {
        return $form

            ->schema(static::UserFormSchema());
    }

    public static function UserFormSchema(): array
    {
        return [

            Section::make('User')
                ->schema([

                    Grid::make(4)
                        ->schema([

                            TextInput::make('name')
                                ->label('Name')
                                ->required(),

                        ]),

                    Grid::make(4)
                        ->schema([

                            TextInput::make('username')
                                ->label('Username')
                                ->required()
                                ->unique(User::class, ignoreRecord: true),
                        ]),

                    Grid::make(4)
                        ->schema([

                            ToggleButtons::make('panelrole_id')
                                ->label('Panel')
                                ->required()
                                ->inline()
                                ->options(Panelrole::where('is_active', true)->pluck('panelrole', 'id')),
                        ]),

                    Grid::make(4)
                        ->schema([

                            ToggleButtons::make('mudirqism')
                                ->label('Mudir Qism')
                                ->inline()
                                ->multiple()
                                ->options(Qism::where('is_active', true)->pluck('abbr_qism', 'id')),
                        ]),

                ])
                ->compact(),

            Section::make('Password')
                ->schema([

                    Grid::make(2)
                        ->schema([

                            TextInput::make('password')
                                ->label('Password')
                                ->password()
                                ->dehydrateStateUsing(fn(string $state): string => Hash::make($state))
                                ->dehydrated(fn(?string $state): bool => filled($state))
                                ->required(fn(string $operation): bool => $operation === 'create'),

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

                ColumnGroup::make('Nama', [

                    TextColumn::make('name')
                        ->label('Name')
                        ->searchable(isIndividual: true, isGlobal: false)
                        ->copyable()
                        ->copyableState(function ($state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->sortable(),

                    TextColumn::make('username')
                        ->label('Username')
                        ->searchable(isIndividual: true, isGlobal: false)
                        ->copyable()
                        ->copyableState(function ($state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->sortable(),

                    TextColumn::make('email')
                        ->label('Email')
                        ->searchable(isIndividual: true, isGlobal: false)
                        ->copyable()
                        ->copyableState(function ($state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->sortable(),

                ]),

                ColumnGroup::make('Panel', [

                    TextColumn::make('panelrole.panelrole')
                        ->label('Panel')
                        ->searchable(isIndividual: true, isGlobal: false)
                        ->copyable()
                        ->copyableState(function ($state) {
                            return ($state);
                        })
                        ->copyMessage('Tersalin')
                        ->sortable(),
                ]),

                ColumnGroup::make('Mudir Qism', [

                    // TextColumn::make('qism.abbr_qism')
                    //     ->label('Mudir Qism')
                    //     ->searchable(isIndividual: true, isGlobal: false)
                    //     ->copyable()
                    //     ->copyableState(function ($state) {
                    //         return ($state);
                    //     })
                    //     ->copyMessage('Tersalin')
                    //     ->sortable(),
                ]),

                ColumnGroup::make('Status', [

                    CheckboxColumn::make('is_active')
                        ->label('Status')
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

                        TextConstraint::make('name')
                            ->label('Name')
                            ->nullable(),

                        TextConstraint::make('username')
                            ->label('Username')
                            ->nullable(),

                        SelectConstraint::make('panelrole_id')
                            ->label('Panel Role')
                            ->options(Panelrole::all()->pluck('panelrole', 'id'))
                            ->multiple()
                            ->nullable(),

                        TextConstraint::make('email')
                            ->label('Email')
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
                    ->importer(UserImporter::class)
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
                    ->exporter(UserExporter::class),

                BulkAction::make('panelrole')
                    ->label(__('Update Panel Role'))
                    ->color('info')
                    ->action(fn(Collection $records, array $data) => $records->each(
                        function ($record) {

                            // dd($record->panelrole);

                            if ($record->panelrole == 'admin') {

                                $user = User::where('id', $record->id)->first();

                                $user->panelrole_id = 1;
                                $user->save();
                            } elseif ($record->panelrole == 'pengajar') {

                                $user = User::where('id', $record->id)->first();
                                $user->panelrole_id = 2;
                                $user->save();
                            } elseif ($record->panelrole == 'walisantri') {

                                $user = User::where('id', $record->id)->first();
                                $user->panelrole_id = 3;
                                $user->save();
                            }
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'view' => Pages\ViewUser::route('/{record}'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
