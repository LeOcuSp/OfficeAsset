<?php

namespace App\Filament\Resources\AssetAllocationResource\Pages;

use App\Filament\Resources\AssetAllocationResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateAssetAllocation extends CreateRecord
{
    protected static string $resource = AssetAllocationResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Create Asset Allocation Successful';
    }
}
