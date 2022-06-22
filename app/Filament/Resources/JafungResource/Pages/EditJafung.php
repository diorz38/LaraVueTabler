<?php

namespace App\Filament\Resources\JafungResource\Pages;

use App\Filament\Resources\JafungResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditJafung extends EditRecord
{
    protected static string $resource = JafungResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
