<?php

namespace App\Filament\Resources\Pengaduans\Tables;

use App\Models\Pengaduan;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class PengaduansTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('siswa.name')
                    ->label('Siswa')
                    ->searchable(),
                TextColumn::make('siswa.nis')
                    ->label('NIS'),
                TextColumn::make('name')
                    ->label('Nama Sarana')
                    ->searchable(),
                TextColumn::make('category.name')
                    ->label('Kategori')
                    ->searchable(),
                TextColumn::make('ruangan')
                    ->searchable(),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state) => match ($state) {
                        'menunggu' => 'warning',
                        'proses' => 'info',
                        default => 'success',
                    }),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('category_id')
                    ->label('Kategori')
                    ->relationship('category', 'name'),
                Filter::make('tanggal')
                    ->schema([DatePicker::make('tanggal')])
                    ->query(fn (Builder $query, array $data) => $query->when($data['tanggal'], fn ($q, $tgl) => $q->whereDate('created_at', $tgl))),
                SelectFilter::make('bulan')
                    ->options([1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April', 5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus', 9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'])
                    ->query(fn (Builder $query, array $data) => $query->when($data['value'], fn ($q, $bln) => $q->whereMonth('created_at', $bln))),
                Filter::make('nis')
                    ->schema([TextInput::make('nis')->label('NIS')])
                    ->query(fn (Builder $query, array $data) => $query->when($data['nis'], fn ($q, $nis) => $q->whereRelation('siswa', 'nis', $nis))),
            ])
            ->recordActions([
                EditAction::make(),
                Action::make('tanggapi')
                    ->icon('heroicon-o-chat-bubble-left-right')
                    ->visible(fn () => auth()->user()->isAdmin())
                    ->fillForm(fn (Pengaduan $record) => ['status' => $record->status])
                    ->schema([
                        Select::make('status')
                            ->options(['menunggu' => 'Menunggu', 'proses' => 'Proses', 'selesai' => 'Selesai'])
                            ->required(),
                    ])
                    ->action(function (Pengaduan $record, array $data) {
                        $record->update($data);
                        Notification::make()->title('Tanggapan disimpan')->success()->send();
                    }),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}