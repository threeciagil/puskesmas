<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tbl_jamkes extends Model
{
    public $table = "tbl_jamkes";
    public $timestamps = false;
    protected $fillable = [
        'singkatan_jamkes','nama_jamkes'
    ];
}
