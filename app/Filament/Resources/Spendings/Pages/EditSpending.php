<?php

namespace App\Filament\Resources\Spendings\Pages;

use App\Filament\Resources\Spendings\SpendingResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditSpending extends EditRecord
{
    protected static string $resource = SpendingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
