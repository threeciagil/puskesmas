@include('farmasi.templatefarmasi.v_header')
@include('farmasi.templatefarmasi.v_sidebar_farmasi')
<div class="row page-titles mx-0">
    <div class="col p-md-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Data Obat</a></li>
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
                                    <th class="text-center" style="width: 1px;">No.</th>
                                    <th class="text-center" style="width: 10px;">Nama Obat</th>
                                    <th class="text-center" style="width: 10px;">Satuan</th>
                                    <th class="text-center" style="width: 100px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $no = 1; ?>
                                @foreach($dataobat as $dataobats)
                                <tr>
                                    <td class="text-center" style="width: 1px;">{{$no}}</td>
                                    <td class="text-center" style="width: 10px;">{{$dataobats->nama_obat}}</td>
                                    <td class="text-center" style="width: 10px;">{{$dataobats->satuan}}</td>

                                    <td class="text-center" style="width: 100px;">
                                        <span>
                                            <a class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus obat ini?')" href="/tabelobat/hapusdataobat/{{$dataobats->id_obat}}" data-toggle="tooltip" data-placement="top" title="Hapus" >
                                                <i class="fa fa-trash"></i>
                                            </a>
                                            <!-- <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal"><i class="fa fa-trash"></i></button> -->
                                        </span>
                                    </td>
                                </tr>
                                <?php $no++; ?>
                                @endforeach
                            </tbody>
                            <!-- <tfoot>
                                <tr>
                                    <th class="text-center">No.</th>
                                 
                                    <th>Nama Obat</th>
                                    <th>Jenis Obat</th>
                                       <th>harga</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot> -->
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

                    <h5 class="modal-title">Tambah Harga Pelayanan</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
            <form class="form-horizontal" enctype="multipart/form-data"  method="post" action="/tabelobat/tambahdataobat" >
            @csrf    
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-lg-4 col-form-label" for="nama_obat">Nama Obat</label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" id="nama_obat" name="nama_obat" placeholder="Nama Obat" required autofocuse>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-4 col-form-label" for="satuan">Satuan</label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" id="satuan" name="satuan" placeholder="Satuan Obat" required autofocuse>
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

<!-- <div class="modal" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">

                    <h5 class="modal-title">Tambah Harga Pelayanan</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
           
                <div class="modal-body">
                </div>
                    
                <div class="modal-footer">
                    </br>
                    <input type="hidden" name="id_pesan">
                    <button class="btn btn-default btn-sm" data-dismiss="modal" aria-hidden="true">Batal</button>
                    <button class="btn btn-danger btn-sm">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div> -->



<script>
    // function deleteConfirm(url) {
    //     $('#btn-delete').attr('href', url);
    //     $('#deleteModal').modal();
    // }
</script>
<!--**********************************
            Content body end
        ***********************************-->
        @include('farmasi.templatefarmasi.v_footer')