<?php

namespace App\Filament\Resources;

use App\Models\Policy;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PolicyResource extends Resource
{
    protected static ?string $model = Policy::class;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Policy Details')
                    ->schema([
                        Forms\Components\TextInput::make('title')->required()->maxLength(255),
                        Forms\Components\TextInput::make('policy_type')->maxLength(100),
                        Forms\Components\Textarea::make('description'),
                    ]),

                Forms\Components\Section::make('Policy Information')
                    ->schema([
                        Forms\Components\DateInput::make('enactment_date'),
                        Forms\Components\TextInput::make('jurisdiction')->maxLength(255),
                        Forms\Components\Textarea::make('key_provisions'),
                    ]),

                Forms\Components\Section::make('Impact & Status')
                    ->schema([
                        Forms\Components\Textarea::make('environmental_impact'),
                        Forms\Components\TextInput::make('status')->maxLength(50),
                        Forms\Components\Textarea::make('effectiveness_metrics'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->searchable(),
                Tables\Columns\TextColumn::make('policy_type'),
                Tables\Columns\TextColumn::make('jurisdiction'),
                Tables\Columns\TextColumn::make('enactment_date')->date(),
                Tables\Columns\TextColumn::make('status'),
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
            'index' => \App\Filament\Resources\PolicyResource\Pages\ListPolicies::route('index'),
            'create' => \App\Filament\Resources\PolicyResource\Pages\CreatePolicy::route('create'),
            'edit' => \App\Filament\Resources\PolicyResource\Pages\EditPolicy::route('edit'),
        ];
    }
}
