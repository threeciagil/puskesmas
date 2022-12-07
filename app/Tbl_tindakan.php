<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tbl_tindakan extends Model
{
    public $table = "tbl_tindakan_rm";
    public $timestamps = false;
    protected $fillable = [
        'id_pemeriksaan', 'tindakan', 'keterangan', 'waktu_tindakan', 'status', 'penanggung_jawab', 
    ];
}
