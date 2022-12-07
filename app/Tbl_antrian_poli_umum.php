<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tbl_antrian_poli_umum extends Model
{
    protected $fillable = [
        'no_antrian','no_rm','waktu','status', 'poli_asal',
    ];
}
