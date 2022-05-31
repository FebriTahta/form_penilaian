<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $fillable=[
        'jenis_id','nama_kategori','slug_kategori'
    ];

    public function jenis()
    {
        return $this->belongsTo(Jenis::class);
    }

    public function poin()
    {
        return $this->hasMany(Poin::class);
    }
}
