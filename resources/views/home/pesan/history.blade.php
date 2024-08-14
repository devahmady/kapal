<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Histori Pemesanan</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <!-- Tombol untuk kembali ke halaman sebelumnya atau beranda -->
        <div class="mb-3">
            <a href="{{ url()->previous() }}" class="btn btn-secondary">
                Kembali
            </a>
        </div>

        <h1 class="mb-4">Histori Pesanan Anda</h1>

        @if ($pesans->isNotEmpty())
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID Pesanan</th>
                        <th>Nama Pengguna</th>
                        <th>Tanggal Pemesanan</th>
                        <th>Jumlah Tiket</th>
                        <th>Total Harga</th>
                        <th>Status Pembayaran</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pesans as $pesan)
                        <tr>
                            <td>{{ $pesan->id }}</td>
                            <td>{{ $pesan->user->name }}</td>
                            <td>{{ $pesan->booking }}</td>
                            <td>{{ $pesan->jumlah_tiket }}</td>
                            <td>Rp {{ number_format($pesan->total_harga, 2, ',', '.') }}</td>
                            <td>
                                @if ($pesan->payments->where('status', 'completed')->isNotEmpty())
                                    Lunas
                                @else
                                    Blum Lunas
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('pesan.show', ['id' => $pesan->id]) }}" class="btn btn-info btn-sm">
                                    Detail
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>Tidak ada histori pesanan ditemukan.</p>
        @endif
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
