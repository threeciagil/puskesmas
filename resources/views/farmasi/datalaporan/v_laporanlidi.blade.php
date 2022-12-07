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
                                    <th>Tanggal</th>
                                    <th>Poli Asal</th>
                                    <th>Nama Pasien</th>
                                    <th>Nomor Rekam Medis</th>
                                    <th>Nama Kepala Keluarga</th>
                                    <th>Alamat</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Umur</th>
                                    <th>nama obat</th>
                                    <th>total</th>
                                    <th>Jenis Asuransi</th>
                                    <th>Waktu Pelayanan</th>
                                    <!-- <th>Jam Datang</th>
                                    <th>Jam Selesai</th>
                                    <th>Jumlah Waktu</th> -->
                                    <th>Jenis Kunjungan Dalam 1 Tahun(baru/lama)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no=1; ?>
                                @foreach($data as $datas)
                                <tr>
                                    <?php 
                                    $hari = date("d-m-Y", strtotime($datas->tanggal));
                                    $jam=date("H:i:s", strtotime($datas->waktu_pelayanan)); 
                                    ?>
                                    <td class=" text-center">{{$no}}</td>
                                    <td>{{$hari}}</td>
                                    <td>{{$datas->poli_yang_dituju }}</td>
                                    <td>{{$datas->nama}}</td>
                                    <td>{{$datas->no_rm}}</td>
                                    <td>{{$datas->nama_kk}}</td>
                                    <td>{{$datas->alamat}}</td>
                                    <td>{{$datas->jenis_kelamin}}</td>
                                    <td>{{$datas->umur}}</td>
                                    <td>
                                        @foreach($obat as $obats)
                                            @if($datas->id_pemeriksaan == $obats->id_pemeriksaan  )
                                                {{$obats->nama_obat.','}}
                                            @endif
                                        @endforeach 
                                    </td>
                                    <td>
                                        @foreach($obat as $obats)
                                            @if($datas->id_pemeriksaan == $obats->id_pemeriksaan  )
                                                {{$obats->jumlah.','}}
                                            @endif
                                        @endforeach 
                                    </td>
                                    <td>{{$datas->jenis_asuransi}}</td>
                                    <td>{{$jam}}</td>
                                    <td>{{$datas->tipe_kunjungan}}</td>
                                </tr>
                                <?php $no++; ?>
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
                    <div class="card-footer">
                        <div class="rounded-button">
                            <button type="button" class="btn mb-1 btn-rounded btn-success float-right" data-href='/farmasi/printlidi' id="export" onclick="exportTasks(event.target);">Export to ecxel</button>    
                            <!-- <button type="button" class="btn mb-1 btn-rounded btn-success float-right">Export to ecxel</button> -->
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