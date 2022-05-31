<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;

    protected $fillable=[
        'nama_karyawan','telp_karyawan','slug_karyawan','tempatlahir_karyawan','tanggallahir_karyawan','alamat_karyawan','user_id','jabatan_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class);
    }
}
