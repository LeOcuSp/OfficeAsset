<?php

namespace App\Filament\Resources\AssetDamageResource\Pages;

use App\Filament\Resources\AssetDamageResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateAssetDamage extends CreateRecord
{
    protected static string $resource = AssetDamageResource::class;

    protected function getRedirectUrl(): string
{
    return $this->getResource()::getUrl('index');
}
protected function getCreatedNotificationTitle(): ?string
{
    return 'Create Damage Item Successful';
}

}
