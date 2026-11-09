<?php

namespace App\Filament\Resources\Users\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn; 
use Filament\Tables\Table;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Name')
                    ->searchable()
                    ->sortable(),
                
                TextColumn::make('email')
                    ->label('Email address')
                    ->searchable()
                    ->sortable(),
                
                TextColumn::make('role')
                    ->label('Role')
                    ->searchable()
                    ->sortable(),
                
                TextColumn::make('nis')
                    ->label('Nis')
                    ->searchable(),
                
                TextColumn::make('kelas')
                    ->label('Kelas')
                    ->searchable()
                    ->sortable(),
                
                TextColumn::make('email_verified_at')
                    ->label('Email verified at')
                    ->dateTime() 
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
