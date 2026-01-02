<?php

namespace App\Filament\Resources\ImpactComparisonResource\Pages;

use App\Filament\Resources\ImpactComparisonResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListImpactComparisons extends ListRecords
{
    protected static string $resource = ImpactComparisonResource::class;

    protected function getHeaderActions(): array
    {
        return [Actions\CreateAction::make()];
    }
}
