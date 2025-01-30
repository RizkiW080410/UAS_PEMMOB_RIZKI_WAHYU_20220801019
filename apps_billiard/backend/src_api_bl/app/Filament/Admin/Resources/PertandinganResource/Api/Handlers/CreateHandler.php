<?php

namespace App\Filament\Admin\Resources\PertandinganResource\Api\Handlers;

use App\Filament\Admin\Resources\PertandinganResource;
use App\Filament\Admin\Resources\PertandinganResource\Api\Requests\CreatePertandinganRequest;
use Rupadana\ApiService\Http\Handlers;

class CreateHandler extends Handlers
{
    public static ?string $uri = '/';

    public static ?string $resource = PertandinganResource::class;

    public static function getMethod()
    {
        return Handlers::POST;
    }

    public static function getModel()
    {
        return static::$resource::getModel();
    }

    /**
     * Create Pertandingan
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function handler(CreatePertandinganRequest $request)
    {
        $model = new (static::getModel());

        $model->fill($request->all());

        $model->save();

        return static::sendSuccessResponse($model, 'Successfully Create Resource');
    }
}
