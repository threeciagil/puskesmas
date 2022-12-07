@include('dokter.templatedokter.v_header')
@include('dokter.templatedokter.v_sidebar')
<div class="row page-titles mx-0">
    <div class="col p-md-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Pelayanan Dokter</a></li>
        </ol>
    </div>
</div>

<!-- row -->
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-4 col-xl-3">
            <div class="card">
                <div class="card-body">
                   
                        <div class="row mb-5">
                            <div>
                                <h4 class="text-muted mb-4">Data Pasien</h4>
                            </div>
                            <ul class="card-profile__info">
                            @foreach($pasien as $pasiens)
                                <li class="mb-1"><strong class="text-dark mr-4">No. Pendaftaran</strong> <span class="float-right">{{$pasiens->no_index}}</span></li>
                                <li class="mb-1"><strong class="text-dark mr-4">Tanggal</strong> <span class="float-right">{{$pasiens->tanggal}}</span></li>
                                <li class="mb-1"><strong class="text-dark mr-4">No. Rekam Medis</strong> <span class="float-right">{{$pasiens->no_rm}}</span></li>
                                <li class="mb-1"><strong class="text-dark mr-4">Nama Lengkap</strong> <span class="float-right">{{$pasiens->nama}}</span></li>
                                <li class="mb-1"><strong class="text-dark mr-4">Tanggal Lahir</strong> <span class="float-right"> {{$pasiens->tanggal_lahir}}</span></li>
                                <li class="mb-1"><strong class="text-dark mr-4">Umur</strong> <span class="float-right">{{$pasiens->umur}}</span></li>
                                <li class="mb-1"><strong class="text-dark mr-4">Jenis Asuransi</strong> <span class="float-right">{{$pasiens->jenis_asuransi}}</span></li>
                                <li class="mb-1"><strong class="text-dark mr-4">Nama KK</strong> <span class="float-right">{{$pasiens->nama_kk}}</span></li>
                                <li class="mb-1"><strong class="text-dark mr-4">Pekerjaan</strong> <span class="float-right">{{$pasiens->pekerjaan}}</span></li>
                                <li class="mb-1"><strong class="text-dark mr-4">Poli Asal</strong> <span class="float-right">{{$pasiens->poli_asal}} </span></li>
                            @endforeach
                            </ul>

                        </div>
                </div>
            </div>
            <div class="card">

                <div class="card-body">
                    <div class="row mb-5">
                        <div>
                            <h4 class="text-muted mb-4">Data Pelayanan</h4>
                        </div>
                        <div class="col-12 text-center">
                            <div class="btn-group-vertical">
                                <button class="btn btn-secondary mb-2 px-4" data-toggle="modal" data-target="#modalRM">Riwayat Rekam Medis</button>
                                <!-- <button class="btn btn-secondary mb-2 px-4" data-toggle="modal" data-target="#modalPemeriksaan">Riwayat Pemeriksaan</button> -->
                                <button class="btn btn-secondary mb-2 px-4" data-toggle="modal" data-target="#modalHasilLab">Hasil Pemeriksaan Lab</button>
                                <button class="btn btn-secondary mb-2 px-4" data-toggle="modal" data-target="#modalAskep">Asuhan Keperawatan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="row mb-5">
                        <div>
                            <h4 class="text-muted mb-4">Data Permintaan</h4>
                        </div>
                        <div class="col-12 text-center">
                            <div class="btn-group-vertical">
                                <button class="btn btn-secondary mb-2 px-5" data-toggle="modal" data-target="#basicModal2">Permintaan Lab</button>
                                <!-- <button class="btn btn-secondary mb-2 px-5">Resep Obat</button> -->
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
        <div class="col-lg-12 col-xl-9">
        
            <div class="card">
                <!-- <section> -->
                <div class="card-body">
                    <div>
                        <h4 class="text-muted mb-4">Anamnesa</h4>
                    </div>
                  
                        <form action="/saveanamnesa" method="post">
                        @csrf  
                        @foreach($data as $datas)
                        <input type="hidden" value="{{$datas->id_pemeriksaan}}" name="id_pemeriksaan" class="form-control">
                        <input type="hidden" value="{{$datas->no_rm}}" name="no_rm" class="form-control">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>RPK</label>
                                        <input type="text" value="{{$datas->rpk}}" name="rpk" class="form-control" placeholder="Riwayat Penyakit Keluarga" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>RPD</label>
                                        <input type="text" name="rpd" value="{{$datas->rpd}}" class="form-control" placeholder="Riwayat Penyakit Dulu" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>RPS</label>
                                        <input type="text" name="rps" value="{{$datas->rps}}" class="form-control" placeholder="Riwayat Penyakit Sekarang" required>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mt-5">Simpan</button>
                            @endforeach
                        </form>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                   
                        <div>
                            <h4 class="text-muted mb-4">Pemeriksaan Fisik</h4>
                        </div>
                        <form action="/savepemeriksaan" method="post">
                        @csrf  
                        @foreach($pemeriksaan as $periksa)
                        <input type="hidden" value="{{$periksa->no_rm}}" name="no_rm" class="form-control">
                        <input type="hidden" value="{{$periksa->id_pemeriksaan}}" name="id_pemeriksaan" class="form-control">
                            <div class="row">
                                <div class="col-lg-6">
                                    <label>TB</label>
                                     <?php 
                                        if(isset($periksa->tb)){
                                     ?>
                                     <div class="input-group">
                                        <input type="text" id="tb" name="tb" value="{{$periksa->tb}}" class="form-control" placeholder="Tinggi Badan" required><span class="input-group-append"><span class="input-group-text">
                                                <a class="text-muted">m</a>
                                            </span></span>
                                    </div>
                                     <?php
                                        }else{
                                     ?>
                                     <div class="input-group">
                                        <input t ype="text" id="tb" name="tb" value="{{$periksa->tinggi_badan}}" class="form-control" placeholder="Tinggi Badan" required><span class="input-group-append"><span class="input-group-text">
                                                <a class="text-muted">m</a>
                                            </span></span>
                                    </div>
                                     <?php
                                        } 
                                     ?>           
                                </div>
                                <div class="col-lg-6">
                                    <label>Sistol</label>

                                    <div class="input-group">
                                        <input type="text" name="sistol" value="{{$periksa->sistol}}" class="form-control" placeholder="Sistol" required><span class="input-group-append"><span class="input-group-text">
                                                <a class="text-muted">mmHg</a>
                                            </span></span>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <label>BB</label>
                                    <?php if(isset($periksa->bb))
                                        {
                                    ?>
                                    <div class="input-group">
                                        <input type="text" id="bb" name="bb" value="{{$periksa->bb}}" class="form-control" placeholder="Berat Badan" onkeyup="cariimt();" required><span class="input-group-append"><span class="input-group-text">
                                                <a class="text-muted">Kg</a>
                                            </span></span>
                                    </div>
                                    <?php
                                        }else{
                                    ?>
                                    <div class="input-group">
                                        <input type="text" id="bb" name="bb" value="{{$periksa->berat_badan}}" class="form-control" placeholder="Berat Badan" onkeyup="cariimt();" required><span class="input-group-append"><span class="input-group-text">
                                                <a class="text-muted">Kg</a>
                                            </span></span>
                                    </div>
                                    <?php
                                        }
                                    ?>
                                    
                                </div>

                                <div class="col-lg-6">
                                    <label>Diastol</label>
                                    <div class="input-group">
                                        <input type="text" name="diastol" value="{{$periksa->diastol}}" class="form-control" placeholder="Diastol" required><span class="input-group-append"><span class="input-group-text">
                                                <a class="text-muted">mmHg</a>
                                            </span></span>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <label>IMT</label>
                                    <div class="input-group">
                                        <input type="text" id="imt" name="imt" value="{{$periksa->imt}}" class="form-control" placeholder="Index Massa" required ><span class="input-group-append"><span class="input-group-text" >
                                                <a class="text-muted">Kg/m2</a>
                                            </span></span>
                                    </div>
                                </div>
                                
                                <div class="col-lg-6">
                                    <label>Suhu</label>
                                    <div class="input-group">
                                        <input type="text" name="suhu" value="{{$periksa->suhu}}" class="form-control" placeholder="Suhu" required><span class="input-group-append"><span class="input-group-text">
                                                <a class="text-muted">'C</a>
                                            </span></span>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Ket</label>
                                            <input type="text" id="ket" name="ket" class="form-control" readonly="true">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <label>RR</label>
                                    <div class="input-group">
                                        <input type="text" name="nafas" value="{{$periksa->rr}}" class="form-control" placeholder="Jumlah Nafas" required><span class="input-group-append"><span class="input-group-text">
                                                <a class="text-muted">/menit</a>
                                            </span></span>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mt-5">Simpan</button>
                        @endforeach
                        </form>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div>
                        <h4 class="text-muted mb-4">Diagnosa</h4>
                    </div>
                    <div class="table-responsive">
                    

                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>ICD-X</th>
                                            <th>Diagnosa</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        $no=1;
                                        @endphp
                                    @foreach($diagnosa as $diagnosas)
                                        <tr>
                                            <td class=" text-center">{{$no}}</td>
                                            <!-- <td class=" text-center"> </td> -->
                                            <td> {{$diagnosas->icd_x}} </td>
                                            <td> {{$diagnosas->nama_diagnosa}} </td>
                                            <td><span>
                                                <button type="button" class="btn btn-danger" onclick="location.href='/pelayanandokter/hapus/{{$diagnosas->no_rm}}/{{$data[0]->id_pemeriksaan}}/{{$diagnosas->id_diagnosa}}'" data-toggle="tooltip" data-placement="top" title="Hapus">
                                                            Hapus
                                                </button>
                                            </td>
                                        </tr>
                                        @php $no++; @endphp
                                    @endforeach

                                    </tbody>                         
                                </table>
                                <button type="button" class="btn btn-primary " data-toggle="modal" data-target="#tambah1"> Tambah
                                </button>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div>
                        <h4 class="text-muted mb-4">Tindakan</h4>
                    </div>
                    <div class="table-responsive">
                      
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Tindakan</th>
                                            <th>Perawat</th>
                                            <th>Keterangan</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($tindakan_rm as $tindakans_rm)
                                        <?php $no = 1;?>
                                        <tr>
                                            <td>{{$no}}</td>
                                            <td>{{$tindakans_rm->tindakan}}</td>
                                            <td>{{$tindakans_rm->perawat}}</td>
                                            <td>{{$tindakans_rm->keterangan}}</td>
                                            <td>
                                                <button type="button" class="btn btn-danger" onclick="location.href='/pelayanandokter/hapustindakan/{{$tindakans_rm->no_rm}}/{{$data[0]->id_pemeriksaan}}/{{$tindakans_rm->id_tindakan}}'" data-toggle="tooltip" data-placement="top" title="Hapus">
                                                            Hapus
                                                </button>
                                            </td>
                                        </tr>
                                        <?php $no++;?>
                                        @endforeach
                                    </tbody>
                                </table>
                                <button type="button" class="btn btn-primary " data-toggle="modal" data-target="#basicModal1"> Tambah
                                </button>
                    </div>
                </div>
            </div>

            

            <div class="card">
                <div class="card-body">
                    <div>
                        <h4 class="text-muted mb-4">Resep Obat</h4>
                    </div>
                       <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Jenis</th>
                                    <th>Nama Obat</th>
                                    <th>Jumlah</th>
                                    <th>Signa</th>
                                    <th>Aturan Pakai</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                           
                            <tbody>
                            <?php $no=1;?>
                                @foreach($dataobatpasien as $dataobatpasiens)
                                <tr>
                                    <td>{{$no}}</td>
                                    <td>{{$dataobatpasiens->jenis_resep}}</td>   
                                    <td>{{$dataobatpasiens->nama_obat}}</td>
                                    <td>{{$dataobatpasiens->jumlah}}</td>
                                    <td>{{$dataobatpasiens->signa}}</td>
                                    <td>{{$dataobatpasiens->aturan_pakai}}</td>
                                    <td>                          
                                        <button type="button" class="btn btn-danger" onclick="location.href='/pelayanandokter/hapusresep/{{$data[0]->no_rm}}/{{$data[0]->id_pemeriksaan}}/{{$dataobatpasiens->id}}'" data-toggle="tooltip" data-placement="top" title="Hapus">
                                        Hapus
                                        </button>
                                    </td>
                                </tr>
                                <?php $no++;?>
                                @endforeach
                            </table>
                        <button type="button"  class="btn btn-primary " id="modal3" data-toggle="modal" data-target="#basicModal3"> Tambah
                    </button>
                    </div>
                </div>
                 <div class="card">
                <div class="card-body">
                    <!-- <div>
                        <h4 class="text-muted mb-4">Anamnesa</h4>
                    </div> -->

                    <h4 class="card-title">Lainnya</h4>
                    <div class="basic-form">
                        <form method="post" action="/savepenyuluhan">
                        @csrf
                            <input type="hidden" value="{{$data[0]->id_pemeriksaan}}" name="id_pemeriksaan" class="form-control">
                            <input type="hidden" value="{{$data[0]->no_rm}}" name="no_rm" class="form-control">
                            <div class="form-group">
                                <label>Penyuluhan/Edukasi</label>
                                <textarea class="form-control h-150px" name="lainnya" rows="6" id="comment"></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary ">Selesai</button>
                        </form>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>
