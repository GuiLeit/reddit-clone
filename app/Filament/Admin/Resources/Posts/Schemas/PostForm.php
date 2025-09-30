<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\Posts\Schemas;

use Filament\Facades\Filament;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

final class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('Title')
                    ->required()
                    ->maxLength(255)
                    ->autofocus(),
                Select::make('community_id')
                    ->label('Community')
                    ->relationship(
                        'community',
                        'subforum',
                        fn ($query) => $query->whereUserBelongs(Filament::auth()->id())
                    )
                    ->required(),
                TextInput::make('body')
                    ->label('Body')
                    ->maxLength(5000)
                    ->columnSpanFull(),

            ]);
    }
}
