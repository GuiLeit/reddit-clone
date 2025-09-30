<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\Posts\Resources\PostComments;

use App\Filament\Admin\Resources\Posts\PostResource;
use App\Filament\Admin\Resources\Posts\Resources\PostComments\Schemas\PostCommentForm;
use App\Filament\Admin\Resources\Posts\Resources\PostComments\Tables\PostCommentsTable;
use App\Models\Comment;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

final class PostCommentResource extends Resource
{
    protected static ?string $model = Comment::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $parentResource = PostResource::class;

    public static function form(Schema $schema): Schema
    {
        return PostCommentForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PostCommentsTable::configure($table);
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
            // 'create' => CreatePostComment::route('/create'),
            // 'edit' => EditPostComment::route('/{record}/edit'),
        ];
    }
}
