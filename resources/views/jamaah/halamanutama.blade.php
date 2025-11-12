
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>PT Syakirasya - Travel Haji & Umrah</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" />
  <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/css/lightbox.min.css" rel="stylesheet" />
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
</head>
<body>

<!-- Navbar -->
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark shadow-sm">
  <div class="container">
    <!-- Brand / Logo -->
    <a class="navbar-brand fw-bold d-flex align-items-center" href="#">
      <img src="{{ asset('img/logo.png') }}" alt="Logo" height="40" class="me-2">
      PT SYAKIRASYA
    </a>

    <!-- Toggle Button (Mobile) -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Menu -->
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto align-items-lg-center">
        <li class="nav-item">
          <a class="nav-link {{ request()->is('/') ? 'active fw-bold text-warning' : 'text-white' }}" href="#beranda">Beranda</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="#tentang">Tentang</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="#paket">Paket</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="#galeri">Galeri</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="#kontak">Kontak</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="#lokasi">Lokasi</a>
        </li>

        <!-- Auth Button -->
        @auth
          <form action="{{ route('logout') }}" method="POST" class="d-inline ms-3">
            @csrf
            <button type="submit" class="btn btn-light btn-sm fw-bold">🚪 Logout</button>
          </form>
        @else
          <li class="nav-item ms-3">
            <a class="btn btn-light btn-sm fw-bold" href="{{ route('login') }}"> Login</a>
          </li>
        @endauth
      </ul>
    </div>
  </div>
</nav>

<!-- Hero Section -->
<section id="beranda" 
         class="d-flex align-items-center" 
         style="height: 100vh; background: url('{{ asset('img/mekkah.jpg') }}') center/cover no-repeat; position: relative;">



<!-- Konten -->
<div class="container position-relative text-white" style="z-index: 2;">
  <div class="row">
    <div class="col-md-6" data-aos="fade-right">
      <h1 class="display-4 fw-bold">Selamat Datang di PT Syakirasya</h1>
      <p class="lead">Perjalanan Haji dan Umrah dengan pelayanan terbaik & terpercaya</p>
      
      <!-- Tombol Booking -->
      <a href="{{ route('pendaftaran.form', $paket->id ?? 1) }}" class="btn btn-lg rounded-pill mt-3 me-2 btn-sky">

  🛫 Booking Sekarang
</a>
    </div>
  </div>
</div>


</section>

<!-- Tentang Kami -->
<section id="tentang" class="py-5">
  <div class="container">
    <div class="row align-items-center">
      
      <!-- Kolom Kiri -->
      <div class="col-md-6 mb-4">
        <h2 class="fw-bold" style="color: #00d9ffff;">Tentang Kami</h2>
        <p>
          <strong>PT Syakirasya</strong> adalah perusahaan resmi yang bergerak di bidang jasa perjalanan
          <span class="fw-bold" style="color: #000000ff;">Umrah dan Haji</span>
          Kami berkomitmen memberikan pelayanan terbaik, aman, dan nyaman 
          untuk setiap jamaah yang ingin menunaikan ibadah suci.
        </p>

        <!-- Highlight Box -->
        <div class="highlight-box">
          <strong>✅ Sudah Berizin Resmi</strong><br>
          IZIN 02090100218880001 - Tahun 2023 (Kemenag RI)
        </div>

        <!-- Checklist Poin -->
        <ul class="list-unstyled text-start mt-3">
          <li>✨ <strong>Berpengalaman</strong> lebih dari 10 tahun melayani jamaah</li>
          <li>🕌 <strong>Fasilitas Nyaman</strong> mulai dari akomodasi hingga transportasi</li>
          <li>📑 <strong>Legalitas Terjamin</strong> resmi terdaftar di Kementerian Agama</li>
        </ul>

        <h5 class="mt-4" style="color: skyblue;">Kantor Pusat</h5>
        <p>Jl. Raya Mauk KM 12, Desa Kosambi, Sukadiri, Kabupaten Tangerang</p>
      </div>

      <!-- Kolom Kanan -->
      <div class="col-md-6 text-center">
        <img src="{{ asset('img/Tentang.jpg') }}" alt="Tentang Kami">
      </div>

    </div>
  </div>
</section>

