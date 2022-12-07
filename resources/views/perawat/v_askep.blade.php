@include('template.header')
@include('perawat.template.sidebar')
<div class="row page-titles mx-0">
    <div class="col p-md-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Asuhan Keperawatan</a></li>
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
                            @foreach($data as $datas)
                                <ul class="card-profile__info">
                                    <li class="mb-1"><strong class="text-dark mr-4">No. Pendaftaran</strong> <span>{{$datas->no_antrian}}</span></li>
                                    <li class="mb-1"><strong class="text-dark mr-4">Tanggal</strong> <span>{{$datas->updated_at}} </span></li>
                                    <li class="mb-1"><strong class="text-dark mr-4">No RM</strong> <span>{{$datas->no_rm}}</span></li>
                                    <li class="mb-1"><strong class="text-dark mr-4">Nama Lengkap</strong> <span>{{$datas->nama}}</span></li>
                                    <li class="mb-1"><strong class="text-dark mr-4">Tanggal Lahir</strong> <span>{{$datas->tanggal_lahir}}</span></li>
                                    <li class="mb-1"><strong class="text-dark mr-4">Umur</strong> <span>{{$datas->umur}}</span></li>
                                    <li class="mb-1"><strong class="text-dark mr-4">Status Pasien</strong> <span>{{$datas->jenis_asuransi}}</span></li>
                                    <li class="mb-1"><strong class="text-dark mr-4">Nama KK</strong> <span>{{$datas->nama_kk}}</span></li>
                                    <li class="mb-1"><strong class="text-dark mr-4">Pekerjaan</strong> <span>{{$datas->pekerjaan}}</span></li>
                                    <li class="mb-1"><strong class="text-dark mr-4">Poli Asal</strong> <span>{{$datas->poli_asal}}</span></li>
                                </ul>
                             @endforeach
                        </div>
                  
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-xl-9">
                <div class="card">
                    <div class="card-body">
                        <div>
                            <h1 class="text-muted mb-4" style="text-align: center;">Tambah Asuhan Keperawatan</h1>
                        </div>
                            <form class="ui form" enctype="multipart/form-data"  method="POST" action="/poliumumperawat" role="form">
                                <!-- <form class="ui form" action="/poliumumperawat/" method="post"> -->
                                @csrf
                                <input type="hidden" value="{{$data[0]->id_antrian}}" name="id_antrian" class="form-control">
                                <input type="hidden" value="{{$data[0]->no_rm}}" name="no_rm" class="form-control">
                                <input type="hidden" value="{{$data[0]->waktu_mulai}}" name="waktu_mulai" class="form-control">
                                <input type="hidden" value="perawat umum" name="penanggungjawab" class="form-control">
                                
                                            <div class="card-body">
                                                <div>
                                                    <h4 class="text-muted mb-4">Anamnesa</h4>
                                                </div>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label>RPK</label>
                                                                    <input type="text" name="rpk" class="form-control" placeholder="Riwayat Penyakit Keluarga" required autofocuse>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label>RPD</label>
                                                                    <input type="text" name="rpd" class="form-control" placeholder="Riwayat Penyakit Dulu" required autofocuse>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label>RPS</label>
                                                                    <input type="text" name="rps" class="form-control" placeholder="Riwayat Penyakit Sekarang" required autofocuse>
                                                            </div>
                                                        </div>
                                                    </div>  
                                                <div>
                                                    <h4 class="text-muted mb-4">Pemeriksaan Fisik</h4>
                                                </div>
                                                            <!-- <form action="#"> -->
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <label>TB</label>
                                                                <div class="input-group">
                                                                    <input type="text" id="tb" name="tb" class="form-control" placeholder="Tinggi Badan" required autofocuse >
                                                                    <span class="input-group-append">
                                                                        <span class="input-group-text">
                                                                        <a class="text-muted">cm</a>
                                                                        </span>
                                                                    </span>
                                                                </div>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <label>Sistol</label>
                                                                <div class="input-group">
                                                                    <input type="text" name="sistol" class="form-control" placeholder="Sistol" required autofocuse>
                                                                    <span class="input-group-append">
                                                                        <span class="input-group-text">
                                                                        <a class="text-muted">mmHg</a>
                                                                        </span>
                                                                    </span>
                                                                </div>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <label>BB</label>
                                                                <div class="input-group">
                                                                    <input type="text" id="bb" name="bb" class="form-control" placeholder="Berat Badan" onkeyup="cari();" required autofocuse>
                                                                    <span class="input-group-append">
                                                                        <span class="input-group-text">
                                                                        <a class="text-muted">Kg</a>
                                                                        </span>
                                                                    </span>
                                                                </div>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <label>Diastol</label>
                                                                <div class="input-group">
                                                                    <input type="text" name="diastol" class="form-control" placeholder="Diastol" required autofocuse>
                                                                    <span class="input-group-append">
                                                                        <span class="input-group-text">
                                                                        <a class="text-muted">mmHg</a>
                                                                        </span>
                                                                    </span>
                                                                </div>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <label>IMT</label>
                                                                <div class="input-group">
                                                                    <input type="text" id="imt" name="imt" class="form-control" placeholder="Index Massa" required autofocuse>
                                                                    <span class="input-group-append">
                                                                        <span class="input-group-text">
                                                                        <a class="text-muted">Kg/m2</a>
                                                                        </span>
                                                                    </span>
                                                                </div>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <label>Suhu</label>
                                                                <div class="input-group">
                                                                    <input type="text" name="suhu" class="form-control" placeholder="Suhu" required autofocuse>
                                                                    <span class="input-group-append">
                                                                        <span class="input-group-text">
                                                                        <a class="text-muted">'C</a>
                                                                        </span>
                                                                    </span>
                                                                </div>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label>Ket</label>
                                                                    <input type="text" id="ket" name="ket" class="form-control" readonly="true">
                                                            </div>
                                                        </div>
                                                                    
                                                        <div class="col-lg-6">
                                                            <label>RR</label>
                                                                <div class="input-group">
                                                                    <input type="text" name="nafas" class="form-control" placeholder="Jumlah Nafas" required autofocuse>
                                                                    <span class="input-group-append">
                                                                        <span class="input-group-text">
                                                                        <a class="text-muted">/menit</a>
                                                                        </span>
                                                                    </span>
                                                                </div>
                                                        </div>
                                                    </div>
                                                <div>
                                                    <h4 class="text-muted mb-4">Catatan Asuhan Keperawatan</h4>
                                                </div>
                                                            <!-- <form action="#"> -->
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label>Subjective</label>
                                                                    <input type="text" name="s" class="form-control" placeholder="Subjective" required autofocuse>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label>Objective</label>
                                                                    <input type="text" name="o" class="form-control" placeholder="Objective" required autofocuse>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label>Analysis</label>
                                                                    <input type="text" name="a" class="form-control" placeholder="Analysis" required autofocuse>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label>Planning</label>
                                                                    <input type="text" name="p" class="form-control" placeholder="Planning" required autofocuse>
                                                            </div>
                                                        </div>
                                                    </div>
                                            </div>  <!-- card body -->
                                        <!-- <div class="col-sm-2"> -->
                                            <button class="btn btn-lg btn-primary btn-block" type="submit">Simpan</button>
                                        <!-- </div> -->
                            </form>
                        <!-- </div>basic form -->
                    </div><!--card body-->
                </div><!-- div card -->
            <!-- </div> -->
        </div><!-- div class --> 
<!-- #/ container -->
    </div>
</div>


<!--**********************************
            Content body end
        ***********************************--> 

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script>
function cari() {
      var txtFirstNumberValue = document.getElementById("tb").value;
      var txtSecondNumberValue = document.getElementById("bb").value;
      var tb = txtFirstNumberValue*0.01;
      var result = (txtSecondNumberValue)/(tb*tb);
      var finalresult = result.toFixed(1)
         
         if(result < 17){
          document.getElementById("imt").value = finalresult;
          document.getElementById("ket").value = "sangat kurus";
         }
        else if(result > 17 && result <=18.4){
          document.getElementById("imt").value = finalresult;
          document.getElementById("ket").value = "kurus";
         }
        else if(result > 18.4 && result <=25){
          document.getElementById("imt").value = finalresult;
          document.getElementById("ket").value = "normal";
         }
          else if(result > 25 && result <=27){
            document.getElementById("imt").value = finalresult;
          document.getElementById("ket").value = "gemuk";
         }
         else{
          document.getElementById("imt").value = finalresult;
           document.getElementById("ket").value = "sangat gemuk";
         }
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
@include('template.footer')