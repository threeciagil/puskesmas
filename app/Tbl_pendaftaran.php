<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tbl_pendaftaran extends Model
{
    protected $fillable = [
        'no_antrian','nama','no_rm', 'tanggal','tipe_kunjungan', 'poli_yang_dituju', 'waktu_pelayanan',
    ];
}
