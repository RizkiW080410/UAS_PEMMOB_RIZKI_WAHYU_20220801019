<?php

namespace App\Filament\Admin\Resources\PertandinganResource\Api\Handlers;

use App\Filament\Admin\Resources\PertandinganResource;
use App\Filament\Admin\Resources\PertandinganResource\Api\Requests\UpdatePertandinganRequest;
use Rupadana\ApiService\Http\Handlers;

class UpdateHandler extends Handlers
{
    public static ?string $uri = '/{id}';

    public static ?string $resource = PertandinganResource::class;

    public static function getMethod()
    {
        return Handlers::PUT;
    }

    public static function getModel()
    {
        return static::$resource::getModel();
    }

    /**
     * Update Pertandingan
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function handler(UpdatePertandinganRequest $request)
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
