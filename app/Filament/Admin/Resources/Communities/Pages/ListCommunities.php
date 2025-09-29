<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\Communities\Pages;

use App\Filament\Admin\Resources\Communities\CommunityResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

final class ListCommunities extends ListRecords
{
    protected static string $resource = CommunityResource::class;

    protected function getTableQuery(): Builder
    {
        return parent::getTableQuery()->where('creator_id', auth()->user()->id);
    }

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
