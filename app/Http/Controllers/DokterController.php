<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tbl_asuhan_keperawatan;
use App\Tbl_datapasien;
use App\Tbl_icdx;
use App\Tbl_anamnesa;
use App\Tbl_pemeriksaan;
use App\Tbl_diagnosa;
use App\Tbl_tindakan;
use App\Tbl_resep_obat;
use App\Tbl_resep_obats;
use App\Tbl_RekamMedis;
use App\Tbl_penyuluhan;
use App\Tbl_permintaan_lab;
use App\Tbl_antrian_kasir;
use App\Tbl_antrian_laboratorium;
use App\Tbl_jenis_dokter;
use Session;
use Illuminate\Support\Facades\DB;
use App\Events\PanggilPerawatEvent;
use App\tbl_antrian_poli_umum;
use App\Tbl_data_laborat_dokter;
use App\Tbl_data_obat;
use App\Tbl_data_tindakan;
use App\Tbl_pengguna;
use App\Tbl_poli;

class DokterController extends Controller
{
    //
    public function tambahObat(Request $request){
        
        //menyimpan resep obat
        $Tbl_resep_obat = new Tbl_resep_obat;
        $Tbl_resep_obat->id_pemeriksaan=$request->id_pemeriksaan;
        $Tbl_resep_obat->jenis_resep=$request->jenis;
        $Tbl_resep_obat->signa=$request->signa;
        $Tbl_resep_obat->aturan_pakai=$request->aturan_pakai;
        $Tbl_resep_obat->save();

        //mengambil data resep terakhir
        // $lastdata = DB::table('tbl_resep_obat')->latest('id_resep')->first();
        $lastdata = Tbl_resep_obat::latest('id_resep')->first();
        // echo($lastdata);exit();
        $lastindex = $lastdata->id_resep;
        //$listresep = DB::table('tbl_resep_obat')->count();
        // $listresep= Tbl_resep_obat::all()->count();
        
        //ambil data obat
        // $obat = DB::select("select * from tbl_data_obat"); 
        $obat= Tbl_data_obat::all();
        $dataobat = array();
        $idobatpasien = array();
        $obatpasien = array();
        foreach($obat as $obats){
            array_push($dataobat,$obats);
        }
        // hitung obat
        $countobat = count($request->nama_obat);
        // echo ($countobat);
        for($i = 0 ; $i < $countobat-1 ; $i++ ){
            array_push($obatpasien,$request->nama_obat[$i]);
            // array_push($obatpasien,$dataobat[$i]->nama_obat[$i]);
        }
        for($i = 0 ; $i < count($dataobat) ; $i++ ){
            for($j = 0 ; $j < $countobat-1 ; $j++  ){
                if($dataobat[$i]->nama_obat == $request->nama_obat[$j]){
                    array_push($idobatpasien,$dataobat[$i]->id_obat);
                }
            }
            // array_push($obatpasien,$dataobat[$i]->nama_obat[$i]);
        }
        // echo ("/n");
        // print_r($idobatpasien);
        if($countobat>1){
            for($i = 0; $i<$countobat-1; $i++){
                $Tbl_resep_obats = new Tbl_resep_obats;
                $Tbl_resep_obats->id_resep=$lastindex;
                $Tbl_resep_obats->nama_obat=$obatpasien[$i];
                $Tbl_resep_obats->id_obat=$dataobat[$i]->id_obat;
                $Tbl_resep_obats->jumlah=$request->jk[$i];
                $Tbl_resep_obats->status="tersedia";
                $Tbl_resep_obats->save();
            }    
        }else{
            for($i = 0; $i<$countobat; $i++){
                $Tbl_resep_obats = new Tbl_resep_obats;
                $Tbl_resep_obats->id_resep=$lastindex;
                $Tbl_resep_obats->nama_obat=$obatpasien[$i];
                $Tbl_resep_obats->id_obat=$request->nama_obat[$i];
                $Tbl_resep_obats->jumlah=$request->jk[$i];
                $Tbl_resep_obats->status="tersedia";
                $Tbl_resep_obats->save();
            }
        }
        return redirect ('/pelayanandokter/'.$request->no_rm.'/'.$request->id_pemeriksaan);

    //  return view('v_tambahff');
    }
    public function showpelayanan($id, $id2)
    {
        if(!Session::get('user_data')){
            return redirect('/login');
        }else{
            $judul = 'PELAYANAN PASIEN';
            date_default_timezone_set('Asia/jakarta');
            $tanggal=date('Y-m-d h:i:s');
            // $askep = DB::select("select * from tbl_asuhan_keperawatan where no_rm='".$id."' && id_pemeriksaan ='".$id2."'");
            $askep = Tbl_asuhan_keperawatan::where('no_rm', $id)->where('id_pemeriksaan',$id2)->get();
            // $anamnesa = DB::select("select * from tbl_anamnesa_rm where no_rm='".$id."' && id_pemeriksaan ='".$id2."'");
            $anamnesa = Tbl_anamnesa::where('no_rm',$id)->where('id_pemeriksaan',$id2)->get();
            // $pemeriksaan2 = DB::select("select * from tbl_pemeriksaan_rm where no_rm='".$id."' && id_pemeriksaan ='".$id2."'");
            $pemeriksaan2 = Tbl_pemeriksaan::where('no_rm',$id)->where('id_pemeriksaan',$id2)->get();
            // $checkanamnesa = DB::select("select * from tbl_anamnesa_rm where no_rm='".$id."' && id_pemeriksaan ='".$id2."'"); 
            $checkanamnesa = Tbl_anamnesa::where('no_rm',$id)->where('id_pemeriksaan',$id2)->get();
            if(count($checkanamnesa)!=0){
                // $data = DB::select("select * from tbl_anamnesa_rm where no_rm='".$id."' && id_pemeriksaan ='".$id2."'");
                $data = Tbl_anamnesa::where('no_rm',$id)->where('id_pemeriksaan',$id2)->get();
            }else{
                // $data = DB::select("select * from tbl_asuhan_keperawatan where no_rm='".$id."' && id_pemeriksaan ='".$id2."'");
                $data = Tbl_asuhan_keperawatan::where('no_rm',$id)->where('id_pemeriksaan',$id2)->get();
            }
            
            $checkpemeriksaan = DB::select("select * from tbl_pemeriksaan_rm where no_rm='".$id."' && id_pemeriksaan ='".$id2."'"); 
            if(count($checkpemeriksaan)!=0){
                // echo("1");
                // $pemeriksaan = DB::select("select * from tbl_pemeriksaan_rm where no_rm='".$id."' && id_pemeriksaan ='".$id2."'");
                $pemeriksaan = Tbl_pemeriksaan::where('no_rm',$id)->where('id_pemeriksaan',$id2)->get();
            }else{
                // $pemeriksaan = DB::select("select * from tbl_asuhan_keperawatan where no_rm='".$id."' && id_pemeriksaan ='".$id2."'");
                $pemeriksaan = Tbl_asuhan_keperawatan::where('no_rm',$id)->where('id_pemeriksaan',$id2)->get();
            }
            // $poli_asal = DB::select("select poli_asal from tbl_antrian_poli_umums where no_rm='".$id."'"); 
            $poli_asal = tbl_antrian_poli_umum::select('poli_asal')->where('no_rm', $id)->get();
            // $pasien = DB::select("select * from tbl_datapasiens where no_rm='".$id."'"); 
            $pasien = Tbl_datapasien::where('no_rm', $id)->get();
            // $diagnosa = DB::select("select * from tbl_diagnosa_rm where no_rm='".$id."' && status!='hapus' && id_pemeriksaan ='".$id2."'");  //perlu cek id_pemeriksaan
            $diagnosa = Tbl_diagnosa::where('no_rm', $id)->where('status','!=', 'hapus')->where('id_pemeriksaan', $id2)->get();
            // $pilihandiagnosa = DB::select("select * from tbl_data_icdx");
            $pilihandiagnosa = Tbl_icdx::all()->where('status','!=', 'hapus');
            // $tindakan = DB::select("select * from tbl_data_tindakan "); 
            $tindakan = Tbl_data_tindakan::where('nama_tindakan','!=','Layanan rawat jalan poli umum')->get();
            // $tindakan = Tbl_data_tindakan::all();
            // $tindakan_rm = DB::select("select * from tbl_tindakan_rm where no_rm='".$id."' && status!='hapus' && id_pemeriksaan ='".$id2."'"); 
            $tindakan_rm = Tbl_tindakan::where('no_rm', $id)->where('status','!=', 'hapus')->where('id_pemeriksaan', $id2)->get();
            // $dataobat = DB::select("SELECT * FROM tbl_data_obat JOIN tbl_data_stock_obat on tbl_data_stock_obat.id_obat=tbl_data_obat.id_obat where tbl_data_stock_obat.sisa!=0");
            $dataobat = DB::table('tbl_data_obat')
            ->join('tbl_data_stock_obat', function ($join) {
                $join->on('tbl_data_stock_obat.id_obat', '=', 'tbl_data_obat.id_obat');
            })
            ->where('tbl_data_stock_obat.sisa', '!=', '0')->where('tbl_data_stock_obat.status','tersedia')
            ->where('tbl_data_obat.status','tersedia')->get();
            $pasien[0]->poli_asal = $poli_asal[0]->poli_asal;
            $pasien[0]->tanggal = $tanggal;
            $pasien[0]->id_pemeriksaan = $data[0]->id_pemeriksaan;
            $dataobatpasien = DB::select("SELECT * FROM tbl_resep_obat JOIN tbl_resep_obats on tbl_resep_obat.id_resep=tbl_resep_obats.id_resep where tbl_resep_obats.status!='hapus' and tbl_resep_obat.id_pemeriksaan='".$id2."'");
            // $dataobatpasien = DB::table('tbl_resep_obat')
            // ->join('tbl_resep_obats', function ($join) {
            //     $join->on('tbl_resep_obat.id_resep','=', 'tbl_resep_obats.id_resep');
            // })
            // ->where('tbl_resep_obats.status','!=','hapus')->where('tbl_resep_obat.id_pemeriksaan=',$id2)
            // ->get();
            // $dataperawat = DB::select("select * from tbl_pengguna where role_id=4");
            $dataperawat = Tbl_pengguna::where('role_id', '4')->get();
            // $datajenislaborat =  DB::select("SELECT * from tbl_jenis_dokter WHERE tbl_jenis_dokter.status !='hapus'");
            $datajenislaborat = Tbl_jenis_dokter::where('status', '!=', 'hapus')->get();
            // $datalaborat = DB::select("SELECT * from tbl_data_laborat_dokter WHERE status!='hapus'");
            $datalaborat = Tbl_data_laborat_dokter::where('status', '!=', 'hapus')->get();
            $datahasillab = DB::select("SELECT * FROM tbl_hasil_lab, tbl_nama_pemeriksaan, tbl_jenis_dokter where tbl_hasil_lab.id_nama_pemeriksaan=tbl_nama_pemeriksaan.id_nama_pemeriksaan AND tbl_hasil_lab.id_jenis_pemeriksaan=tbl_jenis_dokter.id_jenis_dokter AND tbl_hasil_lab.id_pemeriksaan='".$id2."'");
            // $datahasillab = 
            // $data[0]->waktu = $waktu;
            // print_r($dataobatpasien);
            // print_r($pilihandiagnosa);
            // print_r($pemeriksaan);
            // echo($id);
            // echo($id2);
            $data_lab = DB::select("SELECT a.id_pemeriksaan, b.hasil_pemeriksaan_lab, c.nama_pemeriksaan  FROM tbl_rekam_medis a, tbl_hasil_lab b, tbl_nama_pemeriksaan c where a.no_rm='".$id."' AND a.id_pemeriksaan = b.id_pemeriksaan AND b.id_nama_pemeriksaan = c.id_nama_pemeriksaan ");
        // print_r($data_lab);
            $data_obat = DB::select("SELECT *  FROM tbl_resep_obats a, tbl_resep_obat b, tbl_rekam_medis c where c.no_rm='".$id."' AND b.id_pemeriksaan = c.id_pemeriksaan AND a.id_resep = b.id_resep");
        // print_r($data_obat);
            $data_tindakan = DB::select("SELECT a.id_pemeriksaan, b.tindakan, b.keterangan  FROM tbl_rekam_medis a, tbl_tindakan_rm b where a.no_rm='".$id."' AND a.id_pemeriksaan = b.id_pemeriksaan");
            $rekammedis = DB::select("SELECT * FROM tbl_rekam_medis a, tbl_pemeriksaan_rm b, tbl_anamnesa_rm c, tbl_diagnosa_rm d, tbl_penyuluhan e where a.no_rm='".$id."' AND b.no_rm ='".$id."' And c.no_rm='".$id."' AND d.no_rm='".$id."' AND e.no_rm='".$id."' and a.id_pemeriksaan = b.id_pemeriksaan And a.id_pemeriksaan = c.id_pemeriksaan and a.id_pemeriksaan = d.id_pemeriksaan and a.id_pemeriksaan = e.id_pemeriksaan");
        // print_r($rekammedis);
            return view('dokter/v_pelayanan',['pilihandiagnosa'=>$pilihandiagnosa, 'hasillab'=>$datahasillab, 'laborat'=>$datalaborat, 'jenislab'=>$datajenislaborat, 'perawat'=>$dataperawat,'askep'=>$askep,'anamnesa'=>$anamnesa, 'pemeriksaan'=>$pemeriksaan, 'pemeriksaan2'=>$pemeriksaan2, 'dataobatpasien' => $dataobatpasien,'dataobat' => $dataobat,'tindakan_rm' => $tindakan_rm, 'tindakan'=> $tindakan, 'diagnosa' => $diagnosa,'pasien' => $pasien, 'data' => $data, 'judul' => $judul, 'rekammedis' => $rekammedis, 'data_lab' => $data_lab, 'data_tindakan' => $data_tindakan, 'data_obat' => $data_obat]);
            // }else{
                // return view('dokter/v_pelayanan',['pasien' => $pasien, 'data' => $data, 'judul' => $judul]);
            // }
        }
    }

