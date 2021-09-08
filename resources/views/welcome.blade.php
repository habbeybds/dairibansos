@extends('layouts.app')

@section('content')
<!-- About Section-->
<section class="page-section bg-primary mb-0" id="about">
    <div class="container">
        <!-- About Section Content-->
        <div class="row">
            <div class="col-lg-6 ms-auto">
                <div class="left-heading">Apa itu Sistem Bantuan Sosial Sembako Pemerintah Kabupaten Dairi?
                </div>
                <p class="lead">Sistem pendataan Bantuan Sosial (Bansos) Berupa Sembako Melalui Dinas Sosial Pemerintah Kabupaten Dairi.</p>
            </div>
            <div class="col-lg-6 me-auto about-right-img">
                <img class="about-avatar mb-5" src="{{ asset('assets') }}/img/about.png" alt="..." />
            </div>
        </div>
    </div>
</section>
<!-- Situs Terkait Section-->
<section class="page-section bg-other-website text-white" id="other-website">
    <div class="container">
        <!-- Situs Terkait Section Heading-->
        <h2 class="page-section-heading text-center text-poppines mb-0">Situs Terkait</h2>
        <p class="text-center mb-5 mt-5 text-poppines">Temukan informasi-informasi lainnya melalui layanan kami yang lainnya.</p>

        <!-- ***** Section Title End ***** -->
        <div class="row">


            <div class="owl-carousel owl-theme">
                <div class="item service-item">
                    <img src="{{ asset('assets') }}/img/portaldairi.jpg" alt="">
                    <a href="#" class="main-button">Telusuri</a>
                </div>
                <div class="item service-item">
                    <img src="{{ asset('assets') }}/img/perkebbas.png" alt="">
                    <a href="#" class="main-button">Telusuri</a>
                </div>
                <div class="item service-item">
                    <img src="{{ asset('assets') }}/img/jdih.jpg" alt="">
                    <a href="#" class="main-button">Telusuri</a>
                </div>
                <div class="item service-item">
                    <img src="{{ asset('assets') }}/img/lapor.png" alt="">
                    <a href="#" class="main-button">Telusuri</a>
                </div>
                <div class="item service-item">
                    <img src="{{ asset('assets') }}/img/visit.jpg" alt="">
                    <a href="#" class="main-button">Telusuri</a>
                </div>
                <div class="item service-item">
                    <img src="{{ asset('assets') }}/img/sicantik.jpg" alt="">
                    <a href="#" class="main-button">Telusuri</a>
                </div>
                <div class="item service-item">
                    <img src="{{ asset('assets') }}/img/covid.jpg" alt="">
                    <a href="#" class="main-button">Telusuri</a>
                </div>
            </div>

            <script>
                var owl = $('.owl-carousel');
                owl.owlCarousel({
                    loop: true,
                    margin: 30,
                    responsiveClass: true,
                    nav: true,
                    pagination: true,
                    responsive: {
                        0: {
                            items: 1,
                            nav: true,
                        },
                        600: {
                            items: 3,
                            nav: false,
                        },
                        1000: {
                            items: 4,
                            nav: true,
                            loop: false,
                        },
                    }
                })
            </script>
        </div>
    </div>
</section>
@endsection