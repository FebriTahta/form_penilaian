<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detailsurveylembaga extends Model
{
    use HasFactory;
    protected $connection = 'mysql2';

    protected $fillable=[
        'surveylembaga_id',
        'nama_santri',
        'tempatlahir_santri',
        'tanggallahir_santri',
        'nama_ayah',
        'nama_ibu',
        'hp_ayah',
        'hp_ibu',
    ];
    public function kabupaten()
    {
        return $this->belongsTo(Kabupaten::class);
    }
}
