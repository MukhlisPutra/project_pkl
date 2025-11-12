<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail Transaksi - PT SYAKIRASYA WISATA MANDIRI</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        :root {
            /* Warna Corporate: Navy Blue & Gold */
            --brand-primary: #0f2b5e; /* Navy yang lebih dalam */
            --brand-secondary: #c5a059; /* Gold elegan */
            --bg-color: #f4f6f9;
            --text-dark: #2c3e50;
            --text-muted: #6c757d;

            /* Warna status finansial */
            --bg-success-soft: #e6f7f0;
            --border-success-soft: #b8e6d1;
            --text-success-dark: #0a5c37;

            --bg-danger-soft: #fdeeee;
            --border-danger-soft: #f8d0d2;
            --text-danger-dark: #8a1c22;
            
            --bg-neutral-soft: #f8f9fa;
            --border-neutral-soft: #e9ecef;
            --text-neutral-dark: #495057;
        }

        body {
            background-color: var(--bg-color);
            font-family: 'Poppins', sans-serif;
            color: var(--text-dark);
            padding-bottom: 3rem;
        }

        /* Header Perusahaan */
        .company-header {
            background: #fff;
            border-bottom: 4px solid var(--brand-secondary);
            padding: 1.5rem 0;
            margin-bottom: 2rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .company-title {
            font-weight: 700;
            color: var(--brand-primary);
            margin: 0;
            font-size: 1.5rem;
        }

        .company-subtitle {
            font-size: 0.9rem;
            color: var(--text-muted);
            letter-spacing: 1px;
        }

        /* Card Styling */
        .card-modern {
            border: none;
            border-radius: 16px;
            background: #fff;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.06);
            overflow: hidden;
            margin-bottom: 2rem;
        }

        .card-header-modern {
            background: linear-gradient(135deg, var(--brand-primary) 0%, #1e4c9a 100%);
            padding: 1.2rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: white;
        }

        .card-body-modern {
            padding: 2rem;
        }

        /* Data Grid Layout */
        .data-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
        }

        .data-item {
            margin-bottom: 0.5rem;
        }
        
        /* Kartu Stat Finansial */
        .stat-card {
            padding: 1.25rem;
            border-radius: 12px;
            border: 1px solid var(--border-neutral-soft);
        }
        .stat-card.neutral { background-color: var(--bg-neutral-soft); border-color: var(--border-neutral-soft); }
        .stat-card.success { background-color: var(--bg-success-soft); border-color: var(--border-success-soft); }
        .stat-card.danger { background-color: var(--bg-danger-soft); border-color: var(--border-danger-soft); }


        .data-label {
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: var(--text-muted);
            font-weight: 500;
            margin-bottom: 0.3rem;
            display: block;
        }

        .data-value {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--brand-primary);
        }
        
        .stat-card .data-label { font-weight: 600; }
        .stat-card.neutral .data-label { color: var(--text-neutral-dark); }
        .stat-card.success .data-label { color: var(--text-success-dark); }
        .stat-card.danger .data-label { color: var(--text-danger-dark); }

        .stat-card .data-value {
            font-size: 1.75rem; /* Lebih besar agar menonjol */
            font-weight: 700;
        }
        .stat-card.neutral .data-value { color: var(--text-neutral-dark); }
        .stat-card.success .data-value { color: var(--text-success-dark); }
        .stat-card.danger .data-value { color: var(--text-danger-dark); }


        /* Badges */
        .badge-custom {
            padding: 0.6em 1.2em;
            border-radius: 30px;
            font-weight: 500;
            font-size: 0.85rem;
            box-shadow: 0 2px 5px rgba(0,0,0,0.08);
        }

        /* Table Styling */
        .table-modern {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }
        .table-modern thead th {
            background-color: #f8f9fa;
            color: var(--text-muted);
            font-weight: 600;
            font-size: 0.9rem;
            text-transform: uppercase;
            padding: 1rem;
            border-bottom: 2px solid #e9ecef;
        }
        .table-modern tbody td {
            padding: 1rem;
            vertical-align: middle;
            border-bottom: 1px solid #f1f1f1;
            color: var(--text-dark);
        }
        .table-modern tbody tr:hover {
            background-color: #fbfbfb;
        }
        .table-modern tbody tr:last-child td {
            border-bottom: none;
        }

        /* Buttons */
        .btn-back-custom {
            color: var(--brand-primary);
            background: white;
            border: 1px solid #dae1e7;
            border-radius: 50px;
            padding: 0.5rem 1.5rem;
            font-weight: 500;
            font-size: 0.9rem;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        .btn-back-custom:hover {
            background: var(--bg-color);
            color: var(--brand-primary);
            border-color: var(--brand-primary);
        }
        
        /* Helpers */
        .section-title {
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--brand-primary);
            margin-bottom: 1.5rem;
            padding-left: 1rem;
            border-left: 4px solid var(--brand-secondary);
        }
    </style>
