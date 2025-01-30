<?php

namespace App\Filament\Admin\Resources\PertandinganResource\Api;

use App\Filament\Admin\Resources\PertandinganResource;
use Rupadana\ApiService\ApiService;

class PertandinganApiService extends ApiService
{
    protected static ?string $resource = PertandinganResource::class;

    public static function handlers(): array
    {
        return [
            Handlers\CreateHandler::class,
            Handlers\UpdateHandler::class,
            Handlers\DeleteHandler::class,
            Handlers\PaginationHandler::class,
            Handlers\DetailHandler::class,
        ];

    }
}
