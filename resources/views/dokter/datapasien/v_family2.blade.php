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
                                <th class="text-center">No.</th>
                                <th>Nama KK </th>
                                <th>Alamat</th>
                                <th>Desa</th>
                                <th>Kecamatan</th>
                                <th>Kabupaten</th>
                                <th>Nomor Index</th>
                                <th>Action</th>
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
                                    <td>{{$a->nama_kk}}</td>
                                    <td>{{$a->alamat}}</td>
                                    <td>{{$a->desa}}</td>
                                    <td>{{$a->kecamatan}}</td>
                                    <td>{{$a->kabupaten}}</td>
                                    <td>{{$a->no_index}}</td>
                                    <td><span>
                                            <button type="button" class="btn btn-secondary text-white" onclick="location.href='/datarekammedisdokter/viewdatapasien/{{$a->no_index}}'" data-toggle="tooltip" data-placement="top" title="Buka">
                                                <i class="fa fa-folder"></i>
                                            </button>
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                    <!-- <div class="card-footer">
                        <div class="rounded-button">
                            <button type="button" onclick="location.href='/datapasienrm/viewaddfamily'" class="btn mb-1 btn-rounded btn-primary float-right">Tambah Data</button>
                        </div>
                    </div> -->
                </div>
            </div>

        </div>
        <!-- #/ container -->
    </div>

@include('template.footer')
