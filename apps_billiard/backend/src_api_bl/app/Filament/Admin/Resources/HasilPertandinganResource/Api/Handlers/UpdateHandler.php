<?php

namespace App\Filament\Admin\Resources\HasilPertandinganResource\Api\Handlers;

use App\Filament\Admin\Resources\HasilPertandinganResource;
use App\Filament\Admin\Resources\HasilPertandinganResource\Api\Requests\UpdateHasilPertandinganRequest;
use Rupadana\ApiService\Http\Handlers;

class UpdateHandler extends Handlers
{
    public static ?string $uri = '/{id}';

    public static ?string $resource = HasilPertandinganResource::class;

    public static function getMethod()
    {
        return Handlers::PUT;
    }

    public static function getModel()
    {
        return static::$resource::getModel();
    }

    /**
     * Update HasilPertandingan
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function handler(UpdateHasilPertandinganRequest $request)
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
