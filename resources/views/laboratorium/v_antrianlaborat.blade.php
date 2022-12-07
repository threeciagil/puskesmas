@include('template.header')
@include('laboratorium.template.sidebar')
<div class="row page-titles mx-0">
    <div class="col p-md-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Antrian Poli Umum</a></li>
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
                                    <th class="text-center" style="width: 1px">No.</th>
                                    <th class="text-center" style="width: 5px">Nomor Antrian</th>
                                    <th class="text-center" style="width: 10px">Nama </th>
                                    <th class="text-center" style="width: 10px">Nomor Rekam Medis</th>
                                    <th class="text-center" style="width: 10px">Poli Asal</th>
                                    <!-- <th class="text-center" style="width: 10px">Status</th> -->
                                    <th class="text-center" style="width: 300px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $no = 1;
                                ?>
                            @foreach($antrian as $a)
                                <tr>
                                            <td class="text-center" style="width: 1px">{{$no}}</td>
                                            <td class="text-center" style="width: 5px">{{$a->no_antrian}}</td>
                                            <td class="text-center" style="width: 10px">{{$a->nama}} </td>
                                            <td class="text-center" style="width: 10px">{{$a->no_rm}} </td>
                                            <td class="text-center" style="width: 10px">{{$a->poli_asal}} </td>
                                            <!-- <td class="text-center" style="width: 10px">//{//{$a->status}} </td> -->
                                            <td class="text-center" style="width: 300px"><span>
                                                <button type="button" onclick="location.href='laboratpelayanan/{{$a->id_pemeriksaan}}/{{$a->no_rm}}'" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Layani">
                                                Layani
                                                </button>
                                                <!-- <button type="button" onclick="location.href='/pelayanankasir'" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Layani">
                                                Layani
                                                </button> -->
                                                <button type="button" onclick="panggil({{$a->id_antrian}},'{{$a->no_antrian}}');" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Panggil" id="panggil">
                                                Panggil
                                                </button>
                                                <a type="button" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus obat ini?')" href="hapusantrianlaborat/hapus/{{$a->id_antrian}}" data-toggle="tooltip" data-placement="top" title="Hapus">
                                               Hapus
                                                </a>
                                                <!-- <button type="button" class="btn btn-danger" onclick="location.href='hapusantrianlaborat/hapus/{{$a->id_antrian}}'" data-toggle="tooltip" data-placement="top" title="Hapus">
                                                    Hapus
                                                </button> -->
                                                <button type="button" class="btn btn-warning"  onclick="lewati({{$a->id_antrian}},{{$a->urutan}});"  data-toggle="tooltip" data-placement="top" title="Lewati">
                                                Lewati
                                                </button>
                                                </span>
                                            </td>
                                </tr>
                                <?php 
                                $no++;
                                ?>
                                @endforeach
                            </tbody>   
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- #/ container -->
    </div>
    <script
    src="https://code.jquery.com/jquery-2.2.4.js"
    integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI="
    crossorigin="anonymous">
</script>
<script type="text/javascript">
    window.Echo.channel('EveryoneChannel')
    .listen('.EveryoneMessage', function (e) {
    location.reload();
    })
</script>
<script>
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    })
    
    function panggil(a , b) {
        var timer = setInterval(function() {
            var voices = speechSynthesis.getVoices();
            // console.log(voices);
            if (voices.length !== 0) {
                var msg = new SpeechSynthesisUtterance('Nomor Antrian '+ b +', Silakan masuk ke Laboratorium');
                msg.rate = 0.8;
                msg.voice = voices[12];
                speechSynthesis.speak(msg);
                clearInterval(timer);
            }
        }, 200);
        var id = a;
        $.ajax({
                type:'GET',
                url: "{{ url('/antrianlaborat/panggil')}}"+'/'+a,               
                success: function( data ) {
                    console.log(data);
                }  
            });
    }
    
    function lewati(a , b) {
        var id = a;
        $.ajax({
                type:'GET',
                url: "{{ url('/antrianlaborat/lewati')}}"+'/'+id,               
                success: function( data ) {
                    if(data.success == true){
                        alert(data.message);
                        location.reload();
                    }
                }  
                // success: function( data ) {
                //     location.href="{{ url('/daftarantrian')}}"
                // }  
            });
    }
    </script>
         
    <script>
        // function deleteConfirm(url) {
        //     $('#btn-delete').attr('href', url);
        //     $('#deleteModal').modal();
        // }
    </script>
    <!--**********************************
            Content body end
        ***********************************-->
@include('template.footer')