@include('template.header')
@include('admin.template.sidebar')
<div id="content-wrapper">
    <div class="container-fluid">

        <div class="row page-titles mx-0">
            <div class="col p-md-0">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Data</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Antrian Seluruh Poli</a></li>
                </ol>
            </div>
        </div>

        <div class="container-fluid h-50">
            <div class="row h-90">
                <div class="col-3"> </div>
            </div>
            <div class="row justify-content-center h-100">
                <table class="table table-striped table-bordered table-hover">
                        <!-- <div class="col-lg-3 ">
                            <div class="card">
                                <div class="card-body">
                                    <div class="text-center">
                                        <span class="display-5"><i class="icon-user gradient-7-text"></i></span>
                                        <h2 class="mt-0"></h2>
                                        <a href="" class="btn gradient-3 btn-lg border-0 btn-rounded px-5">Pilih</a>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                    <div class="container-fluid h-50">
                        <div class="row h-90">
                            <div class="col-3"> </div>
                        </div>
                        <div class="row justify-content-center h-100">
                            <table class="table table-striped table-bordered table-hover">
                              
                                    
                    <div class="col-lg-4 col-sm-6">
                        <div class="card gradient-1">
                            <div class="card-body">
                                <h1 class="card-title text-white">Poli Umum</h1>
                                <div class="d-inline-block">
                                    <h6 class="text-white">Jumlah Antrian {{$antrian_umum}}</h6>
                                    <h6 class="text-white">Jumlah Dilayani {{$dilayani_umum}}</h6>
                                    <p class="text-white mb-0">{{$tanggal}}</p>
                                </div>
                                <span class="float-right display-5 opacity-4"><i class="fa fa-user-md"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="card gradient-1">
                            <div class="card-body">
                                <h1 class="card-title text-white">Laboratorium</h1>
                                <div class="d-inline-block">
                                    <h6 class="text-white">Jumlah Antrian {{$antrian_laboratorium}}</h6>
                                    <h6 class="text-white">Jumlah Dilayani {{$dilayani_laboratorium}}</h6>
                                    <p class="text-white mb-0">{{$tanggal}}</p>
                                </div>
                                <span class="float-right display-5 opacity-4"><i class="fa fa-heartbeat"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="card gradient-1">
                            <div class="card-body">
                                <h1 class="card-title text-white">Farmasi</h1>
                                <div class="d-inline-block">
                                    <h6 class="text-white">Jumlah Antrian {{$antrian_farmasi}}</h6>
                                    <h6 class="text-white">Jumlah Dilayani {{$dilayani_farmasi}}</h6>
                                    <p class="text-white mb-0">{{$tanggal}}</p>
                                </div>
                                <span class="float-right display-5 opacity-4"><i class="fa fa-medkit"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="card gradient-1">
                            <div class="card-body">
                                <h1 class="card-title text-white">Kasir</h1>
                                <div class="d-inline-block">
                                    <h6 class="text-white">Jumlah Antrian {{$antrian_kasir}}</h6>
                                    <h6 class="text-white">Jumlah Dilayani {{$dilayani_kasir}}</h6>
                                    <p class="text-white mb-0">{{$tanggal}}</p>
                                </div>
                                <span class="float-right display-5 opacity-4"><i class="fa fa-money"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="card gradient-1">
                            <div class="card-body">
                                <h1 class="card-title text-white">Pendaftaran</h1>
                                <div class="d-inline-block">
                                    <h6 class="text-white">Jumlah Antrian {{$antrian_pendaftaran}}</h6>
                                    <h6 class="text-white">Jumlah Dilayani {{$dilayani_pendaftaran}}</h6>
                                    <p class="text-white mb-0">{{$tanggal}}</p>
                                </div>
                                <span class="float-right display-5 opacity-4"><i class="fa fa-users"></i></span>
                            </div>
                        </div>
                    </div>

                                    
               

                                   
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


                   
                </table>
            </div>
        </div>
    </div>
</div>


    @include('template.footer')