    public function showantriandokter()
    {
        $judul = 'PELAYANAN PASIEN';
        date_default_timezone_set('Asia/jakarta');
        $tanggal=date('Y-m-d');
        //ganti ke antrian dokter
        $antrian = DB::select("SELECT * FROM tbl_antrian_poli_umums where status='proses' AND created_at='".$tanggal."'");
        $askep = DB::select("SELECT * FROM tbl_asuhan_keperawatan, tbl_datapasiens where tbl_asuhan_keperawatan.tanggal='".$tanggal."' and tbl_datapasiens.no_rm=tbl_asuhan_keperawatan.no_rm");
        
        $jdata = count($askep);
        $i=0;
        //buat data aksep
        for($a=0; $a<$jdata; $a++){
            // data antrians
            for($b=0; $b<count($antrian); $b++){
                if($antrian[$b]->no_rm == $askep[$a]->no_rm){
                    $askep[$a]->status = $antrian[$b]->status;
                }
            }
        }
        $antrian_final = array();
        $c=0;
        //data askep
        for($a=0; $a<$jdata; $a++){
            //isset kalau ada data status
            if(isset($askep[$a]->status)){
                if($askep[$a]->status =="proses"){
                    // $pasien = DB::select("SELECT * FROM tbl_datapasiens where no_index='".$askep[$a]->no_rm."'");
                    array_push($antrian_final, $askep[$a]);
                        // echo($c);
                        // $c++;
                }
            }    
        }

        return view('dokter/v_daftardatapasienmasuk',['antrian'=>$antrian_final,'judul' => $judul]);
    }
    public function showicdx()
    {
        $judul = 'PELAYANAN PASIEN';
        date_default_timezone_set('Asia/jakarta');
        $tanggal=date('Y-m-d');
        $data = DB::select("select * from tbl_data_icdx where status!='hapus'");  
        
        return view('dokter/v_tabel_diagnosis',['data'=>$data,'judul' => $judul]);
    }
    public function hapus($id)
    {
        $antrian = DB::select("UPDATE tbl_data_icdx set status='hapus' where id=".$id."");
        return redirect ('/dataicdx');
    }

