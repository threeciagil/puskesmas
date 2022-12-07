<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */


use Faker\Generator as Faker;
use App\Http\Controllers\PasienController;
use App\Tbl_ff;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Eloquent\Factory;

$factory->define(Tbl_ff::class, function (Faker $faker) {
       
    return [
           ['nama_kk'=>'Abu Munawaroh',
            'alamat'=>'RT 09 RW 04',
            'desa'=>'Parakan',
            'kecamatan'=>'Trenggalek',
            'kabupaten'=>'Trenggalek',
            'telp'=>'081337712252',
            'foto_KK'=>'avatar.php',
            'no_index' => '03.A000001',],
           [ 'nama_kk'=>'Ali Syahputra',
            'alamat'=>'RT 09 RW 04',
            'desa'=>'Parakan',
            'kecamatan'=>'Trenggalek',
            'kabupaten'=>'Trenggalek',
            'telp'=>'081337712252',
            'foto_KK'=>'avatar.php',
            'no_index' => '03.A000002',
            ],
        ];
});