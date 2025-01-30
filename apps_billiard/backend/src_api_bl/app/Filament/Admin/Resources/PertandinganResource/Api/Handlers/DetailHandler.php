<?php

namespace App\Filament\Admin\Resources\PertandinganResource\Api\Handlers;

use App\Filament\Admin\Resources\PertandinganResource;
use App\Filament\Admin\Resources\PertandinganResource\Api\Transformers\PertandinganTransformer;
use Illuminate\Http\Request;
use Rupadana\ApiService\Http\Handlers;
use Spatie\QueryBuilder\QueryBuilder;

class DetailHandler extends Handlers
{
    public static ?string $uri = '/{id}';

    public static ?string $resource = PertandinganResource::class;

    /**
     * Show Pertandingan
     *
     * @return PertandinganTransformer
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

        return new PertandinganTransformer($query);
    }
}
