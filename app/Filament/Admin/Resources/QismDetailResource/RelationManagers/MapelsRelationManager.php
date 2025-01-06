<?php

namespace App\Filament\Admin\Resources\QismDetailResource\RelationManagers;

use App\Filament\Admin\Resources\MapelResource;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Table;
use Guava\FilamentModalRelationManagers\Concerns\CanBeEmbeddedInModals;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MapelsRelationManager extends RelationManager
{
    use CanBeEmbeddedInModals;

    protected static string $relationship = 'mapels';

    protected static ?string $inverseRelationship = 'qismDetails';

    protected static ?string $navigationIcon = 'heroicon-o-arrow-right-end-on-rectangle';

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
            // ->inverseRelationship('qismDetails')
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
