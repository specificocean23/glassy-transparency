<?php

namespace App\Filament\Resources\SeaLevelProjectionResource\Pages;

use App\Filament\Resources\SeaLevelProjectionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSeaLevelProjections extends ListRecords
{
    protected static string $resource = SeaLevelProjectionResource::class;

    protected function getHeaderActions(): array
    {
        return [Actions\CreateAction::make()];
    }
}
