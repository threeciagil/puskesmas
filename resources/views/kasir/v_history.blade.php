@include('template.header')
@include('kasir.template.sidebar')

<div class="row page-titles mx-0">
    <div class="col p-md-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active"><a href="javascript:void(0)"></a>Data Pasien</li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Data Riwayat Pembayaran</a></li>
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
                                    <th>Jenis tindakan</th>
                                    <th>Harga</th>
                                    <th>Jenis Pelayanan Lab</th>
                                    <th>Harga</th>
                                    <!-- <th>Total Harga</th> -->
                                    <th>Asuransi</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                @foreach($antrian as $antri)
                                <tr>
                                    <?php 
                                    $hari = date("d-m-Y", strtotime($antri->tanggal));
                                    ?>
                                    <td class=" text-center">{{$no}}</td>
                                    <td class=" text-center">{{$antri->no_antrian}}</td>
                                    <td class=" text-center">{{$hari}}</td>
                                    <td class=" text-center">{{$antri->nama}}</td>
                                    <td class=" text-center">{{$antri->jenis_kelamin}}</td>
                                    <td class=" text-center">{{$antri->no_rm}}</td>
                                    <td>
                                        @foreach($tindakan as $tindakans)
                                            @if($tindakans->no_rm == $antri->no_rm && substr($tindakans->waktu_tindakan,0,10) == $antri->tanggal )
                                                {{$tindakans->nama_tindakan.','}}
                                            @endif
                                        @endforeach    
                                    </td>
                                    <td>
                                        @foreach($tindakan as $tindakans)
                                            @if($tindakans->no_rm == $antri->no_rm  )
                                                {{$tindakans->tarif.','}}
                                            @endif
                                        @endforeach    
                                    </td>
                                    <td>
                                        @foreach($pelayanan as $layanan)
                                            @if($layanan->id_pemeriksaan == $antri->id_pemeriksaan  )
                                                {{$layanan->nama.','}}
                                            @endif
                                        @endforeach    
                                    </td>
                                    <td>
                                        @foreach($pelayanan as $layanan)
                                            @if($layanan->id_pemeriksaan == $antri->id_pemeriksaan  )
                                                {{$layanan->tarif.','}}
                                            @endif
                                        @endforeach    
                                    </td>
                                    <!-- <td> -->
                                        <?php
                                        // foreach($pelayanan as $layanan){
                                        //     $tarif = 0;
                                        //     $tariflayanan=0;
                                        //     $tariftindakan=0; 
                                        //     $tariflayanan+=$layanan->tarif;
                                        //     foreach($tindakan as $tindakans){
                                                
                                        //         if($layanan->id_pemeriksaan == $antri->id_pemeriksaan && $tindakans->no_rm == $antri->no_rm ){ 
                                        //             $tariftindakan+=$tindakans->tarif;
                                        //             echo ($tariftindakan+=$tariflayanan);
                                        //         }
                                               
                                        //     }
                                        // }
                                        // echo ($tarif);
                                        ?>
                                    <!-- </td> -->
                                    <td class=" text-center">{{$antri->jenis_asuransi}}</td>
                                    <td class=" text-center">{{$antri->status}}</td>
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