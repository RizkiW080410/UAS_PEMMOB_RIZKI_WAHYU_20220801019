<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HasilPertandingan extends Model
{
    protected $fillable = ['client_id', 'pertandingan_id', 'status'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function pertandingan()
    {
        return $this->belongsTo(Pertandingan::class);
    }
}
