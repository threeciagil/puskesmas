<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\DB;
use App\Tbl_data_obat;
use App\Tbl_stok_obat;
use App\Events\PanggilFarmasiEvent;
class FarmasiController extends Controller
{
    //
   
    public function index()
    {
        if(!Session::get('user_data')){
            return redirect('/login');
        }else{
            $judul = 'PELAYANAN PASIEN';
            date_default_timezone_set('Asia/jakarta');
            $tanggal=date('Y-m-d');
            // $pasien = 
            // $antrian = DB::select("SELECT tbl_rekam_medis.no_rm, tbl_rekam_medis.id_pemeriksaan, tbl_antrian_poli_umums.status FROM tbl_antrian_poli_umums JOIN tbl_rekam_medis on tbl_antrian_poli_umums.no_rm = tbl_rekam_medis.no_rm where tbl_antrian_poli_umums.status='farmasi' AND tbl_antrian_poli_umums.created_at='2021-12-24'"); 
            $pasien = DB::select("SELECT * FROM tbl_rekam_medis a, tbl_antrian_farmasi b, tbl_datapasiens c where a.no_rm = b.no_rm and a.no_rm = c.no_rm AND b.status != 'selesai' AND b.status != 'hapus' AND a.tanggal_kunjungan='".$tanggal."'");
            $obat = DB::select("SELECT * FROM tbl_resep_obats JOIN tbl_resep_obat on tbl_resep_obats.id_resep = tbl_resep_obat.id_resep JOIN tbl_rekam_medis on tbl_resep_obat.id_pemeriksaan = tbl_rekam_medis.id_pemeriksaan WHERE tbl_rekam_medis.tanggal_kunjungan = '".$tanggal."' ");
            // $datapasien = $pasien =  DB::select("SELECT * FROM tbl_datapasiens a, tbl_rekam_medis b where a.no_rm=b.no_rm");
            // $obat = DB::select("SELECT * FROM tbl_resep_obats JOIN tbl_resep_obat on tbl_resep_obats.id_resep = tbl_resep_obat.id_resep "); 
            foreach($pasien as $pasiens){
                $pasiens->obat = array();

                foreach($obat as $obats){
                    if($pasiens->no_rm == $obats->no_rm){
                        array_push($pasiens->obat,$obats->nama_obat);
                        
                    }
                }
            }
            // print_r($pasiens);
            return view('farmasi/pelayanan/v_daftar_data_farmasi',['pasien' => $pasien, 'judul' => $judul]);
        }
    }

    public function panggil($no){
       
        $data_farmasi =  DB::select("select *  from tbl_antrian_farmasi where id_antrian='".$no."'");
        $data_farmasi[0]->nama_poli = "Farmasi";
        
        print_r($data_farmasi);
        broadcast(new PanggilFarmasiEvent($data_farmasi));
    
    }

    public function hapus($id){
        $antrian = DB::select("UPDATE tbl_antrian_farmasi set status='hapus' where id_antrian=".$id."");
        return redirect('/farmasi');
    }

    // public function pelayanan()
    // {
    //     $judul = 'PELAYANAN PASIEN';
    //     date_default_timezone_set('Asia/jakarta');
    //     $tanggal=date('Y-m-d');
        
    //     return view('pelayanan/v_pelayanan',['judul' => $judul]);
    // }
    // public function showtelaahobat()
    // {
    //     $judul = 'PELAYANAN PASIEN';
    //     date_default_timezone_set('Asia/jakarta');
    //     $tanggal=date('Y-m-d');
        
    //     return view('farmasi/pelayanan/v_telaah_obat',['judul' => $judul]);
    // }
    public function showtelaahresep($id1,$id2)
    {
        $judul = 'PELAYANAN PASIEN';
        date_default_timezone_set('Asia/jakarta');
        $tanggal=date('Y-m-d');
        $data = DB::select("select id_pemeriksaan from tbl_asuhan_keperawatan where no_rm='".$id2."' && id_pemeriksaan ='".$id1."'");
        $poli_asal = DB::select("select status, no_antrian from tbl_antrian_poli_umums where no_rm='".$id2."' && created_at ='".$tanggal."'"); 
        $pasien = DB::select("select * from tbl_datapasiens where no_rm='".$id2."'"); 
        $pasien[0]->poli_asal = $poli_asal[0]->status;
        $pasien[0]->no_antrian = $poli_asal[0]->no_antrian;
        $pasien[0]->tanggal = $tanggal;
        $pasien[0]->id_pemeriksaan = $data[0]->id_pemeriksaan;
        $obat = DB::select("SELECT * FROM tbl_resep_obats JOIN tbl_resep_obat on tbl_resep_obats.id_resep = tbl_resep_obat.id_resep JOIN tbl_rekam_medis on tbl_resep_obat.id_pemeriksaan = tbl_rekam_medis.id_pemeriksaan JOIN tbl_data_obat on tbl_resep_obats.id_obat=tbl_data_obat.id_obat WHERE tbl_rekam_medis.tanggal_kunjungan = '".$tanggal."' AND tbl_rekam_medis.id_pemeriksaan = '".$id1."' ");
        // $obat = DB::select("SELECT * FROM tbl_resep_obats JOIN tbl_resep_obat on tbl_resep_obats.id_resep = tbl_resep_obat.id_resep JOIN tbl_rekam_medis on tbl_resep_obat.id_pemeriksaan = tbl_rekam_medis.id_pemeriksaan JOIN tbl_data_obat on tbl_resep_obats.id_obat=tbl_data_obat.id_obat WHERE tbl_rekam_medis.tanggal_kunjungan = '".$tanggal."'");
        
        // print_r($obat);
        return view('farmasi/pelayanan/v_telaah_resep',['obat' => $obat,'pasien' => $pasien,'judul' => $judul]);
    }

