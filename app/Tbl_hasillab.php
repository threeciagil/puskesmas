<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tbl_hasillab extends Model
{
    public $table = "tbl_hasil_lab";
    public $timestamps = false;
    protected $fillable = [
        'id_pemeriksaan','id_nama_pemeriksaan','id_jenis_pemeriksaan ','hasil_pemeriksaan_lab', 'penanggung_jawab'
    ];
}
