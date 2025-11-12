<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard - PT Syakirasya</title>
    
    {{-- Bootstrap & Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    
    {{-- Google Font (Sudah Modern) --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        /* Variabel Warna Kustom (Deep Sapphire & Soft Aqua) */
        :root {
            --bs-primary-dark: #003366;    /* Deep Sapphire Blue */
            --bs-primary-blue: #004780;    /* Biru Primer */
            --bs-sidebar-bg: #003366;      /* Deep Sapphire Blue */
            --bs-light-gray: #f8f9fa;      /* Hampir Putih */
            --bs-accent-light: #4ECDC4;    /* Soft Aqua/Cyan */
            --bs-success-soft: #d4edda;
            --bs-warning-soft: #fff3cd;
            --bs-info-soft: #d1ecf1;
        }
        
        body { 
            background-color: var(--bs-light-gray); 
            font-family: 'Poppins', sans-serif; 
            color: #212529; /* Warna teks lebih gelap */
        }

        /* Sidebar Styling - Lebih Minimalis & Kontras */
        .sidebar {
            height: 100vh;
            background-color: var(--bs-sidebar-bg);
            padding: 0;
            position: fixed;
            top: 0;
            left: 0;
            width: 250px; /* Sedikit lebih lebar */
            box-shadow: 6px 0 15px rgba(0,0,0,0.15); /* Bayangan lebih kuat */
            z-index: 1030;
            transition: transform 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94); /* Smooth transition */
        }
        
        /* Media Queries (Tidak Berubah) */
        @media (max-width: 767.98px) {
            .sidebar {
                transform: translateX(-250px);
            }
            .sidebar.show {
                transform: translateX(0);
            }
            .main-content {
                padding-left: 1rem !important; 
            }
        }

        @media (min-width: 768px) {
            .main-content {
                margin-left: 250px; /* Offset konten utama disesuaikan */
                width: calc(100% - 250px);
            }
            .main-content .topbar-wrapper {
                margin-top: 1.5rem; /* Jarak atas lebih besar */
            }
        }
        
        .sidebar-brand {
            padding: 2rem 1.5rem 1rem; /* Padding lebih besar */
            color: #ffffff;
            font-size: 1.6rem;
            font-weight: 700;
            border-bottom: 1px solid rgba(255, 255, 255, 0.15);
            margin-bottom: 0.5rem;
        }
        .sidebar-brand i {
            color: var(--bs-accent-light); /* Icon dengan warna accent */
        }

        .sidebar .list-group-item {
            background-color: transparent;
            color: rgba(255, 255, 255, 0.85);
            border-radius: 0;
            padding: 1rem 1.5rem;
            border: none;
            border-left: 5px solid transparent; 
            transition: all 0.3s;
            font-weight: 500;
        }

        .sidebar .list-group-item i {
            font-size: 1.1rem; /* Icon sedikit lebih besar */
            width: 20px;
        }

        .sidebar .list-group-item:hover {
            background-color: rgba(255, 255, 255, 0.1);
            color: #fff;
            border-left-color: var(--bs-accent-light); /* Accent light saat hover */
        }

        .sidebar .list-group-item.active {
            background-color: var(--bs-primary-blue); /* Kontras lebih baik */
            font-weight: 600;
            border-left: 5px solid #ffc107; /* Aksen Emas/Kuning pada Item Aktif */
            color: #fff;
            box-shadow: inset 0 0 10px rgba(0, 0, 0, 0.2);
        }

        .sidebar form button {
            border-top: 1px solid rgba(255, 255, 255, 0.2);
            color: #ffcccc !important; /* Merah muda lembut */
            margin-top: auto; 
            width: 100%;
            text-align: left;
        }

        /* Topbar & Main Content Wrapper */
        .topbar-wrapper {
            padding: 0 1rem;
            margin-top: 1rem;
        }

        .topbar {
            background-color: white;
            padding: 1.2rem 2rem;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
            border-radius: 15px; /* Radius lebih besar untuk premium feel */
            margin-bottom: 1.5rem;
            border: 1px solid #e9ecef;
        }
        .topbar h4 {
            color: var(--bs-primary-dark);
            font-weight: 700;
        }
        .topbar .btn-outline-primary {
            border-color: var(--bs-accent-light);
            color: var(--bs-accent-light);
        }
        
        /* Card statistik - Modern & Visual */
        .stat-card {
            border: none;
            border-radius: 18px; /* Radius sangat besar */
            box-shadow: 0 8px 20px rgba(0,0,0,0.08);
            overflow: hidden;
            position: relative;
            transition: transform 0.3s ease;
        }
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 25px rgba(0,0,0,0.12);
        }
        .stat-card .card-icon-overlay {
            position: absolute;
            top: 15px;
            right: 20px;
            font-size: 4rem;
            opacity: 0.1;
            color: var(--bs-primary-blue);
            z-index: 1;
        }

        .stat-card h6 { 
            color: #6c757d; /* Teks judul lebih soft */
            font-weight: 500;
            margin-bottom: 0.5rem;
        }
        .stat-card .stat-value {
            font-size: 2.2rem;
            font-weight: 800;
            z-index: 2;
            position: relative;
        }
        
        /* Card Transaksi - Background Soft */
        .card-transaction-stat {
            border-radius: 12px;
            border: none;
            padding: 0.8rem 1rem;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
            transition: all 0.2s;
        }
        .card-transaction-stat:hover {
            transform: translateY(-3px);
        }
        .card-transaction-stat h6 {
            font-weight: 600;
            font-size: 0.9rem;
            opacity: 0.9;
        }
        .card-transaction-stat h4 {
            font-weight: 700;
            font-size: 1.5rem;
        }

        .bg-success-soft { background-color: var(--bs-success-soft); color: #004724; }
        .bg-info-soft { background-color: var(--bs-info-soft); color: #003049; }
        .bg-warning-soft { background-color: var(--bs-warning-soft); color: #664d03; }
        .bg-secondary-soft { background-color: #e2e3e5; color: #495057; }


        /* Table Styling - Clean & Modern */
        .table-responsive {
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            background-color: #fff;
        }
        .table {
            --bs-table-bg: #fff;
        }
        .table thead {
            background-color: var(--bs-primary-blue);
            color: white;
        }
        .table th {
            font-weight: 600;
            padding: 1rem 1.2rem;
        }
        .table td {
            padding: 1rem 1.2rem;
        }
        .table tbody tr:hover {
            background-color: #f4f7fa;
        }
        .table tbody tr:nth-of-type(odd) {
            background-color: #fcfcfc;
        }

        /* Profil card - Lebih Elegan */
        .profile-card {
            background-color: #fff; 
            border-radius: 15px; 
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
            border-left: 6px solid var(--bs-accent-light);
        }
        .profile-card h5 { 
            font-weight: 700; 
            color: var(--bs-primary-dark);
        }
        .profile-card img {
            border: 3px solid var(--bs-primary-blue);
        }

        /* Tombol & Modal Styling */
        .btn-primary, .bg-primary, .modal-header.bg-primary {
            background-color: var(--bs-primary-blue) !important;
            border-color: var(--bs-primary-blue) !important;
        }
        .btn-info {
            background-color: var(--bs-accent-light) !important;
            border-color: var(--bs-accent-light) !important;
        }
        .btn-outline-primary {
            color: var(--bs-primary-blue);
            border-color: var(--bs-primary-blue);
        }
        .btn-outline-primary:hover {
            background-color: var(--bs-primary-blue);
            color: white;
        }

        /* Styling untuk Notifikasi Dropdown */
        .dropdown-menu-end { right: 0; left: auto; }
        .notification-item { padding: 0.75rem 1rem; border-bottom: 1px solid #eee; }
        .notification-item:last-child { border-bottom: none; }
        .notification-item small { font-size: 0.8rem; }
        .notification-badge { position: absolute; top: 0; right: 0; }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row min-vh-100">
        
        {{-- ========================= SIDEBAR ========================= --}}
        <nav class="col-md-2 sidebar flex-column" id="adminSidebar">
            <div class="sidebar-brand">
                <i class="bi bi-rocket-takeoff-fill me-2"></i> SYAKIRASYA
            </div>
            
            <div class="list-group flex-grow-1">
                <a href="#dashboard" class="list-group-item list-group-item-action active" data-bs-toggle="tab">
                    <i class="bi bi-house-door-fill me-2"></i> Dashboard
                </a>
                <a href="#paket" class="list-group-item list-group-item-action" data-bs-toggle="tab">
                    <i class="bi bi-box-seam-fill me-2"></i> Data Paket
                </a>
                <a href="#jamaah" class="list-group-item list-group-item-action" data-bs-toggle="tab">
                    <i class="bi bi-people-fill me-2"></i> Data Jamaah
                </a>
                <a href="#booking" class="list-group-item list-group-item-action" data-bs-toggle="tab">
                    <i class="bi bi-journal-check me-2"></i> Booking Jamaah
                </a>
               <a href="#transaksi" class="list-group-item list-group-item-action" data-bs-toggle="tab">
                     <i class="bi bi-wallet2 me-2"></i> Transaksi
                </a>
                <a href="#karyawan" class="list-group-item list-group-item-action" data-bs-toggle="tab">
                    <i class="bi bi-person-workspace me-2"></i> Data Karyawan
                </a>
                <a href="#agent" class="list-group-item list-group-item-action" data-bs-toggle="tab">
                    <i class="bi bi-person-badge-fill me-2"></i> Data Agent
                </a>
                <a href="#profil" class="list-group-item list-group-item-action" data-bs-toggle="tab">
                    <i class="bi bi-person-circle me-2"></i> Profil Admin
                </a>
            </div>
            
            {{-- Logout Button --}}
            <form action="{{ route('logout') }}" method="POST" class="mt-auto">
                @csrf
                {{-- Tambah kelas 'text-danger' untuk aksen logout --}}
                <button type="submit" class="list-group-item list-group-item-action text-danger">
                    <i class="bi bi-box-arrow-right me-2"></i> Logout
                </button>
            </form>
        </nav>
        
        {{-- Overlay untuk mobile --}}
        <div class="sidebar-overlay d-md-none" onclick="toggleSidebar()"></div>

        {{-- ========================= MAIN CONTENT ========================= --}}
        <main class="main-content col-12 col-md-10 px-4">
            <div class="topbar-wrapper">
                {{-- TOPBAR --}}
                <div class="topbar d-flex justify-content-between align-items-center">
                    {{-- Toggle button untuk mobile --}}
                    <button class="btn btn-sm btn-outline-primary d-md-none me-2" onclick="toggleSidebar()">
                        <i class="bi bi-list"></i>
                    </button>
                    
                    <h4 class="mb-0">Manajemen Admin <span class="text-secondary fw-500 d-none d-sm-inline">PT SYAKIRASYA</span></h4>
                    
                    <div class="d-flex align-items-center gap-3">
                        
                        {{-- 🔔 FITUR BARU: Dropdown Notifikasi --}}
                        <div class="dropdown">
                            @php
                                // Menghitung notifikasi pending
                                $pendingBookings = collect($pendaftaran ?? [])->where('status', 'pending')->count();
                                $pendingTransactions = collect($transaksis ?? [])->where('status', 'pending')->count();
                                $totalNotifications = $pendingBookings + $pendingTransactions;
                            @endphp
                            
                            <button class="btn btn-light position-relative" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-bell-fill text-primary fs-5"></i>
                                @if($totalNotifications > 0)
                                <span class="badge bg-danger rounded-pill notification-badge">{{ $totalNotifications > 9 ? '9+' : $totalNotifications }}</span>
                                @endif
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end shadow-lg" style="min-width: 300px;">
                                <li class="dropdown-header fw-bold text-primary">Notifikasi Baru ({{ $totalNotifications }})</li>
                                
                                @if($pendingBookings > 0)
                                <li class="notification-item">
                                    <a class="dropdown-item p-0 d-flex align-items-center" href="#booking" data-bs-toggle="tab">
                                        <i class="bi bi-journal-check me-2 text-warning fs-5"></i> 
                                        <div>
                                            <span class="fw-semibold">Booking Baru</span>
                                            <small class="d-block text-muted">{{ $pendingBookings }} pendaftaran menunggu persetujuan.</small>
                                        </div>
                                    </a>
                                </li>
                                @endif

                                @if($pendingTransactions > 0)
                                <li class="notification-item">
                                    <a class="dropdown-item p-0 d-flex align-items-center" href="#transaksi" data-bs-toggle="tab">
                                        <i class="bi bi-wallet2 me-2 text-danger fs-5"></i> 
                                        <div>
                                            <span class="fw-semibold">Transaksi Pending</span>
                                            <small class="d-block text-muted">{{ $pendingTransactions }} pembayaran perlu dikonfirmasi.</small>
                                        </div>
                                    </a>
                                </li>
                                @endif

                                @if($totalNotifications === 0)
                                <li class="notification-item text-center text-muted">Semua aman!</li>
                                @endif
                                <li class="dropdown-divider"></li>
                                <li><a class="dropdown-item text-center text-primary" href="#">Lihat Semua</a></li>
                            </ul>
                        </div>
                        {{-- END Dropdown Notifikasi --}}
                        
                        <span class="text-muted d-none d-sm-inline fw-medium">
                            <i class="bi bi-person-fill me-1 text-primary"></i> 
                            Halo, {{ Auth::user()->nama ?? 'Admin' }}!
                        </span>
                    </div>
                </div>
            </div>

            <div class="tab-content pt-1">
                
                {{-- ========================= TAB DASHBOARD ========================= --}}
                <div class="tab-pane fade show active" id="dashboard">
                    <h5 class="mb-4 text-secondary fw-bold">
                        <i class="bi bi-bar-chart-fill me-2 text-primary"></i> Ringkasan Kinerja
                    </h5>

                    {{-- ⚠️ FITUR BARU: Peringatan Cepat (Quick Alert) --}}
                    @if($pendingBookings > 0 || $pendingTransactions > 0)
                    <div class="alert alert-warning alert-dismissible fade show shadow-sm" role="alert">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i> **PERINGATAN!** Ada tugas yang perlu ditindaklanjuti segera:
                        <ul>
                            @if($pendingBookings > 0)
                                <li>**{{ $pendingBookings }}** Booking Jamaah baru menunggu persetujuan. <a href="#booking" data-bs-toggle="tab" class="alert-link fw-semibold">Cek di sini.</a></li>
                            @endif
                            @if($pendingTransactions > 0)
                                <li>**{{ $pendingTransactions }}** Transaksi pembayaran menunggu konfirmasi. <a href="#transaksi" data-bs-toggle="tab" class="alert-link fw-semibold">Cek di sini.</a></li>
                            @endif
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                    {{-- END Peringatan Cepat --}}

                    {{-- 🔹 Statistik Utama --}}
                    <div class="row g-4">
                        {{-- Total Paket --}}
                        <div class="col-lg-4 col-md-6">
                            <div class="card stat-card shadow-sm border-0">
                                <div class="card-body position-relative">
                                    <i class="bi bi-box-seam-fill card-icon-overlay text-info"></i>
                                    <h6>Total Paket Tersedia</h6>
                                    {{-- Menggunakan variabel dari controller. Jika tidak ada, gunakan 0. --}}
                                    <p class="stat-value text-primary mb-0">{{ $totalPaket ?? '0' }}</p> 
                                    <small class="text-muted">Paket Umrah & Haji</small>
                                </div>
                            </div>
                        </div>

                        {{-- Total Jamaah --}}
                        <div class="col-lg-4 col-md-6">
                            <div class="card stat-card shadow-sm border-0">
                                <div class="card-body position-relative">
                                    <i class="bi bi-people-fill card-icon-overlay text-success"></i>
                                    <h6>Total Data Jamaah</h6>
                                    {{-- Menggunakan variabel dari controller. Jika tidak ada, gunakan 0. --}}
                                    <p class="stat-value text-success mb-0">{{ $totalJamaah ?? '0' }}</p> 
                                    <small class="text-muted">Pengguna terdaftar</small>
                                </div>
                            </div>
                        </div>

                        {{-- Total Booking --}}
                        <div class="col-lg-4 col-md-6">
                            <div class="card stat-card shadow-sm border-0">
                                <div class="card-body position-relative">
                                    <i class="bi bi-journal-check card-icon-overlay text-warning"></i>
                                    <h6>Total Booking</h6>
                                    {{-- Menggunakan variabel dari controller. Jika tidak ada, gunakan 0. --}}
                                    <p class="stat-value text-warning mb-0">{{ $pendaftarans->count() ?? '0' }}</p>
                                    <small class="text-muted">Semua status pendaftaran</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- 🔹 Statistik Transaksi --}}
                    <h5 class="mt-5 mb-3 text-secondary fw-bold">
                        <i class="bi bi-cash-stack me-2 text-primary"></i> Status Transaksi Keuangan
                    </h5>
                    <div class="row g-4">
                        <div class="col-lg-3 col-md-6">
                            <div class="card card-transaction-stat bg-success-soft shadow-sm border-0">
                                <div class="card-body p-3">
                                    <h6><i class="bi bi-check-circle-fill me-1"></i> Total Lunas</h6>
                                    <h4 class="fw-bold">Rp {{ number_format($totalLunas ?? 0, 0, ',', '.') }}</h4>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6">
                            <div class="card card-transaction-stat bg-info-soft shadow-sm border-0">
                                <div class="card-body p-3">
                                    <h6><i class="bi bi-bank me-1"></i> Total Tabungan/Angsuran</h6>
                                    <h4 class="fw-bold">Rp {{ number_format($totalTabungan ?? 0, 0, ',', '.') }}</h4>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6">
                            <div class="card card-transaction-stat bg-warning-soft shadow-sm border-0">
                                <div class="card-body p-3">
                                    <h6><i class="bi bi-credit-card-2-front-fill me-1"></i> Total DP</h6>
                                    <h4 class="fw-bold">Rp {{ number_format($totalDP ?? 0, 0, ',', '.') }}</h4>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6">
                            <div class="card card-transaction-stat bg-secondary-soft shadow-sm border-0">
                                <div class="card-body p-3">
                                    <h6><i class="bi bi-clock-history me-1"></i> Total Pending</h6>
                                    <h4 class="fw-bold">Rp {{ number_format($totalPendingTransaksi ?? 0, 0, ',', '.') }}</h4>
                                </div>
                            </div>
                            {{-- 🔹 Live Chat Section --}}
<div class="mt-5">
    <h5 class="text-secondary fw-bold mb-3">
        <i class="bi bi-chat-dots-fill me-2 text-primary"></i> Fitur Komunikasi
    </h5>

    <div class="card shadow-sm border-0 bg-light">
        <div class="card-body d-flex flex-column flex-sm-row align-items-center justify-content-between">
            <div>
                <h6 class="fw-bold mb-1">💬 Live Chat Jamaah</h6>
                <p class="text-muted mb-0">Buka percakapan langsung dengan jamaah tanpa harus menggunakan WhatsApp.</p>
            </div>
            <a href="{{ route('admin.chat') }}" class="btn btn-primary mt-3 mt-sm-0">
                <i class="bi bi-chat-text-fill me-1"></i> Buka Live Chat
            </a>
        </div>
    </div>
</div>

                        </div>
                    </div>
                </div>

                
                {{-- ========================= TAB PAKET ========================= --}}
                <div class="tab-pane fade" id="paket">
                    <h5 class="mt-3 mb-3 text-secondary fw-bold"><i class="bi bi-box-seam-fill me-2 text-primary"></i> Manajemen Data Paket Travel</h5>
                    
                    <button class="btn btn-primary mb-3 shadow-sm" data-bs-toggle="modal" data-bs-target="#tambahPaketModal">
                        <i class="bi bi-plus-circle me-1"></i> Tambah Paket Baru
                    </button>
                    
                    <div class="table-responsive">
                        <table class="table table-striped table-hover align-middle">
                            <thead>
                                <tr>
                                    <th>Gambar</th>
                                    <th>Nama Paket</th>
                                    <th>Harga</th>
                                    <th>Jadwal Berangkat</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pakets ?? [] as $paket) 
                                <tr>
                                    <td>
                                        @if(isset($paket->gambar))
                                            <img src="{{ asset('storage/'.$paket->gambar) }}" alt="Gambar Paket" width="70" class="rounded-3 shadow-sm">
                                        @else
                                            <i class="bi bi-image-fill text-muted fs-4"></i>
                                        @endif
                                    </td>
                                    <td class="fw-semibold">{{ $paket->nama_paket ?? 'Contoh Paket' }}</td>
                                    <td class="text-success fw-medium">Rp {{ number_format($paket->harga ?? 15000000,0,',','.') }}</td>
                                    <td><i class="bi bi-calendar-event me-1 text-primary"></i> {{ \Carbon\Carbon::parse($paket->tanggal_berangkat ?? now())->format('d M Y') }}</td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-info text-white me-1" data-bs-toggle="modal" data-bs-target="#editPaketModal{{ $paket->id ?? 'dummy' }}" title="Edit">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>
                                        <form action="{{ route('paket.destroy',$paket->id ?? 'dummy') }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin hapus paket ini?')" title="Hapus">
                                                <i class="bi bi-trash-fill"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>

                                {{-- Modal Edit Paket --}}
                                <div class="modal fade" id="editPaketModal{{ $paket->id ?? 'dummy' }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        {{-- Formulir Edit Paket --}}
                                        <form action="{{ route('paket.update',$paket->id ?? 'dummy') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-content">
                                                <div class="modal-header bg-info text-white">
                                                    <h5 class="modal-title"><i class="bi bi-pencil-square me-1"></i> Edit Paket: {{ $paket->nama_paket ?? 'Contoh' }}</h5>
                                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                     {{-- Isi Form Edit --}}
                                                    <div class="mb-3">
                                                        <label class="form-label fw-medium">Nama Paket</label>
                                                        <input type="text" name="nama_paket" class="form-control" value="{{ $paket->nama_paket ?? 'Contoh Paket' }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label fw-medium">Harga (Rp)</label>
                                                        <input type="number" name="harga" class="form-control" value="{{ $paket->harga ?? 15000000 }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label fw-medium">Tanggal Berangkat</label>
                                                        <input type="date" name="tanggal_berangkat" class="form-control" value="{{ \Carbon\Carbon::parse($paket->tanggal_berangkat ?? now())->format('Y-m-d') }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label fw-medium">Deskripsi</label>
                                                        <textarea name="deskripsi" class="form-control" rows="3">{{ $paket->deskripsi ?? 'Deskripsi belum diisi.' }}</textarea>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label fw-medium">Gambar Paket</label>
                                                        <input type="file" name="gambar" class="form-control">
                                                        @if(isset($paket->gambar))
                                                            <small class="text-muted d-block mt-2">Gambar saat ini:</small>
                                                            <img src="{{ asset('storage/'.$paket->gambar) }}" width="80" class="mt-1 rounded-3">
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-info text-white">Simpan Perubahan</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-4">
                                        <i class="bi bi-emoji-neutral me-1"></i> Belum ada data paket travel.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- Modal Tambah Paket (Tidak Diubah) --}}
                <div class="modal fade" id="tambahPaketModal" tabindex="-1">
                    <div class="modal-dialog">
                        <form action="{{ route('paket.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-content">
                                <div class="modal-header bg-primary text-white">
                                    <h5 class="modal-title"><i class="bi bi-plus-circle me-1"></i> Tambah Paket Baru</h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label class="form-label fw-medium">Nama Paket</label>
                                        <input type="text" name="nama_paket" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-medium">Harga (Rp)</label>
                                        <input type="number" name="harga" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-medium">Tanggal Berangkat</label>
                                        <input type="date" name="tanggal_berangkat" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-medium">Deskripsi</label>
                                        <textarea name="deskripsi" class="form-control" rows="3" required></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-medium">Gambar Paket</label>
                                        <input type="file" name="gambar" class="form-control">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary">Tambah Paket</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>


                {{-- ========================= TAB JAMA'AH ========================= --}}
                <div class="tab-pane fade" id="jamaah">
                    <h5 class="mt-3 mb-3 text-secondary fw-bold"><i class="bi bi-people-fill me-2 text-primary"></i> Manajemen Data Jamaah</h5>
                    
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <button class="btn btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#tambahJamaahModal">
                            <i class="bi bi-person-plus-fill me-1"></i> Tambah Jamaah
                        </button>
                        
                        {{-- 🔍 FITUR BARU: Search Jamaah --}}
                        <div class="input-group" style="max-width: 300px;">
                            <span class="input-group-text bg-white border-end-0"><i class="bi bi-search text-muted"></i></span>
                            <input type="text" id="searchJamaah" class="form-control border-start-0" placeholder="Cari Nama/Email Jamaah...">
                        </div>
                        {{-- END Search Jamaah --}}
                    </div>
                    
                    <div class="table-responsive">
                        <table class="table table-striped table-hover align-middle" id="tableJamaah">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>No. HP</th>
                                    <th>Status Akun</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($jamaah ?? [] as $j)
                                <tr>
<<<<<<< HEAD
                                    <td class="fw-medium">{{ $j->name }}</td>
                                    <td>{{ $j->email }}</td>
                                    <td>{{ $j->no_hp }}</td>
                                    <td><span class="badge bg-success"><i class="bi bi-check-circle-fill me-1"></i> Aktif</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-info text-white" data-bs-toggle="modal" data-bs-target="#editJamaahModal{{ $j->id }}"><i class="bi bi-pencil-square"></i></button>
                                        <form action="{{ route('jamaah.destroy',$j->id) }}" method="POST" class="d-inline">
=======
                                    <td class="fw-semibold">{{ $j->name ?? $j->nama ?? 'Nama Jamaah' }}</td>
                                    <td>{{ $j->email ?? 'email@contoh.com' }}</td>
                                    <td>{{ $j->no_hp ?? '0812xxxxxx' }}</td>
                                    <td><span class="badge bg-success py-2 px-3 fw-medium"><i class="bi bi-check-circle-fill me-1"></i> Aktif</span></td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-info text-white me-1" data-bs-toggle="modal" data-bs-target="#editJamaahModal{{ $j->id ?? 'dummy' }}" title="Edit">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>
                                        <form action="{{ route('jamaah.destroy',$j->id ?? 'dummy') }}" method="POST" class="d-inline">
>>>>>>> 961fc8259019e6948cce34e45fc51862ebdc4083
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin hapus jamaah ini?')" title="Hapus">
                                                <i class="bi bi-trash-fill"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>

                                {{-- Modal Edit Jamaah (Tidak Diubah) --}}
                                <div class="modal fade" id="editJamaahModal{{ $j->id ?? 'dummy' }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <form action="{{ route('jamaah.update',$j->id ?? 'dummy') }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-content">
                                                <div class="modal-header bg-info text-white">
<<<<<<< HEAD
                                                    <h5 class="modal-title">Edit Jamaah: {{ $j->name }}</h5>
=======
                                                    <h5 class="modal-title"><i class="bi bi-pencil-square me-1"></i> Edit Jamaah: {{ $j->nama ?? 'Contoh' }}</h5>
>>>>>>> 961fc8259019e6948cce34e45fc51862ebdc4083
                                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label class="form-label fw-medium">Nama</label>
<<<<<<< HEAD
                                                        <input type="text" name="name" class="form-control" value="{{ $j->name }}" required>
=======
                                                        <input type="text" name="nama" class="form-control" value="{{ $j->nama ?? 'Nama Jamaah' }}" required>
>>>>>>> 961fc8259019e6948cce34e45fc51862ebdc4083
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label fw-medium">Email</label>
                                                        <input type="email" name="email" class="form-control" value="{{ $j->email ?? 'email@contoh.com' }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label fw-medium">No. HP</label>
                                                        <input type="text" name="no_hp" class="form-control" value="{{ $j->no_hp ?? '0812xxxxxx' }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label fw-medium">Password Baru (Opsional)</label>
                                                        <input type="password" name="password" class="form-control" placeholder="Kosongkan jika tidak diubah">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-info text-white">Simpan Perubahan</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-4">
                                        <i class="bi bi-emoji-neutral me-1"></i> Belum ada data jamaah terdaftar.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- Modal Tambah Jamaah (Tidak Diubah) --}}
                <div class="modal fade" id="tambahJamaahModal" tabindex="-1">
                    <div class="modal-dialog">
                        <form action="{{ route('jamaah.store') }}" method="POST">
                            @csrf
                            <div class="modal-content">
                                <div class="modal-header bg-primary text-white">
                                    <h5 class="modal-title"><i class="bi bi-person-plus-fill me-1"></i> Tambah Jamaah Baru</h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label class="form-label fw-medium">Nama</label>
                                        <input type="text" name="name" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-medium">Email</label>
                                        <input type="email" name="email" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-medium">No. HP</label>
                                        <input type="text" name="no_hp" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-medium">Password (Awal)</label>
                                        <input type="password" name="password" class="form-control" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary">Tambah Jamaah</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>


                {{-- ========================= TAB BOOKING ========================= --}}
                <div class="tab-pane fade" id="booking">
                    <h5 class="mt-3 mb-4 text-secondary fw-bold"><i class="bi bi-journal-check me-2 text-primary"></i> Daftar Booking & Konfirmasi</h5>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover align-middle">
                            <thead>
                                <tr>
                                    <th>Nama & HP</th>
                                    <th>Paket</th>
                                    <th>Dokumen (KTP/KK)</th>
                                    <th>Catatan</th>
                                    <th>Status</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
<<<<<<< HEAD
                                @foreach($pendaftaran as $item)
<tr>
    <td>
        <span class="fw-medium">{{ $item->user->name }}</span><br>
        <small class="text-muted">{{ $item->user->no_hp }}</small>
    </td>
    <td>{{ $item->paketTravel->nama_paket }}</td>
    <td>
        @if($item->ktp)
            <a href="{{ asset('storage/'.$item->ktp) }}" target="_blank" class="badge bg-primary me-1">
                <i class="bi bi-file-text-fill"></i> KTP
            </a>
        @else
            -
        @endif
=======
                                @forelse($pendaftaran ?? [] as $item)
                                <tr>
                                    <td>
                                        <span class="fw-semibold">{{ $item->user->name ?? 'Nama Pengguna' }}</span><br>
                                        <small class="text-muted">{{ $item->user->no_hp ?? '08xxxx' }}</small>
                                    </td>
                                    <td>{{ $item->paketTravel->nama_paket ?? 'Paket Default' }}</td>
                                    <td>
                                        @if(isset($item->ktp))
                                            <a href="{{ asset('storage/'.$item->ktp) }}" target="_blank" class="badge bg-primary me-1 py-1 px-2 fw-medium">
                                                <i class="bi bi-file-text-fill"></i> KTP
                                            </a>
                                        @else
                                            -
                                        @endif
>>>>>>> 961fc8259019e6948cce34e45fc51862ebdc4083

                                        @if(isset($item->kk))
                                            <a href="{{ asset('storage/'.$item->kk) }}" target="_blank" class="badge bg-primary py-1 px-2 fw-medium">
                                                <i class="bi bi-file-text-fill"></i> KK
                                            </a>
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>{{ $item->catatan ?? '-' }}</td>
                                    <td>
                                        @if(($item->status ?? 'pending') == 'pending')
                                            <span class="badge bg-warning text-dark py-2 px-3 fw-medium">
                                                <i class="bi bi-hourglass-split me-1"></i> Pending
                                            </span>
                                        @elseif($item->status == 'acc')
                                            <span class="badge bg-success py-2 px-3 fw-medium">
                                                <i class="bi bi-check-circle-fill me-1"></i> Diterima
                                            </span>
                                        @else
                                            <span class="badge bg-danger py-2 px-3 fw-medium">
                                                <i class="bi bi-x-circle-fill me-1"></i> Ditolak
                                            </span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if(($item->status ?? 'pending') == 'pending')
                                            <form action="{{ route('admin.pendaftaran.acc', $item->id ?? 'dummy') }}" method="POST" class="d-inline">
                                                @csrf
                                                <button class="btn btn-sm btn-success mb-1 me-1" title="Setujui Pendaftaran">
                                                    <i class="bi bi-check"></i> ACC
                                                </button>
                                            </form>

                                            <form action="{{ route('admin.pendaftaran.tolak', $item->id ?? 'dummy') }}" method="POST" class="d-inline">
                                                @csrf
                                                <button class="btn btn-sm btn-danger mb-1" title="Tolak Pendaftaran">
                                                    <i class="bi bi-x"></i> Tolak
                                                </button>
                                            </form>
                                        @elseif($item->status == 'acc')
                                            <a href="{{ route('invoice.create', $item->id ?? 'dummy') }}" class="btn btn-sm btn-primary" title="Buat Dokumen Invoice">
                                                <i class="bi bi-file-earmark-text-fill"></i> Invoice
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-4">
                                        <i class="bi bi-journal-x me-1"></i> Belum ada data booking jamaah.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div> 

                
                {{-- ========================= TAB TRANSAKSI ========================= --}}
                <div class="tab-pane fade" id="transaksi" role="tabpanel" aria-labelledby="transaksi-tab">
                    <h5 class="mt-3 mb-3 text-secondary fw-bold">
                        <i class="bi bi-wallet2 me-2 text-primary"></i> Data Transaksi Jamaah
                    </h5>

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        {{-- Tombol Tambah Transaksi Baru --}}
                        <button type="button" class="btn btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#storeTransaksiModal">
                            <i class="bi bi-plus-circle me-1"></i> Tambah Transaksi Baru
                        </button>
                        
                        {{-- 🔍 FITUR BARU: Search Transaksi --}}
                        <div class="input-group" style="max-width: 300px;">
                            <span class="input-group-text bg-white border-end-0"><i class="bi bi-search text-muted"></i></span>
                            <input type="text" id="searchTransaksi" class="form-control border-start-0" placeholder="Cari Jamaah/Paket...">
                        </div>
                        {{-- END Search Transaksi --}}
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover align-middle" id="tableTransaksi">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Jamaah</th>
                                    <th>Paket</th>
                                    <th>Jumlah</th>
                                    <th>Status</th>
                                    <th>Jenis Pembayaran</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($transaksis ?? [] as $index => $t)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td class="fw-medium">{{ $t->user->name ?? 'Jamaah X' }}</td> 
                                    <td>
                                        {{ $t->pendaftaran && $t->pendaftaran->paketTravel 
                                            ? $t->pendaftaran->paketTravel->nama_paket 
                                            : 'Paket Umrah' }}
                                    </td>
                                    <td class="text-success fw-semibold">Rp {{ number_format($t->total ?? 0, 0, ',', '.') }}</td>
                                    <td>
                                        @if (($t->status ?? 'pending') == 'pending')
                                            <span class="badge bg-warning text-dark py-1 px-2 fw-medium">Pending</span>
                                        @elseif ($t->status == 'acc')
                                            <span class="badge bg-success py-1 px-2 fw-medium">Acc</span>
                                        @else
                                            <span class="badge bg-secondary py-1 px-2 fw-medium">{{ ucfirst($t->status) }}</span>
                                        @endif
                                    </td>
                                    @php
                                        $metode = strtolower($t->metode_pembayaran ?? 'dp');
                                    @endphp
                                    <td>
                                        @if ($metode == 'dp')
                                            <span class="badge bg-info text-dark py-1 px-2 fw-medium">DP</span>
                                        @elseif ($metode == 'tabungan')
                                            <span class="badge bg-primary py-1 px-2 fw-medium">Tabungan</span>
                                        @elseif ($metode == 'lunas')
                                            <span class="badge bg-success py-1 px-2 fw-medium">Lunas</span>
                                        @else
                                            <span class="badge bg-secondary py-1 px-2 fw-medium">-</span>
                                        @endif
                                    </td>
                                    <td class="d-flex gap-1 justify-content-center">
                                        {{-- 🔄 Ubah Status --}}
                                        <form action="{{ route('transaksi.updateStatus', $t->id ?? 'dummy') }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <select name="status" onchange="this.form.submit()" class="form-select form-select-sm shadow-sm" style="min-width: 90px;">
                                                <option value="pending" {{ ($t->status ?? 'pending') == 'pending' ? 'selected' : '' }}>Pending</option>
                                                <option value="acc" {{ ($t->status ?? '') == 'acc' ? 'selected' : '' }}>Acc</option>
                                                <option value="tolak" {{ ($t->status ?? '') == 'tolak' ? 'selected' : '' }}>Tolak</option>
                                            </select>
                                        </form>

                                        {{-- ✏️ Edit Nominal (Modal) --}}
                                        <button type="button" class="btn btn-sm btn-outline-primary"
                                            data-bs-toggle="modal"
                                            data-bs-target="#editNominalModal{{ $t->id ?? 'dummy' }}" title="Edit Nominal">
                                            <i class="bi bi-pencil"></i>
                                        </button>

                                        {{-- ➕ Tambah Nominal (Modal) --}}
                                        <button type="button" class="btn btn-sm btn-outline-success"
                                            data-bs-toggle="modal"
                                            data-bs-target="#tambahNominalModal{{ $t->id ?? 'dummy' }}" title="Tambah Angsuran">
                                            <i class="bi bi-plus-lg"></i>
                                        </button>

                                        {{-- 🗑️ Hapus Transaksi --}}
                                        <form action="{{ route('transaksi.destroy', $t->id ?? 'dummy') }}" method="POST"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus transaksi ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                    
                                    {{-- MODAL EDIT NOMINAL (Hanya contoh placeholder) --}}
                                    <div class="modal fade" id="editNominalModal{{ $t->id ?? 'dummy' }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <form action="{{ route('transaksi.updateNominal', $t->id ?? 'dummy') }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <div class="modal-content">
                                                    <div class="modal-header bg-primary text-white">
                                                        <h5 class="modal-title"><i class="bi bi-pencil me-1"></i> Edit Nominal & Metode Pembayaran</h5>
                                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <label class="form-label fw-medium">Nominal Baru (Rp)</label>
                                                        <input type="number" name="jumlah" class="form-control" 
                                                            value="{{ $t->total ?? 1000000 }}" required min="1">

                                                        <label class="form-label mt-3 fw-medium">Metode Pembayaran</label>
                                                        <select name="metode_pembayaran" class="form-select">
                                                            <option value="DP" {{ ($t->metode_pembayaran ?? 'DP') == 'DP' ? 'selected' : '' }}>DP</option>
                                                            <option value="Tabungan" {{ ($t->metode_pembayaran ?? '') == 'Tabungan' ? 'selected' : '' }}>Tabungan</option>
                                                            <option value="Lunas" {{ ($t->metode_pembayaran ?? '') == 'Lunas' ? 'selected' : '' }}>Lunas</option>
                                                        </select>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                    {{-- MODAL TAMBAH NOMINAL (Angsuran) (Hanya contoh placeholder) --}}
                                    <div class="modal fade" id="tambahNominalModal{{ $t->id ?? 'dummy' }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <form action="{{ route('transaksi.tambahNominal', $t->id ?? 'dummy') }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <div class="modal-content">
                                                    <div class="modal-header bg-success text-white">
                                                        <h5 class="modal-title"><i class="bi bi-plus-lg me-1"></i> Tambah Nominal Pembayaran (Angsuran)</h5>
                                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <label class="form-label fw-medium">Nominal Tambahan (Rp)</label>
                                                        <input type="number" name="tambah_jumlah" class="form-control" placeholder="Masukkan nominal tambahan" required min="1">

                                                        <label class="form-label mt-3 fw-medium">Metode Pembayaran Setelah Ditambah</label>
                                                        <select name="metode_pembayaran" class="form-select">
                                                            <option value="Tabungan" {{ ($t->metode_pembayaran ?? 'Tabungan') == 'Tabungan' ? 'selected' : '' }}>Tabungan</option>
                                                            <option value="Lunas" {{ ($t->metode_pembayaran ?? '') == 'Lunas' ? 'selected' : '' }}>Lunas</option>
                                                        </select>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-success">Tambah Nominal</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted py-4">
                                        <i class="bi bi-wallet-fill me-1"></i> Belum ada transaksi.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- MODAL TAMBAH TRANSAKSI BARU (Tidak Diubah) --}}
                <div class="modal fade" id="storeTransaksiModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-primary text-white">
                                <h5 class="modal-title"><i class="bi bi-plus-circle me-1"></i> Tambah Transaksi Baru</h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                            </div>

                            <form action="{{ route('transaksi.store') }}" method="POST">
                                @csrf
                                <div class="modal-body">
                                    {{-- Pilih Jamaah --}}
                                    <div class="mb-3">
                                        <label class="form-label fw-medium">Pilih Jamaah *</label>
                                        <select name="user_id" class="form-select" required>
                                            <option value="">-- Pilih Jamaah --</option>
                                            {{-- Pastikan $jamaahList tersedia di controller --}}
                                            @foreach (($jamaahList ?? []) as $j) 
                                                <option value="{{ $j->id }}">{{ $j->name ?? 'Jamaah Dummy' }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                    {{-- Pilih Pendaftaran (Paket Travel) --}}
                                    <div class="mb-3">
                                        <label class="form-label fw-medium">Pilih Paket Travel *</label>
                                        <select name="pendaftaran_id" class="form-select" required>
                                            <option value="">-- Pilih Paket Travel --</option>
                                            {{-- Pastikan $pendaftarans tersedia di controller --}}
                                            @foreach (($pendaftarans ?? []) as $p)
                                                <option value="{{ $p->id }}">
                                                    {{ $p->user->name ?? 'Jamaah Dummy' }} - {{ $p->paketTravel->nama_paket ?? 'Paket Dummy' }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    {{-- Jumlah Pembayaran --}}
                                    <div class="mb-3">
                                        <label class="form-label fw-medium">Jumlah Pembayaran (Rp) *</label>
                                        <input type="number" name="total" class="form-control" required min="1">
                                    </div>

                                    {{-- Metode Pembayaran --}}
                                    <div class="mb-3">
                                        <label class="form-label fw-medium">Metode Pembayaran *</label>
                                        <select name="metode_pembayaran" class="form-select" required>
                                            <option value="DP">DP</option>
                                            <option value="Tabungan">Tabungan / Angsuran</option>
                                            <option value="Lunas">Lunas</option>
                                        </select>
                                    </div>

                                    {{-- Keterangan --}}
                                    <div class="mb-3">
                                        <label class="form-label fw-medium">Keterangan *</label>
                                        <input type="text" name="keterangan" class="form-control" placeholder="Misal: DP tahap 1, Lunas, dll">
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary">Simpan Transaksi</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


                {{-- ========================= TAB KARYAWAN ========================= --}}
                <div class="tab-pane fade" id="karyawan" role="tabpanel">
                    <h5 class="mt-3 mb-3 text-secondary fw-bold">
                        <i class="bi bi-person-workspace me-2 text-primary"></i> 
                        Manajemen Data Karyawan
                    </h5>
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-body">
                            <div class="d-flex justify-content-end align-items-center mb-3">
                                <button class="btn btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#tambahKaryawanModal">
                                    <i class="bi bi-person-plus-fill me-1"></i> Tambah Karyawan
                                </button>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-hover align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Nama</th>
                                            <th>Jabatan</th>
                                            <th>Email</th>
                                            <th>No. HP</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($karyawan ?? [] as $k)
                                        <tr>
                                            <td class="fw-semibold">{{ $k->nama ?? 'Nama Karyawan' }}</td>
                                            <td><span class="badge bg-secondary py-1 px-2 fw-medium">{{ $k->jabatan ?? 'Staf' }}</span></td>
                                            <td>{{ $k->email ?? 'karyawan@syakirasya.com' }}</td>
                                            <td>{{ $k->no_hp ?? '0813xxxxxx' }}</td>
                                            <td class="text-center">
                                                <button class="btn btn-sm btn-outline-info me-1" data-bs-toggle="modal" data-bs-target="#editKaryawanModal{{ $k->id ?? 'dummy' }}" title="Edit">
                                                    <i class="bi bi-pencil-square"></i>
                                                </button>
                                                <form action="{{ route('karyawan.destroy', $k->id ?? 'dummy') }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Yakin ingin hapus karyawan ini?')" title="Hapus">
                                                        <i class="bi bi-trash-fill"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>

                                        {{-- Modal Edit Karyawan (Tidak Diubah) --}}
                                        <div class="modal fade" id="editKaryawanModal{{ $k->id ?? 'dummy' }}" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <form action="{{ route('karyawan.update', $k->id ?? 'dummy') }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-info text-white">
                                                            <h5 class="modal-title"><i class="bi bi-pencil-square me-1"></i> Edit Karyawan</h5>
                                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="mb-2">
                                                                <label class="form-label fw-medium">Nama</label>
                                                                <input type="text" name="nama" class="form-control" value="{{ $k->nama ?? 'Nama Karyawan' }}" required>
                                                            </div>
                                                            <div class="mb-2">
                                                                <label class="form-label fw-medium">Jabatan</label>
                                                                <input type="text" name="jabatan" class="form-control" value="{{ $k->jabatan ?? 'Staf' }}" required>
                                                            </div>
                                                            <div class="mb-2">
                                                                <label class="form-label fw-medium">Email</label>
                                                                <input type="email" name="email" class="form-control" value="{{ $k->email ?? 'karyawan@syakirasya.com' }}" required>
                                                            </div>
                                                            <div class="mb-2">
                                                                <label class="form-label fw-medium">No. HP</label>
                                                                <input type="text" name="no_hp" class="form-control" value="{{ $k->no_hp ?? '0813xxxxxx' }}" required>
                                                            </div>
                                                            <div class="mb-2">
                                                                <label class="form-label fw-medium">Password (Opsional)</label>
                                                                <input type="password" name="password" class="form-control" placeholder="Kosongkan jika tidak diubah">
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                            <button type="submit" class="btn btn-info text-white">Simpan Perubahan</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        @empty
                                        <tr>
                                            <td colspan="5" class="text-center text-muted py-4">
                                                <i class="bi bi-emoji-neutral me-1"></i> Belum ada data karyawan
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                
                {{-- Modal Tambah Karyawan (Tidak Diubah) --}}
                <div class="modal fade" id="tambahKaryawanModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <form action="{{ route('karyawan.store') }}" method="POST">
                            @csrf
                            <div class="modal-content">
                                <div class="modal-header bg-primary text-white">
                                    <h5 class="modal-title"><i class="bi bi-person-plus-fill me-1"></i> Tambah Karyawan Baru</h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-2">
                                        <label class="form-label fw-medium">Nama</label>
                                        <input type="text" name="nama" class="form-control" required>
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label fw-medium">Jabatan</label>
                                        <input type="text" name="jabatan" class="form-control" required>
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label fw-medium">Email</label>
                                        <input type="email" name="email" class="form-control" required>
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label fw-medium">No. HP</label>
                                        <input type="text" name="no_hp" class="form-control" required>
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label fw-medium">Password Awal</label>
                                        <input type="password" name="password" class="form-control" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary">Tambah</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                {{-- ========================= TAB AGENT ========================= --}}
                <div class="tab-pane fade" id="agent">
                    <h5 class="mt-3 mb-3 text-secondary fw-bold"><i class="bi bi-person-badge-fill me-2 text-primary"></i> Manajemen Data Agent</h5>
                    
                    <button class="btn btn-primary mb-3 shadow-sm" data-bs-toggle="modal" data-bs-target="#tambahAgentModal">
                        <i class="bi bi-person-plus-fill me-1"></i> Tambah Agent
                    </button>
                    
                    <div class="table-responsive">
                        <table class="table table-striped table-hover align-middle">
                            <thead>
                                <tr>
                                    <th>Nama Agent</th>
                                    <th>Kode Agent</th>
                                    <th>Email</th>
                                    <th>No. HP</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($agents ?? [] as $a)
                                <tr>
                                    <td class="fw-semibold">{{ $a->nama_agent ?? 'Nama Agent' }}</td>
                                    <td><span class="badge bg-primary py-1 px-2 fw-medium">{{ $a->kode_agent ?? 'A001' }}</span></td>
                                    <td>{{ $a->email ?? 'agent@syakirasya.com' }}</td>
                                    <td>{{ $a->no_hp ?? '0812xxxxxx' }}</td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-info text-white me-1" data-bs-toggle="modal" data-bs-target="#editAgentModal{{ $a->id ?? 'dummy' }}" title="Edit">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>
                                        <form action="{{ route('agent.destroy',$a->id ?? 'dummy') }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin hapus agent ini?')" title="Hapus">
                                                <i class="bi bi-trash-fill"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                
                                {{-- Modal Edit Agent (Tidak Diubah) --}}
                                <div class="modal fade" id="editAgentModal{{ $a->id ?? 'dummy' }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <form action="{{ route('agent.update',$a->id ?? 'dummy') }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-content">
                                                <div class="modal-header bg-info text-white">
                                                    <h5 class="modal-title"><i class="bi bi-pencil-square me-1"></i> Edit Agent: {{ $a->nama_agent ?? 'Contoh' }}</h5>
                                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label class="form-label fw-medium">Nama Agent</label>
                                                        <input type="text" name="nama_agent" class="form-control" value="{{ $a->nama_agent ?? 'Nama Agent' }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label fw-medium">Kode Agent</label>
                                                        <input type="text" name="kode_agent" class="form-control" value="{{ $a->kode_agent ?? 'A001' }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label fw-medium">Email</label>
                                                        <input type="email" name="email" class="form-control" value="{{ $a->email ?? 'agent@syakirasya.com' }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label fw-medium">No. HP</label>
                                                        <input type="text" name="no_hp" class="form-control" value="{{ $a->no_hp ?? '0812xxxxxx' }}" required>
                                                    </div>
                                                    <small class="text-muted d-block mt-3">Kosongkan kolom password jika tidak ingin mengubahnya.</small>
                                                    <div class="mb-3">
                                                        <label class="form-label fw-medium">Password Baru</label>
                                                        <input type="password" name="password" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-info text-white">Simpan Perubahan</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-4">
                                        <i class="bi bi-person-badge me-1"></i> Belum ada data agent.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- Modal Tambah Agent (Tidak Diubah) --}}
                <div class="modal fade" id="tambahAgentModal" tabindex="-1">
                    <div class="modal-dialog">
                        <form action="{{ route('agent.store') }}" method="POST">
                            @csrf
                            <div class="modal-content">
                                <div class="modal-header bg-primary text-white">
                                    <h5 class="modal-title"><i class="bi bi-person-plus-fill me-1"></i> Tambah Agent Baru</h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label class="form-label fw-medium">Nama Agent</label>
                                        <input type="text" name="nama_agent" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-medium">Kode Agent</label>
                                        <input type="text" name="kode_agent" class="form-control" value="{{ 'A'.str_pad(($totalAgents ?? 0) + 1, 3, '0', STR_PAD_LEFT) }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-medium">Email</label>
                                        <input type="email" name="email" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-medium">No. HP</label>
                                        <input type="text" name="no_hp" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-medium">Password (Awal)</label>
                                        <input type="password" name="password" class="form-control" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary">Tambah Agent</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>


                {{-- ========================= TAB PROFIL ========================= --}}
                <div class="tab-pane fade" id="profil">
                    <h5 class="mt-3 mb-4 text-secondary fw-bold"><i class="bi bi-person-circle me-2 text-primary"></i> Profil Admin</h5>
                    <div class="profile-card p-4 d-flex align-items-center gap-4">
                        
                        <div>
                            <img src="https://ui-avatars.com/api/?name={{ Auth::user()->nama ?? 'Admin' }}&background=003366&color=fff&size=100" 
                                alt="Avatar" 
                                class="rounded-circle shadow-sm" 
                                width="100" height="100">
                        </div>
                        
                        <div class="flex-grow-1">
                            <h5 class="mb-1">{{ Auth::user()->name ?? 'Admin Default' }}</h5>
                            <p class="mb-1 text-muted"><i class="bi bi-envelope me-1 text-primary"></i> {{ Auth::user()->email ?? 'admin@syakirasya.com' }}</p>
                            <p class="mb-3 text-muted"><i class="bi bi-clock me-1 text-primary"></i> Terakhir Login: {{ Auth::user()->last_login ?? \Carbon\Carbon::now()->format('d M Y H:i') }}</p>
                            
                            <button class="btn btn-primary btn-sm shadow-sm" data-bs-toggle="modal" data-bs-target="#ubahPasswordModal">
                                <i class="bi bi-key-fill me-1"></i> Ubah Password
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </main>
    </div>
</div>

{{-- Modal Ubah Password Admin (Tidak Diubah) --}}
<div class="modal fade" id="ubahPasswordModal" tabindex="-1" aria-labelledby="ubahPasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('admin.ubahPassword') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="ubahPasswordModalLabel"><i class="bi bi-key-fill me-1"></i> Ubah Password Admin</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-medium">Password Lama</label>
                        <input type="password" name="current_password" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-medium">Password Baru</label>
                        <input type="password" name="new_password" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-medium">Konfirmasi Password Baru</label>
                        <input type="password" name="new_password_confirmation" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Password</button>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- ========================= SCRIPTS ========================= --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Fungsi untuk toggle sidebar di mobile
    function toggleSidebar() {
        document.getElementById('adminSidebar').classList.toggle('show');
    }

document.addEventListener("DOMContentLoaded", () => {
    // Inisialisasi Tab Bootstrap dan Local Storage (Tidak Diubah)
    const sidebar = document.getElementById('adminSidebar');
    const links = document.querySelectorAll('.sidebar a[data-bs-toggle="tab"]');
    const tabs = document.querySelectorAll('.tab-pane');

    // 1️⃣ Cek tab terakhir dari localStorage saat halaman dimuat
    const lastTab = localStorage.getItem("lastTab");
    if (lastTab) {
        // Hapus semua status aktif
        links.forEach(l => l.classList.remove("active"));
        tabs.forEach(t => t.classList.remove("show", "active"));

        // Temukan tab terakhir
        const targetLink = document.querySelector(`.sidebar a[href="${lastTab}"]`);
        const targetTab = document.querySelector(lastTab);

        // Aktifkan lagi tab terakhir
        if (targetLink && targetTab) {
            targetLink.classList.add("active");
            targetTab.classList.add("show", "active");
        } else {
             // Fallback jika tab tidak ditemukan (misal di-refresh)
            document.querySelector('.sidebar a[href="#dashboard"]').classList.add("active");
            document.querySelector('#dashboard').classList.add("show", "active");
        }
    } else {
        // Default aktifkan Dashboard jika tidak ada di localStorage
        document.querySelector('.sidebar a[href="#dashboard"]').classList.add("active");
        document.querySelector('#dashboard').classList.add("show", "active");
    }

    // 2️⃣ Tambahkan event listener untuk menyimpan tab yang diklik
    links.forEach(link => {
        link.addEventListener("click", function (e) {
            e.preventDefault();

            // Aktifkan tab via Bootstrap JS
            const tab = new bootstrap.Tab(this);
            tab.show();

            // Simpan id tab terakhir
            const targetId = this.getAttribute("href");
            localStorage.setItem("lastTab", targetId);

            // Sembunyikan sidebar di mobile setelah klik
            if (window.innerWidth < 768) {
                sidebar.classList.remove('show');
            }
        });
    });

    // =======================================================
    // 🔍 FITUR BARU: LOGIKA PENCARIAN (Search Logic)
    // =======================================================

    // Fungsi Pencarian Universal untuk Tabel
    function setupTableSearch(inputId, tableId) {
        const searchInput = document.getElementById(inputId);
        const tableBody = document.getElementById(tableId).querySelector('tbody');
        const rows = tableBody.querySelectorAll('tr');

        if (!searchInput) return; // Pastikan elemen ada

        searchInput.addEventListener('keyup', function() {
            const searchTerm = this.value.toLowerCase();
            let hasVisibleRow = false;

            rows.forEach(row => {
                // Ambil semua teks dalam satu baris
                const rowText = Array.from(row.querySelectorAll('td')).map(td => td.textContent).join(' ').toLowerCase();

                // Cek apakah baris adalah baris 'empty'
                const isEmptyRow = row.querySelector('td') && row.querySelector('td').getAttribute('colspan');

                if (isEmptyRow) {
                    row.style.display = 'none'; // Selalu sembunyikan baris "belum ada data"
                    return;
                }

                if (rowText.includes(searchTerm)) {
                    row.style.display = ''; // Tampilkan baris
                    hasVisibleRow = true;
                } else {
                    row.style.display = 'none'; // Sembunyikan baris
                }
            });

            // Logika untuk menampilkan pesan 'Data tidak ditemukan' jika diperlukan (opsional, untuk penyederhanaan saat ini tidak ditambahkan)
        });
    }

    // Panggil fungsi pencarian untuk Jamaah
    setupTableSearch('searchJamaah', 'tableJamaah');
    
    // Panggil fungsi pencarian untuk Transaksi
    setupTableSearch('searchTransaksi', 'tableTransaksi');

});
</script>

</body>
</html>