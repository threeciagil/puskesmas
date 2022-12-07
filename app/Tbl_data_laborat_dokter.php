<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tbl_data_laborat_dokter extends Model
{
    public $table = "tbl_data_laborat_dokter";
    public $timestamps = false;
    protected $fillable = [
        'id_data_laborat_dokter','nama','jenis','tarif',
    ];
}
