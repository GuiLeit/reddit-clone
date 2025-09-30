<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\Posts\Resources\PostComments\Pages;

use App\Filament\Admin\Resources\Posts\Resources\PostComments\PostCommentResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

final class EditPostComment extends EditRecord
{
    protected static string $resource = PostCommentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
