<?php

namespace App\Filament\Admin\Resources\RankingResource\Pages;

use App\Filament\Admin\Resources\RankingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRanking extends EditRecord
{
    protected static string $resource = RankingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
