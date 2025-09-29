<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\Communities;

use App\Filament\Admin\Resources\Communities\Pages\CreateCommunity;
use App\Filament\Admin\Resources\Communities\Pages\EditCommunity;
use App\Filament\Admin\Resources\Communities\Pages\ListCommunities;
use App\Filament\Admin\Resources\Communities\Schemas\CommunityForm;
use App\Filament\Admin\Resources\Communities\Tables\CommunitiesTable;
use App\Models\Community;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

final class CommunityResource extends Resource
{
    protected static ?string $model = Community::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return CommunityForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CommunitiesTable::configure($table);
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
            'index' => ListCommunities::route('/'),
            'create' => CreateCommunity::route('/create'),
            'edit' => EditCommunity::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
