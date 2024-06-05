<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Yuk! Kemah - Sewa Peralatan Kemah</title>
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/Raleway.css') }}">
    <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
    <link rel="shortcut icon" href="{{ asset('img/icon.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
</head>

<body data-bs-spy="scroll" data-bs-target="#navbar" data-bs-root-margin="0px 0px -40%" data-bs-smooth-scroll="true"
    class="scrollspy-example">
    @include('sweetalert::alert')

    <nav class="navbar navbar-expand-md fixed-top navbar-shrink py-3 navbar-light" id="mainNav"
        style="background-color: var(--yellow-1)">
        <div class="container"><a class="navbar-brand d-flex align-items-center" href="#header"><img
                    src="img/yukkemah.png" width="112" height="57"></a><button data-bs-toggle="collapse"
                class="navbar-toggler" data-bs-target="#navcol-1"><span class="visually-hidden">Toggle
                    navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item"></li>
                    <li class="nav-item"><a class="nav-link" href="#header"><strong>Tentang Kami</strong></a></li>
                    <li class="nav-item"><a class="nav-link" href="#equipments"><strong>Perlengkapan</strong></a></li>
                    <li class="nav-item"><a class="nav-link" href="#testimonies"><strong>Testimoni</strong></a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact"><strong>Kontak</strong></a></li>
                </ul>

                <ul class="mt-1 mt-lg-0 p-0 m-0 nav-item dropdown">
                    @auth
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Halo! {{ auth()->user()->name }}
                        </a>
                        <ul class="dropdown-menu" style="border-radius:10px">
                            <li><a class="dropdown-item" href="/dashboard">Dashboard</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <form action="/logout" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Logout</button>
                                </form>
                            </li>
                        </ul>
                    @else
                        <a class="btn btn-primary shadow" role="button" href="/login">Masuk</a>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>
    {{-- Header --}}
    <header class="pt-3" id="header">
        <div class="container pt-5 pt-xl-5">
            <div class="row pt-5">
                <div class="py-5 col-md-8 col-xxl-10 text-center text-md-start mx-auto">
                    <div class="text-center">
                        <h1 class="display-4 fw-bold text-warning mb-5"><strong>Tempat sewa peralatan berkemah dengan
                                lebih dari 200+ pelanggan.</strong></h1>
                        <p class="fs-5 mb-5" style="color: var(--navy)">Menyediakan berbagai pilihan peralatan kemah
                            dari sepatu outdoor hingga peralatan survival lainnya.</p>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <section>
        <img src="{{ asset('img/header.png') }}" alt="" class="img-fluid">
    </section>

    {{-- Sepatu Outdoor Section --}}
    <section style="background-color: var(--navy)" class="py-5" id="equipments">
        <div class="container py-4 py-xl-5">
            <h2 class="text-center fw-bold text-white my-5">Sepatu Outdoor</h2>
            <div class="row gy-4 row-cols-1 row-cols-md-2 row-cols-lg-3">
                <div class="col" data-aos="fade-up">
                    <div class="card d-flex justify-content-center">
                        <div class="card-body" style="padding:0px;">
                            <img src="https://images.tokopedia.net/img/cache/700/VqbcmM/2023/3/14/0b8d28bb-579e-44b1-b302-03b8a6e90d89.jpg"
                                class="img-fluid" alt="">
                            <div class="p-3">
                                <h4 class="fw-bold mt-3">New Balance Fresh Foam X Hierro v7</h4>
                                <p class="text-muted"> For those who take going off the beaten path literally, there’s
                                    the Fresh Foam X Hierro, a dedicated, off-road application of our best running
                                    technology. </p>
                                <button class="btn btn-sm px-0" type="button">Sewa&nbsp;<svg
                                        xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                                        fill="currentColor" viewBox="0 0 16 16" class="bi bi-arrow-right">
                                        <path fill-rule="evenodd"
                                            d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8">
                                        </path>
                                    </svg><br></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col" data-aos="fade-up">
                    <div class="card d-flex justify-content-center">
                        <div class="card-body" style="padding:0px;">
                            <img src="https://www.adidas.co.id/media/catalog/product/i/e/ie5127_2_footwear_photography_side20lateral20view_grey.jpg"
                                class="img-fluid" alt="">
                            <div class="p-3">
                                <h4 class="fw-bold mt-3">Terrex Free Hiker GORE-TEX Hiking Shoes 2.0</h4>
                                <p class="text-muted"> Lightweight hiking shoes offer next-level comfort and support to
                                    extend your range in the mountains. A BOOST midsole brings energy to every step to
                                    keep you moving on hikes long and short. </p>
                                <button class="btn btn-sm px-0" type="button">Sewa&nbsp;<svg
                                        xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                                        fill="currentColor" viewBox="0 0 16 16" class="bi bi-arrow-right">
                                        <path fill-rule="evenodd"
                                            d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8">
                                        </path>
                                    </svg><br></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col" data-aos="fade-up">
                    <div class="card d-flex justify-content-center">
                        <div class="card-body" style="padding:0px;">
                            <img src="https://nb.scene7.com/is/image/NB/mthimcge_nb_02_i?$pdpflexf2$&wid=440&hei=440"
                                class="img-fluid" alt="">
                            <div class="p-3">
                                <h4 class="fw-bold mt-3">Fresh Foam X Hierro Mid Gore-Tex®</h4>
                                <p class="text-muted"> These trail running shoes employ a Vibram® Megagrip outsole,
                                    mid-cut upper with GORE-TEX® waterproof fabric, and toe protection to create a
                                    protective shell of durability and traction around the signature Fresh Foam X
                                    cushioning. </p>
                                <button class="btn btn-sm px-0" type="button">Sewa&nbsp;<svg
                                        xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                                        fill="currentColor" viewBox="0 0 16 16" class="bi bi-arrow-right">
                                        <path fill-rule="evenodd"
                                            d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8">
                                        </path>
                                    </svg><br></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Tas Outdoor Section --}}
    <section class="py-5">
        <div class="container py-4 py-xl-5">
            <h2 class="text-center fw-bold my-5" style="color: var(--yellow-2);">Tas Outdoor</h2>
            <div class="row gy-4 row-cols-1 row-cols-md-2 row-cols-lg-3">
                <div class="col" data-aos="fade-up">
                    <div class="card d-flex justify-content-center">
                        <div class="card-body" style="padding:0px;background-color:var(--yellow-2);">
                            <img src="https://d1yutv2xslo29o.cloudfront.net/product/variant/photo/5896a08f-8ed6-43fe-a013-86fd2a9a0eac.jpg"
                                class="img-fluid" alt="">
                            <div class="p-3">
                                <h4 class="fw-bold mt-3 text-white">CAMFEST BACKPACK 30L</h4>
                                <p class="text-white"> Ransel Camfest Backpack 30L siap temani kamu berpergian akhir
                                    pekan ini. Desain bukaan depan memberimu akses mudah untuk mengemas bawaanmu ke
                                    dalam kompartemen utamanya yang luas, bahkan perlengkapanmu untuk perjalanan 2-3
                                    hari. </p>
                                <button class="btn btn-sm text-white px-0" type="button">Sewa&nbsp;<svg
                                        xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                                        fill="currentColor" viewBox="0 0 16 16" class="bi bi-arrow-right">
                                        <path fill-rule="evenodd"
                                            d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8">
                                        </path>
                                    </svg><br></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col" data-aos="fade-up">
                    <div class="card d-flex justify-content-center">
                        <div class="card-body" style="padding:0px;background-color:var(--yellow-2);">
                            <img src="https://www.consina.com/wp-content/uploads/2023/04/everest1.jpg"
                                class="img-fluid" alt="">
                            <div class="p-3">
                                <h4 class="fw-bold mt-3 text-white">CONSINA EVEREST 60+5L EXPERT SERIES RANSEL GUNUNG
                                </h4>
                                <p class="text-white">Consina Everest hadir sebagai teman petualanganmu ke tempat
                                    tempat eksotis dunia. Menampilkan inovasi terbaru dari Consina, Everest menggunakan
                                    bahan dan design terbaik untuk ransel di kelas 60-65L. </p>
                                <button class="btn btn-sm text-white px-0" type="button">Sewa&nbsp;<svg
                                        xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                                        fill="currentColor" viewBox="0 0 16 16" class="bi bi-arrow-right">
                                        <path fill-rule="evenodd"
                                            d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8">
                                        </path>
                                    </svg><br></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col" data-aos="fade-up">
                    <div class="card d-flex justify-content-center">
                        <div class="card-body" style="padding:0px;background-color:var(--yellow-2);">
                            <img src="https://d1yutv2xslo29o.cloudfront.net/product/variant/media/web/910009354_Image1_1_fcd2.webp"
                                class="img-fluid" alt="">
                            <div class="p-3">
                                <h4 class="fw-bold mt-3 text-white">Z-HYPERLITE SUMMIT 35</h4>
                                <p class="text-white"> Z Hyperlite Summit 35 adalah backpack yang dirancang untuk
                                    kegiatan summit attack dan speed hiking. Tas ini memiliki kompartemen utamadan
                                    kompartemen eksternal, seperti saku samping, saku tutup atas, dan saku sisip depan
                                    untuk menyimpan perlengkapan. </p>
                                <button class="btn btn-sm text-white px-0" type="button">Sewa&nbsp;<svg
                                        xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                                        fill="currentColor" viewBox="0 0 16 16" class="bi bi-arrow-right">
                                        <path fill-rule="evenodd"
                                            d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8">
                                        </path>
                                    </svg><br></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Testimoni Section --}}
    <section class="py-5" id="testimonies">
        <div class="container py-4 py-xl-5">
            <div class="row">
                <div class="col-md-6">
                    <h3 class="display-6 fw-bold pb-md-4">Apa sih kata <span class="underline">mereka&nbsp;</span>
                        tentang Yuk! Kemah?</h3>
                </div>
                <div class="col-md-6 pt-4">
                    <p class="text-muted mb-4">Sudah banyak orang menggunakan Yuk! Kemah, ini pesan-pesan yang mereka
                        tinggalkan setelah menggunakan layanan kami.</p>
                </div>
            </div>
            <div class="row gy-4 gy-md-0">
                <div
                    class="col-md-6 d-flex d-sm-flex d-md-flex justify-content-center align-items-center justify-content-md-start align-items-md-center justify-content-xl-center">
                    <div>
                        <div class="m-2 row align-items-center" data-aos="fade-right">
                            <div class="col-3">
                                <img src="{{ asset('img/testimonies/navia.png') }}" class="img-fluid rounded-circle"
                                    alt="">
                            </div>
                            <div class="col-9">
                                <h5 class="fw-bold">"Yuk! Kemah menyala begini euy."</h5>
                                <p class="text-muted">- Teh Navia, Boss Spina di Rosula</p>
                            </div>
                        </div>
                        <div class="m-2 row align-items-center" data-aos="fade-right">
                            <div class="col-3">
                                <img src="{{ asset('img/testimonies/nayi.png') }}" class="img-fluid rounded-circle"
                                    alt="">
                            </div>
                            <div class="col-9">
                                <h5 class="fw-bold">"Affordable banget."</h5>
                                <p class="text-muted">- Kang Tighnari, Biologist</p>
                            </div>
                        </div>
                        <div class="m-2 row align-items-center" data-aos="fade-right">
                            <div class="col-3">
                                <img src="{{ asset('img/testimonies/xianyun.jpg') }}" class="img-fluid rounded-circle"
                                    alt="">
                            </div>
                            <div class="col-9">
                                <h5 class="fw-bold">"Thx mhs."</h5>
                                <p class="text-muted">- Xianyun, Adepti</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 order-first order-md-last">
                    <div><img class="rounded img-fluid w-100 fit-cover" style="min-height: 300px;"
                            src="assets/img/illustrations/teamwork.svg"></div>
                </div>
            </div>
        </div>
    </section>

    {{-- Kontak Section --}}
    <section class="py-4 py-xl-5" id="contact">
        <div class="container">
            <div
                class="text-white bg-primary border rounded border-0 border-primary d-flex flex-column justify-content-between flex-lg-row p-4 p-md-5">
                <div class="pb-2 pb-lg-1">
                    <h2 class="fw-bold text-secondary mb-2">Mau sewa atau nanya-nanya dulu?</h2>
                    <p class="mb-0">Bisa hubungi kami lewat tombol dibawah ini.</p>
                </div>
                <div class="my-2"><a class="btn btn-light fs-5 py-2 px-4" role="button"
                        href="contacts.html">Kontak Kami</a></div>
            </div>
        </div>
    </section>

    {{-- Footer --}}
    <footer style="background-color: var(--navy);">
        <div class="container py-4 py-lg-5">
            <div class="text-center my-5">
                <img src="img/yukkemah.png" alt="" class="img-fluid" style="width: 200px">
            </div>
            {{-- <hr> --}}
            <div class="d-flex justify-content-between align-items-center pt-3" style="color: var(--yellow-1);">
                <p class="mb-0" style="font-size: 0.9em">Copyright © 2024 Yuk! Kemah (Template by Bootstrap Studio)
                </p>
                {{-- <ul class="list-inline mb-0" style="font-size:1.3em;">
                    <li class="list-inline-item"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-facebook">
                            <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951"></path>
                        </svg></li>
                    <li class="list-inline-item"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-twitter">
                            <path d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15"></path>
                        </svg></li>
                    <li class="list-inline-item"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-instagram">
                            <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334"></path>
                        </svg></li>
                </ul> --}}
            </div>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/startup-modern.js"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
</body>

</html>
