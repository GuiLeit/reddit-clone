<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\Communities\Resources\CommunityMembers\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

final class CommunityMembersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('profile_picture')
                    ->label('Image')
                    ->circular()
                    ->size(40)
                    ->defaultImageUrl(url('/images/default-community.png')), // Fallback image
                TextColumn::make('username')->label('Username')->searchable()->sortable(),
                TextColumn::make('name')->label('Name')->searchable()->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                // EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
