<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tbl_RekamMedis extends Model
{
    public $table = "tbl_rekam_medis";
    public $timestamps = false;
    protected $fillable = [
        'tanggal_kunjungan', 'waktu_mulai', 'waktu_selesai','dokter_penanggung_jawab','perawat_penanggung_jawab',
    ];
}
