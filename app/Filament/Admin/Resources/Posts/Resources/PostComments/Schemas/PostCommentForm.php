<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\Posts\Resources\PostComments\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

final class PostCommentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('body')
                    ->label('Comentário')
                    ->maxLength(255)
                    ->columnSpanFull(),
            ]);
    }
}
