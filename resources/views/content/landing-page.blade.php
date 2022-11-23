a
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Css Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Bootstrap icon cdn -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">

    <!-- Mapbox token -->
    <link href='https://api.mapbox.com/mapbox-gl-js/v2.3.1/mapbox-gl.css' rel='stylesheet' />

    <!-- Css Native -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}"> <!-- Tak berjalan seperti ini -->


    <title>PT. Globalindo Inovatif</title>
</head>

<body>
    <!-- Navbar -->
    <!-- nav.navbar.navbar-expand-lg.bg-dark.navbar-dark -->
    <nav class="navbar navbar-expand-lg bg-dark navbar-dark fixed-top">
        <div class="container">
            <!-- a.navbar-brand -->
            <a href="" class="navbar-brand"><span class="text-warning">PT. Globalindo Inovatif</span></a>

            <!-- button.navbar-toogler -->
            <!-- data-bs-toogle untuk menciutkan -->
            <!-- data-bs-target untuk beralih -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navmenu">
                <!-- hamburger icon -->
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- .collapse.navbar-collapse -->
            <div class="collapse navbar-collapse" id="navmenu">
                <!-- target -->
                <!-- ul.navbar-nav -->
                <!-- agar tulisannya dikanan maka tambahkan ms-auto -->
                <ul class="navbar-nav ms-auto">
                    <!-- li.nav-item -->
                    <li class="nav-item">
                        <!-- a.nav-link -->
                        <a href="#barangup100" class="nav-link">Barang stock +100</a>
                    </li>
                    <li class="nav-item">
                        <a href="#barangPembelian" class="nav-link">Daftar barang pembelian</a>
                    </li>
                    <li class="nav-item">
                        <a href="#barangPenjualan" class="nav-link">Daftar barang penjualan</a>
                    </li>
                    <li class="nav-item">
                        @if (Auth::user())
                            <a href="{{ url('/home') }}" class="nav-link">Home</a>
                        @else
                            <a href="{{ url('/login') }}" class="nav-link">Login</a>
                        @endif
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- End Navbar -->

    <!-- Showcase -->
    <!-- section.bg-dark.text-light.p-5.text-center -->
    <section class="bg-dark text-light p-5 p-lg-0 pt-lg-5 text-center text-sm-start">
        <!-- p-lg-0 agar pada saat ukuran large dia tidak memiliki padding -->
        <!-- p-5 untuk membuat padding disemua sisi menjadi 5px -->
        <!-- text-sm-start jika di kecilkan maka tulisan/text diawali dari depan -->
        <div class="container">
            <div class="d-sm-flex align-item-center justify-content-between">
                <!-- align-item-center justify-content-between untuk objek nya menjadi center selalu -->
                <!-- div diatas akan memanggil class flexbox sehingga nantinya mempunyai 2 item -->

                <!-- flexbox untuk tidak diaktifkan pada layar yang sangat kecil, misalnya layar hp, jadi apa yang harus kita lakukan? -->
                <!-- kita bisa tambahkan sm pada class d-flex diatas menjadi d-sm-flex -->
                <!-- sehingga sekarang untuk ukuran mobile dia tidak akan flex -->
                <div>
                    <h1>Welcome to <span class="text-warning">PT. Globalindo Inovatif</span></h1>
                    <p class="lead my-4">
                        <!-- Memperbesar tulisan dengan class lead dan membuat margin atau jarak ke atas dan kebawah-->
                        Global Indo Inovatif – Perusahaan Indonesia dengan nomor registrasi 23/5426 diterbitkan pada
                        tahun 2018. Alamat terdaftar: JALAN NGAGEL JAYA SELATAN 15 G-H.
                    </p>
                    <!-- data-bs-modal untuk membuat modal -->
                    <a href="#all-barang" class="btn btn-primary btn-lg" >Semua Barang</a>
                </div>

                <!-- karena gambarnya yang besar maka akan kita ikat agar tetap berada didalam container dengan img-fluid dan kita juga bisa mengaturnya dengan menggunakan w-50 misal, sehingga 50% dr ukurannya -->
                <img src="{{ asset('image/logo.png') }}" class="img-fluid w-50 d-none d-sm-block mb-4">
                <!-- class d-none maka gambar akan hilang, kemudian d-sm-block maka pada ukuran sm gambar akan hilang -->
            </div>
        </div>
    </section>

    <div class="container pt-5" id="barangup100">
        <div class="row">
            <div class="container-fluid d-flex">
                <div class="col-6 pt-2">
                    <div>
                        <h3><span class="text-warning">Daftar Barang</span> + 100</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Barang -->
    <section class="pt-2 pb-4">
        <div class="container">

            <div class="row">
                {{-- @if (count($data['barang']) > 0) --}}
                @foreach ($data['barang'] as $item)
                    <div class="col g-3">
                        <div class="card bg-white text-light"
                            style="width:350px; height:300px; box-shadow: 2px 2px 2px rgba(0,0,0,0.8); padding:10px; border:1px solid grey;">
                            <div class="row">
                                <div class="col">
                                    <a href="#"><img src="{{ asset('image') }}/{{ $item->gambar }}"
                                            class="m-2 pb-2" style="width:300px; height:200px;"></a>
                                </div>
                                <a href="#" class="btn btn-white btn-md mx-auto m-0 p-0"
                                    style="width:200px; line-height: 0.5em">
                                    <p class="fw-bolder">{{ $item->nama }}</p>
                                </a>
                                <a href="#" class="btn btn-white btn-md mx-auto m-0 p-0"
                                    style="width:200px; line-height: 0.1em">
                                    <p class="text-secondary">{{ $item->kode }}</p>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- End Outlet -->


    <!-- Promo Section -->
    <section class="p-5" id="barangPembelian">
        <div class="container">
            <div class="row align-items-center justify-content-between">
                <div class="col-md">
                    {{-- <img src="gambar/promo/promo1.png" class="img-fluid w-30"> --}}
                    <table class="table table-striped table-bordered">
                        <thead class="text-center">
                            <tr>
                                <th>No</th>
                                <th>Nota</th>
                                <th>Tanggal</th>
                                <th>Barang</th>
                                <th>Lokasi</th>
                                <th>Qty</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <?php $no = 1; ?>
                            @foreach ($data['pembelian'] as $item)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $item->nomor_nota }}</td>
                                    <td>{{ $item->tanggal_pembelian }}</td>
                                    <td>{{ $item->barang->nama }}</td>
                                    <td>{{ $item->barang->lokasi }}</td>
                                    <td>{{ $item->qty }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="col-md p-5">
                    <h2 style="color:orange;">Daftar Pembelian Barang</h2>
                    <p class="lead">
                        Pembelian barang dapat dilakukan oleh admin setelah melakukan proses autentikasi / login. Dan
                        pada halaman landing page ini hanya menampilkan 5 pembelian terakhir. Jika ingin melihat lebih
                        banyak silahkan klik <span class="fw-bolder" id="#">Lihat Selengkapnya</span>
                    </p>
                    <p>
                        Barang pembelian dapat dilihat apabila telah melakukan proses login terlebih dahulu
                    </p>
                    <a href="/pembelian" class="btn btn-warning mt-3">
                        <i class="bi bi-chevron-right">Lihat Selengkapnya</i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="p-5 bg-dark text-light" id="barangPenjualan">
        <div class="container">
            <div class="row align-items-center justify-content-between">

                <div class="col-md p-5">
                    <h2 class="text-warning">Daftar Penjualan Barang</h2>
                    <p class="lead">
                        Penjualan barang dapat dilakukan oleh admin setelah melakukan proses autentikasi / login. Dan
                        pada halaman landing page ini hanya menampilkan 5 penjualan terakhir. Jika ingin melihat lebih
                        banyak silahkan klik <span class="fw-bolder" id="#">Lihat Selengkapnya</span>
                    </p>
                    <p>
                        Barang penjualan dapat dilihat apabila telah melakukan proses login terlebih dahulu
                    </p>
                    <a href="/penjualan" class="btn btn-warning mt-3">
                        <i class="bi bi-chevron-right">Lihat Selengkapnya</i>
                    </a>
                </div>
                <!-- gambarnya di sebelah kanan nantinya -->
                <div class="col-md">
                    {{-- <img src="gambar/promo/promo2.png" class="img-fluid" alt=""> --}}
                    <table class="table table-striped table-bordered">
                        <thead class="text-center text-white">
                            <tr>
                                <th>No</th>
                                <th>Nota</th>
                                <th>Tanggal</th>
                                <th>Barang</th>
                                <th>Lokasi</th>
                                <th>Qty</th>
                            </tr>
                        </thead>
                        <tbody class="text-center text-white">
                            <?php $no = 1; ?>
                            @foreach ($data['penjualan'] as $item)
                                <tr>
                                    <td class="text-white">{{ $no++ }}</td>
                                    <td class="text-white">{{ $item->nomor_nota }}</td>
                                    <td class="text-white">{{ $item->tanggal_pembelian }}</td>
                                    <td class="text-white">{{ $item->barang->nama }}</td>
                                    <td class="text-white">{{ $item->barang->lokasi }}</td>
                                    <td class="text-white">{{ $item->qty }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <section class="pt-2 pb-4">
        <div class="container" id="all-barang">

            <div class="row">
                {{-- @if (count($data['barang']) > 0) --}}
                @foreach ($data['arrBarang'] as $item)
                    <div class="col g-3">
                        <div class="card bg-white text-light"
                            style="width:230px; height:350px; box-shadow: 2px 2px 2px rgba(0,0,0,0.8); padding:10px; border:1px solid grey;">
                            <div class="row">
                                <div class="col">
                                    <a href="#"><img src="{{ asset('image') }}/{{ $item->gambar }}"
                                            class="m-2 pb-2" style="width:200px; height:200px;"></a>
                                </div>
                                <a href="#" class="btn btn-white btn-md mx-auto m-0 p-0"
                                    style="width:200px; line-height: 0.5em">
                                    <p class="fw-bolder">{{ $item->nama }}</p>
                                </a>
                                <a href="#" class="btn btn-white btn-md mx-auto m-0 p-0"
                                    style="width:200px; line-height: 0.1em">
                                    <p class="text-secondary">{{ $item->kode }}</p>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Footer -->
    {{-- <footer class="p-5 bg-dark text-white text-center position-relative">
        <div class="container">
            <p class="lead">Created By Nur Iswanto</p>

            <a href="#" class="position-absolute bottom-0 end-0 p-5"></a>
            <i class="bi bi-arrow-up-circle h1"></i>
        </div>
    </footer> --}}

    <div class="footer bg-dark text-warning pt-3">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12 col-md-12">
                    <div class="footer-widget">
                        <h3 class="title">kontak</h3>
                        <div class="contact-info">
                            <p><i class="fa fa-map-marker"></i>Pondok MC Dermott Blok E no 12A</p>
                            <p><i class="fa fa-envelope"></i>Nur Iswanto</p>
                            <p><i class="fa fa-phone"></i>+62 81261518980</p>
                            <div class="social">
                                <a href="https://twitter.com/SerumpunRADIO"><i class="fab fa-twitter"></i></a>
                                <a href="https://web.facebook.com/917serumpunRADIO/?_rdc=1&_rdr"><i class="fab fa-facebook-f"></i></a>
                                <a href="https://www.instagram.com/serumpunradiobatam/"><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
    
            </div>
        </div>
    </div>
    
    <div class="footer-bottom bg-dark text-warning">
        <div class="container">
            <div class="row">
    
                <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                <div class="col-md-6 template-by">
                    <p>Designed By <a href="#">Nur</a></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>
