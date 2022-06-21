<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Surveylembaga extends Model
{
    use HasFactory;
    protected $connection = 'mysql2';
    protected $fillable=[
        'cabang_id',
        'nama_lembaga',
        'alamat_lembaga',
    ];

}
