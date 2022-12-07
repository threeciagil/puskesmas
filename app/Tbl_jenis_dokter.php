<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tbl_jenis_dokter extends Model
{
    public $table = "tbl_jenis_dokter";
    public $timestamps = false;
    protected $fillable = [
        'jenis_dokter','status',
    ];
}
