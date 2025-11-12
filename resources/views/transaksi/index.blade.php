<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">

    <h2 class="mb-4 text-center">📋 Data Transaksi</h2>

    {{-- Pesan sukses / error --}}
    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger text-center">{{ session('error') }}</div>
    @endif

    {{-- Tombol Tambah Transaksi --}}
    <div class="mb-3 text-end">
        <a href="{{ route('transaksi.create') }}" class="btn btn-primary">+ Tambah Transaksi</a>
    </div>

    {{-- Tabel Transaksi --}}
    <div class="card shadow-sm">
        <div class="card-body table-responsive">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-dark">
                    <tr class="text-center">
                        <th>No</th>
                        <th>Nama Jamaah</th>
                        <th>Tanggal</th>
                        <th>Metode Pembayaran</th>
                        <th>Total (Rp)</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transaksis as $t)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $t->user->name ?? '-' }}</td>
                            <td>{{ \Carbon\Carbon::parse($t->tanggal)->format('d-m-Y') }}</td>
                            <td>{{ $t->metode_pembayaran }}</td>
                            <td>Rp {{ number_format($t->total, 0, ',', '.') }}</td>
                            <td>{{ $t->keterangan ?? '-' }}</td>
                            <td class="text-center">
                                <form action="{{ route('transaksi.destroy', $t->id) }}" method="POST" onsubmit="return confirm('Yakin hapus transaksi ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">Belum ada data transaksi.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

</body>
</html>
