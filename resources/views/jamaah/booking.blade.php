<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Form Booking - PT Syakirasya</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #1A5D1A; /* Dark Green */
            --secondary-color: #F3FDE8; /* Light Pale Green/Cream */
            --text-color: #343a40;
            --border-radius: 12px;
        }

        body {
            background-color: var(--secondary-color);
            font-family: 'Poppins', sans-serif;
            color: var(--text-color);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .booking-form {
            max-width: 650px;
            width: 100%;
            margin: 30px auto; /* Reduced margin for better centering */
            background: white;
            padding: 45px;
            border-radius: var(--border-radius);
            box-shadow: 0 15px 35px rgba(0,0,0,0.1); /* Slightly deeper shadow */
            border: 1px solid #e0e0e0; /* Subtle border */
        }

        h3 {
            color: var(--primary-color);
            font-weight: 700;
            margin-bottom: 5px;
        }

        .header-icon {
            font-size: 40px; /* Larger icon */
            color: var(--primary-color);
            margin-bottom: 10px;
            /* Animation or hover effect could be added here for extra polish */
        }
        
        /* Input Field Styling */
        .form-control {
            border-radius: 8px;
            padding: 10px 15px;
            border: 1px solid #ced4da;
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(26, 93, 26, 0.25); /* Custom focus shadow */
        }

        .form-label {
            font-weight: 600;
            color: var(--text-color);
            margin-bottom: 6px;
            display: block; /* Ensures the label takes full width */
        }

        .form-label i {
            color: var(--primary-color);
            margin-right: 8px;
        }
        
        /* Readonly Field Background */
        .form-control[readonly] {
            background-color: #f5f5f5; /* Light grey background for non-editable fields */
            color: #6c757d;
        }

        /* Button Styling */
        .btn-success {
            background-color: var(--primary-color);
            border: none;
            padding: 12px 25px;
            border-radius: 8px;
            font-weight: 600;
            transition: background-color 0.3s, transform 0.1s;
        }

        .btn-success:hover {
            background-color: #144d14; /* Darker green on hover */
            transform: translateY(-1px);
        }
        
        /* Alert Styling */
        .alert {
            border-radius: 8px;
            font-weight: 500;
            padding: 12px 20px;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border-color: #f5c6cb;
        }
        
        .alert-warning {
            background-color: #fff3cd;
            color: #856404;
            border-color: #ffeeba;
        }
        
        /* File Input Customization (to make it look better) */
        .form-control[type="file"] {
            padding: 10px 15px;
            height: auto;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="booking-form">
        <div class="text-center mb-5">
            <i class="fas fa-kaaba header-icon"></i>
            <h3 class="mt-2">Form Booking Umrah / Haji</h3>
            <p class="text-muted">Silakan lengkapi data di bawah ini untuk melanjutkan booking Anda.</p>
        </div>

        {{-- Pesan error --}}
        @if(session('error'))
        <div class="alert alert-danger text-center mb-4">
            <i class="fas fa-triangle-exclamation me-2"></i>{{ session('error') }}
        </div>
        @endif

        {{-- Pesan warning --}}
        @if(session('warning'))
        <div class="alert alert-warning text-center mb-4">
            <i class="fas fa-exclamation-circle me-2"></i>{{ session('warning') }}
        </div>
        @endif


        {{-- Form Booking --}}
        <form action="{{ route('pendaftaran.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- Hidden user & paket (KEEPING HIDDEN INPUTS) --}}
        <input type="hidden" name="user_id" value="{{ $user->id }}">
        <input type="hidden" name="paket_travel_id" value="{{ $paket->id }}">
        <input type="hidden" name="status" value="menunggu">

        <div class="row">
            {{-- Nama otomatis --}}
            <div class="col-md-6 mb-4">
                <label for="nama" class="form-label"><i class="fas fa-user"></i>Nama Lengkap</label>
                <input type="text" class="form-control" id="nama" name="nama" value="{{ $user->name }}" readonly>
            </div>

            {{-- Nomor HP otomatis --}}
            <div class="col-md-6 mb-4">
                <label for="hp" class="form-label"><i class="fas fa-phone"></i>No. HP / WA Aktif</label>
                {{-- Changed value to old('hp', $user->no_hp) to retain value on validation error --}}
                <input type="tel" class="form-control @error('hp') is-invalid @enderror" id="hp" name="hp" value="{{ old('hp', $user->no_hp) }}" required>
                @error('hp')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        
        {{-- Paket otomatis dari pilihan --}}
        <div class="mb-4">
            <label for="paket" class="form-label"><i class="fas fa-box"></i>Paket Travel Pilihan</label>
            <input type="text" class="form-control" id="paket"
                value="{{ $paket->nama_paket }} (Rp {{ number_format($paket->harga, 0, ',', '.') }})" readonly>
        </div>
        
        <hr class="my-4">
        
        <p class="text-muted text-center mb-4"><i class="fas fa-file-upload me-2"></i>Persyaratan Dokumen</p>

        <div class="row">
            {{-- Upload KTP --}}
            <div class="col-md-6 mb-4">
                <label for="ktp" class="form-label"><i class="fas fa-id-card"></i> Upload KTP (Wajib)</label>
                <input type="file" class="form-control @error('ktp') is-invalid @enderror" id="ktp" name="ktp" accept="image/*" required>
                @error('ktp')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Upload KK --}}
            <div class="col-md-6 mb-4">
                <label for="kk" class="form-label"><i class="fas fa-users"></i> Upload Kartu Keluarga (Wajib)</label>
                <input type="file" class="form-control @error('kk') is-invalid @enderror" id="kk" name="kk" accept="image/*" required>
                @error('kk')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>


        {{-- Catatan --}}
        <div class="mb-5">
            <label for="catatan" class="form-label"><i class="fas fa-comment-dots"></i>Catatan Tambahan (Opsional)</label>
            <textarea class="form-control @error('catatan') is-invalid @enderror" id="catatan" name="catatan" rows="4" placeholder="Contoh: Permintaan kamar double, berangkat bersama 3 orang lainnya...">{{ old('catatan') }}</textarea>
            @error('catatan')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Tombol Kirim --}}
        <div class="d-grid">
            <button type="submit" class="btn btn-success btn-lg">
                <i class="fas fa-paper-plane me-2"></i>Kirim Booking Sekarang
            </button>
        </div>
    </form>

    </div>
