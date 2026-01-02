<?php

namespace App\Filament\Resources;

use App\Models\SeaLevelProjection;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class SeaLevelProjectionResource extends Resource
{
    protected static ?string $model = SeaLevelProjection::class;
    protected static ?string $navigationLabel = 'Sea Level Projections';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Projection Details')
                    ->schema([
                        Forms\Components\TextInput::make('region')->required()->maxLength(255),
                        Forms\Components\Textarea::make('description'),
                    ]),

                Forms\Components\Section::make('Projection Data')
                    ->schema([
                        Forms\Components\TextInput::make('year')->numeric(),
                        Forms\Components\TextInput::make('projected_rise_mm')->numeric(),
                        Forms\Components\TextInput::make('confidence_level')->maxLength(50),
                    ]),

                Forms\Components\Section::make('Sources & Impact')
                    ->schema([
                        Forms\Components\Textarea::make('data_sources'),
                        Forms\Components\Textarea::make('potential_impacts'),
                        Forms\Components\Textarea::make('mitigation_strategies'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('region')->searchable(),
                Tables\Columns\TextColumn::make('year')->numeric(),
                Tables\Columns\TextColumn::make('projected_rise_mm')->numeric(),
                Tables\Columns\TextColumn::make('confidence_level'),
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
            'index' => \App\Filament\Resources\SeaLevelProjectionResource\Pages\ListSeaLevelProjections::route('index'),
            'create' => \App\Filament\Resources\SeaLevelProjectionResource\Pages\CreateSeaLevelProjection::route('create'),
            'edit' => \App\Filament\Resources\SeaLevelProjectionResource\Pages\EditSeaLevelProjection::route('edit'),
        ];
    }
}
