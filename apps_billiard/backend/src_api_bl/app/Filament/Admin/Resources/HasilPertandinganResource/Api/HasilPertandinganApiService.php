<?php

namespace App\Filament\Admin\Resources\HasilPertandinganResource\Api;

use App\Filament\Admin\Resources\HasilPertandinganResource;
use Rupadana\ApiService\ApiService;

class HasilPertandinganApiService extends ApiService
{
    protected static ?string $resource = HasilPertandinganResource::class;

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
