<?php

namespace App\Filament\Resources;

use App\Models\Technology;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class TechnologyResource extends Resource
{
    protected static ?string $model = Technology::class;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Basic Information')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        
                        Forms\Components\TextInput::make('category')
                            ->required(),
                    ]),

                Forms\Components\Section::make('Technical Specs')
                    ->schema([
                        Forms\Components\TextInput::make('cost_per_kwh')->numeric(),
                        Forms\Components\TextInput::make('lifespan_years')->numeric(),
                        Forms\Components\TextInput::make('efficiency_percent')->numeric(),
                    ]),

                Forms\Components\Section::make('Details')
                    ->schema([
                        Forms\Components\Textarea::make('description'),
                        Forms\Components\Textarea::make('irish_applications'),
                        Forms\Components\Textarea::make('advantages'),
                        Forms\Components\Textarea::make('disadvantages'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable(),
                Tables\Columns\TextColumn::make('category')->badge(),
                Tables\Columns\TextColumn::make('efficiency_percent'),
                Tables\Columns\TextColumn::make('cost_per_kwh')->money('EUR'),
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
            'index' => \App\Filament\Resources\TechnologyResource\Pages\ListTechnologies::route('index'),
            'create' => \App\Filament\Resources\TechnologyResource\Pages\CreateTechnology::route('create'),
            'edit' => \App\Filament\Resources\TechnologyResource\Pages\EditTechnology::route('edit'),
        ];
    }
}
