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
                                <th>Nama Pemeriksaan</th>
                                <th>Nilai Normal</th>
                                <th>Satuan</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                @foreach($data as $datas)
                                <tr>
                                    <td class="text-center" style="width: 1px;">{{$no}} </td>
                                    <td> {{$datas->nama_pemeriksaan}}</td>
                                    <td> {{$datas->nilai_normal}}</td>
                                    <!-- <td> //{//{$datas->tarif_pemeriksaan//}}</td> -->
                                    <td> {{$datas->satuan}}</td>
                                    <td class="text-center">
                                        <span>
                                            <a class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus obat ini?')" href="/laborat/deletedataujilab/{{$jenis[0]->id_jenis_pemeriksaan}}/{{$datas->id_nama_pemeriksaan}}" data-toggle="tooltip" data-placement="top" title="Hapus" >
                                               Hapus
                                            </a>
                                            <!-- <button type="button" class="btn btn-danger" data-toggle="modal" onclick="location.href='/laborat/deletedataujilab/{{$jenis[0]->id_jenis_pemeriksaan}}/{{$datas->id_nama_pemeriksaan}}'" data-toggle="tooltip" data-placement="top" title="Hapus">
                                                <i class="fa fa-trash"></i>
                                            </button> -->
                                        </span>
                                        
                                    </td>
                                </tr>
                                <?php $no++; ?>
                                @endforeach
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

                <h5 class="modal-title">Tambah Jenis Pemeriksaan Lab</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <form class="form-horizontal" enctype="multipart/form-data" method="post" action="/savejenispelayananlab">
                @csrf
                <div class="modal-body">
                    
                    <input type="hidden" name="id_jenis" class="form-control" value="{{$jenis[0]->id_jenis_pemeriksaan}}">
                    <div class="form-group row">
                        <label class="col-lg-4 col-form-label">Nama Jenis Pemeriksaan Lab</label>
                        <div class="col-lg-6">
                            <input readonly type="text" name="jenis_lab" class="form-control" value="{{$jenis[0]->jenis_pemeriksaan}}" placeholder="Jenis Pemeriksaan Lab" required autofocuse>
                    </div>
                    </div>
                    <div class="form-group row">
                        
                        <label class="col-lg-4 col-form-label">Nama Pemeriksaan</label>
                        <div class="col-lg-6">
                            <input type="text" name="jenis_pemeriksaan" id="jenis_pemeriksaan" class="form-control" placeholder="Nama Jenis Pemeriksaan" required autofocuse>
                        </div>
                    </div>
                    <div class="form-group row">
                        
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

<!-- <div class="modal" id="hapus" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            
            
                <div class="modal-body">
     
                        <label>Anda yakin ingin menghapus data ini?</label>

                </div>
                <div class="modal-footer">
                    </br>
               
                    <input type="hidden">
                    <button class="btn btn-default btn-sm" data-dismiss="modal" aria-hidden="true">Batal</button>
                    <button class="btn btn-danger btn-sm" >Hapus</button>
         
                </div>
     
        </div>
    </div>
</div> -->

@include('template.footer')
