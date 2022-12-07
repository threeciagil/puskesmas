@include('template.header')
@include('laboratorium.template.sidebar')


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
                                    <th class=" text-center">Tanggal</th>
                                    <th class="text-center">Nomor Antrian</th>
                                    <th class=" text-center">Nama </th>
                                    <th class=" text-center">Jenis Kelamin</th>
                                    <th class=" text-center">Jenis Pelayanan Lab</th>
                                    <th class=" text-center">Nomor Rekam Medis</th>
                                    <th class=" text-center">Asuransi</th>
                                    <th class=" text-center">Poli Asal</th>
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
                                    <td class=" text-center">{{$datas->nama}}</td>
                                    <td class=" text-center">{{$datas->jenis_kelamin}}</td>
                                    <td class=" text-center">
                                        <?php
                                            for($i=0;$i<count($rekammedis);$i++){
                                                if($datas->no_rm == $rekammedis[$i][1] && $datas->id_pemeriksaan == $rekammedis[$i][2]){
                                                    echo ("-".$rekammedis[$i][0]."\n") ;
                                                }
                                            }
                                        ?>
                                    </td>
                                    <td class=" text-center">{{$datas->no_rm}}</td>  
                                    <td class=" text-center">{{$datas->jenis_asuransi}}</td>
                                    <td class=" text-center">{{$datas->poli_asal}}</td>
                                    <td class=" text-center">{{$datas->status}}</td>
                                </tr>
                                <?php $no++ ?>
                                @endforeach
                            </tbody>
                            <!-- <tfoot>
                                <tr>
                                    <th class="text-center">No.</th>
                                    <th>ID Obat</th>
                                    <th>Nama Obat</th>
                                    <th>Jenis Obat</th>
                                    <th>Stok Obat</th>
                                    <th>Tanggal Masuk Obat</th>
                                    <th>Tanggal Kadaluarsa</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot> -->
                        </table>
                    </div>
                    <!-- <div class="card-footer">
                        <div class="rounded-button">
                            <button type="button" class="btn mb-1 btn-rounded btn-primary float-right">Print
                    </div> -->
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