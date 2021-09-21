@extends('managecp.app')

@section('dashboard_content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Jenis Bantuan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Jenis Bantuan</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card ovh">
            <div class="card-header">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Minimize">
                    <i class="fas fa-minus"></i>
                </button>


                <div class="card-tools">
                    <a href="{{route('jenisbantuan')}}"><button type="button" class="btn btn-tool btn-add" title="Tambah Jenis Bantuan">
                            <i class="fas fa-plus"></i> Tambah Data
                        </button></a>
                </div>
            </div>
            <div class="card-body p-0 ovsc">
                <table class="table table-striped projects">
                    <thead>
                        <tr>
                            <th style="width: 1%">
                                No
                            </th>
                            <th style="width: 50%">
                                Jenis Bantuan
                            </th>
                            <th style="width: 9%" class="text-center">
                                Status
                            </th>
                            <th style="width: 40%">
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(!empty(sizeof($results)))
                        @for ($i = 1; $i <= sizeof($results); $i++) <tr>
                            <td>
                                {{ $i }}
                            </td>
                            <td>
                                <a>
                                    {{$results[$i - 1]['jenis_bantuan']}}
                                </a>
                            </td>
                            <td class="project-state">
                                <?php $status = $results[$i - 1]['status']; ?>
                                @if($status == "actived")

                                <span class="badge badge-success">{{$results[$i - 1]['status']}}</span>

                                @else

                                <span class="badge badge-error">{{$results[$i - 1]['status']}}</span>

                                @endif

                            </td>
                            <td class="project-actions text-right">
                                <!-- <a id="detail_{{$i}}" class="btn btn-primary btn-sm" href="#">
                                        <i class="fas fa-folder">
                                        </i>
                                        View
                                    </a> -->
                                <a id="edit_{{$i}}" class="btn btn-info btn-sm" href="{{ route ('editjenisbantuan', $results[$i - 1]['id']) }}">
                                    <i class="fas fa-pencil-alt">
                                    </i>
                                    Edit
                                </a>
                                <form action="{{url('jenisbantuan/'.$results[$i - 1]['id'])}}" method="POST" class="form-line">
                                    @csrf
                                    @method('POST')
                                    <button class="btn btn-danger btn-sm" type="submit"><i class="fas fa-trash">
                                        </i> Delete</button>

                                </form>
                            </td>
                            </tr>
                            @endfor

                            @else
                            <tr>
                                <td colspan='4' class='text-center'>no row</td>
                            </tr>
                            @endif
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection