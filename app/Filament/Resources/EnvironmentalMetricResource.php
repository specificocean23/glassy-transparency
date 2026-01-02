<?php

namespace App\Filament\Resources;

use App\Models\EnvironmentalMetric;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class EnvironmentalMetricResource extends Resource
{
    protected static ?string $model = EnvironmentalMetric::class;
    protected static ?string $navigationLabel = 'Environmental Metrics';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Metric Details')
                    ->schema([
                        Forms\Components\TextInput::make('name')->required()->maxLength(255),
                        Forms\Components\TextInput::make('category')->maxLength(255),
                        Forms\Components\Textarea::make('description'),
                    ]),

                Forms\Components\Section::make('Measurement')
                    ->schema([
                        Forms\Components\TextInput::make('value')->numeric(),
                        Forms\Components\TextInput::make('unit')->maxLength(50),
                        Forms\Components\DateInput::make('measurement_date'),
                        Forms\Components\TextInput::make('location')->maxLength(255),
                    ]),

                Forms\Components\Section::make('Analysis')
                    ->schema([
                        Forms\Components\Textarea::make('trend_analysis'),
                        Forms\Components\Textarea::make('implications'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable(),
                Tables\Columns\TextColumn::make('category'),
                Tables\Columns\TextColumn::make('value')->numeric(),
                Tables\Columns\TextColumn::make('unit'),
                Tables\Columns\TextColumn::make('measurement_date')->date(),
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
            'index' => \App\Filament\Resources\EnvironmentalMetricResource\Pages\ListEnvironmentalMetrics::route('index'),
            'create' => \App\Filament\Resources\EnvironmentalMetricResource\Pages\CreateEnvironmentalMetric::route('create'),
            'edit' => \App\Filament\Resources\EnvironmentalMetricResource\Pages\EditEnvironmentalMetric::route('edit'),
        ];
    }
}