<!-- #/ container -->
</div>
<!--**********************************
            Content body end
        ***********************************-->
<div class="modal" id="tambah1" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <h5 class="modal-title">Tambah Diagnosa</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <form class="form-horizontal" method="post" action="/savediagnosa">
                @csrf
                <input type="hidden" value="{{$data[0]->id_pemeriksaan}}" name="id_pemeriksaan" class="form-control">
                <input type="hidden" value="{{$data[0]->no_rm}}" name="no_rm" class="form-control">
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-lg-4 col-form-label" for="icdx">ICD-X </label>
                        <div class="col-lg-6">
                            <select class="form-control" id="icdx" name="icdx">
                                <option readonly>Please select</option>
                                @foreach($pilihandiagnosa as $diagnosas)
                                    <option value="{{$diagnosas->icd_x}}">{{$diagnosas->nama_diagnosa}}</option>
                                @endforeach
                            </select>   
                        </div>
                    </div>
                    <!-- <div class="form-group row">
                        <label class="col-lg-4 col-form-label" for="jenis">Jenis</label>
                        <div class="col-lg-6">
                            <select class="form-control" id="jenis" name="jenis">
                                <option value="">Please select</option>
                                <option value="Primer">Primer</option>
                                <option value="Sekunder">Sekunder</option>
                                <option value="Komplikasi">Komplikasi</option>
                            </select>
                        </div>
                    </div> -->

                    <!-- <div class="form-group row">
                        <label class="col-lg-4 col-form-label" for="kasus">Kasus</label>
                        <div class="col-lg-6">
                            <select class="form-control" id="kasus" name="kasus">
                                <option value="">Please select</option>
                                <option value="Baru">Baru</option>
                                <option value="Lama">Lama</option>
                            </select>
                        </div>
                    </div> -->
                </div>
                <div class="modal-footer">
                    </br>
                    <input type="hidden" name="id_pesan">
                    <button class="btn btn-default btn-sm" data-dismiss="modal" aria-hidden="true">Batal</button>
                    <button class="btn btn-primary btn-sm">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
 
