<?php

namespace App\Filament\Admin\Resources\Communities\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;

class CommunityForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(2)
                    ->components([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->columnSpan(1),
                        
                        TextInput::make('slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true)
                            ->columnSpan(1)
                            ->disabled()
                            ->dehydrated(),
                    ]),
                    
                Textarea::make('description')
                    ->columnSpanFull()
                    ->rows(4),
                    
                Select::make('creator_id')
                    ->relationship('creator', 'name')
                    ->required()
                    ->searchable()
                    ->preload(),
                    
                FileUpload::make('image')
                    ->image()
                    ->directory('communities')
                    ->visibility('public'),
            ]);
    }
}
