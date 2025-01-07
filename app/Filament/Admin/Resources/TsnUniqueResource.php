<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Clusters\User as ClustersUser;
use App\Filament\Admin\Resources\TsnUniqueResource\Pages;
use App\Filament\Admin\Resources\TsnUniqueResource\RelationManagers;
use App\Filament\Exports\TsnUniqueExporter;
use App\Filament\Imports\TsnUniqueImporter;
use App\Models\TsnUnique;
use App\Models\User;
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
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\TextInputColumn;
use Filament\Tables\Filters\QueryBuilder;
use Filament\Tables\Filters\QueryBuilder\Constraints\BooleanConstraint;
use Filament\Tables\Filters\QueryBuilder\Constraints\DateConstraint;
use Filament\Tables\Filters\QueryBuilder\Constraints\TextConstraint;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\HtmlString;

class TsnUniqueResource extends Resource
{
    protected static ?string $model = User::class;

    public static function canViewAny(): bool
    {
        return auth()->user()->id == 1 || auth()->user()->id == 2;
    }

    protected static ?string $modelLabel = 'Tsn Unique';

    protected static ?string $pluralModelLabel = 'Tsn Unique';

    protected static ?string $navigationLabel = 'Tsn Unique';

    protected static ?int $navigationSort = 900000050;

    // protected static ?string $navigationIcon = 'heroicon-o-TsnUniques';

    // protected static ?string $cluster = AdminClustersTsnUnique::class;

    protected static ?string $navigationGroup = 'Users';

    // protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    public static function form(Form $form): Form
    {

        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('id')
                    ->label('ID')
                    ->searchable(isIndividual: true, isGlobal: false)
                    ->copyable()
                    ->copyableState(function ($state) {
                        return ($state);
                    })
                    ->copyMessage('Tersalin')
                    ->sortable(),

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

                ]),

                ColumnGroup::make('TsnUnique', [

                    TextInputColumn::make('tsnunique')
                        ->label('TsnUnique')
                        ->searchable(isIndividual: true, isGlobal: false)
                        ->sortable(),

                    TextColumn::make('copyable')
                        ->label('User Pass')
                        ->default(function (Model $record) {

                            return (new HtmlString('<div>Bismillah, </br>
                            </br>
                                siakad.tsn.ponpes.id
                            </br>
                            </br>
                            ' . $record->name . '
                            </br>
                                __________</br>
                                Username:</br></br>
                                ' . $record->username . '</br></br>
                                __________</br></br>
                                Password:</br></br>
                                ' . $record->tsnunique . '</div>'));
                        })
                        ->copyable()
                        ->copyableState(function (Model $record) {

                            return (new HtmlString(
                                'Bismillah,

                                siakad.tsn.ponpes.id

                                ' . $record->name . '

                                __________

                                Username:

                                ' . $record->username . '

                                __________

                                Password:

                                ' . $record->tsnunique . ''
                            ));
                        })
                        ->sortable(),

                ]),

                ColumnGroup::make('Req Status', [

                    CheckboxColumn::make('is_request')
                        ->label('Req')
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
                    ->importer(TsnUniqueImporter::class)
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
                    ->exporter(TsnUniqueExporter::class),

                BulkAction::make('Ubah Unique')
                    ->label(__('Ubah Unique'))
                    ->color('info')
                    // ->requiresConfirmation()
                    // ->modalIcon('heroicon-o-check-circle')
                    // ->modalIconColor('success')
                    // ->modalHeading('Ubah Status menjadi "Diterima sebagai santri?"')
                    // ->modalDescription('Setelah klik tombol "Simpan", maka status akan berubah')
                    // ->modalSubmitActionLabel('Simpan')
                    ->action(fn(Collection $records, array $data) => $records->each(
                        function ($record) {

                            $password = $record->tsnunique;
                            $updatepassword = Hash::make($password);

                            User::where('username', $record->username)
                                ->update(['password' => $updatepassword]);

                            Notification::make()
                                // ->success()
                                ->title('Unique berhasil diubah')
                                ->icon('heroicon-o-exclamation-triangle')
                                ->iconColor('success')
                                // ->persistent()
                                ->color('success')
                                ->send();
                        }
                    ))
                    ->deselectRecordsAfterCompletion(),

                BulkAction::make('Set Aktif')
                    ->label(__('Set Aktif'))
                    ->color('success')
                    // ->requiresConfirmation()
                    // ->modalIcon('heroicon-o-check-circle')
                    // ->modalIconColor('success')
                    // ->modalHeading('Ubah Status menjadi "Diterima sebagai santri?"')
                    // ->modalDescription('Setelah klik tombol "Simpan", maka status akan berubah')
                    // ->modalSubmitActionLabel('Simpan')
                    ->action(fn(Collection $records, array $data) => $records->each(
                        function ($record) {

                            User::where('username', $record->username)
                                ->update(['is_active' => 1]);

                            Notification::make()
                                // ->success()
                                ->title('Status User berhasil diubah')
                                ->icon('heroicon-o-exclamation-triangle')
                                ->iconColor('success')
                                // ->persistent()
                                ->color('success')
                                ->send();
                        }
                    ))
                    ->deselectRecordsAfterCompletion(),

                BulkAction::make('Set Tidak Aktif')
                    ->label(__('Set Tidak Aktif'))
                    ->color('danger')
                    // ->requiresConfirmation()
                    // ->modalIcon('heroicon-o-check-circle')
                    // ->modalIconColor('success')
                    // ->modalHeading('Ubah Status menjadi "Diterima sebagai santri?"')
                    // ->modalDescription('Setelah klik tombol "Simpan", maka status akan berubah')
                    // ->modalSubmitActionLabel('Simpan')
                    ->action(fn(Collection $records, array $data) => $records->each(
                        function ($record) {

                            User::where('username', $record->username)
                                ->update(['is_active' => 0]);

                            Notification::make()
                                // ->success()
                                ->title('Status User berhasil diubah')
                                ->icon('heroicon-o-exclamation-triangle')
                                ->iconColor('success')
                                // ->persistent()
                                ->color('success')
                                ->send();
                        }
                    ))
                    ->deselectRecordsAfterCompletion(),

                BulkAction::make('Set Panel Admin')
                    ->label(__('Set Panel Admin'))
                    ->color('warning')
                    // ->requiresConfirmation()
                    // ->modalIcon('heroicon-o-check-circle')
                    // ->modalIconColor('success')
                    // ->modalHeading('Ubah Status menjadi "Diterima sebagai santri?"')
                    // ->modalDescription('Setelah klik tombol "Simpan", maka status akan berubah')
                    // ->modalSubmitActionLabel('Simpan')
                    ->action(fn(Collection $records, array $data) => $records->each(
                        function ($record) {

                            User::where('username', $record->username)
                                ->update(['panelrole_id' => 1]);

                            Notification::make()
                                // ->success()
                                ->title('Status User berhasil diubah')
                                ->icon('heroicon-o-exclamation-triangle')
                                ->iconColor('success')
                                // ->persistent()
                                ->color('success')
                                ->send();
                        }
                    ))
                    ->deselectRecordsAfterCompletion(),

                BulkAction::make('Set Panel TSN')
                    ->label(__('Set Panel TSN'))
                    ->color('warning')
                    // ->requiresConfirmation()
                    // ->modalIcon('heroicon-o-check-circle')
                    // ->modalIconColor('success')
                    // ->modalHeading('Ubah Status menjadi "Diterima sebagai santri?"')
                    // ->modalDescription('Setelah klik tombol "Simpan", maka status akan berubah')
                    // ->modalSubmitActionLabel('Simpan')
                    ->action(fn(Collection $records, array $data) => $records->each(
                        function ($record) {

                            User::where('username', $record->username)
                                ->update(['panelrole_id' => 2]);

                            Notification::make()
                                // ->success()
                                ->title('Status User berhasil diubah')
                                ->icon('heroicon-o-exclamation-triangle')
                                ->iconColor('success')
                                // ->persistent()
                                ->color('success')
                                ->send();
                        }
                    ))
                    ->deselectRecordsAfterCompletion(),

                BulkAction::make('Set Panel Walisantri')
                    ->label(__('Set Panel Walisantri'))
                    ->color('warning')
                    // ->requiresConfirmation()
                    // ->modalIcon('heroicon-o-check-circle')
                    // ->modalIconColor('success')
                    // ->modalHeading('Ubah Status menjadi "Diterima sebagai santri?"')
                    // ->modalDescription('Setelah klik tombol "Simpan", maka status akan berubah')
                    // ->modalSubmitActionLabel('Simpan')
                    ->action(fn(Collection $records, array $data) => $records->each(
                        function ($record) {

                            User::where('username', $record->username)
                                ->update(['panelrole_id' => 3]);

                            Notification::make()
                                // ->success()
                                ->title('Status User berhasil diubah')
                                ->icon('heroicon-o-exclamation-triangle')
                                ->iconColor('success')
                                // ->persistent()
                                ->color('success')
                                ->send();
                        }
                    ))
                    ->deselectRecordsAfterCompletion(),

                BulkAction::make('Set Panel PSB')
                    ->label(__('Set Panel PSB'))
                    ->color('warning')
                    // ->requiresConfirmation()
                    // ->modalIcon('heroicon-o-check-circle')
                    // ->modalIconColor('success')
                    // ->modalHeading('Ubah Status menjadi "Diterima sebagai santri?"')
                    // ->modalDescription('Setelah klik tombol "Simpan", maka status akan berubah')
                    // ->modalSubmitActionLabel('Simpan')
                    ->action(fn(Collection $records, array $data) => $records->each(
                        function ($record) {

                            User::where('username', $record->username)
                                ->update(['panelrole_id' => 4]);

                            Notification::make()
                                // ->success()
                                ->title('Status User berhasil diubah')
                                ->icon('heroicon-o-exclamation-triangle')
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
            'index' => Pages\ListTsnUniques::route('/'),
            'create' => Pages\CreateTsnUnique::route('/create'),
            'view' => Pages\ViewTsnUnique::route('/{record}'),
            'edit' => Pages\EditTsnUnique::route('/{record}/edit'),
        ];
    }
}
