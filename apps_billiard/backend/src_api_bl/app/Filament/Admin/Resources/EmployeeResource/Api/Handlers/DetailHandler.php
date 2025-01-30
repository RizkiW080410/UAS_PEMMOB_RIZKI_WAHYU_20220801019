<?php

namespace App\Filament\Admin\Resources\EmployeeResource\Api\Handlers;

use App\Filament\Admin\Resources\EmployeeResource;
use App\Filament\Admin\Resources\EmployeeResource\Api\Transformers\EmployeeTransformer;
use Illuminate\Http\Request;
use Rupadana\ApiService\Http\Handlers;
use Spatie\QueryBuilder\QueryBuilder;

class DetailHandler extends Handlers
{
    public static ?string $uri = '/{id}';

    public static ?string $resource = EmployeeResource::class;

    /**
     * Show Employee
     *
     * @return EmployeeTransformer
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

        return new EmployeeTransformer($query);
    }
}
