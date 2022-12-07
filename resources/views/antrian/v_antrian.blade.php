<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title> {{$judul}} </title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="/template/images/logo2.png">
    <!-- Custom Stylesheet -->
    <link href="/template/plugins/tables/css/datatable/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="/template/css/style.css" rel="stylesheet">
</head>

<body>

<!--*******************
    Preloader start
********************-->
<div id="preloader">
    <div class="loader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
        </svg>
    </div>
</div>
<!--*******************
    Preloader end
********************-->

<div id="content-wrapper">

    <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <h4>Daftar Antrian</h4>
            </li>
        </ol>

        <br>
        <br>
        <div class="container-fluid h-50">
            <div class="row h-90">
                <div class="col-3"> </div>
            </div>
            <div class="row justify-content-center h-100">
                <table class="table table-striped table-bordered table-hover">
                    @foreach($poli as $b)
                        <div class="col-lg-3 ">
                            <div class="card">
                                <div class="card-body">
                                    <div class="text-center">
                                        <span class="display-5"><i class="icon-user gradient-2-text"></i></span>
                                        <h2 class="mt-0">{{$b->nama_poli}}</h2>
                                        <a href="/getantrian/{{$b->id}}" class="btn gradient-1 btn-lg border-0 btn-rounded px-5" onclick="printDiv('DivIdToPrint');">Pilih</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="container-fluid h-50">
                        <div class="row h-90">
                            <div class="col-3"> </div>
                        </div>
                        <div class="row justify-content-center h-100"  >
                            <table class="table table-striped table-bordered table-hover">
                                @forelse($antrian as $a)
                                    <div class="col-lg-3 col-sm-6">
                                        <div class="card gradient-4">
                                            <div class="card-body">
                                                <h3 class="card-title text-white">Antrian {{$a->nama_poli}}</h3>
                                                <div class="d-inline-block">
                                                    <h2 class="text-white">{{$a->kode_poli}}
                                                        @if($a->no_antrian >= 10)
                                                            0
                                                        @endif
                                                        @if($a->no_antrian < 10)
                                                            00
                                                        @endif
                                                        {{$a->no_antrian}}
                                                    </h2>
                                                    <p class="text-white mb-0">{{ date('l, d F Y')}}</p>
                                                </div>
                                                <span class="float-right display-5 opacity-5"><i class="fa fa-users"></i></span>
                                            </div>
                                        </div>
                                        <!-- print untuk urutan A 00 2 ke atas -->
                                        <div class="card gradient-4" id="DivIdToPrint" style="display:none">
                                            <div class="card-body">
                                                <h3 class="card-title text-white">Antrian {{$a->nama_poli}}</h3>
                                                <div class="d-inline-block">
                                                    <h2 class="text-white">{{$a->kode_poli}}
                                                        @if($a->no_antrian >= 9)
                                                            0
                                                        @endif
                                                        @if($a->no_antrian < 9)
                                                            00
                                                        @endif
                                                        {{$a->no_antrian+1}}
                                                    </h2>
                                                    <p class="text-white mb-0">{{ date('l, d F Y')}}</p>
                                                </div>
                                                <span class="float-right display-5 opacity-5"><i class="fa fa-users"></i></span>
                                            </div>
                                        </div>
                                        @empty
                                        <!-- khusus buat antrian A 00 1 -->
                                        <div class="card gradient-4" id="DivIdToPrint" style="display:none">
                                            <div class="card-body">
                                                <h3 class="card-title text-white">Antrian Poli Umum</h3>
                                                <div class="d-inline-block">
                                                    <h2 class="text-white">A 00 1</h2>
                                                    <p class="text-white mb-0">{{ date('l, d F Y')}}</p>
                                                </div>
                                                <span class="float-right display-5 opacity-5"><i class="fa fa-users"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                @endforelse
                            </table>
                        </div>
                        <div class="row h-50">
                            <div class="col-3"> </div>
                        </div>
                        <!-- #/ container -->
                    </div>
                </table>
            </div>
        </div>
    </div>
</div>
<!--**********************************
Main wrapper end
***********************************-->

<!--**********************************
Scripts
***********************************-->
<script src="/template/plugins/common/common.min.js"></script>
<script src="/template/js/custom.min.js"></script>
<script src="/template/js/settings.js"></script>
<script src="/template/js/gleek.js"></script>
<script src="/template/js/styleSwitcher.js"></script>

<script src="/template/plugins/tables/js/jquery.dataTables.min.js"></script>
<script src="/template/plugins/tables/js/datatable/dataTables.bootstrap4.min.js"></script>
<script src="/template/plugins/tables/js/datatable-init/datatable-basic.min.js"></script>
<script>
    function printDiv(DivIdToPrint) 
    {
        var divToPrint=document.getElementById('DivIdToPrint').innerHTML; 
        document.body.innerHTML = divToPrint;
        window.print('width=48');
        // var newWin=window.open('','Print-Window');
        //     newWin.document.open();
        //     newWin.document.write('<html><body onload="window.print()">'+DivIdToPrint.innerHTML+'</body></html>');
        //     newWin.document.close();
        //     setTimeout(function(){newWin.close();},10);
    }
</script>
</body>

</html>
