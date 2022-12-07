@include('template.header')
@include('admin.template.sidebar')
<div class="row page-titles mx-0">
    <div class="col p-md-0">
        <ol class="breadcrumb">
             <li class="breadcrumb-item"><a href="javascript:void(0)">Data</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Pengguna</a></li>
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
                                    <th>Nama</th>
                                    <th>Username</th>
                                    <th>Role</th>
                                    <th>Email</th>
                                    <th>No. HP</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $no = 1; ?>
                                @foreach($pengguna as $penggunas)
                                <tr>
                                    <td class=" text-center">{{$no}} </td>
                                    <td>{{$penggunas->full_name}} </td>
                                    <td>{{$penggunas->username}}</td>
                                    <td>{{$penggunas->role}}</td>
                                    <td>{{$penggunas->email}} </td>
                                    <td>{{$penggunas->no_hp}}</td>
                                    <!-- <td>
                                        <//?//php 
                                            if($penggunas->is_active = 1){
                                                echo("Aktif");
                                            }else{
                                                echo ("Tidak Aktif");
                                            }
                                        ?>
                                    </td> -->
                                    <td><span>
                                        <a class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus obat ini?')" href="/admin/hapuspengguna/{{$penggunas->id}}" data-toggle="tooltip" data-placement="top" title="Hapus" >
                                                Hapus
                                        </a>
                                    </span>
                                    <!-- <button type="button" class="btn btn-danger"  data-toggle="tooltip" data-placement="top" title="Hapus" onclick="return confirm('Yakin ingin menghapus obat ini?')" href="'/admin/hapuspengguna/{{$penggunas->id}}'">
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
                    <h5 class="modal-title">Tambah Pengguna</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <form class="form-horizontal" enctype="multipart/form-data" method="post" action="/admin/savepengguna">
                @csrf
                <div class="modal-body">
                    <!-- Modal body text goes here. -->
                    <div class="form-group row">
                        <label class="col-lg-4 col-form-label">Nama</label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" name="nama" placeholder="Nama Pengguna">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-4 col-form-label">Username</label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" name="username" placeholder="Username">
                        </div>
                    </div>
                     <div class="form-group row">
                            <label class="col-lg-4 col-form-label">Role</label>
                               <div class="col-lg-6">
                                    <select class="form-control" id="role_id" name="role_id">
                                        <option readonly>Please select</option>
                                        @foreach($role as $roles)
                                            <option value="{{$roles->role_id}}">{{$roles->role}}</option>
                                        @endforeach
                                    </select>       
                               <!-- <select id="inputState" name="role_id" class="form-control" required autofocuse>
                                        <option selected="selected">Choose...</option>
                                            <option value=""></option>
                                    </select> -->
                                </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-4 col-form-label">Email</label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" name="email" placeholder="Email">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-4 col-form-label">No. HP</label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" name="no_hp" placeholder="Nomor HP">
                        </div>
                    </div>
                   <div class="form-group row">
                        <label class="col-lg-4 col-form-label">Password</label>
                        <div class="col-lg-6">
                            <input type="password" class="form-control" name="password" placeholder="Masukkan Password">
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