<!-- Paket -->
<section id="paket" class="section">
  <div class="container">
    <h2 class="fw-bold" style="color: #00d9ffff;">Paket haji & umrah</h2>
    <div class="paket-scroll-container">
      @foreach($pakets as $paket)
      <div class="paket-card">
        @if($paket->gambar)
        <img src="{{ asset('storage/'.$paket->gambar) }}" alt="{{ $paket->nama_paket }}">
        @endif
        <h3>{{ $paket->nama_paket }}</h3>
        <p>Rp {{ number_format($paket->harga, 0, ',', '.') }}</p>
        <a href="{{ url('paket/'.$paket->id) }}" class="btn-detail">Detail</a>
      </div>
      @endforeach
    </div>
  </div>
</section>
<!-- Modal Paket -->
<div class="modal" id="modalPaket">
  <div class="modal-content">
    <span class="close" onclick="tutupModal()">&times;</span>
    <h3 id="modalPaketNama"></h3>
    <p>Silakan klik tombol di bawah untuk melanjutkan proses booking paket ini.</p>
    <a href="#booking" onclick="isiBookingPaket()" class="btn-daftar">📥 Booking Sekarang</a>
  </div>
</div>

<!-- KEUNGGULAN -->
<!-- KEUNGGULAN -->
<section id="keunggulan" class="section py-5" style="background-color: #e0f7ff;">
  <div class="text-center py-5">
    <h2 class="mb-5 fw-bold" style="color: #007BFF;">Kenapa Pilih PT Syakirasya?</h2>
    <div class="container">
      <div class="row g-4">

        <!-- Card 1 -->
        <div class="col-md-4">
          <div class="card hover-card p-4 h-100 text-center shadow-sm border-0" 
               style="transition: transform 0.3s, box-shadow 0.3s;">
            <img src="{{ asset('img/resmi.svg') }}" height="60" alt="Resmi">
            <h5 class="mt-3 fw-bold" style="color: #87CEEB;">Resmi & Terdaftar</h5>
            <p>Agen Umrah & Haji resmi Kemenag RI, aman, dan terpercaya sehingga perjalanan Anda lebih tenang.</p>
          </div>
        </div>

        <!-- Card 2 -->
        <div class="col-md-4">
          <div class="card hover-card p-4 h-100 text-center shadow-sm border-0"
               style="transition: transform 0.3s, box-shadow 0.3s;">
            <img src="{{ asset('img/bimbingan.svg') }}" height="60" alt="Bimbingan">
            <h5 class="mt-3 fw-bold" style="color: #87CEEB;">Bimbingan Lengkap</h5>
            <p>Didampingi pembimbing ibadah & berpengalaman yang siap memandu dari awal hingga akhir perjalanan.</p>
          </div>
        </div>

        <!-- Card 3 -->
        <div class="col-md-4">
          <div class="card hover-card p-4 h-100 text-center shadow-sm border-0"
               style="transition: transform 0.3s, box-shadow 0.3s;">
            <img src="{{ asset('img/hotel.svg') }}" height="60" alt="Hotel">
            <h5 class="mt-3 fw-bold" style="color: #87CEEB;">Hotel Nyaman</h5>
            <p>Akomodasi dekat Masjidil Haram & Nabawi.</p>
          </div>
        </div>

        <!-- Card 4 -->
        <div class="col-md-4">
          <div class="card hover-card p-4 h-100 text-center shadow-sm border-0"
               style="transition: transform 0.3s, box-shadow 0.3s;">
            <img src="{{ asset('img/money.svg') }}" height="60" alt="Harga">
            <h5 class="mt-3 fw-bold" style="color: #87CEEB;">Harga Transparan</h5>
            <p>Tanpa biaya tersembunyi, sesuai paket yang dipilih. Semua jelas, detail, dan transparan.</p>
          </div>
        </div>

        <!-- Card 5 -->
        <div class="col-md-4">
          <div class="card hover-card p-4 h-100 text-center shadow-sm border-0"
               style="transition: transform 0.3s, box-shadow 0.3s;">
            <img src="{{ asset('img/jadwal.svg') }}" height="60" alt="Jadwal">
            <h5 class="mt-3 fw-bold" style="color: #87CEEB;">Jadwal Fleksibel</h5>
            <p>Beragam pilihan paket dan jadwal keberangkatan, memudahkan jamaah menyesuaikan dengan waktu yang tersedia.</p>
          </div>
        </div>

        <!-- Card 6 -->
        <div class="col-md-4">
          <div class="card hover-card p-4 h-100 text-center shadow-sm border-0"
               style="transition: transform 0.3s, box-shadow 0.3s;">
            <img src="{{ asset('img/jam.svg') }}" height="60" alt="Support">
            <h5 class="mt-3 fw-bold" style="color: #87CEEB;">Support 24 Jam</h5>
            <p>Tim support siap membantu jamaah kapanpun diperlukan, baik sebelum, saat, maupun setelah ibadah.</p>
          </div>
        </div>

      </div>
    </div>
  </div>
