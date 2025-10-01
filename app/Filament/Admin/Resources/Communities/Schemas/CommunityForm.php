<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\Communities\Schemas;

use App\Models\Community;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

final class CommunityForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Name')
                    ->required()
                    ->maxLength(100)
                    ->autofocus(),
                TextInput::make('subforum')
                    ->label('Subforum')
                    ->unique(Community::class, 'subforum')
                    ->required()
                    ->maxLength(100)
                    ->reactive()
                    ->afterStateUpdated(fn ($state, callable $set) => $set('subforum', Str::studly($state)))
                    ->prefix('//c'),
                TextInput::make('description')
                    ->label('Description')
                    ->maxLength(255)
                    ->columnSpanFull(),
                FileUpload::make('image')
                    ->label('Community Image')
                    ->image()
                    ->disk('public')
                    ->directory('communities')
                    ->maxSize(2048)
                    ->columnSpanFull(),
            ]);
    }
}
