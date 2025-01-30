<?php

namespace App\Filament\Admin\Resources\RankingResource\Api\Handlers;

use App\Filament\Admin\Resources\RankingResource;
use App\Filament\Admin\Resources\RankingResource\Api\Transformers\RankingTransformer;
use Illuminate\Http\Request;
use Rupadana\ApiService\Http\Handlers;
use Spatie\QueryBuilder\QueryBuilder;

class PaginationHandler extends Handlers
{
    public static ?string $uri = '/';

    public static ?string $resource = RankingResource::class;

    /**
     * List of Ranking
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function handler()
    {
        $query = static::getEloquentQuery();

        $query = QueryBuilder::for($query)
            ->with(['client', 'client.hasilpertandingans'])
            ->allowedFields($this->getAllowedFields() ?? [])
            ->allowedSorts($this->getAllowedSorts() ?? [])
            ->allowedFilters($this->getAllowedFilters() ?? [])
            ->allowedIncludes($this->getAllowedIncludes() ?? [])
            ->paginate(request()->query('per_page'))
            ->appends(request()->query());

        return RankingTransformer::collection($query);
    }
}
