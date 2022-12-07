@include('template.header')
@include('perawat.template.sidebar')


<div class="row page-titles mx-0">
    <div class="col p-md-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Rekam Medis</a></li>
        </ol>
    </div>
</div>


<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card" id="content">    
            <div class="card-body">
                    <div>
                        <h1 class="text-center">Data Pasien</h1>
                    </div>
                    <br>
                    @foreach($pasien as $pasiens)
                    <ul class="px-4 pt-4 justify-content-between">
                        <li class="mb-1"><strong class="text-dark mr-4">Nama Lengkap</strong> <span>: {{$pasiens->nama}} </span></li>
                        <li class="mb-1"><strong class="text-dark mr-4">Nama KK</strong> <span>: {{$pasiens->nama_kk}} </span></li>
                        <li class="mb-1"><strong class="text-dark mr-4">Nomor Rekam Medis</strong> <span>: {{$pasiens->no_rm}} </span></li>
                        <li class="mb-1"><strong class="text-dark mr-4">Jenis Asuransi</strong> <span>: {{$pasiens->jenis_asuransi}} </span></li>
                        <li class="mb-1"><strong class="text-dark mr-4">Nomor Asuransi</strong> <span>: {{$pasiens->no_asuransi}} </span>
                        </li><li class="mb-1"><strong class="text-dark mr-4">Silsilah</strong> <span>: {{$pasiens->silsilah}} </span></li>
                        <li class="mb-1"><strong class="text-dark mr-4">Umur</strong> <span>: {{$pasiens->umur}} </span></li>
                        <li class="mb-1"><strong class="text-dark mr-4">Pekerjaan</strong> <span>: {{$pasiens->pekerjaan}} </span></li>
                        <li class="mb-1"><strong class="text-dark mr-4">No. HP</strong> <span>: {{$pasiens->telp}} </span></li>
                    </ul>
                    
                    @endforeach
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered zero-configuration">
                            <thead>
                                <tr>
                                    <th class="text-center">No.</th>
                                    <th>Tanggal</th>
                                    <th>Waktu Pelayanan</th>
                                    <th>Anamnesa</th>
                                    <th>Pemeriksaan</th>
                                    <th>Diagnosa</th>
                                    <th>Pengobatan/Penyuluhan</th>
                                    <th>Penanggung Jawab</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                ?>
                                @foreach($rekammedis as $rm)
                                <?php 
                                      $time= strtotime($rm->waktu_selesai);
                                      $jam=date("H:i:s", $time); 
                                      $time2= strtotime($rm->waktu_mulai);
                                      $jammulai=date("H:i:s", $time2); 
                                      $hari = date("d-m-Y", strtotime($rm->tanggal_kunjungan));
                                      ?>
                                <tr>
                                    <td class=" text-center">{{$no}}</td>
                                    <td>{{$hari}}</td>
                                    <td>{{$jammulai}} - {{$jam}}</td>
                                    <td>
                                        <p><b>RPD : </b> {{$rm->rpd}} </p>
                                        <p> <b>RPK :</b> {{$rm->rpk}} </p>
                                        <p> <b>RPS :</b> {{$rm->rps}} </p>
                                    </td>
                                    <td>
                                        <p><b>TB : </b> {{$rm->tinggi_badan}} </p>
                                        <p> <b>BB :</b> {{$rm->berat_badan}} </p>
                                        <p> <b>IMT :</b> {{$rm->imt}} </p>
                                        <p><b>Suhu :</b> {{$rm->suhu}} </p>
                                        <p> <b>RR :</b> {{$rm->rr}} </p>
                                        <p> <b>Sistol :</b> {{$rm->sistol }} </p>
                                        <p><b>Diastol :</b> {{$rm->diastol}} </p>
                                    </td>
                                    <td>
                                        @foreach($diagnosa as $di)
                                        @if($di->id_pemeriksaan == $rm->id_pemeriksaan)
                                        <p><b>Kode : </b> {{$di->icd_x}} </p>
                                        <p><b>Nama : </b> {{$di->nama_diagnosa}} </p>
                                        @endif
                                        @endforeach
                                    </td>
                                    <td>
                                        <p><b>Laboratorium : </b>
                                        @foreach($data_lab as $dl)
                                            @if($dl->id_pemeriksaan == $rm->id_pemeriksaan)
                                            <b> {{$dl->nama_pemeriksaan}} : </b> {{$dl->hasil_pemeriksaan_lab}} </p> 
                                            @endif
                                        @endforeach 
                                        <p><b>Tindakan : </b> 
                                        @foreach($data_tindakan as $dt)
                                            @if($dt->id_pemeriksaan == $rm->id_pemeriksaan)
                                            <p><b> {{$dt->tindakan}} : </b> {{$dt->keterangan}} </p> </p>
                                            @endif
                                        @endforeach
                                        <p><b>Resep Obat : </b>
                                        @foreach($data_obat as $do)
                                            @if($do->id_pemeriksaan == $rm->id_pemeriksaan)
                                               <p><b> Nama Obat : </b>{{$do->nama_obat}} </p> 
                                               <p><b> Aturan : </b> {{$do->aturan_pakai}} </p>
                                               <p><b> Jumlah : </b> {{$do->jumlah}}  </p></p>
                                            @endif
                                        @endforeach
                                        <p><b>Penyuluhan : </b></p>
                                        {{$rm->isi_penyuluhan}}
                                    </td>
                                    <td>
                                        <p><b>Dokter : </b> {{$rm->dokter_penanggung_jawab}} </p> 
                                        <p><b>Perawat : </b> {{$rm->perawat_penanggung_jawab}} </p>
                                    </td>
                                </tr>
                              <?php $no++ ?>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <div class="rounded-button">
                            <button type="button" class="btn mb-1 btn-rounded btn-success float-right" onclick="printDiv('DivIdToPrint');">Print</button>
                        </div>
                    </div>
                </div>
                <div class="card gradient-4" id="DivIdToPrint" style="display:none">
                    <br>
                    <div>
                        <h1 class="text-center">Data Pasien</h1>
                    </div>
                    <br>
                    @foreach($pasien as $pasiens)
                    <ul class="px-4 pt-4 justify-content-between">
                        <li class="mb-1"><strong class="text-dark mr-4">Nama Lengkap</strong> <span>: {{$pasiens->nama}} </span></li>
                        <li class="mb-1"><strong class="text-dark mr-4">Nama KK</strong> <span>: {{$pasiens->nama_kk}} </span></li>
                        <li class="mb-1"><strong class="text-dark mr-4">Nomor Rekam Medis</strong> <span>: {{$pasiens->no_rm}} </span></li>
                        <li class="mb-1"><strong class="text-dark mr-4">Jenis Asuransi</strong> <span>: {{$pasiens->jenis_asuransi}} </span></li>
                        <li class="mb-1"><strong class="text-dark mr-4">Nomor Asuransi</strong> <span>: {{$pasiens->no_asuransi}} </span>
                        </li><li class="mb-1"><strong class="text-dark mr-4">Silsilah</strong> <span>: {{$pasiens->silsilah}} </span></li>
                        <li class="mb-1"><strong class="text-dark mr-4">Umur</strong> <span>: {{$pasiens->umur}} </span></li>
                        <li class="mb-1"><strong class="text-dark mr-4">Pekerjaan</strong> <span>: {{$pasiens->pekerjaan}} </span></li>
                        <li class="mb-1"><strong class="text-dark mr-4">No. HP</strong> <span>: {{$pasiens->telp}} </span></li>
                    </ul>
                    <br>
                    <br>
                    @endforeach
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered zero-configuration">
                            <thead>
                                <tr>
                                    <th class="text-center">No.</th>
                                    <th>Tanggal</th>
                                    <th>Waktu Pelayanan</th>
                                    <th>Anamnesa</th>
                                    <th>Pemeriksaan</th>
                                    <th>Diagnosa</th>
                                    <th>Pengobatan/Penyuluhan</th>
                                    <th>Penanggung Jawab</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                ?>
                                @foreach($rekammedis as $rm)
                                <?php 
                                      $time= strtotime($rm->waktu_selesai);
                                      $jam=date("H:i:s", $time); 
                                      $time2= strtotime($rm->waktu_mulai);
                                      $jammulai=date("H:i:s", $time2); 
                                      ?>
                                <tr>
                                    <td class=" text-center">{{$no}}</td>
                                    <td>{{$rm->tanggal_kunjungan}}</td>
                                    <td>{{$jammulai}} - {{$jam}}</td>
                                    <td>
                                        <p><b>RPD : </b> {{$rm->rpd}} </p>
                                        <p> <b>RPK :</b> {{$rm->rpk}} </p>
                                        <p> <b>RPS :</b> {{$rm->rps}} </p>
                                    </td>
                                    <td>
                                        <p><b>TB : </b> {{$rm->tinggi_badan}} </p>
                                        <p> <b>BB :</b> {{$rm->berat_badan}} </p>
                                        <p> <b>IMT :</b> {{$rm->imt}} </p>
                                        <p><b>Suhu :</b> {{$rm->suhu}} </p>
                                        <p> <b>RR :</b> {{$rm->rr}} </p>
                                        <p> <b>Sistol :</b> {{$rm->sistol }} </p>
                                        <p><b>Diastol :</b> {{$rm->diastol}} </p>
                                    </td>
                                    <td>
                                        @foreach($diagnosa as $di)
                                        @if($di->id_pemeriksaan == $rm->id_pemeriksaan)
                                        <p><b>Kode : </b> {{$di->icd_x}} </p>
                                        <p><b>Nama : </b> {{$di->nama_diagnosa}} </p>
                                        @endif
                                        @endforeach
                                    </td>
                                    <td>
                                        <p><b>Laboratorium : </b>
                                        @foreach($data_lab as $dl)
                                            @if($dl->id_pemeriksaan == $rm->id_pemeriksaan)
                                            <b> {{$dl->nama_pemeriksaan}} : </b> {{$dl->hasil_pemeriksaan_lab}} </p> 
                                            @endif
                                        @endforeach 
                                        <p><b>Tindakan : </b> 
                                        @foreach($data_tindakan as $dt)
                                            @if($dt->id_pemeriksaan == $rm->id_pemeriksaan)
                                            <p><b> {{$dt->tindakan}} : </b> {{$dt->keterangan}} </p> </p>
                                            @endif
                                        @endforeach
                                        <p><b>Resep Obat : </b>
                                        @foreach($data_obat as $do)
                                            @if($do->id_pemeriksaan == $rm->id_pemeriksaan)
                                               <p><b> Nama Obat : </b>{{$do->nama_obat}} </p> 
                                               <p><b> Aturan : </b> {{$do->aturan_pakai}} </p>
                                               <p><b> Jumlah : </b> {{$do->jumlah}}  </p></p>
                                            @endif
                                        @endforeach
                                        <p><b>Penyuluhan : </b></p>
                                        {{$rm->isi_penyuluhan}}
                                    </td>
                                    <td>
                                        <p><b>Dokter : </b> {{$rm->dokter_penanggung_jawab}} </p> 
                                        <p><b>Perawat : </b> {{$rm->perawat_penanggung_jawab}} </p>
                                    </td>
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

