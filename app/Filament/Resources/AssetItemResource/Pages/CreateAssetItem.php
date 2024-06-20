<?php

namespace App\Filament\Resources\AssetItemResource\Pages;

use App\Filament\Resources\AssetItemResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateAssetItem extends CreateRecord
{
    protected static string $resource = AssetItemResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Create Asset Item Successful';
    }

}
