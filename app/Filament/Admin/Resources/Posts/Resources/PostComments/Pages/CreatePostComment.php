<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\Posts\Resources\PostComments\Pages;

use App\Filament\Admin\Resources\Posts\Resources\PostComments\PostCommentResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Str;

final class CreatePostComment extends CreateRecord
{
    protected static string $resource = PostCommentResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = auth()->user()->id;
        $data['slug'] = Str::slug($data['title']);

        return $data;
    }
}
