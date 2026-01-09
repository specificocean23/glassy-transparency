<?php

namespace App\Filament\Resources\CouncilAllowanceResource\Pages;

use App\Filament\Resources\CouncilAllowanceResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCouncilAllowance extends EditRecord
{
    protected static string $resource = CouncilAllowanceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
