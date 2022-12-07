@include('template.header')
@include('farmasi.templatefarmasi.v_sidebar_farmasi')

<div class="row page-titles mx-0">
    <div class="col p-md-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active"><a href="javascript:void(0)"></a>Data Pasien</li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Data Riwayat Farmasi</a></li>
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
                                    <th class=" text-center">Tanggal</th>
                                    <th class="text-center">Nomor Antrian</th>
                                    <th class=" text-center">Nomor Rekam Medis</th>
                                    <th class=" text-center">Nama </th>
                                    <th class=" text-center">Jenis Kelamin</th>
                                    <th class=" text-center">Nama Obat</th>
                                    <th class=" text-center">Poli Asal</th>
                                    <th class=" text-center">Asuransi</th>
                                    <th class=" text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                @foreach($data as $datas)
                                <tr>
                                    <?php 
                                    $hari = date("d-m-Y", strtotime($datas->tanggal));
                                    ?>
                                    <td class=" text-center">{{$no}}</td>
                                    <td class=" text-center">{{$hari}}</td>
                                    <td class=" text-center">{{$datas->no_antrian}}</td>
                                    <td class=" text-center">{{$datas->no_rm}}</td>
                                    <td class=" text-center">{{$datas->nama}}</td>
                                    <td class=" text-center">{{$datas->jenis_kelamin}}</td>
                                    <td class=" ">
                                        <?php
                                            for($i=0;$i<count($datas->obat);$i++){
                                                echo($datas->obat[$i].', <br> ');
                                            }
                                        ?>
                                    </td> 
                                    <td class=" text-center">{{$datas->poli_asal}}</td> 
                                    <td class=" text-center">{{$datas->jenis_asuransi}}</td>
                                    <td class=" text-center">{{$datas->status}}</td>
                                </tr>
                                <?php $no++ ?>
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