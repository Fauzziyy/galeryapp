<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{
    protected $fillable = [
        'judul',
        'deskripsi',
        'foto',
        'status',
        'album_id',
        'users_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'users_id');
    }

    public function likes()
    {
        return $this->hasMany(LikeFoto::class, 'fotos_id');
    }
}
