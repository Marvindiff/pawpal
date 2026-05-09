<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookingResource\Pages;
use App\Models\Booking;
use Filament\Forms;
use Filament\Resources\Form as ResourceForm;
use Filament\Resources\Resource;
use Filament\Resources\Table as ResourceTable;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;

class BookingResource extends Resource
{
    protected static ?string $model = Booking::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar';

    public static function form(ResourceForm $form): ResourceForm
    {
        return $form->schema([
            Forms\Components\Select::make('owner_id')
                ->relationship('owner', 'name')
                ->required(),

            Forms\Components\Select::make('sitter_id')
                ->relationship('sitter', 'name')
                ->required(),

            Forms\Components\DateTimePicker::make('schedule')
                ->required(),

            Forms\Components\Select::make('status')
                ->options([
                    'pending' => 'Pending',
                    'confirmed' => 'Confirmed',
                    'completed' => 'Completed',
                    'cancelled' => 'Cancelled',
                ])
                ->required(),
        ]);
    }

    public static function table(ResourceTable $table): ResourceTable
{
    return $table
        ->columns([
            TextColumn::make('owner.name')
                ->label('Owner'),

            TextColumn::make('sitter.name')
                ->label('Sitter'),

            TextColumn::make('schedule')
                ->dateTime(),

            Tables\Columns\BadgeColumn::make('status')
                ->enum([
                    'pending' => 'Pending',
                    'confirmed' => 'Confirmed',
                    'completed' => 'Completed',
                    'cancelled' => 'Cancelled',
                ])
                ->colors([
                    'warning' => 'pending',
                    'primary' => 'confirmed',
                    'success' => 'completed',
                    'danger' => 'cancelled',
                ]),
        ])
        ->actions([
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
        ])
        ->bulkActions([
            Tables\Actions\DeleteBulkAction::make(),
        ]);
}
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBookings::route('/'),
            'create' => Pages\CreateBooking::route('/create'),
            'edit' => Pages\EditBooking::route('/{record}/edit'),
        ];
    }
}