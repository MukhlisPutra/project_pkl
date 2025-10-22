<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard - PT Syakirasya</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        /* Variabel Warna Kustom */
        :root {
            --bs-primary-blue: #004780; /* Biru Primer yang Lebih Tua */
            --bs-sidebar-bg: #005a9c; /* Biru Sidebar */
            --bs-light-gray: #f4f7f9;
            --bs-accent-light: #5bc0de; /* Info Cyan */
        }
        
        body { 
            background-color: var(--bs-light-gray); 
            font-family: 'Poppins', sans-serif; 
            color: #343a40;
        }

        /* Sidebar Styling */
        .sidebar {
            height: 100vh;
            background-color: var(--bs-sidebar-bg);
            padding: 0;
            position: sticky;
            top: 0;
            box-shadow: 4px 0 10px rgba(0,0,0,0.1);
        }

        .sidebar-brand {
            padding: 1.5rem 1rem;
            color: white;
            font-size: 1.5rem;
            font-weight: 700;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            margin-bottom: 0.5rem;
        }

        .sidebar .list-group-item {
            background-color: transparent;
            color: white;
            border-radius: 0;
            padding: 1rem 1.5rem;
            border: none;
            border-left: 5px solid transparent; /* Border Aksen */
            transition: all 0.3s;
            font-weight: 500;
        }

        .sidebar .list-group-item:hover {
            background-color: rgba(255, 255, 255, 0.15);
            color: var(--bs-accent-light);
        }

        .sidebar .list-group-item.active {
            background-color: var(--bs-primary-blue);
            font-weight: 600;
            border-left: 5px solid #ffc107; /* Aksen Emas pada Item Aktif */
            color: #fff;
        }

        /* Logout dipisahkan */
        .sidebar form button {
            border-top: 1px solid rgba(255, 255, 255, 0.2);
            color: #ffdddd !important; /* Merah muda lembut */
            margin-top: auto; /* Push ke bawah */
        }

        /* Topbar */
        .topbar {
            background-color: white;
            padding: 1.25rem 2rem;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            margin-top: 1rem; /* Jarak dari atas */
            border-radius: 10px;
        }
        .topbar h4 {
            color: var(--bs-primary-blue);
            font-weight: 600;
        }
        
        /* Card statistik */
        .stat-card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        }
        .stat-card h6 { 
            color: var(--bs-primary-blue); 
            font-weight: 600;
        }
        .stat-card p {
            color: #198754; /* Green for total success */
        }

        /* Table Styling */
        .table-responsive {
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }
        .table thead {
            background-color: var(--bs-primary-blue);
            color: white;
        }
        .table tbody tr:hover {
            background-color: #e9ecef;
        }

        /* Profil card */
        .profile-card {
            background-color: #fff; 
            border-radius: 12px; 
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            border-left: 5px solid var(--bs-primary-blue);
        }
        .profile-card h5 { 
            font-weight: 600; 
            color: var(--bs-primary-blue);
        }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row min-vh-100">
        <nav class="col-md-2 d-none d-md-flex sidebar flex-column">
            <div class="sidebar-brand">
                <i class="bi bi-gear-fill me-2"></i> Admin Panel
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
                     <i class="bi bi-journal-check me-2"></i> Transaksi
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
            <form action="{{ route('logout') }}" method="POST" class="mt-auto">
                @csrf
                <button type="submit" class="list-group-item list-group-item-action">
                    <i class="bi bi-box-arrow-right me-2"></i> Logout
                </button>
            </form>
        </nav>
        
        <main class="col-md-10 ms-sm-auto px-4">
            <div class="topbar d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Manajemen Admin PT Syakirasya</h4>
                <span class="text-muted"><i class="bi bi-person-fill me-1 text-primary"></i> Selamat datang, {{ Auth::user()->nama ?? 'Admin' }}!</span>
            </div>

            <div class="tab-content pt-3">
                
                <div class="tab-pane fade show active" id="dashboard">
                    <h5 class="mb-4 text-secondary"><i class="bi bi-bar-chart-fill me-2"></i> Statistik Singkat</h5>
                    <div class="row g-4">
                        <div class="col-lg-4 col-md-6">
                            <div class="card stat-card">
                                <div class="card-body">
                                    <h6>Total Paket Tersedia</h6>
                                    <p class="fs-3 fw-bold text-primary">{{ $totalPaket }}</p>
                                    <small class="text-muted">Paket Umrah & Haji</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="card stat-card">
                                <div class="card-body">
                                    <h6>Total Data Jamaah</h6>
                                    <p class="fs-3 fw-bold text-success">{{ $totalJamaah }}</p>
                                    <small class="text-muted">Pengguna terdaftar</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="card stat-card">
                                <div class="card-body">
                                    <h6>Booking Pending</h6>
                                    <p class="fs-3 fw-bold text-warning">{{ $totalBookingPending ?? '5' }}</p>
                                    <small class="text-muted">Menunggu konfirmasi</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="paket">
                    <h5 class="mt-3 mb-3 text-secondary"><i class="bi bi-box-seam-fill me-2"></i> Manajemen Data Paket</h5>
                    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#tambahPaketModal">
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
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pakets as $paket)
                                <tr>
                                    <td>
                                        @if($paket->gambar)
                                            <img src="{{ asset('storage/'.$paket->gambar) }}" alt="Gambar Paket" width="70" class="rounded shadow-sm">
                                        @else
                                            <i class="bi bi-image-fill text-muted fs-4"></i>
                                        @endif
                                    </td>
                                    <td class="fw-medium">{{ $paket->nama_paket }}</td>
                                    <td>Rp *{{ number_format($paket->harga,0,',','.') }}*</td>
                                    <td><i class="bi bi-calendar-event me-1"></i> {{ \Carbon\Carbon::parse($paket->tanggal_berangkat)->format('d M Y') }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-info text-white" data-bs-toggle="modal" data-bs-target="#editPaketModal{{ $paket->id }}"><i class="bi bi-pencil-square"></i></button>
                                        <form action="{{ route('paket.destroy',$paket->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin hapus paket ini?')"><i class="bi bi-trash-fill"></i></button>
                                        </form>
                                    </td>
                                </tr>

                                <div class="modal fade" id="editPaketModal{{ $paket->id }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <form action="{{ route('paket.update',$paket->id) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-content">
                                                <div class="modal-header bg-info text-white">
                                                    <h5 class="modal-title">Edit Paket: {{ $paket->nama_paket }}</h5>
                                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label class="form-label fw-medium">Nama Paket</label>
                                                        <input type="text" name="nama_paket" class="form-control" value="{{ $paket->nama_paket }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label fw-medium">Harga (Rp)</label>
                                                        <input type="number" name="harga" class="form-control" value="{{ $paket->harga }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label fw-medium">Tanggal Berangkat</label>
                                                        <input type="date" name="tanggal_berangkat" class="form-control" value="{{ \Carbon\Carbon::parse($paket->tanggal_berangkat)->format('Y-m-d') }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label fw-medium">Deskripsi</label>
                                                        <textarea name="deskripsi" class="form-control" rows="3">{{ $paket->deskripsi ?? 'Deskripsi belum diisi.' }}</textarea>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label fw-medium">Gambar Paket</label>
                                                        <input type="file" name="gambar" class="form-control">
                                                        @if($paket->gambar)
                                                            <small class="text-muted d-block mt-2">Gambar saat ini:</small>
                                                            <img src="{{ asset('storage/'.$paket->gambar) }}" width="80" class="mt-1 rounded">
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
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="modal fade" id="tambahPaketModal" tabindex="-1">
                    <div class="modal-dialog">
                        <form action="{{ route('paket.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-content">
                                <div class="modal-header bg-primary text-white">
                                    <h5 class="modal-title">Tambah Paket Baru</h5>
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

                <div class="tab-pane fade" id="jamaah">
                    <h5 class="mt-3 mb-3 text-secondary"><i class="bi bi-people-fill me-2"></i> Manajemen Data Jamaah</h5>
                    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#tambahJamaahModal">
                        <i class="bi bi-person-plus-fill me-1"></i> Tambah Jamaah
                    </button>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover align-middle">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>No. HP</th>
                                    <th>Status Akun</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($jamaah as $j)
                                <tr>
                                    <td class="fw-medium">{{ $j->name }}</td>
                                    <td>{{ $j->email }}</td>
                                    <td>{{ $j->no_hp }}</td>
                                    <td><span class="badge bg-success"><i class="bi bi-check-circle-fill me-1"></i> Aktif</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-info text-white" data-bs-toggle="modal" data-bs-target="#editJamaahModal{{ $j->id }}"><i class="bi bi-pencil-square"></i></button>
                                        <form action="{{ route('jamaah.destroy',$j->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin hapus jamaah ini?')"><i class="bi bi-trash-fill"></i></button>
                                        </form>
                                    </td>
                                </tr>

                                <div class="modal fade" id="editJamaahModal{{ $j->id }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <form action="{{ route('jamaah.update',$j->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-content">
                                                <div class="modal-header bg-info text-white">
                                                    <h5 class="modal-title">Edit Jamaah: {{ $j->name }}</h5>
                                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label class="form-label fw-medium">Nama</label>
                                                        <input type="text" name="name" class="form-control" value="{{ $j->name }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label fw-medium">Email</label>
                                                        <input type="email" name="email" class="form-control" value="{{ $j->email }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label fw-medium">No. HP</label>
                                                        <input type="text" name="no_hp" class="form-control" value="{{ $j->no_hp }}" required>
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
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="modal fade" id="tambahJamaahModal" tabindex="-1">
                    <div class="modal-dialog">
                        <form action="{{ route('jamaah.store') }}" method="POST">
                            @csrf
                            <div class="modal-content">
                                <div class="modal-header bg-primary text-white">
                                    <h5 class="modal-title">Tambah Jamaah Baru</h5>
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

                <div class="tab-pane fade" id="booking">
                    <h5 class="mt-3 mb-4 text-secondary"><i class="bi bi-journal-check me-2"></i> Daftar Booking & Konfirmasi</h5>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover align-middle">
                            <thead>
                                <tr>
                                    <th>Nama & HP</th>
                                    <th>Paket</th>
                                    <th>Dokumen (KTP/KK)</th>
                                    <th>Catatan</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
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

        @if($item->kk)
            <a href="{{ asset('storage/'.$item->kk) }}" target="_blank" class="badge bg-primary">
                <i class="bi bi-file-text-fill"></i> KK
            </a>
        @else
            -
        @endif
    </td>
    <td>{{ $item->catatan ?? '-' }}</td>
    <td>
        @if($item->status == 'pending')
            <span class="badge bg-warning text-dark">
                <i class="bi bi-hourglass-split me-1"></i> Pending
            </span>
        @elseif($item->status == 'acc')
            <span class="badge bg-success">
                <i class="bi bi-check-circle-fill me-1"></i> ACC
            </span>
        @else
            <span class="badge bg-danger">
                <i class="bi bi-x-circle-fill me-1"></i> Ditolak
            </span>
        @endif
    </td>
    <td>
        @if($item->status == 'pending')
            <form action="{{ route('admin.pendaftaran.acc', $item->id) }}" method="POST" class="d-inline">
                @csrf
                <button class="btn btn-sm btn-success mb-1" title="Setujui Pendaftaran">
                    <i class="bi bi-check"></i> ACC
                </button>
            </form>

            <form action="{{ route('admin.pendaftaran.tolak', $item->id) }}" method="POST" class="d-inline">
                @csrf
                <button class="btn btn-sm btn-danger mb-1" title="Tolak Pendaftaran">
                    <i class="bi bi-x"></i> Tolak
                </button>
            </form>
        @elseif($item->status == 'acc')
           <a href="{{ route('invoice.create', $item->id) }}" class="btn btn-sm btn-primary" title="Buat Dokumen Invoice">
    <i class="bi bi-file-earmark-text-fill"></i> Invoice
</a>

        @endif
    </td>
</tr>
@endforeach


                            </tbody>
                        </table>
                    </div>
                </div>
               </div> <!-- penutup tab booking -->

<!-- ========================= TAB TRANSAKSI ========================= -->
<div class="tab-pane fade" id="transaksi" role="tabpanel" aria-labelledby="transaksi-tab">
    <h5 class="mt-3 mb-3 text-secondary">
        <i class="bi bi-wallet2 me-2"></i> Data Transaksi Jamaah
    </h5>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Nama Jamaah</th>
                            <th>Paket</th>
                            <th>Jumlah</th>
                            <th>Status</th>
                            <th>Jenis Pembayaran</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($transaksis as $index => $t)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $t->user->nama ?? '-' }}</td>
                            <td>
    {{ $t->pendaftaran && $t->pendaftaran->paketTravel 
        ? $t->pendaftaran->paketTravel->nama_paket 
        : '-' }}
</td>
                            <td>Rp {{ number_format($t->jumlah, 0, ',', '.') }}</td>
                            <td>
                                @if ($t->status == 'pending')
                                    <span class="badge bg-warning text-dark">Pending</span>
                                @elseif ($t->status == 'acc')
                                    <span class="badge bg-success">Acc</span>
                                @else
                                    <span class="badge bg-secondary">{{ ucfirst($t->status) }}</span>
                                @endif
                            </td>
                            <td>
                                @if ($t->jenis_pembayaran == 'dp')
                                    <span class="badge bg-info text-dark">DP</span>
                                @elseif ($t->jenis_pembayaran == 'tabungan')
                                    <span class="badge bg-primary">Tabungan</span>
                                @elseif ($t->jenis_pembayaran == 'lunas')
                                    <span class="badge bg-success">Lunas</span>
                                @else
                                    <span class="badge bg-secondary">-</span>
                                @endif
                            </td>
                            <td class="d-flex gap-1">
                                {{-- Ubah Status --}}
                                <form action="{{ route('transaksi.updateStatus', $t->id) }}" method="POST">
                                    @csrf
                                    <select name="status" onchange="this.form.submit()" class="form-select form-select-sm">
                                        <option value="pending" {{ $t->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="acc" {{ $t->status == 'acc' ? 'selected' : '' }}>Acc</option>
                                    </select>
                                </form>

                                {{-- Edit Nominal --}}
                                <button type="button" class="btn btn-sm btn-outline-primary"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editTransaksiModal{{ $t->id }}">
                                    <i class="bi bi-pencil"></i>
                                </button>

                                {{-- Tambah Nominal --}}
                                <button type="button" class="btn btn-sm btn-outline-success"
                                    data-bs-toggle="modal"
                                    data-bs-target="#tambahTransaksiModal{{ $t->id }}">
                                    <i class="bi bi-plus-lg"></i>
                                </button>
                            </td>
                        </tr>

                        <!-- ========== Modal Edit Transaksi ========== -->
                        <div class="modal fade" id="editTransaksiModal{{ $t->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog">
                                <form action="{{ route('transaksi.updateNominal', $t->id) }}" method="POST">
                                    @csrf
                                    <div class="modal-content">
                                        <div class="modal-header bg-primary text-white">
                                            <h5 class="modal-title">Edit Nominal Transaksi</h5>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <label>Nominal (Rp)</label>
                                            <input type="number" name="jumlah" class="form-control" value="{{ $t->jumlah }}" required>

                                            <label class="mt-3">Jenis Pembayaran</label>
                                            <select name="jenis_pembayaran" class="form-select">
                                                <option value="dp" {{ $t->jenis_pembayaran == 'dp' ? 'selected' : '' }}>DP</option>
                                                <option value="tabungan" {{ $t->jenis_pembayaran == 'tabungan' ? 'selected' : '' }}>Tabungan</option>
                                                <option value="lunas" {{ $t->jenis_pembayaran == 'lunas' ? 'selected' : '' }}>Lunas</option>
                                            </select>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- ========== Modal Tambah Nominal ========== -->
                        <div class="modal fade" id="tambahTransaksiModal{{ $t->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog">
                                <form action="{{ route('transaksi.tambahNominal', $t->id) }}" method="POST">
                                    @csrf
                                    <div class="modal-content">
                                        <div class="modal-header bg-success text-white">
                                            <h5 class="modal-title">Tambah Nominal Transaksi</h5>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <label>Tambah Nominal (Rp)</label>
                                            <input type="number" name="tambah_jumlah" class="form-control" placeholder="Masukkan nominal tambahan" required>

                                            <label class="mt-3">Jenis Pembayaran</label>
                                            <select name="jenis_pembayaran" class="form-select">
                                                <option value="tabungan">Tabungan</option>
                                                <option value="lunas">Lunas</option>
                                            </select>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-success">Tambah</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">Belum ada transaksi</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- ========================= TAB KARYAWAN ========================= -->
<div class="tab-pane fade" id="karyawan" role="tabpanel" aria-labelledby="karyawan-tab">

    <div class="card shadow-sm border-0 mt-3">
        <div class="card-body">

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="text-secondary mb-0">
                    <i class="bi bi-person-workspace me-2 text-primary"></i> 
                    Manajemen Data Karyawan
                </h5>
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
                        @forelse($karyawan as $k)
                        <tr>
                            <td class="fw-semibold">{{ $k->nama }}</td>
                            <td>{{ $k->jabatan ?? 'Staf' }}</td>
                            <td>{{ $k->email }}</td>
                            <td>{{ $k->no_hp }}</td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-outline-info me-1" data-bs-toggle="modal" data-bs-target="#editKaryawanModal{{ $k->id }}">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                                <form action="{{ route('karyawan.destroy', $k->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Yakin ingin hapus karyawan ini?')">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>

                        <!-- Modal Edit -->
                        <div class="modal fade" id="editKaryawanModal{{ $k->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <form action="{{ route('karyawan.update', $k->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-content">
                                        <div class="modal-header bg-info text-white">
                                            <h5 class="modal-title"><i class="bi bi-pencil-square me-1"></i> Edit Karyawan</h5>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-2">
                                                <label class="form-label">Nama</label>
                                                <input type="text" name="nama" class="form-control" value="{{ $k->nama }}" required>
                                            </div>
                                            <div class="mb-2">
                                                <label class="form-label">Jabatan</label>
                                                <input type="text" name="jabatan" class="form-control" value="{{ $k->jabatan }}" required>
                                            </div>
                                            <div class="mb-2">
                                                <label class="form-label">Email</label>
                                                <input type="email" name="email" class="form-control" value="{{ $k->email }}" required>
                                            </div>
                                            <div class="mb-2">
                                                <label class="form-label">No. HP</label>
                                                <input type="text" name="no_hp" class="form-control" value="{{ $k->no_hp }}" required>
                                            </div>
                                            <div class="mb-2">
                                                <label class="form-label">Password (Opsional)</label>
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

<!-- Modal Tambah Karyawan -->
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
                        <label class="form-label">Nama</label>
                        <input type="text" name="nama" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Jabatan</label>
                        <input type="text" name="jabatan" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">No. HP</label>
                        <input type="text" name="no_hp" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Password Awal</label>
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




                <div class="tab-pane fade" id="agent">
                    <h5 class="mt-3 mb-3 text-secondary"><i class="bi bi-person-badge-fill me-2"></i> Manajemen Data Agent</h5>
                    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#tambahAgentModal">
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
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- Loop data agent (asumsi variabel $agents tersedia) --}}
                                @foreach($agents as $a)
                                <tr>
                                    <td class="fw-medium">{{ $a->nama_agent }}</td>
                                    <td><span class="badge bg-secondary">{{ $a->kode_agent ?? 'A001' }}</span></td>
                                    <td>{{ $a->email }}</td>
                                    <td>{{ $a->no_hp }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-info text-white" data-bs-toggle="modal" data-bs-target="#editAgentModal{{ $a->id }}"><i class="bi bi-pencil-square"></i></button>
                                        <form action="{{ route('agent.destroy',$a->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin hapus agent ini?')"><i class="bi bi-trash-fill"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                <div class="modal fade" id="editAgentModal{{ $a->id }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <form action="{{ route('agent.update',$a->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-content">
                                                <div class="modal-header bg-info text-white">
                                                    <h5 class="modal-title">Edit Agent: {{ $a->nama_agent }}</h5>
                                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label class="form-label fw-medium">Nama Agent</label>
                                                        <input type="text" name="nama_agent" class="form-control" value="{{ $a->nama_agent }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label fw-medium">Kode Agent</label>
                                                        <input type="text" name="kode_agent" class="form-control" value="{{ $a->kode_agent ?? 'A001' }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label fw-medium">Email</label>
                                                        <input type="email" name="email" class="form-control" value="{{ $a->email }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label fw-medium">No. HP</label>
                                                        <input type="text" name="no_hp" class="form-control" value="{{ $a->no_hp }}" required>
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
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="modal fade" id="tambahAgentModal" tabindex="-1">
                    <div class="modal-dialog">
                        <form action="{{ route('agent.store') }}" method="POST">
                            @csrf
                            <div class="modal-content">
                                <div class="modal-header bg-primary text-white">
                                    <h5 class="modal-title">Tambah Agent Baru</h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label class="form-label fw-medium">Nama Agent</label>
                                        <input type="text" name="nama_agent" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-medium">Kode Agent</label>
                                        <input type="text" name="kode_agent" class="form-control" value="{{ 'A'.str_pad($totalAgents + 1, 3, '0', STR_PAD_LEFT) }}" required>
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


                <div class="tab-pane fade" id="profil">
                    <h5 class="mt-3 mb-4 text-secondary"><i class="bi bi-person-circle me-2"></i> Profil Admin</h5>
                    <div class="profile-card p-4 d-flex align-items-center gap-4">
                        
                        <div>
                            <img src="https://ui-avatars.com/api/?name={{ Auth::user()->nama ?? 'Admin' }}&background=004780&color=fff&size=90" 
                                alt="Avatar" 
                                class="rounded-circle shadow-sm" 
                                width="90" height="90">
                        </div>
                        
                        <div class="flex-grow-1">
                            <h5 class="mb-1">{{ Auth::user()->nama ?? 'Admin' }}</h5>
                            <p class="mb-1 text-muted"><i class="bi bi-envelope me-1"></i> {{ Auth::user()->email ?? '-' }}</p>
                            <p class="mb-3 text-muted"><i class="bi bi-clock me-1"></i> Terakhir Login: *{{ Auth::user()->last_login ?? 'Belum ada data' }}*</p>
                            
                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#ubahPasswordModal">
                                <i class="bi bi-key-fill me-1"></i> Ubah Password
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </main>
    </div>
</div>

<div class="modal fade" id="ubahPasswordModal" tabindex="-1" aria-labelledby="ubahPasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('admin.ubahPassword') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="ubahPasswordModalLabel">Ubah Password Admin</h5>
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


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Inisialisasi Tab Bootstrap dan Local Storage
    const links = document.querySelectorAll('.sidebar a[data-bs-toggle="tab"]');
    const tabs = document.querySelectorAll('.tab-pane');

    // 1. Cek tab terakhir dari localStorage saat halaman dimuat
    const lastTab = localStorage.getItem("lastTab");
    if (lastTab) {
        links.forEach(l => l.classList.remove("active"));
        tabs.forEach(t => t.classList.remove("show", "active"));
        
        const targetLink = document.querySelector(.sidebar a[href="${lastTab}"]);
        const targetTab = document.querySelector(lastTab);
        
        if (targetLink && targetTab) {
            targetLink.classList.add("active");
            targetTab.classList.add("show", "active");
        }
    }

    // 2. Tambahkan event listener untuk menyimpan tab yang diklik ke localStorage
    links.forEach(link => {
        link.addEventListener("click", function(e){
            e.preventDefault();
            
            // Logika default Bootstrap untuk mengaktifkan tab
            const tab = new bootstrap.Tab(this);
            tab.show();

            // Simpan state
            const targetId = this.getAttribute("href");
            localStorage.setItem("lastTab", targetId);
        });
    });
</script>
</body>
</html>