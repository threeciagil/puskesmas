<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tbl_asuhan_keperawatan extends Model
{
    public $table = "tbl_asuhan_keperawatan";
    public $timestamps = false;
    protected $fillable = [
        'id_askep','id_pemeriksaan','no_rm','tanggal','jam_mulai','rpd','rpk','rps','nb_subjective','tb','bb','imt','suhu','sistol','diastol','nb_object','nb_assessment','nb_plan','jam_selesai','penanggungjawab',
    ];
}
