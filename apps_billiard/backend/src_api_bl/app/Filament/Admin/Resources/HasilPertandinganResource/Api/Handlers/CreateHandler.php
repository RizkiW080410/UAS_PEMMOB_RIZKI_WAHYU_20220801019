<?php

namespace App\Filament\Admin\Resources\HasilPertandinganResource\Api\Handlers;

use App\Filament\Admin\Resources\HasilPertandinganResource;
use App\Filament\Admin\Resources\HasilPertandinganResource\Api\Requests\CreateHasilPertandinganRequest;
use Rupadana\ApiService\Http\Handlers;

class CreateHandler extends Handlers
{
    public static ?string $uri = '/';

    public static ?string $resource = HasilPertandinganResource::class;

    public static function getMethod()
    {
        return Handlers::POST;
    }

    public static function getModel()
    {
        return static::$resource::getModel();
    }

    /**
     * Create HasilPertandingan
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function handler(CreateHasilPertandinganRequest $request)
    {
        $model = new (static::getModel());

        $model->fill($request->all());

        $model->save();

        return static::sendSuccessResponse($model, 'Successfully Create Resource');
    }
}
