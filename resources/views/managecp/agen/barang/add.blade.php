@extends('managecp.app')

@section('dashboard_content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Barang</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Tambah Barang</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <form action="add_barang" method="POST">
            @csrf
            <div class="row">
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
                                <label for="inputKodeBarang">Koda Barang</label>
                                <input type="text" name="inputKodeBarang" id="inputKodeBarang" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="inputNamaBarang">Nama Barang</label>
                                <input type="text" name="inputNamaBarang" id="inputNamaBarang" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="inputSatuan">Satuan</label>
                                <select id="inputSatuan" name="inputSatuan" class="form-control custom-select" required>
                                    <!-- <option selected disabled>Select one</option> -->
                                    @if(!empty(sizeof($satuan_barang)))
                                    @for ($i = 1; $i <= sizeof($satuan_barang); $i++) <option value="{{$satuan_barang[$i - 1]}}"> {{$satuan_barang[$i - 1]}}</option>
                                        @endfor
                                        @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="inputHarga">Harga</label>
                                <input type="text" name="inputHarga" id="inputHarga" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="inputStok">Stok</label>
                                <input type="number" name="inputStok" id="inputStok" class="form-control" required>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <a href="{{route('baranglist')}}" class="btn btn-secondary">Cancel</a>
                    <input type="submit" value="Submit" class="btn btn-success float-right">
                </div>
            </div>
        </form>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection