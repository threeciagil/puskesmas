@include('template.header')
@include('perawat.template.sidebar')

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
                                <td class="text-center" style="width: 150px">
                                <span>
                                    <button type="button" onclick="location.href='/datarekammedisperawat/perawatrmdatapasien/perawatrm/{{$a->no_rm}}'" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Layani">
                                        Data Rekam Medis
                                        </button>
                                    </span><br><br>
                                    <button type="button" onclick="location.href='/datarekammedisperawat/perawatrmdatapasien/perawataskep/{{$a->no_rm}}'" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Layani">
                                        Data Asuhan Keperawatan
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
<!--**********************************
            Content body end
        ***********************************-->
        <script type="text/javascript">
    window.Echo.channel('PanggilanPerawatChannel')
    .listen('.PanggilanMessage', function (e) {
        if (typeof e !== 'undefined') {
            console.log(e[0].panggil_perawat);
            alert(e[0].panggil_perawat);
        }else{
            console.log("foo");
        }
        // document.getElementById("message").innerHTML = e.message.nama_poli;
    })
</script>
@include('template.footer')
