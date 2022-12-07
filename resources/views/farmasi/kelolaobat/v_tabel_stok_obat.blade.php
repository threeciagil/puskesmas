@include('farmasi.templatefarmasi.v_header')
@include('farmasi.templatefarmasi.v_sidebar_farmasi')


<div class="row page-titles mx-0">
    <div class="col p-md-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Stok Obat</a></li>
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
                                    <!-- <th>ID Obat</th> -->
                                    <th>Nama Obat</th>
                                    <th>Jumlah Penerimaan</th>
                                    <th>Stok Obat</th>
                                    <th>Tanggal Masuk Obat</th>
                                    <th>Tanggal Kadaluarsa</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                @foreach($data as $datas)
                                <tr>
                                    <?php 
                                    $masuk = date("d-m-Y", strtotime($datas->tanggal_masuk));
                                    $kadaluarsa=date("d-m-Y", strtotime($datas->tanggal_kadaluarsa)); 
                                    ?>
                                    <td class=" text-center">{{$no}}</td>
                                    <!-- <td class=" text-center">//{//{$datas->id}}</td> -->
                                    <!-- <td class=" text-center">//{//{$datas->id_obat}}</td> -->
                                    <td>{{$datas->nama_obat}}</td>
                                    <td>{{$datas->jumlah_penerimaan}}</td>
                                    <td>{{$datas->sisa}}</td>
                                    <td>{{$masuk}}</td>
                                    <td>{{$kadaluarsa}}</td>
                                    <td>
                                        <span>
                                            <a type="button" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus obat ini?')" href="/tabelobat/hapusstokobat/{{$datas->id}}" data-toggle="tooltip" data-placement="top" title="Hapus">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </span>
                                    </td>
                                </tr>
                                <?php $no++; ?>
                                @endforeach
                            </tbody>
                            <!-- <tfoot>
                                <tr>
                                    <th class="text-center">No.</th>
                                    <th>ID Obat</th>
                                    <th>Nama Obat</th>
                                    <th>Jenis Obat</th>
                                    <th>Stok Obat</th>
                                    <th>Tanggal Masuk Obat</th>
                                    <th>Tanggal Kadaluarsa</th>
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
                <h5 class="modal-title">Tambah Stok Obat</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <form class="form-horizontal" enctype="multipart/form-data" method="post" action="/tabelobat/tambahstokobat">
                @csrf
                <div class="modal-body">
                    <!-- Modal body text goes here. -->
                     <div class="form-group row">
                        <label class="col-lg-4 col-form-label">Nama Obat</label>
                        <div class="col-lg-6">
                            <select class="form-control" id="id_obat" name="id_obat" required autofocuse>
                                @foreach($dataobat as $dataobats)
                                <option value="{{$dataobats->id_obat}}">{{$dataobats->nama_obat}}</option>
                                 @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-4 col-form-label">Jumlah Obat</label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" name="stok_obat" placeholder="Stok Obat" required autofocuse>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-4 col-form-label">Tanggal Kadaluarsa</label>
                        <div class="col-lg-6">
                            <input type="date" class="form-control" name="tanggal_kadaluarsa" placeholder="Tanggal Kadaluarsa" required autofocuse>
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