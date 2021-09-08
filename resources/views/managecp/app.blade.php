<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <!-- SEO Meta Tags -->
    <meta name="description" content="Layanan Bantuan Sosial Sembako Kabupaten Dairi">
    <meta name="author" content="Dinas Komunikasi dan Informatika Kabupaten Dairi">

    <!-- Favicon -->
    <link href="{{ asset('assets') }}/favicon.ico" rel="icon" type="image/png">

    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css" />

    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v5.15.3/js/all.js" crossorigin="anonymous"></script>
    <link href="{{ asset('assets') }}/vendor/@fortawesome/font-awesome-v4/css/font-awesome.min.css" rel="stylesheet">

    <!-- Style -->
    <link href="{{ asset('assets') }}/vendor/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css" rel="stylesheet"/> -->
    <link href="{{ asset('assets') }}/vendor/bootstrap-datepicker/dist/css/bootstrap-datepicker3.min.css" rel="stylesheet">
    <link href="{{ asset('assets') }}/vendor/owlcarousel/css/owl.carousel.min.css" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets') }}/vendor/owlcarousel/css/owl.theme.default.css" rel="stylesheet" type="text/css">
    <link href="{{ asset('css') }}/styles.css" rel="stylesheet">
    <link href="{{ asset('css') }}/custom.css" rel="stylesheet">
    <title>Bansos Dairi</title>


    <!-- javascript -->
    <script src="{{ asset('assets') }}/vendor/jquery/dist/jquery.min.js"></script>
    <script src="{{ asset('assets') }}/vendor/jquery/dist/jquery-3.2.1.slim.min.js"></script>
    <script src="{{ asset('assets') }}/vendor/owlcarousel/js/owl.carousel.js"></script>

</head>

<body>


    @yield('dashboard_content')


    <!-- Bootstrap core JS-->


    <script src="{{ asset('assets') }}/vendor/jquery/dist/jquery.min.js"></script>

    <script src="{{ asset('assets') }}/vendor/popper/popper.min.js"></script>
    <script src="{{ asset('assets') }}/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets') }}/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script> -->
    <script src="{{ asset('js') }}/api_get.js"></script>

    <!-- Core theme JS-->
    <script src="{{ asset('js') }}/scripts.js"></script>
    <script src="{{ asset('js') }}/custom.js"></script>


</body>


</html>