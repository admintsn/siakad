<?php

namespace App\Filament\Tsn\Resources;

use App\Filament\Admin\Resources\DataImtihanResource;
use App\Filament\Tsn\Resources\NilaiTaResource\Pages;
use App\Filament\Tsn\Resources\NilaiTaResource\RelationManagers;
use App\Models\JenisSoal;
use App\Models\KategoriSoal;
use App\Models\Kelas;
use App\Models\KelasSantri;
use App\Models\Mahad;
use App\Models\Mapel;
use App\Models\MapelQism;
use App\Models\Nilai;
use App\Models\Pengajar;
use App\Models\Qism;
use App\Models\QismDetail;
use App\Models\QismDetailHasKelas;
use App\Models\Sem;
use App\Models\Semester;
use App\Models\SemesterBerjalan;
use App\Models\StaffAdmin;
use App\Models\TahunAjaran;
use App\Models\TahunAjaranAktif;
use App\Models\TahunBerjalan;
use Filament\Forms;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Notifications\Notification;
use Filament\Pages\SubNavigationPosition;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\ExportBulkAction;
use Filament\Tables\Actions\ImportAction;
use Filament\Tables\Actions\ReplicateAction;
use Filament\Tables\Columns\CheckboxColumn;
use Filament\Tables\Columns\ColumnGroup;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\TextInputColumn;
use Filament\Tables\Enums\ActionsPosition;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\QueryBuilder;
use Filament\Tables\Filters\QueryBuilder\Constraints\BooleanConstraint;
use Filament\Tables\Filters\QueryBuilder\Constraints\DateConstraint;
use Filament\Tables\Filters\QueryBuilder\Constraints\SelectConstraint;
use Filament\Tables\Filters\QueryBuilder\Constraints\TextConstraint;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Grouping\Group;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\HtmlString;
use Illuminate\Validation\Rules\Unique;

class NilaiTaResource extends Resource
{
    protected static ?string $model = Nilai::class;

    public static function canViewAny(): bool
    {

        if (auth()->user()->id === 1 || auth()->user()->id === 2) {
            return true;
        } else {

            $cek = Nilai::whereHas('pengajar', function ($query) {
                $query->where('user_id', Auth::user()->id);
            })
                ->where('jenis_soal_id', 3)->count();

            if ($cek !== 0) {

                return true;
            } else {

                return false;
            }
        }
    }

    protected static ?string $modelLabel = 'Nilai TA';

    protected static ?string $pluralModelLabel = 'Nilai TA';

    protected static ?string $navigationLabel = 'Nilai TA';

    protected static ?int $navigationSort = 700000100;

    // protected static ?string $navigationIcon = 'heroicon-o-Qisms';

    // protected static ?string $cluster = ConfigLembaga::class;

    protected static ?string $navigationGroup = 'Nilai Imtihan';

    // protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    public static function form(Form $form): Form
    {

        return DataImtihanResource::form($form);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->heading('Daftar mata pelajaran')
            ->description(new HtmlString('<div>
            <table class="table w-fit">
            <!-- head -->
            <thead>
                <tr>
                    <th class="text-tsn-header text-xs" colspan="2"></th>
                </tr>
            </thead>
            <tbody>
            <tr>
            <th class="text-xs align-top">-</th>
            <td class="text-xs">Klik "Input" untuk mulai input nilai</td>
            </tr>
            <tr>
            <th class="text-xs align-top">-</th>
            <td class="text-xs">Centang Status untuk menandai bahwa input nilai telah selesai</td>
            </tr>
            <tr>
            <th class="text-xs align-top">-</th>
            <td class="text-xs">Jika terdapat data yang kurang sesuai, harap disampaikan ke admin agar direvisi oleh admin</td>
            </tr>
            </tbody>
            </table>
                                </div>'))
            ->recordUrl(null)
            ->defaultPaginationPageOption('all')
            // ->striped()
            ->columns([

                TextColumn::make('file_nilai')
                    ->label('Link')
                    ->formatStateUsing(fn(string $state): string => __("Input"))
                    ->icon('heroicon-s-pencil-square')
                    ->iconColor('success')
                    // ->circular()
                    ->alignCenter()
                    ->url(function (Model $record) {
                        if ($record->file_nilai !== null) {

                            return ($record->file_nilai);
                        }
                    })
                    ->badge()
                    ->color('info')
                    ->openUrlInNewTab(),

                ColumnGroup::make('Centang jika input nilai telah selesai', [

                    CheckboxColumn::make('is_nilai_selesai')
                        ->label('Status')
                        ->alignCenter()
                        ->sortable(),

                ])->alignCenter(),

                TextColumn::make('kode_soal')
                    ->label('Nilai')
                    ->sortable(),

                TextColumn::make('pengajar.nama')
                    ->label('Nama Pengajar')
                    ->toggleable(isToggledHiddenByDefault: true),

            ])
            ->groups([
                Group::make('qismDetail.abbr_qism_detail')
                    ->titlePrefixedWithLabel(false)
            ])

            ->defaultGroup('qismDetail.abbr_qism_detail')
            ->groupingSettingsHidden()
            ->defaultSort('kode_soal')
            ->filters([

                SelectFilter::make('qism_detail_id')
                    ->label('Qism')
                    ->multiple()
                    ->options([
                        '1' => 'TAPa',
                        '2' => 'TAPi',
                        '3' => 'PTPa',
                        '4' => 'PTPi',
                        '5' => 'TQPa',
                        '6' => 'TQPi',
                        '7' => 'IDD',
                        '8' => 'MTW',
                        '9' => 'TN',
                    ])
                    ->hidden(auth()->user()->id !== 1 || auth()->user()->id !== 2),

                SelectFilter::make('kelas_id')
                    ->label('Kelas')
                    ->multiple()
                    ->options([
                        '1' => 'Kelas 1',
                        '2' => 'Kelas 2',
                        '3' => 'Kelas 3',
                        '4' => 'Kelas 4',
                        '5' => 'Kelas 5',
                        '6' => 'Kelas 6',
                        '7' => 'Kelas A',
                        '8' => 'Kelas B',
                        '9' => 'Kelas MTW',
                    ])
                    ->hidden(auth()->user()->id !== 1 || auth()->user()->id !== 2),

                Filter::make('is_nilai_selesai')
                    ->label('Nilai Selesai')
                    ->query(fn(Builder $query): Builder => $query->where('is_nilai_selesai', 1))
                    ->hidden(auth()->user()->id !== 1 || auth()->user()->id !== 2),

                Filter::make('Nilai Belum Selesai')
                    ->label('Nilai Belum Selesai')
                    ->query(fn(Builder $query): Builder => $query->where('is_nilai_selesai', 0))
                    ->hidden(auth()->user()->id !== 1 || auth()->user()->id !== 2),

            ], layout: FiltersLayout::AboveContent)
            ->actions([])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                // Tables\Actions\DeleteBulkAction::make(),
                // ]),
            ])
            ->emptyStateHeading('Tidak ada data')
            ->emptyStateIcon('heroicon-o-book-open');
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
            'index' => Pages\ListNilaiTas::route('/'),
            'create' => Pages\CreateNilaiTa::route('/create'),
            'view' => Pages\ViewNilaiTa::route('/{record}'),
            'edit' => Pages\EditNilaiTa::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        $tahunberjalan = TahunBerjalan::where('is_active', 1)->first();

        $semesterberjalan = SemesterBerjalan::where('is_active', 1)->first();

        if (Auth::user()->id === 1 or Auth::user()->id === 2) {
            return parent::getEloquentQuery()->where('jenis_soal_id', 3)->where('is_nilai', 1)->where('tahun_berjalan_id', $tahunberjalan->id)->where('semester_berjalan_id', $semesterberjalan->id);
        } else {

            return parent::getEloquentQuery()->whereHas('pengajar', function ($query) {
                $query->where('user_id', Auth::user()->id);
            })->where('jenis_soal_id', 3)->where('is_nilai', 1)->where('tahun_berjalan_id', $tahunberjalan->id)->where('semester_berjalan_id', $semesterberjalan->id);
        }
    }

}
