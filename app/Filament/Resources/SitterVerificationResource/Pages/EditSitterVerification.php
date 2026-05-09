<?php

namespace App\Filament\Resources\SitterVerificationResource\Pages;

use App\Filament\Resources\SitterVerificationResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSitterVerification extends EditRecord
{
    protected static string $resource = SitterVerificationResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