<div class="modal" id="basicModal1" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Tindakan</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <form class="form-horizontal" method="post" action="/savetindakan">
                @csrf
                <input type="hidden" value="{{$data[0]->id_pemeriksaan}}" name="id_pemeriksaan" class="form-control">
                <input type="hidden" value="{{$data[0]->no_rm}}" name="no_rm" class="form-control">
                <div class="modal-body">
                    <!-- Modal body text goes here. -->
                    <div class="form-group row">
                        <label class="col-lg-4 col-form-label" for="tindakan">Tindakan </label>
                        <div class="col-lg-6">
                            <select class="form-control" id="tindakan" name="tindakan">
                                <option readonly>Please select</option>
                                @foreach($tindakan as $tindakans)
                                <option value="{{$tindakans->nama_tindakan}}">{{$tindakans->nama_tindakan}}</option>
                                @endforeach
                            </select>
                            <!-- <input type="text" class="form-control" id="tindakan" name="tindakan" placeholder="Masukkan tindakan"> -->
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-4 col-form-label" for="keterangan">Keterangan </label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" id="keterangan" name="keterangan" placeholder="Masukkan keterangan">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-4 col-form-label" for="perawat">Panggil Perawat </label>
                        <div class="col-lg-6">
                            <select class="form-control" id="perawat" name="perawat">
                                <option readonly>Please select</option>
                                @foreach($perawat as $perawats)
                                <option value="{{$perawats->full_name}}">{{$perawats->full_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                
                <div class="modal-footer">
                    </br>
                    <input type="hidden" name="id_pesan">
                    <button class="btn btn-default btn-sm" data-dismiss="modal" aria-hidden="true">Batal</button>
                    <button class="btn btn-primary btn-sm">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

 

<div class="modal" id="basicModal2" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <h5 class="modal-title">Tambah Permintaan Laboratoriun</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <form class="form-horizontal" method="post" action="/savepermintaanlab">
            @csrf
            <input type="hidden" value="{{$data[0]->id_pemeriksaan}}" name="id_pemeriksaan" class="form-control">
            <input type="hidden" value="{{$data[0]->no_rm}}" name="no_rm" class="form-control">
                <div class="modal-body">
                    <!-- Modal body text goes here. -->
                    <div class="form-group row">
                
                        <div class="col-lg-12">
                            <h4></h4>
                            <div class="col-lg-6">
                             <!-- <label class="form-check-label"> -->
                           
                            @foreach($jenislab as $lab)
                                <!-- @foreach($laborat as $datalaborats) -->
                                    <!-- @if($lab->id_jenis_dokter==$datalaborats->id_jenis) -->
                                        <!-- <label>{{$lab->jenis_dokter}}</label> -->
                                        <div> <input type="checkbox" class="form-check-input" name="id_laborat[]" value="{{$datalaborats->id_data_laborat_dokter }}" ><label for="id_pemeriksaan[]">{{$datalaborats->nama }}</label><br>
                                            </div>
                                        <!-- </label> -->
                                    <!-- @endif -->
                                <!-- @endforeach -->
                            @endforeach
                          
                        </div>
                    </div>
                    </div>
                </div>
                  

               <div class="modal-footer">
                    </br>
                    <input type="hidden" name="id_pesan">
                    <button class="btn btn-default btn-md" data-dismiss="modal" aria-hidden="true">Batal</button>
                    <button class="btn btn-primary btn-md">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal" id="modalRM" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Data Rekam Medis</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div>
                <div class="table-responsive">
                        <table class="table table-striped table-bordered zero-configuration">
                            <thead>
                                <tr>
                                    <th class="text-center">No.</th>
                                    <th>Tanggal</th>
                                    <th>Waktu Pelayanan</th>
                                    <th>Anamnesa</th>
                                    <th>Pemeriksaan</th>
                                    <th>Diagnosa</th>
                                    <th>Pengobatan/Penyuluhan</th>
                                    <th>Penanggung Jawab</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                ?>
                                @foreach($rekammedis as $rm)
                                <?php 
                                      $time= strtotime($rm->waktu_selesai);
                                      $jam=date("H:i:s", $time); 
                                      $time2= strtotime($rm->waktu_mulai);
                                      $jammulai=date("H:i:s", $time2); 
                                      ?>
                                <tr>
                                    <td class=" text-center">{{$no}}</td>
                                    <td>{{$rm->tanggal_kunjungan}}</td>
                                    <td>{{$jammulai}} - {{$jam}}</td>
                                    <td><b>RPD :</b> {{$rm->rpd}} || <b>RPK :</b> {{$rm->rpk}} || <b>RPS :</b> {{$rm->rps}}</td>
                                    <td><b>TB :</b> {{$rm->tinggi_badan}} || <b>BB :</b> {{$rm->berat_badan}} || <b>IMT :</b> {{$rm->imt}} || <br><b>Suhu :</b> {{$rm->rpd}} || <b>RR :</b> {{$rm->rr}} || <b>Sistol :</b> {{$rm->sistol }} || <br><b>Diastol :</b> {{$rm->diastol}} </td>
                                    <td>{{$rm->nama_diagnosa}}</td>
                                    <td><b>Laboratorium : </b>
                                        @foreach($data_lab as $dl)
                                            @if($dl->id_pemeriksaan == $rm->id_pemeriksaan)
                                            <b> {{$dl->nama_pemeriksaan}} :</b> {{$dl->hasil_pemeriksaan_lab}} || 
                                            @endif
                                        @endforeach ||
                                        <b>Tindakan : </b> 
                                        @foreach($data_tindakan as $dt)
                                            @if($dt->id_pemeriksaan == $rm->id_pemeriksaan)
                                            <b> {{$dt->tindakan}} :</b> {{$dt->keterangan}} ||
                                            @endif
                                        @endforeach

                                        <b>Obat : </b>
                                    @foreach($data_obat as $do)
                                            @if($do->id_pemeriksaan == $rm->id_pemeriksaan)
                                               <b>{{$do->nama_obat}} :</b> <br>aturan : {{$do->aturan_pakai}} || jumlah : {{$do->jumlah}}  <br>
                                            @endif
                                        @endforeach ||
                                        <b>Penyuluhan : </b>
                                    {{$rm->isi_penyuluhan}}</td>
                                    <td><b>Dokter : </b> {{$rm->dokter_penanggung_jawab}} || <b>Perawat : </b> {{$rm->perawat_penanggung_jawab}}</td>
                                </tr>
                                <?php $no++; ?>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
            </div>
        </div>
    </div>
</div>
<div class="modal" id="modalHasilLab" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Data Pemeriksaan Lab</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered ">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Jenis Pelayanan Lab</th>
                            <th>Jenis Permintaan Dokter</th>
                            <th>Jenis Uji Lab</th>
                            <th>Hasil Lab</th>
                            <th>Nilai Normal</th>
                            <th>Satuan</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $no=1;?>
                        @foreach($hasillab as $hasillabs)
                        <tr>
                            <td>{{$no}}</td>
                            <td>{{$hasillabs->jenis_dokter}}</td>   
                            <td>{{$hasillabs->jenis_dokter}}</td>
                            <td>{{$hasillabs->nama_pemeriksaan}}</td>
                            <td>{{$hasillabs->hasil_pemeriksaan_lab}}</td>
                            <td>{{$hasillabs->nilai_normal}}</td>
                            <td>{{$hasillabs->satuan}}</td>
                        </tr>
                        <?php $no++;?>
                        @endforeach
                    </table>
            </div>
        </div>
    </div>
</div>
<div class="modal modal-xl" id="modalAskep" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Data Asuhan Keperawatan</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="table-responsive">
                        <table class="table table-striped table-bordered zero-configuration">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width: 1px">No.</th>
                                    <th class="text-center" style="width: 25px">Tanggal</th>
                                    <th class="text-center" style="width: 25px">Waktu Pelayanan</th>
                                    <th class="text-center" style="width: 25px">Subjective</th>
                                    <th class="text-center" style="width: 25px">Objective</th>
                                    <th class="text-center" style="width: 25px">Assessment</th>
                                    <th class="text-center" style="width: 25px">Plan</th>
                                    <th class="text-center" style="width: 25px">Penanggung Jawab</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;?>
                                @foreach($askep as $a)
                                <tr>
                                    <td class=" text-center" style="width: 1px">{{$no}}</td>
                                      <?php 
                                      $time= strtotime($a->jam_selesai);
                                      $jam=date("H:i:s", $time); 
                                      $time2= strtotime($a->jam_mulai);
                                      $jammulai=date("H:i:s", $time2); 
                                      ?>

                                    <td class="text-center" style="width: 25px">{{$a->tanggal}}</td>
                                    <td style="width: 25px">{{$jammulai}}- {{$jam}} </td>
                                    <td style="width: 25px"><p><b>rpd :</b> {{$a->rpd}} <p> </p> <b>rpk :</b> {{$a->rpk}} </p> <p> <b>rps :</b> {{$a->rps}} </p> <p> <b>nb_subjective :</b> {{$a->nb_subjective}} </p></td>
                                    <td style="width: 25px"><p><b>tb :</b> {{$a->tb}} </p><p> <b>bb :</b> {{$a->bb}} </p> <p> <b>imt :</b> {{$a->imt}} </p> <p> <b>suhu :</b> {{$a->rpd}} </p> <p> <b>rr :</b> {{$a->rr}} </p> <p> <b>sistol :</b> {{$a->sistol }} </p> <p> <b>diastol :</b> {{$a->diastol}} </p> <p> <b>nb_objective :</b> {{$a->nb_object}} </p></td>
                                    <td style="width: 25px"> {{$a->nb_assessment}}</td>
                                    <td style="width: 25px"> {{$a->nb_plan}}</td>
                                    <td style="width: 25px"> {{$a->penanggungjawab}}</td>
                                </tr>
                                <?php $no++; ?>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
        </div>
    </div>
</div>

<div class="modal" id="basicModalRujukan" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <h5 class="modal-title">Tambah Permintaan Rujukan</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <form class="form-horizontal" method="post" action="">
                 
                <div class="modal-body">
                    <!-- Modal body text goes here. -->
                    <div class="form-group row">
                        <label class="col-lg-9 col-form-label" for="nama_obat">Isi Rujukan </label>
                        <div class="col-lg-12">
                            <textarea class="form-control" id="isi_rujukan" name="isi_rujukan" placeholder="Rujukan..." required autofocuse></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    </br>
                    <input type="hidden" name="id_pesan">
                    <button class="btn btn-default btn-md" data-dismiss="modal" aria-hidden="true">Batal</button>
                    <button class="btn btn-primary btn-md">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal" id="basicModal3" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <h5 class="modal-title">Tambah Obat</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <form class="form-horizontal" method="post" action="/dokteraddobat">
                @csrf
                <input type="hidden" value="{{$data[0]->id_pemeriksaan}}" name="id_pemeriksaan" class="form-control">
                <input type="hidden" value="{{$data[0]->no_rm}}" name="no_rm" class="form-control">
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-lg-4 col-form-label" for="jenis">Jenis
                                        <!-- <span class="text-danger">*</span> -->
                        </label>
                        <div class="col-lg-6">
                            <select class="form-control" id="jenisresep" onchange="jadi();" name="jenis">
                                <option value="Racikan">Racikan</option>
                                <option value="Jadi">Jadi</option>
                            </select>
                        </div>
                    </div>
                    <div class="control-group after-add-more">
                        <label>Nama Obat</label>
                            <select class="form-control" id="nama_obat" name="nama_obat[]">
                                @foreach($dataobat as $dataobats)
                                <option value="{{$dataobats->nama_obat}}">{{$dataobats->nama_obat}}</option>
                                <!-- <input type="hidden" value="{{$dataobats->id_obat}}" name="id_obat[]" class="form-control"> -->
                                 @endforeach
                            </select>
                        <label>Jumlah</label>
                            <input type="text" name="jk[]" class="form-control" required autofocuse>
                    </div>
                    <button class="btn btn-success add-more" id="add" type="button">
                        <i class="glyphicon glyphicon-plus"></i> Add
                    </button>
                    <div class="form-group row">
                        <label class="col-lg-4 col-form-label" for="signa">Signa </label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" id="signa" name="signa" placeholder="Signa Obat" required autofocuse>
                        </div>
                    </div>
                    <!-- data add -->
                     <div class="col-lg-6">
                            <input type="hidden" class="form-control" id="coret" name="coret" required autofocuse>
                        </div>
                        <!--  -->
                    <div class="form-group row">
                        <label class="col-lg-4 col-form-label" for="aturan_pakai">Aturan Pakai </label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" id="aturan_pakai" name="aturan_pakai" placeholder="Aturan Pakai" required autofocuse>
                        </div>
                    </div>
                     <div class="modal-footer">
                    </br>
                    <input type="hidden" name="id_pesan">
                    <button class="btn btn-default btn-sm" data-dismiss="modal" aria-hidden="true">Batal</button>
                    <button class="btn btn-primary btn-sm">Simpan</button>
                </div>
         <!--  <button class="btn btn-success" type="submit">Submit</button> -->
        </form>

        <!-- class hide membuat form disembunyikan  -->
        <!-- hide adalah fungsi bootstrap 3, klo bootstrap 4 pake invisible  -->
       <div class="copy hide">
            <div class="control-group">
                <br>
                <button class="btn btn-danger remove" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button> 
                <br>
                <label>Nama Obat</label>
                    <select class="form-control" id="nama_obat" name="nama_obat[]">
                        @foreach($dataobat as $dataobats)
                        <option value="{{$dataobats->nama_obat}}">{{$dataobats->nama_obat}}</option>
                        @endforeach
                    </select>
                    <!-- <select class="form-control" id="jenis" name="nama[]">
                        <option value="">Please select</option>
                        <option value=""></option>
                    </select> -->
                <label>Jumlah</label>
                <input type="text" name="jk[]" class="form-control">
            </div>
            <!-- <div class="control-group">
               <button class="btn btn-danger remove" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>  
                <br>
                <label>Nama Obat</label>
                <select class="form-control" id="jenis" onkeyup="jadi();" name="nama[]">
                    <option value="">Please select</option>
                    <option value=""></option>
                </select>
                <label>Jumlah</label>
                <input type="text" name="jk[]" class="form-control">
              <hr>
            </div> -->
          </div>
        </div>
    </div>
</div>
  

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script>
function cariimt() {
      var txtFirstNumberValue = document.getElementById("tb").value;
      var txtSecondNumberValue = document.getElementById("bb").value;
      var tb = txtFirstNumberValue*0.01;
      var result = (txtSecondNumberValue)/(tb*tb);
      var finalresult = result.toFixed(1)
         
         if(result < 17){
          document.getElementById("imt").value = finalresult;
          document.getElementById("ket").value = "sangat kurus";
         }
        else if(result > 17 && result <=18.4){
          document.getElementById("imt").value = finalresult;
          document.getElementById("ket").value = "kurus";
         }
        else if(result > 18.4 && result <=25){
          document.getElementById("imt").value = finalresult;
          document.getElementById("ket").value = "normal";
         }
          else if(result > 25 && result <=27){
            document.getElementById("imt").value = finalresult;
          document.getElementById("ket").value = "gemuk";
         }
         else{
          document.getElementById("imt").value = finalresult;
           document.getElementById("ket").value = "sangat gemuk";
         }
      }
</script>
<script>
    function cari() {
      var txtFirstNumberValue = document.getElementById("tb").value;
      var txtSecondNumberValue = document.getElementById("bb").value;
      var tb = txtFirstNumberValue*0.01;
      var result = (txtSecondNumberValue)/(tb*tb);
      var finalresult = result.toFixed(1)
         
         if(result < 17){
          document.getElementById("imt").value = finalresult;
        //   document.getElementById("ket").value = "sangat kurus";
         }
        else if(result > 17 && result <=18.4){
          document.getElementById("imt").value = finalresult;
        //   document.getElementById("ket").value = "kurus";
         }
        else if(result > 18.4 && result <=25){
          document.getElementById("imt").value = finalresult;
        //   document.getElementById("ket").value = "normal";
         }
          else if(result > 25 && result <=27){
            document.getElementById("imt").value = finalresult;
        //   document.getElementById("ket").value = "gemuk";
         }
         else{
          document.getElementById("imt").value = finalresult;
        //    document.getElementById("ket").value = "sangat gemuk";
         }
      }
      
     $(document).ready(function() {
        var nilai=1;
        $(".copy").hide()        
        $(".add-more").click(function(){ 
            var html = $(".copy").html();
            $(".after-add-more").after(html);
            var html1 = $(".add-more").html();
            $(".copy").after(html1);
            document.getElementById("coret").value =++nilai;
        });

      // saat tombol remove dklik control group akan dihapus 
      $("body").on("click",".remove",function(){ 
          $(this).parents(".control-group").remove();
          document.getElementById("coret").value =--nilai;
      });
    });
    function jadi(){
        var jenis = document.getElementById('jenisresep').value;
        // console.log("kaks");
        if(jenis === "Jadi"){
            $("#add").attr('disabled', 'true');
        }
    }

</script>
@include('dokter.templatedokter.v_footer')