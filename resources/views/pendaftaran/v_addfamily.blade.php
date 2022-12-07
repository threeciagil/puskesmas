@include('template.header')
@include('pendaftaran.template.sidebar')
<!--**********************************
            Content body start
        ***********************************-->
<div class="row page-titles mx-0">
    <div class="col p-md-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Family Folder</a></li>
        </ol>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <!-- <h4 class="card-title">Data Family Folder</h4> -->
                    <div class="table-responsive">
                        <div class="container">
                            <div class="py-5 text-center">
                                <h1 class="h1 mb-3 font-weight-normal" style="text-align: center;"> Tambah Family Folder </h1>
                            </div>


                            <form class="ui form" action="/daftarantrian/createfamily" method="post" enctype="multipart/form-data">
                            @csrf <!-- {{ csrf_field() }} -->

                                <input type="hidden" name="segment" id="segment" class="form-control" value="{{ Request::segment(3) }}"  autofocuse>
                                <!-- <h1 class="h1 mb-3 font-weight-normal" style="text-align: center;"> Tambah Data Family Folder </h1> -->
                                <label for="inputNamaKK">Nama Kartu Keluarga</label>
                                <input type="text" name="nama_kk" id="inputNamaKK" class="form-control" placeholder="Nama KK" required autofocuse></input>
                                <br>
                                <label for="inputAlamat">Alamat</label>
                                <input type="text" name="alamat" id="inpuAlamat" class="form-control" placeholder="Alamat Lengkap" required autofocuse></input>
                                <br>
                                <label for="inputDesa">Desa</label>
                                <input type="text" name="desa" id="inputDesa" class="form-control" placeholder="Nama Desa" required autofocuse></input>
                                <br>
                                <label for="inputKecamatan">Kecamatan</label>
                                <input type="text" name="kecamatan" id="inputKecamatan" class="form-control" placeholder="Nama Kecamatan" required autofocuse></input>
                                <br>
                                <label for="inputKabupaten">Kabupaten</label>
                                <input type="text" name="kabupaten" id="inputKabupaten" class="form-control" placeholder="Nama Kabupaten" required autofocuse></input>
                                <br>
                                <label for="inputHP">No. Telp./HP.</label>
                                <input type="text" name="telp" id="inputHP" class="form-control" placeholder="Nomor Telpon / HP" required autofocuse></input>
                                <br>
                                <label for="kk">Upload gambar KK</label>
                                <input type="file" name="kk" id="kk" class="form-control" placeholder="Upload gambar KK" required autofocuse></input>
                                <br>

                                <!-- <label for="inputIndex">Foto Dokumen Kartu Keluarga</label>
                                    <input type="text" name="no_index" id="inputIndex" class="form-control" placeholder="Nomor Index" required autofocuse>
                                    <br> -->
                                <div class="col-sm-2">

                                    <button class="btn btn-lg btn-primary btn-block" type="submit"> Simpan</button>

                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@include('template.footer')
