@extends('managecp.app')

@section('dashboard_content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Penyaluran</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Penyaluran</a></li>
                        <li class="breadcrumb-item active">Buat Penyaluran</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <form id="form_penyaluran" action="add_penyaluran" method="POST">
            @csrf
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Tambah Data</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="inputNamaPenerima">Nama atau NIK Penerima</label>
                                <input type="text" name="inputNamaPenerima" id="inputNamaPenerima" class="form-control" required>
                                <div class="cover-search">
                                    <div class="row-search-penerima">
                                        <div class="row overflow-y-set"></div>
                                    </div>
                                </div>

                            </div>
                            <div class="form-group">
                                <label>Nama Barang</label><br>
                                @if(!empty(sizeof($barang)))
                                <div class="row">
                                    @for ($i = 1; $i <= sizeof($barang); $i++) 
                                    <div class="col-4">
                                        <input type="checkbox" id="inputNamaBarang{{$i}}" name="inputNamaBarang[]" value="{{$barang[$i - 1]['id']}}">
                                        <label for="inputNamaBarang{{$i}}" class="item-barang"> {{strtoupper($barang[$i - 1]['nama_barang'])}}</label><br>
                                    </div>
                                @endfor
                            </div>
                            @endif
                            <input class="nik_penerima" name="nik_penerima" type="hidden" value="">
                        </div>
                        <div class="form-group">
                            <label for="inputStatus">Status</label>
                            <select id="inputStatus" name="status" class="form-control custom-select" required>
                                <!-- <option selected disabled>Select one</option> -->
                                <option value="pending" selected>Pending</option>
                                <option value="completed">Diserahkan</option>
                            </select>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
</div>
<div class="row justify-content-center">
    <div class="col-6">
        <a href="{{route('penyaluranlist')}}" class="btn btn-secondary">Cancel</a>
        <input type="submit" value="Submit" class="btn btn-success float-right">
    </div>
</div>
</form>
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection