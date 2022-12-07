<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tbl_data_obat extends Model
{
    public $table = "tbl_data_obat";
    public $timestamps = false;
    protected $fillable = [
        'id_obat','nama_obat','satuan',
    ];
}
