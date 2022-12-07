@include('template.header')
@include('dokter.templatedokter.v_sidebar')

<div class="row page-titles mx-0">
    <div class="col p-md-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Data Pasien</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Family Folder</a></li>
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
                                <th>Nomor Index</th>
                                <th>Nomor Rekam Medis</th>
                                <th>Nama Lengkap</th>
                                <th>Jenis Kelamin</th>
                                <th>Alamat</th>
                                <th>Asuransi</th>
                                <th class="justify-center" style="width: 150px">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $no = 0;
                            @endphp
                            @foreach($pasien as $a)
                                @php
                                    $no++;
                                @endphp
                                <tr>
                                    <td class="text-center" style="width: 1px;">{{$no}}</td>
                                    <td>{{$a->no_index}}</td>
                                    <td>{{$a->no_rm}}</td>
                                    <td>{{$a->nama}}</td>
                                    <td>{{$a->jenis_kelamin}}</td>
                                    <td>{{$a->alamat}}</td>
                                    <td>{{$a->jenis_asuransi}}</td>
                                    <td class="justify-center" style="width: 150px">
                                    <span>
                                            <button type="button" class="btn btn-secondary text-white" onclick="location.href='/datarekammedisdokter/viewdatapasien/rm/{{$a->no_rm}}'" data-toggle="tooltip" data-placement="top" title="Buka">
                                                <i class="fa fa-folder"></i>
                                            </button>
                                    </span>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <!-- <div class="card-footer">
                            <div class="rounded-button">
                                <button type="button" onclick="location.href='/datapasienrm/viewaddpasien/{{ Request::segment(3) }}'" class="btn mb-1 btn-rounded btn-primary float-right">Tambah Data</button>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- #/ container -->
</div>
<!--**********************************
            Content body end
        ***********************************-->
@include('template.footer')
