@include('template.header')
@include('laboratorium.template.sidebar')

<div class="row page-titles mx-0">
    <div class="col p-md-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Data Laboratorium</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Data Jenis Pemeriksaan</a></li>
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
                                <th class="text-center" style="width: 10px;">Jenis Pemeriksaan Lab</th>
                                <th class="text-center" style="width: 40px;">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                @foreach($jenis as $jenis)
                                <tr>
                                    <td class="text-center" style="width: 1px;"> {{$no}}</td>
                                    <td class="text-center" style="width: 10px;"> {{$jenis->jenis_pemeriksaan}}</td>
                                    <td class="text-center" style="width: 40px;">
                                        <span>
                                        <button type="button" onclick="location.href='/laboratdataujilab/{{$jenis->id_jenis_pemeriksaan}}'" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Layani">
                                            Data Pelayanan 
                                            </button>
                                        </span>
                                        <span>
                                            <a class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus obat ini?')" href="/laborat/deletedatajenislab/{{$jenis->id_jenis_pemeriksaan}}" data-toggle="tooltip" data-placement="top" title="Hapus" >
                                               Hapus
                                            </a>
                                        <!-- <button type="button" class="btn btn-danger" onclick="location.href='/laborat/deletedatajenislab/{{$jenis->id_jenis_pemeriksaan}}'" data-toggle="tooltip" data-placement="top" title="Hapus">
                                                Hapus
                                        </button> -->
                                        </span>
                                    </td>
                                </tr>
                                <?php $no++; ?>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
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

                <h5 class="modal-title">Tambah Jenis Pemeriksaan</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <form class="form-horizontal" enctype="multipart/form-data" method="post" action="/savejenispelayananlab">
                @csrf
                <div class="modal-body">
                    
                    <div class="form-group row">
                        
                        <label class="col-lg-4 col-form-label">Jenis Pemeriksaan Lab</label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" name="jenis_pemeriksaan" id="jenis_pemeriksaan" placeholder="Jenis" required autofocuse>
                        </div>
                    </div>
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
<!-- <div class="modal" id="basicModal1" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <h5 class="modal-title">Tambah Jenis Pemeriksaan Lab</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <form class="form-horizontal" enctype="multipart/form-data" method="post" action="/savejenislab">
                @csrf
                <div class="modal-body">
                     Modal body text goes here.
                    <div class="form-group row">
                        <label class="col-lg-4 col-form-label">Jenis Pemeriksaan Lab</label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" name="jenis_pemeriksaan" placeholder="Jenis ">
                        </div>
                    </div>
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
</div> -->


@include('template.footer')