    public function hapusresep($id1,$id2,$id3)
    {
        $antrian = DB::select("UPDATE tbl_resep_obats set status='hapus' where id=".$id3."");
        return redirect ('/pelayanandokter/'.$id1.'/'.$id2);
    }

    public function hapusdiagnosa($id1,$id2,$id3)
    {
        $antrian = DB::select("UPDATE tbl_diagnosa_rm set status='hapus' where id_diagnosa=".$id3."");
        return redirect ('/pelayanandokter/'.$id1.'/'.$id2);
    }

    public function hapustindakan($id1,$id2,$id3)
    {
        $antrian = DB::select("UPDATE tbl_tindakan_rm set status='hapus' where id_tindakan=".$id3."");
        return redirect ('/pelayanandokter/'.$id1.'/'.$id2);
    }

    public function storeicdx(Request $request)
    {
        date_default_timezone_set('Asia/jakarta');
        $tanggal=date('Y-m-d');
        $waktu=date("H:i:s");
        
        // $data_rm = DB::select("select * from tbl_rekam_medis where no_rm='".$request->no_rm."'");  

        $Tbl_icdx = new Tbl_icdx;
        $Tbl_icdx->icd_x=$request->icdx;
        $Tbl_icdx->nama_diagnosa=$request->diagnosa;
        $Tbl_icdx->save();
        
        return redirect ('/dataicdx');
    }

