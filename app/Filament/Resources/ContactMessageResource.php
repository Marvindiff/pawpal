<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactMessageResource\Pages;
use App\Filament\Resources\ContactMessageResource\RelationManagers;
use App\Models\ContactMessage;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Actions\DeleteAction;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ContactMessageResource extends Resource
{
    protected static ?string $model = ContactMessage::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
{
    return $table
        ->columns([
            TextColumn::make('id')
                ->sortable(),

            TextColumn::make('name')
                ->searchable()
                ->weight('bold'),

            TextColumn::make('email')
                ->searchable(),

            TextColumn::make('message')
                ->limit(40)
                ->tooltip(fn ($record) => $record->message),

            TextColumn::make('created_at')
                ->dateTime()
                ->since(),
        ])
        ->actions([
            ViewAction::make(),   // 👁 View popup
            DeleteAction::make() // 🗑 Delete
        ])
        ->defaultSort('created_at', 'desc');
}
    
    public static function getRelations(): array
    {
        return [
            //
        ];
    }
    public static function getModel(): string
{
    return \App\Models\ContactMessage::class;
}
public static function getEloquentQuery(): Builder
{
    return parent::getEloquentQuery();
}
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListContactMessages::route('/'),
            'create' => Pages\CreateContactMessage::route('/create'),
            'edit' => Pages\EditContactMessage::route('/{record}/edit'),
        ];
    }    
}
