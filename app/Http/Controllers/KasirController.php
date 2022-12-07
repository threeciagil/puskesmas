<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Tbl_kasir;
use App\Events\PanggilKasirEvent;
use App\Tbl_antrian_farmasi;
use Illuminate\Support\Facades\DB;
class KasirController extends Controller
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
            $antrian = DB::select("SELECT * FROM tbl_antrian_kasir  where status!='selesai' AND status!='hapus' AND tanggal='".$tanggal."'");
            // $antrian = DB::select("SELECT * FROM tbl_antrian_poli_umums  where status='pembayaran' AND created_at='".$tanggal."'"); 
            $pasien = DB::select("SELECT a.jenis_asuransi, a.no_rm, a.nama  FROM tbl_datapasiens a JOIN tbl_antrian_kasir b on a.no_rm = b.no_rm  where b.status!='selesai'");
            $ambil_id = DB::select("SELECT a.id_pemeriksaan, a.no_rm  FROM tbl_rekam_medis a, tbl_antrian_kasir b where a.no_rm = b.no_rm AND b.status!='selesai' AND a.tanggal_kunjungan='".$tanggal."'");
            foreach($pasien as $pasiens){
                foreach($ambil_id as $ambil_ids){
                    if($pasiens->no_rm == $ambil_ids->no_rm){
                        $pasiens->id_pemeriksaan = $ambil_ids->id_pemeriksaan;
                    }
                }
            }
            
            foreach($antrian as $antrians){
                foreach($pasien as $pasiens){
                    if($pasiens->no_rm == $antrians->no_rm){
                        $antrians->jenis_asuransi = $pasiens->jenis_asuransi;
                        $antrians->id_pemeriksaan = $pasiens->id_pemeriksaan;
                        $antrians->nama = $pasiens-> nama;
                    }
                }
            }
            // $antrian = DB::select("SELECT * FROM tbl_antrian_poli_umums JOIN tbl_datapasiens on tbl_antrian_poli_umums.no_rm = tbl_datapasiens.no_rm JOIN tbl_rekam_medis on tbl_antrian_poli_umums.no_rm = tbl_rekam_medis.no_rm where tbl_antrian_poli_umums.status='pembayaran' AND tbl_antrian_poli_umums.created_at='2021-12-24'"); 
            // $dataobat = DB::select("SELECT * FROM tbl_data_obat JOIN tbl_data_stock_ obat on tbl_data_stock_obat.id_obat=tbl_data_obat.id_obat where tbl_data_stock_obat.jumlah_penerimaan!=0");
            // echo($tanggal);
            // print_r($antrian);

            return view('kasir/v_daftarantriankasir',['antrian' => $antrian,'judul' => $judul]);
        }
    }
    
    public function lewati($id)
    {
        date_default_timezone_set('Asia/jakarta');
        $tanggal=date('Y-m-d');
        $datas = DB::table("tbl_antrian_kasir")
                ->whereDate('tanggal', '=', now())->get();
        $count = DB::table("tbl_antrian_kasir")
                ->whereDate('tanggal', '=', now())->count();
        $data = DB::select("select * from tbl_antrian_kasir where id_antrian=".$id."");        
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
            $antrian = DB::select("UPDATE tbl_antrian_kasir set status='lewati' where id_antrian=".$id."");
            $updatedata =  DB::select("UPDATE tbl_antrian_kasir set urutan = $urutan_akhir where id_antrian=".$id."");
            $updatedata1 =  DB::select("UPDATE tbl_antrian_kasir set urutan = $urutan_akhir1 where id_antrian=".$id1."");
            $updatedata2 =  DB::select("UPDATE tbl_antrian_kasir set urutan = $urutan_akhir2 where id_antrian=".$id2."");
            $updatedata3 =  DB::select("UPDATE tbl_antrian_kasir set urutan = $urutan_akhir3 where id_antrian=".$id3."");
            
            $updateid =  DB::select("UPDATE tbl_antrian_kasir set id_antrian = $temp_id where id_antrian=".$id."");
            $updateid1 =  DB::select("UPDATE tbl_antrian_kasir set id_antrian = $temp_id1 where id_antrian=".$id1."");
            $updateid2 =  DB::select("UPDATE tbl_antrian_kasir set id_antrian = $temp_id2 where id_antrian=".$id2."");
            $updateid3 =  DB::select("UPDATE tbl_antrian_kasir set id_antrian = $temp_id3 where id_antrian=".$id3."");

            $updateidakhir =  DB::select("UPDATE tbl_antrian_kasir set id_antrian = $id_akhir where id_antrian=".$temp_id."");
            $updateidakhir1 =  DB::select("UPDATE tbl_antrian_kasir set id_antrian = $id1_akhir where id_antrian=".$temp_id1."");
            $updateidakhir2 =  DB::select("UPDATE tbl_antrian_kasir set id_antrian = $id2_akhir where id_antrian=".$temp_id2."");
            $updateidakhir3 =  DB::select("UPDATE tbl_antrian_kasir set id_antrian = $id3_akhir where id_antrian=".$temp_id3."");       
                 
            
            
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
            $antrian = DB::select("UPDATE tbl_antrian_kasir set status='lewati' where id_antrian=".$id."");
            $updatedata =  DB::select("UPDATE tbl_antrian_kasir set urutan = $urutan_akhir where id_antrian=".$id."");
            $updatedata1 =  DB::select("UPDATE tbl_antrian_kasir set urutan = $urutan_akhir1 where id_antrian=".$id1."");
            $updatedata2 =  DB::select("UPDATE tbl_antrian_kasir set urutan = $urutan_akhir2 where id_antrian=".$id2."");
            $updatedata3 =  DB::select("UPDATE tbl_antrian_kasir set urutan = $urutan_akhir3 where id_antrian=".$id3."");
            
            $updateid =  DB::select("UPDATE tbl_antrian_kasir set id_antrian = $temp_id where id_antrian=".$id."");
            $updateid1 =  DB::select("UPDATE tbl_antrian_kasir set id_antrian = $temp_id1 where id_antrian=".$id1."");
            $updateid2 =  DB::select("UPDATE tbl_antrian_kasir set id_antrian = $temp_id2 where id_antrian=".$id2."");
            $updateid3 =  DB::select("UPDATE tbl_antrian_kasir set id_antrian = $temp_id3 where id_antrian=".$id3."");

            $updateidakhir =  DB::select("UPDATE tbl_antrian_kasir set id_antrian = $id_akhir where id_antrian=".$temp_id."");
            $updateidakhir1 =  DB::select("UPDATE tbl_antrian_kasir set id_antrian = $id1_akhir where id_antrian=".$temp_id1."");
            $updateidakhir2 =  DB::select("UPDATE tbl_antrian_kasir set id_antrian = $id2_akhir where id_antrian=".$temp_id2."");            
            $updateidakhir3 =  DB::select("UPDATE tbl_antrian_kasir set id_antrian = $id3_akhir where id_antrian=".$temp_id3."");            
            
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
            $antrian = DB::select("UPDATE tbl_antrian_kasir set status='lewati' where id_antrian=".$id."");
            $updatedata =  DB::select("UPDATE tbl_antrian_kasir set urutan = $urutan_akhir where id_antrian=".$id."");
            // $updatedata1 =  DB::select("UPDATE tbl_antri_pendaftaran set urutan = $urutan_akhir1 where id_antrian=".$id1."");
            $updatedata2 =  DB::select("UPDATE tbl_antrian_kasir set urutan = $urutan_akhir2 where id_antrian=".$id1."");
            $updatedata3 =  DB::select("UPDATE tbl_antrian_kasir set urutan = $urutan_akhir3 where id_antrian=".$id2."");
            
            $updateid =  DB::select("UPDATE tbl_antrian_kasir set id_antrian = $temp_id where id_antrian=".$id."");
            // $updateid1 =  DB::select("UPDATE tbl_antri_pendaftaran set id_antrian = $temp_id1 where id_antrian=".$id1."");
            $updateid2 =  DB::select("UPDATE tbl_antrian_kasir set id_antrian = $temp_id2 where id_antrian=".$id1."");
            $updateid3 =  DB::select("UPDATE tbl_antrian_kasir set id_antrian = $temp_id3 where id_antrian=".$id2."");

            $updateidakhir =  DB::select("UPDATE tbl_antrian_kasir set id_antrian = $id_akhir where id_antrian=".$temp_id."");
            // $updateidakhir1 =  DB::select("UPDATE tbl_antri_pendaftaran set id_antrian = $id1_akhir where id_antrian=".$temp_id1."");
            $updateidakhir2 =  DB::select("UPDATE tbl_antrian_kasir set id_antrian = $id1_akhir where id_antrian=".$temp_id2."");            
            $updateidakhir3 =  DB::select("UPDATE tbl_antrian_kasir set id_antrian = $id2_akhir where id_antrian=".$temp_id3."");            
            $updateidakhir4 =  DB::select("UPDATE tbl_antrian_kasir set id_antrian = $id_akhir-1 where id_antrian=".$id_akhir."");
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
            $antrian = DB::select("UPDATE tbl_antrian_kasir set status='lewati' where id_antrian=".$id."");
            $updatedata =  DB::select("UPDATE tbl_antrian_kasir set urutan = $urutan_akhir where id_antrian=".$id."");
            $updatedata1 =  DB::select("UPDATE tbl_antrian_kasir set urutan = $urutan_akhir1 where id_antrian=".$id1."");
            $updatedata2 =  DB::select("UPDATE tbl_antrian_kasir set urutan = $urutan_akhir2 where id_antrian=".$id2."");
            
            $updateid =  DB::select("UPDATE tbl_antrian_kasir set id_antrian = $temp_id where id_antrian=".$id."");
            $updateid1 =  DB::select("UPDATE tbl_antrian_kasir set id_antrian = $temp_id1 where id_antrian=".$id1."");
            $updateid2 =  DB::select("UPDATE tbl_antrian_kasir set id_antrian = $temp_id2 where id_antrian=".$id2."");
            
            $updateidakhir =  DB::select("UPDATE tbl_antrian_kasir set id_antrian = $id_akhir where id_antrian=".$temp_id."");
            $updateidakhir1 =  DB::select("UPDATE tbl_antrian_kasir set id_antrian = $id1_akhir where id_antrian=".$temp_id1."");
            $updateidakhir2 =  DB::select("UPDATE tbl_antrian_kasir set id_antrian = $id2_akhir where id_antrian=".$temp_id2."");            
            $updateidakhir3 =  DB::select("UPDATE tbl_antrian_kasir set id_antrian = $id_akhir-2 where id_antrian=".$id_akhir."");
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
        // $data1 = $data[0];
        // $antrian = DB::select("UPDATE tbl_antri_pendaftaran set status='lewati' where id_antrian=".$id."");
        // $updatedata1 =  DB::select("UPDATE tbl_antri_pendaftaran set urutan = $urutan_akhir where id_antrian=".$id."");
        // $updatedata1 =  DB::select("UPDATE tbl_antri_pendaftaran set urutan = $urutan_akhir1 where id_antrian=".$id1."");
        // $updatedata2 =  DB::select("UPDATE tbl_antri_pendaftaran set urutan = $urutan_akhir2 where id_antrian=".$id2."");
        // // $antrian = DB::select("UPDATE tbl_antri_pendaftaran set status='lewati' where id_antrian=".$id."");
        // return redirect('/daftarantrian');
    }

    public function panggil($no){
       
        $data_kasir =  DB::select("select *  from tbl_antrian_kasir where id_antrian='".$no."'");
        $data_kasir[0]->nama_poli = "Kasir";
        
        print_r($data_kasir);
        broadcast(new PanggilKasirEvent($data_kasir));
    
    }

    public function hapus($id){
        $antrian = DB::select("UPDATE tbl_antrian_kasir set status='hapus' where id_antrian=".$id."");
        return redirect('/kasir');
    }
    public function showpelayanankasir($id1,$id2)
    {
        $judul = 'PELAYANAN PASIEN';
        date_default_timezone_set('Asia/jakarta');
        $tanggal=date('Y-m-d');
        $data = DB::select("select id_pemeriksaan from tbl_asuhan_keperawatan where no_rm='".$id2."' && id_pemeriksaan ='".$id1."'");
        $poli_asal = DB::select("select poli_asal, no_antrian from tbl_antrian_poli_umums where no_rm='".$id2."' && created_at ='".$tanggal."'"); 
        $pasien = DB::select("select * from tbl_datapasiens where no_rm='".$id2."'"); 
        // echo ($id2);
        // print_r($data);
        $pasien[0]->poli_asal = $poli_asal[0]->poli_asal;
        $pasien[0]->no_antrian = $poli_asal[0]->no_antrian;
        $pasien[0]->tanggal = $tanggal;
        $pasien[0]->id_pemeriksaan = $data[0]->id_pemeriksaan;
        $tindakan_rm = DB::select("SELECT * FROM tbl_tindakan_rm JOIN tbl_data_tindakan on tbl_tindakan_rm.tindakan = tbl_data_tindakan.nama_tindakan where tbl_tindakan_rm.no_rm='".$id2."' && tbl_tindakan_rm.status!='hapus'"); 
        $pemeriksaan = DB::select("SELECT * FROM tbl_permintaanlab JOIN tbl_data_laborat_dokter on tbl_permintaanlab.id_data_laborat_dokter=tbl_data_laborat_dokter.id_data_laborat_dokter where tbl_permintaanlab.id_pemeriksaan ='".$id1."'");
        
        // if($pasien[0]->jenis_asuransi == "BPJS"){
        //     for($i=0;$i<count($tindakan_rm);$i++){
        //         $tindakan_rm[$i]->tarif = 0;
        //     }
        //     for($j=0;$j<count($pemeriksaan);$j++){
        //         $pemeriksaan[$j]->tarif = 0;
        //     }
        // }
        
        // $pelayanan = 
        
        return view('kasir/v_datapelayanankasir',['pemeriksaan' => $pemeriksaan, 'tindakan_rm' => $tindakan_rm, 'pasien' => $pasien, 'judul' => $judul]);
    }

    // public function showpelayanankasir()
    // {
    //     $judul = 'PELAYANAN PASIEN';
    //     date_default_timezone_set('Asia/jakarta');
    //     $tanggal=date('Y-m-d');
    //     // $pasien = DB::select("select * from tbl_datapasiens where no_rm='".$id2."'"); 
    //     // $antrian = DB::select("SELECT * FROM tbl_antrian_poli_umums, tbl_rekam_medis where .no_rm = tbl_antrian_poli_umums.no_rm AND tbl_antrian_poli_umums.no_rm = tbl_rekam_medis.no_rm AND tbl_antrian_poli_umums.status='selesai' AND tbl_antrian_poli_umums.created_at='".$tanggal."'"); 
        
    //     return view('kasir/v_datapelayanankasir',['judul' => $judul]);
    // }

    public function showhistory()
    {
        $judul = 'PELAYANAN PASIEN';
        date_default_timezone_set('Asia/jakarta');
        $tanggal=date('Y-m-d');
        $antrian= DB::select("SELECT * FROM  tbl_antrian_kasir JOIN tbl_datapasiens on tbl_antrian_kasir.no_rm = tbl_datapasiens.no_rm JOIN tbl_rekam_medis on tbl_antrian_kasir.no_rm = tbl_rekam_medis.no_rm AND tbl_datapasiens.no_rm = tbl_rekam_medis.no_rm WHERE tbl_antrian_kasir.status = 'selesai'"); 
        $antrians = DB::select("SELECT * FROM  tbl_antrian_kasir where status = 'selesai'"); 
        $pasien = DB::select("SELECT * FROM tbl_datapasiens a, tbl_rekam_medis b WHERE a.no_rm = b.no_rm");
        $tindakan_rm = DB::select("SELECT * FROM tbl_tindakan_rm JOIN tbl_data_tindakan on tbl_tindakan_rm.tindakan = tbl_data_tindakan.nama_tindakan  where  tbl_tindakan_rm.status!='hapus'  "); 
        $pelayananlab = DB::select("SELECT * FROM tbl_permintaanlab JOIN tbl_data_laborat_dokter on tbl_permintaanlab.id_data_laborat_dokter = tbl_data_laborat_dokter.id_data_laborat_dokter");
        // print_r($antrians);

        foreach($antrians as $a){
            foreach($pasien as $p){
                if($a->no_rm == $p->no_rm){
                    $a->nama = $p->nama;
                    $a->jenis_kelamin = $p->jenis_kelamin;
                    $a->jenis_asuransi = $p->jenis_asuransi;
                    $a->id_pemeriksaan = $p->id_pemeriksaan;
                }
            } 
        }
        //nomorantrian, tanggal, status = tbl_antrian_kasir (no_rm, tanggal, status)
        // jenis tindakan, = tbl_tindakan_rm (id_pemeriksaan, no_rm)
        // nama, jenis kelamin, no_rm, asuransi = tbl_datapasiens (no_rm)
        
        //jenis pelayanan lab, harga, total harga = tbl_permintaanlab, id_datalaborat_dokter (id_pemeriksaan, id_data_laborat_dokter)
        return view('kasir/v_history',['antrian'=> $antrians, 'tindakan'=> $tindakan_rm, 'pelayanan'=>$pelayananlab , 'judul' => $judul]);
    }

    public function storekasir(Request $request)
    {
        date_default_timezone_set('Asia/jakarta');
        $tanggal=date('Y-m-d');
        $waktu=date('h:i:s');
        $Tbl_kasir = new Tbl_kasir;
        $Tbl_kasir->no_rm=$request->no_rm;
        $Tbl_kasir->id_pemeriksaan=$request->id_pemeriksaan;
        $Tbl_kasir->total_pembayaran=$request->tarif;
        $Tbl_kasir->status="Pembayaran";
        $Tbl_kasir->save();
        // dd($request);

        $updatestatus = DB::select("UPDATE tbl_antrian_poli_umums set status ='farmasi' where no_rm='".$request->no_rm."' && created_at='".$tanggal."'");
        $updatestatus2 = DB::select("UPDATE tbl_antrian_kasir set status ='selesai' where no_rm='".$request->no_rm."' && tanggal='".$tanggal."'");

        $data = DB::select("SELECT * FROM tbl_antrian_kasir where no_rm='".$request->no_rm."' && tanggal='".$tanggal."'");
        
        $Tbl_antrian_farmasi = new Tbl_antrian_farmasi();
        // $tanggal=date('Y-m-d');
        $cek = $Tbl_antrian_farmasi
            // ->where('id_poli', '=', $id_poli)
            ->where('tanggal', '=', $tanggal)
            ->count();
        $jumlah_antrian = $cek + 1;
        $Tbl_antrian_farmasi->no_antrian=$data[0]->no_antrian;
        $Tbl_antrian_farmasi->no_rm=$data[0]->no_rm;
        $Tbl_antrian_farmasi->waktu=$waktu;
        $Tbl_antrian_farmasi->status="farmasi";
        $Tbl_antrian_farmasi->poli_asal="Poli Umum";
        $Tbl_antrian_farmasi->urutan = $jumlah_antrian;
        $Tbl_antrian_farmasi->tanggal = $tanggal;
        $Tbl_antrian_farmasi->save();

        return redirect ('/kasir');
    }

    public function showlaporan()
    {
        $judul = 'PELAYANAN PASIEN';
        date_default_timezone_set('Asia/jakarta');
        $tanggal=date('Y-m-d');
        $data3 = DB::select("SELECT * FROM  tbl_antrian_kasir JOIN tbl_datapasiens on tbl_antrian_kasir.no_rm = tbl_datapasiens.no_rm JOIN tbl_rekam_medis on tbl_antrian_kasir.no_rm = tbl_rekam_medis.no_rm AND tbl_datapasiens.no_rm = tbl_rekam_medis.no_rm WHERE tbl_antrian_kasir.status = 'selesai'"); 
        $data = DB::select("SELECT * FROM  tbl_antrian_kasir where status = 'selesai'"); 
        $pasien = DB::select("SELECT * FROM  tbl_datapasiens"); 
        $rm = DB::select("SELECT * FROM  tbl_rekam_medis"); 
        foreach($data as $d){
            foreach($pasien as $p){
                if($d->no_rm == $p->no_rm){
                    $d->nama =  $p->nama;
                    $d->nama_kk =  $p->nama_kk;
                    $d->alamat =  $p->alamat;
                    $d->jenis_kelamin =  $p->jenis_kelamin;
                    $d->umur =  $p->umur;
                    $d->pekerjaan =  $p->pekerjaan;
                    $d->jenis_asuransi =  $p->jenis_asuransi;
                }
            }
            foreach($rm as $r){
                if($d->no_rm == $r->no_rm){
                    $d->id_pemeriksaan =  $r->id_pemeriksaan;
                }
            }
        }
        // $data = DB::select("SELECT * FROM tbl_permintaanlab,tbl_data_laborat_dokter,tbl_antrian_poli_umums, tbl_datapasiens, tbl_tindakan_rm, kasir where kasir.id_pemeriksaan = tbl_tindakan_rm.id_pemeriksaan AND tbl_permintaanlab.id_pemeriksaan = tbl_tindakan_rm.id_pemeriksaan AND tbl_permintaanlab.id_data_laborat_dokter = tbl_data_laborat_dokter.id_data_laborat_dokter AND tbl_tindakan_rm.no_rm = tbl_datapasiens.no_rm AND  tbl_datapasiens.no_rm=tbl_antrian_poli_umums.no_rm"); 
        $tindakan_rm = DB::select("SELECT * FROM tbl_tindakan_rm JOIN tbl_data_tindakan on tbl_tindakan_rm.tindakan = tbl_data_tindakan.nama_tindakan  where  tbl_tindakan_rm.status!='hapus'  "); 
        $pendaftaran = DB::select("SELECT * FROM tbl_pendaftarans JOIN tbl_rekam_medis on tbl_pendaftarans.no_rm = tbl_rekam_medis.no_rm WHERE tbl_pendaftarans.tanggal = tbl_rekam_medis.tanggal_kunjungan");
        $pelayananlab = DB::select("SELECT * FROM tbl_permintaanlab JOIN tbl_data_laborat_dokter on tbl_permintaanlab.id_data_laborat_dokter = tbl_data_laborat_dokter.id_data_laborat_dokter");
        $kasir = DB::select("SELECT * FROM kasir");
        // echo("<br>");
        // echo("<br>");
        // print_r($tindakan_rm);
        // echo("<br>");
        // echo("<br>");
        // print_r($pelayananlab);
        return view('kasir/datalaporan/v_laporankasir',['data' => $data,'kasir' => $kasir,'tindakan' => $tindakan_rm,'pendaftaran' => $pendaftaran,'pelayanan' => $pelayananlab,'judul' => $judul]);
        // return view('kasir/datalaporan/v_laporankasir',['judul' => $judul]);
    }
   
    public function exportLaporan()
    {
        $fileName = 'laporan Kasir.csv';

        $data = DB::select("SELECT * FROM  tbl_antrian_kasir where status = 'selesai'"); 
        $pasien = DB::select("SELECT * FROM  tbl_datapasiens"); 
        $rm = DB::select("SELECT * FROM  tbl_rekam_medis"); 
        foreach($data as $d){
            foreach($pasien as $p){
                if($d->no_rm == $p->no_rm){
                    $d->nama =  $p->nama;
                    $d->nama_kk =  $p->nama_kk;
                    $d->alamat =  $p->alamat;
                    $d->jenis_kelamin =  $p->jenis_kelamin;
                    $d->umur =  $p->umur;
                    $d->pekerjaan =  $p->pekerjaan;
                    $d->jenis_asuransi =  $p->jenis_asuransi;
                }
            }
            foreach($rm as $r){
                if($d->no_rm == $r->no_rm){
                    $d->id_pemeriksaan =  $r->id_pemeriksaan;
                }
            }
        }
        $tindakan_rm = DB::select("SELECT * FROM tbl_tindakan_rm JOIN tbl_data_tindakan on tbl_tindakan_rm.tindakan = tbl_data_tindakan.nama_tindakan  where  tbl_tindakan_rm.status!='hapus'  "); 
        $pendaftaran = DB::select("SELECT * FROM tbl_pendaftarans JOIN tbl_rekam_medis on tbl_pendaftarans.no_rm = tbl_rekam_medis.no_rm WHERE tbl_pendaftarans.tanggal = tbl_rekam_medis.tanggal_kunjungan");
        $pelayananlab = DB::select("SELECT * FROM tbl_permintaanlab JOIN tbl_data_laborat_dokter on tbl_permintaanlab.id_data_laborat_dokter = tbl_data_laborat_dokter.id_data_laborat_dokter");
        $kasir = DB::select("SELECT * FROM kasir");
        foreach($data as $datas){
            $datas->tindakan = array();
            $datas->tariftindakan = array();
            $datas->namalayanan = array();
            $datas->tariflayanan = array();
            $datas->total_pembayaran = array();
            foreach($pendaftaran as $pendaftarans){
                if($pendaftarans->no_rm == $datas->no_rm && $pendaftarans->tanggal == $datas->tanggal )
                $datas->tipe_kunjungan = $pendaftarans->tipe_kunjungan;
            }
            foreach($tindakan_rm as $tindakans){
                if($tindakans->no_rm == $datas->no_rm){
                    array_push($datas->tindakan, $tindakans->nama_tindakan);
                    array_push($datas->tariftindakan, $tindakans->tarif);
                }  
            }
            foreach($pelayananlab as $layanan){
                if($layanan->id_pemeriksaan == $datas->id_pemeriksaan){
                    array_push($datas->tariflayanan, $layanan->tarif);
                    array_push($datas->namalayanan, $layanan->nama);
                }  
            }
            foreach($kasir as $kasirs){
                if($kasirs->id_pemeriksaan == $datas->id_pemeriksaan){
                    array_push($datas->total_pembayaran, $kasirs->total_pembayaran);
                }
            } 
            foreach($pendaftaran as $pendaftarans){
                if($pendaftarans->no_rm == $datas->no_rm && $pendaftarans->tanggal == $datas->tanggal ){
                    $datas->tipe_kunjungan = $pendaftarans->tipe_kunjungan;
                }
            }       
        }
        // $data = DB::select("SELECT * FROM tbl_permintaanlab,tbl_data_laborat_dokter,tbl_antrian_poli_umums, tbl_datapasiens, tbl_tindakan_rm, kasir where kasir.id_pemeriksaan = tbl_tindakan_rm.id_pemeriksaan AND tbl_permintaanlab.id_pemeriksaan = tbl_tindakan_rm.id_pemeriksaan AND tbl_permintaanlab.id_data_laborat_dokter = tbl_data_laborat_dokter.id_data_laborat_dokter AND tbl_tindakan_rm.no_rm = tbl_datapasiens.no_rm AND  tbl_datapasiens.no_rm=tbl_antrian_poli_umums.no_rm"); 
        // print_r($data);
        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );
        // $columns = array('Tanggal','Poli Asal',' Nama Pasien',' Jenis Kelamin', 'Umur', 'Total', 'Jenis Kunjungan(BPJS/Umum)', 'Jenis Kunjungan Dalam 1 Tahun(baru/lama)' );
        // $columns = array('Nama Pasien','Nomor Rekam Medis','Alamat','Jenis Kelamin', 'Jenis Kunjungan(BPJS/Umum)','Poli Asal','Jenis Tindakan','Harga','Jenis Pelayanan Lab', 'Harga', 'Total Pembayaran');
        $columns = array('Nama Pasien','Nomor Rekam Medis','Alamat','Jenis Kelamin', 'Jenis Kunjungan(Baru/Lama)','Pekerjaan','Jenis Asuransi','Poli Asal','Jenis Tindakan','Harga Tindakan','Jenis Pelayanan Lab','Harga Pelayanan Lab' ,'Total Pembayaran');

        $callback = function() use($data, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($data as $datas) {
                $row['Nama Pasien']  = $datas->nama;
                $row['Nomor Rekam Medis'] = $datas->no_rm;
                $row['Alamat'] = $datas->alamat;
                $row['Jenis Kelamin']    = $datas->jenis_kelamin;
                $row['Jenis Kunjungan(Baru/Lama)']  = $datas->tipe_kunjungan;             
                $row['Pekerjaan']  = $datas->pekerjaan;
                $row['Jenis Asuransi']  = $datas->jenis_asuransi;
                $row['Poli Asal']  = $datas->poli_asal;
                $row['Jenis Tindakan']  = implode(', ',$datas->tindakan);
                $row['Harga Tindakan']  = implode(', ',$datas->tariftindakan);
                $row['Jenis Pelayanan lab']  = implode(', ',$datas->namalayanan);
                $row['Harga Pelayanan Lab']  = implode(', ',$datas->tariflayanan);      
                $row['Total Pembayaran']  = implode(', ',$datas->total_pembayaran);             

                // fputcsv($file, array($row['Nama Pasien'],$row['Nomor Rekam Medis'], $row['Alamat'], $row['Jenis Kelamin'], $row['Jenis Kunjungan(BPJS/Umum)'], $row['Poli Asal'] , $row['Jenis Tindakan'] , $row['Harga'], $row['Jenis Pelayanan Lab'], $row['Harga'], $row['Total Pembayaran']));
                fputcsv($file, array($row['Nama Pasien'],$row['Nomor Rekam Medis'], $row['Alamat'], $row['Jenis Kelamin'], $row['Jenis Kunjungan(Baru/Lama)'], $row['Pekerjaan'], $row['Jenis Asuransi'], $row['Poli Asal'], $row['Jenis Tindakan'],$row['Harga Tindakan'],$row['Jenis Pelayanan lab'], $row['Harga Pelayanan Lab'] , $row['Total Pembayaran']));

            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }


}