</section>

<style>
  .hover-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 10px 25px rgba(0, 123, 255, 0.2);
  }
</style>


<!-- Galeri -->
<section id="galeri" class="section bg-light py-5">
  <div class="container text-center">
     <h2 class="fw-bold" style="color: #00d9ffff;">Galeri</h2>
    <div class="row justify-content-center g-3">
      @for ($i = 1; $i <= 9; $i++)
        <div class="col-6 col-md-3 galeri-item">
          <a href="{{ asset("img/galeri$i.jpg") }}" data-lightbox="galeri" data-title="Umrah {{ $i }}">
            <div class="galeri-wrapper">
              <img src="{{ asset("img/galeri$i.jpg") }}" class="img-fluid" alt="Umrah {{ $i }}" />
              <div class="overlay"><i class="fas fa-search-plus"></i></div>
            </div>
          </a>
        </div>
      @endfor
    </div>
  </div>
</section>


<!-- Kontak -->
<section id="kontak" class="kontak-section">
  <div class="container">
    <h2 class="kontak-title">Kontak Kami</h2>
    <div class="kontak-card">
      <p><i class="fas fa-map-marker-alt"></i> 
        <strong>Alamat:</strong><br>
        Jl. Raya Mauk Km.12, Desa Kosambi, Kec.Sukadiri, Kabupaten Tangerang
      </p>
      <p><i class="fas fa-phone-alt"></i> 
        <strong>Telepon:</strong><br>
        <a href="tel:081295730907">0812-9573-0907</a>
      </p>
      <p><i class="fas fa-envelope"></i> 
        <strong>Email:</strong><br>
        <a href="mailto:info@syakirasya.co.id">info@syakirasya.co.id</a>
      </p>

      <!-- Tombol WhatsApp -->
      <a href="https://wa.me/6281295730907" target="_blank" class="btn-wa">
        <i class="fab fa-whatsapp"></i> Hubungi Kami via WhatsApp
      </a>

      <!-- Sosial Media -->
      <div class="sosmed">
        <a href="https://instagram.com/syakirasyagroup" target="_blank" class="ig" title="Ikuti Instagram Kami">
          <i class="fab fa-instagram"></i>
        </a>
        <a href="https://tiktok.com/@syakirasyagroup" target="_blank" class="tt" title="Ikuti TikTok Kami">
          <i class="fab fa-tiktok"></i>
        </a>
      </div>
    </div>
  </div>
</section>

<!-- Font Awesome (harus ada ini di <head>) -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

  <!-- lokasi -->
    <section id="lokasi" class="section">
    <div class="map-container">
      <iframe
        src="https://www.google.com/maps?q=Jl.%20Raya%20Mauk%20KM%2012%20Kosambi%20Sukadiri%20Tangerang&output=embed"
        width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy"
        referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
  </div>
</section>

