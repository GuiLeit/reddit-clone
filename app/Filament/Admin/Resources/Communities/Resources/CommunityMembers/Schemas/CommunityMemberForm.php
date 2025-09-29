<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\Communities\Resources\CommunityMembers\Schemas;

use Filament\Schemas\Schema;

final class CommunityMemberForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                //
            ]);
    }
}
