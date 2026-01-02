<?php

namespace App\Filament\Resources\EnvironmentalMetricResource\Pages;

use App\Filament\Resources\EnvironmentalMetricResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEnvironmentalMetrics extends ListRecords
{
    protected static string $resource = EnvironmentalMetricResource::class;

    protected function getHeaderActions(): array
    {
        return [Actions\CreateAction::make()];
    }
}
