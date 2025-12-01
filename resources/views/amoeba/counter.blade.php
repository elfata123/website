<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $counter->nama }} - Ria Busana 85</title>
    <link href="{{ asset('amoeba-assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('amoeba-assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('amoeba-assets/css/main.css') }}" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('amoeba-assets/img/logo rb no bg.png') }}">
</head>

<body>
    <header id="header" class="header d-flex align-items-center sticky-top">
        <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">
            <a href="{{ route('amoeba') }}" class="logo d-flex align-items-center">
                <img src="{{ asset('amoeba-assets/img/logo.png') }}" alt="Ria Busana 85 Logo">
                <h1 class="sitename">Ria Busana 85</h1>
            </a>
            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="{{ route('amoeba') }}">Home</a></li>
                    <li><a href="{{ route('staff.index') }}">Staff</a></li>
                    <li><a href="https://member.riabusana.co.id/" target="_blank">Member</a></li>
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
                        <h2>{{ $counter->nama }}</h2>
                        <p>{{ $counter->lokasi }}</p>
                        <a href="{{ route('amoeba') }}" class="btn-get-started">← Kembali ke Home</a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Products Section -->
        <section id="products" class="portfolio section">
            <div class="container" data-aos="fade-up">
                <div class="section-title">
                    <h2>Produk</h2>
                    <p>Koleksi produk di {{ $counter->nama }}</p>
                </div>

                <div class="row gy-4">
                    @forelse($counter->products as $product)
                        <div class="col-lg-4 col-md-6 portfolio-item" data-aos="fade-up" data-aos-delay="100">
                            <div class="card h-100">
                                @if ($product->gambar)
                                    <img src="{{ asset('upload/produk/' . $product->gambar) }}" class="card-img-top"
                                        alt="{{ $product->nama }}" style="height: 250px; object-fit: cover;">
                                @else
                                    <div class="card-img-top bg-secondary d-flex align-items-center justify-content-center"
                                        style="height: 250px;">
                                        <i class="bi bi-image" style="font-size: 3rem; color: #ccc;"></i>
                                    </div>
                                @endif
                                <div class="card-body">
                                    <h5 class="card-title">{{ $product->nama }}</h5>
                                    <p class="card-text" style="color: #555; font-size: 0.9rem; margin-bottom: 0.75rem;">{{ Str::limit($product->deskripsi, 100) }}</p>
                                    <h6 class="card-text text-primary fw-bold">Rp
                                        {{ number_format($product->harga, 0, ',', '.') }}</h6>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <p class="text-center text-muted">Belum ada produk di counter ini.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </section>

        <!-- Team Section -->
        <section id="team" class="team section light-background">
            <div class="container" data-aos="fade-up">
                <div class="section-title">
                    <h2>Tim {{ $counter->nama }}</h2>
                    <p>Staff yang bekerja di counter ini</p>
                </div>

                <div class="row gy-4">
                    @forelse($counter->staff as $member)
                        <div class="col-lg-4 col-md-6 team-member" data-aos="fade-up" data-aos-delay="100">
                            <div class="card h-100 text-center">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $member->nama }}</h5>
                                    <p class="card-text text-muted">{{ $member->jabatan }}</p>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <p class="text-center text-muted">Belum ada staff di counter ini.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </section>
    </main>

    <footer id="footer" class="footer light-background">
        <div class="container">
            <div class="row gy-4 mb-5">
                <!-- About Section -->
                <div class="col-lg-4 col-md-12 footer-about">
                    <a href="{{ route('amoeba') }}" class="logo d-flex align-items-center mb-3">
                        <img src="{{ asset('amoeba-assets/img/logo.png') }}" alt="Ria Busana 85 Logo"
                            style="max-height: 45px;">
                        <span class="sitename ms-2 fw-bold">Ria Busana 85</span>
                    </a>
                    <p>Toko busana modern terpercaya dengan koleksi lengkap dan pelayanan profesional.</p>
                    <!-- Social Links -->
                    <div class="mt-3">
                        <p class="mb-2"><strong>Follow Us:</strong></p>
                        <div class="d-flex gap-2">
                            <a href="https://facebook.com" target="_blank" class="text-decoration-none"
                                title="Facebook">
                                <i class="bi bi-facebook" style="font-size: 1.5rem; color: #0064C8;"></i>
                            </a>
                            <a href="https://instagram.com" target="_blank" class="text-decoration-none"
                                title="Instagram">
                                <i class="bi bi-instagram" style="font-size: 1.5rem; color: #0064C8;"></i>
                            </a>
                            <a href="https://twitter.com" target="_blank" class="text-decoration-none"
                                title="Twitter">
                                <i class="bi bi-twitter" style="font-size: 1.5rem; color: #0064C8;"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Menu Section -->
                <div class="col-lg-2 col-6 footer-links">
                    <h4>Menu Utama</h4>
                    <ul>
                        <li><a href="{{ route('amoeba') }}#hero">Home</a></li>
                        <li><a href="{{ route('amoeba') }}#about">Tentang Kami</a></li>
                        <li><a href="{{ route('amoeba') }}#portfolio">Produk</a></li>
                        <li><a href="{{ route('amoeba') }}#contact">Kontak</a></li>
                    </ul>
                </div>

                <!-- Services Section -->
                <div class="col-lg-2 col-6 footer-links">
                    <h4>Layanan</h4>
                    <ul>
                        <li><a href="{{ route('amoeba') }}#services">Fasilitas</a></li>
                        <li><a href="{{ route('amoeba') }}#team">Tim Kami</a></li>
                        <li><a href="{{ route('amoeba') }}#portfolio">Counter</a></li>
                    </ul>
                </div>

                <!-- Contact Section -->
                <div class="col-lg-4 col-md-12 footer-contact">
                    <h4>Hubungi Kami</h4>
                    <p>
                        <strong><i class="bi bi-geo-alt"></i> Alamat:</strong> <br>Jl. Raya Ria Busana 85, Jakarta<br>
                        <strong><i class="bi bi-telephone"></i> Telepon:</strong> <br><a href="tel:+62211234567">+62
                            21-1234-567</a><br>
                        <strong><i class="bi bi-envelope"></i> Email:</strong> <br><a
                            href="mailto:info@riabusana85.com">info@riabusana85.com</a>
                    </p>
                </div>
            </div>

            <!-- Copyright Section -->
            <div class="row copyright mt-4 pt-4 border-top">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    <p class="mb-0">© <span>Copyright</span> <strong class="px-1 sitename">Ria Busana 85</strong>
                        <span>All Rights Reserved</span></p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <p class="mb-0">Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a> | Powered by
                        <a href="https://laravel.com" target="_blank">Laravel</a></p>
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
