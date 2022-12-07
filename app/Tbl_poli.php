<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tbl_poli extends Model
{
    public $table = "tbl_poli";
    public $timestamps = false;
    protected $fillable = [
        'id', 'kode_poli', 'nama_poli',
    ];
}