<!--**********************************
            Content body end
        ***********************************-->
<script src="/template/plugins/common/common.min.js"></script>
<script src="/template/js/custom.min.js"></script>
<script src="/template/js/settings.js"></script>
<script src="/template/js/gleek.js"></script>
<script src="/template/js/styleSwitcher.js"></script>

<script src="/template/plugins/tables/js/jquery.dataTables.min.js"></script>
<script src="/template/plugins/tables/js/datatable/dataTables.bootstrap4.min.js"></script>
<script src="/template/plugins/tables/js/datatable-init/datatable-basic.min.js"></script>



        <!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script> -->
<!-- <script src="//cdnjs.cloudflare.com/ajax/libs/jspdf/1.2.61/jspdf.debug.js"></script> -->
<!-- <script src="/template/js/jspdf.debug.js"></script> -->
<!-- <script src="{{ asset('/template/js/jspdf.debug.js') }}"></script> -->
<!-- <script type="application/javascript" src="{{ asset('/js/jspdf.debug.js') }}"></script> -->

<!-- <script>
$(document).ready(function() {
    var doc = new jsPDF({
    orientation: 'landscape'
    });
    doc.setFontSize(10);
    $('#cmd').click(function () {
        doc.fromHTML($('#content').html(), 15, 15, {
            'width': 170,
        },
        function () {
            doc.save('data-rm.pdf')
        });
    });
});
</script> -->
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
function printDiv(DivIdToPrint) 
    {
        var divToPrint=document.getElementById('DivIdToPrint').innerHTML; 
        document.body.innerHTML = divToPrint;
        window.print('width=48');
        location.reload();
        // var newWin=window.open('','Print-Window');
        //     newWin.document.open();
        //     newWin.document.write('<html><body onload="window.print()">'+DivIdToPrint.innerHTML+'</body></html>');
        //     newWin.document.close();
        //     setTimeout(function(){newWin.close();},10);
    }
</script>
@include('template.Footer')