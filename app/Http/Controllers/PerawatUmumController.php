<?php

namespace App\Http\Controllers;

use App\Events\PanggilPendaftaranEvent;
use App\Tbl_ff;
use App\Tbl_asuhan_keperawatan;
use App\Tbl_datapasien;
use App\Tbl_pendaftaran;
use Illuminate\Support\Facades\DB;
use Session;
use Illuminate\Http\Request;
use Excel;
// use Maatwebsite\Excel\Concerns\FromCollection;

class PerawatUmumController extends Controller
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
        }
        else{
            $value = session('user_data')[0]['role'];
            // if($value == "Perawat Umum"){
                $judul = 'Antrian Poli Umum';
                date_default_timezone_set('Asia/jakarta');
                $tanggal=date('Y-m-d');
                $status='masuk';
                // $antrian = DB::select("SELECT * FROM tbl_antrian_poli_umums JOIN tbl_datapasiens on tbl_datapasiens.no_rm=tbl_antrian_poli_umums.no_rm JOIN tbl_rekam_medis on tbl_rekam_medis.no_rm=tbl_antrian_poli_umums.no_rm where tbl_antrian_poli_umums.created_at='".$tanggal."' && tbl_rekam_medis.tanggal_kunjungan='".$tanggal."' && tbl_antrian_poli_umums.status='Masuk' OR tbl_antrian_poli_umums.status='Lewati'");
                $antrian = DB::select("SELECT * FROM tbl_antrian_poli_umums JOIN tbl_datapasiens on tbl_datapasiens.no_rm=tbl_antrian_poli_umums.no_rm where tbl_antrian_poli_umums.created_at='".$tanggal."' && tbl_antrian_poli_umums.status='Masuk' OR tbl_antrian_poli_umums.status='Lewati'");
                return view('perawat/v_antrianpoliumum',['antrian' => $antrian, 'judul' => $judul]);
            // }
            // else{
            //     return redirect('/login');
            // }
        
        }
    }
    public function lewati($id)
    {
        date_default_timezone_set('Asia/jakarta');
        $tanggal=date('Y-m-d');
        $datas = DB::table("tbl_antrian_poli_umums")
                ->whereDate('created_at', '=', now())->get();
        $count = DB::table("tbl_antrian_poli_umums")
                ->whereDate('created_at', '=', now())->count();
        $data = DB::select("select * from tbl_antrian_poli_umums where id_antrian=".$id."");        
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
            $antrian = DB::select("UPDATE tbl_antrian_poli_umums set status='lewati' where id_antrian=".$id."");
            $updatedata =  DB::select("UPDATE tbl_antrian_poli_umums set urutan = $urutan_akhir where id_antrian=".$id."");
            $updatedata1 =  DB::select("UPDATE tbl_antrian_poli_umums set urutan = $urutan_akhir1 where id_antrian=".$id1."");
            $updatedata2 =  DB::select("UPDATE tbl_antrian_poli_umums set urutan = $urutan_akhir2 where id_antrian=".$id2."");
            $updatedata3 =  DB::select("UPDATE tbl_antrian_poli_umums set urutan = $urutan_akhir3 where id_antrian=".$id3."");
            
            $updateid =  DB::select("UPDATE tbl_antrian_poli_umums set id_antrian = $temp_id where id_antrian=".$id."");
            $updateid1 =  DB::select("UPDATE tbl_antrian_poli_umums set id_antrian = $temp_id1 where id_antrian=".$id1."");
            $updateid2 =  DB::select("UPDATE tbl_antrian_poli_umums set id_antrian = $temp_id2 where id_antrian=".$id2."");
            $updateid3 =  DB::select("UPDATE tbl_antrian_poli_umums set id_antrian = $temp_id3 where id_antrian=".$id3."");

            $updateidakhir =  DB::select("UPDATE tbl_antrian_poli_umums set id_antrian = $id_akhir where id_antrian=".$temp_id."");
            $updateidakhir1 =  DB::select("UPDATE tbl_antrian_poli_umums set id_antrian = $id1_akhir where id_antrian=".$temp_id1."");
            $updateidakhir2 =  DB::select("UPDATE tbl_antrian_poli_umums set id_antrian = $id2_akhir where id_antrian=".$temp_id2."");
            $updateidakhir3 =  DB::select("UPDATE tbl_antrian_poli_umums set id_antrian = $id3_akhir where id_antrian=".$temp_id3."");       
                 
            
            
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
            $antrian = DB::select("UPDATE tbl_antrian_poli_umums set status='lewati' where id_antrian=".$id."");
            $updatedata =  DB::select("UPDATE tbl_antrian_poli_umums set urutan = $urutan_akhir where id_antrian=".$id."");
            $updatedata1 =  DB::select("UPDATE tbl_antrian_poli_umums set urutan = $urutan_akhir1 where id_antrian=".$id1."");
            $updatedata2 =  DB::select("UPDATE tbl_antrian_poli_umums set urutan = $urutan_akhir2 where id_antrian=".$id2."");
            $updatedata3 =  DB::select("UPDATE tbl_antrian_poli_umums set urutan = $urutan_akhir3 where id_antrian=".$id3."");
            
            $updateid =  DB::select("UPDATE tbl_antrian_poli_umums set id_antrian = $temp_id where id_antrian=".$id."");
            $updateid1 =  DB::select("UPDATE tbl_antrian_poli_umums set id_antrian = $temp_id1 where id_antrian=".$id1."");
            $updateid2 =  DB::select("UPDATE tbl_antrian_poli_umums set id_antrian = $temp_id2 where id_antrian=".$id2."");
            $updateid3 =  DB::select("UPDATE tbl_antrian_poli_umums set id_antrian = $temp_id3 where id_antrian=".$id3."");

            $updateidakhir =  DB::select("UPDATE tbl_antrian_poli_umums set id_antrian = $id_akhir where id_antrian=".$temp_id."");
            $updateidakhir1 =  DB::select("UPDATE tbl_antrian_poli_umums set id_antrian = $id1_akhir where id_antrian=".$temp_id1."");
            $updateidakhir2 =  DB::select("UPDATE tbl_antrian_poli_umums set id_antrian = $id2_akhir where id_antrian=".$temp_id2."");            
            $updateidakhir3 =  DB::select("UPDATE tbl_antrian_poli_umums set id_antrian = $id3_akhir where id_antrian=".$temp_id3."");            
            
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
            $antrian = DB::select("UPDATE tbl_antrian_poli_umums set status='lewati' where id_antrian=".$id."");
            $updatedata =  DB::select("UPDATE tbl_antrian_poli_umums set urutan = $urutan_akhir where id_antrian=".$id."");
            // $updatedata1 =  DB::select("UPDATE tbl_antri_pendaftaran set urutan = $urutan_akhir1 where id_antrian=".$id1."");
            $updatedata2 =  DB::select("UPDATE tbl_antrian_poli_umums set urutan = $urutan_akhir2 where id_antrian=".$id1."");
            $updatedata3 =  DB::select("UPDATE tbl_antrian_poli_umums set urutan = $urutan_akhir3 where id_antrian=".$id2."");
            
            $updateid =  DB::select("UPDATE tbl_antrian_poli_umums set id_antrian = $temp_id where id_antrian=".$id."");
            // $updateid1 =  DB::select("UPDATE tbl_antri_pendaftaran set id_antrian = $temp_id1 where id_antrian=".$id1."");
            $updateid2 =  DB::select("UPDATE tbl_antrian_poli_umums set id_antrian = $temp_id2 where id_antrian=".$id1."");
            $updateid3 =  DB::select("UPDATE tbl_antrian_poli_umums set id_antrian = $temp_id3 where id_antrian=".$id2."");

            $updateidakhir =  DB::select("UPDATE tbl_antrian_poli_umums set id_antrian = $id_akhir where id_antrian=".$temp_id."");
            // $updateidakhir1 =  DB::select("UPDATE tbl_antri_pendaftaran set id_antrian = $id1_akhir where id_antrian=".$temp_id1."");
            $updateidakhir2 =  DB::select("UPDATE tbl_antrian_poli_umums set id_antrian = $id1_akhir where id_antrian=".$temp_id2."");            
            $updateidakhir3 =  DB::select("UPDATE tbl_antrian_poli_umums set id_antrian = $id2_akhir where id_antrian=".$temp_id3."");            
            $updateidakhir4 =  DB::select("UPDATE tbl_antrian_poli_umums set id_antrian = $id_akhir-1 where id_antrian=".$id_akhir."");
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
            $antrian = DB::select("UPDATE tbl_antrian_poli_umums set status='lewati' where id_antrian=".$id."");
            $updatedata =  DB::select("UPDATE tbl_antrian_poli_umums set urutan = $urutan_akhir where id_antrian=".$id."");
            $updatedata1 =  DB::select("UPDATE tbl_antrian_poli_umums set urutan = $urutan_akhir1 where id_antrian=".$id1."");
            $updatedata2 =  DB::select("UPDATE tbl_antrian_poli_umums set urutan = $urutan_akhir2 where id_antrian=".$id2."");
            
            $updateid =  DB::select("UPDATE tbl_antrian_poli_umums set id_antrian = $temp_id where id_antrian=".$id."");
            $updateid1 =  DB::select("UPDATE tbl_antrian_poli_umums set id_antrian = $temp_id1 where id_antrian=".$id1."");
            $updateid2 =  DB::select("UPDATE tbl_antrian_poli_umums set id_antrian = $temp_id2 where id_antrian=".$id2."");
            
            $updateidakhir =  DB::select("UPDATE tbl_antrian_poli_umums set id_antrian = $id_akhir where id_antrian=".$temp_id."");
            $updateidakhir1 =  DB::select("UPDATE tbl_antrian_poli_umums set id_antrian = $id1_akhir where id_antrian=".$temp_id1."");
            $updateidakhir2 =  DB::select("UPDATE tbl_antrian_poli_umums set id_antrian = $id2_akhir where id_antrian=".$temp_id2."");            
            $updateidakhir3 =  DB::select("UPDATE tbl_antrian_poli_umums set id_antrian = $id_akhir-2 where id_antrian=".$id_akhir."");
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
    // public function lewati($id)
    // {
    //     $antrian = DB::select("UPDATE tbl_antri_pendaftaran set status='lewati' where id_antrian=".$id."");
    //     return redirect('/daftarantrian');
    // }

    public function hapus($id)
    {
        // print($id);
        $antrian = DB::select("UPDATE tbl_antrian_poli_umums set status='hapus' where id_antrian=".$id."");
        return redirect('/perawatumum');
    }

    public function proses($id)
    {
        // print($id);
        $antrian = DB::select("UPDATE tbl_antrian_poli_umums set status='proses' where id_antrian=".$id."");
        return redirect('/perawatumum');
    }
    
    public function storeperawat(Request $request)
    {   
        date_default_timezone_set('Asia/jakarta');
        $tanggal=date('Y-m-d');
        $waktu=date("Y-m-d H:i:s");
        // echo ($tanggal);
        
        $data_rm = DB::select("select * from tbl_rekam_medis where no_rm='".$request->no_rm."' and tanggal_kunjungan='".$tanggal. "'");  
        
        $Tbl_asuhanperawatan = new Tbl_asuhan_keperawatan;
        $Tbl_asuhanperawatan->id_pemeriksaan=$data_rm[0]->id_pemeriksaan;
        $Tbl_asuhanperawatan->no_rm=$request->no_rm;
        $Tbl_asuhanperawatan->tanggal=$tanggal;
        $Tbl_asuhanperawatan->jam_mulai=$request->waktu_mulai;
        $Tbl_asuhanperawatan->rpd=$request->rpd;
        $Tbl_asuhanperawatan->rpk=$request->rpk;
        $Tbl_asuhanperawatan->rps=$request->rps;
        $Tbl_asuhanperawatan->nb_subjective=$request->s;
        $Tbl_asuhanperawatan->tb=$request->tb;
        $Tbl_asuhanperawatan->bb=$request->bb;
        $Tbl_asuhanperawatan->imt=$request->imt;
        $Tbl_asuhanperawatan->suhu=$request->suhu;
        $Tbl_asuhanperawatan->rr=$request->nafas;
        $Tbl_asuhanperawatan->sistol=$request->sistol;
        $Tbl_asuhanperawatan->diastol=$request->diastol;
        $Tbl_asuhanperawatan->nb_object=$request->o;
        $Tbl_asuhanperawatan->nb_assessment=$request->a;
        $Tbl_asuhanperawatan->nb_plan=$request->p;
        $Tbl_asuhanperawatan->jam_selesai=$waktu;
        $Tbl_asuhanperawatan->penanggungjawab=session('user_data')[0]['nama'];
        $Tbl_asuhanperawatan->save();
        
        $this->proses($request->id_antrian);
        return redirect ('/perawatumum');
    }

    public function layani($id, $id2)
    {
        date_default_timezone_set('Asia/jakarta');
        $tanggal=date('Y-m-d');
        $waktu=date("Y-m-d H:i:s");
        $judul = 'Asuhan Keperawatan';
        // $family = DB::select("select * from tbl_datapasiens where no_rm = '".$id2."'");
        // $data_poli = DB::select("select * from tbl_antrian_poli_umums where id_antrian =".$id."");   
        $data = DB::select("SELECT * FROM tbl_antrian_poli_umums JOIN tbl_datapasiens on tbl_datapasiens.no_rm=tbl_antrian_poli_umums.no_rm where tbl_antrian_poli_umums.id_antrian=".$id."");
        $data[0]->tanggal =  $tanggal;
        $data[0]->waktu_mulai =  $waktu;
        // echo($id2);
        // print_r($data_poli);
        // print_r($data);
        return view('perawat/v_askep',['data' => $data, 'judul' => $judul]);
    }    

    public function history()
    {
        $judul = 'Daftar Pelayanan Pasien';
        $history = DB::select("SELECT * FROM tbl_antrian_poli_umums JOIN tbl_datapasiens on tbl_datapasiens.no_rm=tbl_antrian_poli_umums.no_rm where tbl_antrian_poli_umums.status!='Masuk' AND tbl_antrian_poli_umums.status!='proses' AND tbl_antrian_poli_umums.status!='Masuk' AND tbl_antrian_poli_umums.status!='lewati'  ");
        // print_r($history);
        return view('perawat/v_history', ['history' => $history,'judul' => $judul]);
    }

    public function showlaporanrm()
    {
        $judul = 'Daftar Pelayanan Pasien';
        // $data = DB::select("SELECT tbl_resep_obat.jenis_resep,tbl_resep_obat.signa, tbl_resep_obat.aturan_pakai, tbl_tindakan_rm.tindakan, tbl_tindakan_rm.penanggung_jawab, tbl_tindakan_rm.perawat,tbl_penyuluhan.isi_penyuluhan, tbl_diagnosa_rm.nama_diagnosa, tbl_pemeriksaan_rm.tinggi_badan, tbl_pemeriksaan_rm.berat_badan,tbl_pemeriksaan_rm.imt,tbl_pemeriksaan_rm.suhu,tbl_pemeriksaan_rm.rr,tbl_pemeriksaan_rm.sistol,tbl_pemeriksaan_rm.diastol,tbl_anamnesa_rm.rpd,tbl_anamnesa_rm.rps,tbl_anamnesa_rm.rpk,tbl_pendaftarans.tanggal, tbl_pendaftarans.tipe_kunjungan, tbl_datapasiens.nama, tbl_datapasiens.no_rm, tbl_datapasiens.nama_kk, tbl_datapasiens.alamat, tbl_datapasiens.jenis_kelamin, tbl_datapasiens.umur, tbl_datapasiens.jenis_asuransi, tbl_datapasiens.pekerjaan,tbl_antrian_poli_umums.poli_asal ,tbl_rekam_medis.no_rm, tbl_rekam_medis.id_pemeriksaan, tbl_rekam_medis.waktu_selesai, tbl_asuhan_keperawatan.jam_mulai FROM tbl_asuhan_keperawatan,tbl_rekam_medis,tbl_tindakan_rm,tbl_diagnosa_rm,tbl_pemeriksaan_rm,tbl_anamnesa_rm,tbl_datapasiens, tbl_antrian_poli_umums, tbl_pendaftarans, tbl_penyuluhan, tbl_resep_obat where tbl_antrian_poli_umums.status = 'selesai' AND tbl_asuhan_keperawatan.no_rm =  tbl_antrian_poli_umums.no_rm AND tbl_datapasiens.no_rm = tbl_antrian_poli_umums.no_rm AND tbl_pendaftarans.no_rm = tbl_antrian_poli_umums.no_rm AND tbl_anamnesa_rm.no_rm = tbl_pendaftarans.no_rm AND tbl_pemeriksaan_rm.no_rm = tbl_anamnesa_rm.no_rm AND tbl_diagnosa_rm.no_rm = tbl_pemeriksaan_rm.no_rm AND tbl_penyuluhan.no_rm = tbl_diagnosa_rm.no_rm AND tbl_tindakan_rm.no_rm = tbl_penyuluhan.no_rm AND tbl_resep_obat.id_pemeriksaan = tbl_rekam_medis.id_pemeriksaan AND tbl_rekam_medis.no_rm = tbl_penyuluhan.no_rm  AND tbl_antrian_poli_umums.no_rm ");
        
        $rm = DB::select("SELECT * FROM tbl_rekam_medis");
        $antrian = DB::select("SELECT * FROM tbl_antrian_poli_umums WHERE status = 'selesai' ");
        $pasien = DB::select("SELECT * FROM tbl_datapasiens");
        $anamnesa = DB::select("SELECT * FROM tbl_anamnesa_rm");
        $asuhan = DB::select("SELECT * FROM tbl_asuhan_keperawatan");
        $tindakan = DB::select("SELECT * FROM tbl_tindakan_rm");
        $penyuluhan = DB::select("SELECT * FROM tbl_penyuluhan");
        foreach($antrian as $antrians){
            foreach($pasien as $pasiens){
                if($pasiens->no_rm==$antrians->no_rm){
                    $antrians->nama = $pasiens->nama;
                    $antrians->nama_kk = $pasiens->nama_kk;
                    $antrians->alamat = $pasiens->alamat;
                    $antrians->jenis_kelamin = $pasiens->jenis_kelamin;
                    $antrians->umur = $pasiens->umur;
                    $antrians->jenis_asuransi = $pasiens->jenis_asuransi;
                    $antrians->pekerjaan = $pasiens->pekerjaan;
                }
            }
            foreach($rm as $r){
                if($r->no_rm==$antrians->no_rm){
                    $antrians->id_pemeriksaan = $r->id_pemeriksaan;
                }
            }
        }
        foreach($antrian as $antrians){
            foreach($anamnesa as $anamnesas){
                if($anamnesas->id_pemeriksaan==$antrians->id_pemeriksaan){
                    $antrians->arpd = $anamnesas->rpd;
                    $antrians->arpk = $anamnesas->rpk;
                    $antrians->arps = $anamnesas->rps;
                }
            }
            foreach($asuhan as $asuh){
                if($asuh->id_pemeriksaan==$antrians->id_pemeriksaan){
                    $antrians->rpd = $asuh->rpd;
                    $antrians->rpk = $asuh->rpk;
                    $antrians->rps = $asuh->rps;
                    $antrians->nb_subjective = $asuh->nb_subjective;
                    $antrians->tb = $asuh->tb;
                    $antrians->bb = $asuh->bb;
                    $antrians->imt = $asuh->imt;
                    $antrians->suhu = $asuh->suhu;
                    $antrians->rr = $asuh->rr;
                    $antrians->sistol = $asuh->sistol;
                    $antrians->diastol = $asuh->diastol;
                    $antrians->nb_object = $asuh->nb_object;
                    $antrians->nb_assessment = $asuh->nb_assessment;
                    $antrians->nb_plan = $asuh->nb_plan;
                    $antrians->penanggungjawab = $asuh->penanggungjawab;
                    $antrians->jam_mulai = $asuh->jam_mulai;
                    $antrians->jam_selesai = $asuh->jam_selesai;
                    
                }
            }
            foreach($tindakan as $tindakans){
                if($tindakans->id_pemeriksaan==$antrians->id_pemeriksaan){
                    $antrians->tindakan = $tindakans->tindakan;
                    $antrians->penanggung_jawab = $tindakans->penanggung_jawab;
                    $antrians->perawat = $tindakans->perawat;
                }
            }
            foreach($penyuluhan as $p){
                if($p->id_pemeriksaan==$antrians->id_pemeriksaan){
                    $antrians->isi_penyuluhan = $p->isi_penyuluhan;
                }
            }
            
        }
        //tanggal, poliasal,no_rm = tbl_antrian_poli_umums
        //nama, no_rm, nama_kk, alamat, jenis_kelamin, umur, asuransi, pekerjaan = tbl_datapasiens
        //anamnesa, no_rm, = tbl_anamnesa_rm
        //pemeriksaan, no_rm = tbl_pasuhan keperawatan
        //tindakan, id pemeriksaan, no rm, penanggungjawab = tbl_tindakan_rm
        //penyuluhan = tbl_penyuluhan rm
        //nama diagnosa, no rm, id pemeriksaan = tbl_diagnosa
        $diagnosa = DB::select("SELECT tbl_diagnosa_rm.id_pemeriksaan, tbl_diagnosa_rm.nama_diagnosa, tbl_diagnosa_rm.no_rm FROM tbl_diagnosa_rm, tbl_anamnesa_rm WHERE tbl_diagnosa_rm.id_pemeriksaan = tbl_anamnesa_rm.id_pemeriksaan");
        // print_r($diagnosa);
        
        
        
        //tipe kunjungan,norm,nama,tanggal = tbl_pendaftarans
        $kunjungan = DB::select("SELECT tbl_pendaftarans.tipe_kunjungan,tbl_antrian_poli_umums.no_rm, tbl_pendaftarans.tanggal FROM tbl_pendaftarans JOIN tbl_antrian_poli_umums ON tbl_antrian_poli_umums.no_rm = tbl_pendaftarans.no_rm AND tbl_antrian_poli_umums.created_at = tbl_pendaftarans.tanggal");

        //jenis pemeriksaan laborat, id_pemeriksaan = tbl_permintaan_lab
        $pemeriksaan = DB::select("SELECT tbl_permintaanlab.id_pemeriksaan, tbl_data_laborat_dokter.nama FROM tbl_permintaanlab, tbl_data_laborat_dokter, tbl_asuhan_keperawatan WHERE tbl_asuhan_keperawatan.id_pemeriksaan = tbl_permintaanlab.id_pemeriksaan AND tbl_permintaanlab.id_data_laborat_dokter = tbl_data_laborat_dokter.id_data_laborat_dokter ");
        // print_r($pemeriksaan);
       
        $dataobat = DB::select("SELECT * FROM tbl_resep_obat, tbl_resep_obats, tbl_rekam_medis WHERE tbl_resep_obat.id_resep = tbl_resep_obats.id_resep AND tbl_resep_obat.id_pemeriksaan = tbl_rekam_medis.id_pemeriksaan ");
        
        // print_r($kunjungan);

        return view('perawat/datalaporan/v_laporanrm', ['dataobat' => $dataobat, 'data' => $antrian, 'kunjungan' => $kunjungan, 'diagnosa' => $diagnosa, 'pemeriksaan' => $pemeriksaan, 'judul' => $judul]);
    }

    public function exportCsv()
    {
        $fileName = 'laporan poli umum.csv';
        $rm = DB::select("SELECT * FROM tbl_rekam_medis");
        $antrian = DB::select("SELECT * FROM tbl_antrian_poli_umums WHERE status = 'selesai' ");
        $pasien = DB::select("SELECT * FROM tbl_datapasiens");
        $anamnesa = DB::select("SELECT * FROM tbl_anamnesa_rm");
        $asuhan = DB::select("SELECT * FROM tbl_asuhan_keperawatan");
        $tindakan = DB::select("SELECT * FROM tbl_tindakan_rm");
        $penyuluhan = DB::select("SELECT * FROM tbl_penyuluhan");
        
        $diagnosa = DB::select("SELECT tbl_diagnosa_rm.id_pemeriksaan, tbl_diagnosa_rm.nama_diagnosa, tbl_diagnosa_rm.no_rm FROM tbl_diagnosa_rm, tbl_anamnesa_rm WHERE tbl_diagnosa_rm.id_pemeriksaan = tbl_anamnesa_rm.id_pemeriksaan");
        $kunjungan = DB::select("SELECT tbl_pendaftarans.tipe_kunjungan,tbl_antrian_poli_umums.no_rm, tbl_pendaftarans.tanggal FROM tbl_pendaftarans JOIN tbl_antrian_poli_umums ON tbl_antrian_poli_umums.no_rm = tbl_pendaftarans.no_rm AND tbl_antrian_poli_umums.created_at = tbl_pendaftarans.tanggal");
        $pemeriksaan = DB::select("SELECT tbl_permintaanlab.id_pemeriksaan, tbl_data_laborat_dokter.nama FROM tbl_permintaanlab, tbl_data_laborat_dokter, tbl_asuhan_keperawatan WHERE tbl_asuhan_keperawatan.id_pemeriksaan = tbl_permintaanlab.id_pemeriksaan AND tbl_permintaanlab.id_data_laborat_dokter = tbl_data_laborat_dokter.id_data_laborat_dokter ");
        $dataobat = DB::select("SELECT * FROM tbl_resep_obat, tbl_resep_obats, tbl_rekam_medis WHERE tbl_resep_obat.id_resep = tbl_resep_obats.id_resep AND tbl_resep_obat.id_pemeriksaan = tbl_rekam_medis.id_pemeriksaan ");
        
        foreach($antrian as $antrians){
            $antrians->nama_pemeriksaan = array();
            $antrians->diagnosa = array();
            foreach($pasien as $pasiens){
                if($pasiens->no_rm==$antrians->no_rm){
                    $antrians->nama = $pasiens->nama;
                    $antrians->nama_kk = $pasiens->nama_kk;
                    $antrians->alamat = $pasiens->alamat;
                    $antrians->jenis_kelamin = $pasiens->jenis_kelamin;
                    $antrians->umur = $pasiens->umur;
                    $antrians->jenis_asuransi = $pasiens->jenis_asuransi;
                    $antrians->pekerjaan = $pasiens->pekerjaan;
                }
            }
            foreach($rm as $r){
                if($r->no_rm==$antrians->no_rm){
                    $antrians->id_pemeriksaan = $r->id_pemeriksaan;
                }
            }
            foreach($kunjungan as $k){
                if($k->no_rm == $antrians->no_rm){
                    $antrians->tipe_kunjungan = $k->tipe_kunjungan;
                }
            }
        }
        foreach($antrian as $antrians){
            $antrians->nama_obat= array();
            foreach($anamnesa as $anamnesas){
                if($anamnesas->id_pemeriksaan==$antrians->id_pemeriksaan){
                    $antrians->arpd = $anamnesas->rpd;
                    $antrians->arpk = $anamnesas->rpk;
                    $antrians->arps = $anamnesas->rps;
                }
            }
            foreach($asuhan as $asuh){
                if($asuh->id_pemeriksaan==$antrians->id_pemeriksaan){
                    $antrians->rpd = $asuh->rpd;
                    $antrians->rpk = $asuh->rpk;
                    $antrians->rps = $asuh->rps;
                    $antrians->nb_subjective = $asuh->nb_subjective;
                    $antrians->tb = $asuh->tb;
                    $antrians->bb = $asuh->bb;
                    $antrians->imt = $asuh->imt;
                    $antrians->suhu = $asuh->suhu;
                    $antrians->rr = $asuh->rr;
                    $antrians->sistol = $asuh->sistol;
                    $antrians->diastol = $asuh->diastol;
                    $antrians->nb_object = $asuh->nb_object;
                    $antrians->nb_assessment = $asuh->nb_assessment;
                    $antrians->nb_plan = $asuh->nb_plan;
                    $antrians->penanggungjawab = $asuh->penanggungjawab;
                    $antrians->jam_mulai = $asuh->jam_mulai;
                    $antrians->jam_selesai = $asuh->jam_selesai;
                    
                }
            }
            foreach($tindakan as $tindakans){
                if($tindakans->id_pemeriksaan==$antrians->id_pemeriksaan){
                    $antrians->tindakan = $tindakans->tindakan;
                    $antrians->penanggung_jawab = $tindakans->penanggung_jawab;
                    $antrians->perawat = $tindakans->perawat;
                }
            }
            foreach($penyuluhan as $p){
                if($p->id_pemeriksaan==$antrians->id_pemeriksaan){
                    $antrians->isi_penyuluhan = $p->isi_penyuluhan;
                }
            }
            foreach($pemeriksaan as $p){
                if($p->id_pemeriksaan == $antrians->id_pemeriksaan){
                    array_push($antrians->nama_pemeriksaan,$p->nama);
                }
            }
            foreach($diagnosa as $d){
                if($d->id_pemeriksaan == $antrians->id_pemeriksaan){
                    array_push($antrians->diagnosa,$d->nama_diagnosa);
                }
            }  
            foreach($dataobat as $d){
                if($d->id_pemeriksaan == $antrians->id_pemeriksaan){
                    $antrians->jenis_resep = $d->jenis_resep;
                    $antrians->signa = $d->signa;
                    $antrians->aturan_pakai = $d->aturan_pakai;
                    array_push($antrians->nama_obat,$d->nama_obat);
                }
            }  
                
            
        }
        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );
        // $columns = array('nama');
        // $columns = array('Tanggal', 'Poli Asal',' Nama Pasien',' Nomor Rekam Medis', 'Nama KK','Alamat', 'Jenis Kelamin', 'Umur', 'Jenis Kunjungan Dalam 1 Tahun(baru/lama)', 'Jenis Asuransi(BPJS/Umum)', 'Jenis Kelamin', 'Pekerjaan', 'Anamnesa', 'Pemeriksaan', 'Diagnosa', 'Jenis Tindakan', 'Penyuluhan', 'Resep Obat', 'Tenaga Medis 1',' Tenaga Medis 2' );
        $columns = array('Tanggal','Poli Asal',' Nama Pasien',' Nomor Rekam Medis', 'Nama KK','Alamat', 'Jenis Kelamin', 'Umur', 'Jenis Kunjungan Dalam 1 Tahun(baru/lama)', 'Jenis Asuransi(BPJS/Umum)', 'Pekerjaan', 'Anamnesa', 'Pemeriksaan','Pemeriksaan Laborat', 'Diagnosa', 'Jenis Tindakan', 'Penyuluhan', 'Resep Obat','Waktu Mulai','Waktu Selesai', 'Tenaga Medis 1', 'Tenaga Medis 2' );

        $callback = function() use($antrian, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($antrian as $datas) {
                $row['Tanggal']  = $datas->created_at;
                $row['Poli Asal']    = $datas->poli_asal;
                $row['Nama Pasien']    = $datas->nama;
                $row['Nomor Rekam Medis']  = $datas->no_rm;
                $row['Nama KK']  = $datas->nama_kk;
                $row['Alamat']  = $datas->alamat;
                $row['Jenis Kelamin']    = $datas->jenis_kelamin;
                $row['Umur']    = $datas->umur;
                $row['Jenis Kunjungan Dalam 1 Tahun(baru/lama)']  = $datas->tipe_kunjungan;
                $row['Jenis Asuransi(BPJS/Umum)']  = $datas->jenis_asuransi;
                $row['Pekerjaan']    = $datas->pekerjaan;
                $row['Anamnesa']    = "RPS: ".$datas->arps.",RPD: ".$datas->arpd.",RPK: ".$datas->arpk;
                $row['Pemeriksaan']  = $datas->tb.",".$datas->bb.",".$datas->imt.",".$datas->rr.",".$datas->sistol.",".$datas->diastol;
                $row['Pemeriksaan Laborat'] = implode(', ',$datas->nama_pemeriksaan);
                $row['Diagnosa']  = implode(', ',$datas->diagnosa);
                $row['Jenis Tindakan']  = $datas->tindakan;
                $row['Penyuluhan']    = $datas->isi_penyuluhan;
                $row['Resep Obat']    = "Jenis Resep: ".$datas->jenis_resep."| Signa Obat".$datas->signa."Aturan Pakai: ".$datas->aturan_pakai;
                $row['Waktu Mulai'] = $datas->jam_mulai;
                $row['Waktu Selesai'] = $datas->jam_selesai;
                $row['Tenaga Medis 1']  = $datas->penanggung_jawab;
                $row['Tenaga Medis 2']  = $datas->perawat;
                //fungsi php
                fputcsv($file, array($row['Tanggal'], $row['Poli Asal'], $row['Nama Pasien'], $row['Nomor Rekam Medis'], $row['Nama KK'], $row['Alamat'], $row['Jenis Kelamin'], $row['Umur'], $row['Jenis Kunjungan Dalam 1 Tahun(baru/lama)'], $row['Jenis Asuransi(BPJS/Umum)'], $row['Pekerjaan'], $row['Anamnesa'], $row['Pemeriksaan'], $row['Pemeriksaan Laborat'] ,$row['Diagnosa'], $row['Jenis Tindakan'], $row['Penyuluhan'], $row['Resep Obat'], $row['Waktu Mulai'], $row['Waktu Selesai'] , $row['Tenaga Medis 1'], $row['Tenaga Medis 2']));
                // fputcsv($file, array($row['Tanggal'], $row['Poli Asal'], ['Nama Pasien'], $row['Nomor Rekam Medis'], $row['Nama KK'], $row['Alamat'], $row['Jenis Kelamin'], $row['Umur'], $row['Jenis Kunjungan Dalam 1 Tahun(baru/lama)'], $row['Jenis Asuransi(BPJS/Umum)'], $row['Pekerjaan'] , $row['Anamnesa'], $row['Pemeriksaan'], $row['Diagnosa'], $row['Jenis Tindakan'], $row['Penyuluhan'] , $row['Resep Obat'] , $row['Tenaga Medis 1'] , $row['Tenaga Medis 2']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
    // public function exportCsv(){
        
    //     return Excel::download(new DataExport, 'Laporan Poli Umum.xlsx');
    // }


    public function panggil($no){
        // $data_pendaftaran =  DB::select("select *  from tbl_antri_pendaftaran where id_antrian='".$no."'");
        $data_pendaftaran =  DB::select("select *  from tbl_antrian_poli_umums where id_antrian='".$no."'");
        $data_pendaftaran[0]->nama_poli = "Poli Umum";
        
        
        print_r($data_pendaftaran);
        broadcast(new PanggilPendaftaranEvent($data_pendaftaran));
        // return redirect ('/daftarantrian');
    }



  

   
}

// Class DataExport implements FromCollection{
//     function collection(){
//         $data = DB::select("SELECT tbl_resep_obat.jenis_resep,tbl_resep_obat.signa, tbl_resep_obat.aturan_pakai, tbl_tindakan_rm.tindakan, tbl_tindakan_rm.penanggung_jawab, tbl_tindakan_rm.perawat,tbl_penyuluhan.isi_penyuluhan, tbl_diagnosa_rm.nama_diagnosa, tbl_pemeriksaan_rm.tinggi_badan, tbl_pemeriksaan_rm.berat_badan,tbl_pemeriksaan_rm.imt,tbl_pemeriksaan_rm.suhu,tbl_pemeriksaan_rm.rr,tbl_pemeriksaan_rm.sistol,tbl_pemeriksaan_rm.diastol,tbl_anamnesa_rm.rpd,tbl_anamnesa_rm.rps,tbl_anamnesa_rm.rpk,tbl_pendaftarans.tanggal, tbl_pendaftarans.tipe_kunjungan, tbl_datapasiens.nama, tbl_datapasiens.no_rm, tbl_datapasiens.nama_kk, tbl_datapasiens.alamat, tbl_datapasiens.jenis_kelamin, tbl_datapasiens.umur, tbl_datapasiens.jenis_asuransi, tbl_datapasiens.pekerjaan,tbl_antrian_poli_umums.poli_asal ,tbl_rekam_medis.no_rm, tbl_rekam_medis.id_pemeriksaan FROM tbl_rekam_medis,tbl_tindakan_rm,tbl_diagnosa_rm,tbl_pemeriksaan_rm,tbl_anamnesa_rm,tbl_datapasiens, tbl_antrian_poli_umums, tbl_pendaftarans, tbl_penyuluhan, tbl_resep_obat where tbl_datapasiens.no_rm = tbl_antrian_poli_umums.no_rm && tbl_pendaftarans.no_rm = tbl_antrian_poli_umums.no_rm && tbl_anamnesa_rm.no_rm = tbl_pendaftarans.no_rm && tbl_pemeriksaan_rm.no_rm = tbl_anamnesa_rm.no_rm && tbl_diagnosa_rm.no_rm = tbl_pemeriksaan_rm.no_rm && tbl_penyuluhan.no_rm = tbl_diagnosa_rm.no_rm && tbl_tindakan_rm.no_rm = tbl_penyuluhan.no_rm && tbl_resep_obat.id_pemeriksaan = tbl_rekam_medis.id_pemeriksaan && tbl_rekam_medis.no_rm = tbl_penyuluhan.no_rm && tbl_antrian_poli_umums.no_rm ");
//         return $data;
//     }
// }
