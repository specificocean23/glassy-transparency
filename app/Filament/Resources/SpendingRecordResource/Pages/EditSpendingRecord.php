<?php

namespace App\Filament\Resources\SpendingRecordResource\Pages;

use App\Filament\Resources\SpendingRecordResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSpendingRecord extends EditRecord
{
    protected static string $resource = SpendingRecordResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
