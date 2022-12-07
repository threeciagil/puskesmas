@include('template.header')
@include('kasir.template.sidebar')


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
                                    <th>Jenis Kunjungan Dalam 1 Tahun(baru/lama)</th>
                                    <th>Pekerjaan</th>
                                    <th>Jenis Asuransi</th> 
                                    <th>Poli Asal</th>
                                    <th>Jenis Tindakan</th>
                                    <th>Harga</th>
                                    <th>Jenis Pelayanan Lab</th>
                                    <th>Harga</th>
                                    <th>Total Harga</th>


                                    <!-- <th>Jam Datang</th>
                                    <th>Jam Selesai</th>
                                    <th>Jumlah Waktu</th> -->
                                </tr>
                            </thead>
                            <tbody>
                            <?php $no=1; ?>
                                @foreach($data as $datas)
                                <tr>
                                    <?php 
                                      $tanggal=date("d-m-Y", strtotime($datas->tanggal)); 
                                      ?>
                                            <td class=" text-center">{{$no}}</td>
                                            <td>{{$tanggal}}</td>
                                            <td>{{$datas->poli_asal}}</td>
                                            <td>{{$datas->nama}}</td>
                                            <td>{{$datas->no_rm}}</td>
                                            <td>{{$datas->nama_kk}}</td>
                                            <td>{{$datas->alamat}}</td>
                                            <td>{{$datas->jenis_kelamin}}</td>
                                            <td>{{$datas->umur}}</td>
                                            <td>
                                                @foreach($pendaftaran as $pendaftarans)
                                                    @if($pendaftarans->no_rm == $datas->no_rm && $pendaftarans->tanggal == $datas->tanggal )
                                                        {{$pendaftarans->tipe_kunjungan}}
                                                    @endif
                                                @endforeach        
                                            </td>
                                            <td>{{$datas->pekerjaan}}</td>
                                            <td>{{$datas->jenis_asuransi}}</td>
                                            <td>{{$datas->poli_asal}}</td>
                                            <td>
                                                @foreach($tindakan as $tindakans)
                                                    @if($tindakans->no_rm == $datas->no_rm  )
                                                        {{$tindakans->nama_tindakan.','}}
                                                    @endif
                                                @endforeach   
                                            </td>
                                            <td>
                                                @foreach($tindakan as $tindakans)
                                                    @if($tindakans->no_rm == $datas->no_rm  )
                                                        {{$tindakans->tarif.','}}
                                                    @endif
                                                @endforeach   
                                            </td>
                                            <td>
                                                @foreach($pelayanan as $layanan)
                                                    @if($layanan->id_pemeriksaan == $datas->id_pemeriksaan  )
                                                        {{$layanan->nama.','}}
                                                    @endif
                                                @endforeach    
                                            </td>
                                            <td>
                                                @foreach($pelayanan as $layanan)
                                                    @if($layanan->id_pemeriksaan == $datas->id_pemeriksaan  )
                                                        {{$layanan->tarif.','}}
                                                    @endif
                                                @endforeach    
                                            </td>
                                            <td>
                                                @foreach($kasir as $kasirs)
                                                    @if($kasirs->id_pemeriksaan == $datas->id_pemeriksaan  )
                                                        {{$kasirs->total_pembayaran}}
                                                    @endif
                                                @endforeach   
                                            </td>
                                            
                                </tr>
                                <?php $no++; ?>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <div class="rounded-button">
                        <button type="button" class="btn mb-1 btn-rounded btn-success float-right" data-href='/kasir/printlaporan' id="export" onclick="exportTasks(event.target);">Export to ecxel</
                       
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