    public function storepenyuluhan(Request $request)
    {
        date_default_timezone_set('Asia/jakarta');
        $tanggal=date('Y-m-d');
        $waktuselesai=date("Y-m-d H:i:s");
        $waktu=date("h:i:s");
        

        $Tbl_penyuluhan = new Tbl_penyuluhan;
        $Tbl_penyuluhan->isi_penyuluhan=$request->lainnya;
        $Tbl_penyuluhan->no_rm=$request->no_rm;
        $Tbl_penyuluhan->id_pemeriksaan=$request->id_pemeriksaan;
        $Tbl_penyuluhan->save();
        // dd($request);
        $updatedokter = DB::select("UPDATE tbl_rekam_medis set waktu_selesai ='".$waktuselesai."' where id_pemeriksaan=".$request->id_pemeriksaan."");

        $updatestatus = DB::select("UPDATE tbl_antrian_poli_umums set status ='pembayaran' where no_rm='".$request->no_rm."' && created_at='".$tanggal."'");

        $data = DB::select("SELECT * FROM tbl_antrian_poli_umums where no_rm='".$request->no_rm."' && created_at='".$tanggal."'");
        
        $askep = DB::select("select penanggungjawab from tbl_asuhan_keperawatan where no_rm='".$request->no_rm."' && id_pemeriksaan ='".$request->id_pemeriksaan."'");
       
        $Tbl_tindakan = new Tbl_tindakan;
        $Tbl_tindakan->id_pemeriksaan=$request->id_pemeriksaan;
        $Tbl_tindakan->tindakan="Layanan rawat jalan poli umum";
        $Tbl_tindakan->keterangan="-";
        $Tbl_tindakan->waktu_tindakan=$tanggal;
        $Tbl_tindakan->penanggung_jawab=session('user_data')[0]['nama'];
        $Tbl_tindakan->no_rm = $request->no_rm;
        $Tbl_tindakan->perawat = $askep[0]->penanggungjawab;
        $Tbl_tindakan->save();

        $Tbl_antrian_kasir = new Tbl_antrian_kasir();
        // $tanggal=date('Y-m-d');
        $cek = $Tbl_antrian_kasir
            // ->where('id_poli', '=', $id_poli)
            ->where('tanggal', '=', $tanggal)
            ->count();
        $jumlah_antrian = $cek + 1;
        $Tbl_antrian_kasir->no_antrian=$data[0]->no_antrian;
        $Tbl_antrian_kasir->no_rm=$data[0]->no_rm;
        $Tbl_antrian_kasir->waktu=$waktu;
        $Tbl_antrian_kasir->status="pembayaran";
        $Tbl_antrian_kasir->poli_asal="Poli Umum";
        $Tbl_antrian_kasir->urutan = $jumlah_antrian;
        $Tbl_antrian_kasir->tanggal = $tanggal;
        $Tbl_antrian_kasir->save();

        return redirect ('/daftarantriandokter');
    }

