<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;

    protected $fillable=[
        'nama_karyawan','telp_karyawan','slug_karyawan','tempatlahir_karyawan','tanggallahir_karyawan','alamat_karyawan','user_id','jabatan_id','jenkel'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class);
    }

    public function penilaian()
    {
        return $this->hasMany(Penilaian::class);
    }

    public function mengisi()
    {
        return $this->hasMany(Mengisi::class);
    }

    public function group()
    {
        return $this->belongsToMany(Karyawan::class);
    }
}
