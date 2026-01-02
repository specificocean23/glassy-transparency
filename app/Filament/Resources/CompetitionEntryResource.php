<?php

namespace App\Filament\Resources;

use App\Models\CompetitionEntry;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CompetitionEntryResource extends Resource
{
    protected static ?string $model = CompetitionEntry::class;
    protected static ?string $navigationLabel = 'Competition Entries';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Entry Details')
                    ->schema([
                        Forms\Components\TextInput::make('title')->required()->maxLength(255),
                        Forms\Components\TextInput::make('participant_name')->required()->maxLength(255),
                        Forms\Components\Textarea::make('description'),
                    ]),

                Forms\Components\Section::make('Competition Information')
                    ->schema([
                        Forms\Components\TextInput::make('competition_name')->maxLength(255),
                        Forms\Components\DateInput::make('submission_date'),
                        Forms\Components\TextInput::make('category')->maxLength(100),
                    ]),

                Forms\Components\Section::make('Evaluation & Status')
                    ->schema([
                        Forms\Components\TextInput::make('score')->numeric(),
                        Forms\Components\TextInput::make('status')->maxLength(50),
                        Forms\Components\Textarea::make('judges_feedback'),
                        Forms\Components\Textarea::make('innovation_highlights'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->searchable(),
                Tables\Columns\TextColumn::make('participant_name')->searchable(),
                Tables\Columns\TextColumn::make('competition_name'),
                Tables\Columns\TextColumn::make('category'),
                Tables\Columns\TextColumn::make('status'),
                Tables\Columns\TextColumn::make('score')->numeric(),
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
            'index' => \App\Filament\Resources\CompetitionEntryResource\Pages\ListCompetitionEntries::route('index'),
            'create' => \App\Filament\Resources\CompetitionEntryResource\Pages\CreateCompetitionEntry::route('create'),
            'edit' => \App\Filament\Resources\CompetitionEntryResource\Pages\EditCompetitionEntry::route('edit'),
        ];
    }
}