<<<<<<< HEAD

    {{-- Pesan error --}}
@if(session('error'))
  <div class="alert alert-danger text-center">
    <i class="fas fa-triangle-exclamation me-2"></i>{{ session('error') }}
  </div>
@endif

{{-- Pesan warning (kalau mau pakai notifikasi kuning) --}}
@if(session('warning'))
  <div class="alert alert-warning text-center">
    <i class="fas fa-exclamation-circle me-2"></i>{{ session('warning') }}
  </div>
@endif


    {{-- Form Booking --}}
    <form action="{{ route('pendaftaran.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    {{-- Hidden user & paket --}}
    <input type="hidden" name="user_id" value="{{ $user->id }}">
    <input type="hidden" name="paket_travel_id" value="{{ $paket->id }}">
    <input type="hidden" name="status" value="menunggu">

    {{-- Nama otomatis --}}
    <div class="mb-3">
        <label for="nama" class="form-label"><i class="fas fa-user"></i>Nama Lengkap</label>
        <input type="text" class="form-control" id="nama" name="nama" value="{{ $user->name }}" readonly>

    </div>

    {{-- Nomor HP otomatis --}}
    <div class="mb-3">
        <label for="hp" class="form-label"><i class="fas fa-phone"></i>No. HP / WA Aktif</label>
        <input type="tel" class="form-control" id="hp" name="hp" value="{{ $user->no_hp }}">
    </div>

    {{-- Paket otomatis dari pilihan --}}
    <div class="mb-3">
        <label for="paket" class="form-label"><i class="fas fa-box"></i>Paket Travel</label>
        <input type="text" class="form-control" id="paket"
               value="{{ $paket->nama_paket }} (Rp {{ number_format($paket->harga, 0, ',', '.') }})" readonly>
    </div>

    {{-- Upload KTP --}}
    <div class="mb-3">
        <label for="ktp" class="form-label"><i class="fas fa-id-card"></i> Upload KTP</label>
        <input type="file" class="form-control @error('ktp') is-invalid @enderror" id="ktp" name="ktp" accept="image/*" required>
        @error('ktp')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    {{-- Upload KK --}}
    <div class="mb-3">
        <label for="kk" class="form-label"><i class="fas fa-users"></i> Upload Kartu Keluarga</label>
        <input type="file" class="form-control @error('kk') is-invalid @enderror" id="kk" name="kk" accept="image/*" required>
        @error('kk')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>



    {{-- Catatan --}}
    <div class="mb-3">
        <label for="catatan" class="form-label"><i class="fas fa-comment-dots"></i>Catatan Tambahan</label>
        <textarea class="form-control @error('catatan') is-invalid @enderror" id="catatan" name="catatan" rows="3">{{ old('catatan') }}</textarea>
        @error('catatan')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    {{-- Tombol Kirim --}}
    <div class="d-grid">
        <button type="submit" class="btn btn-success btn-lg">
            <i class="fas fa-paper-plane me-2"></i>Kirim Booking Sekarang
        </button>
    </div>
</form>

  </div>
=======
>>>>>>> 961fc8259019e6948cce34e45fc51862ebdc4083
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>