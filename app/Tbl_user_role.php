<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tbl_user_role extends Model
{
    public $table = "tbl_user_role";
    public $timestamps = false;
    protected $fillable = [
        'role_id', 'role',
    ];
}
