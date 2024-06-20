<?php

namespace App\Filament\Resources\AssetAllocationResource\Pages;

use App\Filament\Resources\AssetAllocationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAssetAllocations extends ListRecords
{
    protected static string $resource = AssetAllocationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
