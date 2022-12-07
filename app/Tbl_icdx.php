<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tbl_icdx extends Model
{
    public $table = "tbl_data_icdx";
    public $timestamps = false;
    protected $fillable = [
        'icd_x', 'nama_diagnosa', 
    ];
}
