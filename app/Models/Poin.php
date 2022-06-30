<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poin extends Model
{
    use HasFactory;

    protected $fillable=[
        'kategori_id','nama_poin','slug_poin','besar_poin'
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function penilaian()
    {
        return $this->hasMany(Penilaian::class);
    }
}
