<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tbl_jenis_pemeriksaan extends Model
{
    public $table = "tbl_jenis_pemeriksaan";
    public $timestamps = false;
    protected $fillable = [
        'jenis_pemeriksaan','status',
    ];
}
