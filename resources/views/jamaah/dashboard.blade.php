<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard Jamaah - PT SYAKIRASYA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        /* Definisi Palet Warna */
        :root {
            --bs-primary-navy: #003366; /* Navy Blue/Biru Tua - Warna Utama Perusahaan */
            --bs-accent-gold: #ffc107; /* Kuning Emas - Warna Aksen/Highlight */
            --bs-background-light: #f8f9fa; /* Background super lembut */
            --bs-soft-blue: #e9f0f8; /* Biru sangat muda untuk elemen background */
        }

        /* Utility Classes Custom */
        .text-primary-navy { color: var(--bs-primary-navy) !important; }
        .bg-primary-navy { background-color: var(--bs-primary-navy) !important; }
        .bg-accent-gold-light { background-color: rgba(255, 193, 7, 0.1) !important; }
        .shadow-lg-custom { box-shadow: 0 1rem 3rem rgba(0, 51, 102, 0.17) !important; }

        body {
            background-color: var(--bs-background-light);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #212529;
        }
        
        /* Header Dashboard */
        .dashboard-header {
            background: linear-gradient(135deg, var(--bs-primary-navy) 0%, #004d99 100%);
            color: #fff;
            padding: 3.5rem;
            border-radius: 1.5rem;
            box-shadow: 0 15px 40px rgba(0, 51, 102, 0.4);
            margin-bottom: 3.5rem;
        }

        .dashboard-header .bi-person-circle {
            font-size: 2.5rem;
            color: var(--bs-accent-gold) !important;
        }

        /* Section Heading */
        .section-heading {
            color: var(--bs-primary-navy);
            border-left: 5px solid var(--bs-accent-gold);
            padding-left: 1rem;
            padding-bottom: 0;
            font-weight: 700;
        }
        .section-heading i {
            color: var(--bs-accent-gold);
        }

        /* Kartu Status Aktif */
        .card-info {
            border: 1px solid var(--bs-soft-blue);
            border-radius: 1rem;
            box-shadow: 0 6px 25px rgba(0,0,0,.05);
            transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
            background-color: #ffffff;
        }
        .info-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.8rem 0;
            border-bottom: 1px solid var(--bs-soft-blue);
        }
        .info-item:last-of-type { border-bottom: none; }
        .info-item i {
            font-size: 1.2rem;
            margin-right: 1rem;
            min-width: 1.5rem;
        }
        .info-item strong {
            font-weight: 600;
            color: #6c757d;
        }
        .info-value {
            font-weight: 700;
            text-align: right;
            margin-left: auto;
        }

        /* Total Section Highlight */
        .total-highlight {
            background-color: var(--bs-primary-navy);
            color: #fff;
            padding: 1.5rem 1rem;
            border-radius: 0 0 1rem 1rem;
            margin-top: -1px;
        }
        .total-highlight .fs-4 {
            font-size: 1.6rem !important;
            color: var(--bs-accent-gold);
        }

        /* Badge Status */
        .status-badge {
            padding: .5rem 1.2rem;
            border-radius: 2rem;
            font-weight: 700;
            letter-spacing: 0.5px;
            min-width: 120px;
            text-align: center;
        }

        /* ===================================== */
        /* KARTU PAKET */
        /* ===================================== */

        .paket-scroll-container {
            display: flex;
            gap: 1.5rem; /* Jarak antar kartu sedikit dikurangi */
            overflow-x: auto;
            padding-bottom: 1.5rem;
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
        .paket-scroll-container::-webkit-scrollbar { display: none; }

        .paket-card {
            min-width: 320px; /* Lebar lebih kompak */
            background: #fff;
            border-radius: 1rem; /* Sedikit lebih kecil dari sebelumnya */
            box-shadow: 0 8px 20px rgba(0,0,0,0.08); /* Shadow lebih halus */
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            flex-shrink: 0;
            overflow: hidden;
            border: 1px solid var(--bs-soft-blue); /* Tambahkan border lembut */
        }
        .paket-card:hover {
            transform: translateY(-5px); /* Efek melayang lebih halus */
            box-shadow: 0 15px 35px rgba(0,0,0,0.12);
        }

        .paket-media {
            height: 200px; /* Tinggi Media (Gambar) dikurangi */
            position: relative;
            overflow: hidden;
        }
        .paket-media img, .paket-media .img-placeholder {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }
        .paket-card:hover .paket-media img {
            transform: scale(1.05); /* Zoom in pada hover */
        }
        
        /* Tag Durasi (Jika diperlukan di masa depan) */
        .paket-duration-tag {
            position: absolute;
            top: 15px;
            right: 0;
            background-color: var(--bs-primary-navy);
            color: #fff;
            padding: 0.3rem 1rem;
            border-radius: 100px 0 0 100px;
            font-weight: 600;
            box-shadow: 0 2px 8px rgba(0,0,0,0.2);
        }

        .paket-card-body {
            padding: 1.5rem;
            flex-grow: 1; /* Penting untuk layout flex */
        }

        .paket-title {
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--bs-primary-navy);
            margin-bottom: 0.25rem;
        }
        
        /* Penempatan Harga di Body Card */
        .paket-price-container {
            margin-top: 1rem;
            padding-top: 1rem;
            border-top: 1px dashed var(--bs-soft-blue);
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }

        .paket-price {
            font-size: 1.65rem;
            font-weight: 800;
            color: var(--bs-accent-gold);
            line-height: 1;
        }
        .paket-price small {
            font-size: 0.8rem;
            font-weight: 500;
            color: #6c757d;
            display: block;
            margin-bottom: 0.25rem;
        }

        .btn-daftar {
            padding: 0.85rem; /* Padding lebih besar */
            font-size: 1.05rem;
            font-weight: 600;
            border-radius: 0 0 1rem 1rem; /* Border radius menyatu dengan card */
            border: none;
            background-color: var(--bs-primary-navy);
            color: white;
            transition: background-color 0.3s;
        }
        .btn-daftar:hover {
            background-color: #004d99;
            color: white;
        }

        /* Mengatur posisi tombol Daftar agar berada di luar paket-card-body */
        .paket-card-footer-action {
            padding: 0;
        }
        
        /* ===================================== */
        /* CUSTOM FLOATING BUTTONS (Live Chat & WhatsApp) */
        /* ===================================== */

        /* Container untuk menampung kedua tombol di kanan bawah */
        .floating-action-container {
            position: fixed;
            bottom: 40px; 
            right: 40px; 
            z-index: 1000;
            display: flex;
            flex-direction: column; 
            align-items: flex-end; 
            gap: 15px; 
        }

        /* Gaya untuk tombol chat baru */
        .chat-float {
            width: 60px;
            height: 60px;
            background-color: var(--bs-primary-navy); 
            color: #FFF;
            border-radius: 50px;
            text-align: center;
            font-size: 30px;
            box-shadow: 2px 2px 3px #999;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            transition: all 0.3s ease;
            position: static; /* Dikelola oleh container */
        }
        .chat-float:hover {
            background-color: #004d99; 
            color: #FFF;
            transform: scale(1.05);
        }

        /* Tombol Live Chat yang lebih lebar */
        .chat-float-extended {
            width: auto;
            padding: 10px 20px;
            font-size: 1rem;
        }

        /* WhatsApp Button (Menggunakan styling yang diperbarui agar sesuai dengan container) */
        .whatsapp-float {
            position: static; /* Dikelola oleh container */
            bottom: unset;
            right: unset;
            width: 60px;
            height: 60px;
            background-color: #25d366;
            color: #FFF;
            border-radius: 50px;
            text-align: center;
            font-size: 30px;
            box-shadow: 2px 2px 3px #999;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        .whatsapp-float:hover {
            background-color: #128C7E;
            color: #FFF;
            transform: scale(1.05);
        }
    </style>
