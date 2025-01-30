<?php

namespace App\Filament\Admin\Resources\PertandinganResource\Pages;

use App\Filament\Admin\Resources\PertandinganResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPertandingan extends EditRecord
{
    protected static string $resource = PertandinganResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
