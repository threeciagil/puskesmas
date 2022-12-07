@include('template.header')
@include('laboratorium.template.sidebar')

<div class="row page-titles mx-0">
    <div class="col p-md-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Data Laboratorium</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Data Pelayanan Dokter</a></li>
        </ol>
    </div>
</div>
<!-- row -->
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <!-- <h4 class="card-title">Data Table</h4> -->
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered zero-configuration">
                            <thead>

                            <tr>
                                <th class="text-center">No.</th>
                                <th class="text-center">Nama Pemeriksaan</th>
                                <th class="text-center">Jenis Pemeriksaan</th>
                                <th class="text-center">Tarif</th>
                                <th class="text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php $no=1; ?>
                                @foreach($data as $datas)
                                <tr>
                                    <td class="text-center" style="width: 1px;">{{$no}} </td>
                                    <td > {{$datas->nama}}</td>
                                    <td > {{$datas->jenis_dokter}}</td>
                                    <td > {{$datas->tarif}}</td>
                                    <td class="text-center">
                                        
                                        <span>
                                        <button type="button" class="btn btn-info" onclick="location.href='/showpemeriksaandokter/{{$datas->id_data_laborat_dokter}}'" data-toggle="tooltip" data-placement="top" title="Detail">
                                                Detail
                                        </button>
                                        </span>
                                        <span>
                                            <a class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus obat ini?')" href="/laborat/deletepelayanandokter/{{$datajenis[0]->id_jenis_dokter}}/{{$datas->id_data_laborat_dokter}}" data-toggle="tooltip" data-placement="top" title="Hapus" >
                                               Hapus
                                            </a>
                                        <!-- <button type="button" class="btn btn-danger" onclick="location.href='/laborat/deletepelayanandokter/{{$datajenis[0]->id_jenis_dokter}}/{{$datas->id_data_laborat_dokter}}'" data-toggle="tooltip" data-placement="top" title="Hapus">
                                                Hapus
                                        </button> -->
                                        </span>
                                    </td>
                                </tr>
                                <?php $no++; ?>
                                @endforeach;
                            </tbody>
                        </table>

                    <div class="card-footer">
                        <div class="rounded-button">
                             <button type="button" class="btn mb-1 btn-rounded btn-primary float-right" data-toggle="modal" data-target="#basicModal1">Tambah Data</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #/ container -->
    </div>
</div>
<div class="modal" id="basicModal1" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <h5 class="modal-title">Tambah Jenis Pemeriksaan Dokter</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <form class="form-horizontal" enctype="multipart/form-data" method="post" action="/savepelayanandokter">
                @csrf
                
                <input type="hidden" value="{{$datajenis[0]->id_jenis_dokter}}" name="id_jenis" class="form-control">
                <div class="modal-body">
                    <!-- Modal body text goes here. -->
                    <!-- <div class="form-group row">
                        <label class="col-lg-4 col-form-label">Kode</label>
                        <div class="col-lg-6">
                            <?//php $jdata = count($data)?>
                            <input readonly type="text" class="form-control" name="kode" value=//"{//{//$jdata}}" placeholder="Kode" required autofocuse>
                        </div>
                    </div> -->
                    <div class="form-group row">
                        <label class="col-lg-4 col-form-label">Nama Jenis Pemeriksaan Dokter</label>
                        <div class="col-lg-6">
                            <input readonly type="text" class="form-control" name="nama_jenis_lab" value="{{$datajenis[0]->jenis_dokter}} " placeholder="Jenis Pemeriksaan Lab" required autofocuse>
                            <input type="hidden" class="form-control" name="jenis_lab" value="{{$datajenis[0]->id_jenis_dokter}} " placeholder="Jenis Pemeriksaan Lab" required autofocuse>
                    </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-4 col-form-label">Nama Pemeriksaan</label>
                        <div class="col-lg-6">
                             <input type="text" name="nama_pemeriksaan_dokter" id="nama_pemeriksaan_dokter" class="form-control" placeholder="Nama Pemeriksaan" required autofocuse>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-4 col-form-label">Nama Pemeriksaan Laboratorium</label>
                        <!-- <div class="col-lg-12"> -->
                            <div class="col-lg-6">
                             <!-- <label class="form-check-label"> -->
                                @foreach($datanama as $datanama)
                                   <input type="checkbox" class="form-check-input" name="id_nama[]" value="{{$datanama->id_nama_pemeriksaan}}" ><label for="id_nama[]">{{$datanama->nama_pemeriksaan }}</label><br>
                                <!-- </label> -->
                                @endforeach
    
                            <!-- </div> -->
                        </div>    
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-4 col-form-label">Tarif</label>
                        <div class="col-lg-6">
                            <input type="text" name="tarif" id="tarif" class="form-control" placeholder="Tarif" required autofocuse>
                        </div>
                    </div>
                    <!-- <div class="form-group row">
                        <label class="col-lg-4 col-form-label">Nilai Normal</label>
                        <div class="col-lg-6">
                            <input type="text" name="nilai_normal" id="nilai_normal" class="form-control" placeholder="Nilai Normal" required autofocuse>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-4 col-form-label">Satuan</label>
                        <div class="col-lg-6">
                            <input type="text" name="satuan" id="satuan" class="form-control" placeholder="Satuan" required autofocuse>
                        </div>
                    </div> -->
                </div>
                <div class="modal-footer">
                    </br>
                    <input type="hidden">
                    <button class="btn btn-default btn-sm" data-dismiss="modal" aria-hidden="true">Batal</button>
                    <button class="btn btn-primary btn-sm">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@include('template.footer')
