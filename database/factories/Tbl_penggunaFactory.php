<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
// use App\Model;
use App\Tbl_pengguna;

$factory->define(Tbl_pengguna::class, function (Faker $faker) {
    return [
        'full_name'=>'Lala',
        'username'=>'pendaftaran',
        'password'=>'12345678',
        'email'=>'lala@gmail.com', 
        'role_id'=>'2',
        'no_hp'=>'081337712252',
    ];
}

);
