<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice - Data Travel</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <style>
        /* 🎨 Refined Premium Palette */
        :root {
            --primary-color: #00334d; /* Darker Deep Teal/Navy */
            --accent-color: #e6b039; /* Richer Gold/Amber */
            --light-bg: #f7f9fb;
            --text-color: #2c3e50; /* Very Dark Slate Gray */
            --border-color: #dde1e5;
            --danger-color: #c0392b; /* Slightly darker danger red */
        }

        /* ---------------------------------------------------- */
        /* General Layout and Reset (Screen View) */
        /* ---------------------------------------------------- */
        @page { 
            size: A4; 
            margin: 0; 
        }
        body { 
            font-family: 'Segoe UI', 'Helvetica Neue', Arial, sans-serif; 
            margin: 0; 
            padding: 0; 
            background-color: #ecf0f1; 
            color: var(--text-color);
            line-height: 1.4; 
            font-size: 10pt;
        }
        .invoice-container { 
            width: 95%; 
            max-width: 800px; 
            margin: 30px auto; 
            padding: 40px; 
            background-color: #ffffff; 
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2); 
            border-radius: 12px; 
            border-top: 8px solid var(--primary-color); 
        }
        .separator { border: 0; height: 1px; background-color: var(--border-color); margin: 25px 0; } 

        /* ---------------------------------------------------- */
        /* Header (Logo & Title) */
        /* ---------------------------------------------------- */
        .invoice-header { 
            display: flex; 
            justify-content: space-between; 
            align-items: flex-start; 
            margin-bottom: 30px; 
            border-bottom: 2px solid var(--border-color);
            padding-bottom: 15px;
        }
        .header-left {
            display: flex;
            flex-direction: column;
            align-items: flex-start; 
            gap: 5px; 
            max-width: 65%; 
        }
        .company-logo {
            max-height: 50px; 
            width: auto;
            border-radius: 6px; 
            margin-bottom: 5px; 
        }
        .invoice-header h1 { 
            color: var(--primary-color); 
            margin: 0; 
            font-size: 2.3em; 
            letter-spacing: 1px;
            font-weight: 900; 
            text-shadow: 1px 1px 2px rgba(0,0,0,0.05);
            border-bottom: 4px solid var(--accent-color); 
            padding-bottom: 5px;
        }
        .invoice-number { 
            font-size: 1.15em; 
            font-weight: 800; 
            color: #ffffff; 
            background-color: var(--primary-color);
            padding: 10px 20px; 
            border-radius: 10px;
            letter-spacing: 1.5px;
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
        }

        /* ---------------------------------------------------- */
        /* Info Section (Company & Client) */
        /* ---------------------------------------------------- */
        .invoice-info-section { 
            display: flex; 
            justify-content: space-between; 
            margin-bottom: 20px; 
        }
        .invoice-info-section h2 { 
            font-size: 1.3em; 
            color: var(--primary-color); 
            margin-bottom: 10px; 
            font-weight: 800;
            border-bottom: 2px solid var(--accent-color);
            display: inline-block;
            padding-bottom: 3px;
        }
        .invoice-info-section p { 
            margin: 5px 0; 
            font-size: 0.95em; 
            color: var(--text-color);
        }
        .company-data, .client-data { 
            width: 47%; 
            padding: 18px; 
            border-radius: 10px;
            background-color: var(--light-bg);
            border-left: 5px solid var(--accent-color); 
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05); 
        }
        .client-data { 
            text-align: right; 
            border-left: none; 
            border-right: 5px solid var(--accent-color); 
            background-color: #f9fcff; 
        }
        .client-data h2 { text-align: right; border-bottom: 2px solid var(--accent-color); }

        /* ---------------------------------------------------- */
        /* Table Styling */
        /* ---------------------------------------------------- */
        .section-title { 
            color: var(--primary-color); 
            margin-top: 30px; 
            margin-bottom: 15px; 
            font-size: 1.5em; 
            font-weight: 900;
            letter-spacing: 0.5px;
            border-bottom: 2px solid var(--primary-color);
            padding-bottom: 5px;
            text-transform: uppercase;
        }
        .data-table, .payment-table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-bottom: 25px; 
            border: 1px solid var(--border-color);
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        }
        .data-table th, .payment-table th {
            background-color: var(--primary-color); 
            color: white; 
            padding: 10px 12px; 
            text-align: left; 
            font-size: 0.85em; 
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            white-space: nowrap; 
        }
        .data-table td, .payment-table td {
            padding: 8px 12px; 
            border-bottom: 1px solid var(--border-color); 
            font-size: 0.9em; 
            vertical-align: middle;
        }
        .data-table tbody tr:nth-child(even) { background-color: var(--light-bg); } 
        
        /* Payment Highlighting */
        .outstanding-cell { 
            font-weight: 900; 
            font-size: 1.2em; 
            color: var(--danger-color);
            background-color: #fef4f3; 
            border-left: 4px solid var(--danger-color);
        }

        /* Status Badges */
        .status-badge {
            padding: 7px 16px; 
            border-radius: 5px;
            display: inline-flex;
            font-size: 0.8em; 
        }

        /* ---------------------------------------------------- */
        /* Signature and QR Section */
        /* ---------------------------------------------------- */
        .signature-section {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-top: 40px; 
            padding: 0; 
        }
        .signature-block {
            text-align: center;
            width: 50%; 
        }
        .signature-block .role { margin-bottom: 3px; font-weight: 600; color: #7f8c8d; font-size: 0.9em;}
        .signature-space { height: 70px; border-bottom: 2px dashed var(--accent-color); margin: 8px 0 5px 0;} 
        .signature-block .signer { 
            font-size: 1.1em; 
            font-weight: 800;
            color: var(--primary-color);
        }

        .qr-block {
            text-align: center;
            width: 25%; 
            align-self: center;
            border: 1px solid var(--border-color);
            padding: 10px;
            border-radius: 8px;
            background-color: #f9f9f9;
        }
        .qr-code {
            width: 110px; 
            height: 110px;
            padding: 6px;
            background-color: #fff;
            border: 3px solid var(--primary-color);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
            border-radius: 4px;
        }
        .qr-block p { font-size: 0.8em; color: #7f8c8d; margin-top: 10px; font-weight: 700; letter-spacing: 0.5px; }

        /* ---------------------------------------------------- */
        /* Footer Note */
        /* ---------------------------------------------------- */
        .footer-note {
            text-align: center;
            margin-top: 30px; 
            padding: 15px; 
            background-color: var(--light-bg);
            border-top: 4px solid var(--accent-color); 
            color: #5d6d7e;
            font-style: italic;
            font-size: 0.9em; 
            border-radius: 0 0 12px 12px;
            box-shadow: inset 0 5px 10px rgba(0, 0, 0, 0.05);
        }

        /* ---------------------------------------------------- */
        /* Print Button Styling (Screen Only) */
        /* ---------------------------------------------------- */
        .btn-print-wrapper {
            position: fixed;
            bottom: 30px;
            right: 30px;
            z-index: 1000;
        }
        .btn-print {
            padding: 15px 30px;
            background-color: #2ecc71; 
            color: white;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-size: 1.1em;
            font-weight: bold;
            transition: background-color 0.3s, transform 0.2s;
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.3);
        }
        
        /* 👑 PRINT MEDIA QUERY - EXTREME OPTIMIZATION 👑 */
        @media print {
            body { 
                background-color: #fff !important; 
                margin: 0 !important;
                padding: 0 !important;
                font-size: 8.5pt !important; /* Aggressive font reduction */
                -webkit-print-color-adjust: exact !important; 
                color-adjust: exact !important; 
            }
            @page {
                margin: 0; /* Remove page margin entirely */
            }
            .invoice-container { 
                width: 100% !important;
                /* Padding dikurangi ke level paling minimum untuk menghemat ruang */
                padding: 10px 15px !important; 
                margin: 0 !important; 
                box-shadow: none !important; 
                border-top: none !important; 
                max-width: none !important; 
                box-sizing: border-box !important; /* Pastikan padding dihitung dalam lebar 100% */
            }
            .btn-print-wrapper { display: none !important; }
            
            /* Aggressive Vertical Space Optimizations */
            .separator { margin: 10px 0 !important; } 
            .invoice-header { margin-bottom: 12px !important; padding-bottom: 5px !important; } 
            .invoice-header h1 { font-size: 2.0em !important; }
            .invoice-number { padding: 8px 15px !important; font-size: 1.0em !important; }
            .invoice-info-section { margin-bottom: 8px !important; }
            .company-data, .client-data { 
                width: 49% !important;
                padding: 10px !important; /* Minimal padding */
            }

            /* Aggressive Table Space Optimizations */
            .section-title { margin-top: 15px !important; margin-bottom: 8px !important; font-size: 1.2em !important; } 
            .data-table, .payment-table { margin-bottom: 15px !important; } 
            .data-table th, .payment-table th { padding: 5px 8px !important; font-size: 0.75em !important; }
            .data-table td, .payment-table td { 
                padding: 5px 8px !important; 
                font-size: 0.8em !important; 
                white-space: normal !important; /* IZINKAN TEKS WRAP */
            }
            .outstanding-cell { font-size: 1.1em !important; }

            /* Footer Optimization */
            .signature-section { margin-top: 20px !important; } 
            .signature-block { width: 45% !important; }
            .qr-block { width: 30% !important; }
            .signature-space { height: 40px !important; } 
            .qr-code { width: 60px !important; height: 60px !important; padding: 2px !important; border-width: 2px !important; } /* Lebih kecil lagi */
            .qr-block p { font-size: 0.7em !important; margin-top: 5px !important; }
            .footer-note { margin-top: 15px !important; padding: 10px !important; font-size: 0.8em !important; } 

            /* Anti-Potong: Crucial */
            .invoice-container > *, 
            .data-table, 
            .payment-table, 
            .signature-section {
                page-break-inside: avoid !important;
            }
        }
    </style>
</head>
<body>

{{-- PHP logic block is kept intact --}}
@php
    // Data dasar
    $user = $pendaftaran->user ?? null;
    $paket = $pendaftaran->paketTravel ?? null;

    $userName = $user->nama ?? $user->name ?? '-';
    $userHp   = $user->no_hp ?? $user->hp ?? '-';

    $hargaPaket = $paket->harga ?? 0;
   $total = max(0, $hargaPaket);


    // 💰 Hitung total bayar dari transaksi yang sudah acc
    $totalBayar = $pendaftaran->transaksis()
        ->where('status', 'acc')
        ->sum('total');

    $total = max(0, $hargaPaket);
    $sisa  = max(0, $total - $totalBayar);
@endphp


<div class="invoice-container">
    
    <header class="invoice-header">
        <div class="header-left">
            {{-- GANTI DENGAN PATH LOGO ANDA YANG BENAR --}}
            <img src="{{ asset('img/logo.png') }}" alt="Company Logo" class="company-logo">
            <h1>RIWAYAT MUTASI PEMBAYARAN</h1>
        </div>
        <p class="invoice-number">INVOICE #{{ $pendaftaran->id ?? '00000' }}</p>
    </header>
    
    <div class="invoice-info-section">
        <div class="invoice-info company-data">
            <h2><i class="bi bi-building"></i> Data Travel</h2>
            <p><strong>PT. SYAKIRASYA WISATA MANDIRI</strong></p>
            <p>Jl. Raya Mauk Km.12, Desa Kosambi, Kec. Sukadiri, Kab. Tangerang, Banten</p>
            <p><i class="bi bi-telephone"></i> 0812-9573-0907</p>
            <p><i class="bi bi-envelope"></i> syakirasyawrm@gmail.com</p>
        </div>
        <div class="invoice-info client-data">
            <h2><i class="bi bi-person"></i> Data Jamaah</h2>
            <p><strong>{{ $userName }}</strong></p>
            <p><i class="bi bi-telephone"></i> {{ $userHp }}</p>
            <p><i class="bi bi-envelope"></i> {{ $user->email ?? '-' }}</p>
            <p><strong>Invoice Date:</strong> {{ \Carbon\Carbon::now()->format('d M Y') }}</p>
        </div>
    </div>
    
    <hr class="separator"/>
    
    <h3 class="section-title">Detail Pemesanan</h3>
    <div class="table-responsive">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Tanggal Registrasi</th>
                    <th>Nama Paket</th>
                    <th>Tanggal Keberangkatan</th>
                    <th>Tipe Kamar</th>
                    <th>Jumlah Pax</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ \Carbon\Carbon::parse($pendaftaran->created_at)->format('d M Y') }}</td>
                    <td>{{ $paket->nama_paket ?? ($pendaftaran->paket ?? '-') }}</td>
                    <td>
                        {{ \Carbon\Carbon::parse($paket->tanggal_berangkat ?? $pendaftaran->tanggal_berangkat ?? now())->format('d M Y') }}
                    </td>
                    <td>{{ $pendaftaran->tipe_kamar ?? 'Quad' }}</td>
                    <td>{{ $pendaftaran->jumlah_pax ?? $pendaftaran->pax ?? 1 }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <h3 class="section-title">Rincian Pembayaran</h3>
    <div class="table-responsive">
        <table class="payment-table">
            <thead>
                <tr>
                    <th>Harga Paket</th>
                    <th>Total Harga</th>
                    <th>Sudah Dibayar</th>
                    <th>Sisa Pembayaran</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Rp {{ number_format($hargaPaket,0,',','.') }}</td>
                    <td class="total-price-cell">Rp {{ number_format($total,0,',','.') }}</td>
                    <td>Rp {{ number_format($totalBayar,0,',','.') }}</td>
                    <td class="outstanding-cell">Rp {{ number_format($sisa,0,',','.') }}</td>
                    <td>
                        @if($sisa <= 0)
                            <span class="status-badge status-lunas"><i class="bi bi-check-circle"></i> LUNAS</span>
                        @else
                            <span class="status-badge status-belum"><i class="bi bi-x-circle"></i> BELUM LUNAS</span>
                        @endif
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <hr class="separator"/>
    
    <div class="signature-section">
        <div class="signature-block">
            <p>Tangerang, {{ \Carbon\Carbon::now()->format('d M Y') }}</p>
            <p class="role">Disiapkan Oleh, Direktur</p>
            <div class="signature-space"></div>
            <p class="signer"><strong>PT. SYAKIRASYA WISATA MANDIRI</strong></p>
        </div>
        <div class="qr-block">
            {{-- Ganti dengan path QR code yang benar di server Anda --}}
            <img src="{{ asset('img/qr.png') }}" alt="QR Code" class="qr-code">
            <p>Scan for Official Verification</p>
        </div>
    </div>
    
    <div class="footer-note">
        <p>Terima kasih atas kepercayaan Anda memilih layanan kami. Mohon segera lakukan pelunasan.</p>
    </div>

</div>

<div class="btn-print-wrapper">
    <button onclick="window.print()" class="btn-print">
        <i class="bi bi-printer"></i> Print Invoice
    </button>
</div>

</body>
</html>