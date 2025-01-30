<?php

namespace App\Filament\Admin\Resources\PertandinganResource\Api\Transformers;

use App\Models\Pertandingan;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property Pertandingan $resource
 */
class PertandinganTransformer extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->resource->toArray();
    }
}
