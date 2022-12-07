<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tbl_diagnosa extends Model
{
    public $table = "tbl_diagnosa_rm";
    public $timestamps = false;
    protected $fillable = [
        'id_pemeriksaan', 'icd_x', 'nama_diagnosa',
    ];
}
