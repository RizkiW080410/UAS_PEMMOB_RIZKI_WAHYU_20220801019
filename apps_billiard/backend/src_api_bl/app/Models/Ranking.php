<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ranking extends Model
{
    protected $fillable = ['client_id'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function getTotalPertandinganAttribute()
    {
        return $this->client->hasilpertandingans->count();
    }

    public function getWinAttribute()
    {
        return $this->client->hasilpertandingans->where('status', 'Menang')->count();
    }

    public function getLoseAttribute()
    {
        return $this->client->hasilpertandingans->where('status', 'Kalah')->count();
    }

    public function getRankAttribute()
    {
        // Hitung semua klien berdasarkan jumlah kemenangan - kekalahan
        $rankedClients = self::all()
            ->map(function ($ranking) {
                return [
                    'client_id' => $ranking->client_id,
                    'score' => $ranking->win - $ranking->lose,
                ];
            })
            ->sortByDesc('score') // Urutkan berdasarkan skor tertinggi
            ->values();

        // Temukan posisi klien ini dalam daftar peringkat
        $position = $rankedClients->search(function ($client) {
            return $client['client_id'] === $this->client_id;
        });

        // Jika tidak masuk 10 besar, ranking adalah 0
        return ($position !== false && $position < 10) ? $position + 1 : 0;
    }
}
