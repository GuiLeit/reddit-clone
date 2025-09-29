<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\Communities\Pages;

use App\Filament\Admin\Resources\Communities\CommunityResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Str;

final class EditCommunity extends EditRecord
{
    protected static string $resource = CommunityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['slug'] = Str::slug($data['slug'] ?? $data['name'] ?? '');

        return $data;
    }
}
