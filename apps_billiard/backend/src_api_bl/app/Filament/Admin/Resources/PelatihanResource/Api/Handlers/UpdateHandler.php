<?php

namespace App\Filament\Admin\Resources\PelatihanResource\Api\Handlers;

use App\Filament\Admin\Resources\PelatihanResource;
use App\Filament\Admin\Resources\PelatihanResource\Api\Requests\UpdatePelatihanRequest;
use Rupadana\ApiService\Http\Handlers;

class UpdateHandler extends Handlers
{
    public static ?string $uri = '/{id}';

    public static ?string $resource = PelatihanResource::class;

    public static function getMethod()
    {
        return Handlers::PUT;
    }

    public static function getModel()
    {
        return static::$resource::getModel();
    }

    /**
     * Update Pelatihan
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function handler(UpdatePelatihanRequest $request)
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
