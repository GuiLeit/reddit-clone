<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\Communities\Resources\CommunityMembers\Pages;

use App\Filament\Admin\Resources\Communities\Resources\CommunityMembers\CommunityMemberResource;
use Filament\Resources\Pages\CreateRecord;

final class CreateCommunityMember extends CreateRecord
{
    protected static string $resource = CommunityMemberResource::class;
}
