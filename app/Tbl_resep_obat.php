<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tbl_resep_obat extends Model
{
    public $table = "tbl_resep_obat";
    public $timestamps = false;
    protected $fillable = [
        'id_pemeriksaan','jenis_resep','signa','aturan_pakai',
    ];
}
