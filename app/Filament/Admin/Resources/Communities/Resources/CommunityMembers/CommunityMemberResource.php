<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\Communities\Resources\CommunityMembers;

use App\Filament\Admin\Resources\Communities\CommunityResource;
use App\Filament\Admin\Resources\Communities\Resources\CommunityMembers\Schemas\CommunityMemberForm;
use App\Filament\Admin\Resources\Communities\Resources\CommunityMembers\Tables\CommunityMembersTable;
use App\Models\CommunityMember;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

final class CommunityMemberResource extends Resource
{
    protected static ?string $model = CommunityMember::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $parentResource = CommunityResource::class;

    public static function form(Schema $schema): Schema
    {
        return CommunityMemberForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CommunityMembersTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            // 'create' => CreateCommunityMember::route('/create'),
            // 'edit' => EditCommunityMember::route('/{record}/edit'),
        ];
    }
}