    public function selesai($id)
    {   $judul = 'PELAYANAN PASIEN';
        date_default_timezone_set('Asia/jakarta');
        $tanggal=date('Y-m-d');
        $updatestatus = DB::select("UPDATE tbl_antrian_poli_umums set status ='selesai' where no_rm='".$id."' && created_at='".$tanggal."'");
        $updatestatus2 = DB::select("UPDATE tbl_antrian_farmasi set status ='selesai' where no_rm='".$id."' && tanggal='".$tanggal."'");
        $pasien = DB::select("SELECT * FROM tbl_rekam_medis a JOIN tbl_antrian_farmasi b on a.no_rm = b.no_rm where b.status='farmasi' AND b.tanggal='".$tanggal."'");
        $obat = DB::select("SELECT * FROM tbl_resep_obats JOIN tbl_resep_obat on tbl_resep_obats.id_resep = tbl_resep_obat.id_resep JOIN tbl_rekam_medis on tbl_resep_obat.id_pemeriksaan = tbl_rekam_medis.id_pemeriksaan WHERE tbl_rekam_medis.tanggal_kunjungan = '".$tanggal."' ");
        $stokobat = DB::select("SELECT * FROM tbl_data_stock_obat");
        // print_r($obat);
        
        foreach($stokobat as $stok){
            // $stok->pemakaian = array();
            // $stok->pengurangan = array();
            foreach($obat as $obats){
                if($obats->id_obat==$stok->id_obat){
                    $stok->pemakaian += $obats->jumlah;
                    $stok->sisa -= $obats->jumlah;
                    $updatepemakaian = DB::select("UPDATE tbl_data_stock_obat set pemakaian ='".$stok->pemakaian."' where id_obat='".$obats->id_obat."'");
                    $updatesisa = DB::select("UPDATE tbl_data_stock_obat set sisa ='".$stok->sisa."' where id_obat='".$obats->id_obat."'");
                }
            }
        }
        
        // print_r($stokobat);
        
        // $obat = DB::select("SELECT * FROM tbl_resep_obats JOIN tbl_resep_obat on tbl_resep_obats.id_resep = tbl_resep_obat.id_resep "); 
        // foreach($pasien as $pasiens){
        //     $pasiens->obat = array();
        //     foreach($obat as $obats){
        //         if($pasiens->no_rm = $obats->no_rm){
        //             array_push($pasiens->obat,$obats->nama_obat);
        //         }
        //     }
        // }
            // print_r($pasien);
        // return view('farmasi/pelayanan/v_daftar_data_farmasi',['pasien' => $pasien, 'judul' => $judul]);
        return  redirect ('/farmasi');
    // }
        // return view('farmasi/pelayanan/v_telaah_resep',['obat' => $obat,'pasien' => $pasien,'judul' => $judul]);
    }

    // public function showantrian()
    // {
    //     $judul = 'PELAYANAN PASIEN';
    //     date_default_timezone_set('Asia/jakarta');
    //     $tanggal=date('Y-m-d');
        
    //     return view('farmasi/pelayanan/v_daftar_data_farmasi',['judul' => $judul]);
    // }
    // public function showpelayanan()
    // {
    //     $judul = 'PELAYANAN PASIEN';
    //     date_default_timezone_set('Asia/jakarta');
    //     $tanggal=date('Y-m-d');
        
    //     return view('farmasi/pelayanan/v_pelayanan',['judul' => $judul]);
    // }
    public function showobat()
    {
        $judul = 'Data Obat';
        date_default_timezone_set('Asia/jakarta');
        $tanggal=date('Y-m-d');
        $dataobat = DB::select("SELECT * FROM tbl_data_obat WHERE status = 'tersedia'");
        return view('farmasi/kelolaobat/v_tabel_obat',['dataobat' => $dataobat,'judul' => $judul]);
    }
    public function showstokobat()
    {
        $judul = 'Stok Obat';
        date_default_timezone_set('Asia/jakarta');
        $tanggal=date('Y-m-d');
        $data = DB::select("SELECT * FROM tbl_data_obat JOIN tbl_data_stock_obat on tbl_data_stock_obat.id_obat=tbl_data_obat.id_obat WHERE tbl_data_stock_obat.status = 'tersedia' && tbl_data_obat.status = 'tersedia'");
        $dataobat = DB::select("SELECT * FROM tbl_data_obat WHERE status = 'tersedia'");
        $stokobat = DB::select("SELECT * FROM tbl_data_stock_obat WHERE status = 'tersedia'");
        return view('farmasi/kelolaobat/v_tabel_stok_obat',['data' => $data,'dataobat' => $dataobat,'stokobat' => $stokobat,'judul' => $judul]);
    }
    public function storedataobat(Request $request)
    {
        $tbl_data_obat= new Tbl_data_obat;
        $tbl_data_obat->nama_obat = $request->nama_obat;
        $tbl_data_obat->satuan= $request->satuan;
        $tbl_data_obat->status= "tersedia";
        $tbl_data_obat->save();
        return  redirect ('/tabelobat');
    }

