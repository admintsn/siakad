<?php

namespace App\Filament\Tsn\Resources;

use App\Filament\Tsn\Resources\SemuaNilaiResource\Pages;
use App\Filament\Tsn\Resources\SemuaNilaiResource\RelationManagers;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Nilai;
use App\Models\Pengajar;
use App\Models\QismDetail;
use App\Models\SemesterBerjalan;
use App\Models\SemuaNilai;
use App\Models\TahunBerjalan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\CheckboxColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Grouping\Group;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class SemuaNilaiResource extends Resource
{
    protected static ?string $model = Nilai::class;

    public static function canViewAny(): bool
    {
        return auth()->user()->mudirqism !== null;
    }

    protected static ?string $modelLabel = 'Semua Nilai';

    protected static ?string $pluralModelLabel = 'Semua Nilai';

    protected static ?string $navigationLabel = 'Semua Nilai';

    protected static ?int $navigationSort = 800000000;

    // protected static ?string $navigationIcon = 'heroicon-o-Qisms';

    // protected static ?string $cluster = ConfigLembaga::class;

    protected static ?string $navigationGroup = 'Menu Mudir';

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
            ->heading('Data Semua Nilai per Qism')
            ->description('Data semua nilai per qism untuk pengecekan mudir qism')
            ->recordUrl(null)
            ->defaultPaginationPageOption('all')
            // ->striped()
            ->columns([

                TextColumn::make('file_nilai')
                    ->label('Link')
                    ->formatStateUsing(fn(string $state): string => __("Cek"))
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

                IconColumn::make('is_nilai_selesai')
                    ->label('Status')
                    ->alignCenter()
                    ->boolean()
                    // ->disabled()
                    ->sortable(),

                TextColumn::make('qismDetail.abbr_qism_detail')
                    ->label('Qism')
                    ->sortable(),

                TextColumn::make('kelas.kelas')
                    ->label('Kelas')
                    ->sortable(),

                TextColumn::make('kelas_internal')
                    ->label('Kelas Internal')
                    ->sortable(),

                TextColumn::make('mapel.mapel')
                    ->label('Mapel')
                    ->sortable(),

                TextColumn::make('keterangan_nilai')
                    ->label('Keterangan')
                    ->sortable(),

                TextColumn::make('kode_soal')
                    ->label('Kode Soal')
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('pengajar.nama')
                    ->label('Nama Pengajar')
                    ->sortable(),

            ])
            ->groups([
                Group::make('jenisSoal.jenis_soal')
                    ->titlePrefixedWithLabel(false)
            ])

            ->defaultGroup('jenisSoal.jenis_soal')
            ->defaultSort('kode_soal')
            ->filters([

                SelectFilter::make('qism_detail_id')
                    ->label('Qism')
                    ->multiple()
                    ->options(QismDetail::all()->pluck('abbr_qism_detail', 'id'))
                    ->visible(auth()->user()->id === 1 || auth()->user()->id === 2),

                SelectFilter::make('kelas_id')
                    ->label('Kelas')
                    ->multiple()
                    ->options(Kelas::all()->pluck('kelas', 'id'))
                    ->visible(auth()->user()->id === 1 || auth()->user()->id === 2),

                SelectFilter::make('mapel_id')
                    ->label('Mapel')
                    ->multiple()
                    ->options(Mapel::all()->pluck('mapel', 'id'))
                    ->visible(auth()->user()->id === 1 || auth()->user()->id === 2),

                SelectFilter::make('pengajar_id')
                    ->label('Pengajar')
                    ->multiple()
                    ->options(Pengajar::all()->pluck('nama', 'id'))
                    ->visible(auth()->user()->id === 1 || auth()->user()->id === 2),

                Filter::make('is_nilai_selesai')
                    ->label('Nilai Selesai')
                    ->query(fn(Builder $query): Builder => $query->where('is_nilai_selesai', 1))
                    ->visible(auth()->user()->id === 1 || auth()->user()->id === 2),

                Filter::make('Nilai Belum Selesai')
                    ->label('Nilai Belum Selesai')
                    ->query(fn(Builder $query): Builder => $query->where('is_nilai_selesai', 0))
                    ->visible(auth()->user()->id === 1 || auth()->user()->id === 2),

            ], layout: FiltersLayout::AboveContent)
            ->filtersFormColumns(4)
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
            'index' => Pages\ListSemuaNilais::route('/'),
            'create' => Pages\CreateSemuaNilai::route('/create'),
            'view' => Pages\ViewSemuaNilai::route('/{record}'),
            'edit' => Pages\EditSemuaNilai::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        $tahunberjalan = TahunBerjalan::where('is_active', 1)->first();

        $semesterberjalan = SemesterBerjalan::where('is_active', 1)->first();

        if (Auth::user()->id === 1 or Auth::user()->id === 2) {
            return parent::getEloquentQuery()->where('is_nilai', 1)->where('tahun_berjalan_id', $tahunberjalan->id)->where('semester_berjalan_id', $semesterberjalan->id);
        } else {

            return parent::getEloquentQuery()->whereIn('qism_id', Auth::user()->mudirqism)->where('is_nilai', 1)->where('tahun_berjalan_id', $tahunberjalan->id)->where('semester_berjalan_id', $semesterberjalan->id);
        }
    }
}
