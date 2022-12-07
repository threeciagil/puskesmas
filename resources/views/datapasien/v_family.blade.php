@include('template.header')
@include('pendaftaran.template.sidebar')

<div class="row page-titles mx-0">
    <div class="col p-md-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Family Folder</a></li>
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
                                <th class="text-center" style="width: 10px">Nama KK </th>
                                <th class="text-center" style="width: 10px"> Alamat</th>
                                <th class="text-center" style="width: 10px">Desa</th>
                                <th class="text-center" style="width: 10px">Kecamatan</th>
                                <th class="text-center" style="width: 10px">Kabupaten</th>
                                <th class="text-center" style="width: 10px">Nomor Index</th>
                                <th class="text-center" style="width: 300px">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $no=0;
                            @endphp
                            @foreach($family as $a)
                                @php
                                    $no++;
                                @endphp
                                <tr>
                                    <td class="text-center" style="width: 1px;">{{$no}}</td>
                                    <td style="width: 10px">{{$a->nama_kk}}</td>
                                    <td style="width: 10px">{{$a->alamat}}</td>
                                    <td style="width: 10px">{{$a->desa}}</td>
                                    <td style="width: 10px">{{$a->kecamatan}}</td>
                                    <td style="width: 10px">{{$a->kabupaten}}</td>
                                    <td style="width: 10px">{{$a->no_index}}</td>
                                    <td class="text-center" style="width: 300px"><span>
                                            <button type="button" class="btn btn-secondary text-white" onclick="location.href='/datapasienrm/viewdatapasien/{{$a->no_index}}'" data-toggle="tooltip" data-placement="top" title="Buka">
                                                <i class="fa fa-user"></i>
                                            </button>
                                        </span>
                                        <span>
                                            <button type="button" class="btn btn-secondary text-white" onclick="location.href='/datapasienrm/vieweditfamily/{{$a->no_index}}'" data-toggle="tooltip" data-placement="top" title="Edit">
                                                <i class="fa fa-pencil"></i>
                                            </button>
                                        </span>
                                        <span>                    
                                        <button type="button" class="btn btn-secondary text-white" onclick="location.href='{{$a->foto_KK}}'" data-toggle="tooltip" data-placement="top" title="Lihat KK">
                                            <i class="fa fa-folder"></i>
                                        </button> 
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <div class="rounded-button">
                            <button type="button" onclick="location.href='/datapasienrm/viewaddfamily'" class="btn mb-1 btn-rounded btn-primary float-right">Tambah Data</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- #/ container -->
    </div>

@include('template.footer')
