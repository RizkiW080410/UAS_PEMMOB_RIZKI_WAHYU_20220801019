<?php

namespace App\Filament\Admin\Resources\HasilPertandinganResource\Api\Transformers;

use App\Models\HasilPertandingan;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property HasilPertandingan $resource
 */
class HasilPertandinganTransformer extends JsonResource
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
