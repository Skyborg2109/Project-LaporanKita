<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    protected $fillable = [
        'user_id',
        'judul',
        'kategori',
        'deskripsi',
        'lokasi',
        'foto',
        'status',
    ];

    protected $casts = [
        'foto' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
