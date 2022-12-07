<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tbl_antrian_pendaftaran extends Model
{
    public $table = "tbl_antri_pendaftaran";
    public $timestamps = false;
    protected $fillable = [
        'id_antrian','no_antrian', 'id',
    ];
}
