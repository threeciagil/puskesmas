<?php

namespace App\Http\Controllers;

use App\Tbl_ff;
use App\Tbl_datapasien;
use App\Tbl_pendaftaran;
use App\Tbl_antrian_poli_umum;
use App\Tbl_nama_pemeriksaan;
use App\Tbl_jenis_dokter;
use App\Tbl_jenis_pemeriksaan;
use App\Tbl_data_laborat_dokter;
use App\Tbl_hasillab;
use App\Tbl_pemeriksaan_dokter;
use App\Events\PanggilLaboratEvent;
use Illuminate\Support\Facades\DB;
use Session;
use Illuminate\Http\Request;
use Excel;


class LaboratoriumController extends Controller
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
            $judul = 'Antrian Laboratorium';
            date_default_timezone_set('Asia/jakarta');
            $tanggal=date('Y-m-d');
            $status='masuk';
            // $antrian = DB::select("SELECT * FROM tbl_antrian_laboratorium a JOIN tbl_datapasiens b JOIN tbl_rekam_medis C  on c.tanggal_kunjungan='".$tanggal."' AND a.status='permintaanlab' AND a.no_rm = b.no_rm AND b.no_rm = c.no_rm AND a.no_rm = c.no_rm");
            // $antrian = DB::select("SELECT * FROM tbl_antrian_laboratorium a JOIN tbl_datapasiens b JOIN tbl_rekam_medis C  on a.tanggal='".$tanggal."' AND a.status='permintaanlab' AND a.no_rm = b.no_rm AND b.no_rm = c.no_rm AND a.no_rm = c.no_rm");
            $antrian = DB::select("SELECT * FROM tbl_antrian_laboratorium a JOIN tbl_datapasiens b on a.no_rm = b.no_rm  where tanggal='".$tanggal."' AND a.status='permintaanlab' ");
            // $datapasiens = DB::select("SELECT * FROM tbl_datapasiens ");
            $rm = DB::select("SELECT * FROM tbl_rekam_medis");
            foreach($antrian as $antrians){
                foreach($rm as $rm){
                    if($rm->no_rm == $antrians->no_rm){
                        $antrians->id_pemeriksaan = $rm->id_pemeriksaan; 
                    }
                }
            }
            return view('laboratorium/v_antrianlaborat',[ 'antrian'=>$antrian ,'judul' => $judul]);
        }
    }

    public function panggil($no){
       
        $data_laborat =  DB::select("select * from tbl_antrian_laboratorium where id_antrian='".$no."'");
        $data_laborat[0]->nama_poli = "Laboratorium";
        
        // print_r($data_laborat);
        broadcast(new PanggilLaboratEvent($data_laborat));
    
    }

    public function lewati($id)
    {
        date_default_timezone_set('Asia/jakarta');
        $tanggal=date('Y-m-d');
        $datas = DB::table("tbl_antrian_laboratorium")
                ->whereDate('tanggal', '=', now())->get();
        $count = DB::table("tbl_antrian_laboratorium")
                ->whereDate('tanggal', '=', now())->count();
        $data = DB::select("select * from tbl_antrian_laboratorium where id_antrian=".$id."");        
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
            $antrian = DB::select("UPDATE tbl_antrian_laboratorium set status='lewati' where id_antrian=".$id."");
            $updatedata =  DB::select("UPDATE tbl_antrian_laboratorium set urutan = $urutan_akhir where id_antrian=".$id."");
            $updatedata1 =  DB::select("UPDATE tbl_antrian_laboratorium set urutan = $urutan_akhir1 where id_antrian=".$id1."");
            $updatedata2 =  DB::select("UPDATE tbl_antrian_laboratorium set urutan = $urutan_akhir2 where id_antrian=".$id2."");
            $updatedata3 =  DB::select("UPDATE tbl_antrian_laboratorium set urutan = $urutan_akhir3 where id_antrian=".$id3."");
            
            $updateid =  DB::select("UPDATE tbl_antrian_laboratorium set id_antrian = $temp_id where id_antrian=".$id."");
            $updateid1 =  DB::select("UPDATE tbl_antrian_laboratorium set id_antrian = $temp_id1 where id_antrian=".$id1."");
            $updateid2 =  DB::select("UPDATE tbl_antrian_laboratorium set id_antrian = $temp_id2 where id_antrian=".$id2."");
            $updateid3 =  DB::select("UPDATE tbl_antrian_laboratorium set id_antrian = $temp_id3 where id_antrian=".$id3."");

            $updateidakhir =  DB::select("UPDATE tbl_antrian_laboratorium set id_antrian = $id_akhir where id_antrian=".$temp_id."");
            $updateidakhir1 =  DB::select("UPDATE tbl_antrian_laboratorium set id_antrian = $id1_akhir where id_antrian=".$temp_id1."");
            $updateidakhir2 =  DB::select("UPDATE tbl_antrian_laboratorium set id_antrian = $id2_akhir where id_antrian=".$temp_id2."");
            $updateidakhir3 =  DB::select("UPDATE tbl_antrian_laboratorium set id_antrian = $id3_akhir where id_antrian=".$temp_id3."");       
                 
            
            
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
            $antrian = DB::select("UPDATE tbl_antrian_laboratorium set status='lewati' where id_antrian=".$id."");
            $updatedata =  DB::select("UPDATE tbl_antrian_laboratorium set urutan = $urutan_akhir where id_antrian=".$id."");
            $updatedata1 =  DB::select("UPDATE tbl_antrian_laboratorium set urutan = $urutan_akhir1 where id_antrian=".$id1."");
            $updatedata2 =  DB::select("UPDATE tbl_antrian_laboratorium set urutan = $urutan_akhir2 where id_antrian=".$id2."");
            $updatedata3 =  DB::select("UPDATE tbl_antrian_laboratorium set urutan = $urutan_akhir3 where id_antrian=".$id3."");
            
            $updateid =  DB::select("UPDATE tbl_antrian_laboratorium set id_antrian = $temp_id where id_antrian=".$id."");
            $updateid1 =  DB::select("UPDATE tbl_antrian_laboratorium set id_antrian = $temp_id1 where id_antrian=".$id1."");
            $updateid2 =  DB::select("UPDATE tbl_antrian_laboratorium set id_antrian = $temp_id2 where id_antrian=".$id2."");
            $updateid3 =  DB::select("UPDATE tbl_antrian_laboratorium set id_antrian = $temp_id3 where id_antrian=".$id3."");

            $updateidakhir =  DB::select("UPDATE tbl_antrian_laboratorium set id_antrian = $id_akhir where id_antrian=".$temp_id."");
            $updateidakhir1 =  DB::select("UPDATE tbl_antrian_laboratorium set id_antrian = $id1_akhir where id_antrian=".$temp_id1."");
            $updateidakhir2 =  DB::select("UPDATE tbl_antrian_laboratorium set id_antrian = $id2_akhir where id_antrian=".$temp_id2."");            
            $updateidakhir3 =  DB::select("UPDATE tbl_antrian_laboratorium set id_antrian = $id3_akhir where id_antrian=".$temp_id3."");            
            
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
            $antrian = DB::select("UPDATE tbl_antrian_laboratorium set status='lewati' where id_antrian=".$id."");
            $updatedata =  DB::select("UPDATE tbl_antrian_laboratorium set urutan = $urutan_akhir where id_antrian=".$id."");
            // $updatedata1 =  DB::select("UPDATE tbl_antri_pendaftaran set urutan = $urutan_akhir1 where id_antrian=".$id1."");
            $updatedata2 =  DB::select("UPDATE tbl_antrian_laboratorium set urutan = $urutan_akhir2 where id_antrian=".$id1."");
            $updatedata3 =  DB::select("UPDATE tbl_antrian_laboratorium set urutan = $urutan_akhir3 where id_antrian=".$id2."");
            
            $updateid =  DB::select("UPDATE tbl_antrian_laboratorium set id_antrian = $temp_id where id_antrian=".$id."");
            // $updateid1 =  DB::select("UPDATE tbl_antri_pendaftaran set id_antrian = $temp_id1 where id_antrian=".$id1."");
            $updateid2 =  DB::select("UPDATE tbl_antrian_laboratorium set id_antrian = $temp_id2 where id_antrian=".$id1."");
            $updateid3 =  DB::select("UPDATE tbl_antrian_laboratorium set id_antrian = $temp_id3 where id_antrian=".$id2."");

            $updateidakhir =  DB::select("UPDATE tbl_antrian_laboratorium set id_antrian = $id_akhir where id_antrian=".$temp_id."");
            // $updateidakhir1 =  DB::select("UPDATE tbl_antri_pendaftaran set id_antrian = $id1_akhir where id_antrian=".$temp_id1."");
            $updateidakhir2 =  DB::select("UPDATE tbl_antrian_laboratorium set id_antrian = $id1_akhir where id_antrian=".$temp_id2."");            
            $updateidakhir3 =  DB::select("UPDATE tbl_antrian_laboratorium set id_antrian = $id2_akhir where id_antrian=".$temp_id3."");            
            $updateidakhir4 =  DB::select("UPDATE tbl_antrian_laboratorium set id_antrian = $id_akhir-1 where id_antrian=".$id_akhir."");
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
            $antrian = DB::select("UPDATE tbl_antrian_laboratorium set status='lewati' where id_antrian=".$id."");
            $updatedata =  DB::select("UPDATE tbl_antrian_laboratorium set urutan = $urutan_akhir where id_antrian=".$id."");
            $updatedata1 =  DB::select("UPDATE tbl_antrian_laboratorium set urutan = $urutan_akhir1 where id_antrian=".$id1."");
            $updatedata2 =  DB::select("UPDATE tbl_antrian_laboratorium set urutan = $urutan_akhir2 where id_antrian=".$id2."");
            
            $updateid =  DB::select("UPDATE tbl_antrian_laboratorium set id_antrian = $temp_id where id_antrian=".$id."");
            $updateid1 =  DB::select("UPDATE tbl_antrian_laboratorium set id_antrian = $temp_id1 where id_antrian=".$id1."");
            $updateid2 =  DB::select("UPDATE tbl_antrian_laboratorium set id_antrian = $temp_id2 where id_antrian=".$id2."");
            
            $updateidakhir =  DB::select("UPDATE tbl_antrian_laboratorium set id_antrian = $id_akhir where id_antrian=".$temp_id."");
            $updateidakhir1 =  DB::select("UPDATE tbl_antrian_laboratorium set id_antrian = $id1_akhir where id_antrian=".$temp_id1."");
            $updateidakhir2 =  DB::select("UPDATE tbl_antrian_laboratorium set id_antrian = $id2_akhir where id_antrian=".$temp_id2."");            
            $updateidakhir3 =  DB::select("UPDATE tbl_antrian_laboratorium set id_antrian = $id_akhir-2 where id_antrian=".$id_akhir."");
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

    public function hapus($id)
    {
        $antrian = DB::select("UPDATE tbl_antrian_laboratorium set status='hapus' where id_antrian=".$id."");
        return redirect('/laborat');
    }

    
    public function layani($id1,$id2)
    { 
        $tanggal=date('Y-m-d');
        $judul = 'Pelayanan Laboratorium';
        $pasien = DB::select("SELECT * FROM tbl_antrian_poli_umums JOIN tbl_datapasiens on tbl_datapasiens.no_rm=tbl_antrian_poli_umums.no_rm where tbl_antrian_poli_umums.no_rm='".$id2."' && tbl_antrian_poli_umums.status='permintaanlab'");
        $pasien[0]->tanggal = $tanggal;
        // echo($id1);
        // print_r($pasien);
        // $permintaan = DB::select("SELECT * FROM tbl_permintaanlab JOIN tbl_data_laborat_dokter where id_pemeriksaan='".$id1."' AND tbl_permintaanlab.id_data_laborat_dokter=tbl_data_laborat_dokter.id_data_laborat_dokter AND tbl_data_laborat_dokter.id_data_laborat_dokter");
        // $permintaan = DB::select("SELECT * FROM tbl_data_laborat_dokter, tbl_permintaanlab, tbl_pemeriksaan_dokter, tbl_nama_pemeriksaan, tbl_jenis_dokter  where tbl_permintaanlab.id_pemeriksaan='".$id1."' AND tbl_permintaanlab.id_data_laborat_dokter = tbl_data_laborat_dokter.id_data_laborat_dokter AND tbl_data_laborat_dokter.id_data_laborat_dokter=tbl_pemeriksaan_dokter.id_data_laborat_dokter AND tbl_pemeriksaan_dokter.id_nama=tbl_nama_pemeriksaan.id_nama_pemeriksaan AND tbl_pemeriksaan_dokter.id_jenis=tbl_jenis_dokter.id_jenis_dokter AND tbl_permintaanlab.tanggal='".$tanggal."'");
        $permintaan = DB::select("SELECT * FROM tbl_data_laborat_dokter, tbl_permintaanlab, tbl_pemeriksaan_dokter, tbl_nama_pemeriksaan, tbl_jenis_dokter  where tbl_permintaanlab.id_pemeriksaan='".$id1."' AND tbl_permintaanlab.id_data_laborat_dokter = tbl_data_laborat_dokter.id_data_laborat_dokter AND tbl_data_laborat_dokter.id_data_laborat_dokter=tbl_pemeriksaan_dokter.id_data_laborat_dokter AND tbl_pemeriksaan_dokter.id_nama=tbl_nama_pemeriksaan.id_nama_pemeriksaan AND tbl_pemeriksaan_dokter.id_jenis=tbl_jenis_dokter.id_jenis_dokter ");
        
        // $permintaan2 = DB::select("SELECT a.id_jenis_pemeriksaan, a.jenis_pemeriksaan, a.nama_pemeriksaan, a.nilai_nominal, a.satuan FROM tbl_nama_pemeriksaan a, tbl_permintaanlab b WHERE a.nama_pemeriksaan = b.");
        // $permintaan =  DB::select("SELECT * FROM tbl_permintaanlab, tbl_data_laborat_dokter, tbl_jenis_pemeriksaan where tbl_permintaanlab.id_pemeriksaan='".$id1."' AND tbl_permintaanlab.id_data_laborat_dokter=tbl_data_laborat_dokter.id_data_laborat_dokter");
        // print_r($permintaan);
        return view('laboratorium/v_pelayananlaborat', ['permintaan'=>$permintaan, 'pasien'=>$pasien, 'judul'=> $judul]);
    }
    
    public function dataJenisPelayananDokter($id)
    {
        $judul = 'Daftar Pelayanan Pasien';
        date_default_timezone_set('Asia/jakarta');
        $tanggal=date('Y-m-d');
        $datajenis = DB::select("select * from tbl_jenis_dokter where status !='hapus' && id_jenis_dokter=".$id.""); 
        // print_r($datajenis);0
        $datanama = DB::select("select * from tbl_nama_pemeriksaan where status !='hapus'");
        $data = DB::select("SELECT * FROM tbl_data_laborat_dokter JOIN tbl_jenis_dokter on tbl_data_laborat_dokter.id_jenis=tbl_jenis_dokter.id_jenis_dokter where tbl_data_laborat_dokter.id_jenis='".$id."' && tbl_data_laborat_dokter.status !='hapus'");
        // $data = DB::select("SELECT * FROM tbl_data_laborat_dokter where id_jenis='".$id."'");
        
        // print_r($datanama);
        return view('laboratorium/v_datajenispelayanandokter',[ 'data'=>$data, 'datanama'=>$datanama,'datajenis'=>$datajenis, 'judul' => $judul]);
    }
    
    public function showPemeriksaanDokter($id)
    {
        $judul = 'Daftar Pemeriksaan Dokter';
        date_default_timezone_set('Asia/jakarta');
        $tanggal=date('Y-m-d');
        
        $data = DB::select("SELECT * FROM tbl_data_laborat_dokter, tbl_pemeriksaan_dokter, tbl_nama_pemeriksaan where tbl_data_laborat_dokter.id_data_laborat_dokter='".$id."' && tbl_data_laborat_dokter.id_data_laborat_dokter=tbl_pemeriksaan_dokter.id_data_laborat_dokter && tbl_pemeriksaan_dokter.id_nama=tbl_nama_pemeriksaan.id_nama_pemeriksaan");
        // $data = DB::select("SELECT * FROM tbl_data_laborat_dokter where id_jenis='".$id."'");
        $datalab = DB::select("select * from tbl_nama_pemeriksaan where status !='hapus'");
       
        $datadokter = DB::select("select * from tbl_data_laborat_dokter, tbl_jenis_dokter where tbl_jenis_dokter.status !='hapus' && tbl_data_laborat_dokter.status !='hapus' && tbl_jenis_dokter.id_jenis_dokter=tbl_data_laborat_dokter.id_jenis && tbl_data_laborat_dokter.id_data_laborat_dokter=".$id.""); 
        // print_r($datadokter);
        return view('laboratorium/v_datapemeriksaandokter',[ 'data'=>$data, 'judul' => $judul, 'datalab'=> $datalab, 'datadokter'=>$datadokter]);
    }
    

    public function dataJenisPelayananLab()
    {
        $judul = 'Daftar Pelayanan Pasien';
        date_default_timezone_set('Asia/jakarta');
        $tanggal=date('Y-m-d');
        $jenis_layanan = DB::select("select * from tbl_jenis_pemeriksaan where status !='hapus' "); 
        // print_r($jenis_layanan);
        return view('laboratorium/v_datajenislab',[ 'jenis' => $jenis_layanan, 'judul' => $judul]);
    }

    public function dataJenisDokter()
    {
        $judul = 'Daftar Pelayanan Pasien';
        date_default_timezone_set('Asia/jakarta');
        $tanggal=date('Y-m-d');
        $jenis_layanan = DB::select("select * from tbl_jenis_dokter where status !='hapus' "); 
        // print_r($jenis_layanan);
        return view('laboratorium/v_datajenisdokter',[ 'jenis' => $jenis_layanan, 'judul' => $judul]);
    }

    public function dataUjiLab($id)
    {
        $judul = 'Daftar Pelayanan Pasien';
        date_default_timezone_set('Asia/jakarta');
        $tanggal=date('Y-m-d');
        $data = DB::select("select * from tbl_nama_pemeriksaan where status !='hapus' && id_jenis_pemeriksaan = ".$id); 
        $jenis = DB::select("select * from tbl_jenis_pemeriksaan where id_jenis_pemeriksaan = ".$id); 
        return view('laboratorium/v_dataujilab',['data'=> $data, 'jenis'=> $jenis, 'judul' => $judul]);
    }

    public function dataLaporanLab()
    {
        $judul = 'Daftar Pelayanan Pasien';
        date_default_timezone_set('Asia/jakarta');
        $tanggal=date('Y-m-d');
       
        $antrian = DB::select("SELECT * FROM tbl_antrian_laboratorium where status = 'selesai' ");
        $datapasiens =  DB::select("SELECT * FROM tbl_datapasiens a, tbl_rekam_medis b where a.no_rm = b.no_rm ");
        $datalab = DB::select("SELECT * FROM tbl_hasil_lab a, tbl_jenis_dokter b, tbl_nama_pemeriksaan c, tbl_rekam_medis d, tbl_permintaanlab e, tbl_data_laborat_dokter f where a.id_pemeriksaan = d.id_pemeriksaan AND a.id_jenis_pemeriksaan = b.id_jenis_dokter AND a.id_nama_pemeriksaan = c.id_nama_pemeriksaan AND e.id_data_laborat_dokter = f.id_data_laborat_dokter");  
        $kunjungan = DB::select("SELECT tbl_pendaftarans.tipe_kunjungan,tbl_antrian_poli_umums.no_rm, tbl_pendaftarans.tanggal FROM tbl_pendaftarans JOIN tbl_antrian_poli_umums ON tbl_antrian_poli_umums.no_rm = tbl_pendaftarans.no_rm AND tbl_antrian_poli_umums.created_at = tbl_pendaftarans.tanggal");
        // $data
        
        
        foreach($antrian as $a){
            foreach($datapasiens as $p){
                if($a->no_rm == $p->no_rm ){
                    $a->nama = $p->nama;
                    $a->nama_kk = $p->nama_kk;
                    $a->alamat = $p->alamat;
                    $a->jenis_kelamin = $p->jenis_kelamin;
                    $a->umur = $p->umur;
                    $a->jenis_asuransi = $p->jenis_asuransi;
                    $a->id_pemeriksaan = $p->id_pemeriksaan;
                    $a->dokter_penanggung_jawab = $p->dokter_penanggung_jawab;
                }
            }   
        }
        
        foreach($antrian as $datas){
            $datas->jenislab = array();
            $datas->namalab = array();
            $datas->permintaan = array();
            foreach($datalab as $labs){
                if($datas->id_pemeriksaan == $labs->id_pemeriksaan){
                    array_push($datas->jenislab, $labs->jenis_dokter);
                    array_push($datas->namalab, $labs->nama_pemeriksaan);
                    array_push($datas->permintaan, $labs->nama);
                }
            }
            
        }
        
        return view('laboratorium/v_laporanlab',[ 'kunjungan'=>$kunjungan, 'data' =>$antrian, 'judul' => $judul]);
    }


    public function exportLaporan()
    {
        $fileName = 'laporan laboratorium.csv';
        $data = DB::select("SELECT tbl_resep_obat.jenis_resep,tbl_resep_obat.signa, tbl_resep_obat.aturan_pakai, tbl_tindakan_rm.tindakan, tbl_tindakan_rm.penanggung_jawab, tbl_tindakan_rm.perawat,tbl_penyuluhan.isi_penyuluhan, tbl_diagnosa_rm.nama_diagnosa, tbl_pemeriksaan_rm.tinggi_badan, tbl_pemeriksaan_rm.berat_badan,tbl_pemeriksaan_rm.imt,tbl_pemeriksaan_rm.suhu,tbl_pemeriksaan_rm.rr,tbl_pemeriksaan_rm.sistol,tbl_pemeriksaan_rm.diastol,tbl_anamnesa_rm.rpd,tbl_anamnesa_rm.rps,tbl_anamnesa_rm.rpk,tbl_pendaftarans.tanggal, tbl_pendaftarans.tipe_kunjungan, tbl_datapasiens.nama, tbl_datapasiens.no_rm, tbl_datapasiens.nama_kk, tbl_datapasiens.alamat, tbl_datapasiens.jenis_kelamin, tbl_datapasiens.umur, tbl_datapasiens.jenis_asuransi, tbl_datapasiens.pekerjaan,tbl_antrian_poli_umums.poli_asal ,tbl_rekam_medis.no_rm, tbl_rekam_medis.id_pemeriksaan FROM tbl_rekam_medis,tbl_tindakan_rm,tbl_diagnosa_rm,tbl_pemeriksaan_rm,tbl_anamnesa_rm,tbl_datapasiens, tbl_antrian_poli_umums, tbl_pendaftarans, tbl_penyuluhan, tbl_resep_obat where tbl_datapasiens.no_rm = tbl_antrian_poli_umums.no_rm && tbl_pendaftarans.no_rm = tbl_antrian_poli_umums.no_rm && tbl_anamnesa_rm.no_rm = tbl_pendaftarans.no_rm && tbl_pemeriksaan_rm.no_rm = tbl_anamnesa_rm.no_rm && tbl_diagnosa_rm.no_rm = tbl_pemeriksaan_rm.no_rm && tbl_penyuluhan.no_rm = tbl_diagnosa_rm.no_rm && tbl_tindakan_rm.no_rm = tbl_penyuluhan.no_rm && tbl_resep_obat.id_pemeriksaan = tbl_rekam_medis.id_pemeriksaan && tbl_rekam_medis.no_rm = tbl_penyuluhan.no_rm && tbl_antrian_poli_umums.no_rm");
        date_default_timezone_set('Asia/jakarta');
        $tanggal=date('Y-m-d');
        $data = DB::select("SELECT * FROM tbl_antrian_laboratorium a JOIN tbl_datapasiens b on a.no_rm = b.no_rm JOIN tbl_rekam_medis c ON a.no_rm=c.no_rm where a.status = 'selesai' ");
        $datalab = DB::select("SELECT * FROM tbl_hasil_lab a, tbl_jenis_dokter b, tbl_nama_pemeriksaan c, tbl_rekam_medis d, tbl_permintaanlab e, tbl_data_laborat_dokter f where a.id_pemeriksaan = d.id_pemeriksaan AND a.id_jenis_pemeriksaan = b.id_jenis_dokter AND a.id_nama_pemeriksaan = c.id_nama_pemeriksaan AND e.id_data_laborat_dokter = f.id_data_laborat_dokter");  
        $kunjungan = DB::select("SELECT tbl_pendaftarans.tipe_kunjungan,tbl_antrian_poli_umums.no_rm, tbl_pendaftarans.tanggal FROM tbl_pendaftarans JOIN tbl_antrian_poli_umums ON tbl_antrian_poli_umums.no_rm = tbl_pendaftarans.no_rm AND tbl_antrian_poli_umums.created_at = tbl_pendaftarans.tanggal");
        
        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        foreach($data as $datas){
            $datas->jenislab = array();
            $datas->namalab = array();
            $datas->permintaan = array();
            $datas->kunjungan = array();
            foreach($datalab as $labs){
                if($datas->id_pemeriksaan == $labs->id_pemeriksaan){
                    array_push($datas->jenislab, $labs->jenis_dokter);
                    array_push($datas->namalab, $labs->nama_pemeriksaan);
                    array_push($datas->permintaan, $labs->nama);
                }
            }
            foreach($kunjungan as $k){
                if($k->no_rm == $datas->no_rm && $k->tanggal == $datas->tanggal ) {                                               
                    array_push($datas->kunjungan, $k->tipe_kunjungan);
                }
            }
        }

        $columns = array('Tanggal','Poli Asal',' Nama Pasien',' Nomor Rekam Medis', 'Nama KK','Alamat', 'Jenis Kelamin', 'Umur','Jenis Asuransi', 'Jenis Kunjungan Dalam 1 Tahun(baru/lama)', 'Nama Jenis Lab', 'Jenis Permintaan Lab', 'Nama Pemeriksaan Lab', 'Penanggung Jawab');
        $callback = function() use($data, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($data as $datas) {
                $row['Tanggal']  = $datas->tanggal;
                $row['Poli Asal']    = $datas->poli_asal;
                $row['Nama Pasien']    = $datas->nama;
                $row['Nomor Rekam Medis']  = $datas->no_rm;
                $row['Nama KK']  = $datas->nama_kk;
                $row['Alamat']  = $datas->alamat;
                $row['Jenis Kelamin']    = $datas->jenis_kelamin;
                $row['Umur']    = $datas->umur;
                $row['Jenis Asuransi']    = $datas->jenis_asuransi;
                $row['Jenis Kunjungan Dalam 1 Tahun(baru/lama)']  = implode(', ',$datas->kunjungan);
                $row['Nama Jenis Lab']  = implode(', ',$datas->jenislab); 
                $row['Jenis Permintaan Lab']  = implode(', ',$datas->permintaan);
                $row['Nama Pemeriksaan Lab']  = implode(', ',$datas->namalab);
                $row['Penanggung Jawab']  = $datas->dokter_penanggung_jawab;
                //fungsi php
                fputcsv($file, array($row['Tanggal'], $row['Poli Asal'], $row['Nama Pasien'], $row['Nomor Rekam Medis'], $row['Nama KK'], $row['Alamat'], $row['Jenis Kelamin'], $row['Umur'],$row['Jenis Asuransi'], $row['Jenis Kunjungan Dalam 1 Tahun(baru/lama)'], $row['Nama Jenis Lab'], $row['Jenis Permintaan Lab'], $row['Nama Pemeriksaan Lab'], $row['Penanggung Jawab']));
                
            }

            fclose($file);
        };
        // print_r($data);
        return response()->stream($callback, 200, $headers);
    }


    public function history()
    {
        $judul = 'Daftar Pelayanan Pasien';
        date_default_timezone_set('Asia/jakarta');
        $tanggal=date('Y-m-d');
        $antri = DB::select("SELECT * FROM tbl_antrian_laboratorium a JOIN tbl_datapasiens b on a.no_rm = b.no_rm  WHERE status = 'selesai' ");
        
        $pemeriksaan = DB::select("SELECT * FROM tbl_data_laborat_dokter a JOIN tbl_permintaanlab b on a.id_data_laborat_dokter = b.id_data_laborat_dokter");
        $rm = DB::select("SELECT * FROM tbl_rekam_medis");
        $hasil = array();
        $b= array();
        $rekammedis = array();
        // print_r($rm);
        for($a=0;$a<count($rm);$a++){
            for($i=0;$i<count($pemeriksaan);$i++){
                if($rm[$a]->id_pemeriksaan==$pemeriksaan[$i]->id_pemeriksaan &&  $rm[$a]->tanggal_kunjungan ==$pemeriksaan[$i]->tanggal){
                    $rekammedis[$i] = array();
                    array_push($rekammedis[$i], $pemeriksaan[$i]->nama);
                    array_push($rekammedis[$i], $rm[$a]->no_rm);
                    array_push($rekammedis[$i], $rm[$a]->id_pemeriksaan);
                }
            }
        }
        for($a=0;$a<count($antri);$a++){
            for($i=0;$i<count($rm);$i++){
                if($rm[$i]->no_rm==$antri[$a]->no_rm &&  $rm[$i]->tanggal_kunjungan == $antri[$a]->tanggal){
                    // $antri[$i]->id_pemeriksaan = array();
                    // echo($rm[$i]->id_pemeriksaan);
                    $antri[$a]->id_pemeriksaan = $rm[$i]->id_pemeriksaan;
                }
            }
        }
        
        return view('laboratorium/v_history',[ 'data' => $antri, 'rekammedis' => $rekammedis,'judul' => $judul]);
    }

    public function storepelayanandokter(Request $request)
    {
        $Tbl_data_laborat_dokter = new Tbl_data_laborat_dokter;
        $Tbl_data_laborat_dokter->nama=$request->nama_pemeriksaan_dokter;
        $Tbl_data_laborat_dokter->id_jenis=$request->jenis_lab;
        $Tbl_data_laborat_dokter->tarif=$request->tarif;
        $Tbl_data_laborat_dokter->save();
        // dd($request);
        $lastdata = DB::table('tbl_data_laborat_dokter')->latest('id_data_laborat_dokter')->first();
        $lastindex = $lastdata->id_data_laborat_dokter;

        $countdata = count($request->id_nama);
        for($i = 0; $i<$countdata; $i++){
            $Tbl_pemeriksaan_dokter = new Tbl_pemeriksaan_dokter;
            $Tbl_pemeriksaan_dokter->id_jenis=$request->jenis_lab;
            $Tbl_pemeriksaan_dokter->id_nama=$request->id_nama[$i];
            $Tbl_pemeriksaan_dokter->id_data_laborat_dokter=$lastindex;
            $Tbl_pemeriksaan_dokter->save();
        }
        return redirect ('/laboratdatajenisdokter/'.$request->jenis_lab);
    }

    public function storepemeriksaandokter(Request $request)
    {
        // dd($request);
        $lastdata = DB::table('tbl_data_laborat_dokter')->where('id_data_laborat_dokter',$request->id_dokter)->get();
        
        // $lastindex = $lastdata->id_data_laborat_dokter;
        // print_r($lastdata);
        $countdata = count($request->id_nama);
        for($i = 0; $i<$countdata; $i++){
            $Tbl_pemeriksaan_dokter = new Tbl_pemeriksaan_dokter;
            $Tbl_pemeriksaan_dokter->id_jenis=$request->jenis_lab;
            $Tbl_pemeriksaan_dokter->id_nama=$request->id_nama[$i];
            $Tbl_pemeriksaan_dokter->id_data_laborat_dokter=$request->id_dokter;
            $Tbl_pemeriksaan_dokter->save();
            
        }
        return redirect ('/showpemeriksaandokter/'.$request->id_dokter);
    }

    public function storejenisdokter(Request $request)
    {
        $Tbl_jenis_dokter = new Tbl_jenis_dokter;
        $Tbl_jenis_dokter->jenis_dokter=$request->jenis;
        $Tbl_jenis_dokter->status="tersedia";
        $Tbl_jenis_dokter->save();
        // dd($request);
        return redirect ('/laboratjenisdokter');
    }
    // public function storedatajenisdokter(Request $request)
    // {
    //     $Tbl_jenis_dokter = new Tbl_jenis_dokter;
    //     $Tbl_jenis_dokter->jenis_dokter=$request->jenis;
    //     $Tbl_jenis_dokter->status="tersedia";
    //     $Tbl_jenis_dokter->save();
    //     // dd($request);
    //     return redirect ('/laboratjenisdokter');
    // }

    public function storejenispemeriksaanlab(Request $request)
    {
        $Tbl_jenis_pemeriksaan = new Tbl_jenis_pemeriksaan();
        $Tbl_jenis_pemeriksaan->jenis_pemeriksaan=$request->jenis_pemeriksaan;
        $Tbl_jenis_pemeriksaan->status="tersedia";
        $Tbl_jenis_pemeriksaan->save();
        // dd($request);
        return redirect ('/laboratdatajenislab');
    }

    public function storedatajenispemeriksaanlab(Request $request)
    {
        $judul = 'Daftar Pelayanan Pasien';
        date_default_timezone_set('Asia/jakarta');
        $tanggal=date('Y-m-d');

        $data = DB::select("SELECT  * from tbl_nama_pemeriksaan where id_jenis_pemeriksaan = ".$request->id_jenis); 

        $jenis = DB::select("SELECT  * from tbl_jenis_pemeriksaan where id_jenis_pemeriksaan = ".$request->id_jenis."");   
        //$id_jenis = DB::select("select id_jenis_pemeriksaan from tbl_jenis_pemeriksaan where jenis_pemeriksaan = '.$request->jenis_lab.'");
       
    //    print_r($jenis[0]->jenis_pemeriksaan);
        $Tbl_nama_pemeriksaan = new Tbl_nama_pemeriksaan();
        $Tbl_nama_pemeriksaan->id_jenis_pemeriksaan=$request->id_jenis;
        $Tbl_nama_pemeriksaan->nama_pemeriksaan=$request->jenis_pemeriksaan;
        $Tbl_nama_pemeriksaan->nilai_normal=$request->nilai_normal;
        $Tbl_nama_pemeriksaan->satuan=$request->satuan;
        $Tbl_nama_pemeriksaan->status="tersedia";
        $Tbl_nama_pemeriksaan->save();


        // dd($request);
       return redirect ('/laboratdataujilab/'.$request->id_jenis);
    }

    public function storehasillab(Request $request)
    {  date_default_timezone_set('Asia/jakarta');
        $tanggal=date('Y-m-d');
        $countdata = count($request->hasil);
        for($i = 0; $i<$countdata; $i++){
            $Tbl_hasillab = new Tbl_hasillab;
            $Tbl_hasillab->id_pemeriksaan=$request->id_pemeriksaan;
            $Tbl_hasillab->id_nama_pemeriksaan=$request->id_nama[$i];
            $Tbl_hasillab->id_jenis_pemeriksaan=$request->id_jenis[$i];
            $Tbl_hasillab->hasil_pemeriksaan_lab=$request->hasil[$i];
            $Tbl_hasillab->penanggung_jawab=session('user_data')[0]['nama'];
            $Tbl_hasillab->save();
        }

            $updatestatus = DB::select("UPDATE tbl_antrian_poli_umums set status ='Masuk' where no_rm='".$request->no_rm."' AND created_at='".$tanggal."'");
            $updatepoliasal = DB::select("UPDATE tbl_antrian_poli_umums set poli_asal ='Laboratorium' where no_rm='".$request->no_rm."' AND created_at='".$tanggal."'");
            $updatestatus2 = DB::select("UPDATE tbl_antrian_laboratorium set status ='selesai' where no_rm='".$request->no_rm."' AND tanggal='".$tanggal."'");
        // dd($request);
        return redirect ('/laborat');
    }

    public function deletepelayanandokter($id1, $id2)
    {
        $delete = DB::select("UPDATE tbl_data_laborat_dokter set status='hapus' where id_data_laborat_dokter=".$id2."");
        // $data = DB::select("select * from tbl_data_laborat_dokter where jenis='".$datajenis[0]->jenis_pemeriksaan."'");
        return redirect ('/laboratdatajenisdokter/'.$id1);
    }

    public function deletedatajenislab($id)
    {
        $delete = DB::select("UPDATE tbl_jenis_pemeriksaan set status='hapus' where id_jenis_pemeriksaan=".$id."");
        $delete = DB::select("UPDATE tbl_nama_pemeriksaan set status='hapus' where id_jenis_pemeriksaan=".$id."");
        return redirect ('/laboratdatajenislab');
    }
    public function deletedatajenisdokter($id)
    {
        $delete = DB::select("UPDATE tbl_jenis_dokter SET status='hapus' where id_jenis_dokter=".$id." ");
        $deletedatadokter = DB::select("UPDATE tbl_data_laborat_dokter SET status='hapus' where id_jenis=".$id."");
        // $data = DB::select("select * from tbl_data_laborat_dokter where jenis='".$datajenis[0]->jenis_pemeriksaan."'");
        return redirect ('/laboratjenisdokter/');
    }

    public function deletedataujilab($id,$id2)
    {
        $delete = DB::select("UPDATE tbl_nama_pemeriksaan set status='hapus' where id_nama_pemeriksaan=".$id2."");
        return redirect ('/laboratdataujilab/'.$id);
    }
    public function deletedatapemeriksaandokter($id,$id2)
    {
        $delete = DB::table('tbl_pemeriksaan_dokter')->where('id', $id2)->delete();
        return redirect ('/showpemeriksaandokter/'.$id);
    }

}