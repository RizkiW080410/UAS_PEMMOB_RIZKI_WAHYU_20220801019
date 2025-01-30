<?php

namespace App\Filament\Admin\Resources\HasilPertandinganResource\Pages;

use App\Filament\Admin\Resources\HasilPertandinganResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListHasilPertandingans extends ListRecords
{
    protected static string $resource = HasilPertandinganResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
