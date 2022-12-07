<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tbl_kasir extends Model
{
    public $table = "kasir";
    public $timestamps = false;
    protected $fillable = [
        'no_rm', 'id_pemeriksaan','total_pembayaran', 'status' 
    ];
}
