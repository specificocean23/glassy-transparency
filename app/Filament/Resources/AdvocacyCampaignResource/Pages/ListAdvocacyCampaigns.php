<?php

namespace App\Filament\Resources\AdvocacyCampaignResource\Pages;

use App\Filament\Resources\AdvocacyCampaignResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAdvocacyCampaigns extends ListRecords
{
    protected static string $resource = AdvocacyCampaignResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
