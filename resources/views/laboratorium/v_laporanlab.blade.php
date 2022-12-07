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
                                    <th class="text-center">No.</th>
                                    <th>Tanggal</th>
                                    <th>Poli Asal</th>
                                    <th>Nama Pasien</th>
                                    <th>Nomor Rekam Medis</th>
                                    <th>Nama Kepala Keluarga</th>
                                    <th>Alamat</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Umur</th>
                                    <th>Jenis Asuransi</th>
                                    <th>Jenis Kunjungan Dalam 1 Tahun(baru/lama)</th>
                                    <th>Poli Asal</th>
                                    <th>Nama Jenis Lab</th>
                                    <th>Jenis Permintaan Lab</th>
                                    <th>Nama Pemeriksaan Lab</th>
                                    <th>Penanggung Jawab</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no=1 ?>
                                @foreach($data as $datas)
                                <tr>
                                    <?php 
                                    $tanggal = date("d-m-Y", strtotime($datas->tanggal));
                                    // $kadaluarsa=date("d-m-Y", strtotime($datas->tanggal_kadaluarsa)); 
                                    ?>
                                    <td class=" text-center">{{$no}}</td>
                                    <td class=" text-center">{{$tanggal}}</td>
                                    <td>{{$datas->poli_asal}}</td>
                                    <td>{{$datas->nama}}</td>
                                    <td>{{$datas->no_rm}}</td>
                                    <td>{{$datas->nama_kk}}</td>
                                    <td>{{$datas->alamat}}</td>
                                    <td>{{$datas->jenis_kelamin}}</td>
                                    <td>{{$datas->umur}}</td>
                                    <td>{{$datas->jenis_asuransi}}</td>
                                    <td>
                                        @foreach($kunjungan as $k)
                                            @if($k->no_rm == $datas->no_rm && $k->tanggal == $datas->tanggal )
                                                {{$k->tipe_kunjungan}}
                                            @endif
                                        @endforeach    
                                    </td>
                                    <td>{{$datas->poli_asal}}</td>
                                    <td>
                                        <?php
                                            for($i=0;$i<count($datas->jenislab);$i++){
                                                if($i!=0){
                                                    if($datas->jenislab[$i]!=$datas->jenislab[$i-1])
                                                    echo ("-".$datas->jenislab[$i]."\n") ;
                                                }else{
                                                    echo ("-".$datas->jenislab[$i]."\n") ;
                                                }
                                            }
                                        ?>
                                    </td>
                                    <td>                                        
                                        <?php
                                            for($i=0;$i<count($datas->permintaan);$i++){
                                                if($i!=0){
                                                    if($datas->permintaan[$i]!=$datas->permintaan[$i-1])
                                                    echo ("-".$datas->permintaan[$i]."\n") ;
                                                }else{
                                                    echo ("-".$datas->permintaan[$i]."\n") ;
                                                }
                                            }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                            for($i=0;$i<count($datas->namalab);$i++){
                                                if($i!=0){
                                                    if($datas->namalab[$i]!=$datas->namalab[$i-1])
                                                    echo ("-".$datas->namalab[$i]."\n") ;
                                                }else{
                                                    echo ("-".$datas->namalab[$i]."\n") ;
                                                }
                                            }
                                        ?>
                                    </td>
                                    <td>{{$datas->dokter_penanggung_jawab}}</td>
                                    
                                    <!-- <td></td> -->
                                                                             
                                </tr>
                                <?php $no++;?>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <div class="rounded-button">
                            <button type="button" class="btn mb-1 btn-rounded btn-success float-right"data-href='/laborat/print' id="export" onclick="exportTasks(event.target);">Export to ecxel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #/ container -->
    </div>
</div>


<script>
   function exportTasks(_this) {
      let _url = $(_this).data('href');
      window.location.href = _url;
   }
</script>
<!--**********************************
            Content body end
        ***********************************-->
@include('template.footer')