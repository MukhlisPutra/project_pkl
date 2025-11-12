<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Daftar Akun - PT Syakirasya</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  {{-- Tambahkan Bootstrap Icons untuk konsistensi --}}
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
  <style>
    body {
      /* Ganti background agar sama dengan login.blade.php */
      background: linear-gradient(to right, #d4fc79, #96e6a1);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      font-family: 'Poppins', sans-serif; /* Asumsi font Poppins digunakan di login */
    }
    .card {
      /* Style card agar sama dengan login.blade.php */
      border: none;
      border-radius: 16px;
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    }
    .form-floating > label {
      /* Style form-floating label agar sama dengan login.blade.php */
      left: 1.25rem;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="row justify-content-center">
      {{-- Ubah col-md-6 menjadi col-md-5 agar konsisten dengan login --}}
      <div class="col-md-5">
        <div class="card p-4">
          <div class="text-center mb-4">
            {{-- Tambahkan logo dan heading seperti di login --}}
            <img src="{{ asset('img/logo.png') }}" alt="Logo Syakirasya" height="60" />
            <h5 class="mt-2">Daftar Akun Jamaah</h5>
            <p class="text-muted small">Silakan isi data diri Anda untuk membuat akun.</p>
          </div>

          {{-- Notifikasi sukses / error --}}
          @if (session('success'))
              <div class="alert alert-success py-2">{{ session('success') }}</div>
          @endif
          @if ($errors->any())
              {{-- Ubah tampilan error agar lebih mirip notifikasi di login --}}
              <div class="alert alert-danger py-2">
                  {{-- Tampilkan error pertama, jika ingin sama persis dengan login. Jika tidak, pakai list di bawah. --}}
                  {{ $errors->first() }}
                  {{-- Jika ingin menampilkan semua error, gunakan ini:
                  <ul class="mb-0">
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
                  --}}
              </div>
          @endif

          {{-- Form Register --}}
          <form action="{{ route('register.post') }}" method="POST">
              @csrf

              {{-- Ubah input menjadi form-floating --}}
              <div class="form-floating mb-3">
                  <input type="text" name="name" class="form-control" placeholder="Nama Lengkap" value="{{ old('name') }}" required>
                  <label for="name"><i class="bi bi-person me-2"></i>Nama Lengkap</label>
              </div>

              <div class="form-floating mb-3">
                  <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}" required>
                  <label for="email"><i class="bi bi-envelope me-2"></i>Email</label>
              </div>

              <div class="form-floating mb-3">
                  <input type="text" name="no_hp" class="form-control" placeholder="Nomor HP" value="{{ old('no_hp') }}" required>
                  <label for="no_hp"><i class="bi bi-phone me-2"></i>Nomor HP</label>
              </div>

              {{-- Textarea tidak support form-floating sebaik input, gunakan mb-3 biasa dengan label di atas --}}
              <div class="mb-3">
                  <label for="alamat" class="form-label small text-muted">Alamat (Opsional)</label>
                  <textarea name="alamat" class="form-control" rows="2" placeholder="Masukkan Alamat">{{ old('alamat') }}</textarea>
              </div>

              <div class="form-floating mb-4">
                  <input type="password" name="password" class="form-control" placeholder="Kata Sandi" required>
                  <label for="password"><i class="bi bi-lock me-2"></i>Kata Sandi</label>
              </div>

              {{-- Ubah tombol agar konsisten --}}
              <div class="d-grid">
                <button type="submit" class="btn btn-success">Daftar Sekarang</button>
              </div>

              <p class="text-center mt-3">
                  Sudah punya akun? <a href="{{ route('login') }}" class="text-decoration-none">Masuk di sini</a>
              </p>
          </form>

        </div>
      </div>
    </div>
  </div>

  {{-- Bootstrap JS (opsional, tapi baik untuk komponen interaktif) --}}
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>