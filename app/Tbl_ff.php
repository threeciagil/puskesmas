<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tbl_ff extends Model
{
    protected $fillable = [
        'nama_kk', 'alamat', 'desa','kecamatan','kabupaten','telp','no_index','foto_KK'
    ];
}
