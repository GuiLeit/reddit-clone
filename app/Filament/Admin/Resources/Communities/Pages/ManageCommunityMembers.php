<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\Communities\Pages;

use App\Filament\Admin\Resources\Communities\CommunityResource;
use App\Filament\Admin\Resources\Communities\Resources\CommunityMembers\CommunityMemberResource;
use Filament\Resources\Pages\ManageRelatedRecords;
use Filament\Tables\Table;

final class ManageCommunityMembers extends ManageRelatedRecords
{
    protected static string $resource = CommunityResource::class;

    protected static string $relationship = 'members';

    protected static ?string $relatedResource = CommunityMemberResource::class;

    protected static ?string $title = 'Manage Community Members';

    public function table(Table $table): Table
    {
        return $table
            ->headerActions([
                // CreateAction::make(),
            ]);
    }
}
