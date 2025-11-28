<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ria Busana 85</title>
    <link href="{{ asset('amoeba-assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('amoeba-assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('amoeba-assets/css/main.css') }}" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('amoeba-assets/img/logo rb no bg.png') }}">
</head>

<body>
    <header id="header" class="header d-flex align-items-center sticky-top">
        <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">
            <a href="{{ route('amoeba') }}" class="logo d-flex align-items-center">
                <img src="{{ asset('amoeba-assets/img/logo rb.png') }}" alt="Ria Busana 85 Logo">
                <h1 class="sitename">Ria Busana 85</h1>
            </a>
            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="#hero" class="active">Home</a></li>
                    <li><a href="#about">About</a></li>
                    <li><a href="#services">Layanan</a></li>
                    <li><a href="#portfolio">Counter</a></li>
                    <li><a href="#team">Staff</a></li>
                    <li><a href="#contact">Kontak</a></li>
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
                        <h2>Selamat datang di Ria Busana 85</h2>
                        <p>Bangga, Bersama, Kita Hebat, Jaya Jaya Jaya</p>
                        <a href="#about" class="btn-get-started">Mulai Sekarang</a>
                    </div>
                </div>
            </div>
        </section>

        <!-- About Section -->
        <section id="about" class="about section">
            <div class="container" data-aos="fade-up">
                <div class="row gx-0">
                    <div class="col-lg-6 d-flex flex-column justify-content-center" data-aos="fade-up"
                        data-aos-delay="200">
                        <div class="content">
                            <h3>Tentang Toko</h3>
                            <h2>Kenapa Harus RB 85</h2>
                            <p>Karena Koleksi lengkap untuk seluruh keluarga Produk berkualitas & nyaman digunakan selain itu Harga nya murah sebelum diskon.</p>
                            <p>Kami adalah toko busana modern yang menghadirkan pilihan pakaian baru yang sedang tren. Dengan koleksi yang selalu mengikuti tren, kami berkomitmen untuk memberikan pengalaman berbelanja yang nyaman, mudah, dan terpercaya.</p>
                        </div>
                    </div>
                    <div class="col-lg-6 d-flex align-items-center" data-aos="zoom-out" data-aos-delay="200">
                        <img src="{{ asset('amoeba-assets/img/RB About.jpg') }}" class="img-fluid" alt="">
                    </div>
                </div>
            </div>
        </section>

        <!-- Services Section -->
        <section id="services" class="services section light-background">
            <div class="container" data-aos="fade-up">
                <div class="section-title">
                    <h2>Fasilitas</h2>
                    <p>Fasilitas yang tersedia di Ria Busana 85</p>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-6 service-item d-flex" data-aos="fade-up" data-aos-delay="100">
                        <div class="icon flex-shrink-0"><i class="bi bi-shop"></i></div>
                        <div>
                            <h4>Toko Modern</h4>
                            <p>Toko dengan desain modern dan nyaman untuk berbelanja</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 service-item d-flex" data-aos="fade-up" data-aos-delay="200">
                        <div class="icon flex-shrink-0"><i class="bi bi-tags"></i></div>
                        <div>
                            <h4>Koleksi Lengkap</h4>
                            <p>Berbagai pilihan busana dari berbagai brand ternama</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 service-item d-flex" data-aos="fade-up" data-aos-delay="300">
                        <div class="icon flex-shrink-0"><i class="bi bi-person-check"></i></div>
                        <div>
                            <h4>Pelayanan Profesional</h4>
                            <p>Staff yang ramah dan profesional siap membantu Anda</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Portfolio Section -->
        <section id="portfolio" class="portfolio section">
            <div class="container" data-aos="fade-up">
                <div class="section-title">
                    <h2>Produk</h2>
                    <p>Koleksi produk kami per counter</p>
                </div>

                @forelse($counters as $counter)
                    <div class="row mb-5">
                        <div class="col-12 mb-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <h3 class="mb-0">{{ $counter->nama }} - {{ $counter->lokasi }}</h3>
                                <a href="{{ route('counter.detail', $counter) }}" class="btn btn-light btn-sm">
                                    <i class="bi bi-eye"></i> Lihat Tim & Detail
                                </a>
                            </div>
                            <hr class="my-2">
                        </div>
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
                                        <p class="card-text text-muted">{{ Str::limit($product->deskripsi, 100) }}</p>
                                        <h6 class="card-text text-primary">Rp
                                            {{ number_format($product->harga, 0, ',', '.') }}</h6>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <p class="text-muted">Tidak ada produk untuk counter ini.</p>
                            </div>
                        @endforelse
                    </div>
                @empty
                    <div class="row">
                        <div class="col-12">
                            <p class="text-center text-muted">Belum ada data counter.</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </section><!-- End Portfolio Section -->

        <!-- Promo Section -->
        <section id="promo" class="promo section light-background">
            <div class="container" data-aos="fade-up">
                <div class="section-title">
                    <h2>Promosi Terbaru</h2>
                    <p>Penawaran spesial dan diskon menarik</p>
                </div>

                @if ($promos->isNotEmpty())
                    <div class="row gy-4">
                        @forelse($promos as $promo)
                            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                                <div class="card h-100 shadow-sm">
                                    @if ($promo->product->gambar)
                                        <img src="{{ asset('upload/produk/' . $promo->product->gambar) }}" 
                                             class="card-img-top"
                                             alt="{{ $promo->product->nama }}" 
                                             style="height: 200px; object-fit: cover;">
                                    @else
                                        <div class="card-img-top bg-secondary d-flex align-items-center justify-content-center"
                                            style="height: 200px;">
                                            <i class="bi bi-image" style="font-size: 3rem; color: #ccc;"></i>
                                        </div>
                                    @endif
                                    
                                    <!-- Badge Diskon -->
                                    <div style="position: absolute; top: 10px; right: 10px; background: #dc3545; color: white; padding: 5px 10px; border-radius: 50%; font-weight: bold; font-size: 18px;">
                                        -{{ $promo->diskon }}%
                                    </div>

                                    <div class="card-body">
                                        <h5 class="card-title">{{ $promo->product->nama }}</h5>
                                        <p class="card-text text-muted" style="font-size: 0.9rem;">{{ Str::limit($promo->deskripsi, 80) }}</p>
                                        
                                        <!-- Harga Lama -->
                                        <p class="mb-2">
                                            <span class="text-muted" style="text-decoration: line-through;">
                                                Rp {{ number_format($promo->harga_asli, 0, ',', '.') }}
                                            </span>
                                        </p>
                                        
                                        <!-- Harga Baru -->
                                        <h5 class="card-text text-danger" style="font-weight: bold;">
                                            Rp {{ number_format($promo->harga_setelah_diskon, 0, ',', '.') }}
                                        </h5>
                                        
                                        <!-- Periode -->
                                        <p class="text-muted" style="font-size: 0.85rem;">
                                            <i class="bi bi-calendar-event"></i> 
                                            {{ date('d M', strtotime($promo->mulai)) }} - {{ date('d M Y', strtotime($promo->berakhir)) }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @empty
                        @endforelse
                    </div>
                @else
                    <div class="row">
                        <div class="col-12">
                            <p class="text-center text-muted">Tidak ada promosi aktif saat ini.</p>
                        </div>
                    </div>
                @endif
            </div>
        </section><!-- End Promo Section -->

        <!-- Team Section -->
        <section id="team" class="team section">
            <div class="container" data-aos="fade-up">
                <div class="section-title">
                    <h2>Tim Kami</h2>
                    <p>Staff dan karyawan Ria Busana 85</p>
                </div>

                @php
                    $staffWithoutCounter = $staff->filter(fn($s) => $s->counter_id === null);
                @endphp

                <!-- Team Staff (Non-Counter Only) -->
                @if ($staffWithoutCounter->isNotEmpty())
                    <div class="mb-5">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h4 class="text-center flex-grow-1">Staff Umum</h4>
                            <a href="{{ route('staff.index') }}" class="btn btn-sm btn-primary">Lihat Semua</a>
                        </div>
                        <div class="row">
                            @forelse($staffWithoutCounter->take(3) as $member)
                                <div class="col-lg-4 col-md-6 team-member" data-aos="fade-up" data-aos-delay="100">
                                    <div class="card h-100 text-center">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $member->nama }}</h5>
                                            <p class="card-text text-muted">{{ $member->jabatan }}</p>
                                        </div>
                                    </div>
                                </div>
                            @empty
                            @endforelse
                        </div>
                    </div>
                @else
                    <div class="row">
                        <div class="col-12">
                            <p class="text-center text-muted">Belum ada data staff umum.</p>
                        </div>
                    </div>
                @endif
            </div>
        </section><!-- End Team Section -->

        <!-- Contact Section -->
        <section id="contact" class="contact section">
            <div class="container" data-aos="fade-up" data-aos-delay="100">
                <div class="section-title">
                    <h2>Hubungi Kami</h2>
                    <p>Informasi Kontak Ria Busana 85</p>
                </div>

                <div class="row mb-5">
                    <div class="col-lg-4 info-item d-flex flex-column justify-content-center" data-aos="fade-up"
                        data-aos-delay="200">
                        <i class="bi bi-geo-alt"></i>
                        <h3>Alamat</h3>
                        <p>Jl. Raya Ria Busana 85<br>Jakarta, IndonesiaJalan Ahmad Yani No. 129-131, Ciwalen, Garut, Jawa Barat, 44161</p>
                    </div>

                    <div class="col-lg-4 info-item d-flex flex-column justify-content-center" data-aos="fade-up"
                        data-aos-delay="300">
                        <i class="bi bi-telephone"></i>
                        <h3>Telepon</h3>
                        <p>+62 21-1234-5678</p>
                    </div>

                    <div class="col-lg-4 info-item d-flex flex-column justify-content-center" data-aos="fade-up"
                        data-aos-delay="400">
                        <i class="bi bi-envelope"></i>
                        <h3>Email</h3>
                        <p>info@riabusana85.com</p>
                    </div>
                </div>

                <div class="section-title mt-5">
                    <h2>Lokasi Toko</h2>
                </div>

                <div class="row">
                    <div class="col-lg-12" data-aos="fade-up" data-aos-delay="200">
                        <div class="card h-100">
                            <div class="card-body">
                                <!-- Ganti URL Google Maps dengan lokasi Ria Busana 85 Anda -->
                                <iframe width="100%" height="400" style="border:0; border-radius: 4px;"
                                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.757089!2d106.8241!3d-6.2088!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f3f!2sRia%20Busana%2085!5e0!3m2!1sid!2sid!4v1234567890"
                                    allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                                </iframe>
                            </div>
                        </div>
                    </div>
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
                        <img src="{{ asset('amoeba-assets/img/logo rb no bg.png') }}" alt="Ria Busana 85 Logo" style="max-height: 45px;">
                        <span class="sitename ms-2 fw-bold">Ria Busana 85</span>
                    </a>
                    <p>Toko busana modern terpercaya dengan koleksi lengkap dan pelayanan profesional.</p>
                    <!-- Social Links -->
                    <div class="mt-3">
                        <p class="mb-2"><strong>Follow Us:</strong></p>
                        <div class="d-flex gap-2">
                            <a href="https://facebook.com" target="_blank" class="text-decoration-none" title="Facebook">
                                <i class="bi bi-facebook" style="font-size: 1.5rem; color: #0064C8;"></i>
                            </a>
                            <a href="https://instagram.com" target="_blank" class="text-decoration-none" title="Instagram">
                                <i class="bi bi-instagram" style="font-size: 1.5rem; color: #0064C8;"></i>
                            </a>
                            <a href="https://twitter.com" target="_blank" class="text-decoration-none" title="Twitter">
                                <i class="bi bi-twitter" style="font-size: 1.5rem; color: #0064C8;"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Menu Section -->
                <div class="col-lg-2 col-6 footer-links">
                    <h4>Menu Utama</h4>
                    <ul>
                        <li><a href="#hero">Home</a></li>
                        <li><a href="#about">Tentang Kami</a></li>
                        <li><a href="#portfolio">Produk</a></li>
                        <li><a href="#contact">Kontak</a></li>
                    </ul>
                </div>

                <!-- Services Section -->
                <div class="col-lg-2 col-6 footer-links">
                    <h4>Layanan</h4>
                    <ul>
                        <li><a href="#services">Fasilitas</a></li>
                        <li><a href="#team">Tim Kami</a></li>
                        <li><a href="#portfolio">Counter</a></li>
                    </ul>
                </div>

                <!-- Contact Section -->
                <div class="col-lg-4 col-md-12 footer-contact">
                    <h4>Hubungi Kami</h4>
                    <p>
                        <strong><i class="bi bi-geo-alt"></i> Alamat:</strong> <br>Jalan Ahmad Yani No. 129-131, Ciwalen, Garut, Jawa Barat, 44161<br>
                        <strong><i class="bi bi-telephone"></i> Telepon:</strong> <br><a href="tel:+62211234567">+62 21-1234-567</a><br>
                        <strong><i class="bi bi-envelope"></i> Email:</strong> <br><a href="mailto:info@riabusana85.com">info@riabusana85.com</a>
                    </p>
                </div>
            </div>

            <!-- Copyright Section -->
            <div class="row copyright mt-4 pt-4 border-top">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    <p class="mb-0">© <span>Copyright</span> <strong class="px-1 sitename">Ria Busana 85</strong> <span>All Rights Reserved</span></p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <p class="mb-0">Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a> | Powered by <a href="https://laravel.com" target="_blank">Laravel</a></p>
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
