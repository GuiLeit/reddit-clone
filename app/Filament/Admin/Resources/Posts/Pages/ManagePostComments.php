<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\Posts\Pages;

use App\Filament\Admin\Resources\Posts\PostResource;
use App\Filament\Admin\Resources\Posts\Resources\PostComments\PostCommentResource;
use Filament\Resources\Pages\ManageRelatedRecords;
use Filament\Tables\Table;

final class ManagePostComments extends ManageRelatedRecords
{
    protected static string $resource = PostResource::class;

    protected static string $relationship = 'comments';

    protected static ?string $relatedResource = PostCommentResource::class;

    protected static ?string $title = 'Manage Post Comments';

    public function table(Table $table): Table
    {
        return $table
            ->headerActions([
                // CreateAction::make(),
            ]);
    }
}
