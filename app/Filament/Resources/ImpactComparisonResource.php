<?php

namespace App\Filament\Resources;

use App\Models\ImpactComparison;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ImpactComparisonResource extends Resource
{
    protected static ?string $model = ImpactComparison::class;
    protected static ?string $navigationLabel = 'Impact Comparisons';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Comparison Details')
                    ->schema([
                        Forms\Components\TextInput::make('name')->required()->maxLength(255),
                        Forms\Components\Textarea::make('description'),
                    ]),

                Forms\Components\Section::make('Items Being Compared')
                    ->schema([
                        Forms\Components\TextInput::make('item_1')->required()->maxLength(255),
                        Forms\Components\TextInput::make('item_2')->required()->maxLength(255),
                    ]),

                Forms\Components\Section::make('Impact Analysis')
                    ->schema([
                        Forms\Components\Textarea::make('environmental_impact_1'),
                        Forms\Components\Textarea::make('environmental_impact_2'),
                        Forms\Components\Textarea::make('economic_comparison'),
                        Forms\Components\Textarea::make('conclusion'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable(),
                Tables\Columns\TextColumn::make('item_1'),
                Tables\Columns\TextColumn::make('item_2'),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => \App\Filament\Resources\ImpactComparisonResource\Pages\ListImpactComparisons::route('index'),
            'create' => \App\Filament\Resources\ImpactComparisonResource\Pages\CreateImpactComparison::route('create'),
            'edit' => \App\Filament\Resources\ImpactComparisonResource\Pages\EditImpactComparison::route('edit'),
        ];
    }
}
