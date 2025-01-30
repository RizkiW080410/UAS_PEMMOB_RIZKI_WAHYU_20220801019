<?php

namespace App\Filament\Admin\Resources\RankingResource\Api\Handlers;

use App\Filament\Admin\Resources\RankingResource;
use App\Filament\Admin\Resources\RankingResource\Api\Requests\CreateRankingRequest;
use Rupadana\ApiService\Http\Handlers;

class CreateHandler extends Handlers
{
    public static ?string $uri = '/';

    public static ?string $resource = RankingResource::class;

    public static function getMethod()
    {
        return Handlers::POST;
    }

    public static function getModel()
    {
        return static::$resource::getModel();
    }

    /**
     * Create Ranking
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function handler(CreateRankingRequest $request)
    {
        $model = new (static::getModel());

        $model->fill($request->all());

        $model->save();

        return static::sendSuccessResponse($model, 'Successfully Create Resource');
    }
}
