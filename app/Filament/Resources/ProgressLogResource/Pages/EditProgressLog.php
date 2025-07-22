<?php

namespace App\Filament\Resources\ProgressLogResource\Pages;

use App\Filament\Resources\ProgressLogResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProgressLog extends EditRecord
{
    protected static string $resource = ProgressLogResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
