<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CouncilAllowanceResource\Pages;
use App\Filament\Resources\CouncilAllowanceResource\RelationManagers;
use App\Models\CouncilAllowance;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CouncilAllowanceResource extends Resource
{
    protected static ?string $model = CouncilAllowance::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-library';
    
    protected static ?string $navigationGroup = 'Transparency';
    
    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Council Allowance Details')
                    ->schema([
                        Forms\Components\TextInput::make('county')
                            ->required()
                            ->maxLength(255)
                            ->default('Waterford')
                            ->helperText('County name (e.g., Waterford, Cork)'),
                        Forms\Components\TextInput::make('year')
                            ->required()
                            ->numeric()
                            ->minValue(2000)
                            ->maxValue(2100)
                            ->default(date('Y'))
                            ->helperText('The fiscal year for this allowance'),
                        Forms\Components\TextInput::make('amount')
                            ->required()
                            ->numeric()
                            ->prefix('€')
                            ->step(1000)
                            ->helperText('Annual allowance amount in euros'),
                        Forms\Components\Textarea::make('notes')
                            ->maxLength(65535)
                            ->rows(3)
                            ->helperText('Optional notes about this allowance')
                            ->columnSpanFull(),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('county')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('year')
                    ->numeric()
                    ->sortable(),
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
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('year', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('county')
                    ->options(fn () => \App\Models\CouncilAllowance::distinct()->pluck('county', 'county')->toArray()),
                Tables\Filters\SelectFilter::make('year')
                    ->options(fn () => \App\Models\CouncilAllowance::distinct()->pluck('year', 'year')->sort()->reverse()->toArray()),
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
            'index' => Pages\ListCouncilAllowances::route('/'),
            'create' => Pages\CreateCouncilAllowance::route('/create'),
            'edit' => Pages\EditCouncilAllowance::route('/{record}/edit'),
        ];
    }
}
