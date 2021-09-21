<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Bansos Dairi</title>
    <!-- Favicon -->
    <link href="{{ asset('assets') }}/favicon.ico" rel="icon" type="image/png">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link href="{{ asset('assets') }}/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('managecp') }}/dist/css/adminlte.min.css">

    <!-- custom css -->
    <link rel="stylesheet" href="{{ asset('managecp') }}/dist/css/custom.css">



</head>
<!--
`body` tag options:

  Apply one or more of the following classes to to the body tag
  to get the desired effect

  * sidebar-collapse
  * sidebar-mini
-->

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        @include('managecp.navbars.navbar')

        @include('managecp.sidebars.sidebar')

        @include('sweetalert::alert')

        @yield('dashboard_content')

        @include('managecp.sidebars.control-sidebar')

        @include('managecp.footers.footer')
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="{{ asset('assets') }}/vendor/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('assets') }}/vendor/popper/popper.min.js"></script>
    <script src="{{ asset('assets') }}/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

    <!-- AdminLTE -->
    <script src="{{ asset('managecp') }}/dist/js/adminlte.js"></script>

    <!-- OPTIONAL SCRIPTS -->
    <script src="{{ asset('assets') }}/vendor/chart.js/Chart.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('managecp') }}/dist/js/demo.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ asset('managecp') }}/dist/js/pages/dashboard3.js"></script>

    <script>
        var results_penerima = [];
        var nomor_sk = '';
        var jenis_bantuan_id = '';
        var tahapan_bantuan = '';

        let input_harga = document.getElementById('inputHarga');
        if (input_harga) {
            input_harga.addEventListener('keyup', function(e) {
                // tambahkan 'Rp.' pada saat form di ketik
                // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
                input_harga.value = formatRupiah(this.value, 'Rp. ');
            });
        }


        $("#submitDataPenerima").click(function(e) {

            e.preventDefault();

            var nomorSK = $('#inputNoSK').val();
            var jenisbantuanID = $('#inputJenisBantuan').val();

            var formData = new FormData($('#dataImport')[0]);
            formData.append('uploadDataPenerima', $('input[type=file]')[0].files[0]);

            var form = $("#dataImport");
            $('#DataPenerimaLog').html('');


            $.ajax({
                type: form.attr('method'),
                cache: false,
                contentType: false,
                processData: false,
                url: form.attr('action'),
                data: {
                    formData,
                    "nomor_SK": nomorSK,
                    "jenisbantuanid": jenisbantuanID,
                },
                data: formData,
                success: function(data) {

                    $('#inputNoSK-error').html('');
                    $('#inputKecamatan-error').html('');
                    $('#inputDesa-error').html('');
                    $('#uploadDataPenerima-error').html('');

                    results = JSON.parse(data);

                    if (results.code == 200) {

                        $('#importPenerimaModal').modal('show');

                        let penerima = results.data.penerima;

                        if (penerima.length > 0) {
                            $.each(penerima, function(i, item) {
                                $('#DataPenerimaLog').append('').delay(50).queue(function(next) {
                                    $(this).append('<tr class="tr-process-data">' +
                                        '<td>' + (i + 1) + '</td>' +
                                        '<td>' + item.nik + '</td>' +
                                        '<td>' + item.no_kk + '</td>' +
                                        '<td>' + item.name + '</td>' +
                                        '<td>' + item.alamat + '</td>' +
                                        '<td>' + item.status_kawin + '</td>' +
                                        '</tr>');
                                    next();
                                });;
                            });

                            /* Parsing Data to Button Import */

                            results_penerima = penerima;
                            nomor_sk = results.data.nomor_sk;
                            jenis_bantuan_id = results.data.jenisbantuan_id;
                            tahapan_bantuan = results.data.tahapan;

                        } else {
                            $('#DataPenerimaLog').html('<tr class="text-center"><td colspan="6">no data import</td></tr>');
                        }

                    } else {
                        if (results.error_details != "") {
                            let error_details = results.error_details;
                            var IndexValue = ['inputNoSK', 'inputKecamatan', 'inputDesa', 'uploadDataPenerima', ];
                            if (IndexValue[0] in error_details) {
                                $('#inputNoSK-error').html(results.error_details.inputNoSK[0]);
                            } else {
                                $('#inputNoSK-error').html('');
                            }
                            if (IndexValue[1] in error_details) {
                                $('#inputKecamatan-error').html(results.error_details.inputKecamatan[0]);
                            } else {
                                $('#inputKecamatan-error').html('');
                            }
                            if (IndexValue[2] in error_details) {
                                $('#inputDesa-error').html(results.error_details.inputDesa[0]);
                            } else {
                                $('#inputDesa-error').html('');
                            }
                            if (IndexValue[3] in error_details) {
                                $('#uploadDataPenerima-error').html(results.error_details.uploadDataPenerima[0]);
                            } else {
                                $('#uploadDataPenerima-error').html('');
                            }
                        } else {
                            alert(results.message);
                        }
                    }

                }
            });
        });

        $("#importDataPenerima").click(function(e) {

            let token = $('#token').val();
            var form = $("#dataImport");

            $.ajax({
                url: "submitimportpenerima",
                method: "POST",
                async: false,
                data: {
                    "_token": token,
                    "data": results_penerima,
                    "nomor_SK": nomor_sk,
                    "jenisbantuanid": jenis_bantuan_id,
                    "tahapanBantuan": tahapan_bantuan,
                },
                success: function(data) {
                    if (data == "true") {
                        alert("Berhasil import data pengguna!");
                        window.location.href = "/penerimalist";
                    } else if (data == "false") {
                        alert("Gagal import karena data penerima tidak ada!");
                        $('#importPenerimaModal').modal('toggle');
                    } else {
                        alert("Error Silahkan coba lagi!");
                        $('#importPenerimaModal').modal('toggle');
                    }

                }
            });
        });

        /* Fungsi formatRupiah */
        function formatRupiah(angka, prefix) {
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            // tambahkan titik jika yang di input sudah menjadi angka ribuan
            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
        }

        $("#form_penyaluran #inputNamaPenerima").on('keyup', function(e) {
            let token = $('#token').val();
            let value_search_nama_penerima = $(this).val();
            let path = '{{route("autocompletepenerima")}}';

            if (value_search_nama_penerima.length > 4) {
                $.ajax({
                    url: path,
                    method: "GET",
                    async: false,
                    data: {
                        "_token": token,
                        "data": value_search_nama_penerima,
                    },
                    success: function(data) {
                        $('.row-search-penerima').show();
                        $('.row-search-penerima').children().html('');

                        results = JSON.parse(data);

                        if (results.length > 0) {
                            let row_results = '';
                            $.each(results, function(i, item) {
                                row_results += '<div class="col-12 row-result">' +
                                    '<div class="item-name" onclick="choosePenerima(\''+i+'\',\''+item.nik+'\',\''+item.name+'\');">' +
                                    item.name +
                                    '</div>' +
                                    '</div>';
                            })
                            $('.row-search-penerima').children().append(row_results);
                        }

                    }
                });
            } else {
                $('.row-search-penerima').children().html('');
            }
        });

        function choosePenerima(i,nik_penerima,name_penerima) {
            $('.row-search-penerima').children().html('');
            $('.nik_penerima').val(nik_penerima);
            $('#inputNamaPenerima').val(name_penerima);
        }
    </script>
</body>

</html>