    public function storepermintaanlab(Request $request)
    {
        date_default_timezone_set('Asia/jakarta');
        $tanggal=date('Y-m-d');
        $waktu=date("h:i:s");
        
        for($i =0 ; $i<count($request->id_laborat); $i++){
            $Tbl_permintaan_lab = new Tbl_permintaan_lab;
            $Tbl_permintaan_lab->id_data_laborat_dokter=$request->id_laborat[$i];
            $Tbl_permintaan_lab->status_permintaan="Baru";
            $Tbl_permintaan_lab->id_pemeriksaan=$request->id_pemeriksaan;
            $Tbl_permintaan_lab->tanggal=$tanggal;
            $Tbl_permintaan_lab->waktu=$waktu;
            $Tbl_permintaan_lab->dokter_penanggungjawab=session('user_data')[0]['nama'];
            
            $Tbl_permintaan_lab->save();
        }
       
        $data = DB::select("SELECT * FROM tbl_antrian_poli_umums where no_rm='".$request->no_rm."' && created_at='".$tanggal."'");
        
        $Tbl_antrian_laboratorium = new Tbl_antrian_laboratorium();
        $tanggal=date('Y-m-d');
        $cek = $Tbl_antrian_laboratorium
            // ->where('id_poli', '=', $id_poli)
            ->where('tanggal', '=', $tanggal)
            ->count();
        $jumlah_antrian = $cek + 1;
        $Tbl_antrian_laboratorium->no_antrian=$data[0]->no_antrian;
        $Tbl_antrian_laboratorium->no_rm=$data[0]->no_rm;
        $Tbl_antrian_laboratorium->waktu=$waktu;
        $Tbl_antrian_laboratorium->status="permintaanlab";
        $Tbl_antrian_laboratorium->poli_asal="Poli Umum";
        $Tbl_antrian_laboratorium->urutan = $jumlah_antrian;
        $Tbl_antrian_laboratorium->tanggal = $tanggal;
        $Tbl_antrian_laboratorium->save();

        
        // dd($request);

        $updatestatus = DB::select("UPDATE tbl_antrian_poli_umums set status ='permintaanlab' where no_rm='".$request->no_rm."' AND created_at='".$tanggal."'");
        //$status_permintaan_lab = DB::select("SELECT * FROM tbl_antrian_poli_umums where status='proses' AND created_at='".$tanggal."'");

        return redirect ('/daftarantriandokter');
        //return redirect ('/pelayanandokter/'.$request->no_rm.'/'.$request->id_pemeriksaan);
    }

