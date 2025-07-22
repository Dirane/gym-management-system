<?php

namespace App\Filament\Resources\ProgressLogResource\Pages;

use App\Filament\Resources\ProgressLogResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProgressLogs extends ListRecords
{
    protected static string $resource = ProgressLogResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
