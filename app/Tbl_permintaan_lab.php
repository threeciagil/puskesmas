<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tbl_permintaan_lab extends Model
{
    public $table = "tbl_permintaanlab";
    public $timestamps = false;
    protected $fillable = [
        'id_pemeriksaan',	'id_data_laborat_dokter',	'status_permintaan',	'waktu',	'tanggal',
    ];
}
