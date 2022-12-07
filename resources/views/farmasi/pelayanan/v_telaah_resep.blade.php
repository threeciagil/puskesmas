@include('farmasi.templatefarmasi.v_header')
@include('farmasi.templatefarmasi.v_sidebar_farmasi')
<div class="row page-titles mx-0">
    <div class="col p-md-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Antrian</a></li>
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
                                <li class="mb-1"><strong class="text-dark mr-4">No. Antrian</strong> <span class="float-right">{{$pasiens->no_antrian}}</span></li>
                                <li class="mb-1"><strong class="text-dark mr-4">Tanggal</strong> <span class="float-right">{{$pasiens->tanggal}}</span></li>
                                <li class="mb-1"><strong class="text-dark mr-4">No. Rekam Medis</strong> <span class="float-right">{{$pasiens->no_rm}}</span></li>
                                <li class="mb-1"><strong class="text-dark mr-4">Nama Lengkap</strong> <span class="float-right">{{$pasiens->nama}}</span></li>
                                <li class="mb-1"><strong class="text-dark mr-4">Tanggal Lahir</strong> <span class="float-right"> {{$pasiens->tanggal_lahir}}</span></li>
                                <li class="mb-1"><strong class="text-dark mr-4">Umur</strong> <span class="float-right">{{$pasiens->umur}}</span></li>
                                <li class="mb-1"><strong class="text-dark mr-4">Alamat</strong> <span class="float-right">{{$pasiens->alamat}}</span></li>
                                <li class="mb-1"><strong class="text-dark mr-4">Jenis Kelamin</strong> <span class="float-right">{{$pasiens->jenis_kelamin}}</span></li>
                                <li class="mb-1"><strong class="text-dark mr-4">Jenis Asuransi</strong> <span class="float-right">{{$pasiens->jenis_asuransi}}</span></li>
                                <li class="mb-1"><strong class="text-dark mr-4">Nomor Asuransi</strong> <span class="float-right">{{$pasiens->no_asuransi}} </span></li>
                                <li class="mb-1"><strong class="text-dark mr-4">Poli Asal</strong> <span class="float-right">{{$pasiens->poli_asal}} </span></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-xl-8">

                    <div class="card">
                <div class="card-body">
                    <div class="row mb-8">
                        <div>
                            <h4 class="text-muted mb-4">Data Pelayanan</h4>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Racikan</th>
                                        <th>Nama Obat</th>
                                        <th>Satuan</th>
                                        <th>Jumlah Permintaan</th>
                                        <th>Signa</th>
                                        <th>Aturan Pakai</th>
                                        <!-- <th>Keterangan</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no=1; ?>
                                    @foreach($obat as $obats)
                                    <tr>
                                        <td>{{$obats->jenis_resep}}</td>
                                        <td>{{$obats->nama_obat}}</td>
                                        <td>{{$obats->satuan}}</td>
                                        <td>{{$obats->jumlah}}</td>
                                        <td>{{$obats->signa}}</td>
                                        <td>{{$obats->aturan_pakai}}</td>
                                        <!-- <td>//{//{$obats->status}}</td> -->
                                    </tr>
                                    <?php $no++; ?>
                                    @endforeach
                                </tbody>
                            </table>
                            <a href="/selesai/{{$pasien[0]->no_rm}}/" class="btn mb-1 btn-rounded btn-warning float-right text-white mr-2">Selesai</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

        <!-- <div class="col-lg-12 col-xl-12">
      
                <div class="card">
                   
                    <div class="card-body">
                     
                
                        <div>
                            <h4 class="text-center text-muted mb-4">TELAAH RESEP</h4>
                        </div>

                        
                              <div class="form-row align-items-center">
                                <div class="col-auto my-1">
                                   <h4 class="text-center mb-4"> Penelaah </h4>
                                </div>
                            </div>
                   
                    <form enctype="multipart/form-data" method="post" action="">
                        <div class="table-responsive">
                            <table class="table table-bordered">

                                <thead>
                                    <tr>
                                         <th>  <h4> <span class="label label-warning mb-4">Persyaratan Administrasi </span></h4></th>
                                        <th><h4> <span class="label label-warning mb-4">Pilihan</span></h4></th>
                                        <th><h4> <span class="label label-warning mb-4">Keterangan</span></h4></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <tr>
                                        <td>Nama, Tanggal Lahir, Jenis Kelamin, BB, TB</td>
                                        <td>
                                            <div class="radio mb-3">
                                                <label>
                                                    <input type="radio" required=""  value="ada" name="adm1">Ada</label>
                                            </div>
                                            <div class="radio mb-3">
                                                <label>
                                                    <input type="radio" required=""  value="tidak ada" name="adm1">Tidak Ada</label>
                                            </div>
                                        </td>
                                        <td>
                                            <input type="text" name="ketadm1" class="form-control input-rounded" placeholder="Keterangan">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Nama, SIP, Alamat dan Paraf Dokter</td>
                                        <td>
                                            <div class="radio mb-3">
                                                <label>
                                                    <input type="radio" required="" value="ada" name="adm2">Ada</label>
                                            </div>
                                            <div class="radio mb-3">
                                                <label>
                                                    <input type="radio" required=""  value="tidak ada" name="adm2">Tidak Ada</label>
                                            </div>
                                        </td>
                                        <td>
                                            <input type="text" name="ketadm2" class="form-control input-rounded" placeholder="Keterangan">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal Resep</td>
                                        <td>
                                            <div class="radio mb-3">
                                                <label>
                                                    <input type="radio" required=""  value="ada" name="adm3">Ada</label>
                                            </div>
                                            <div class="radio mb-3">
                                                <label>
                                                    <input type="radio" required=""  value="tidak ada" name="adm3">Tidak Ada</label>
                                            </div>
                                        </td>
                                        <td>
                                            <input type="text" name="ketadm3" class="form-control input-rounded" placeholder="Keterangan">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Ruangan / Unit Asal Resep</td>
                                        <td>
                                            <div class="radio mb-3">
                                                <label>
                                                    <input type="radio"required=""  value="ada" name="adm4">Ada</label>
                                            </div>
                                            <div class="radio mb-3">
                                                <label>
                                                    <input type="radio" required=""  value="tidak ada" name="adm4">Tidak Ada</label>
                                            </div>
                                        </td>
                                        <td>
                                            <input type="text" name="ketadm4" class="form-control input-rounded" placeholder="Keterangan">
                                        </td>
                                    </tr>
                                </tbody>
                     
                     
                 
                           
                                <thead>
                                    <tr>
                                       <th>  <h4> <span class="label label-warning mb-4">Persyaratan Farmasetik </span></h4></th>
                                        <th><h4> <span class="label label-warning mb-4">Pilihan</span></h4></th>
                                        <th><h4> <span class="label label-warning mb-4">Keterangan</span></h4></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Nama obat, Bentuk dan Kekuatan sediaan</td>
                                        <td>
                                            <div class="radio mb-3">
                                                <label>
                                                    <input type="radio" required=""  value="ada" name="farm1">Ada</label>
                                            </div>
                                            <div class="radio mb-3">
                                                <label>
                                                    <input type="radio"required=""  value="tidak ada" name="farm1">Tidak Ada</label>
                                            </div>
                                        </td>
                                        <td>
                                            <input type="text" name="ketfarm1" class="form-control input-rounded" placeholder="Keterangan">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Dosis dan Jumlah Obat</td>
                                        <td>
                                            <div class="radio mb-3">
                                                <label>
                                                    <input type="radio" required=""  value="ada" name="farm2">Ada</label>
                                            </div>
                                            <div class="radio mb-3">
                                                <label>
                                                    <input type="radio" required=""  value="tidak ada" name="farm2">Tidak Ada</label>
                                            </div>
                                        </td>
                                        <td>
                                            <input type="text" name="ketfarm2" class="form-control input-rounded" placeholder="Keterangan">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Stabilitas</td>
                                        <td>
                                            <div class="radio mb-3">
                                                <label>
                                                    <input type="radio" required=""  value="ada" name="farm3">Ada</label>
                                            </div>
                                            <div class="radio mb-3">
                                                <label>
                                                    <input type="radio" required=""  value="tidak ada" name="farm3">Tidak Ada</label>
                                            </div>
                                        </td>
                                        <td>
                                            <input type="text" name="ketfarm3" class="form-control input-rounded" placeholder="Keterangan">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Aturan dan Cara Penggunaan</td>
                                        <td>
                                            <div class="radio mb-3">
                                                <label>
                                                    <input type="radio" required=""  value="ada" name="farm4">Ada</label>
                                            </div>
                                            <div class="radio mb-3">
                                                <label>
                                                    <input type="radio" required=""  value="tidak ada" name="farm4">Tidak Ada</label>
                                            </div>
                                        </td>
                                        <td>
                                            <input type="text" name="ketfarm4" class="form-control input-rounded" placeholder="Keterangan">
                                        </td>
                                    </tr>
                                </tbody>
                     
               
                      
                                <thead>
                                    <tr>
                                        <th>  <h4> <span class="label label-warning mb-4">Persyaratan Klinis </span></h4></th>
                                        <th><h4> <span class="label label-warning mb-4">Pilihan</span></h4></th>
                                        <th><h4> <span class="label label-warning mb-4">Keterangan</span></h4></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Tepat Indikasi, Dosis dan Waktu Penggunaan Obat</td>
                                        <td>
                                            <div class="radio mb-3">
                                                <label>
                                                    <input type="radio" required=""  value="ada"  name="klinis1">Ada</label>
                                            </div>
                                            <div class="radio mb-3">
                                                <label>
                                                    <input type="radio"required=""  value="tidak ada" name="klinis1">Tidak Ada</label>
                                            </div>
                                        </td>
                                        <td>
                                            <input type="text" name="ketklinis1" class="form-control input-rounded" placeholder="Keterangan">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Duplikasi Pengobatan</td>
                                        <td>
                                            <div class="radio mb-3">
                                                <label>
                                                    <input type="radio" required=""  value="ada" name="klinis2">Ada</label>
                                            </div>
                                            <div class="radio mb-3">
                                                <label>
                                                    <input type="radio" required=""  value="tidak ada" name="klinis2">Tidak Ada</label>
                                            </div>
                                        </td>
                                        <td>
                                            <input type="text" name="ketklinis2" class="form-control input-rounded" placeholder="Keterangan">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Alergi dan Reaksi obat yang tidak diinginkan</td>
                                        <td>
                                            <div class="radio mb-3">
                                                <label>
                                                    <input type="radio" required=""  value="ada" name="klinis3">Ada</label>
                                            </div>
                                            <div class="radio mb-3">
                                                <label>
                                                    <input type="radio" required=""  value="tidak ada" name="klinis3">Tidak Ada</label>
                                            </div>
                                        </td>
                                        <td>
                                            <input type="text" name="ketklinis3" class="form-control input-rounded" placeholder="Keterangan">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Kontra Indikasi</td>
                                        <td>
                                            <div class="radio mb-3">
                                                <label>
                                                    <input type="radio" required=""  value="ada" name="klinis4">Ada</label>
                                            </div>
                                            <div class="radio mb-3">
                                                <label>
                                                    <input type="radio" required=""  value="tidak ada" name="klinis4">Tidak Ada</label>
                                            </div>
                                        </td>
                                        <td>
                                            <input type="text" name="ketklinis4" class="form-control input-rounded" placeholder="Keterangan">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Interaksi Obat</td>
                                        <td>
                                            <div class="radio mb-3">
                                                <label>
                                                    <input type="radio" required=""  value="ada" name="klinis5">Ada</label>
                                            </div>
                                            <div class="radio mb-3">
                                                <label>
                                                    <input type="radio" required=""  value="tidak ada" name="klinis5">Tidak Ada</label>
                                            </div>
                                        </td>
                                        <td>
                                            <input type="text" name="ketklinis5" class="form-control input-rounded" placeholder="Keterangan">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="rounded-button">
                            <button type="submit" class="btn mb-2 btn-secondary float-right">Telaah Resep</button>
                        </div>
                    </div>
                </div>
                    
            </form>

                            
        </div> -->
    </div>
    <!-- #/ container -->
</div>


<!--**********************************
            Content body end
        ***********************************-->
@include('farmasi.templatefarmasi.v_footer')