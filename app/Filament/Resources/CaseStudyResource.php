<?php
namespace App\Filament\Resources;
use App\Models\CaseStudy;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CaseStudyResource extends Resource
{
    protected static ?string $model = CaseStudy::class;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('title')->required(),
            Forms\Components\TextInput::make('category'),
            Forms\Components\Textarea::make('summary'),
            Forms\Components\Textarea::make('full_content'),
            Forms\Components\TextInput::make('location'),
            Forms\Components\TextInput::make('jobs_created')->numeric(),
            Forms\Components\TextInput::make('investment_amount')->numeric(),
            Forms\Components\TextInput::make('co2_reduced')->numeric(),
            Forms\Components\DateInput::make('published_at'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('title')->searchable(),
            Tables\Columns\TextColumn::make('category'),
            Tables\Columns\TextColumn::make('jobs_created'),
            Tables\Columns\TextColumn::make('published_at')->date(),
        ])->actions([
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
        ])->bulkActions([
            Tables\Actions\DeleteBulkAction::make(),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => \App\Filament\Resources\CaseStudyResource\Pages\ListCaseStudies::route('index'),
            'create' => \App\Filament\Resources\CaseStudyResource\Pages\CreateCaseStudy::route('create'),
            'edit' => \App\Filament\Resources\CaseStudyResource\Pages\EditCaseStudy::route('edit'),
        ];
    }
}
