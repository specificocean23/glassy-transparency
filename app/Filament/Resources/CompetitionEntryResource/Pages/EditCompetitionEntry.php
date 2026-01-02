<?php

namespace App\Filament\Resources\CompetitionEntryResource\Pages;

use App\Filament\Resources\CompetitionEntryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCompetitionEntry extends EditRecord
{
    protected static string $resource = CompetitionEntryResource::class;

    protected function getHeaderActions(): array
    {
        return [Actions\DeleteAction::make()];
    }
}
