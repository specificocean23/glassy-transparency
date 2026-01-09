<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SpendingRecordResource\Pages;
use App\Filament\Resources\SpendingRecordResource\RelationManagers;
use App\Models\SpendingRecord;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SpendingRecordResource extends Resource
{
    protected static ?string $model = SpendingRecord::class;

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';
    
    protected static ?string $navigationGroup = 'Transparency';
    
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Spending Details')
                    ->schema([
                        Forms\Components\Select::make('county_id')
                            ->relationship('county', 'name')
                            ->required()
                            ->searchable()
                            ->preload()
                            ->label('County'),
                        Forms\Components\Select::make('financial_category_id')
                            ->relationship('financialCategory', 'name')
                            ->required()
                            ->searchable()
                            ->preload()
                            ->label('Financial Category'),
                        Forms\Components\TextInput::make('year')
                            ->required()
                            ->numeric()
                            ->minValue(2000)
                            ->maxValue(2100)
                            ->default(date('Y'))
                            ->helperText('The fiscal year for this spending'),
                        Forms\Components\TextInput::make('amount')
                            ->required()
                            ->numeric()
                            ->prefix('€')
                            ->helperText('Amount in euros (e.g., 1000000 for 1 million)')
                            ->step(0.01),
                        Forms\Components\Textarea::make('notes')
                            ->maxLength(65535)
                            ->rows(3)
                            ->helperText('Optional notes about this spending'),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('year')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('county.name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('financialCategory.name')
                    ->label('Category')
                    ->sortable()
                    ->searchable()
                    ->formatStateUsing(fn ($record) => $record->financialCategory->icon . ' ' . $record->financialCategory->name),
                Tables\Columns\TextColumn::make('amount')
                    ->money('EUR')
                    ->sortable()
                    ->summarize([
                        Tables\Columns\Summarizers\Sum::make()
                            ->money('EUR')
                            ->label('Total'),
                    ]),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('year', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('year')
                    ->options(fn () => \App\Models\SpendingRecord::distinct()->pluck('year', 'year')->sort()->reverse()->toArray()),
                Tables\Filters\SelectFilter::make('county_id')
                    ->relationship('county', 'name')
                    ->searchable()
                    ->preload()
                    ->label('County'),
                Tables\Filters\SelectFilter::make('financial_category_id')
                    ->relationship('financialCategory', 'name')
                    ->searchable()
                    ->preload()
                    ->label('Category'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListSpendingRecords::route('/'),
            'create' => Pages\CreateSpendingRecord::route('/create'),
            'edit' => Pages\EditSpendingRecord::route('/{record}/edit'),
        ];
    }
}
