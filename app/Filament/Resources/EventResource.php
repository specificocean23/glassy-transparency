<?php
namespace App\Filament\Resources;
use App\Models\Event;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class EventResource extends Resource
{
    protected static ?string $model = Event::class;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('title')->required(),
            Forms\Components\TextInput::make('event_type'),
            Forms\Components\Textarea::make('description'),
            Forms\Components\DateTimeInput::make('start_date'),
            Forms\Components\DateTimeInput::make('end_date'),
            Forms\Components\TextInput::make('location'),
            Forms\Components\TextInput::make('registration_url'),
            Forms\Components\TextInput::make('max_participants')->numeric(),
            Forms\Components\Select::make('status')->options(['upcoming' => 'Upcoming', 'live' => 'Live', 'completed' => 'Completed']),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('title')->searchable(),
            Tables\Columns\TextColumn::make('event_type')->badge(),
            Tables\Columns\TextColumn::make('start_date')->dateTime(),
            Tables\Columns\TextColumn::make('status')->badge(),
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
            'index' => \App\Filament\Resources\EventResource\Pages\ListEvents::route('index'),
            'create' => \App\Filament\Resources\EventResource\Pages\CreateEvent::route('create'),
            'edit' => \App\Filament\Resources\EventResource\Pages\EditEvent::route('edit'),
        ];
    }
}
