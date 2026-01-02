<?php

namespace App\Filament\Resources\ImpactComparisonResource\Pages;

use App\Filament\Resources\ImpactComparisonResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditImpactComparison extends EditRecord
{
    protected static string $resource = ImpactComparisonResource::class;

    protected function getHeaderActions(): array
    {
        return [Actions\DeleteAction::make()];
    }
}
