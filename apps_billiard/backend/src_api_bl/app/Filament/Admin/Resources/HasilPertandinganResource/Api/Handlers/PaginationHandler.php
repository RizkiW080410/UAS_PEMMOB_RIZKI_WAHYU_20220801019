<?php

namespace App\Filament\Admin\Resources\HasilPertandinganResource\Api\Handlers;

use App\Filament\Admin\Resources\HasilPertandinganResource;
use App\Filament\Admin\Resources\HasilPertandinganResource\Api\Transformers\HasilPertandinganTransformer;
use Illuminate\Http\Request;
use Rupadana\ApiService\Http\Handlers;
use Spatie\QueryBuilder\QueryBuilder;

class PaginationHandler extends Handlers
{
    public static ?string $uri = '/';

    public static ?string $resource = HasilPertandinganResource::class;

    /**
     * List of HasilPertandingan
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function handler()
    {
        $query = static::getEloquentQuery();

        $query = QueryBuilder::for($query)
            ->with(['client', 'pertandingan'])
            ->allowedFields($this->getAllowedFields() ?? [])
            ->allowedSorts($this->getAllowedSorts() ?? [])
            ->allowedFilters($this->getAllowedFilters() ?? [])
            ->allowedIncludes($this->getAllowedIncludes() ?? [])
            ->paginate(request()->query('per_page'))
            ->appends(request()->query());

        return HasilPertandinganTransformer::collection($query);
    }
}
