<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tbl_datapasien extends Model
{
    protected $fillable = [
        'nama','jenis_kelamin','no_index','nama_kk', 'alamat','pekerjaan', 'tanggal_lahir', 'umur', 'jenis_asuransi','no_asuransi','agama','telp','silsilah','no_rm',
    ];
}
