@include('template.header')
@include('perawat.template.sidebar')

<div class="row page-titles mx-0">
    <div class="col p-md-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active"><a href="javascript:void(0)"></a>Data Pasien</li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Data Riwayat Pendaftaran Poli Umum</a></li>
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
                                    <th class="text-center">Nomor Antrian</th>
                                    <th>Tanggal </th>
                                    <th>Nama </th>
                                    <th>Jenis Kelamin</th>
                                    <th>Nomor Rekam Medis</th>
                                    <th>Asuransi</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $a= 1;
                                @endphp
                                @foreach($history as $histories)
                                <!-- $a=1; -->
                                <tr>
                                    <?php 
                                    $hari = date("d-m-Y H:i:s", strtotime($histories->waktu));
                                    ?>
                                    <td class=" text-center"> {{$a}}</td>
                                    <td class=" text-center"> {{$histories->no_antrian}} </td>
                                    <td class=" text-center"> {{$histories->waktu}} </td>
                                    <td class=" text-center"> {{$histories->nama}} </td>
                                    <td class=" text-center"> {{$histories->jenis_kelamin}} </td>
                                    <td class=" text-center"> {{$histories->no_rm}} </td>
                                    <td class=" text-center"> {{$histories->jenis_asuransi}} </td>
                                    <td class=" text-center"> {{$histories->status}}</td>
                                </tr>
                                @php
                                $a++;
                                @endphp
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- #/ container -->
    </div>
</div>
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