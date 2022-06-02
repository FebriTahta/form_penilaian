<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penilaian extends Model
{
    use HasFactory;

    protected $fillable=[
        'karyawan_id','jenis_id','kategori_id','poin_id','tanggal','nilai','keterangan'
    ];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class);
    }

    public function jenis()
    {
        return $this->belongsTo(Jenis::class);
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function poin()
    {
        return $this->belongsTo(Poin::class);
    }
}