    public function hapusobat($id)
    {
        $updateobat = DB::select("UPDATE tbl_data_obat set status ='hapus' where id_obat='$id'");
        return  redirect ('/tabelobat');
    }

    public function hapusstokobat($id)
    {
        $updateobat = DB::select("UPDATE tbl_data_stock_obat set status ='hapus' where id='$id'");
        return  redirect ('/stokobat');
    }

    public function storestockobat(Request $request)
    {
        date_default_timezone_set('Asia/jakarta');
        $tanggal=date('Y-m-d');
        
        $tbl_stok_obat= new Tbl_stok_obat;
        $tbl_stok_obat->id_obat = $request->id_obat;
        $tbl_stok_obat->jumlah_penerimaan = $request->stok_obat;
        $tbl_stok_obat->tanggal_masuk= $tanggal;
        $tbl_stok_obat->tanggal_kadaluarsa= $request->tanggal_kadaluarsa;
        $tbl_stok_obat->sisa= $request->stok_obat;
        $tbl_stok_obat->status= 'tersedia';
        $tbl_stok_obat->save();
        return  redirect ('/stokobat');
    }
    public function lewati($id)
    {
        date_default_timezone_set('Asia/jakarta');
        $tanggal=date('Y-m-d');
        $datas = DB::table("tbl_antrian_farmasi")
                ->whereDate('tanggal', '=', now())->get();
        $count = DB::table("tbl_antrian_farmasi")
                ->whereDate('tanggal', '=', now())->count();
        $data = DB::select("select * from tbl_antrian_farmasi where id_antrian=".$id."");        
        // print_r($data);
        $id1 = $id+1;
        $id2 = $id+2;
        $id3 = $id+3;
        $temp_id  = 99999996;
        $temp_id1 = 99999997;
        $temp_id2 = 99999998;
        $temp_id3 = 99999999;
        $id_akhir = $id3;
        $id1_akhir = $id;
        $id2_akhir = $id1;
        $id3_akhir = $id2;
        $urutan_awal = $data[0]->urutan;
        $urutan_akhir = $urutan_awal+3;
        if($count>4 && $urutan_akhir<$count){ 
            // $id1 = $id+1;
            // $id2 = $id+2;
            // $urutan_awal = $data[0]->urutan;
            // $urutan_akhir = $urutan_awal[0]+3;
            $data1 = $datas[$urutan_awal+1];
            $data2 = $datas[$urutan_awal+2];
            $data3 = $datas[$urutan_awal+3];
            $urutan_akhir1 = $data1->urutan-2;
            $urutan_akhir2 = $data2->urutan-2;
            $urutan_akhir3 = $data3->urutan-2;      
            $antrian = DB::select("UPDATE tbl_antrian_farmasi set status='lewati' where id_antrian=".$id."");
            $updatedata =  DB::select("UPDATE tbl_antrian_farmasi set urutan = $urutan_akhir where id_antrian=".$id."");
            $updatedata1 =  DB::select("UPDATE tbl_antrian_farmasi set urutan = $urutan_akhir1 where id_antrian=".$id1."");
            $updatedata2 =  DB::select("UPDATE tbl_antrian_farmasi set urutan = $urutan_akhir2 where id_antrian=".$id2."");
            $updatedata3 =  DB::select("UPDATE tbl_antrian_farmasi set urutan = $urutan_akhir3 where id_antrian=".$id3."");
            
            $updateid =  DB::select("UPDATE tbl_antrian_farmasi set id_antrian = $temp_id where id_antrian=".$id."");
            $updateid1 =  DB::select("UPDATE tbl_antrian_farmasi set id_antrian = $temp_id1 where id_antrian=".$id1."");
            $updateid2 =  DB::select("UPDATE tbl_antrian_farmasi set id_antrian = $temp_id2 where id_antrian=".$id2."");
            $updateid3 =  DB::select("UPDATE tbl_antrian_farmasi set id_antrian = $temp_id3 where id_antrian=".$id3."");

            $updateidakhir =  DB::select("UPDATE tbl_antrian_farmasi set id_antrian = $id_akhir where id_antrian=".$temp_id."");
            $updateidakhir1 =  DB::select("UPDATE tbl_antrian_farmasi set id_antrian = $id1_akhir where id_antrian=".$temp_id1."");
            $updateidakhir2 =  DB::select("UPDATE tbl_antrian_farmasi set id_antrian = $id2_akhir where id_antrian=".$temp_id2."");
            $updateidakhir3 =  DB::select("UPDATE tbl_antrian_farmasi set id_antrian = $id3_akhir where id_antrian=".$temp_id3."");       
                 
            
            
            // $antrian = DB::select("UPDATE tbl_antri_pendaftaran set status='lewati' where id_antrian=".$id."");
            // return redirect('/daftarantrian');
            return response()->json([
                'success' => true,
                'message' => 'Pasien dilewati',
            ]);
        }
        elseif($urutan_akhir==$count){
            $urutan_akhir=$count;
            $urutan_akhir1 = $count-3;
            $urutan_akhir2 = $count-2;   
            $urutan_akhir3 = $count-1;  
            // echo( $urutan_akhir2);
            // echo("\n");
            // echo( $urutan_akhir2);   
            $antrian = DB::select("UPDATE tbl_antrian_farmasi set status='lewati' where id_antrian=".$id."");
            $updatedata =  DB::select("UPDATE tbl_antrian_farmasi set urutan = $urutan_akhir where id_antrian=".$id."");
            $updatedata1 =  DB::select("UPDATE tbl_antrian_farmasi set urutan = $urutan_akhir1 where id_antrian=".$id1."");
            $updatedata2 =  DB::select("UPDATE tbl_antrian_farmasi set urutan = $urutan_akhir2 where id_antrian=".$id2."");
            $updatedata3 =  DB::select("UPDATE tbl_antrian_farmasi set urutan = $urutan_akhir3 where id_antrian=".$id3."");
            
            $updateid =  DB::select("UPDATE tbl_antrian_farmasi set id_antrian = $temp_id where id_antrian=".$id."");
            $updateid1 =  DB::select("UPDATE tbl_antrian_farmasi set id_antrian = $temp_id1 where id_antrian=".$id1."");
            $updateid2 =  DB::select("UPDATE tbl_antrian_farmasi set id_antrian = $temp_id2 where id_antrian=".$id2."");
            $updateid3 =  DB::select("UPDATE tbl_antrian_farmasi set id_antrian = $temp_id3 where id_antrian=".$id3."");

            $updateidakhir =  DB::select("UPDATE tbl_antrian_farmasi set id_antrian = $id_akhir where id_antrian=".$temp_id."");
            $updateidakhir1 =  DB::select("UPDATE tbl_antrian_farmasi set id_antrian = $id1_akhir where id_antrian=".$temp_id1."");
            $updateidakhir2 =  DB::select("UPDATE tbl_antrian_farmasi set id_antrian = $id2_akhir where id_antrian=".$temp_id2."");            
            $updateidakhir3 =  DB::select("UPDATE tbl_antrian_farmasi set id_antrian = $id3_akhir where id_antrian=".$temp_id3."");            
            
            return response()->json([
                'success' => true,
                'message' => 'Pasien dilewati',
            ]);
        }
        elseif($urutan_akhir==$count+1){
            // $id_akhir = $count;
            $urutan_akhir=$count;
            // $urutan_akhir1 = $count-3;
            $urutan_akhir2 = $count-2;   
            $urutan_akhir3 = $count-1;
            // echo($urutan_akhir2);
            // echo($urutan_akhir3); 
            // echo( $urutan_akhir2);
            // echo("\n");
            // echo( $urutan_akhir2);   
            $antrian = DB::select("UPDATE tbl_antrian_farmasi set status='lewati' where id_antrian=".$id."");
            $updatedata =  DB::select("UPDATE tbl_antrian_farmasi set urutan = $urutan_akhir where id_antrian=".$id."");
            // $updatedata1 =  DB::select("UPDATE tbl_antri_pendaftaran set urutan = $urutan_akhir1 where id_antrian=".$id1."");
            $updatedata2 =  DB::select("UPDATE tbl_antrian_farmasi set urutan = $urutan_akhir2 where id_antrian=".$id1."");
            $updatedata3 =  DB::select("UPDATE tbl_antrian_farmasi set urutan = $urutan_akhir3 where id_antrian=".$id2."");
            
            $updateid =  DB::select("UPDATE tbl_antrian_farmasi set id_antrian = $temp_id where id_antrian=".$id."");
            // $updateid1 =  DB::select("UPDATE tbl_antri_pendaftaran set id_antrian = $temp_id1 where id_antrian=".$id1."");
            $updateid2 =  DB::select("UPDATE tbl_antrian_farmasi set id_antrian = $temp_id2 where id_antrian=".$id1."");
            $updateid3 =  DB::select("UPDATE tbl_antrian_farmasi set id_antrian = $temp_id3 where id_antrian=".$id2."");

            $updateidakhir =  DB::select("UPDATE tbl_antrian_farmasi set id_antrian = $id_akhir where id_antrian=".$temp_id."");
            // $updateidakhir1 =  DB::select("UPDATE tbl_antri_pendaftaran set id_antrian = $id1_akhir where id_antrian=".$temp_id1."");
            $updateidakhir2 =  DB::select("UPDATE tbl_antrian_farmasi set id_antrian = $id1_akhir where id_antrian=".$temp_id2."");            
            $updateidakhir3 =  DB::select("UPDATE tbl_antrian_farmasi set id_antrian = $id2_akhir where id_antrian=".$temp_id3."");            
            $updateidakhir4 =  DB::select("UPDATE tbl_antrian_farmasi set id_antrian = $id_akhir-1 where id_antrian=".$id_akhir."");    

            return response()->json([
                'success' => true,
                'message' => 'Pasien dilewati',
            ]);
        }
        elseif($urutan_akhir==$count+2){
            // $id_akhir=$count;
            $urutan_akhir=$count;
            $urutan_akhir1 = $urutan_awal;
            $urutan_akhir2 = $count-1;   
            // echo( $urutan_akhir2);
            // echo("\n");
            // echo( $urutan_akhir2);   
            $antrian = DB::select("UPDATE tbl_antrian_farmasi set status='lewati' where id_antrian=".$id."");
            $updatedata =  DB::select("UPDATE tbl_antrian_farmasi set urutan = $urutan_akhir where id_antrian=".$id."");
            $updatedata1 =  DB::select("UPDATE tbl_antrian_farmasi set urutan = $urutan_akhir1 where id_antrian=".$id1."");
            $updatedata2 =  DB::select("UPDATE tbl_antrian_farmasi set urutan = $urutan_akhir2 where id_antrian=".$id2."");
            
            $updateid =  DB::select("UPDATE tbl_antrian_farmasi set id_antrian = $temp_id where id_antrian=".$id."");
            $updateid1 =  DB::select("UPDATE tbl_antrian_farmasi set id_antrian = $temp_id1 where id_antrian=".$id1."");
            $updateid2 =  DB::select("UPDATE tbl_antrian_farmasi set id_antrian = $temp_id2 where id_antrian=".$id2."");
            
            $updateidakhir =  DB::select("UPDATE tbl_antrian_farmasi set id_antrian = $id_akhir where id_antrian=".$temp_id."");
            $updateidakhir1 =  DB::select("UPDATE tbl_antrian_farmasi set id_antrian = $id1_akhir where id_antrian=".$temp_id1."");
            $updateidakhir2 =  DB::select("UPDATE tbl_antrian_farmasi set id_antrian = $id2_akhir where id_antrian=".$temp_id2."");            
            $updateidakhir4 =  DB::select("UPDATE tbl_antrian_farmasi set id_antrian = $id_akhir-2 where id_antrian=".$id_akhir."");
            // $updatedata2 =  DB::select("UPDATE tbl_antri_pendaftaran set urutan = $urutan_akhir2 where id_antrian=".$id2."");
            return response()->json([
                'success' => true,
                'message' => 'Pasien dilewati',
            ]);
        }
        elseif($data[0]->urutan==$count){
            return response()->json([
                'success' => true,
                'message' => 'Pasien ini berada di nomor terakhir',
            ]);
        }
        // return redirect('/daftarantrian');
    }
    public function showlaporanlidi()
    {
        $judul = 'PELAYANAN PASIEN';
        date_default_timezone_set('Asia/jakarta');
        $tanggal=date('Y-m-d');
        // Jenis Kunjungan Dalam 1 Tahun(baru/lama),Tanggal, poli_yang_dituju
        $datas =  DB::select("SELECT tbl_datapasiens.nama,tbl_datapasiens.nama_kk,tbl_datapasiens.alamat,tbl_datapasiens.no_rm,tbl_datapasiens.jenis_kelamin,tbl_datapasiens.umur,tbl_datapasiens.jenis_asuransi, kasir.total_pembayaran, kasir.id_pemeriksaan, tbl_pendaftarans.tanggal, tbl_pendaftarans.tipe_kunjungan, tbl_pendaftarans.poli_yang_dituju, tbl_pendaftarans.waktu_pelayanan FROM tbl_pendaftarans,tbl_datapasiens,kasir where tbl_datapasiens.no_rm = kasir.no_rm && tbl_datapasiens.no_rm = tbl_pendaftarans.no_rm");
        $data =  DB::select("SELECT * FROM tbl_datapasiens, kasir where tbl_datapasiens.no_rm = kasir.no_rm");
        $pendaftaran =  DB::select("SELECT * FROM tbl_pendaftarans");
        $kasir =  DB::select("SELECT * FROM kasir");
        $obat = DB::select("SELECT tbl_resep_obats.nama_obat, tbl_resep_obat.id_pemeriksaan, tbl_resep_obats.id_resep,tbl_resep_obats.jumlah FROM tbl_resep_obats JOIN tbl_resep_obat on tbl_resep_obats.id_resep = tbl_resep_obat.id_resep  JOIN tbl_data_obat on tbl_resep_obats.id_obat=tbl_data_obat.id_obat ");
        $rm =  DB::select("SELECT * FROM tbl_rekam_medis");
        foreach($data as $d){
            foreach($pendaftaran as $p){
                if($d->no_rm == $p->no_rm){
                    $d->tanggal = $p->tanggal;
                    $d->tipe_kunjungan = $p->tipe_kunjungan;
                    $d->poli_yang_dituju = $p->poli_yang_dituju;
                    $d->waktu_pelayanan = $p->waktu_pelayanan;
                }
            } 
        }

        // foreach ($obat as $obats) {
        //     foreach($obat as $obats){
        //         if($r->id_pemeriksaan == $obats->id_pemeriksaan  )
        //             array_push($r->nama_obat , $obats->nama_obat);
        //             array_push($r->jumlah , $obats->jumlah);
        //     } 
        // }
        // print_r($rm);
        return view('farmasi/datalaporan/v_laporanlidi',['data' => $data,'obat' => $obat, 'judul' => $judul]);
    }

