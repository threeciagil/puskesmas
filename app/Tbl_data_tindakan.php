<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tbl_data_tindakan extends Model
{
    public $table = "tbl_data_tindakan";
    public $timestamps = false;
    protected $fillable = [
        'nama_tindakan','tarif',
    ];
}
