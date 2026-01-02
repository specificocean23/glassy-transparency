<?php

namespace App\Filament\Resources;

use App\Models\ResearchPaper;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ResearchPaperResource extends Resource
{
    protected static ?string $model = ResearchPaper::class;
    protected static ?string $navigationLabel = 'Research Papers';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Paper Details')
                    ->schema([
                        Forms\Components\TextInput::make('title')->required()->maxLength(255),
                        Forms\Components\TextInput::make('authors')->maxLength(255),
                        Forms\Components\Textarea::make('abstract'),
                    ]),

                Forms\Components\Section::make('Publication Information')
                    ->schema([
                        Forms\Components\TextInput::make('journal')->maxLength(255),
                        Forms\Components\DateInput::make('publication_date'),
                        Forms\Components\TextInput::make('volume')->maxLength(50),
                        Forms\Components\TextInput::make('issue')->maxLength(50),
                        Forms\Components\TextInput::make('doi')->maxLength(255),
                    ]),

                Forms\Components\Section::make('Content & Links')
                    ->schema([
                        Forms\Components\Textarea::make('key_findings'),
                        Forms\Components\TextInput::make('url')->maxLength(255),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->searchable(),
                Tables\Columns\TextColumn::make('authors')->searchable(),
                Tables\Columns\TextColumn::make('journal'),
                Tables\Columns\TextColumn::make('publication_date')->date(),
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
            'index' => \App\Filament\Resources\ResearchPaperResource\Pages\ListResearchPapers::route('index'),
            'create' => \App\Filament\Resources\ResearchPaperResource\Pages\CreateResearchPaper::route('create'),
            'edit' => \App\Filament\Resources\ResearchPaperResource\Pages\EditResearchPaper::route('edit'),
        ];
    }
}
