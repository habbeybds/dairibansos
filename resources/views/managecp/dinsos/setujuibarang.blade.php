@extends('managecp.app')

@section('dashboard_content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Setujui Pengajuan Barang</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Setujui Barang</li>
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
            </div>
            <div class="card-body p-0 ovsc">
                <table class="table table-striped projects">
                    <thead>
                        <tr>
                            <th style="width: 1%">
                                No
                            </th>
                            <th style="width: 20%">
                                Agen
                            </th>
                            <th style="width: 10%">
                                Kode
                            </th>
                            <th style="width: 10%">
                                Barang
                            </th>
                            <th style="width: 10%">
                                Satuan
                            </th>
                            <th style="width: 10%">
                                Harga
                            </th>
                            <th style="width: 10%">
                                Stok
                            </th>
                            <th style="width: 9%" class="text-center">
                                Status
                            </th>
                            <th style="width: 20%">
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(!empty(sizeof($results)))
                        @for ($i = 1; $i <= sizeof($results); $i++) <?php $currency_format = "Rp " . number_format($results[$i - 1]['harga'], 0, ',', '.'); ?> <tr class="row-{{$results[$i - 1]['id']}}">
                            <td>
                                {{ $i }}
                            </td>
                            <td>
                                <a>
                                    {{$results[$i - 1]['first_name'].' '.$results[$i - 1]['last_name']}}
                                </a>
                            </td>
                            <td>
                                <a>
                                    {{strtoupper($results[$i - 1]['kode_barang'])}}
                                </a>
                            </td>
                            <td>
                                <a>
                                    {{$results[$i - 1]['nama_barang']}}
                                </a>
                            </td>
                            <td>
                                <a>
                                    {{ucfirst($results[$i - 1]['satuan'])}}
                                </a>
                            </td>
                            <td>
                                <a>
                                    {{$currency_format}}
                                </a>
                            </td>
                            <td>
                                <a>
                                    {{$results[$i - 1]['stok']}}
                                </a>
                            </td>
                            <td class="project-state">
                                <?php $status = $results[$i - 1]['status']; ?>
                                @if($status == "pending")

                                <span class="badge badge-pending">{{$results[$i - 1]['status']}}</span>

                                @elseif ($status == "approved")

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
                                <?php $barang_id = $results[$i - 1]['id']; ?>
                                <a id="edit_{{$i}}" onclick="SetApprovedBarang('{{$barang_id}}');" class="btn btn-success btn-sm">
                                    Approve
                                </a>
                                <a id="edit_{{$i}}" onclick="SetCancelledBarang('{{$barang_id}}');" class="btn btn-danger btn-sm">
                                    Cencel
                                </a>
                            </td>
                            </tr>
                            @endfor

                            @else
                            <tr>
                                <td colspan='9' class='text-center'>no row</td>
                            </tr>
                            @endif
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->



        <!-- Telah Disetujui -->
        <div class="content-header">
            <h1>Telah Disetuju</h1>
        </div>
        @csrf
        <div class="card ovh">
            <div class="card-header">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Minimize">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
            <div class="card-body p-0 ovsc">
                <table class="table table-striped projects">
                    <thead>
                        <tr>
                            <th style="width: 30%">
                                Agen
                            </th>
                            <th style="width: 10%">
                                Kode
                            </th>
                            <th style="width: 20%">
                                Barang
                            </th>
                            <th style="width: 10%">
                                Satuan
                            </th>
                            <th style="width: 20%">
                                Harga
                            </th>
                            <th style="width: 10%">
                                Stok
                            </th>
                        </tr>
                    </thead>
                    <tbody id="BarangListTable">
                        @if(!empty(sizeof($results_disetujui)))
                        @for ($i = 1; $i <= sizeof($results_disetujui); $i++) <?php $currency_format = "Rp " . number_format($results_disetujui[$i - 1]['harga'], 0, ',', '.'); ?> <tr>
                            <td>
                                <a>
                                    {{$results_disetujui[$i - 1]['first_name'].' '.$results_disetujui[$i - 1]['last_name']}}
                                </a>
                            </td>
                            <td>
                                <a>
                                    {{strtoupper($results_disetujui[$i - 1]['kode_barang'])}}
                                </a>
                            </td>
                            <td>
                                <a>
                                    {{$results_disetujui[$i - 1]['nama_barang']}}
                                </a>
                            </td>
                            <td>
                                <a>
                                    {{ucfirst($results_disetujui[$i - 1]['satuan'])}}
                                </a>
                            </td>
                            <td>
                                <a>
                                    {{$currency_format}}
                                </a>
                            </td>
                            <td>
                                <a>
                                    {{$results_disetujui[$i - 1]['stok']}}
                                </a>
                            </td>
                            </tr>
                            @endfor

                            @else
                            <tr id="no-row">
                                <td colspan='7' class='text-center'>no row</td>
                            </tr>
                            @endif
                    </tbody>
                </table>
                <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
            </div>
            <!-- /.card-body -->
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script>
    $('#BarangListTable').html('<tr class="text-center"><td colspan="9">no row</td></tr>');
    function SetCancelledBarang(barangid) {
        let token = $('#token').val();
        $.ajax({
            url: "cancelBarang",
            method: "POST",
            data: {
                "_token": token,
                "data": barangid,
            },
            success: function(data) {
                let results = JSON.parse(data);

                if (results.code == 200) {

                    $('.row-' + barangid).html('');

                    alert("data barang berhasil di tolak");

                }
            }
        });
    }

    function SetApprovedBarang(barangid) {
        let token = $('#token').val();
        $.ajax({
            url: "approveBarang",
            method: "POST",
            data: {
                "_token": token,
                "data": barangid,
            },
            success: function(data) {
                let results = JSON.parse(data);

                if (results.code == 200) {

                    $('.row-' + barangid).html('');

                    let barangs = results.data;

                    if (barangs.length > 0) {
                        $('#no-row').html('');
                        $.each(barangs, function(i, item) {
                            var harga = item.harga;
                            var format_harga = parseInt(harga).toLocaleString();
                            var satuan = item.satuan[0].toUpperCase() + item.satuan.slice(1);

                            $('#BarangListTable').append('').delay(50).queue(function(next) {
                                $(this).append('<tr id="hasil-row-' + item.id + '">' +
                                    '<td>' + item.first_name + ' ' + item.last_name + '</td>' +
                                    '<td>' + item.kode_barang.toUpperCase() + '</td>' +
                                    '<td>' + item.nama_barang + '</td>' +
                                    '<td>' + satuan + '</td>' +
                                    '<td>' + 'Rp ' + format_harga + '</td>' +
                                    '<td>' + item.stok + '</td>' +
                                    '</tr>');
                                $('#hasil-row-' + item.id).addClass('tr-process-data-barang');
                                next();
                            }).delay(300).queue(function(next) {
                                $('#hasil-row-' + item.id).removeClass('tr-process-data-barang');
                                next();
                            });
                        });


                    } else {
                        $('#BarangListTable').html('<tr class="text-center"><td colspan="9">no row</td></tr>');
                    }

                }
            }
        });
    };
</script>
@endsection