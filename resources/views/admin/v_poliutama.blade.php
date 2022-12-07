@include('template.header')
@include('admin.template.sidebar')
<div class="row page-titles mx-0">
    <div class="col p-md-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Data</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Level Pengguna</a></li>
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
                                    <th>No.</th>
                                    <th>Kode Poli</th>
                                    <th>Nama Poli</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $no = 1; ?>
                                @foreach($poli as $polis)
                                <tr>
                                    <td class=" text-center">{{$no}} </td>
                                    <td>{{$polis->kode_poli}} </td>
                                    <td>{{$polis->nama_poli}} </td>
                                </tr>
                                <?php $no++; ?>
                                @endforeach
                            </tbody>
                            <!-- <tfoot>
                                <tr>
                                    <th>No.</th>\
                                      <th>Kependekan Jaminan Kesehatan</th>
                                    <th>Nama Jaminan Kesehatan</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot> -->
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- #/ container -->
</div>
<!--**********************************
            Content body end
        ***********************************-->
@include('template.footer')     