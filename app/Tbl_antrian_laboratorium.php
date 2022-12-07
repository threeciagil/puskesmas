<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tbl_antrian_laboratorium extends Model
{
    public $table = "tbl_antrian_laboratorium";
    public $timestamps = false;
    protected $fillable = [
        'no_antrian','no_rm','waktu','status', 'poli_asal',
    ];
}
