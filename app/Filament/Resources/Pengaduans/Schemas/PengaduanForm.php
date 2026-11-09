<?php

namespace App\Filament\Resources\Pengaduans\Schemas;

use App\Models\Siswa;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class PengaduanForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('siswa_id')
                    ->label('Siswa')
                    ->relationship('siswa', 'name')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->visible(fn () => auth()->user()->isAdmin()),
                Hidden::make('siswa_id')
                    ->default(fn () => Siswa::where('nis', auth()->user()->nis)->value('id'))
                    ->visible(fn () => ! auth()->user()->isAdmin()),
                TextInput::make('name')
                    ->label('Nama Sarana')
                    ->required()
                    ->maxLength(255),
                Select::make('category_id')
                    ->label('Kategori')
                    ->relationship('category', 'name')
                    ->required(),
                TextInput::make('ruangan')
                    ->required()
                    ->maxLength(255),
                Textarea::make('deskripsi')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }
}