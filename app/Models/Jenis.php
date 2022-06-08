<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jenis extends Model
{
    use HasFactory;

    protected $fillable=[
        'nama_jenis','slug_jenis','img_jenis','img_thumbnail_jenis'
    ];

    public function kategori()
    {
        return $this->hasMany(Kategori::class);
    }

    public function group()
    {
        return $this->hasMany(Group::class,'id');
    }

    public function mengisi()
    {
        return $this->hasMany(Mengisi::class,'id');
    }

    public function penilaian()
    {
        return $this->hasMany(Penilaian::class,'id');
    }

    // public function getImgJenisAttribute($value)
    // {
    //     return asset('img_jenis/'.$value);
    // }

    // public function getImgThumbnailJenisAttribute($value)
    // {
    //     return asset('img_thumbnail_jenis/'.$value);
    // }
}
