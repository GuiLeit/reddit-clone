<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\Posts\Tables;

use App\Filament\Admin\Resources\Posts\PostResource;
use Filament\Actions\Action;
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
                TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                Action::make('Comments')
                    ->icon('heroicon-o-users')
                    ->color('info')
                    ->url(fn ($record) => PostResource::getUrl('comments', ['record' => $record->id])),
                DeleteAction::make(),
                // EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
