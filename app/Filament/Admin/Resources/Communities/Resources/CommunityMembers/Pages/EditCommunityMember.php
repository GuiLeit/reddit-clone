<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\Communities\Resources\CommunityMembers\Pages;

use App\Filament\Admin\Resources\Communities\Resources\CommunityMembers\CommunityMemberResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

final class EditCommunityMember extends EditRecord
{
    protected static string $resource = CommunityMemberResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
