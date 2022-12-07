@include('farmasi.templatefarmasi.v_header')
@include('kasir.template.sidebar')
<div class="row page-titles mx-0">
    <div class="col p-md-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Antrian</a></li>
        </ol>
    </div>
</div>
<!-- row -->
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-4 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-5">
                        <div>
                            <h4 class="text-muted mb-4">Data Pasien</h4>
                        </div>
                         <ul class="card-profile__info">
                            @foreach($pasien as $pasiens)
                                <li class="mb-1"><strong class="text-dark mr-4">No. Antrian</strong> <span class="float-right">{{$pasiens->no_antrian}}</span></li>
                                <li class="mb-1"><strong class="text-dark mr-4">Tanggal</strong> <span class="float-right">{{$pasiens->tanggal}}</span></li>
                                <li class="mb-1"><strong class="text-dark mr-4">No. Rekam Medis</strong> <span class="float-right">{{$pasiens->no_rm}}</span></li>
                                <li class="mb-1"><strong class="text-dark mr-4">Nama Lengkap</strong> <span class="float-right">{{$pasiens->nama}}</span></li>
                                <li class="mb-1"><strong class="text-dark mr-4">Tanggal Lahir</strong> <span class="float-right"> {{$pasiens->tanggal_lahir}}</span></li>
                                <li class="mb-1"><strong class="text-dark mr-4">Umur</strong> <span class="float-right">{{$pasiens->umur}}</span></li>
                                <li class="mb-1"><strong class="text-dark mr-4">Alamat</strong> <span class="float-right">{{$pasiens->alamat}}</span></li>
                                <li class="mb-1"><strong class="text-dark mr-4">Jenis Kelamin</strong> <span class="float-right">{{$pasiens->jenis_kelamin}}</span></li>
                                <li class="mb-1"><strong class="text-dark mr-4">Jenis Asuransi</strong> <span class="float-right">{{$pasiens->jenis_asuransi}}</span></li>
                                <li class="mb-1"><strong class="text-dark mr-4">Nomor Asuransi</strong> <span class="float-right">{{$pasiens->no_asuransi}} </span></li>
                                <li class="mb-1"><strong class="text-dark mr-4">Poli Asal</strong> <span class="float-right">{{$pasiens->poli_asal}} </span></li>
                            @endforeach
                            <!-- <li class="mb-1"><strong class="text-dark mr-4">No. Antrian</strong> <span></span></li>
                            <li class="mb-1"><strong class="text-dark mr-4">Tanggal</strong> <span>tanggal, jam</span></li>
                            <li class="mb-1"><strong class="text-dark mr-4">No RM</strong> <span> </span></li>
                            <li class="mb-1"><strong class="text-dark mr-4">Nama Lengkap</strong> <span> </span></li>
                            <li class="mb-1"><strong class="text-dark mr-4">Alamat</strong> <span> </span></li>
                            <li class="mb-1"><strong class="text-dark mr-4">Umur</strong> <span> </span></li>
                            <li class="mb-1"><strong class="text-dark mr-4">Jenis Kelamin</strong> <span> </span></li>
                            <li class="mb-1"><strong class="text-dark mr-4">Jenis Asuransi</strong> <span></span> </li>
                            <li class="mb-1"><strong class="text-dark mr-4">No Asuransi</strong> <span></span> </li>
                            <li class="mb-1"><strong class="text-dark mr-4">Poli Asal</strong> <span> </span></li> -->
                        </ul>
                    </div>
                </div>
            </div>
            <!-- <div class="card">
                <div class="card-body">
                    <div class="row mb-5">
                        <div>
                            <h4 class="text-muted mb-4">Data Pelayanan</h4>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                   
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div> -->
        </div>
        
        <div class="col-lg-12 col-xl-9">
         
                <div class="card">
                    <!-- <section> -->
                    <div class="card-body">
                        
                        <div>
                            <h2 class="text-center text-muted mb-4">Pelayanan</h2>
                        </div>
                        <div class="mb-4">
                            <h5><strong>Poli Asal :</strong> {{$pasien[0]->poli_asal}}</h5>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Jenis Tindakan</th>
                                        <th>Harga Jenis Tindakan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($tindakan_rm as $tindakans)
                                    <tr>
                                        <td>{{$tindakans->nama_tindakan}}</td>
                                        <td>{{$tindakans->tarif}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Jenis Laboratorium</th>
                                        <th>Harga Jenis Laboratorium</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pemeriksaan as $pemeriksaans)
                                    <tr>
                                        <td>{{$pemeriksaans->nama}}</td>
                                        <td>{{$pemeriksaans->tarif}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <?php 
                        $totaltarif = 0;
                        
                        foreach($pemeriksaan as $pemeriksaans){
                            $totaltarif+=$pemeriksaans->tarif;
                        }
                        foreach($tindakan_rm as $tindakans){
                            $totaltarif+=$tindakans->tarif;
                        }
                        foreach($pasien as $pasiens){
                            if($pasiens->jenis_asuransi == "BPJS"){
                                $totaltarif = 0;
                            }
                        }
                        ?>
                       <div class="card-footer"> 
                            <div class="col-md-6 rounded-button">
                                <button type="button" class="btn mb-1 btn-rounded btn-warning float-right" data-toggle="modal" data-target="#basicModal1">Print</button>
                            </div>
                            <div class="col-md-6 rounded-button">
                                <form class="form-horizontal" method="post" action="/pelayanankasir/savekasir">
                                @csrf
                                    <input type="hidden" value="{{$pasien[0]->no_rm}}" name="no_rm" class="form-control">
                                    <input type="hidden" value="{{$pasien[0]->id_pemeriksaan}}" name="id_pemeriksaan" class="form-control">
                                    <input type="hidden" value="{{$totaltarif}}" name="tarif" class="form-control">
                                    <button class="btn mb-1 btn-rounded btn-success float-right text-white mr-2">Selesai</button>  
                                </form>
                            </div>
                            
                        </div>
                    </div>
                </div>
        </div>
    </div>
    <!-- #/ container -->
    
</div>
<div class="modal" id="basicModal1" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
    <div class="modal-dialog">
        <div id = "">
            <div class="modal-content">
                <div class="modal-header">

                    <h5 class="modal-title">Invoice Pelayanan Pukesmas Rejowinangon</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                
                <div class="modal-body">
                        <!-- Modal body text goes here. -->
                    <ul class="card-profile__info">
                                <li class="mb-1"><strong class="text-dark mr-4">Nama Pasien :</strong> <span class="float-right">{{$pasien[0]->nama}}</span></li>
                                <!-- <li class="mb-1"><strong class="text-dark mr-4"> Nomor Pembayaran</strong> <span >:</span></li> -->
                                <li class="mb-1"><strong class="text-dark mr-4">Jumlah Yang Dibayarkan :</strong> <span class="float-right">Rp{{$totaltarif}} </span></li>
                                <li class="mb-1"><strong class="text-dark mr-4">Jenis Pelayanan (poli dan jenis tindakan)  :</strong> <span class="float-right text-dark mr-4" ></span></li>
                                <li class="mb-1"><div class="mb-4">
                                    <h6><strong class="text-dark mr-4">Poli Asal :</strong> <span class="float-right">{{$pasien[0]->poli_asal}}</span></h6>
                                </li>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Jenis Tindakan</th>
                                                <th>Harga Jenis Tindakan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($tindakan_rm as $tindakans)
                                            <tr>
                                                <td>{{$tindakans->nama_tindakan}}</td>
                                                <td>{{$tindakans->tarif}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Jenis Laboratorium</th>
                                                <th>Harga Jenis Laboratorium</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($pemeriksaan as $pemeriksaans)
                                            <tr>
                                                <td>{{$pemeriksaans->nama}}</td>
                                                <td>{{$pemeriksaans->tarif}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <li class="mb-1"><strong class="text-dark mr-4">Tanggal Pembayaran :</strong> <span class="float-right">{{$pasien[0]->tanggal}} </span></li>
                            </ul>
                            <button type="button" class="btn mb-1 btn-rounded btn-primary float-right" onclick="printDiv('DivIdToPrint')">Print</button>
                    </div>
            </div>
        </div>
    </div>
</div>
<div id = "DivIdToPrint" style="display:none">
            <div class="">
                <div class="">
                    <h5 class="">Invoice Pelayanan Pukesmas Rejowinangon</h5>
                </div>
                
                <div class="">
                        <!-- Modal body text goes here. -->
                    <ul class="card-profile__info">
                                <li class="mb-1"><strong class="text-dark mr-4">Nama Pasien :</strong> <span class="float-right">{{$pasien[0]->nama}}</span></li>
                                <!-- <li class="mb-1"><strong class="text-dark mr-4"> Nomor Pembayaran</strong> <span >:</span></li> -->
                                <li class="mb-1"><strong class="text-dark mr-4">Jumlah Yang Dibayarkan :</strong> <span class="float-right">Rp{{$totaltarif}} </span></li>
                                <li class="mb-1"><strong class="text-dark mr-4">Jenis Pelayanan (poli dan jenis tindakan)  :</strong> <span class="float-right text-dark mr-4" ></span></li>
                                <li class="mb-1"><div class="mb-4">
                                    <h6><strong class="text-dark mr-4">Poli Asal :</strong> <span class="float-right">{{$pasien[0]->poli_asal}}</span></h6>
                                </li>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Jenis Tindakan</th>
                                                <th>Harga Jenis Tindakan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($tindakan_rm as $tindakans)
                                            <tr>
                                                <td>{{$tindakans->nama_tindakan}}</td>
                                                <td>{{$tindakans->tarif}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Jenis Laboratorium</th>
                                                <th>Harga Jenis Laboratorium</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($pemeriksaan as $pemeriksaans)
                                            <tr>
                                                <td>{{$pemeriksaans->nama}}</td>
                                                <td>{{$pemeriksaans->tarif}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <li class="mb-1"><strong class="text-dark mr-4">Tanggal Pembayaran :</strong> <span class="float-right">{{$pasien[0]->tanggal}} </span></li>
                            </ul>           
                    </div>
            </div>
        </div>
<script>
    function printDiv(DivIdToPrint) 
    {
        var divToPrint=document.getElementById('DivIdToPrint').innerHTML; 
        document.body.innerHTML = divToPrint;
        window.print();
        location.reload();
        // var newWin=window.open('','Print-Window');
        //     newWin.document.open();
        //     newWin.document.write('<html><body onload="window.print()">'+divToPrint+'</body></html>');
        //     newWin.document.close();
        //     setTimeout(function(){newWin.close();},1000);
    }
</script>
@include('farmasi.templatefarmasi.v_footer')

<!--**********************************
            Content body end
        ***********************************-->