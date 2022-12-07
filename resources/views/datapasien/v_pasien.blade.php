@include('template.header')
@include('pendaftaran.template.sidebar')

<div class="row page-titles mx-0">
    <div class="col p-md-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Data Pasien</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Data Pasien</a></li>
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
                                <th class="text-center" style="width: 10px">Nomor Index</th>
                                <th class="text-center" style="width: 10px">Nomor Rekam Medis</th>
                                <th class="text-center" style="width: 10px">Nama Lengkap</th>
                                <th class="text-center" style="width: 10px">Jenis Kelamin</th>
                                <th class="text-center" style="width: 10px">Alamat</th>
                                <th class="text-center" style="width: 10px">Asuransi</th>
                                <th class="text-center" style="width: 150px">Action</th>
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
                                    <td class="text-center" style="width: 10px">{{$a->no_index}}</td>
                                    <td class="text-center" style="width: 10px">{{$a->no_rm}}</td>
                                    <td class="text-center" style="width: 10px">{{$a->nama}}</td>
                                    <td class="text-center" style="width: 10px">{{$a->jenis_kelamin}}</td>
                                    <td class="text-center" style="width: 10px">{{$a->alamat}}</td>
                                    <td class="text-center" style="width: 10px">{{$a->jenis_asuransi}}</td>
                                    <td class="text-center" style="width: 150px">
                                    <span>
                                            <button type="button" class="btn btn-secondary text-white" onclick="location.href='/datarekammedis/editdatapasien/{{$a->no_rm}}'" data-toggle="tooltip" data-placement="top" title="edit">
                                                <i class="fa fa-pencil"></i>
                                            </button>
                                    </span>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="card-footer">
                            <div class="rounded-button">
                                <button type="button" onclick="location.href='/datapasienrm/viewaddpasien/{{ Request::segment(3) }}'" class="btn mb-1 btn-rounded btn-primary float-right">Tambah Data</button>
                            </div>
                        </div>
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
