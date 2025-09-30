<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\Communities\Tables;

use App\Filament\Admin\Resources\Communities\CommunityResource;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

final class CommunitiesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image_url')
                    ->label('Image')
                    ->circular()
                    ->size(40)
                    ->defaultImageUrl(url('/images/default-community.png')), // Fallback image
                TextColumn::make('name')->label('Name')->searchable()->sortable(),
                TextColumn::make('subforum')->label('Subforum')->searchable()->sortable(),
                TextColumn::make('creator.name')->label('Creator')->searchable()->sortable(),
                TextColumn::make('members_count')
                    ->label('Members')
                    ->counts('members')
                    ->sortable()
                    ->badge()
                    ->color('success'),
                TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->defaultSort('created_at', 'desc')
            ->actions([
                Action::make('Members')
                    ->icon('heroicon-o-users')
                    ->color('info')
                    ->url(fn ($record) => CommunityResource::getUrl('members', ['record' => $record->id])),
                EditAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ]);
    }
}
