@extends('managecp.app')

@section('dashboard_content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Penerima</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{route('penerimalist')}}">Penerima</a></li>
                        <li class="breadcrumb-item active">Tambah Penerima</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <form id="dataImport" action="/getdataimportpenerima" method="POST" enctype="multipart/form-data">
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
                                <label for="inputNoSK">Nomor SK</label>
                                <input type="text" name="inputNoSK" id="inputNoSK" class="form-control" required>
                                <p id="inputNoSK-error" class="msg-error-field"></p>
                            </div>
                            <div class="form-group">
                                <label for="inputJenisBantuan">Jenis Bantuan</label>
                                <select id="inputJenisBantuan" name="inputJenisBantuan" class="form-control custom-select" required>
                                    <!-- <option selected disabled>Select one</option> -->
                                    @if(!empty(sizeof($jenisbantuan)))
                                    @for ($i = 1; $i <= sizeof($jenisbantuan); $i++) <option value="{{$jenisbantuan[$i - 1]['id']}}"> {{$jenisbantuan[$i - 1]['jenis_bantuan']}}</option>
                                        @endfor
                                        @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="inputKecamatan">Kecamatan</label>
                                <select id="inputKecamatan" onchange="GetKecamatan();" name="inputKecamatan" class="form-control custom-select" required>
                                    <option selected disabled>Select one</option>
                                    @if(!empty(sizeof($kecamatan)))
                                    @for ($i = 1; $i <= sizeof($kecamatan); $i++) <option value="{{$kecamatan[$i - 1]['id']}}"> {{$kecamatan[$i - 1]['kecamatan']}}</option>
                                        @endfor
                                        @endif
                                </select>
                                <p id="inputKecamatan-error" class="msg-error-field"></p>
                            </div>
                            <div class="form-group">
                                <label for="inputDesa">Nama Desa</label>
                                <select id="inputDesa" name="inputDesa" class="form-control custom-select" required>
                                    <option selected disabled></option>
                                </select>
                                <p id="inputDesa-error" class="msg-error-field"></p>
                            </div>
                            <div class="form-group">
                                <div class="upload_lampiran">
                                    <div>
                                        <label onclick="uploadlampiranpressed()" class="iconuploadlampiran" for="uploadDataPenerima"><i class="fa fa-paperclip" aria-hidden="true"></i></label>
                                        <!-- <input type="file" class="form-control-file" id="uploadDataPenerima" hidden> -->
                                        <input onchange="pressed()" class="form-control-file" type="file" id="uploadDataPenerima" name="uploadDataPenerima" required />
                                        <label id="fileLabel" for="uploadDataPenerima">Upload Penerima (.xlsx)</label>
                                    </div>
                                </div>
                                <p id="uploadDataPenerima-error" class="msg-error-field"></p>
                            </div>
                            <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-6">
                    <a href="{{route('penerimalist')}}" class="btn btn-secondary">Cancel</a>
                    <button id="submitDataPenerima" type="button" class="btn btn-success float-right">
                    <!-- data-toggle="modal" data-target="#importPenerimaModal" -->
                        Submit
                    </button>
                    <!-- <input type="submit" value="Import" class="btn btn-success float-right"> -->
                </div>
            </div>
        </form>

        <!-- Modal -->
        <div class="modal fade" id="importPenerimaModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Process Importing Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <table cellspacing="0" class="table table-striped projects process-data">
                            <thead>
                                <tr>
                                    <th style="width: 1%">
                                        No
                                    </th>
                                    <th style="width: 20%">
                                        NIK
                                    </th>
                                    <th style="width: 20%">
                                        KK
                                    </th>
                                    <th style="width: 20%">
                                        Nama
                                    </th>
                                    <th style="width: 30%">
                                        Alamat
                                    </th>
                                    <th style="width: 9%" class="text-center">
                                        Status
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="DataPenerimaLog">

                            </tbody>
                        </table>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button id="importDataPenerima" type="button" class="btn btn-primary">Import</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<script>
    // function submitDataPenerima() {
    //     let getFile = $('#uploadDataPenerima').val();
    //     let nameFile = $('#fileLabel').val();

    //     var form = $("#dataImport");
    //     $.ajax({
    //         type: form.attr('method'),
    //         url: form.attr('action'),
    //         data: form.serialize() + "&action=getDataImport&path=" + getFile,
    //         success: function(data) {
    //             var result = data;
    //             console.log(result);
    //             //$('#result').attr("value", result);

    //         }
    //     });
    // }

    function GetKecamatan() {
        let kecamatanid = $('#inputKecamatan').val();
        let token = $('#token').val();
        $.ajax({
            url: "getdesa",
            method: "POST",
            data: {
                "_token": token,
                "action": "getDataDesa",
                "data": kecamatanid
            },
            success: function(data) {
                var results = JSON.parse(data);
                $('#inputDesa').html('');
                if (results.length > 0) {
                    $.each(results, function(i, item) {
                        $('#inputDesa').append($('<option>', {
                            value: item.id,
                            text: item.desa
                        }));
                    });
                } else {
                    $('#inputDesa').html('<option selected disabled></option>');
                }



                // window.location.href = "/dashboard";
            }
        });
    }

    window.pressed = function() {
        // var btn_upload = $('#uploadLampiran').val();
        var a = document.getElementById('uploadDataPenerima');
        var fileLabel = document.getElementById('fileLabel');

        if (a.value == "") {
            fileLabel.innerHTML = "Upload Penerima (.xlsx)";
        } else {
            var theSplit = a.value.split('\\');
            fileLabel.innerHTML = theSplit[2];
        }

    }
</script>
<!-- /.content-wrapper -->
@endsection