</head>
<body>

    <header class="company-header">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="company-title">PT SYAKIRASYA WISATA MANDIRI</h1>
                    <span class="company-subtitle">Travel & Tours Management</span>
                </div>
                <div class="d-none d-md-block">
                    <span class="text-muted small"><i class="bi bi-clock"></i> {{ date('d M Y') }}</span>
                </div>
            </div>
        </div>
    </header>

    <div class="container">
        
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold text-dark m-0" style="font-size: 1.75rem;">
                Detail Transaksi
            </h2>
            <a href="{{ route('jamaah.dashboard') }}" class="btn-back-custom">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>

        <div class="card-modern">
            <div class="card-header-modern">
                <div>
                    <i class="bi bi-pass-fill me-2 opacity-75"></i>
                    <span class="fw-bold">ID Pendaftaran: #{{ $pendaftaran->id }}</span>
                </div>
                <div>
                    @php
                        $color = match(strtolower($pendaftaran->status)) {
                            'lunas' => 'success',
                            'pending' => 'warning',
                            'batal' => 'danger',
                            'acc', 'terkonfirmasi' => 'primary',
                            default => 'secondary',
                        };
                    @endphp
                    <span class="badge bg-{{ $color }} badge-custom text-white">
                        {{ strtoupper($pendaftaran->status) }}
                    </span>
                </div>
            </div>
            <div class="card-body-modern">
                
                <div class="data-grid mb-3">
                    <div class="data-item">
                        <span class="data-label"><i class="bi bi-person text-primary me-1"></i> Nama Jamaah</span>
                        <div class="data-value">{{ Auth::user()->name }}</div>
                    </div>
                    <div class="data-item">
                        <span class="data-label"><i class="bi bi-airplane text-primary me-1"></i> Paket Travel</span>
                        <div class="data-value">{{ $pendaftaran->paketTravel->nama_paket ?? '—' }}</div>
                    </div>
                    <div class="data-item">
                        <span class="data-label"><i class="bi bi-calendar-check text-primary me-1"></i> Keberangkatan</span>
                        <div class="data-value">
                            {{ optional($pendaftaran->paketTravel->tanggal_berangkat)->format('d M Y') ?? '—' }}
                        </div>
                    </div>
                </div>

                <hr class="my-4">

                @php
                    // bila $totalTagihan tidak dikirim dari controller, hitung fallback:
                    $totalTagihan = $totalTagihan ?? ($pendaftaran->paketTravel->harga ?? 0);
                    $totalPembayaran = $totalPembayaran ?? ($transaksi->where('status', 'acc')->sum('total') ?? 0); // Hanya hitung yg ACC
                    $sisaTagihan = $totalTagihan - $totalPembayaran;
                @endphp

                <h5 class="fw-bold mb-3" style="color: var(--brand-primary);">Ringkasan Finansial</h5>
                <div class="row g-3">
                    <div class="col-md-4">
                        <div class="stat-card neutral">
                            <span class="data-label"><i class="bi bi-wallet2 me-1"></i> Total Tagihan</span>
                            <div class="data-value">
                                Rp {{ number_format($totalTagihan, 0, ',', '.') }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="stat-card success">
                            <span class="data-label"><i class="bi bi-cash-coin me-1"></i> Total Pembayaran (ACC)</span>
                            <div class="data-value">
                                Rp {{ number_format($totalPembayaran, 0, ',', '.') }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="stat-card danger">
                            <span class="data-label"><i class="bi bi-clipboard-minus me-1"></i> Sisa Tagihan</span>
                            <div class="data-value">
                                Rp {{ number_format(max(0, $sisaTagihan), 0, ',', '.') }}
                            </div>
                        </div>
                    </div>
                </div>
                </div>
        </div>

        <div class="mb-5">
            <h4 class="section-title">Riwayat Pembayaran</h4>

            @if($transaksi->count())
                <div class="card-modern p-0">
                    <div class="table-responsive">
                        <table class="table-modern mb-0">
                            <thead>
                                <tr>
                                    <th width="20%">Tanggal</th>
                                    <th width="35%">Keterangan</th>
                                    <th width="15%">Status</th>
                                    <th width="30%" class="text-end">Nominal (Rp)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($transaksi as $t)
                                    @php
                                        $badge = match(strtolower($t->status)) {
                                            'acc' => 'success',
                                            'pending' => 'warning',
                                            'batal' => 'danger',
                                            default => 'secondary',
                                        };
                                        // Ikon status opsional
                                        $icon = match(strtolower($t->status)) {
                                            'acc' => 'bi-check-circle-fill',
                                            'pending' => 'bi-hourglass-split',
                                            'batal' => 'bi-x-circle-fill',
                                            default => 'bi-circle',
                                        };
                                    @endphp
                                    <tr>
                                        <td>
                                            <div class="fw-medium">{{ $t->created_at->format('d M Y') }}</div>
                                            <small class="text-muted">{{ $t->created_at->format('H:i') }} WIB</small>
                                        </td>
                                        <td>
                                            <span class="text-dark fw-medium">{{ $t->keterangan }}</span>
                                        </td>
                                        <td>
                                            <span class="badge bg-{{ $badge }} bg-opacity-10 text-{{ $badge }} border border-{{ $badge }} rounded-pill px-3 py-2">
                                                <i class="bi {{ $icon }} me-1"></i> {{ ucfirst($t->status) }}
                                            </span>
                                        </td>
                                        <td class="text-end">
                                            <span class="fw-bold text-dark fs-5">
                                                Rp {{ number_format($t->total, 0, ',', '.') }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @else
                <div class="text-center py-5 card-modern">
                    <div class="mb-3">
                        <i class="bi bi-receipt text-muted" style="font-size: 4rem; opacity: 0.3;"></i>
                    </div>
                    <h5 class="text-muted">Belum ada riwayat transaksi</h5>
                    <p class="small text-muted">Transaksi pembayaran Anda akan muncul di sini setelah diproses.</p>
                </div>
            @endif
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>