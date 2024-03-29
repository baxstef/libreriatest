<?php

namespace App\Filament\User\Resources\LibroResource\Pages;

use App\Filament\User\Resources\LibroResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewLibro extends ViewRecord
{
    protected static string $resource = LibroResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
