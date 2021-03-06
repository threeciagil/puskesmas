<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KasirController extends Controller
{
    //
   
    public function index()
    {
        $judul = 'PELAYANAN PASIEN';
        date_default_timezone_set('Asia/jakarta');
        $tanggal=date('Y-m-d');
        
        return view('kasir/v_daftarantriankasir',['judul' => $judul]);
    }
    public function showpelayanankasir()
    {
        $judul = 'PELAYANAN PASIEN';
        date_default_timezone_set('Asia/jakarta');
        $tanggal=date('Y-m-d');
        
        return view('kasir/v_datapelayanankasir',['judul' => $judul]);
    }

    public function showhistory()
    {
        $judul = 'PELAYANAN PASIEN';
        date_default_timezone_set('Asia/jakarta');
        $tanggal=date('Y-m-d');
        
        return view('kasir/v_history',['judul' => $judul]);
    }

    public function showlaporan()
    {
        $judul = 'PELAYANAN PASIEN';
        date_default_timezone_set('Asia/jakarta');
        $tanggal=date('Y-m-d');
        
        return view('kasir/datalaporan/v_laporankasir',['judul' => $judul]);
    }
   

}
