<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */


use Faker\Generator as Faker;
use App\Tbl_ff;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Eloquent\Factory;

$factory->define(Tbl_ff::class, function (Faker $faker) {
       
        $nama_kk = ucwords($faker->nama_kk);
        $des = ucfirst($faker->desa);
        $kec = ucfirst($faker->kecamatan);
        $kab = ucfirst($faker->kabupaten);
        $kode = $this->kode($kab, $kec, $des);
        $char = substr($faker->nama_kk, 0, 1);
        $c = strtoupper($char);
        $no = $this->getKK($c, $des,$kec,$kab);    
    if ($no < 10) {
            $no_index = $kode . '.' . $c . '00000' . $no;
        } elseif ($no > 9 && $no < 100) {
            $no_index = $kode . '.' . $c . '0000' . $no;
        } elseif ($no > 99 && $no < 1000) {
            $no_index = $kode . '.' . $c . '000' . $no;
        } elseif ($no > 999 && $no < 10000) {
            $no_index = $kode . '.' . $c . '00' . $no;
        }elseif ($no > 9999 && $no < 100000) {
            $no_index = $kode . '.' . $c . '0' . $no;
        } else {
            $no_index = $kode . '.' . $c . $no;
        }
    return [
            'nama_kk'=>$nama_kk,
            'alamat'=>$faker->alamat,
            'desa'=>$des,
            'kecamatan'=>$kec,
            'kabupaten'=>$kab,
            'telp'=> $faker->telp,
            'foto_KK'=>$faker->foto_KK,
            'no_index' => $no_index,
    ];
     
});
 function getKK($char, $desa,$kecamatan,$kabupaten)
    {
        if($kecamatan === 'Trenggalek'&& $kabupaten === 'Trenggalek'){
        // $tbl_ffs = DB::select("select nama_kk from tbl_ffs where desa='".$desa."'&& kecamatan='".$kecamatan."'&& kabupaten='".$kabupaten."'");
         $tbl_ffs = Tbl_ff::select('nama_kk')->where('desa',$desa)->where('kecamatan', $kecamatan)->where('kabupaten',$kabupaten)->get();
        $no = 1;
        foreach ($tbl_ffs as $row) {
            $sub_kalimat = substr($row->nama_kk, 0, 1);
            if ($sub_kalimat == $char) {
                $no++;
            }
        }
        return $no++;}
        elseif($kecamatan !== 'Trenggalek'&& $kabupaten === 'Trenggalek'){
        // $tbl_ffs = DB::select("select nama_kk from tbl_ffs where kecamatan !='".'Trenggalek'."'&& kabupaten='".'Trenggalek'."'");
        $tbl_ffs = Tbl_ff::select('nama_kk')->where('kecamatan', '!=','Trenggalek')->where('kabupaten','Trenggalek')->get();
        $no = 1;
        foreach ($tbl_ffs as $row) {
            $sub_kalimat = substr($row->nama_kk, 0, 1);
            if ($sub_kalimat == $char) {
                $no++;
            }
        }
        return $no++;
        }
        elseif($kabupaten !== 'Trenggalek'){
        $tbl_ffs = Tbl_ff::select('nama_kk')->where('kabupaten','!=','Trenggalek')->get();
        // $tbl_ffs = DB::select("select nama_kk from tbl_ffs where kabupaten !='".'Trenggalek'."'");
        $no = 1;
        foreach ($tbl_ffs as $row) {
            $sub_kalimat = substr($row->nama_kk, 0, 1);
            if ($sub_kalimat == $char) {
                $no++;
            }
        }
        return $no++;
        }
    }

    function kode($kabupaten, $kecamatan, $desa)
    {
        $kode = 00;
        if ($kecamatan === 'Trenggalek') {
            if($kabupaten === 'Trenggalek'){
                if ($desa === 'Dawuhan') {
                    return $kode = '01';
                } else if ($desa === 'Sukosari') {
                    return $kode = '02';
                } else if ($desa === 'Parakan') {
                    return $kode = '03';
                } else if ($desa === 'Rejowinangun') {
                    return $kode = '04';
                } else if ($desa === 'Surodakan') {
                    return $kode = '05';
                } else if ($desa === 'Ngares') {
                    return $kode = '06';
                } else if ($desa === 'Sumberdadi') {
                    return $kode = '07';
                } else {
                    return $kode = '08';
                }
            }
            else {
                return $kode= '10';
            }
            
        }        
        else {
            if($kabupaten === 'Trenggalek'){
                return $kode = '09';
                }
                else{
                    return $kode= '10';
                }
            
        }
    }
