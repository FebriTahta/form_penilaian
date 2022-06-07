<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;
    protected $fillable=[
        'nama_group','jenis_id'
    ];

    public function jenis()
    {
        return $this->belongsTo(Jenis::class,'jenis_id','id');
    }
}
