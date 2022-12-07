<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tbl_pemeriksaan extends Model
{
    public $table = "tbl_pemeriksaan_rm";
    public $timestamps = false;
    protected $fillable = [
        'id_pemeriksaan','tinggi_badan','berat_badan','imt','suhu','rr','sistol','diastol',
    ];
}
