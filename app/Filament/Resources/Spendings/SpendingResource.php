<?php

namespace App\Filament\Resources\Spendings;

use App\Filament\Resources\Spendings\Pages\CreateSpending;
use App\Filament\Resources\Spendings\Pages\EditSpending;
use App\Filament\Resources\Spendings\Pages\ListSpendings;
use App\Filament\Resources\Spendings\Schemas\SpendingForm;
use App\Filament\Resources\Spendings\Tables\SpendingsTable;
use App\Models\Spending;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class SpendingResource extends Resource
{
    protected static ?string $model = Spending::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return SpendingForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SpendingsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListSpendings::route('/'),
            'create' => CreateSpending::route('/create'),
            'edit' => EditSpending::route('/{record}/edit'),
        ];
    }
}