    public function exportLidi()
    {
        $fileName = 'laporan Lidi.csv';
        $data =  DB::select("SELECT * FROM tbl_datapasiens, kasir where tbl_datapasiens.no_rm = kasir.no_rm");
        $pendaftaran =  DB::select("SELECT * FROM tbl_pendaftarans");
        $kasir =  DB::select("SELECT * FROM kasir");
        $obat = DB::select("SELECT tbl_resep_obats.nama_obat, tbl_resep_obat.id_pemeriksaan, tbl_resep_obats.id_resep,tbl_resep_obats.jumlah FROM tbl_resep_obats JOIN tbl_resep_obat on tbl_resep_obats.id_resep = tbl_resep_obat.id_resep  JOIN tbl_data_obat on tbl_resep_obats.id_obat=tbl_data_obat.id_obat ");
        $rm =  DB::select("SELECT * FROM tbl_rekam_medis");
        // print_r($data);
        foreach($data as $d){
            foreach($pendaftaran as $p){
                if($d->no_rm == $p->no_rm){
                    $d->tanggal = $p->tanggal;
                    $d->tipe_kunjungan = $p->tipe_kunjungan;
                    $d->poli_yang_dituju = $p->poli_yang_dituju;
                    $d->waktu_pelayanan = $p->waktu_pelayanan;
                }
            } 
            $d->nama_obat = array();
            $d->jumlah = array();
            foreach($obat as $o){
                if($d->id_pemeriksaan == $o->id_pemeriksaan){
                    array_push($d->nama_obat, $o->nama_obat);
                    array_push($d->jumlah, $o->jumlah);
                }
            } 
        } 
        // print_r($data);
        $j=0;
        
        // for($i=0; $i<count($dataobats); $i++){
        //     for($j=0; $j<count($data); $j++){
        //         $data[$j]->obat = array();
        //         if($data[$j]->id_pemeriksaan ==  $dataobats[$i]->id_pemeriksaan){
        //             array_push($data[$j]->obat, $dataobats[$i]->nama_obat);
        //         }
        //     }
        // }
        // print_r($data);
        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );
        // $columns = array('Tanggal','Poli Asal',' Nama Pasien',' Jenis Kelamin', 'Umur', 'Total', 'Jenis Kunjungan(BPJS/Umum)', 'Jenis Kunjungan Dalam 1 Tahun(baru/lama)' );
        $columns = array('Tanggal','Poli Asal',' Nama Pasien','Nomor Rekam Medis','Nama Kepala Keluarga','Alamat',' Jenis Kelamin', 'Umur','Nama Obat','Total','Jenis Kunjungan(BPJS/Umum)','Waktu Pelayanan','Jenis Kunjungan Dalam 1 Tahun(baru/lama)' );

