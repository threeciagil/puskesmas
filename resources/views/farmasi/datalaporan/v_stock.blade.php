@include('template.header')
@include('farmasi.templatefarmasi.v_sidebar_farmasi')


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
                                    <th>Nama Obat</th>
                                    <th>Satuan</th>
                                    <th>Tanggal</th>
                                    <th>Expaired Date</th>
                                    <th>Jumlah Masuk</th>
                                    <th>Jumlah Keluar</th>
                                    <th>Sisa</th>
                                    <th>Keterangan</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no=1; ?>
                                @foreach($dataobats as $datas)
                                <tr>
                                    <?php 
                                    $masuk = date("d-m-Y", strtotime($datas->tanggal_masuk));
                                    $kadaluarsa=date("d-m-Y", strtotime($datas->tanggal_kadaluarsa)); 
                                    ?>
                                    <td class=" text-center">{{$no}}</td>
                                    <td>{{$datas->nama_obat}}</td>
                                    <td>{{$datas->satuan}}</td>
                                    <td>{{$masuk}}</td>
                                    <td>{{$kadaluarsa}}</td>
                                    <td>{{$datas->jumlah_penerimaan}}</td>
                                    <td>{{$datas->pemakaian}}</td>
                                    <td>{{$datas->sisa}}</td>
                                    <td><?php if($datas->sisa==0){?> 
                                        <?php 
                                                echo("Habis");
                                            } else{
                                                echo("Tersedia");
                                            }
                                        ?>
                                    </td>       
                                </tr>
                                <?php $no++; ?>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <div class="rounded-button">
                        <button type="button" class="btn mb-1 btn-rounded btn-success float-right" data-href='/farmasi/printstock' id="export" onclick="exportTasks(event.target);">Export to ecxel</button>
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