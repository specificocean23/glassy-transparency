<?php

namespace App\Filament\Resources\SeaLevelProjectionResource\Pages;

use App\Filament\Resources\SeaLevelProjectionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSeaLevelProjection extends EditRecord
{
    protected static string $resource = SeaLevelProjectionResource::class;

    protected function getHeaderActions(): array
    {
        return [Actions\DeleteAction::make()];
    }
}
