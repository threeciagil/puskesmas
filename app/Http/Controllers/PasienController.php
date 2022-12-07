<?php

namespace App\Http\Controllers;

use App\Tbl_ff;
use App\Tbl_datapasien;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


class PasienController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function viewdataFF()
    {
        $judul = 'Daftar Family Folder';
        $family = DB::select("SELECT * FROM tbl_ffs");
        return view('datapasien/v_family',['family' => $family, 'judul' => $judul]);
    }

    public function viewaddfamily()
    {
        $judul = 'Tambah Data Family Folder';
        return view('datapasien/v_addfamily',['judul' => $judul]);
    }

    public function viewdatapasien($id)
    {
        $judul = 'Daftar Pasien';
        $pasien = DB::select("SELECT * FROM tbl_datapasiens where no_index='".$id."'");
        return view('datapasien/v_pasien', ['pasien' => $pasien, 'judul' => $judul]);
    }

    public function vieweditfamily($id)
    {
        $judul = 'Edit Data Family';
        $family = DB::select("SELECT * FROM tbl_ffs where no_index='".$id."'");
        // print_r($family);
        return view('datapasien/v_editfamily', ['family' => $family, 'judul' => $judul]);
    }

    public function vieweditpasien($id)
    {
        $judul = 'Edit Data Pasien';
        $pasien = DB::select("SELECT * FROM tbl_datapasiens where no_rm='".$id."'");
        // print_r($pasien);
        return view('datapasien/v_editpasien', ['pasien' => $pasien, 'judul' => $judul]);
    }

    public function viewaddfamilyrm()
    {
        $judul = 'Daftar Family Folder';
        $family = DB::select("SELECT * FROM tbl_ffs");
        return view('datapasien/v_family2',['family' => $family, 'judul' => $judul]);
    }

    public function viewdatapasienrm($id)
    {
        $judul = 'Daftar Pasien';
        $pasien = DB::select("SELECT * FROM tbl_datapasiens where no_index='".$id."'");
        return view('datapasien/v_pasien2', ['pasien' => $pasien, 'judul' => $judul]);
    }

    public function viewdatarmpendaftran($id)
    {
        $judul = 'Rekam Medis Pasien';
        $pasien =  DB::select("SELECT * FROM tbl_datapasiens where no_rm='".$id."'");
        $data_lab = DB::select("SELECT a.id_pemeriksaan, b.hasil_pemeriksaan_lab, c.nama_pemeriksaan  FROM tbl_rekam_medis a, tbl_hasil_lab b, tbl_nama_pemeriksaan c where a.no_rm='".$id."' AND a.id_pemeriksaan = b.id_pemeriksaan AND b.id_nama_pemeriksaan = c.id_nama_pemeriksaan ");
        // print_r($data_lab);
        $data_obat = DB::select("SELECT *  FROM tbl_resep_obats a, tbl_resep_obat b, tbl_rekam_medis c where c.no_rm='".$id."' AND b.id_pemeriksaan = c.id_pemeriksaan AND a.id_resep = b.id_resep");
        // print_r($data_obat);
        $data_tindakan = DB::select("SELECT a.id_pemeriksaan, b.tindakan, b.keterangan  FROM tbl_rekam_medis a, tbl_tindakan_rm b where a.no_rm='".$id."' AND a.id_pemeriksaan = b.id_pemeriksaan");
        $datadiagnosa = DB::select("SELECT a.id_pemeriksaan, b.icd_x, b.nama_diagnosa  FROM tbl_rekam_medis a, tbl_diagnosa_rm b where a.no_rm='".$id."' and a.id_pemeriksaan = b.id_pemeriksaan && status !='Hapus'");
        $rekammedis = DB::select("SELECT * FROM tbl_rekam_medis a, tbl_pemeriksaan_rm b, tbl_anamnesa_rm c, tbl_penyuluhan d where a.no_rm='".$id."' AND b.no_rm ='".$id."' And c.no_rm='".$id."' AND d.no_rm='".$id."' and a.id_pemeriksaan = b.id_pemeriksaan And a.id_pemeriksaan = c.id_pemeriksaan and a.id_pemeriksaan = d.id_pemeriksaan");
        // print_r($datadiagnosa);
       
        // return view('perawat/datapasien/v_rm', [ 'judul' => $judul, 'pasien' => $pasien,'diagnosa' => $datadiagnosa , 'rekammedis' => $rekammedis, 'data_lab' => $data_lab, 'data_tindakan' => $data_tindakan, 'data_obat' => $data_obat]);
        return view('datapasien/v_rekammedis', [ 'judul' => $judul, 'pasien' => $pasien,'diagnosa' => $datadiagnosa , 'rekammedis' => $rekammedis, 'data_lab' => $data_lab, 'data_tindakan' => $data_tindakan, 'data_obat' => $data_obat]);
    }

    public function viewaddpasien($id)
    {
        $judul = 'Tambah Data Pasien';
        $data['data_ff'] = DB::select("SELECT * from tbl_ffs where no_index='".$id."'");
        $data['jamkes'] = DB::select("select * from tbl_jamkes");
        $data['silsilah'] = ['Kepala Keluarga', 'Ibu', 'Lainnya'];
        $data['jenkel'] = ['Laki-laki', 'Perempuan'];
        $data['no_index'] = $id;
        return view('datapasien/v_addpasien', ['data' => $data,'judul' => $judul]);
    }
    
    public function tambahFF(Request $request)
    {
        // print($request);
        // exit();
        // $waktu=date("H:i:s");
        $kk = request()->file('kk');
        $kkname = time().'.'.$kk->getClientOriginalExtension();
        $path = public_path('/images/');
        $kk->move($path, $kkname);
        $nama_kk = ucwords($request->nama_kk);
        $des = ucfirst($request->desa);
        $kec = ucfirst($request->kecamatan);
        $kab = ucfirst($request->kabupaten);
        $kode = $this->kode($kab, $kec, $des);

        $tbl_ff = new Tbl_ff;
        $tbl_ff->nama_kk=$nama_kk;
        $tbl_ff->alamat=$request->alamat;
        $tbl_ff->desa = $des;
        $tbl_ff->kecamatan = $kec;
        $tbl_ff->kabupaten = $kab;
        $tbl_ff->telp=$request->telp;
        $tbl_ff->foto_KK='/images/' . $kkname;
        $char = substr($request->nama_kk, 0, 1);
        $c = strtoupper($char);
        $no = $this->getKK($c, $des,$kec,$kab);
        // printf($no);exit();
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
        
        return redirect ('/datapasienrm');
    }

    public function getKK($char, $desa, $kecamatan, $kabupaten)
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
    public function kode($kabupaten, $kecamatan, $desa)
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

    public function tambahpasien(Request $request)
    {
        date_default_timezone_set('Asia/jakarta');
        $tanggal=date('Y-m-d');
        $waktu=date("h:i:s:");

        $index = $request->index;
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
        $Tbl_datapasien->no_index=$request->index;
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


        // $index = $request->index;
        // $silsilah=$request->silsilah;
        // $Tbl_datapasien = new Tbl_datapasien;
        
        // // echo $request->index;
        // $nama= ucwords($request->nama);
        // $no_rm = $this->getSilsilah($index, $silsilah);
        // $Tbl_datapasien->nama = $nama;
        // $Tbl_datapasien->jenis_kelamin=$request->jenis_kelamin;
        // $Tbl_datapasien->no_index=$request->index;
        // $Tbl_datapasien->nama_kk=$request->nama_kk;
        // $Tbl_datapasien->alamat=$request->alamat;
        // $Tbl_datapasien->pekerjaan=$request->pekerjaan;
        // $Tbl_datapasien->tanggal_lahir=$request->tanggal_lahir;
        // $Tbl_datapasien->umur=$request->umur;
        // $Tbl_datapasien->jenis_asuransi=$request->jenis_asuransi;
        // $Tbl_datapasien->no_asuransi=$request->no_asuransi;
        // $Tbl_datapasien->agama=$request->agama;
        // $Tbl_datapasien->telp=$request->no_hp;
        // $Tbl_datapasien->silsilah=$request->silsilah;
        // $Tbl_datapasien->no_rm = $no_rm;
        // $Tbl_datapasien->save();

        return redirect ('datapasienrm/viewdatapasien/'.$request->index);
    }
    // public function getSilsilah($index, $silsilah)
    // {
    //     if($silsilah=='Kepala Keluarga'){
    //         $no_rm=$index . '.' . '1';
    //         return $no_rm;
    //     }
    //     elseif ($silsilah=='Ibu') {
    //         $no_rm=$index . '.' .  '2';
    //         return $no_rm;
            
    //     }
    //     else{
    //         // $count=DB::select("select count(*) as jumlah from tbl_datapasiens where no_index='".$index."' AND silsilah='Lainnya'")[0]->jumlah;
    //         $count = Tbl_datapasien::where('no_index' , $index)->where('silsilah','Lainnya')->count();
    //         $no=$count+3;
    //         $no_rm=$index . '.'  . $no;
            
    //         return $no_rm;
           
    //     }

    // }

    public function editPasien(Request $request)
    {
        // print_r($request->nama);
        // print_r($request->jenis_kelamin);
        //   print_r($request->jenis_asuransi);
        // print_r($request->index);
        // print_r($request->nama_kk);
        // print_r($request->alamat);
        // print_r($request->pekerjaan);
        // print_r($request->tanggal_lahir);
        // print_r($request->umur);
        // print_r($request->no_hp);
        // print_r($request->silsilah);
        // print_r($request->agama);

        DB::table('tbl_datapasiens')->where('no_rm', $request->no_rm)->update([
            'nama'=>$request->nama,
            'jenis_kelamin'=>$request->jenis_kelamin,
            'no_index'=>$request->index,
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
        
        return redirect ('datapasienrm/viewdatapasien/'.$request->index);
    }
    public function viewaddfamilyrmlaborat()
    {
        $judul = 'Daftar Family Folder';
        $family = DB::select("SELECT * FROM tbl_ffs");
        return view('laboratorium/datapasien/v_family2',['family' => $family, 'judul' => $judul]);
    }

    public function viewdatapasienrmlaborat($id)
    {
        $judul = 'Daftar Pasien';
        $pasien = DB::select("SELECT * FROM tbl_datapasiens where no_index='".$id."'");
        return view('laboratorium/datapasien/v_pasien2', ['pasien' => $pasien, 'judul' => $judul]);
    }

    public function viewdatarmlaborat($id)
    {
         $judul = 'Rekam Medis Pasien';
        $pasien =  DB::select("SELECT * FROM tbl_datapasiens where no_rm='".$id."'");
        $data_lab = DB::select("SELECT a.id_pemeriksaan, b.hasil_pemeriksaan_lab, c.nama_pemeriksaan  FROM tbl_rekam_medis a, tbl_hasil_lab b, tbl_nama_pemeriksaan c where a.no_rm='".$id."' AND a.id_pemeriksaan = b.id_pemeriksaan AND b.id_nama_pemeriksaan = c.id_nama_pemeriksaan ");
        // print_r($data_lab);
        $data_obat = DB::select("SELECT *  FROM tbl_resep_obats a, tbl_resep_obat b, tbl_rekam_medis c where c.no_rm='".$id."' AND b.id_pemeriksaan = c.id_pemeriksaan AND a.id_resep = b.id_resep");
        // print_r($data_obat);
        $data_tindakan = DB::select("SELECT a.id_pemeriksaan, b.tindakan, b.keterangan  FROM tbl_rekam_medis a, tbl_tindakan_rm b where a.no_rm='".$id."' AND a.id_pemeriksaan = b.id_pemeriksaan");
        $datadiagnosa = DB::select("SELECT a.id_pemeriksaan, b.icd_x, b.nama_diagnosa  FROM tbl_rekam_medis a, tbl_diagnosa_rm b where a.no_rm='".$id."' and a.id_pemeriksaan = b.id_pemeriksaan && status !='Hapus'");
        $rekammedis = DB::select("SELECT * FROM tbl_rekam_medis a, tbl_pemeriksaan_rm b, tbl_anamnesa_rm c, tbl_penyuluhan d where a.no_rm='".$id."' AND b.no_rm ='".$id."' And c.no_rm='".$id."' AND d.no_rm='".$id."' and a.id_pemeriksaan = b.id_pemeriksaan And a.id_pemeriksaan = c.id_pemeriksaan and a.id_pemeriksaan = d.id_pemeriksaan");
        // print_r($datadiagnosa);
       
        // return view('perawat/datapasien/v_rm', [ 'judul' => $judul, 'pasien' => $pasien,'diagnosa' => $datadiagnosa , 'rekammedis' => $rekammedis, 'data_lab' => $data_lab, 'data_tindakan' => $data_tindakan, 'data_obat' => $data_obat]);
        return view('laboratorium/datapasien/v_rekammedis', [ 'judul' => $judul, 'pasien' => $pasien,'diagnosa' => $datadiagnosa , 'rekammedis' => $rekammedis, 'data_lab' => $data_lab, 'data_tindakan' => $data_tindakan, 'data_obat' => $data_obat]);
    }

    public function viewaddfamilyrmfarmasi()
    {
        $judul = 'Daftar Family Folder';
        $family = DB::select("SELECT * FROM tbl_ffs");
        return view('farmasi/datapasien/v_family2',['family' => $family, 'judul' => $judul]);
    }

    public function viewdatapasienrmfarmasi($id)
    {
        $judul = 'Daftar Pasien';
        $pasien = DB::select("SELECT * FROM tbl_datapasiens where no_index='".$id."'");
        return view('farmasi/datapasien/v_pasien2', ['pasien' => $pasien, 'judul' => $judul]);
    }

    public function viewdatarmfarmasi($id)
    {

        $judul = 'Rekam Medis Pasien';
        $pasien =  DB::select("SELECT * FROM tbl_datapasiens where no_rm='".$id."'");
        $data_lab = DB::select("SELECT a.id_pemeriksaan, b.hasil_pemeriksaan_lab, c.nama_pemeriksaan  FROM tbl_rekam_medis a, tbl_hasil_lab b, tbl_nama_pemeriksaan c where a.no_rm='".$id."' AND a.id_pemeriksaan = b.id_pemeriksaan AND b.id_nama_pemeriksaan = c.id_nama_pemeriksaan ");
        // print_r($data_lab);
        $data_obat = DB::select("SELECT *  FROM tbl_resep_obats a, tbl_resep_obat b, tbl_rekam_medis c where c.no_rm='".$id."' AND b.id_pemeriksaan = c.id_pemeriksaan AND a.id_resep = b.id_resep");
        // print_r($data_obat);
        $data_tindakan = DB::select("SELECT a.id_pemeriksaan, b.tindakan, b.keterangan  FROM tbl_rekam_medis a, tbl_tindakan_rm b where a.no_rm='".$id."' AND a.id_pemeriksaan = b.id_pemeriksaan");
        $datadiagnosa = DB::select("SELECT a.id_pemeriksaan, b.icd_x, b.nama_diagnosa  FROM tbl_rekam_medis a, tbl_diagnosa_rm b where a.no_rm='".$id."' and a.id_pemeriksaan = b.id_pemeriksaan && status !='Hapus'");
        $rekammedis = DB::select("SELECT * FROM tbl_rekam_medis a, tbl_pemeriksaan_rm b, tbl_anamnesa_rm c, tbl_penyuluhan d where a.no_rm='".$id."' AND b.no_rm ='".$id."' And c.no_rm='".$id."' AND d.no_rm='".$id."' and a.id_pemeriksaan = b.id_pemeriksaan And a.id_pemeriksaan = c.id_pemeriksaan and a.id_pemeriksaan = d.id_pemeriksaan");
        // print_r($datadiagnosa);
       
        // return view('perawat/datapasien/v_rm', [ 'judul' => $judul, 'pasien' => $pasien,'diagnosa' => $datadiagnosa , 'rekammedis' => $rekammedis, 'data_lab' => $data_lab, 'data_tindakan' => $data_tindakan, 'data_obat' => $data_obat]);
        return view('farmasi/datapasien/v_rekammedis', [ 'judul' => $judul, 'pasien' => $pasien,'diagnosa' => $datadiagnosa , 'rekammedis' => $rekammedis, 'data_lab' => $data_lab, 'data_tindakan' => $data_tindakan, 'data_obat' => $data_obat]);
    }

    public function viewaddfamilyrmdokter()
    {
        $judul = 'Daftar Family Folder';
        $family = DB::select("SELECT * FROM tbl_ffs");
        return view('dokter/datapasien/v_family2',['family' => $family, 'judul' => $judul]);
    }

    public function viewdatapasienrmdokter($id)
    {
        $judul = 'Daftar Pasien';
        $pasien = DB::select("SELECT * FROM tbl_datapasiens where no_index='".$id."'");
        return view('dokter/datapasien/v_pasien2', ['pasien' => $pasien, 'judul' => $judul]);
    }

    
    public function viewdatarmdokter($id)
    {
        $judul = 'Rekam Medis Pasien';
        $pasien =  DB::select("SELECT * FROM tbl_datapasiens where no_rm='".$id."'");
        $data_lab = DB::select("SELECT a.id_pemeriksaan, b.hasil_pemeriksaan_lab, c.nama_pemeriksaan  FROM tbl_rekam_medis a, tbl_hasil_lab b, tbl_nama_pemeriksaan c where a.no_rm='".$id."' AND a.id_pemeriksaan = b.id_pemeriksaan AND b.id_nama_pemeriksaan = c.id_nama_pemeriksaan ");
        // print_r($data_lab);
        $data_obat = DB::select("SELECT *  FROM tbl_resep_obats a, tbl_resep_obat b, tbl_rekam_medis c where c.no_rm='".$id."' AND b.id_pemeriksaan = c.id_pemeriksaan AND a.id_resep = b.id_resep");
        // print_r($data_obat);
        $data_tindakan = DB::select("SELECT a.id_pemeriksaan, b.tindakan, b.keterangan  FROM tbl_rekam_medis a, tbl_tindakan_rm b where a.no_rm='".$id."' AND a.id_pemeriksaan = b.id_pemeriksaan");
        $datadiagnosa = DB::select("SELECT a.id_pemeriksaan, b.icd_x, b.nama_diagnosa  FROM tbl_rekam_medis a, tbl_diagnosa_rm b where a.no_rm='".$id."' and a.id_pemeriksaan = b.id_pemeriksaan && status !='Hapus'");
        $rekammedis = DB::select("SELECT * FROM tbl_rekam_medis a, tbl_pemeriksaan_rm b, tbl_anamnesa_rm c, tbl_penyuluhan d where a.no_rm='".$id."' AND b.no_rm ='".$id."' And c.no_rm='".$id."' AND d.no_rm='".$id."' and a.id_pemeriksaan = b.id_pemeriksaan And a.id_pemeriksaan = c.id_pemeriksaan and a.id_pemeriksaan = d.id_pemeriksaan");
        // print_r($datadiagnosa);
       
        // return view('perawat/datapasien/v_rm', [ 'judul' => $judul, 'pasien' => $pasien,'diagnosa' => $datadiagnosa , 'rekammedis' => $rekammedis, 'data_lab' => $data_lab, 'data_tindakan' => $data_tindakan, 'data_obat' => $data_obat]);
        return view('dokter/datapasien/v_rekammedis', [ 'judul' => $judul, 'pasien' => $pasien,'diagnosa' => $datadiagnosa , 'rekammedis' => $rekammedis, 'data_lab' => $data_lab, 'data_tindakan' => $data_tindakan, 'data_obat' => $data_obat]);
    }

    public function viewaddfamilyrmadmin()
    {
        $judul = 'Daftar Family Folder';
        $family = DB::select("SELECT * FROM tbl_ffs");
        return view('admin/datapasien/v_family2',['family' => $family, 'judul' => $judul]);
    }

    public function viewdatapasienrmadmin($id)
    {
        $judul = 'Daftar Pasien';
        $pasien = DB::select("SELECT * FROM tbl_datapasiens where no_index='".$id."'");
        return view('admin/datapasien/v_pasien2', ['pasien' => $pasien, 'judul' => $judul]);
    }

    public function viewdatarmadmin($id)
    {
        $judul = 'Rekam Medis Pasien';
        $pasien =  DB::select("SELECT * FROM tbl_datapasiens where no_rm='".$id."'");
        $data_lab = DB::select("SELECT a.id_pemeriksaan, b.hasil_pemeriksaan_lab, c.nama_pemeriksaan  FROM tbl_rekam_medis a, tbl_hasil_lab b, tbl_nama_pemeriksaan c where a.no_rm='".$id."' AND a.id_pemeriksaan = b.id_pemeriksaan AND b.id_nama_pemeriksaan = c.id_nama_pemeriksaan ");
        // print_r($data_lab);
        $data_obat = DB::select("SELECT *  FROM tbl_resep_obats a, tbl_resep_obat b, tbl_rekam_medis c where c.no_rm='".$id."' AND b.id_pemeriksaan = c.id_pemeriksaan AND a.id_resep = b.id_resep");
        // print_r($data_obat);
        $data_tindakan = DB::select("SELECT a.id_pemeriksaan, b.tindakan, b.keterangan  FROM tbl_rekam_medis a, tbl_tindakan_rm b where a.no_rm='".$id."' AND a.id_pemeriksaan = b.id_pemeriksaan");
        $datadiagnosa = DB::select("SELECT a.id_pemeriksaan, b.icd_x, b.nama_diagnosa  FROM tbl_rekam_medis a, tbl_diagnosa_rm b where a.no_rm='".$id."' and a.id_pemeriksaan = b.id_pemeriksaan && status !='Hapus'");
        $rekammedis = DB::select("SELECT * FROM tbl_rekam_medis a, tbl_pemeriksaan_rm b, tbl_anamnesa_rm c, tbl_penyuluhan d where a.no_rm='".$id."' AND b.no_rm ='".$id."' And c.no_rm='".$id."' AND d.no_rm='".$id."' and a.id_pemeriksaan = b.id_pemeriksaan And a.id_pemeriksaan = c.id_pemeriksaan and a.id_pemeriksaan = d.id_pemeriksaan");
        // print_r($datadiagnosa);
       
        // return view('perawat/datapasien/v_rm', [ 'judul' => $judul, 'pasien' => $pasien,'diagnosa' => $datadiagnosa , 'rekammedis' => $rekammedis, 'data_lab' => $data_lab, 'data_tindakan' => $data_tindakan, 'data_obat' => $data_obat]);
        return view('admin/datapasien/v_rekammedis', [ 'judul' => $judul, 'pasien' => $pasien,'diagnosa' => $datadiagnosa , 'rekammedis' => $rekammedis, 'data_lab' => $data_lab, 'data_tindakan' => $data_tindakan, 'data_obat' => $data_obat]);
    }


    public function viewaddfamilyrmperawat()
    {
        $judul = 'Daftar Family Folder';
        $family = DB::select("SELECT * FROM tbl_ffs");
        return view('perawat/datapasien/v_family2',['family' => $family, 'judul' => $judul]);
    }

    public function viewdatapasienrmperawat($id)
    {
        $judul = 'Daftar Pasien';
        $pasien = DB::select("SELECT * FROM tbl_datapasiens where no_index='".$id."'");
        return view('perawat/datapasien/v_pasien2', ['pasien' => $pasien, 'judul' => $judul]);
    }

    public function viewaskepperawat($id)
    {
        $judul = 'Asuhan Keperawatan Pasien';
        $pasien =  DB::select("SELECT * FROM tbl_datapasiens where no_rm='".$id."'");
        $data_askep = DB::select("SELECT * FROM tbl_asuhan_keperawatan where no_rm='".$id."'");
        // $data_lab = DB::select("SELECT a.id_pemeriksaan, b.hasil_pemeriksaan_lab, c.nama_pemeriksaan  FROM tbl_rekam_medis a, tbl_hasil_lab b, tbl_nama_pemeriksaan c where a.no_rm='".$id."' AND a.id_pemeriksaan = b.id_pemeriksaan AND b.id_nama_pemeriksaan = c.id_nama_pemeriksaan ");
        // print_r($data_askep);
        // $data_obat = DB::select("SELECT *  FROM tbl_resep_obats a, tbl_resep_obat b, tbl_rekam_medis c where c.no_rm='".$id."' AND b.id_pemeriksaan = c.id_pemeriksaan AND a.id_resep = b.id_resep");
        // // print_r($data_obat);
        // $rekammedis = DB::select("SELECT * FROM tbl_rekam_medis a, tbl_pemeriksaan_rm b, tbl_anamnesa_rm c, tbl_diagnosa_rm d, tbl_tindakan_rm e, tbl_penyuluhan f where a.no_rm='".$id."' AND b.no_rm ='".$id."' And c.no_rm='".$id."' AND d.no_rm='".$id."' AND e.no_rm ='".$id."' AND f.no_rm='".$id."'");
        // // print_r($rekammedis);
        return view('perawat/datapasien/v_askep',  [ 'judul' => $judul, 'pasien' => $pasien, 'askep' => $data_askep]);
    }

    public function viewrmperawat($id)
    {
        $judul = 'Rekam Medis Pasien';
        $pasien =  DB::select("SELECT * FROM tbl_datapasiens where no_rm='".$id."'");
        $data_lab = DB::select("SELECT a.id_pemeriksaan, b.hasil_pemeriksaan_lab, c.nama_pemeriksaan  FROM tbl_rekam_medis a, tbl_hasil_lab b, tbl_nama_pemeriksaan c where a.no_rm='".$id."' AND a.id_pemeriksaan = b.id_pemeriksaan AND b.id_nama_pemeriksaan = c.id_nama_pemeriksaan ");
        // print_r($data_lab);
        $data_obat = DB::select("SELECT *  FROM tbl_resep_obats a, tbl_resep_obat b, tbl_rekam_medis c where c.no_rm='".$id."' AND b.id_pemeriksaan = c.id_pemeriksaan AND a.id_resep = b.id_resep");
        // print_r($data_obat);
        $data_tindakan = DB::select("SELECT a.id_pemeriksaan, b.tindakan, b.keterangan  FROM tbl_rekam_medis a, tbl_tindakan_rm b where a.no_rm='".$id."' AND a.id_pemeriksaan = b.id_pemeriksaan");
        $datadiagnosa = DB::select("SELECT a.id_pemeriksaan, b.icd_x, b.nama_diagnosa  FROM tbl_rekam_medis a, tbl_diagnosa_rm b where a.no_rm='".$id."' and a.id_pemeriksaan = b.id_pemeriksaan && status !='Hapus'");
        $rekammedis = DB::select("SELECT * FROM tbl_rekam_medis a, tbl_pemeriksaan_rm b, tbl_anamnesa_rm c, tbl_penyuluhan d where a.no_rm='".$id."' AND b.no_rm ='".$id."' And c.no_rm='".$id."' AND d.no_rm='".$id."' and a.id_pemeriksaan = b.id_pemeriksaan And a.id_pemeriksaan = c.id_pemeriksaan and a.id_pemeriksaan = d.id_pemeriksaan");
        // print_r($datadiagnosa);
       
        return view('perawat/datapasien/v_rm', [ 'judul' => $judul, 'pasien' => $pasien,'diagnosa' => $datadiagnosa , 'rekammedis' => $rekammedis, 'data_lab' => $data_lab, 'data_tindakan' => $data_tindakan, 'data_obat' => $data_obat]);
    }

}
