<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tbl_penyuluhan extends Model
{
    public $table = "tbl_penyuluhan";
    public $timestamps = false;
    protected $fillable = [
        'isi_penyuluhan', 'no_rm', 'id_pemeriksaan', 
    ];
}
