<?php

namespace App\Filament\Admin\Resources\QismDetailResource\Pages;

use App\Filament\Admin\Resources\MapelResource;
use App\Filament\Admin\Resources\QismDetailResource;
use Filament\Actions;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Pages\ManageRelatedRecords;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ManageMapel extends ManageRelatedRecords
{
    protected static string $resource = QismDetailResource::class;

    protected static string $relationship = 'mapels';

    // protected static ?string $inverseRelationship = 'numberrange';

    protected static ?string $navigationIcon = 'heroicon-o-arrow-right-end-on-rectangle';

    public function getTitle(): string
    {
        return __('Assignment ' . $this->getOwnerRecord()->abbr_qism_detail . ' to ' . $this->getNavigationLabel());
    }

    public static function getNavigationLabel(): string
    {
        return 'Mapel';
    }

    public function form(Form $form): Form
    {
        return MapelResource::form($form);
    }

    public function table(Table $table): Table
    {
        return MapelResource::table($table)
            ->recordTitleAttribute('mapel')
            ->inverseRelationship('qismDetails')
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label('New ' . $this->getNavigationLabel())
                    ->modalCloseButton(false)
                    ->modalHeading(' ')
                    ->modalWidth('full')
                    ->button()
                    ->closeModalByClickingAway(false),
                Tables\Actions\AttachAction::make()
                    ->recordSelectOptionsQuery(fn(Builder $query) => $query->where('is_active', true))
                    ->preloadRecordSelect()
                    ->multiple(),
            ])
            ->actions([
                ActionGroup::make([
                    Tables\Actions\EditAction::make()
                        ->label('Edit')
                        ->modalCloseButton(false)
                        ->modalHeading(' ')
                        ->modalWidth('full')
                        ->closeModalByClickingAway(false),
                    Tables\Actions\DetachAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ])
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DetachBulkAction::make(),
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
