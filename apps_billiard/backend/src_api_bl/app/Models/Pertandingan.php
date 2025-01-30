<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pertandingan extends Model
{
    protected $fillable = ['pertandingan_number','image', 'client_a_id', 'client_b_id', 'category', 'start_time', 'skor_a', 'skor_b', 'status'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $lastId = static::max('id');
            $model->pertandingan_number = 'P-'.str_pad($lastId + 1, 5, '0', STR_PAD_LEFT);
        });
    }

    public function clientA()
    {
        return $this->belongsTo(Client::class, 'client_a_id');
    }

    public function clientB()
    {
        return $this->belongsTo(Client::class, 'client_b_id');
    }
}
