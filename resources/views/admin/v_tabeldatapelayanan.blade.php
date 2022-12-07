@include('template.header')
@include('admin.template.sidebar')
<div class="row page-titles mx-0">
    <div class="col p-md-0">
        <ol class="breadcrumb">
             <li class="breadcrumb-item"><a href="javascript:void(0)">Data</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Tindakan Pelayanan</a></li>
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
                                    <!-- <th class="text-center">Nama Poli</th> -->
                                    <th class="text-center">Nama Tindakan</th>
                                    <th class="text-center">Tarif Tindakan</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                @foreach($tindakan as $tindakan)
                                <tr>
                                    <td class=" text-center"> {{$no}}</td>
                                    <!-- <td> //{//{$tindakan->poli}}</td> -->
                                    <td>{{$tindakan->nama_tindakan}} </td>
                                    <td>{{$tindakan->tarif}} </td>
                                    <td class="text-center"><span>
                                        <a class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus obat ini?')" href="/admin/hapustindakan/{{$tindakan->id_datatindakan}}" data-toggle="tooltip" data-placement="top" title="Hapus" >
                                                Hapus
                                        </a>
                                    </span>
                                    <!-- <button type="button" class="btn btn-danger"  data-toggle="tooltip" data-placement="top" title="Hapus" onclick="location.href='/admin/hapustindakan/{{$tindakan->id_datatindakan}}'">
                                        Hapus
                                    </button> -->
                                    </td>
                                </tr>
                                <?php $no++; ?>
                                @endforeach
                            </tbody>
                            <!-- <tfoot>
                                <tr>
                                    <th class="text-center">No.</th>
                                    <th>Nama Poli</th>
                                    <th>Nama Tindakan</th>
                                    <th>Tarif Tindakan</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot> -->
                        </table>
                    </div>
                    <div class="card-footer">
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

                    <h5 class="modal-title">Tambah Harga Pelayanan</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
               <form class="form-horizontal" enctype="multipart/form-data" method="post" action="/admin/savetindakan">
                    @csrf
                    <div class="modal-body">
                        <!-- Modal body text goes here. -->
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label">Nama Tindakan </label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" name="nama_tindakan" placeholder="Nama Tindakan">
                            </div>
                        </div>
                        <!-- <div class="form-group row">
                            <label class="col-lg-4 col-form-label">Nama Poli</label>
                            <div class="col-lg-6">
                                <input readonly type="text" name="nama_poli" class="form-control" value="Poli Umum" placeholder="Nama Kepala Keluarga" required autofocuse>    
                            </div>
                        </div> -->
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label">Tarif Tindakan </label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" name="tarif_tindakan" placeholder="Tarif Tindakan">
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
</div>
    <script>
        // function deleteConfirm(url) {
        //     $('#btn-delete').attr('href', url);
        //     $('#deleteModal').modal();
        // }
    </script>
    <!--**********************************
            Content body end
        ***********************************-->
    @include('template.footer')