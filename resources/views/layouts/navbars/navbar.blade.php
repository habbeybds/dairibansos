<!-- Navigation-->
<nav class="navbar navbar-expand-lg bg-transparant text-uppercase fixed-top" id="mainNav">
    <div class="container">
        <!-- ***** Logo Start ***** -->
        <a href="{{route('welcome')}}" class="navbar-brand page-scroll logo"><img width="40px" src="{{ asset('assets') }}/img/pemkabdairi.png" alt=""> Bansos Dairi</a>
        <!-- ***** Logo End ***** -->
        <button class="navbar-toggler text-uppercase font-weight-bold bg-hamburger text-white rounded" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            Menu
            <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ms-auto">

                @if($initial =='login')
                <li class="nav-item mx-0 mx-lg-1"><a href="{{route('login')}}"><button id="btn-masuk" class="nav-link py-3 px-0 px-lg-3 rounded btn-masuk">MASUK</button></a></li>
                @else
                <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded page-scroll" href="#page-top">HOME</a></li>
                <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded page-scroll" href="#about">TENTANG</a></li>
                <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded page-scroll" href="#other-website">SITUS TERKAIT</a></li>
                <li class="nav-item mx-0 mx-lg-1"><a href="{{route('login')}}"><button id="btn-masuk" class="nav-link py-3 px-0 px-lg-3 rounded btn-masuk">MASUK</button></a></li>
                @endif
            </ul>
        </div>
    </div>
</nav>