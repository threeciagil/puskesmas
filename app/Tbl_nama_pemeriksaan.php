<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tbl_nama_pemeriksaan extends Model
{
    public $table = "tbl_nama_pemeriksaan";
    public $timestamps = false;
    protected $fillable = [
        'id_nama_pemeriksaan','id_jenis_pemeriksaan','nama_pemeriksaan', 'nilai_normal', 'satuan','status',
    ];
}