<!-- Testimoni -->
<section id="testimoni" class="py-5 overflow-hidden" style="background: linear-gradient(to bottom, #f0f9ff, #ffffff);">
  <div class="container text-center">
    <h2 class="mb-5 text-primary fw-bold" data-aos="fade-up">💬 Testimoni Jamaah</h2>
  </div>

  <div class="testimoni-scroll-container">
    <div class="testimoni-scroll-content">
      
      <div class="testimoni-card">
        <p class="fst-italic">"Pelayanan luar biasa, ustadz/ustadzahnya sabar, dan akomodasi sangat nyaman. Pengalaman umroh yang tak terlupakan!"</p>
        <h5 class="fw-semibold text-primary mt-3">🌟 Siti Aisyah - Jakarta</h5>
      </div>
      <div class="testimoni-card">
        <p class="fst-italic">"Harga terjangkau dengan fasilitas bintang lima. Semua berjalan lancar dari awal hingga akhir. Sangat merekomendasikan travel ini."</p>
        <h5 class="fw-semibold text-primary mt-3">🌟 Budi Santoso - Surabaya</h5>
      </div>
      <div class="testimoni-card">
        <p class="fst-italic">"Alhamdulillah, bisa beribadah dengan khusyuk. Timnya sangat membantu dan komunikatif. Terima kasih banyak!"</p>
        <h5 class="fw-semibold text-primary mt-3">🌟 Fatimah Az-Zahra - Bandung</h5>
      </div>
      <div class="testimoni-card">
        <p class="fst-italic">"Rencana perjalanan matang, tidak ada kendala berarti. Semuanya on-time dan profesional. Terbaik!"</p>
        <h5 class="fw-semibold text-primary mt-3">🌟 Ahmad Yani - Yogyakarta</h5>
      </div>
      <div class="testimoni-card">
        <p class="fst-italic">"Sangat puas dengan bimbingan ibadah yang intensif. Semoga bisa berangkat lagi tahun depan!"</p>
        <h5 class="fw-semibold text-primary mt-3">🌟 Kartika Dewi - Medan</h5>
      </div>
      
      <div class="testimoni-card">
        <p class="fst-italic">"Pelayanan luar biasa, ustadz/ustadzahnya sabar, dan akomodasi sangat nyaman. Pengalaman umroh yang tak terlupakan!"</p>
        <h5 class="fw-semibold text-primary mt-3">🌟 Siti Aisyah - Jakarta</h5>
      </div>
      <div class="testimoni-card">
        <p class="fst-italic">"Harga terjangkau dengan fasilitas bintang lima. Semua berjalan lancar dari awal hingga akhir. Sangat merekomendasikan travel ini."</p>
        <h5 class="fw-semibold text-primary mt-3">🌟 Budi Santoso - Surabaya</h5>
      </div>
      <div class="testimoni-card">
        <p class="fst-italic">"Alhamdulillah, bisa beribadah dengan khusyuk. Timnya sangat membantu dan komunikatif. Terima kasih banyak!"</p>
        <h5 class="fw-semibold text-primary mt-3">🌟 Fatimah Az-Zahra - Bandung</h5>
      </div>
      <div class="testimoni-card">
        <p class="fst-italic">"Rencana perjalanan matang, tidak ada kendala berarti. Semuanya on-time dan profesional. Terbaik!"</p>
        <h5 class="fw-semibold text-primary mt-3">🌟 Ahmad Yani - Yogyakarta</h5>
      </div>
      <div class="testimoni-card">
        <p class="fst-italic">"Sangat puas dengan bimbingan ibadah yang intensif. Semoga bisa berangkat lagi tahun depan!"</p>
        <h5 class="fw-semibold text-primary mt-3">🌟 Kartika Dewi - Medan</h5>
      </div>

    </div>
  </div>
</section>



<!-- Footer -->
<footer class="text-white text-center py-4" style="background-color: #87CEEB;">
  <div class="container">
    <footer class="text-center text-muted py-2" style="font-size: 0.85rem; border-top:1px solid #ccc;">
  Travel Management System ® 2025 - Version 2.7.25 || PT. SYAKIRASYA WISATA MANDIRI © Hajj & Umroh Service
  <br>
  <a href="https://wa.me/62881012454138" target="_blank" class="text-decoration-none text-success">
    Hubungi Developer - Version 2.7.25
  </a>
    <div class="d-flex justify-content-center gap-4">
      <a href="https://instagram.com/syakirasyagroup" target="_blank" class="text-white fs-5">
        <i class="bi bi-instagram"></i> Instagram
      </a>
      <a href="https://facebook.com/SyakirasyaUmroh" target="_blank" class="text-white fs-5">
        <i class="bi bi-facebook"></i> Facebook
      </a>
    </div>
  </div>
</footer>

<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>AOS.init();</script>
<script src="{{ asset('js/script.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/js/lightbox.min.js"></script>

<!-- WhatsApp Floating -->
<a href="https://wa.me/6281295730907?text=Assalamu%20alaikum%20saya%20ingin%20bertanya%20tentang%20travel%20umrah"
   class="floating-whatsapp"
   target="_blank">
  <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" alt="WhatsApp" class="wa-icon">
  <span class="wa-text">Hubungi Kami</span>
</a>
</body>
</html>
