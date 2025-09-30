<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\Posts\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

final class PostsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn ($query) => $query->withCount(['upvotes', 'downvotes']))
            ->recordUrl(null)
            ->columns([
                TextColumn::make('title')
                    ->label('Title')
                    ->limit(35)
                    ->searchable()
                    ->sortable(),
                TextColumn::make('community.subforum')
                    ->label('Community')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('upvotes_count')
                    ->label('Upvotes')
                    ->sortable()
                    ->badge()
                    ->color('success'),
                TextColumn::make('downvotes_count')
                    ->label('Downvotes')
                    ->sortable()
                    ->badge()
                    ->color('danger'),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                DeleteAction::make(),
                // EditAction is intentionally omitted to prevent post editing
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
