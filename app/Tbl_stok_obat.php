<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tbl_stok_obat extends Model
{
    public $table = "tbl_data_stock_obat";
    public $timestamps = false;
    protected $fillable = [
        'id','id_obat','tanggal_masuk','jumlah_penerimaan','tanggal_kadaluarsa','pemakaian','sisa','status',
    ];
}
