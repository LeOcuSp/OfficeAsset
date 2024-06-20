<?php

namespace App\Filament\Resources\AssetDonorResource\Pages;

use App\Filament\Resources\AssetDonorResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAssetDonors extends ListRecords
{
    protected static string $resource = AssetDonorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
