<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\Communities\Pages;

use App\Filament\Admin\Resources\Communities\CommunityResource;
use Filament\Resources\Pages\CreateRecord;

final class CreateCommunity extends CreateRecord
{
    protected static string $resource = CommunityResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['creator_id'] = auth()->user()->id;

        return $data;
    }
}
