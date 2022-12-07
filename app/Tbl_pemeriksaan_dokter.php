<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tbl_pemeriksaan_dokter extends Model
{
    public $table = "tbl_pemeriksaan_dokter";
    public $timestamps = false;
    protected $fillable = [
        'id_jenis','id_nama',
    ];
}
