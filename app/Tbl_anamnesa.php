<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tbl_anamnesa extends Model
{
    public $table = "tbl_anamnesa_rm";
    public $timestamps = false;
    protected $fillable = [
        'id_pemeriksaan','rpd','rpk','rps','no_rm'
    ];
}
