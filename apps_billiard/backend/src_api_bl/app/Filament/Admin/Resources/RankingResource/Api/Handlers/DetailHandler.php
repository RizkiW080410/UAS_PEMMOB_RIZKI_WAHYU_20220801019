<?php

namespace App\Filament\Admin\Resources\RankingResource\Api\Handlers;

use App\Filament\Admin\Resources\RankingResource;
use App\Filament\Admin\Resources\RankingResource\Api\Transformers\RankingTransformer;
use Illuminate\Http\Request;
use Rupadana\ApiService\Http\Handlers;
use Spatie\QueryBuilder\QueryBuilder;

class DetailHandler extends Handlers
{
    public static ?string $uri = '/{id}';

    public static ?string $resource = RankingResource::class;

    /**
     * Show Ranking
     *
     * @return RankingTransformer
     */
    public function handler(Request $request)
    {
        $id = $request->route('id');

        $query = static::getEloquentQuery();

        $query = QueryBuilder::for(
            $query->where(static::getKeyName(), $id)
        )
            ->first();

        if (! $query) {
            return static::sendNotFoundResponse();
        }

        return new RankingTransformer($query);
    }
}
