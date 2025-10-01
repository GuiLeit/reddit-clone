<?php

declare(strict_types=1);

namespace App\Filament\Shared\Pages;

use App\Models\User;
use Filament\Auth\Pages\Register;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Component;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;

final class RegisterPage extends Register
{
    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Wizard::make([
                    Step::make('Nome')
                        ->schema([
                            $this->getNameFormComponent(),
                            $this->getUsernameFormComponent(),
                        ]),
                    Step::make('Imagem')
                        ->schema([
                            $this->getProfileImageFormComponent(),
                        ]),
                    Step::make('Email/Senha')
                        ->schema([
                            $this->getEmailFormComponent(),
                            $this->getPasswordFormComponent(),
                            $this->getPasswordConfirmationFormComponent(),
                        ]),
                ])->submitAction(new HtmlString(Blade::render(<<<'BLADE'
                    <x-filament::button
                        type="submit"
                        size="sm"
                        wire:submit="register"
                    >
                        Register
                    </x-filament::button>
                    BLADE))),
            ]);
    }

    protected function getFormActions(): array
    {
        return [];
    }

    private function getUsernameFormComponent(): Component
    {
        return TextInput::make('username')
            ->label('Username')
            ->unique(User::class, 'username')
            ->required()
            ->maxLength(100)
            ->reactive()
            ->afterStateUpdated(fn ($state, callable $set) => $set('username', Str::studly($state)))
            ->prefix('//u');
    }

    private function getProfileImageFormComponent(): Component
    {
        return FileUpload::make('profile_picture')
            ->label('Imagem de perfil')
            ->image()
            ->disk('public')
            ->directory('communities')
            ->maxSize(2048)
            ->columnSpanFull();
    }
}
