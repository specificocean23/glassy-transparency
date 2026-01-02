<?php

namespace App\Filament\Resources;

use App\Models\AdvocacyCampaign;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class AdvocacyCampaignResource extends Resource
{
    protected static ?string $model = AdvocacyCampaign::class;
    protected static ?string $navigationLabel = 'Advocacy Campaigns';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Campaign Details')
                    ->schema([
                        Forms\Components\TextInput::make('name')->required()->maxLength(255),
                        Forms\Components\TextInput::make('organization')->maxLength(255),
                        Forms\Components\Textarea::make('description'),
                    ]),

                Forms\Components\Section::make('Campaign Information')
                    ->schema([
                        Forms\Components\DateInput::make('start_date'),
                        Forms\Components\DateInput::make('end_date'),
                        Forms\Components\TextInput::make('target_audience')->maxLength(255),
                        Forms\Components\Textarea::make('goals'),
                    ]),

                Forms\Components\Section::make('Impact')
                    ->schema([
                        Forms\Components\Textarea::make('outcomes'),
                        Forms\Components\TextInput::make('engagement_metrics')->maxLength(255),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable(),
                Tables\Columns\TextColumn::make('organization'),
                Tables\Columns\TextColumn::make('start_date')->date(),
                Tables\Columns\TextColumn::make('end_date')->date(),
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
            'index' => \App\Filament\Resources\AdvocacyCampaignResource\Pages\ListAdvocacyCampaigns::route('index'),
            'create' => \App\Filament\Resources\AdvocacyCampaignResource\Pages\CreateAdvocacyCampaign::route('create'),
            'edit' => \App\Filament\Resources\AdvocacyCampaignResource\Pages\EditAdvocacyCampaign::route('edit'),
        ];
    }
}
