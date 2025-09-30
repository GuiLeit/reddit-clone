<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\Posts\Pages;

use App\Filament\Admin\Resources\Posts\PostResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

final class ListPosts extends ListRecords
{
    protected static string $resource = PostResource::class;

    protected function getTableQuery(): Builder
    {
        return parent::getTableQuery()->where('user_id', auth()->user()->id);
    }

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
