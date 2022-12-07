@include('template.header')
@include('admin.template.sidebar')
<div class="row page-titles mx-0">
    <div class="col p-md-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Data</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Jaminan Kesehatan</a></li>
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
                                    <th>No.</th>
                                    <th>Kependekan Jaminan Kesehatan</th>
                                     <th>Nama Jaminan Kesehatan</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                @foreach($jamkes as $jamkes)
                                <tr>
                                    <td class=" text-center">{{$no}} </td>
                                    <td>{{$jamkes->singkatan_jamkes}} </td>
                                    <td>{{$jamkes->nama_jamkes}} </td>
                                    <td><span>
                                        <a class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus obat ini?')" href="/admin/hapusjamkes/{{$jamkes->id_jamkes}}" data-toggle="tooltip" data-placement="top" title="Hapus" >
                                                Hapus
                                        </a>
                                    <!-- <button type="button" class="btn btn-danger"  data-toggle="tooltip" data-placement="top" title="Hapus" oonclick="return confirm('Yakin ingin menghapus obat ini?')" href="/admin/hapusjamkes/{{$jamkes->id_jamkes}}">
                                        Hapus
                                    </button> -->
                                    </td>
                                </tr>
                                <?php $no++; ?>
                                @endforeach
                            </tbody>
                            <!-- <tfoot>
                                <tr>
                                    <th>No.</th>\
                                      <th>Kependekan Jaminan Kesehatan</th>
                                    <th>Nama Jaminan Kesehatan</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot> -->
                        </table>
                        <div class="rounded-button">
                            <button type="button" class="btn btn-primary " data-toggle="modal" data-target="#basicModal1">Tambah Data</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="basicModal1" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Jaminan Kesehatan</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <form class="form-horizontal" enctype="multipart/form-data" method="post" action="savejamkes ">
                    @csrf
                    <div class="modal-body">
                        <!-- Modal body text goes here. -->
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label">Nama Jaminan Kesehatan</label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" name="nama_jamkes" placeholder="Nama Jaminan Kesehatan">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label">Singkatan Jaminan Kesehatan</label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" name="singkatan" placeholder="Nama Jaminan Kesehatan">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        </br>
                        <!-- <input type="hidden" name="id_pesan"> -->
                        <button class="btn btn-default btn-sm" data-dismiss="modal" aria-hidden="true">Batal</button>
                        <button class="btn btn-primary btn-sm">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- #/ container -->
</div>
<!--**********************************
            Content body end
        ***********************************-->
@include('template.footer')