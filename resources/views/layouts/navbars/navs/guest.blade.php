<!-- Navigation-->
<nav class="navbar navbar-expand-lg bg-transparant text-uppercase fixed-top" id="mainNav">
    <div class="container">
        <!-- ***** Logo Start ***** -->
        <a href="#page-top" class="navbar-brand page-scroll logo"><img width="40px" src="{{ asset('assets') }}/img/pemkabdairi.png" alt=""> Bansos Dairi</a>
        <!-- ***** Logo End ***** -->
        <button class="navbar-toggler text-uppercase font-weight-bold bg-hamburger text-white rounded" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            Menu
            <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded page-scroll" href="#page-top">HOME</a></li>
                <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded page-scroll" href="#about">TENTANG</a></li>
                <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded page-scroll" href="#other-website">SITUS TERKAIT</a></li>
                <li class="nav-item mx-0 mx-lg-1"><button id="btn-masuk" class="nav-link py-3 px-0 px-lg-3 rounded btn-masuk">MASUK</button></li>
            </ul>
        </div>

        <!-- <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item {{  $initial === 'welcome' ? 'active' : ' ' }}">
                    <a class="nav-link" href="{{ route('welcome') }}">Beranda <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item {{  $initial === 'lapor' ? 'active' : ' ' }}">
                    <a class="nav-link" href="#">Laporan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Berita</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Hubungi Kami</a>
                </li>
                <li class="nav-item">
                    <div class="btn-register" data-toggle="modal" data-target="#registerModal">
                        <a class="nav-link" href="#">{{ __('Daftar') }}</a>
                    </div>
                </li>
                <li class="nav-item">
                    <div class="btn-login" data-toggle="modal" data-target="#loginModal">
                        <a class="nav-link" href="#">{{ __('Masuk') }}</a>
                    </div>
                </li>
            </ul>
        </div> -->
    </div>
</nav>