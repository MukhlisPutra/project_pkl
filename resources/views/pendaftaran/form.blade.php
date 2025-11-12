<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Form Booking - PT Syakirasya</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
  <style>
    body {
      background-color: #f8f9fa;
      font-family: 'Poppins', sans-serif;
    }
    .booking-form {
      max-width: 650px;
      margin: 60px auto;
      background: white;
      padding: 40px;
      border-radius: 16px;
      box-shadow: 0 10px 25px rgba(0,0,0,0.07);
    }
    h3 {
      color: #1A5D1A;
      font-weight: bold;
      margin-bottom: 20px;
    }
    .form-label i {
      color: #1A5D1A;
      margin-right: 6px;
    }
    .btn-success {
      background-color: #1A5D1A;
      border: none;
    }
    .btn-success:hover {
      background-color: #144d14;
    }
    .header-icon {
      font-size: 32px;
      color: #1A5D1A;
    }
  </style>
</head>
<body>

<div class="container">
  <div class="booking-form">
    <div class="text-center mb-4">
      <i class="fas fa-kaaba header-icon"></i>
      <h3 class="mt-2">Form Booking Umrah / Haji</h3>
      <p class="text-muted">Silakan lengkapi data di bawah ini untuk melanjutkan booking Anda.</p>
    </div>

    {{-- Pesan sukses --}}
    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Form Booking --}}
    <form action="{{ route('pendaftaran.store') }}" method="POST" enctype="multipart/form-data">
      @csrf

      {{-- Hidden user & paket --}}
      <input type="hidden" name="user_id" value="{{ $user->id }}">
      <input type="hidden" name="paket_travel_id" value="{{ $paket->id }}">
      <input type="hidden" name="status" value="menunggu">

      {{-- Nama otomatis dari database --}}
      <div class="mb-3">
        <label for="nama" class="form-label"><i class="fas fa-user"></i>Nama Lengkap</label>
        <input type="text" class="form-control" id="nama" name="nama" 
               value="{{ $user->name }}" readonly>
      </div>

      {{-- Nomor HP --}}
      <div class="mb-3">
        <label for="hp" class="form-label"><i class="fas fa-phone"></i>No. HP / WA Aktif</label>
        <input type="tel" class="form-control" id="hp" name="hp" 
               value="{{ $user->no_hp }}" readonly>
      </div>

      {{-- Paket --}}
      <div class="mb-3">
        <label for="paket" class="form-label"><i class="fas fa-box"></i>Paket Travel</label>
        <input type="text" class="form-control" id="paket" 
               value="{{ $paket->nama_paket }} (Rp {{ number_format($paket->harga, 0, ',', '.') }})" readonly>
      </div>

      {{-- Upload KTP --}}
      <div class="mb-3">
        <label for="ktp" class="form-label"><i class="fas fa-id-card"></i> Upload KTP</label>
        <input type="file" class="form-control @error('ktp') is-invalid @enderror" 
               id="ktp" name="ktp" accept="image/*" required>
        @error('ktp')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      {{-- Upload KK --}}
      <div class="mb-3">
        <label for="kk" class="form-label"><i class="fas fa-users"></i> Upload Kartu Keluarga</label>
        <input type="file" class="form-control @error('kk') is-invalid @enderror" 
               id="kk" name="kk" accept="image/*" required>
        @error('kk')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      {{-- Catatan --}}
      <div class="mb-3">
        <label for="catatan" class="form-label"><i class="fas fa-comment-dots"></i>Catatan Tambahan</label>
        <textarea class="form-control @error('catatan') is-invalid @enderror" 
                  id="catatan" name="catatan" rows="3">{{ old('catatan') }}</textarea>
        @error('catatan')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      {{-- Tombol --}}
      <div class="d-grid">
        <button type="submit" class="btn btn-success btn-lg">
          <i class="fas fa-paper-plane me-2"></i>Kirim Booking Sekarang
        </button>
      </div>
    </form>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