    public function storeanamnesa(Request $request)
    {
        date_default_timezone_set('Asia/jakarta');
        $tanggal=date('Y-m-d');
        $waktu=date("H:i:s");
        
        $checkanamnesa = DB::select("select * from tbl_anamnesa_rm where no_rm='".$request->no_rm."' && id_pemeriksaan ='".$request->id_pemeriksaan."'"); 
       
        if(count($checkanamnesa)!=0){
            DB::table('tbl_anamnesa_rm')->where('id_pemeriksaan', $request->id_pemeriksaan)->update([
                'rpd'=>$request->rpd,
                'rpk'=>$request->rpk,
                'rps'=>$request->rps,
            ]);
        }else if(count($checkanamnesa)==0){
            $Tbl_anamnesa = new Tbl_anamnesa;
            $Tbl_anamnesa->id_pemeriksaan=$request->id_pemeriksaan;
            $Tbl_anamnesa->rpd=$request->rpd;
            $Tbl_anamnesa->rpk=$request->rpk;
            $Tbl_anamnesa->rps=$request->rps;
            $Tbl_anamnesa->no_rm=$request->no_rm;
            $Tbl_anamnesa->save();
        }
        $askep = DB::select("select penanggungjawab from tbl_asuhan_keperawatan where no_rm='".$request->no_rm."' && id_pemeriksaan ='".$request->id_pemeriksaan."'");
       
        $update= DB::table('tbl_rekam_medis')->where('id_pemeriksaan', $request->id_pemeriksaan)->update([
            'perawat_penanggung_jawab'=>$askep[0]->penanggungjawab,
            'dokter_penanggung_jawab'=>session('user_data')[0]['nama'],
        ]);
        
        // $Tbl_rekammedis = new Tbl_RekamMedis;
        // $Tbl_rekammedis->dokter_penanggung_jawab = session('user_data')[0]['nama'];
        // $Tbl_rekammedis->save();
        
        return redirect ('/pelayanandokter/'.$request->no_rm.'/'.$request->id_pemeriksaan);
    }
    
