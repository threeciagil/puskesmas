<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tbl_resep_obats extends Model
{
    public $table = "tbl_resep_obats";
    public $timestamps = false;
    protected $fillable = [
        'id_resep','nama_obat','jumlah',
    ];
}
