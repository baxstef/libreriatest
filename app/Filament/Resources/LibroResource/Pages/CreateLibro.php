<?php

namespace App\Filament\Resources\LibroResource\Pages;

use App\Filament\Resources\LibroResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Forms\Form;
use Filament\Pages\Page;

class CreateLibro extends CreateRecord
{
    protected static string $resource = LibroResource::class;
    protected function saveRecord(Form $form): void
    {
        $form->record['user_id'] = auth()->id();

        parent::saveRecord($form);
    }
}
