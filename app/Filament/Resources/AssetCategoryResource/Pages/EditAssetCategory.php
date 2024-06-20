<?php

namespace App\Filament\Resources\AssetCategoryResource\Pages;

use App\Filament\Resources\AssetCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAssetCategory extends EditRecord
{
    protected static string $resource = AssetCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Edit Create Asset Category Successful';
    }
}
