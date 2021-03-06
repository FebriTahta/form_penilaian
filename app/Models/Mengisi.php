<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mengisi extends Model
{
    use HasFactory;
    protected $fillable=[
        'karyawan_id','jenis_id','tanggal','keterangan','total'
    ];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class);
    }

    public function jenis()
    {
        return $this->belongsTo(Jenis::class);
    }
}
