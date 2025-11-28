<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff - Ria Busana 85</title>
    <link href="{{ asset('amoeba-assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('amoeba-assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('amoeba-assets/css/main.css') }}" rel="stylesheet">
</head>

<body>
    <header id="header" class="header d-flex align-items-center sticky-top">
        <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">
            <a href="{{ route('amoeba') }}" class="logo d-flex align-items-center">
                <h1 class="sitename">Ria Busana 85</h1>
            </a>
            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="{{ route('amoeba') }}">Home</a></li>
                    <li><a href="{{ route('staff.index') }}" class="active">Staff</a></li>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>
        </div>
    </header>

    <main class="main">
        <!-- Hero Section -->
        <section id="hero" class="hero section dark-background">
            <img src="{{ asset('amoeba-assets/img/hero-bg.jpg') }}" alt="" data-aos="fade-in">
            <div class="container text-center" data-aos="fade-up" data-aos-delay="100">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <h2>Staff Umum</h2>
                        <p>Tim staff yang melayani di Ria Busana 85</p>
                        <a href="{{ route('amoeba') }}" class="btn-get-started">← Kembali ke Home</a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Team Section -->
        <section id="team" class="team section">
            <div class="container" data-aos="fade-up">
                <div class="section-title">
                    <h2>Tim Staff</h2>
                    <p>Staff yang tidak ter-assign ke counter tertentu</p>
                </div>

                <div class="row gy-4">
                    @forelse($staff as $member)
                        <div class="col-lg-4 col-md-6 team-member" data-aos="fade-up" data-aos-delay="100">
                            <div class="card h-100 text-center">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $member->nama }}</h5>
                                    <p class="card-text text-muted">{{ $member->posisi }}</p>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <p class="text-center text-muted">Belum ada staff umum.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </section>
    </main>

    <footer id="footer" class="footer light-background">
        <div class="container">
            <div class="row copyright">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    <p>© <span>Copyright</span> <strong class="px-1 sitename">Ria Busana 85</strong> <span>All Rights
                            Reserved</span></p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <p>Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a></p>
                </div>
            </div>
        </div>
    </footer>

    <script src="{{ asset('amoeba-assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('amoeba-assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('amoeba-assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('amoeba-assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('amoeba-assets/js/main.js') }}"></script>
</body>

</html>