</head>
<body>

<div class="container my-5">

    <div class="dashboard-header d-flex flex-wrap justify-content-between align-items-center">
        <div>
            <h2 class="mb-1 fw-bolder">
                <i class="bi bi-person-circle me-3"></i>Selamat Datang, 
                {{ $user->name ?? 'Jamaah' }}
            </h2>
            <p class="lead mt-2 mb-0 opacity-90">Dashboard Personal Anda untuk memantau perjalanan ibadah.</p>
        </div>
        <div class="mt-3 mt-md-0">
            <form action="{{ route('logout') }}" method="POST" onsubmit="return confirm('Yakin ingin keluar dari akun ini?')">
                @csrf
                <button type="submit" class="btn btn-outline-light border-2 shadow-sm px-4 fw-medium">
                    <i class="bi bi-box-arrow-right me-1"></i> Logout
                </button>
            </form>
        </div>
    </div>

    <div class="row g-5"> 

        <div class="col-lg-5">
            <h4 class="mb-4 section-heading"><i class="bi bi-clipboard-check me-2"></i> Status Pendaftaran Aktif</h4>
            @if($pendaftaran)
                <div class="card card-info">
                    <div class="card-body">
                        
                        <div class="info-item">
                            <i class="bi bi-box-seam text-primary"></i> 
                            <strong>Paket Travel</strong> 
                            <span class="info-value text-primary-navy">{{ $pendaftaran->paketTravel->nama_paket ?? $pendaftaran->paket ?? '—' }}</span>
                        </div>
                        
                        <div class="info-item">
                            <i class="bi bi-calendar-event text-success"></i> 
                            <strong>Tgl. Berangkat</strong> 
                            <span class="info-value">
                                {{ $pendaftaran->paketTravel && $pendaftaran->paketTravel->tanggal_berangkat 
                                    ? $pendaftaran->paketTravel->tanggal_berangkat->format('d F Y') 
                                    : '—' }}
                            </span>
                        </div>
                        
                        <div class="info-item">
                            <i class="bi bi-check2-circle text-info"></i> 
                            <strong>ID Pendaftaran</strong> 
                            <span class="info-value text-muted small">#{{ $pendaftaran->id ?? '—' }}</span>
                        </div>

                        <div class="info-item border-0">
                            <i class="bi bi-info-circle text-warning"></i> 
                            <strong>Status Saat Ini</strong> 
                            @php
                                $status = $pendaftaran->status ?? '-';
                                $color = [
                                    'Lunas' => 'success', 
                                    'Pending' => 'warning', 
                                    'Batal' => 'danger',
                                    'Terkonfirmasi' => 'primary',
                                    'Acc' => 'primary',
                                ][$status] ?? 'secondary';
                            @endphp
                            <span class="info-value">
                                <span class="status-badge bg-{{ $color }} text-white shadow-sm">{{ ucfirst($status) }}</span>
                            </span>
                        </div>
                        
                    </div>
                    <div class="total-highlight d-flex justify-content-between align-items-center">
                        <strong class="text-white">Total Biaya Keseluruhan</strong>
                        <span class="fs-4 fw-bolder">Rp {{ number_format($totalPembayaran, 0, ',', '.') }}</span>
                    </div>
                </div>
                
                <small class="text-muted mt-3 d-block fst-italic px-1">
                    <i class="bi bi-envelope-fill me-1"></i>
                    Informasi penting lainnya (dokumen, jadwal manasik) akan dikirim via email/WA.
                </small>
            @else
                <div class="alert alert-info shadow-sm border-0 py-4 bg-accent-gold-light text-dark">
                    <h5 class="alert-heading fw-bold"><i class="bi bi-info-circle-fill me-2"></i> Belum Ada Pendaftaran Aktif</h5>
                    <p class="mb-0">Silakan jelajahi paket umrah/haji di bagian bawah untuk memulai pendaftaran.</p>
                </div>
            @endif
        </div>
        
        <div class="col-lg-7">
            <h4 class="mb-4 section-heading"><i class="bi bi-journal-text me-2"></i> Riwayat Pendaftaran</h4>
            @if($riwayat->count())
                <div class="card shadow rounded-3">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover align-middle mb-0">
                            <thead>
                                <tr class="text-center">
                                    <th class="text-start ps-4">Paket</th>
                                    <th>Berangkat</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                               @foreach ($riwayat as $r)
                                    @php
                                        if (
                                            empty($r->paketTravel) &&
                                            empty($r->paket)
                                        ) continue;
                                    @endphp

                                    <tr>
                                        {{-- Nama Paket --}}
                                        <td class="text-start ps-4 fw-medium text-primary-navy">
                                            {{ \Illuminate\Support\Str::limit($r->paketTravel->nama_paket ?? $r->paket ?? '—', 35) }}
                                        </td>

                                        {{-- Tanggal Berangkat --}}
                                        <td class="text-center text-muted small">
                                            @php
                                                $tanggal = $r->paketTravel->tanggal_berangkat ?? $r->tanggal_berangkat ?? null;
                                            @endphp
                                            {{ $tanggal ? \Carbon\Carbon::parse($tanggal)->format('d M Y') : '—' }}
                                        </td>

                                        {{-- Status --}}
                                        <td class="text-center">
                                            @php
                                                $status = ucfirst($r->status ?? '—');
                                                $color = match ($status) {
                                                    'Lunas' => 'success',
                                                    'Pending' => 'warning',
                                                    'Batal' => 'danger',
                                                    'Acc', 'Terkonfirmasi' => 'primary',
                                                    default => 'secondary',
                                                };
                                            @endphp
                                            <span class="badge bg-{{ $color }} fw-bold">{{ $status }}</span>
                                        </td>

                                        {{-- Tombol Detail --}}
                                        <td class="text-center">
                                            <a href="{{ route('jamaah.transaksi.show', $r->id) }}" class="btn btn-sm btn-outline-primary" title="Lihat detail pembayaran">
                                                <i class="bi bi-box-arrow-in-right"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @else
                <div class="alert alert-secondary border-0 py-3">
                    <i class="bi bi-x-octagon-fill me-2"></i> Tidak ada riwayat pendaftaran yang tercatat.
                </div>
            @endif
        </div>

    </div>

    <hr class="my-5 opacity-25">

    <section id="paket" class="section pt-3 pb-5">
        <h3 class="fw-bold mb-4 section-heading"><i class="bi bi-send-fill me-2"></i> Pilih Paket Perjalanan Terbaik</h3>

        @if($pakets->count())
            <div class="paket-scroll-container">
                @foreach($pakets as $paket)
                    <div class="paket-card d-flex flex-column">
                        
                        <div class="paket-media">
                            {{-- Tag Durasi (Opsional, jika ingin ditampilkan di gambar) --}}
                            <span class="paket-duration-tag">
                                {{ $paket->durasi_hari ?? '15' }} Hari
                            </span>
                            
                            @if($paket->gambar)
                                <img src="{{ asset('storage/'.$paket->gambar) }}" 
                                     alt="{{ $paket->nama_paket }}">
                            @else
                                <div class="d-flex justify-content-center align-items-center img-placeholder bg-light">
                                    <i class="bi bi-image-fill text-secondary fs-1"></i>
                                </div>
                            @endif
                        </div>
                        
                        <div class="paket-card-body">
                            <h4 class="paket-title">{{ $paket->nama_paket ?? 'Paket Ibadah' }}</h4>
                            <p class="text-muted small mb-0 flex-grow-1">
                                {{ \Illuminate\Support\Str::limit($paket->deskripsi ?? 'Deskripsi paket belum tersedia.', 70) }}
                            </p>
                            
                            {{-- Harga dipindahkan ke Body untuk penekanan --}}
                            <div class="paket-price-container">
                                <div class="paket-price">
                                    <small>Mulai dari</small>
                                    Rp {{ number_format($paket->harga ?? 0, 0, ',', '.') }}
                                </div>
                            </div>
                        </div>
                        
                        {{-- Elemen paket-meta Dihapus --}}
                        
                        <div class="paket-card-footer-action">
                             <a href="{{ route('pendaftaran.form', ['paket' => $paket->id]) }}" 
                               class="btn btn-daftar w-100">
                                Daftar Sekarang <i class="bi bi-arrow-right-circle-fill ms-2"></i>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="alert alert-secondary border-0 py-3">
                <i class="bi bi-x-octagon-fill me-2"></i> Maaf, belum ada paket perjalanan yang tersedia saat ini.
            </div>
        @endif
    </section>
    
</div>

<div class="floating-action-container">
    
    <a href="{{ route('jamaah.chat') }}" 
       class="chat-float chat-float-extended"
       data-bs-toggle="tooltip" 
       data-bs-placement="left" 
       title="Mulai Live Chat">
        <i class="bi bi-chat-dots-fill me-2"></i> Live Chat
    </a>

    <a href="https://wa.me/6281234567890?text=Halo%20Admin%2C%20saya%20ingin%20bertanya%20tentang%20status%20pendaftaran%20saya%20atas%20nama%20{{ $user->name ?? 'Jamaah' }}." 
       class="whatsapp-float" 
       target="_blank" 
       data-bs-toggle="tooltip" 
       data-bs-placement="left" 
       title="Hubungi Kami via WhatsApp">
        <i class="bi bi-whatsapp"></i>
    </a>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl)
    })
</script>
</body>
</html>