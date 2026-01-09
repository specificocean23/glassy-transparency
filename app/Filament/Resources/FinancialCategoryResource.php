<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FinancialCategoryResource\Pages;
use App\Filament\Resources\FinancialCategoryResource\RelationManagers;
use App\Models\FinancialCategory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FinancialCategoryResource extends Resource
{
    protected static ?string $model = FinancialCategory::class;

    protected static ?string $navigationIcon = 'heroicon-o-currency-euro';
    
    protected static ?string $navigationGroup = 'Transparency';
    
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Basic Information')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn ($state, callable $set) => $set('slug', \Illuminate\Support\Str::slug($state))),
                        Forms\Components\TextInput::make('slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),
                        Forms\Components\Textarea::make('description')
                            ->maxLength(65535)
                            ->rows(3),
                        Forms\Components\TextInput::make('icon')
                            ->label('Icon (Emoji)')
                            ->maxLength(10)
                            ->placeholder('e.g., ⛽ 🏠 💨'),
                        Forms\Components\ColorPicker::make('color')
                            ->label('Chart Color')
                            ->required()
                            ->default('#3b82f6'),
                    ])->columns(2),
                    
                Forms\Components\Section::make('Classification')
                    ->schema([
                        Forms\Components\Toggle::make('is_environmental_positive')
                            ->label('Good for Environment')
                            ->helperText('e.g., Wind energy, Solar power'),
                        Forms\Components\Toggle::make('is_environmental_negative')
                            ->label('Bad for Environment')
                            ->helperText('e.g., Fossil fuels'),
                        Forms\Components\Toggle::make('is_new_housing')
                            ->label('New Housing Development'),
                        Forms\Components\Toggle::make('is_current_housing')
                            ->label('Current Housing Maintenance'),
                        Forms\Components\TextInput::make('sort_order')
                            ->numeric()
                            ->default(0)
                            ->helperText('Lower numbers appear first'),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('icon')
                    ->label('')
                    ->size('lg'),
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\ColorColumn::make('color')
                    ->label('Chart Color'),
                Tables\Columns\IconColumn::make('is_environmental_positive')
                    ->label('Env+')
                    ->boolean(),
                Tables\Columns\IconColumn::make('is_environmental_negative')
                    ->label('Env-')
                    ->boolean(),
                Tables\Columns\TextColumn::make('sort_order')
                    ->sortable(),
            ])
            ->defaultSort('sort_order')
            ->filters([
                Tables\Filters\TernaryFilter::make('is_environmental_positive')
                    ->label('Good for Environment'),
                Tables\Filters\TernaryFilter::make('is_environmental_negative')
                    ->label('Bad for Environment'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListFinancialCategories::route('/'),
            'create' => Pages\CreateFinancialCategory::route('/create'),
            'edit' => Pages\EditFinancialCategory::route('/{record}/edit'),
        ];
    }
}
