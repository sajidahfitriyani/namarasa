<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Namarasa — Restoran Indonesia Dengan Citarasa Nusantara dan Kopitiam Terbaik di PIK!</title>

    <meta name="title" content="Namarasa — Restoran Indonesia Dengan Citarasa Nusantara dan Kopitiam Terbaik di PIK!">
    <meta name="description" content=" Namarasa adalah kopitiam modern yang menyajikan ragam hidangan Nusantara autentik,
    mulai dari makanan berat, camilan, hingga minuman spesial dengan cita rasa premium namun harga terjangkau.
    Tempat kami selalu ramai pengunjung, jadi jangan lupa reservasi meja sebelumnya ya!">
    <link rel="icon" href="{{ url('cuba/assets/images/favicon.ico') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ url('cuba/assets/images/icon-192.png') }}" type="image/x-icon">

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@xz/fonts@1/serve/plus-jakarta-display.min.css" />

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Scripts -->
    <script src="https://kit.fontawesome.com/4d516d4246.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.2/dist/css/splide.min.css">
</head>

<body>

    <!-- ------------------------ Mobile Header Section ------------------------ -->
    <nav class="navbar navbar-light bg-white d-block d-sm-block d-md-block d-lg-none py-3 border-bottom">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="#">Namarasa</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
                aria-controls="offcanvasNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar"
                aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title fw-bold" id="offcanvasNavbarLabel">
                        Namarasa
                    </h5>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                </div>
                <div class="offcanvas-body" style="margin-top: -24px">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <hr />
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Beranda</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/#tentang-kami">Tentang Kami</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('categories.index') }}">Kategori</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('menus.index') }}">Menu</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/#galeri-outlet">Galeri Outlet</a>
                        </li>
                    </ul>
                    <hr />
                    <div class="d-grid gap-2">
                        <button class="btn btn-warning text-white me-2 px-5 fw-500"
                            onclick="location.href='http://127.0.0.1:8000/reservation/step-one'" type="button"> <i
                                class="fas fa-calendar-plus"></i> &nbsp; &nbsp; Buat
                            Reservasi</button>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- ------------------------ Double Header Section ------------------------ -->
    <nav class="py-1 bg-white border-bottom d-none d-sm-none d-md-none d-lg-block text-grey">
        <div class="container d-flex flex-wrap fs-15">
            <ul class="nav me-auto">
                <li class="nav-item me-2">
                    <a href="/" class="nav-link link-dark text-grey px-2 active" aria-current="page">Beranda</a>
                </li>
                <li class="nav-item me-2">
                    <a href="/#tentang-kami" class="nav-link link-dark text-grey px-2">Tentang Kami</a>
                </li>
                <li class="nav-item me-2">
                    <a href="{{ route('categories.index') }}" class="nav-link link-dark text-grey px-2">Kategori</a>
                </li>
                <li class="nav-item me-2">
                    <a href="{{ route('menus.index') }}" class="nav-link link-dark text-grey px-2">Menu</a>
                </li>
                <li class="nav-item me-2">
                    <a href="/#galeri-outlet" class="nav-link link-dark text-grey px-2">Galeri Outlet</a>
                </li>
            </ul>
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link link-dark text-grey px-2 no-effect-hover">Contact Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link link-dark text-grey px-2 no-effect-hover">|</a>
                </li>
                <li class="nav-item">
                    <a href="https://wa.me/+6285718719077" class="nav-link link-dark text-grey px-2" target="_blank">
                        Admin 1</a>
                </li>
                <li class="nav-item">
                    <a href="https://wa.me/+6289522054302" target="_blank"
                        class="nav-link link-dark text-grey px-2">Admin 2</a>
                </li>
            </ul>
        </div>
    </nav>

    <header class="py-3 mb-4 border-bottom d-none d-sm-none d-md-none d-lg-block bg-white sticky-top">
        <div class="container d-flex flex-wrap justify-content-center">
            <a href="/" class="d-flex align-items-center mb-3 mb-lg-0 me-lg-auto text-dark text-decoration-none">
                <span class="fs-3 fw-bold">Namarasa</span>
            </a>
            <button class="btn btn-warning text-white me-2 px-5 fw-500"
                onclick="location.href='http://127.0.0.1:8000/reservation/step-one'" type="button"> <i
                    class="fas fa-calendar-plus"></i> &nbsp; &nbsp; Buat
                Reservasi</button>
        </div>
    </header>

    <!-- ------------------------ Main Content Section ------------------------ -->
    <main>
        {{ $slot }}
    </main>

    <!-- --------------------------- Footer Section ---------------------------- -->
    <footer class="py-5">
        <div class="container">
            <div class="row text-white">
                <div class="col-md-6 border-end">
                    <h4 class="fw-bold">Namarasa — Restoran Indonesia Dengan Citarasa Nusantara dan Kopitiam Terbaik di PIK!</h4>
                    <p class="">
                        Namarasa adalah kopitiam modern yang menyajikan ragam hidangan Nusantara autentik,
                        mulai dari makanan berat, camilan, hingga minuman spesial dengan cita rasa premium namun harga terjangkau. 
                        Tempat kami selalu ramai pengunjung, jadi jangan lupa reservasi meja sebelumnya ya!
                    </p>
                    <small class="d-block mb-3">
                        &copy; 2025 — Made with laravel 9.4.1 and bootstrap 5.2.0
                    </small>
                </div>

                <div class="col-6 col-md ms-0 ms-md-4">
                    <h4 class="fw-bold mb-3">Navigasi Cepat</h4>
                    <ul class="list-unstyled">
                        <li class="mb-1">
                            <a class="link-light text-decoration-none" href="/userlisting?srczz=&katfilt=6901">
                                Beranda
                            </a>
                        </li>
                        <li class="mb-1">
                            <a class="link-light text-decoration-none" href="/userlisting?srczz=&katfilt=6905">
                                Tentang Kami
                            </a>
                        </li>
                        <li class="mb-1">
                            <a class="link-light text-decoration-none" href="/userlisting?srczz=&katfilt=6904">
                                Kategori
                            </a>
                        </li>
                        <li class="mb-1">
                            <a class="link-light text-decoration-none" href="/userlisting?srczz=&katfilt=6902">
                                Menu
                            </a>
                        </li>
                        <li class="mb-1">
                            <a class="link-light text-decoration-none" href="/userlisting?srczz=&katfilt=6903">
                                Galeri Outlet
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-6 col-md">
                    <h4 class="fw-bold mb-3">Sosial Media</h4> 
                    <ul class="list-unstyled">
                        <li class="mb-1">
                            <a class="link-light text-decoration-none" 
                            href="https://wa.me/6285718719077" 
                            target="_blank" 
                            rel="noopener noreferrer">
                                <i class="fab fa-whatsapp"></i> &nbsp; Whatsapp
                            </a>
                        </li>
                        <li class="mb-1">
                            <a class="link-light text-decoration-none" 
                            href="https://www.instagram.com/namarasa_pik/" 
                            target="_blank" 
                            rel="noopener noreferrer">
                                <i class="fab fa-instagram"></i> &nbsp; Instagram
                            </a>
                        </li>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>

    <!-- Splide JS -->
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.2/dist/js/splide.min.js"></script>

    <!-- Initializing Hero Section Splide JS -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var splide = new Splide('.splide', {
                type: 'loop',
                padding: '80px',
                gap: '24px',
                autoplay: true,
                arrows: false,
                breakpoints: {
                    576: {
                        type: 'loop',
                        perPage: 1,
                        gap: '8px',
                        padding: '8px',
                    },
                }
            });
            splide.mount();
        });
    </script>

    <!-- Initializing Feature Section Splide JS -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var splide = new Splide('.splide2', {
                type: 'fade',
                rewind: true,
                autoplay: true,
                arrows: false,
            });
            splide.mount();
        });
    </script>

    <!-- Swiper JS -->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    <!-- Initialize Testimonial Swiper -->
    <script>
        var swiper = new Swiper(".testimonial-swiper", {
            slidesPerView: 1,
            spaceBetween: 12,
            pagination: {
                el: ".swiper-pagination",
            },
            breakpoints: {
                768: {
                    slidesPerView: 2.2,
                    spaceBetween: 12,
                },
                1024: {
                    slidesPerView: 3,
                    spaceBetween: 12,
                },
            },
        });
    </script>

    <!-- Initialize Menu Swiper -->
    <script>
        var swiper = new Swiper(".menu-swiper", {
            slidesPerView: 1,
            spaceBetween: 12,
            pagination: {
                el: ".swiper-pagination",
            },
            breakpoints: {
                768: {
                    slidesPerView: 2.2,
                    spaceBetween: 12,
                },
                1024: {
                    slidesPerView: 4.3,
                    spaceBetween: 12,
                },
            },
        });
    </script>

</body>

</html>
