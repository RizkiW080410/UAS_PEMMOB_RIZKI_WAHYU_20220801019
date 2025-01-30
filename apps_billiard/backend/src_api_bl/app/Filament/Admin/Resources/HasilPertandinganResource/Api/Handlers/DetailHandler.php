<?php

namespace App\Filament\Admin\Resources\HasilPertandinganResource\Api\Handlers;

use App\Filament\Admin\Resources\HasilPertandinganResource;
use App\Filament\Admin\Resources\HasilPertandinganResource\Api\Transformers\HasilPertandinganTransformer;
use Illuminate\Http\Request;
use Rupadana\ApiService\Http\Handlers;
use Spatie\QueryBuilder\QueryBuilder;

class DetailHandler extends Handlers
{
    public static ?string $uri = '/{id}';

    public static ?string $resource = HasilPertandinganResource::class;

    /**
     * Show HasilPertandingan
     *
     * @return HasilPertandinganTransformer
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

        return new HasilPertandinganTransformer($query);
    }
}
