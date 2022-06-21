<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kabupaten extends Model
{
    use HasFactory;
    protected $connection = 'mysql2';
    protected $table = 'kabupaten';

   

    public function kecamatan()
    {
        return $this->hasMany(Kecamatan::class);
    }

    public function detailsurveylembaga()
    {
        return $this->hasMany(Detailsurveylembaga::class);
    }

    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class);
    }
}
