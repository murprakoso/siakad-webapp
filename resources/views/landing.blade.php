<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="Sistem Informasi Akademik Sekolah" />
    <meta name="author" content="Tim SIAKAD" />
    <title>SIAKAD - Sistem Informasi Akademik Sekolah</title>
    <!-- Favicon -->
    @if (isset($settings->site_favicon) && $settings->site_favicon)
        <link rel="icon" href="{{ asset($settings->site_favicon_url) }}" type="image/x-icon">
    @else
        <link rel="icon" href="{{ asset('landing/assets/favicon.ico') }}" type="image/x-icon">
        <!-- Default favicon -->
    @endif
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="{{ asset('landing/css/styles.css') }}" rel="stylesheet" />
</head>

<body id="page-top">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
        <div class="container px-5">
            <a class="navbar-brand" href="#page-top">SIAKAD Sekolah</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span
                    class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">Beranda</a></li>
                    @guest
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Login
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="{{ url('siswa/login') }}">Siswa</a></li>
                                <li><a class="dropdown-item" href="{{ url('guru/login') }}">Guru</a></li>
                                <li><a class="dropdown-item" href="{{ url('operator/login') }}">Operator</a></li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                {{ Auth::user()->nama_lengkap }}
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li><a class="dropdown-item" href="#">Profil</a></li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="dropdown-item">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <!-- Header-->
    <header class="masthead text-center text-white">
        <div class="masthead-content">
            <div class="container px-5">
                <h2 class="masthead-heading mb-0">Selamat Datang di SIAKAD</h2>
                <h3 class="masthead-subheading mb-0">Sistem Informasi Akademik Sekolah</h3>
                <a class="btn btn-primary btn-xl rounded-pill mt-5" href="#tentang">Pelajari Lebih Lanjut</a>
            </div>
        </div>
        <div class="bg-circle-1 bg-circle"></div>
        <div class="bg-circle-2 bg-circle"></div>
        <div class="bg-circle-3 bg-circle"></div>
        <div class="bg-circle-4 bg-circle"></div>
    </header>

    <!-- Content section 1-->
    <section id="tentang">
        <div class="container px-5">
            <div class="row gx-5 align-items-center">
                <div class="col-lg-6 order-lg-2">
                    <div class="p-5"><img class="img-fluid rounded-circle"
                            src="{{ asset('landing/assets/img/sekolah.png') }}" alt="Sekolah" /></div>
                </div>
                <div class="col-lg-6 order-lg-1">
                    <div class="p-5">
                        <h2 class="display-4">Mengelola Akademik dengan Mudah</h2>
                        <p>SIAKAD adalah solusi untuk mengelola administrasi akademik sekolah dengan cepat dan efisien.
                            Dari pendaftaran siswa hingga penilaian akhir, semua dapat dilakukan dalam satu sistem.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Content section 2-->
    <section>
        <div class="container px-5">
            <div class="row gx-5 align-items-center">
                <div class="col-lg-6">
                    <div class="p-5"><img class="img-fluid rounded-circle"
                            src="{{ asset('landing/assets/img/pendidikan.png') }}" alt="Pendidikan" /></div>
                </div>
                <div class="col-lg-6">
                    <div class="p-5">
                        <h2 class="display-4">Efisiensi dalam Pengelolaan Data</h2>
                        <p>Sistem kami membantu sekolah mengelola data siswa, guru, dan administrasi lainnya dengan
                            lebih efisien. Pengelolaan data yang terstruktur memudahkan sekolah untuk mengambil
                            keputusan yang tepat.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Content section 3-->
    <section>
        <div class="container px-5">
            <div class="row gx-5 align-items-center">
                <div class="col-lg-6 order-lg-2">
                    <div class="p-5"><img class="img-fluid rounded-circle"
                            src="{{ asset('landing/assets/img/kelas.png') }}" alt="Kelas" /></div>
                </div>
                <div class="col-lg-6 order-lg-1">
                    <div class="p-5">
                        <h2 class="display-4">Sistem Penilaian yang Terintegrasi</h2>
                        <p>SIAKAD menyediakan fitur penilaian terintegrasi yang memudahkan guru untuk memberikan nilai
                            dan laporan secara real-time. Siswa dan orang tua dapat dengan mudah mengakses hasil
                            akademik melalui portal ini.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer-->
    <footer class="py-5 bg-black">
        <div class="container px-5">
            <p class="m-0 text-center text-white small">&copy; SIAKAD 2024. </p>
        </div>
    </footer>

    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="{{ asset('landing/js/scripts.js') }}"></script>
</body>

</html>
