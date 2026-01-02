<?php

namespace App\Filament\Resources\EnvironmentalMetricResource\Pages;

use App\Filament\Resources\EnvironmentalMetricResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEnvironmentalMetric extends EditRecord
{
    protected static string $resource = EnvironmentalMetricResource::class;

    protected function getHeaderActions(): array
    {
        return [Actions\DeleteAction::make()];
    }
}
