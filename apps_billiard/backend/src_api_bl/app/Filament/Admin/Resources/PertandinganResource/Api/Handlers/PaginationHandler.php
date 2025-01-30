<?php

namespace App\Filament\Admin\Resources\PertandinganResource\Api\Handlers;

use App\Filament\Admin\Resources\PertandinganResource;
use App\Filament\Admin\Resources\PertandinganResource\Api\Transformers\PertandinganTransformer;
use Illuminate\Http\Request;
use Rupadana\ApiService\Http\Handlers;
use Spatie\QueryBuilder\QueryBuilder;

class PaginationHandler extends Handlers
{
    public static ?string $uri = '/';

    public static ?string $resource = PertandinganResource::class;

    /**
     * List of Pertandingan
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function handler()
    {
        $query = static::getEloquentQuery();

        $query = QueryBuilder::for($query)
            ->with(['clientA', 'clientB'])
            ->allowedFields($this->getAllowedFields() ?? [])
            ->allowedSorts($this->getAllowedSorts() ?? [])
            ->allowedFilters($this->getAllowedFilters() ?? [])
            ->allowedIncludes($this->getAllowedIncludes() ?? [])
            ->paginate(request()->query('per_page'))
            ->appends(request()->query());

        return PertandinganTransformer::collection($query);
    }
}
