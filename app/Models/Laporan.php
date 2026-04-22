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

    public function supports()
    {
        return $this->hasMany(Support::class);
    }

    public function supportingUsers()
    {
        return $this->belongsToMany(User::class, 'supports');
    }
}
