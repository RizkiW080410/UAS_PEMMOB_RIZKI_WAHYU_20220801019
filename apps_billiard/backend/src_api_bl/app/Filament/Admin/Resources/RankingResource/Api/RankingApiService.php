<?php

namespace App\Filament\Admin\Resources\RankingResource\Api;

use App\Filament\Admin\Resources\RankingResource;
use Rupadana\ApiService\ApiService;

class RankingApiService extends ApiService
{
    protected static ?string $resource = RankingResource::class;

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
