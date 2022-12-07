@include('template.header')
@include('laboratorium.template.sidebar')
<div class="row page-titles mx-0">
    <div class="col p-md-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Pelayanan Lab</a></li>
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
                            <li class="mb-1"><strong class="text-dark mr-4">No. Pendaftaran</strong> <span>{{$pasien[0]->no_antrian}} </span></li>
                            <li class="mb-1"><strong class="text-dark mr-4">Tanggal</strong> <span> {{$pasien[0]->tanggal}}</span></li>
                            <li class="mb-1"><strong class="text-dark mr-4">Nama</strong> <span>{{$pasien[0]->nama}} </span></li>
                            <li class="mb-1"><strong class="text-dark mr-4">No RM</strong> <span> {{$pasien[0]->no_rm}}</span></li>
                            <li class="mb-1"><strong class="text-dark mr-4">TanggalLahir</strong> <span> {{$pasien[0]->tanggal_lahir}}</span></li>
                            <li class="mb-1"><strong class="text-dark mr-4">Umur</strong> <span> {{$pasien[0]->umur}}</span></li>
                            <li class="mb-1"><strong class="text-dark mr-4">Asuransi</strong> <span>{{$pasien[0]->jenis_asuransi}} </span></li>
                            <li class="mb-1"><strong class="text-dark mr-4">Nama KK</strong> <span>{{$pasien[0]->nama_kk}}</span> </li>
                            <li class="mb-1"><strong class="text-dark mr-4">Poli Asal</strong> <span> {{$pasien[0]->poli_asal}}</span></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="card">
                <!-- <div class="card-body">
                    <div class="row mb-5">
                        <div>
                            <h4 class="text-muted mb-4">Data Pelayanan</h4>
                        </div>
                        <div class="col-12 text-center">
                            <div class="btn-group-vertical">
                                <button class="btn btn-secondary mb-2 px-4">Riwayat Rekam Medis</button>
                                <button class="btn btn-secondary mb-2 px-4">Riwayat Pemeriksaan</button>
                            </div>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
        <div class="col-lg-12 col-xl-9">
            <div class="card">
                <!-- <section> -->
                <div class="card-body">
                    <div>
                        <h4 class="text-muted mb-4"> Data Permintaan Lab</h4>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Jenis Pemeriksaan</th>
                                    <th>Nama Pemeriksaan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no=1;?>
                                @foreach($permintaan as $permintaans)
                                    <tr>
                                        <td>{{$no}}</td>
                                        <td>{{$permintaans->jenis_dokter}}</td>
                                        <td>{{$permintaans->nama_pemeriksaan}}</td>
                                    </tr>
                                    <?php $no++; ?>
                                @endforeach
                            </tbody>
                        </table>
                        <h5>Dokter Penanggung Jawab :</h5><span>{{$permintaan[0]->dokter_penanggungjawab}}</span>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div>
                        <h4 class="text-muted mb-4">Pemeriksaan Laboratorium</h4>
                    </div>
                    <div class="form-group">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>

                                    </tr>
                                </thead>
                                <tbody>                                    
                                    <!-- <th class="card-title mt-3">Hematologi</th> -->
                                    <td>
                                    <form action="/savehasillab" method="post">
                                        @csrf  
                                        <input type="hidden" value="{{$permintaan[0]->id_pemeriksaan}}" name="id_pemeriksaan" class="form-control">
                                        <input type="hidden" value="{{$pasien[0]->no_rm}}" name="no_rm" class="form-control">
                                        @foreach($permintaan as $permintaans)
                                            <h4>{{$permintaans->jenis_dokter}} - {{$permintaans->nama_pemeriksaan}}</h4>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Jenis</label>
                                                        <input type="text" value="{{$permintaans->jenis_dokter}}" name="jenis[]" class="form-control" required disabled> 
                                                        <input type="hidden" value="{{$permintaans->id_jenis_dokter}}" name="id_jenis[]" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Nama</label>
                                                        <input type="text" name="nama[]" value="{{$permintaans->nama_pemeriksaan}}" class="form-control" required disabled>
                                                        <input type="hidden" value="{{$permintaans->id_nama_pemeriksaan}}" name="id_nama[]" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Nilai Normal</label>
                                                        <input type="text" name="nilai_normal[]" value="{{$permintaans->nilai_normal}}" class="form-control" required disabled>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Satuan</label>
                                                        <input type="text" name="satuan[]" value="{{$permintaans->satuan}}" class="form-control" required disabled>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Hasil Lab</label>
                                                        <input type="text" name="hasil[]"  class="form-control" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <!-- <div class="form-check ">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input" name="chk[]" id="chk[]" value="{{$permintaans->nama}}">{{$permintaans->nama}}</label>
                                            </div><br> -->
                                        @endforeach
                                        <button type="submit" class="btn btn-primary mt-5">Proses</button>
                                    </form>  
                                    </td>
                                    </tbody>
                                </table>
                            <!-- <button type="button" class="btn btn-primary "> Proses</button> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>  
                                        <!-- <div class="form-check ">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input" value="">LECO</label>
                                        </div><br>
                                        <div class="form-check ">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input" value="">ERY</label>
                                        </div><br>
                                        <div class="form-check ">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input" value="">TROMBO</label>
                                        </div><br>
                                        <div class="form-check ">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input" value="">HCT</label>
                                        </div> -->
                                    
                                    <!-- <th class="card-title mt-3">Hitung Jenis</th>
                                    <td>
                                        <div class="form-check disabled">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input" value="">Basofil</label>
                                        </div><br>
                                        <div class="form-check disabled">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input" value="">Eos</label>
                                        </div><br>
                                        <div class="form-check disabled">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input" value="">Batang</label>
                                        </div><br>
                                        <div class="form-check disabled">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input" value="">Segmen</label>
                                        </div><br>
                                        <div class="form-check disabled">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input" value="">limfo</label>
                                        </div><br>
                                        <div class="form-check disabled">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input" value="">Monosit</label>
                                        </div><br>

                                    </td> -->
                                
        <!-- #/ container -->
    </div>
</div>


    <!--**********************************
            Content body end
        ***********************************-->
@include('template.footer')