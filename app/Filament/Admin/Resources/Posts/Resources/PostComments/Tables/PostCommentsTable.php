<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\Posts\Resources\PostComments\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

final class PostCommentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn ($query) => $query->withCount(['upvotes', 'downvotes']))
            ->columns([
                TextColumn::make('User')
                    ->label('User')
                    ->formatStateUsing(fn ($record) => $record->user->name)
                    ->searchable()
                    ->sortable(),
                TextColumn::make('body')
                    ->label('Comment')
                    ->limit(25)
                    ->searchable()
                    ->columnSpanFull(),
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
                TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
