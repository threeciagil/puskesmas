<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tbl_pengguna extends Model
{
    public $table = "tbl_pengguna";
    public $timestamps = false;
    protected $fillable = [
        'full_name','username','password','email', 'role_id','no_hp',
    ];
}
