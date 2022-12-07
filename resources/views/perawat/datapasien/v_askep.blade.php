@include('template.header')
@include('perawat.template.sidebar')


<div class="row page-titles mx-0">
    <div class="col p-md-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Asuhan Keperawatan</a></li>
        </ol>
    </div>
</div>
<!-- row -->

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card" >
                <!-- id="content" -->
                <div class="card-body" >
                    
                    <div class="container" >
                    <div>
                        <h1 class="text-center">Data Pasien</h1>
                    </div>
                    
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
                    <!-- <h4 class="card-title">Data Table</h4> -->
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered zero-configuration">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width: 1px">No.</th>
                                    <th class="text-center" style="width: 25px">Tanggal</th>
                                    <th class="text-center" style="width: 25px">Waktu Pelayanan</th>
                                    <th class="text-center" style="width: 25px">Subjective</th>
                                    <th class="text-center" style="width: 25px">Objective</th>
                                    <th class="text-center" style="width: 25px">Assessment</th>
                                    <th class="text-center" style="width: 25px">Plan</th>
                                    <th class="text-center" style="width: 25px">Penanggung Jawab</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;?>
                                @foreach($askep as $a)
                                <tr>
                                    <td class=" text-center" style="width: 1px">{{$no}}</td>
                                      <?php 
                                      $time= strtotime($a->jam_selesai);
                                      $jam=date("H:i:s", $time); 
                                      $time2= strtotime($a->jam_mulai);
                                      $jammulai=date("H:i:s", $time2); 
                                      $hari = date("d-m-Y", strtotime($a->tanggal));
                                      ?>

                                    <td class="text-center" style="width: 25px">{{$hari}}</td>
                                    <td style="width: 25px">{{$jammulai}}- {{$jam}} </td>
                                    <td style="width: 25px"><p><b>rpd :</b> {{$a->rpd}} <p> </p> <b>rpk :</b> {{$a->rpk}} </p> <p> <b>rps :</b> {{$a->rps}} </p> <p> <b>nb_subjective :</b> {{$a->nb_subjective}} </p></td>
                                    <td style="width: 25px"><p><b>tb :</b> {{$a->tb}} </p><p> <b>bb :</b> {{$a->bb}} </p> <p> <b>imt :</b> {{$a->imt}} </p> <p> <b>suhu :</b> {{$a->suhu}} </p> <p> <b>rr :</b> {{$a->rr}} </p> <p> <b>sistol :</b> {{$a->sistol }} </p> <p> <b>diastol :</b> {{$a->diastol}} </p> <p> <b>nb_objective :</b> {{$a->nb_object}} </p></td>
                                    <td style="width: 25px"> {{$a->nb_assessment}}</td>
                                    <td style="width: 25px"> {{$a->nb_plan}}</td>
                                    <td style="width: 25px"> {{$a->penanggungjawab}}</td>
                                </tr>
                                <?php $no++; ?>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    </div>

                    <div class="card gradient-4" id="DivIdToPrint" style="display:none" >
                    <br>
                    <div>
                        <h1 class="text-center">Data Pasien</h1>
                    </div>
                    <br>
                    @foreach($pasien as $pasien)
                    <ul class="px-4 pt-4 justify-content-between">
                        <li class="mb-1"><strong class="text-dark mr-4">Nama Lengkap</strong> <span>: {{$pasien->nama}} </span></li>
                        <li class="mb-1"><strong class="text-dark mr-4">Nama KK</strong> <span>: {{$pasien->nama_kk}} </span></li>
                        <li class="mb-1"><strong class="text-dark mr-4">Nomor Rekam Medis</strong> <span>: {{$pasien->no_rm}} </span></li>
                        <li class="mb-1"><strong class="text-dark mr-4">Jenis Asuransi</strong> <span>: {{$pasien->jenis_asuransi}} </span></li>
                        <li class="mb-1"><strong class="text-dark mr-4">Nomor Asuransi</strong> <span>: {{$pasien->no_asuransi}} </span>
                        </li><li class="mb-1"><strong class="text-dark mr-4">Silsilah</strong> <span>: {{$pasien->silsilah}} </span></li>
                        <li class="mb-1"><strong class="text-dark mr-4">Umur</strong> <span>: {{$pasien->umur}} </span></li>
                        <li class="mb-1"><strong class="text-dark mr-4">Pekerjaan</strong> <span>: {{$pasien->pekerjaan}} </span></li>
                        <li class="mb-1"><strong class="text-dark mr-4">No. HP</strong> <span>: {{$pasien->telp}} </span></li>
                    </ul>
                    <br>
                    <br>
                    @endforeach
                    <!-- <h4 class="card-title">Data Table</h4> -->
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered zero-configuration">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width: 1px">No.</th>
                                    <th style="width: 25px">Tanggal</th>
                                    <th style="width: 25px">Waktu Pelayanan</th>
                                    <th style="width: 25px">Subjective</th>
                                    <th style="width: 25px">Objective</th>
                                    <th style="width: 25px">Assessment</th>
                                    <th style="width: 25px">Plan</th>
                                    <th style="width: 25px">Penanggung Jawab</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;?>
                                @foreach($askep as $a)
                                <tr>
                                    <td class=" text-center" style="width: 1px">{{$no}}</td>
                                      <?php 
                                      $time= strtotime($a->jam_selesai);
                                      $jam=date("H:i:s", $time); 
                                      $time2= strtotime($a->jam_mulai);
                                      $jammulai=date("H:i:s", $time2); 
                                      $hari = date("d-m-Y", strtotime($a->tanggal))
                                      ?>

                                    <td class="text-center" style="width: 25px">{{$hari}}</td>
                                    <td style="width: 25px">{{$jammulai}}- {{$jam}} </td>
                                    <td style="width: 25px"><p><b>RPD :</b> {{$a->rpd}} <p> </p> <b>RPK :</b> {{$a->rpk}} </p> <p> <b>RPS :</b> {{$a->rps}} </p> <p> <b>NB Subjective :</b> {{$a->nb_subjective}} </p></td>
                                    <td style="width: 25px"><p><b>TB :</b> {{$a->tb}} </p><p> <b>BB :</b> {{$a->bb}} </p> <p> <b>IMT :</b> {{$a->imt}} </p> <p> <b>Suhu :</b> {{$a->suhu}} </p> <p> <b>Respirasi :</b> {{$a->rr}} </p> <p> <b>Sistol :</b> {{$a->sistol }} </p> <p> <b>Diastol :</b> {{$a->diastol}} </p> <p> <b>nb_objective :</b> {{$a->nb_object}} </p></td>
                                    <td style="width: 25px"> {{$a->nb_assessment}}</td>
                                    <td style="width: 25px"> {{$a->nb_plan}}</td>
                                    <td style="width: 25px"> {{$a->penanggungjawab}}</td>
                                </tr>
                                <?php $no++; ?>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    </div>

                    <div class="card-footer">
                        <div class="rounded-button">
                            <button type="button" class="btn mb-1 btn-rounded btn-success float-right" onclick="printDiv('DivIdToPrint');">Print</button>
                        </div>
                        <!-- id="cmd" -->
                    </div>
                </div>
            </div>
            
        </div>
        <!-- #/ container -->
    </div>
</div>


<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<!-- <script src="//cdnjs.cloudflare.com/ajax/libs/jspdf/1.2.61/jspdf.debug.js"></script> -->
<!-- <script src="/template/js/jspdf.debug.js"></script> -->
<!-- <script src="{{ asset('/template/js/jspdf.debug.js') }}"></script> -->
<script type="application/javascript" src="{{ asset('/js/jspdf.debug.js') }}"></script>



<script>
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
    }</script>
<!--**********************************
            Content body end
        ***********************************-->
@include('template.footer')