        $callback = function() use($data, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($data as $datas) {
                $row['Tanggal']  = $datas->tanggal;
                $row['Poli Asal']    = $datas->poli_yang_dituju;
                $row['Nama Pasien']    = $datas->nama;
                $row['Nomor Rekam Medis']  = $datas->no_rm;
                $row['Nama Kepala Keluargal']  = $datas->nama_kk;
                $row['Alamat']  = $datas->alamat;
                $row['Jenis Kelamin']  = $datas->jenis_kelamin;
                $row['Umur']  = $datas->umur;
                $row['Nama Obat']   = implode(', ',$datas->nama_obat);
                $row['Total'] =  implode(', ',$datas->jumlah);
                $row['Jenis Kunjungan(BPJS/Umum)']   = $datas->jenis_asuransi;
                $row['Waktu Pelayanan'] = $datas->waktu_pelayanan;
                $row['Jenis Kunjungan Dalam 1 Tahun(baru/lama)']  = $datas->tipe_kunjungan;
               
                fputcsv($file, array($row['Tanggal'], $row['Poli Asal'], $row['Nama Pasien'], $row['Nomor Rekam Medis'], $row['Nama Kepala Keluargal'], $row['Alamat'], $row['Jenis Kelamin'], $row['Umur'], $row['Nama Obat'], $row['Total'],  $row['Jenis Kunjungan(BPJS/Umum)'],$row['Waktu Pelayanan'], $row['Jenis Kunjungan Dalam 1 Tahun(baru/lama)']));
                
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function showlaporanlplpo()
    {
        $judul = 'PELAYANAN PASIEN';
        date_default_timezone_set('Asia/jakarta');
        $tanggal=date('Y-m-d');
        $dataobats = DB::select("SELECT * FROM tbl_data_obat,tbl_data_stock_obat where  tbl_data_obat.id_obat = tbl_data_stock_obat.id_obat && tbl_data_stock_obat.status = 'tersedia' && tbl_data_obat.status = 'tersedia'");
        
        return view('farmasi/datalaporan/v_lplpo',['dataobats' => $dataobats,'judul' => $judul]);
    }

    public function exportLplpo()
    {
        $fileName = 'laporan LPLPO.csv';
        $dataobats = DB::select("SELECT * FROM tbl_data_obat,tbl_data_stock_obat where  tbl_data_obat.id_obat = tbl_data_stock_obat.id_obat && tbl_data_stock_obat.status = 'tersedia' && tbl_data_obat.status = 'tersedia'");
        $j=0;
        
        // for($i=0; $i<count($dataobats); $i++){
        //     for($j=0; $j<count($data); $j++){
        //         $data[$j]->obat = array();
        //         if($data[$j]->id_pemeriksaan ==  $dataobats[$i]->id_pemeriksaan){
        //             array_push($data[$j]->obat, $dataobats[$i]->nama_obat);
        //         }
        //     }
        // }
        // print_r($data);
        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );
        // $columns = array('Tanggal','Poli Asal',' Nama Pasien',' Jenis Kelamin', 'Umur', 'Total', 'Jenis Kunjungan(BPJS/Umum)', 'Jenis Kunjungan Dalam 1 Tahun(baru/lama)' );
        $columns = array('Nama Obat','Satuan',' Stok Awal','Penerimaan', 'Persediaan', 'Pemakaian', 'Sisa Stok');

        $callback = function() use($dataobats, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($dataobats as $datas) {
                $row['Nama Obat']  = $datas->nama_obat;
                $row['Satuan']    = $datas->satuan;
                $row['Stok Awal']    = $datas->jumlah_penerimaan;
                $row['Penerimaan']  = $datas->jumlah_penerimaan;
                $row['Persediaan']  = $datas->sisa;
                $row['Pemakaian']  = $datas->pemakaian;
                $row['Sisa Stok']  = $datas->sisa;
                
                fputcsv($file, array($row['Nama Obat'], $row['Satuan'] , $row['Stok Awal'], $row['Penerimaan'], $row['Persediaan'],$row['Pemakaian'], $row['Sisa Stok']));
                
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function exportStock()
    {
        $fileName = 'laporan Stock Obat.csv';
        $dataobats = DB::select("SELECT * FROM tbl_data_obat,tbl_data_stock_obat where  tbl_data_obat.id_obat = tbl_data_stock_obat.id_obat && tbl_data_stock_obat.status = 'tersedia' && tbl_data_obat.status = 'tersedia'");
        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );
        // $columns = array('Tanggal','Poli Asal',' Nama Pasien',' Jenis Kelamin', 'Umur', 'Total', 'Jenis Kunjungan(BPJS/Umum)', 'Jenis Kunjungan Dalam 1 Tahun(baru/lama)' );
        $columns = array('Nama Obat','Satuan',' Tanggal','Expired Date', 'Jumlah Masuk', 'Jumlah Keluar', 'Sisa Stok', 'Keterangan');

        $callback = function() use($dataobats, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($dataobats as $datas) {
                $row['Nama Obat']  = $datas->nama_obat;
                $row['Satuan']    = $datas->satuan;
                $row['Tanggal']    = $datas->tanggal_masuk;
                $row['Expired Date']    = $datas->tanggal_kadaluarsa;
                $row['Jumlah Masuk']  = $datas->jumlah_penerimaan;
                $row['Jumlah Keluar']  = $datas->pemakaian;
                $row['Sisa Stok']  = $datas->sisa;
                if($datas->sisa==0){
                    $row['Keterangan']  = "Habis";
                }else{
                    $row['Keterangan']  = "Tersedia";
                }
                
                
                fputcsv($file, array($row['Nama Obat'], $row['Satuan'] , $row['Tanggal'], $row['Expired Date'], $row['Jumlah Masuk'],$row['Jumlah Keluar'], $row['Sisa Stok'], $row['Keterangan']));
                
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function showlaporanstok()
    {
        $judul = 'PELAYANAN PASIEN';
        date_default_timezone_set('Asia/jakarta');
        $tanggal=date('Y-m-d');
        $dataobats = DB::select("SELECT * FROM tbl_data_obat,tbl_data_stock_obat where  tbl_data_obat.id_obat = tbl_data_stock_obat.id_obat && tbl_data_stock_obat.status = 'tersedia' && tbl_data_obat.status = 'tersedia'");

        
        return view('farmasi/datalaporan/v_stock',['dataobats' => $dataobats, 'judul' => $judul]);
    }

    // public function showlaporantelaah()
    // {
    //     $judul = 'PELAYANAN PASIEN';
    //     date_default_timezone_set('Asia/jakarta');
    //     $tanggal=date('Y-m-d');
    //     $data  = DB::select("SELECT * FROM tbl_antrian_poli_umums, tbl_datapasiens where tbl_antrian_poli_umums.no_rm = tbl_datapasiens.no_rm AND tbl_antrian_poli_umums.status = 'selesai'");
    //     return view('farmasi/datalaporan/v_laporantelaah',['data' => $data,'judul' => $judul]);
    // }

    // public function exportTelaah()
    // {
    //     $fileName = 'laporan Telaah Pasien.csv';
    //     $data  = DB::select("SELECT * FROM tbl_antrian_poli_umums, tbl_datapasiens where tbl_antrian_poli_umums.no_rm = tbl_datapasiens.no_rm AND tbl_antrian_poli_umums.status = 'selesai'");
    //     $headers = array(
    //         "Content-type"        => "text/csv",
    //         "Content-Disposition" => "attachment; filename=$fileName",
    //         "Pragma"              => "no-cache",
    //         "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
    //         "Expires"             => "0"
    //     );
    //     // $columns = array('Tanggal','Poli Asal',' Nama Pasien',' Jenis Kelamin', 'Umur', 'Total', 'Jenis Kunjungan(BPJS/Umum)', 'Jenis Kunjungan Dalam 1 Tahun(baru/lama)' );
    //     $columns = array('Tanggal','Poli Asal','Nama Pasien','Jenis Kelamin', 'Umur');

    //     $callback = function() use($data, $columns) {
    //         $file = fopen('php://output', 'w');
    //         fputcsv($file, $columns);

    //         foreach ($data as $datas) {
    //             $row['Tanggal']  = $datas->created_at;
    //             $row['Poli Asal']    = $datas->poli_asal;
    //             $row['Nama Pasien']    = $datas->nama;
    //             $row['Jenis Kelamin']    = $datas->jenis_kelamin;
    //             $row['Umur']  = $datas->umur;             
                
    //             fputcsv($file, array($row['Tanggal'], $row['Poli Asal'] , $row['Nama Pasien'], $row['Jenis Kelamin'], $row['Umur']));
    //         }

    //         fclose($file);
    //     };

    //     return response()->stream($callback, 200, $headers);
    // }

    public function showhistory()
    {
        $judul = 'PELAYANAN PASIEN';
        date_default_timezone_set('Asia/jakarta');

        $tanggal=date('Y-m-d');
        $antrian = DB::select("SELECT * FROM tbl_antrian_farmasi WHERE status = 'selesai' ");
        $pasien = DB::select("SELECT * FROM tbl_datapasiens a, tbl_antrian_farmasi b WHERE b.status = 'selesai' AND a.no_rm = b.no_rm");
        $obats = DB::select("SELECT tbl_resep_obats.nama_obat, tbl_resep_obat.id_pemeriksaan, tbl_resep_obats.id_resep, tbl_rekam_medis.no_rm FROM tbl_resep_obats JOIN tbl_resep_obat on tbl_resep_obats.id_resep = tbl_resep_obat.id_resep JOIN tbl_rekam_medis on tbl_resep_obat.id_pemeriksaan = tbl_rekam_medis.id_pemeriksaan JOIN tbl_data_obat on tbl_resep_obats.id_obat=tbl_data_obat.id_obat WHERE tbl_rekam_medis.tanggal_kunjungan = '".$tanggal."'  ");
        $obat = DB::select("SELECT tbl_resep_obats.nama_obat, tbl_resep_obat.id_pemeriksaan, tbl_resep_obats.id_resep FROM tbl_resep_obats JOIN tbl_resep_obat on tbl_resep_obats.id_resep = tbl_resep_obat.id_resep  JOIN tbl_data_obat on tbl_resep_obats.id_obat=tbl_data_obat.id_obat ");
        $rm = DB::select("SELECT * FROM tbl_rekam_medis ");

        foreach($obat as $o){
            foreach($rm as $r){
                if($o->id_pemeriksaan == $r->id_pemeriksaan){
                    $o->no_rm = $r->no_rm;
                }
            }
        }

        // print_r($obat);
        // echo(count($obat));
        for($i=0;$i<count($pasien);$i++){
            $pasien[$i]->obat = array();
            for($j=0;$j<count($obat);$j++){
                if($pasien[$i]->no_rm == $obat[$j]->no_rm){                   
                    array_push($pasien[$i]->obat , $obat[$j]->nama_obat);
                }
            }
        }
        // print_r($pasien);
        // echo("<br><br>");
        // print_r($pasien);
        
        // tanggal,no antrian, rm, nama, kelamin,obat, poli asal, asuransi,status
        return view('farmasi/pelayanan/v_history',['data' => $pasien, 'judul' => $judul]);
    }
}