    public function storetindakan(Request $request)
    {
        date_default_timezone_set('Asia/jakarta');
        $tanggal=date('Y-m-d h:i:s');
        // $waktu=date("H:i:s");
        
        // $data_rm = DB::select("select * from tbl_rekam_medis where no_rm='".$request->no_rm."'");  

        $Tbl_tindakan = new Tbl_tindakan;
        $Tbl_tindakan->id_pemeriksaan=$request->id_pemeriksaan;
        $Tbl_tindakan->tindakan=$request->tindakan;
        $Tbl_tindakan->keterangan=$request->keterangan;
        $Tbl_tindakan->waktu_tindakan=$tanggal;
        $Tbl_tindakan->status="Masuk";
        $Tbl_tindakan->penanggung_jawab=session('user_data')[0]['nama'];
        $Tbl_tindakan->no_rm = $request->no_rm;
        $Tbl_tindakan->perawat = $request->perawat;
        $Tbl_tindakan->save();

        $perawat = $request->perawat;
        broadcast(new PanggilPerawatEvent($perawat));
        
        return redirect ('/pelayanandokter/'.$request->no_rm.'/'.$request->id_pemeriksaan);
    }

    public function storepemeriksaan(Request $request)
    {
        date_default_timezone_set('Asia/jakarta');
        $tanggal=date('Y-m-d');
        $waktu=date("H:i:s");

        $checkpemeriksaan = DB::select("select * from tbl_pemeriksaan_rm where no_rm='".$request->no_rm."' && id_pemeriksaan ='".$request->id_pemeriksaan."'"); 
       
        if(count($checkpemeriksaan)!=0){
            DB::table('tbl_pemeriksaan_rm')->where('id_pemeriksaan', $request->id_pemeriksaan)->update([
                'tinggi_badan'=>$request->tb,
                'berat_badan'=>$request->bb,
                // 'no_index'=>$request->no_index,
                'sistol'=>$request->sistol,
                'imt'=>$request->imt,
                'suhu'=>$request->suhu,
                'rr'=>$request->nafas,
                'diastol'=>$request->diastol,
            ]);
        }else if(count($checkpemeriksaan)==0){
            $Tbl_pemeriksaan = new Tbl_pemeriksaan;
            $Tbl_pemeriksaan->id_pemeriksaan=$request->id_pemeriksaan;
            $Tbl_pemeriksaan->tinggi_badan=$request->tb;
            $Tbl_pemeriksaan->berat_badan=$request->bb;
            $Tbl_pemeriksaan->sistol=$request->sistol;
            $Tbl_pemeriksaan->imt=$request->imt;
            $Tbl_pemeriksaan->suhu=$request->suhu;
            $Tbl_pemeriksaan->rr=$request->nafas;
            $Tbl_pemeriksaan->diastol=$request->diastol;
            $Tbl_pemeriksaan->no_rm=$request->no_rm;
            $Tbl_pemeriksaan->save();
            
        }
        
        // $data_rm = DB::select("select * from tbl_rekam_medis where no_rm='".$request->no_rm."'");  
        
        return redirect ('/pelayanandokter/'.$request->no_rm.'/'.$request->id_pemeriksaan);
    }

    public function storediagnosa(Request $request)
    {
        date_default_timezone_set('Asia/jakarta');
        $tanggal=date('Y-m-d');
        $waktu=date("H:i:s");

        $diagnosa = DB::select("select * from tbl_data_icdx"); 
        
        $countdiagnosapasien = count($diagnosa);
        // echo ($countdiagnosapasien);
        for($i = 0 ; $i < $countdiagnosapasien ; $i++ ){
            if($diagnosa[$i]->icd_x==$request->icdx){
                $namadiagnosa = $diagnosa[$i]->nama_diagnosa;
            }
        }
        // $data_rm = DB::select("select * from tbl_rekam_medis where no_rm='".$request->no_rm."'");  

        $Tbl_diagnosa = new Tbl_diagnosa;
        $Tbl_diagnosa->id_pemeriksaan=$request->id_pemeriksaan;
        $Tbl_diagnosa->icd_x=$request->icdx;
        $Tbl_diagnosa->nama_diagnosa=$namadiagnosa;
        $Tbl_diagnosa->no_rm=$request->no_rm;
        $Tbl_diagnosa->status="tersedia";
        $Tbl_diagnosa->save();
        
        return redirect ('/pelayanandokter/'.$request->no_rm.'/'.$request->id_pemeriksaan);
    }

    // public function pelayanan()
    // {
    //     $judul = 'PELAYANAN PASIEN';
    //     date_default_timezone_set('Asia/jakarta');
    //     $tanggal=date('Y-m-d');
        
    //     return view('dokter/v_pelayanan',['judul' => $judul]);
    // }

}
