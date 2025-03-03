<?php

namespace App\Filament\Resources\StudyfieldResource\Pages;

use App\Filament\Resources\StudyfieldResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditStudyfield extends EditRecord
{
    protected static string $resource = StudyfieldResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
