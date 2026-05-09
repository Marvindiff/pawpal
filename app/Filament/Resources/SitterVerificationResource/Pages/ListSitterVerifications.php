<?php

namespace App\Filament\Resources\SitterVerificationResource\Pages;

use App\Filament\Resources\SitterVerificationResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSitterVerifications extends ListRecords
{
    protected static string $resource = SitterVerificationResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
