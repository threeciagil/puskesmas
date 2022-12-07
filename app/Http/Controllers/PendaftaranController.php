<?php

namespace App\Http\Controllers;

use App\Events\EveryoneEvent;
use App\Events\PanggilPendaftaranEvent;
use App\Tbl_RekamMedis;
use App\Tbl_ff;
use App\Tbl_datapasien;
use App\Tbl_pendaftaran;
use App\Tbl_antrian_poli_umum;
use Illuminate\Support\Facades\DB;
use Session;
use Illuminate\Http\Request;
// use Request;

class PendaftaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        if(!Session::get('user_data')){
            return redirect('/login');
        }else{
            $value = session('user_data')[0]['role'];
            if($value == "Pendaftaran"){
                $judul = 'Antrian Pendaftaran';
                date_default_timezone_set('Asia/jakarta');
                $tanggal=date('Y-m-d');
                $status='masuk';
                $antrian = DB::select("SELECT tbl_antri_pendaftaran.id_antrian,tbl_antri_pendaftaran.no_antrian,tbl_poli.kode_poli, tbl_antri_pendaftaran.status,tbl_antri_pendaftaran.id_poli,tbl_poli.nama_poli,tbl_antri_pendaftaran.urutan FROM tbl_antri_pendaftaran JOIN tbl_poli on tbl_poli.id=tbl_antri_pendaftaran.id_poli where tbl_antri_pendaftaran.tanggal_daftar='".$tanggal."' && tbl_antri_pendaftaran.status!='hapus' ");
                return view('pendaftaran/v_pendaftaran',['antrian' => $antrian, 'judul' => $judul]);
        
            }
            else{
                return redirect('/login');
            }
        }
    }

    public function lewati($id)
    {
        date_default_timezone_set('Asia/jakarta');
        $tanggal=date('Y-m-d');
        //ambil data di tabel antri pendaftaran
        $datas = DB::table("tbl_antri_pendaftaran")
                ->whereDate('tanggal_daftar', '=', now())->get();
        //hitung data di ambil oendaftaran        
        $count = DB::table("tbl_antri_pendaftaran")
                ->whereDate('tanggal_daftar', '=', now())->count();
        //ambil data yg mau dilewati
        $data = DB::select("select * from tbl_antri_pendaftaran where id_antrian=".$id."");        
        
        //ambil 3 data terdekat setelah data yang mau dilewati
        $id1 = $id+1;
        $id2 = $id+2;
        $id3 = $id+3;

        //alokasi id untuk menukar data 
        $temp_id  = 99999996;
        $temp_id1 = 99999997;
        $temp_id2 = 99999998;
        $temp_id3 = 99999999;

        //tentukan id tujuan
        $id_akhir = $id3;
        $id1_akhir = $id;
        $id2_akhir = $id1;
        $id3_akhir = $id2;
        
        //tentukan ururtan awal dan akhir data yg ingin dilewati
        $urutan_awal = $data[0]->urutan;
        $urutan_akhir = $urutan_awal+3;

        //ketika data berada di tengah
        if($count>4 && $urutan_akhir<$count){ 
            $data1 = $datas[$urutan_awal+1];
            $data2 = $datas[$urutan_awal+2];
            $data3 = $datas[$urutan_awal+3];
            $urutan_akhir1 = $data1->urutan-2;
            $urutan_akhir2 = $data2->urutan-2;
            $urutan_akhir3 = $data3->urutan-2;      
            $antrian = DB::select("UPDATE tbl_antri_pendaftaran set status='lewati' where id_antrian=".$id."");
            $updatedata =  DB::select("UPDATE tbl_antri_pendaftaran set urutan = $urutan_akhir where id_antrian=".$id."");
            $updatedata1 =  DB::select("UPDATE tbl_antri_pendaftaran set urutan = $urutan_akhir1 where id_antrian=".$id1."");
            $updatedata2 =  DB::select("UPDATE tbl_antri_pendaftaran set urutan = $urutan_akhir2 where id_antrian=".$id2."");
            $updatedata3 =  DB::select("UPDATE tbl_antri_pendaftaran set urutan = $urutan_akhir3 where id_antrian=".$id3."");
            
            $updateid =  DB::select("UPDATE tbl_antri_pendaftaran set id_antrian = $temp_id where id_antrian=".$id."");
            $updateid1 =  DB::select("UPDATE tbl_antri_pendaftaran set id_antrian = $temp_id1 where id_antrian=".$id1."");
            $updateid2 =  DB::select("UPDATE tbl_antri_pendaftaran set id_antrian = $temp_id2 where id_antrian=".$id2."");
            $updateid3 =  DB::select("UPDATE tbl_antri_pendaftaran set id_antrian = $temp_id3 where id_antrian=".$id3."");

            $updateidakhir =  DB::select("UPDATE tbl_antri_pendaftaran set id_antrian = $id_akhir where id_antrian=".$temp_id."");
            $updateidakhir1 =  DB::select("UPDATE tbl_antri_pendaftaran set id_antrian = $id1_akhir where id_antrian=".$temp_id1."");
            $updateidakhir2 =  DB::select("UPDATE tbl_antri_pendaftaran set id_antrian = $id2_akhir where id_antrian=".$temp_id2."");
            $updateidakhir3 =  DB::select("UPDATE tbl_antri_pendaftaran set id_antrian = $id3_akhir where id_antrian=".$temp_id3."");       
                 
            return response()->json([
                'success' => true,
                'message' => 'Pasien dilewati',
            ]);
        }
        //jika data berada di urutan terakhir ke-4        
        elseif($urutan_akhir==$count){
            $urutan_akhir=$count;
            $urutan_akhir1 = $count-3;
            $urutan_akhir2 = $count-2;   
            $urutan_akhir3 = $count-1;  
            // echo( $urutan_akhir2);
            // echo("\n");
            // echo( $urutan_akhir2);   
            $antrian = DB::select("UPDATE tbl_antri_pendaftaran set status='lewati' where id_antrian=".$id."");
            $updatedata =  DB::select("UPDATE tbl_antri_pendaftaran set urutan = $urutan_akhir where id_antrian=".$id."");
            $updatedata1 =  DB::select("UPDATE tbl_antri_pendaftaran set urutan = $urutan_akhir1 where id_antrian=".$id1."");
            $updatedata2 =  DB::select("UPDATE tbl_antri_pendaftaran set urutan = $urutan_akhir2 where id_antrian=".$id2."");
            $updatedata3 =  DB::select("UPDATE tbl_antri_pendaftaran set urutan = $urutan_akhir3 where id_antrian=".$id3."");
            
            $updateid =  DB::select("UPDATE tbl_antri_pendaftaran set id_antrian = $temp_id where id_antrian=".$id."");
            $updateid1 =  DB::select("UPDATE tbl_antri_pendaftaran set id_antrian = $temp_id1 where id_antrian=".$id1."");
            $updateid2 =  DB::select("UPDATE tbl_antri_pendaftaran set id_antrian = $temp_id2 where id_antrian=".$id2."");
            $updateid3 =  DB::select("UPDATE tbl_antri_pendaftaran set id_antrian = $temp_id3 where id_antrian=".$id3."");

            $updateidakhir =  DB::select("UPDATE tbl_antri_pendaftaran set id_antrian = $id_akhir where id_antrian=".$temp_id."");
            $updateidakhir1 =  DB::select("UPDATE tbl_antri_pendaftaran set id_antrian = $id1_akhir where id_antrian=".$temp_id1."");
            $updateidakhir2 =  DB::select("UPDATE tbl_antri_pendaftaran set id_antrian = $id2_akhir where id_antrian=".$temp_id2."");            
            $updateidakhir3 =  DB::select("UPDATE tbl_antri_pendaftaran set id_antrian = $id3_akhir where id_antrian=".$temp_id3."");            
            
            return response()->json([
                'success' => true,
                'message' => 'Pasien dilewati',
            ]);
        }
        //jika data berada di urutan terakhir ketiga
        elseif($urutan_akhir==$count+1){

            $urutan_akhir=$count;
            $urutan_akhir2 = $count-2;   
            $urutan_akhir3 = $count-1;
            $antrian = DB::select("UPDATE tbl_antri_pendaftaran set status='lewati' where id_antrian=".$id."");
            $updatedata =  DB::select("UPDATE tbl_antri_pendaftaran set urutan = $urutan_akhir where id_antrian=".$id."");
            $updatedata2 =  DB::select("UPDATE tbl_antri_pendaftaran set urutan = $urutan_akhir2 where id_antrian=".$id1."");
            $updatedata3 =  DB::select("UPDATE tbl_antri_pendaftaran set urutan = $urutan_akhir3 where id_antrian=".$id2."");
            
            $updateid =  DB::select("UPDATE tbl_antri_pendaftaran set id_antrian = $temp_id where id_antrian=".$id."");
            $updateid2 =  DB::select("UPDATE tbl_antri_pendaftaran set id_antrian = $temp_id2 where id_antrian=".$id1."");
            $updateid3 =  DB::select("UPDATE tbl_antri_pendaftaran set id_antrian = $temp_id3 where id_antrian=".$id2."");

            $updateidakhir =  DB::select("UPDATE tbl_antri_pendaftaran set id_antrian = $id_akhir where id_antrian=".$temp_id."");
            $updateidakhir2 =  DB::select("UPDATE tbl_antri_pendaftaran set id_antrian = $id1_akhir where id_antrian=".$temp_id2."");            
            $updateidakhir3 =  DB::select("UPDATE tbl_antri_pendaftaran set id_antrian = $id2_akhir where id_antrian=".$temp_id3.""); 
            $updateidakhir4 =  DB::select("UPDATE tbl_antri_pendaftaran set id_antrian = $id_akhir-1 where id_antrian=".$id_akhir."");           
            
            return response()->json([
                'success' => true,
                'message' => 'Pasien dilewati',
            ]);
        }

        //jika data berada di urutan terakhir kedua
        elseif($urutan_akhir==$count+2){

            $urutan_akhir=$count;
            $urutan_akhir1 = $urutan_awal;
            $urutan_akhir2 = $count-1;   
            $antrian = DB::select("UPDATE tbl_antri_pendaftaran set status='lewati' where id_antrian=".$id."");
            $updatedata =  DB::select("UPDATE tbl_antri_pendaftaran set urutan = $urutan_akhir where id_antrian=".$id."");
            $updatedata1 =  DB::select("UPDATE tbl_antri_pendaftaran set urutan = $urutan_akhir1 where id_antrian=".$id1."");
            $updatedata2 =  DB::select("UPDATE tbl_antri_pendaftaran set urutan = $urutan_akhir2 where id_antrian=".$id2."");
            
            $updateid =  DB::select("UPDATE tbl_antri_pendaftaran set id_antrian = $temp_id where id_antrian=".$id."");
            $updateid1 =  DB::select("UPDATE tbl_antri_pendaftaran set id_antrian = $temp_id1 where id_antrian=".$id1."");
            $updateid2 =  DB::select("UPDATE tbl_antri_pendaftaran set id_antrian = $temp_id2 where id_antrian=".$id2."");
            
            $updateidakhir =  DB::select("UPDATE tbl_antri_pendaftaran set id_antrian = $id_akhir where id_antrian=".$temp_id."");
            $updateidakhir1 =  DB::select("UPDATE tbl_antri_pendaftaran set id_antrian = $id1_akhir where id_antrian=".$temp_id1."");
            $updateidakhir2 =  DB::select("UPDATE tbl_antri_pendaftaran set id_antrian = $id2_akhir where id_antrian=".$temp_id2."");            
            $updateidakhir3 =  DB::select("UPDATE tbl_antrian_poli_umums set id_antrian = $id_akhir-2 where id_antrian=".$id_akhir."");
            // $updatedata2 =  DB::select("UPDATE tbl_antri_pendaftaran set urutan = $urutan_akhir2 where id_antrian=".$id2."");
            return response()->json([
                'success' => true,
                'message' => 'Pasien dilewati',
            ]);
        }

        //jika data berada di urutan terakhir
        elseif($data[0]->urutan==$count){
            return response()->json([
                'success' => true,
                'message' => 'Pasien ini berada di nomor terakhir',
            ]);
        }
    }

    public function hapus($id)
    {
        $antrian = DB::select("UPDATE tbl_antri_pendaftaran set status='hapus' where id_antrian=".$id."");
        return redirect('/daftarantrian');
    }

    public function layani($id)
    { 
        $judul = 'Daftar Family Folder';
        $family = DB::select("select * from tbl_ffs");
        return view('pendaftaran/v_family',['family' => $family, 'judul' => $judul, 'segment' => $id]);
    }

    public function vieweditfamily($id1,$id2)
    {
        $judul = 'Edit Data Family';
        $family = DB::select("SELECT * FROM tbl_ffs where no_index='".$id2."'");
        // print_r($family);
        return view('pendaftaran/v_editfamily', ['family' => $family, 'judul' => $judul, 'segment'=>$id1]);
    }
    public function addfamily()
    {
        $judul = 'Tambah Data Family Folder';
        return view('pendaftaran/v_addfamily',['judul' => $judul]);
    }

    public function datapasien($id,$id2)
    {
        $judul = 'Daftar Pasien';
        $pasien = DB::select("SELECT * FROM tbl_datapasiens where no_index='".$id2."'");
        return view('pendaftaran/v_pasien', ['pasien' => $pasien, 'judul' => $judul]);
    }

    public function addpasien($id, $id2)
    {
        $judul = 'Tambah Data Pasien';
        $data['data_ff'] = DB::select("SELECT * from tbl_ffs where no_index='".$id2."'");
        $data['jamkes'] = DB::select("select * from tbl_jamkes");
        $data['silsilah'] = ['Kepala Keluarga', 'Ibu', 'Lainnya'];
        $data['jenkel'] = ['Laki-laki', 'Perempuan'];
        $data['no_index'] = $id2;
        return view('pendaftaran/v_addpasien', ['data' => $data,'judul' => $judul]);
    }

    public function vieweditpasien($id1,$id2)
    {  
        
        //  echo($segment);
        $judul = 'Edit Data Pasien';
        $pasien = DB::select("SELECT * FROM tbl_datapasiens where no_rm='".$id2."'");
        // print_r($pasien);
        return view('pendaftaran/v_editpasien', ['pasien' => $pasien, 'judul' => $judul, 'segment'=>$id1]);
    }

    public function saveeditPasien(Request $request)
    {
        // echo($request->index);
        DB::table('tbl_datapasiens')->where('no_rm', $request->no_rm)->update([
            'nama'=>$request->nama,
            'jenis_kelamin'=>$request->jenis_kelamin,
            // 'no_index'=>$request->no_index,
            'nama_kk'=>$request->nama_kk,
            'alamat'=>$request->alamat,
            'pekerjaan'=>$request->pekerjaan,
            'tanggal_lahir'=>$request->tanggal_lahir,
            'umur'=>$request->umur,
            'jenis_asuransi'=>$request->jenis_asuransi,
            'no_asuransi'=>$request->no_asuransi,
            'agama'=>$request->agama,
            'telp'=>$request->no_hp,
            'silsilah'=>$request->silsilah,
        ]);
        
        return redirect ('datapasien/'.$request->seg2.'/'.$request->index);
    }
    
    public function editFF(Request $request)
    {
        $kk = request()->file('kk');
        if(isset($kk)){
            $kkname = time().'.'.$kk->getClientOriginalExtension();
            $path = public_path('/images/');
            $kk->move($path, $kkname);
            // echo($kkname);                
            DB::table('tbl_ffs')->where('no_index', $request->index)->update([
                'nama_kk'=>$request->nama_kk,
                'alamat'=>$request->alamat,
                'desa'=>$request->desa,
                'kecamatan'=>$request->kecamatan,
                'kabupaten'=>$request->kabupaten,
                'telp'=>$request->telp,
                'foto_KK'=>'/images/' . $kkname,
            ]);
        }
        else{
            DB::table('tbl_ffs')->where('no_index', $request->index)->update([
                'nama_kk'=>$request->nama_kk,
                'alamat'=>$request->alamat,
                'desa'=>$request->desa,
                'kecamatan'=>$request->kecamatan,
                'kabupaten'=>$request->kabupaten,
                'telp'=>$request->telp
            ]);
        }
        return redirect ('/datarekammedis');
    }

    public function editFFPendaftaran(Request $request)
    {
        $kk = request()->file('kk');
        if(isset($kk)){
            $kkname = time().'.'.$kk->getClientOriginalExtension();
            $path = public_path('/images/');
            $kk->move($path, $kkname);
            // echo($kkname);                
            DB::table('tbl_ffs')->where('no_index', $request->index)->update([
                'nama_kk'=>$request->nama_kk,
                'alamat'=>$request->alamat,
                'desa'=>$request->desa,
                'kecamatan'=>$request->kecamatan,
                'kabupaten'=>$request->kabupaten,
                'telp'=>$request->telp,
                'foto_KK'=>'/images/' . $kkname,
            ]);
        }
        else{
            DB::table('tbl_ffs')->where('no_index', $request->index)->update([
                'nama_kk'=>$request->nama_kk,
                'alamat'=>$request->alamat,
                'desa'=>$request->desa,
                'kecamatan'=>$request->kecamatan,
                'kabupaten'=>$request->kabupaten,
                'telp'=>$request->telp
            ]);
        }
        return redirect ('daftarantrian/layani/'.$request->segment);
    }

    // public function tambahFF(Request $request)
    // {
    //     $kk = request()->file('kk');
    //     $kkname = time().'.'.$kk->getClientOriginalExtension();
    //     $path = public_path('/images/');
    //     $kk->move($path, $kkname);
    //     // echo($kkname);

    //     $tbl_ff = new Tbl_ff;
    //     $tbl_ff->nama_kk=$request->nama_kk;
    //     $tbl_ff->alamat=$request->alamat;
    //     $tbl_ff->desa=$request->desa;
    //     $tbl_ff->kecamatan=$request->kecamatan;
    //     $tbl_ff->kabupaten=$request->kabupaten;
    //     $tbl_ff->telp=$request->telp;
    //     $tbl_ff->foto_KK='/images/' . $kkname;
    //     $kode = $this->kode($request->kabupaten, $request->kecamatan, $request->desa);
    //     $char = substr($request->nama_kk, 0, 1);
    //     $c = strtoupper($char);
    //     $data = DB::select("select * from tbl_ffs where desa='".$request->desa."'");
    //     $no = 1;
    //     foreach ($data as $row) {
    //         $sub_kalimat = substr($row->nama_kk, 0, 1);
    //         if ($sub_kalimat == $char) {
    //             $no++;
    //         }
    //     }
    //     if ($no < 10) {
    //         $no_index = $kode . '.' . $c . '00000' . $no;
    //     } elseif ($no > 9 && $no < 100) {
    //         $no_index = $kode . '.' . $c . '0000' . $no;
    //     } elseif ($no > 99 && $no < 1000) {
    //         $no_index = $kode . '.' . $c . '000' . $no;
    //     } elseif ($no > 999 && $no < 10000) {
    //         $no_index = $kode . '.' . $c . '00' . $no;
    //     }elseif ($no > 9999 && $no < 100000) {
    //         $no_index = $kode . '.' . $c . '0' . $no;
    //     } else {
    //         $no_index = $kode . '.' . $c . $no;
    //     }
    //     // if ($no < 10) {
    //     //     $no_index = $kode . '.' . $c . '000' . $no;
    //     // } elseif ($no > 9) {
    //     //     $no_index = $kode . '.' . $c . '00' . $no;
    //     // } elseif ($no > 99) {
    //     //     $no_index = $kode . '.' . $c . '0' . $no;
    //     // } else {
    //     //     $no_index = $kode . '.' . $c . $no;
    //     // }
    //     $tbl_ff->no_index=$no_index;
    //     $tbl_ff->save();

    //     return redirect ('/datapasienrm');
    // }

    public function store(Request $request)
    {
        $kk = request()->file('kk');
        $kkname = time().'.'.$kk->getClientOriginalExtension();
        $path = public_path('/images/');
        $kk->move($path, $kkname);
        $nama_kk = ucwords($request->nama_kk);
        $des = ucfirst($request->desa);
        $kec = ucfirst($request->kecamatan);
        $kab = ucfirst($request->kabupaten);

        $tbl_ff = new Tbl_ff;
        $tbl_ff->nama_kk=$nama_kk;
        $tbl_ff->alamat=$request->alamat;
        $tbl_ff->desa = $des;
        $tbl_ff->kecamatan = $kec;
        $tbl_ff->kabupaten = $kab;
        $tbl_ff->telp=$request->telp;
        $tbl_ff->foto_KK='/images/' . $kkname;
       
        $kode = $this->kode($kab, $kec, $des);
        $char = substr($request->nama_kk, 0, 1);
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
        $tbl_ff->no_index=$no_index;
        $tbl_ff->save();

        return redirect ('/daftarantrian/layani/'.$request->segment);
    }

    private function getKK($char, $desa,$kecamatan,$kabupaten)
    {
        if($kecamatan === 'Trenggalek'&& $kabupaten === 'Trenggalek'){
        // $tbl_ffs = DB::select("select nama_kk from tbl_ffs where desa='".$desa."'&& kecamatan='".$kecamatan."'&& kabupaten='".$kabupaten."'");
        $tbl_ffs = Tbl_ff::select('nama_kk')->where('desa', $desa)->where('kecamatan','Trenggalek')->where('kabupaten','Trenggalek')->get();
        $no = 0;
        foreach ($tbl_ffs as $row) {
            $sub_kalimat = substr($row->nama_kk, 0, 1);
            if ($sub_kalimat == $char) {
                $no++;
            }
        }
        $no++;
        return $no;
    }
        elseif($kabupaten === 'Trenggalek'&& $kecamatan !== 'Trenggalek' ){
        // $tbl_ffs = DB::select("select nama_kk from tbl_ffs where kecamatan !='".'Trenggalek'."'&& kabupaten='".'Trenggalek'."'");
        $tbl_ffs = Tbl_ff::select('nama_kk')->where('kecamatan', '!=','Trenggalek')->where('kabupaten','Trenggalek')->get();
        $no = 0;
        foreach ($tbl_ffs as $row) {
            $sub_kalimat = substr($row->nama_kk, 0, 1);
            if ($sub_kalimat == $char) {
                $no++;
            }
        }
        $no++;
        return $no;
    }
        elseif($kabupaten !== 'Trenggalek'){
        // $tbl_ffs = DB::select("select nama_kk from tbl_ffs where kabupaten !='".'Trenggalek'."'");
        $tbl_ffs = Tbl_ff::select('nama_kk')->where('kabupaten','!=','Trenggalek')->get();
        $no = 0;
        foreach ($tbl_ffs as $row) {
            $sub_kalimat = substr($row->nama_kk, 0, 1);
            if ($sub_kalimat == $char) {
                $no++;
            }
        }
        $no++;
        return $no;
        }
    }

    private function kode($kabupaten, $kecamatan, $desa)
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

    public function storepasien(Request $request)
    {
        date_default_timezone_set('Asia/jakarta');
        $tanggal=date('Y-m-d');
        $waktu=date("h:i:s:");

        $index = $request->seg2;
        $silsilah=$request->silsilah;
        if($silsilah=='Kepala Keluarga'){
            $no_rm=$index . '.' . '1';
        }
        elseif ($silsilah=='Ibu') {
            $no_rm=$index . '.' .  '2';
        }
        else{
            $count=DB::select("select count(*) as jumlah from tbl_datapasiens where no_index='".$index."'")[0]->jumlah;
            $no=$count+3;
            $no_rm=$index . '.'  . $no;
        }
        $nama= ucwords($request->nama);
        $Tbl_datapasien = new Tbl_datapasien;
        $Tbl_datapasien->nama = $nama;
        $Tbl_datapasien->jenis_kelamin=$request->jenis_kelamin;
        $Tbl_datapasien->no_index=$request->seg2;
        $Tbl_datapasien->nama_kk=$request->nama_kk;
        $Tbl_datapasien->alamat=$request->alamat;
        $Tbl_datapasien->pekerjaan=$request->pekerjaan;
        $Tbl_datapasien->tanggal_lahir=$request->tanggal_lahir;
        $Tbl_datapasien->umur=$request->umur;
        $Tbl_datapasien->jenis_asuransi=$request->jenis_asuransi;
        $Tbl_datapasien->no_asuransi=$request->no_asuransi;
        $Tbl_datapasien->agama=$request->agama;
        $Tbl_datapasien->telp=$request->no_hp;
        $Tbl_datapasien->silsilah=$request->silsilah;
        $Tbl_datapasien->no_rm=$no_rm;
        $Tbl_datapasien->save();

        // $Tbl_rekammedis = new Tbl_RekamMedis;
        // $Tbl_rekammedis->tanggal_kunjungan = $tanggal;
        // $Tbl_rekammedis->waktu_mulai = $waktu;
        // $Tbl_rekammedis->waktu_selesai = $waktu;
        // $Tbl_rekammedis->perawat_penanggung_jawab = session('user_data')[0]['nama'];
        // $Tbl_rekammedis->no_rm=$no_rm;
        // $Tbl_rekammedis->save();

        return redirect ('/datapasien/'.$request->seg1."/".$request->seg2);
    }

    
    public function pendaftaran_pasien($id,$id2)
    {
       
        $judul = 'Pendaftaran Pasien';
        // $this->load->model("M_familyfolder");
        // $cekpasien = DB::select("select *  from tbl_datapasiens where no_index='".$id2."'");
        //buat daetin no rm
        $data['no_rm']=$id2;
        $data['cek']=DB::select("select count(*) as total from tbl_asuhan_keperawatan where no_rm='".$id2."'")[0]->total;

        $data['data_pasien'] = DB::select("select *  from tbl_datapasiens where no_rm='".$id2."'");
        $data_pendaftaran =  DB::select("select *  from tbl_antri_pendaftaran where id_antrian='".$id."'");
        // echo($data_pendaftaran[0]->no_antrian);
        if($data_pendaftaran[0]->no_antrian <= 10){
            $text="00";
        }else{
            $text="0";
        }
        $data['id_antrian'] = $id;
        $data['no_antrian_pendaftaran'] = "A ".$text." ".$data_pendaftaran[0]->no_antrian;
        $data['jamkes'] = DB::select("select *  from tbl_jamkes");
        $data['jenkel'] = ['Laki-laki', 'Perempuan'];
        $data['poli'] = ['Poli Umum'];
        return view('pendaftaran/v_pendaftaran_pasien', ['data' => $data, 'judul' => $judul]);
    }

    public function save_pendaftaran(Request $request)
    {
        date_default_timezone_set('Asia/jakarta');
        $tanggal=date('Y-m-d');
        $waktu=date("Y-m-d H:i:s");
        // echo($request->no_rm);
        // print_r($request->noantrian); exit();
        $Tbl_pendaftaran = new Tbl_pendaftaran();
        $Tbl_pendaftaran->no_antrian=$request->noantrian;
        $Tbl_pendaftaran->nama=$request->nama;
        $Tbl_pendaftaran->no_rm=$request->rm;
        $Tbl_pendaftaran->tanggal=$tanggal;
        $Tbl_pendaftaran->tipe_kunjungan=$request->tipe_kunjungan;
        $Tbl_pendaftaran->poli_yang_dituju="Poli Umum";
        $Tbl_pendaftaran->waktu_pelayanan=$waktu;


        $Tbl_antrian_poli_umum = new Tbl_antrian_poli_umum();
        $tanggal=date('Y-m-d');
        $cek = $Tbl_antrian_poli_umum
            // ->where('id_poli', '=', $id_poli)
            ->where('created_at', '=', $tanggal)
            ->count();
        $jumlah_antrian = $cek + 1;
        $Tbl_antrian_poli_umum->no_antrian=$request->noantrian;
        $Tbl_antrian_poli_umum->no_antrian=$request->noantrian;
        $Tbl_antrian_poli_umum->no_rm=$request->no_rm;
        $Tbl_antrian_poli_umum->waktu=$waktu;
        $Tbl_antrian_poli_umum->status="Masuk";
        $Tbl_antrian_poli_umum->poli_asal="Poli Umum";
        $Tbl_antrian_poli_umum->urutan = $jumlah_antrian;
        $Tbl_antrian_poli_umum->save();
        $Tbl_pendaftaran->save();
        

        // $update = DB::select("UPDATE tbl_rekam_medis set status='lewati' where id_antrian=".$id."");
            
        $Tbl_rekammedis = new Tbl_RekamMedis;
        $Tbl_rekammedis->tanggal_kunjungan = $tanggal;
        $Tbl_rekammedis->waktu_mulai = $waktu;
        $Tbl_rekammedis->waktu_selesai = $waktu;
        // $Tbl_rekammedis->perawat_penanggung_jawab = session('user_data')[0]['nama'];
        $Tbl_rekammedis->no_rm=$request->no_rm;
        $Tbl_rekammedis->save();
//??
        broadcast(new EveryoneEvent());
        $this->hapus($request->id_antrian);

        return redirect ('/daftarantrian');
    }

    public function history()
    {
        $judul = 'Daftar Pelayanan Pasien';
        $history = $antrian = DB::select("SELECT * FROM tbl_antrian_poli_umums JOIN tbl_datapasiens on tbl_datapasiens.no_rm=tbl_antrian_poli_umums.no_rm");
        // print_r($history);
        return view('pendaftaran/v_history', ['history'=>$history, 'judul' => $judul]);
    }

    public function cekbpjs($id){
        $data_bpjs =  DB::select("select *  from tbl_asuransi where nomor_asuransi='".$id."' AND tipe_asuransi ='BPJS'");
        if(count($data_bpjs)==0){
            return ("Data tidak ditemukan");
        }
        else{
            $kalimat = "Data ditemukan :\n Nama :".$data_bpjs[0]->nama." \n tipe asuransi : ".$data_bpjs[0]->tipe_asuransi."\n faskes tingkat 1 :".$data_bpjs[0]->faskes_1."\n NIK:".$data_bpjs[0]->nik;
            return ( $kalimat);
        }
    }
    public function panggil($no){
        
        $data_pendaftaran =  DB::select("select *  from tbl_antri_pendaftaran where id_antrian='".$no."'");

        $data_pendaftaran[0]->nama_poli = "Pendaftaran";

        print_r($data_pendaftaran);
        broadcast(new PanggilPendaftaranEvent($data_pendaftaran));
    }
}
