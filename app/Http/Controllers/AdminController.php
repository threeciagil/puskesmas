<?php

namespace App\Http\Controllers;

use App\Tbl_antrian_farmasi;
use App\Tbl_antrian_kasir;
use App\Tbl_antrian_laboratorium;
use App\Tbl_antrian_pendaftaran;
use App\tbl_antrian_poli_umum;
use Illuminate\Http\Request;

use App\Tbl_data_obat;
use App\Tbl_data_tindakan;
use App\Tbl_pengguna;
use Session;
use App\Tbl_pendaftaran;
use App\Tbl_jamkes;
use App\Tbl_poli;
use App\Tbl_tindakan;
use App\Tbl_user_role;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    //
    public function index()
    {
        if(!Session::get('user_data')){
            return redirect('/login');
        }else{
            $judul = 'PELAYANAN PASIEN';
            date_default_timezone_set('Asia/jakarta');
            $tanggal=date('d-m-Y');

            // $antrian_pendaftaran = DB::table("tbl_antri_pendaftaran")
            // ->whereDate('tanggal_daftar', '=', now())
            // ->where('status', '=', 'Masuk')
            // ->count();

            $antrian_pendaftaran = Tbl_antrian_pendaftaran::whereDate('tanggal_daftar', '=', now())
            ->where('status', '=', 'Masuk')
            ->count();

            // $dilayani_pendaftaran = DB::table("tbl_antri_pendaftaran")
            // ->whereDate('tanggal_daftar', '=', now())
            // ->where('status', '!=', 'Masuk')
            // ->count();

            $dilayani_pendaftaran = Tbl_antrian_pendaftaran::whereDate('tanggal_daftar', '=', now())
            ->where('status', '!=', 'Masuk')
            ->count();

            // $antrian_umum = DB::table("tbl_antrian_poli_umums")
            // ->whereDate('created_at', '=', now())
            // ->where('status', '=', 'Masuk')
            // ->count();
            
            $antrian_umum = tbl_antrian_poli_umum::whereDate('created_at', '=', now())
            ->where('status', '=', 'Masuk')
            ->count();

            // $dilayani_umum = DB::table("tbl_antrian_poli_umums")
            // ->whereDate('created_at', '=', now())
            // ->where('status', '!=', 'Masuk')
            // ->count();
            
            $dilayani_umum = tbl_antrian_poli_umum::whereDate('created_at', '=', now())
            ->where('status', '!=', 'Masuk')
            ->count();

            // $antrian_laboratorium = DB::table("tbl_antrian_laboratorium")
            // ->whereDate('tanggal', '=', now())
            // ->where('status', '!=', 'selesai')
            // ->count();

            $antrian_laboratorium = Tbl_antrian_laboratorium::whereDate('tanggal', '=', now())
            ->where('status', '!=', 'selesai')
            ->count();
            
            // $dilayani_laboratorium = DB::table("tbl_antrian_laboratorium")
            // ->whereDate('tanggal', '=', now())
            // ->where('status', '=', 'selesai')
            // ->count();

            $dilayani_laboratorium = Tbl_antrian_laboratorium::whereDate('tanggal', '=', now())
            ->where('status', '=', 'selesai')
            ->count();

            // $antrian_farmasi = DB::table("tbl_antrian_farmasi")
            // ->whereDate('tanggal', '=', now())
            // ->where('status', '!=', 'selesai')
            // ->count();

            $antrian_farmasi = Tbl_antrian_farmasi::whereDate('tanggal', '=', now())
            ->where('status', '!=', 'selesai')
            ->count();

            // $dilayani_farmasi = DB::table("tbl_antrian_farmasi")
            // ->whereDate('tanggal', '=', now())
            // ->where('status', '=', 'selesai')
            // ->count();

            $dilayani_farmasi = Tbl_antrian_farmasi::whereDate('tanggal', '=', now())
            ->where('status', '=', 'selesai')
            ->count();

            // $antrian_kasir = DB::table("tbl_antrian_kasir")
            // ->whereDate('tanggal', '=', now())
            // ->where('status', '!=', 'selesai')
            // ->count();

            $antrian_kasir = Tbl_antrian_kasir::whereDate('tanggal', '=', now())
            ->where('status', '!=', 'selesai')
            ->count();

            // $dilayani_kasir = DB::table("tbl_antrian_kasir")
            // ->whereDate('tanggal', '=', now())
            // ->where('status', '=', 'selesai')
            // ->count();

            $dilayani_kasir = Tbl_antrian_kasir::whereDate('tanggal', '=', now())
            ->where('status', '=', 'selesai')
            ->count();

            
            return view('admin/v_dasboard',['tanggal' => $tanggal,'antrian_umum' => $antrian_umum,'dilayani_umum' => $dilayani_umum, 'antrian_laboratorium' => $antrian_laboratorium,'dilayani_laboratorium' => $dilayani_laboratorium,'antrian_farmasi' => $antrian_farmasi,'dilayani_farmasi' => $dilayani_farmasi,'antrian_pendaftaran' => $antrian_pendaftaran,'dilayani_pendaftaran' => $dilayani_pendaftaran,'antrian_kasir' => $antrian_kasir,'dilayani_kasir' => $dilayani_kasir,'judul' => $judul]);
            
        }
    
    }

    public function showjamkes()
    {
        $judul = 'PELAYANAN PASIEN';
        date_default_timezone_set('Asia/jakarta');
        $tanggal=date('Y-m-d');
        // $jamkes = DB::select("SELECT * FROM tbl_jamkes ");
         $jamkes = Tbl_jamkes::All();        
        return view('admin/v_tabeljamkes',['jamkes' => $jamkes, 'judul' => $judul]);
    }

    public function showlevelpengguna()
    {
        $judul = 'PELAYANAN PASIEN';
        date_default_timezone_set('Asia/jakarta');
        $tanggal=date('Y-m-d');
        // $role = DB::select("SELECT * FROM tbl_user_role ");
        $role = Tbl_user_role::All();    
        return view('admin/v_tabellevelpengguna',['role' => $role,'judul' => $judul]);
    }

    public function showpengguna()
    {
        $judul = 'PELAYANAN PASIEN';
        date_default_timezone_set('Asia/jakarta');
        $tanggal=date('Y-m-d');
        $pengguna = DB::select("SELECT * FROM tbl_pengguna,tbl_user_role WHERE tbl_pengguna.role_id = tbl_user_role.role_id ");
        // $role = DB::select("SELECT * FROM tbl_user_role ");
        //inner join $pengguna = Tbl_pengguna::addSelect(['role_id' => Tbl_user_role::whereColumn('role_id', 'role_id')])->get();
        $role = Tbl_user_role::All();  
        return view('admin/v_tabelpengguna',['role' => $role, 'pengguna' => $pengguna, 'judul' => $judul]);
    }
    
    public function showpoliutama() 
    {
        $judul = 'PELAYANAN PASIEN';
        date_default_timezone_set('Asia/jakarta');
        $tanggal=date('Y-m-d');
        // $poli = DB::select("SELECT * FROM tbl_poli ");
        $poli = Tbl_poli::All();
        return view('admin/v_poliutama',['poli' => $poli,'judul' => $judul]);
    }

    public function showdatapelayanan() 
    {
        $judul = 'PELAYANAN PASIEN';
        date_default_timezone_set('Asia/jakarta');
        $tanggal=date('Y-m-d');
        // $tindakan = DB::select("SELECT * FROM tbl_data_tindakan ");
        $tindakan = Tbl_data_tindakan::All();
        return view('admin/v_tabeldatapelayanan',['tindakan' => $tindakan,'judul' => $judul]);
    }

    public function storejamkes(Request $request)
    {
        $Tbl_jamkes= new Tbl_jamkes;
        $Tbl_jamkes->singkatan_jamkes = $request->singkatan;
        $Tbl_jamkes->nama_jamkes= $request->nama_jamkes;
        $Tbl_jamkes->save();
        return  redirect ('/admin/jamkes');
    }

    public function hapusjamkes($id)
    {
        // DB::table('tbl_jamkes')->where('id_jamkes', '=', $id)->delete();
        Tbl_jamkes::where('id_jamkes', '=', $id)->delete();
        return redirect('/admin/jamkes');
    }

    public function hapuspengguna($id)
    {
        // DB::table('tbl_pengguna')->where('id', '=', $id)->delete();
        Tbl_pengguna::where('id', '=', $id)->delete();
        return redirect('/admin/pengguna');
    }

    public function hapustindakan($id)
    {
        // DB::table('tbl_data_tindakan')->where('id_datatindakan', '=', $id)->delete();
        Tbl_data_tindakan::where('id_datatindakan', '=', $id)->delete();
        return redirect('/admin/datapelayanan');
    }

    public function storepengguna(Request $request)
    {
        $Tbl_pengguna= new Tbl_pengguna;
        $Tbl_pengguna->full_name = $request->nama;
        $Tbl_pengguna->username= $request->username;
        $Tbl_pengguna->role_id = $request->role_id;
        $Tbl_pengguna->email= $request->email;
        $Tbl_pengguna->no_hp = $request->no_hp;
        $Tbl_pengguna->password = $request->password;
        // $Tbl_pengguna->is_active= 1;
        $Tbl_pengguna->save();
        return  redirect ('/admin/pengguna');
    }


    public function storetindakan(Request $request)
    {
        $Tbl_tindakan= new Tbl_data_tindakan;
        $Tbl_tindakan->nama_tindakan = $request->nama_tindakan;
        // $Tbl_tindakan->poli= $request->nama_poli;
        $Tbl_tindakan->tarif = $request->tarif_tindakan;
        $Tbl_tindakan->save();
        return  redirect ('/admin/datapelayanan');
    }
}
