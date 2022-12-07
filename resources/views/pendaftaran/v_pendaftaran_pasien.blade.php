@include('template.header')
@include('pendaftaran.template.sidebar')
<!--**********************************
            Content body start
        ***********************************-->

<div class="row page-titles mx-0">
    <div class="col p-md-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)"></a>Family Folder</li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)"></a>Data Pasien</li>
        </ol>
    </div>
</div>

<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <h1 class="h1 font-weight-normal" style="text-align: center;">Pendaftaran Pasien</h1>
            <div class="basic-form">
                <form class="ui form" action="/pendaftaranpasien/" method="post">
                @csrf <!-- {{ csrf_field() }} -->

                    <div class="form-row">
                        <div class="form-group row col-md-6">
                            <label class="col-sm-4 col-form-label">No. Antrian</label>
                            <div class="col-sm-6">
                                <input type="text" name="noantrian" value="{{$data['no_antrian_pendaftaran']}}" class="form-control" placeholder="No. Antrian" readonly="true">
                                <input type="hidden" name="no_rm" value="{{$data['no_rm']}}" class="form-control">
                                <input type="hidden" name="id_antrian" value="{{$data['id_antrian']}}" class="form-control">
                            </div>
                        </div>
                        <!-- <div class="form-group row col-md-6">
                        <label class="col-sm-4 col-form-label">Nomor Rekam Medis</label>
                        <div class="col-sm-6">
                            <input type="text" name="no_rm" class="form-control" placeholder="Nomor Rekam Medis" required autofocuse>
                        </div>
                    </div> -->
                    </div>

                    <div class="form-row">
                        <div class="form-group row col-md-6">
                            <label class="col-sm-4 col-form-label">Nama Lengkap</label>
                            <div class="col-sm-6">
                                <input type="text" name="nama" value="{{$data['data_pasien'][0]->nama}}" class="form-control" placeholder="No. Antrian" readonly="true">
                            </div>
                        </div>
                        <div class="form-group row col-md-6">
                            <label class="col-sm-4 col-form-label">Umur</label>
                            <div class="col-sm-6">
                                <label>{{$data['data_pasien'][0]->umur}}</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group row col-md-6">
                            <label class="col-sm-4 col-form-label">Asuransi</label>
                            <div class="col-sm-6">
                                <select id="inputState" name="jenis_asuransi" id="jenis_asuransi" class="form-control" required autofocuse disabled>
                                    @foreach($data['jamkes'] as $j):
                                        @if($j->singkatan_jamkes == $data['data_pasien'][0]->jenis_asuransi)
                                            <option value="{{$j->singkatan_jamkes}}" selected>{{ $j->singkatan_jamkes }}</option>
                                        @else:
                                            <option value="{{$j->singkatan_jamkes}}">{{ $j->singkatan_jamkes }}</option>
                                        @endif;
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row col-md-6">
                            <label class="col-sm-4 col-form-label">No. Asuransi</label>
                            <div class="col-sm-6">
                                <input type="text" name="no_asuransi" id="no_asuransi" class="form-control" placeholder="Nomor Asuransi" value="{{ $data['data_pasien'][0]->no_asuransi }}" >
                                <a onclick="cekbpjs()"class="btn btn-success text-white float-right mt-2" id="button_bpjs" >Cek Asuransi</a>            
                            </div>
                           
                            <!-- <div class="col-sm-2">
                            <button type="" class="btn btn-dark">Cek</button>
                        </div> -->
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group row col-md-6">
                            <label class="col-sm-4 col-form-label">Jenis Kelamin</label>
                            <div class="col-sm-6">
                                <label>{{ $data['data_pasien'][0]->jenis_kelamin }}</label>
                            </div>
                        </div>
                        <div class="form-group row col-md-6">
                            <label class="col-sm-4 col-form-label">No. HP</label>
                            <div class="col-sm-6">
                                <input type="text" name="no_hp" class="form-control" placeholder="Nomor HP/Telepon" value="{{ $data['data_pasien'][0]->telp }}" required></input>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group row col-md-6">
                            <label class="col-sm-4 col-form-label">Nomor Rekam Medis</label>
                            <div class="col-sm-6">
                                <input type="text" name="rm" class="form-control" placeholder="Nomor Rekam Medis" value="{{ $data['no_rm'] }}" required autofocuse></input></input>
                            </div>
                        </div>
                        <div class="form-group row col-md-6">
                            <label class="col-sm-4 col-form-label">Poli Tujuan</label>
                            <div class="col-sm-6">
                                <label>Poli Umum</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group row col-md-6">
                            <label class="col-sm-4 col-form-label">Kunjungan</label>
                            <div class="col-sm-6">
                                @if($data['cek'] < 1)
                                    @php
                                        $val = "Baru";
                                    @endphp
                                @else
                                    @php
                                        $val = "Lama";
                                    @endphp
                                @endif
                                <input type="text" name="tipe_kunjungan" class="form-control" placeholder="Kunjungan" value="{{ $val }}" required readonly>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary ">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script
    src="https://code.jquery.com/jquery-2.2.4.js"
    integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI="
    crossorigin="anonymous">

    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    })
 </script>
 <script>   
//   function isbpjs() {
//         var asuransi = document.getElementById('jenis_asuransi').value;
        
//         if(asuransi==="BPJS"){
//             // $('#button_bpjs').attr('disabled','disabled');
//             $("#button_bpjs").removeAttr('disabled');
//             $("#no_asuransi").removeAttr('readonly');
//         }else{
//             $("#button_bpjs").attr('disabled', 'true');
//             $("#no_asuransi").attr('readonly', 'false');
//         }
//     }
    function cekbpjs() {
        var no_asuransi = document.getElementById("no_asuransi");
        if (no_asuransi && no_asuransi.value) {
            $.ajax({
                type:'GET',
                url: "{{ url('/cekbpjs/')}}"+'/'+no_asuransi.value,               
                success: function( data ) {
                    alert(data);
                }  
            });
        }else{
            alert("nomor asuransi belum diisi");
        }
    }

</script>
@include('template.footer')
