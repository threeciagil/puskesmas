@include('template.header')
@include('perawat.template.sidebar')


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
                                    <th>Jenis Asuransi</th>
                                    <th>Pekerjaan</th>
                                    <th>Anamnesa</th>
                                    <th>Pemeriksaan</th>
                                    <th>Jenis Pemeriksaan Laborat</th>
                                    <th>Diagnosa</th>
                                    <th>Jenis Tindakan</th>
                                    <th>Penyuluhan</th>
                                    <th>Resep Obat</th>
                                    <th>Waktu Pemeriksaan</th>
                                    <th>Penanggung Jawab</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no=1;?>
                                @foreach($data as $datas)
                                <tr>
                                            <td class=" text-center">{{$no}}</td>
                                            <td>{{$datas->created_at}}</td>
                                            <td>{{$datas->poli_asal}}</td>
                                            <td>{{$datas->nama}}</td>
                                            <td>{{$datas->no_rm}}</td>
                                            <td>{{$datas->nama_kk}}</td>
                                            <td>{{$datas->alamat}}</td>
                                            <td>{{$datas->jenis_kelamin}}</td>
                                            <td>{{$datas->umur}}</td>
                                            <td>@foreach($kunjungan as $k)
                                                    @if($k->no_rm == $datas->no_rm)
                                                        {{$k->tipe_kunjungan}} 
                                                    @endif
                                                @endforeach</td>
                                            <td>{{$datas->jenis_asuransi}}</td>
                                            <td>{{$datas->pekerjaan}}</td>
                                            <td>RPS: {{$datas->arps}} | RPK: {{$datas->arpk}} | RPD: {{$datas->arpd}}</td>
                                            <td>TB: {{$datas->tb}} | BB: {{$datas->bb}} | IMT: {{$datas->imt}} | RR: {{$datas->rr}} | Sistol: {{$datas->sistol}} | Diastol: {{$datas->diastol}}</td>
                                            <td>@foreach($pemeriksaan as $p)
                                                    @if($p->id_pemeriksaan == $datas->id_pemeriksaan)
                                                        {{$p->nama}}<br>
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td>
                                                @foreach($diagnosa as $d)
                                                    @if($d->id_pemeriksaan == $datas->id_pemeriksaan)
                                                        {{$d->nama_diagnosa}}<br>
                                                    @endif
                                                @endforeach    
                                            </td>
                                            <td>{{$datas->tindakan}}</td>
                                            <td>{{$datas->isi_penyuluhan}}</td>
                                            <td> 
                                                @foreach($dataobat as $do)
                                                    @if($do->id_pemeriksaan == $datas->id_pemeriksaan)
                                                    <b> Jenis Resep :</b> {{$do->jenis_resep}} || <b>Signa Obat:</b> {{$do->signa}} || <b>Aturan Pakai:</b> {{$do->aturan_pakai}} ||<b> Nama Obat:</b> {{$do->nama_obat}}<br>
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td>{{$datas->jam_mulai}} - {{$datas->jam_selesai}}</td>
                                            <td>{{$datas->penanggung_jawab}} || {{$datas->perawat}}</td>
                                            <!-- <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td> -->
                                            
                                </tr>
                                <?php $no++;?>
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
                            <button type="button" class="btn mb-1 btn-rounded btn-success float-right" data-href='/poliumum/print' id="export" onclick="exportTasks(event.target);">Export to ecxel</button>
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
<!--**********************************
            Content body end
        ***********************************-->
@include('template.footer')