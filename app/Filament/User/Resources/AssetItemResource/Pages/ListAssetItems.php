<?php

namespace App\Filament\User\Resources\AssetItemResource\Pages;

use App\Filament\User\Resources\AssetItemResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAssetItems extends ListRecords
{
    protected static string $resource = AssetItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
