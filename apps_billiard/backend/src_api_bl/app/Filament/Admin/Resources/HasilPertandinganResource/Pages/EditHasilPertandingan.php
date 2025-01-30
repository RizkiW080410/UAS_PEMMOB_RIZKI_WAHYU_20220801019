<?php

namespace App\Filament\Admin\Resources\HasilPertandinganResource\Pages;

use App\Filament\Admin\Resources\HasilPertandinganResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditHasilPertandingan extends EditRecord
{
    protected static string $resource = HasilPertandinganResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
