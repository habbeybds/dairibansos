@extends('managecp.app')

@section('dashboard_content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Desa</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Desa</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <form action="{{$data['action']}}" method="{{$data['method']}}">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Ubah Data</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="inputKecamatan">Kecamatan</label>
                                <select id="inputKecamatan" name="inputKecamatan" class="form-control custom-select" required>
                                    <!-- <option selected disabled>Select one</option> -->
                                    @if(!empty(sizeof($kecamatan)))
                                        @for ($i = 1; $i <= sizeof($kecamatan); $i++)
                                            @if ($kecamatan[$i - 1]['id'] == $data['data']['kecamatanid'])
                                            <option value="{{$kecamatan[$i - 1]['id']}}" selected> {{$kecamatan[$i - 1]['kecamatan']}}</option>
                                            @else
                                            <option value="{{$kecamatan[$i - 1]['id']}}"> {{$kecamatan[$i - 1]['kecamatan']}}</option>
                                            @endif
                                        
                                        @endfor
                                    @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="inputDesa">Nama Desa</label>
                                <input type="text" name="inputDesa" id="inputDesa" value="{{$data['data']['desa']}}" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="inputStatus">Status</label>
                                <select id="inputStatus" name="status" class="form-control custom-select" required>
                                    <!-- <option selected disabled>Select one</option> -->
                                    @if($data['data']['status'] == 'actived')
                                    <option value="actived" selected>Actived</option>
                                    <option value="cancelled">Cancelled</option>
                                    @else
                                    <option value="actived">Actived</option>
                                    <option value="cancelled" selected>Cancelled</option>
                                    @endif
                                </select>
                            </div>

                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <a href="{{route('desalist')}}" class="btn btn-secondary">Cancel</a>
                    <input type="submit" value="{{$data['nama_tombol']}}" class="btn btn-success float-right">
                </div>
            </div>
        </form>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection