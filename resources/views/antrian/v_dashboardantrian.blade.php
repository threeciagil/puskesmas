@include('antrian.template.header')
<!-- row -->
<div class="content-body">
    <div class="card-body pb-0 d-flex justify-content-between">
    <!-- <div class="row justify-content-center "> -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-sm-5">
                        <!-- <div class="card">
                            <div class="card-body"> -->
                            <div class="card gradient-1">
                                    <div class="card-body">
                                        <h1 class="card-title text-white">Pendaftaran</h1>
                                        <div class="d-inline-block">
                                            <h2 class="card-title text-white" id="no_pendaftaran">000</h2>
                                            <p>Total Antrian</p>
                                        </div>
                                        <span class="float-right display-7 opacity-4"><i class="fa fa-users"></i></span>
                                    </div>
                                </div>
                                <div class="card gradient-1">
                                    <div class="card-body">
                                        <h1 class="card-title text-white">Poli Umum</h1>
                                        <div class="d-inline-block">
                                            <h2 class="card-title text-white" id="no_poli_umum">000</h2>
                                            <p>Total Antrian</p>
                                        </div>
                                        <span class="float-right display-7 opacity-4"><i class="fa fa-user-md"></i></span>
                                    </div>
                                </div>
                                <!-- <div class="card gradient-1">
                                    <div class="card-body">
                                        <h1 class="card-title text-white">Laboratorium</h1>
                                        <div class="d-inline-block">
                                            <h2 class="card-title text-white">A001</h2>
                                            <p>Total Antrian</p>
                                        </div>
                                        <span class="float-right display-7 opacity-4"><i class="fa fa-users"></i></span>
                                    </div>
                                </div>
                                <div class="card gradient-1">
                                    <div class="card-body">
                                        <h1 class="card-title text-white">Farmasi</h1>
                                        <div class="d-inline-block">
                                            <h2 class="card-title text-white">A001</h2>
                                            <p>Total Antrian</p>
                                        </div>
                                        <span class="float-right display-7 opacity-4"><i class="fa fa-users"></i></span>
                                    </div>
                                </div>
                            <div class="card gradient-1">
                                <div class="card-body">
                                    <h1 class="card-title text-white">Kasir</h1>
                                    <div class="d-inline-block">
                                        <h2 class="card-title text-white">A001</h2>
                                        <p>Total Antrian</p>
                                    </div>
                                    <span class="float-right display-7 opacity-4"><i class="fa fa-users"></i></span>
                                </div> 
                            </div> -->
                        <!-- </div> -->
                    <!-- </div> -->
                </div>
                <div class="col-xl-6 " id="panggilan">
                    <div class="card gradient-7">
                        <div class="card-body">
                            <div id="message"></div>
                            <h1 class="text-white" id="nama_poli">Poli</h1>
                            <div class="d-inline-block">
                                <h1 class="card-title text-white" >Nomor Antrian</h1>
                                <br>
                                <h1 class="text-white" id="nomor_antrian">000</h1>
                            </div>
                            <span class="float-right display-4 opacity-4"><i class="fa fa-user-md"></i></span>
                        </div> 
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-3 col-sm-6">
                    <div class="card gradient-1">
                        <div class="card-body">
                           <h1 class="card-title text-white">Laboratorium</h1>
                            <div class="d-inline-block">
                                <h2 class="card-title text-white"  id="no_lab">000</h2>
                                <p>Total Antrian</p>
                            </div>
                            <span class="float-right display-7 opacity-4"><i class="fa fa-heartbeat"></i></span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="card gradient-1">
                        <div class="card-body">
                            <h1 class="card-title text-white">Farmasi</h1>
                            <div class="d-inline-block">
                                <h2 class="card-title text-white"  id="no_farmasi">000</h2>
                                <p>Total Antrian</p>
                            </div>
                            <span class="float-right display-7 opacity-4"><i class="fa fa-medkit"></i></span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="card gradient-1">
                        <div class="card-body">
                            <h1 class="card-title text-white">Kasir</h1>
                            <div class="d-inline-block">
                                <h2 class="card-title text-white"  id="no_kasir">000</h2>
                                <p>Total Antrian</p>
                            </div>
                            <span class="float-right display-7 opacity-4"><i class="fa fa-money"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--**********************************
            Content body end
        ***********************************-->
@include('template.footer')
<script
    src="https://code.jquery.com/jquery-2.2.4.js"
    integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI="
    crossorigin="anonymous">
</script>
<script type="text/javascript">
    window.Echo.channel('PanggilanChannel')
    .listen('.PanggilanMessage', function (e) {
        console.log(e);
        // document.getElementById("message").innerHTML = e.message.nama_poli;
        document.getElementById("nama_poli").innerHTML = e[0].nama_poli;
        var nomor = document.getElementById("nomor_antrian");
        var kode1 = "00";
        var kode2 ="0"; 
        var nomor_pendaftaran = document.getElementById("no_pendaftaran");
        // var nomor_awal = e[0].no_antrian;
        // if(e[0].no_antrian<10){
        //     nomor.innerHTML = e[0].kode_poli.concat(" ", kode1," ",e[0].no_antrian);            
        // }
        // else{
        //     nomor.innerHTML =  e[0].kode_poli.concat(" ", kode2,e[0].no_antrian);
        // }

        if(e[0].nama_poli == "Pendaftaran"){
            if(e[0].no_antrian<10){
                nomor.innerHTML = e[0].kode_poli.concat(" ", kode1," ",e[0].no_antrian); 
                nomor_pendaftaran.innerHTML = e[0].kode_poli.concat(" ", kode1," ",e[0].no_antrian);
            }
            else{
                nomor.innerHTML =  e[0].kode_poli.concat(" ", kode2,e[0].no_antrian);
                nomor_pendaftaran.innerHTML =  e[0].kode_poli.concat(" ", kode2,e[0].no_antrian);
            }
        }
        else if(e[0].nama_poli == "Poli Umum"){
            nomor.innerHTML = e[0].no_antrian; 
            document.getElementById("no_poli_umum").innerHTML = e[0].no_antrian;
        }
         else if(e[0].nama_poli == "Laboratorium"){
            nomor.innerHTML = e[0].no_antrian; 
            document.getElementById("no_lab").innerHTML = e[0].no_antrian;
        }
        else if(e[0].nama_poli == "Farmasi"){
            nomor.innerHTML = e[0].no_antrian; 
            document.getElementById("no_farmasi").innerHTML = e[0].no_antrian;
        }
        else if(e[0].nama_poli == "Kasir"){
            nomor.innerHTML = e[0].no_antrian; 
            document.getElementById("no_kasir").innerHTML = e[0].no_antrian;
        }
    })
</script>