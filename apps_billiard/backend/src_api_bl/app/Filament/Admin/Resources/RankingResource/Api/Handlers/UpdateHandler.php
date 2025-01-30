<?php

namespace App\Filament\Admin\Resources\RankingResource\Api\Handlers;

use App\Filament\Admin\Resources\RankingResource;
use App\Filament\Admin\Resources\RankingResource\Api\Requests\UpdateRankingRequest;
use Rupadana\ApiService\Http\Handlers;

class UpdateHandler extends Handlers
{
    public static ?string $uri = '/{id}';

    public static ?string $resource = RankingResource::class;

    public static function getMethod()
    {
        return Handlers::PUT;
    }

    public static function getModel()
    {
        return static::$resource::getModel();
    }

    /**
     * Update Ranking
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function handler(UpdateRankingRequest $request)
    {
        $id = $request->route('id');

        $model = static::getModel()::find($id);

        if (! $model) {
            return static::sendNotFoundResponse();
        }

        $model->fill($request->all());

        $model->save();

        return static::sendSuccessResponse($model, 'Successfully Update Resource');
    }
}
