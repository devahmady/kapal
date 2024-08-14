<div class="container py-3">
    <div class="text-center">
        <h6 class="section-title text-center text-primary text-uppercase">E-Tiket</h6>
        <h1 class="mb-5">Detail Pesanan #{{ $pesan->id }}</h1>
    </div>
    <div class="mb-3">
        <a href="{{ route('pesan.history') }}" class="btn btn-primary">
            Kembali ke Menu Histori
        </a>
    </div>
    <div class="ticket">
        <div class="ticket-header">
            <h2>Detail Pesanan</h2>
        </div>
        <div class="ticket-section">
            <h3>Informasi Pengguna</h3>
            @if ($pesan->user)
                <table class="table table-bordered mb-4">
                    <thead>
                        <tr>
                            <th>Nama Pengguna</th>
                            <th>Email Pengguna</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $pesan->user->name }}</td>
                            <td>{{ $pesan->user->email }}</td>
                        </tr>
                    </tbody>
                </table>
            @else
                <p>Data pengguna tidak tersedia.</p>
            @endif
        </div>
        <div class="ticket-body">
            <div class="ticket-info">
                <table class="table table-bordered mb-4">
                    <thead>
                        <tr>
                            <th colspan="2">Informasi Pesanan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>ID Pesanan:</td>
                            <td>{{ $pesan->id }}</td>
                        </tr>
                        <tr>
                            <td>Tanggal Pemesanan:</td>
                            <td>{{ $pesan->booking }}</td>
                        </tr>
                        <tr>
                            <td>Jumlah Tiket:</td>
                            <td>{{ $pesan->jumlah_tiket }}</td>
                        </tr>
                        <tr>
                            <td>Total Harga:</td>
                            <td>Rp {{ number_format($pesan->total_harga, 2, ',', '.') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="ticket-section">
                <h3>Informasi Data Penumpang</h3>
                @if ($pesan->dataPenumpangs->isNotEmpty())
                    <table class="table table-bordered mb-4">
                        <thead>
                            <tr>
                                <th>Nama Penumpang</th>
                                <th>Email Penumpang</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pesan->dataPenumpangs as $dataPenumpang)
                                <tr>
                                    <td>{{ $dataPenumpang->name }}</td>
                                    <td>{{ $dataPenumpang->email }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p>Data penumpang tidak tersedia.</p>
                @endif
            </div>
            <div class="ticket-section">
                <h3>Informasi Rute</h3>
                @if ($pesan->route)
                    <table class="table table-bordered mb-4">
                        <tbody>
                            <tr>
                                <td><strong>Tujun Rute:</strong></td>
                                <td>{{ $pesan->route->end_point }}</td>
                            </tr>
                        </tbody>
                    </table>
                @else
                    <p>Data rute tidak tersedia.</p>
                @endif
            </div>
            <div class="ticket-section">
                <h3>Informasi Data Kendaraan</h3>
                @if ($pesan->dataKendaraans->isNotEmpty())
                    <table class="table table-bordered mb-4">
                        <thead>
                            <tr>
                                <th>Jenis Kendaraan</th>
                                <th>Plat Kendaraan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pesan->dataKendaraans as $dataKendaraan)
                                <tr>
                                    <td>{{ $dataKendaraan->kendaraan->type }}</td>
                                    <td>{{ $dataKendaraan->plat }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p>Data kendaraan tidak tersedia.</p>
                @endif
            </div>

            <div class="ticket-section">
                <h3>Informasi Bank</h3>
                @if ($pesan->bank)
                    <table class="table table-bordered mb-4">
                        <tbody>
                            <tr>
                                <td><strong>Nama Bank:</strong></td>
                                <td>{{ $pesan->bank->name }}</td>
                            </tr>
                            <tr>
                                <td><strong>Nomor Rekening:</strong></td>
                                <td>{{ $pesan->bank->rekening }}</td>
                            </tr>
                        </tbody>
                    </table>
                @else
                    <p>Data bank tidak tersedia.</p>
                @endif
            </div>

            <div class="ticket-section">
                <h3>Riwayat Pembayaran</h3>
                @if ($payments->isNotEmpty())
                    <table class="table table-bordered mb-4">
                        <thead>
                            <tr>
                                <th>ID Pembayaran</th>
                                <th>Jumlah</th>
                                <th>Metode Pembayaran</th>
                                <th>Status</th>
                                <th>Dibuat</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($payments as $payment)
                                <tr>
                                    <td>{{ $payment->id }}</td>
                                    <td>Rp {{ number_format($payment->amount, 2, ',', '.') }}</td>
                                    <td>{{ $payment->payment_method }}</td>
                                    <td>{{ ucfirst($payment->status) }}</td>
                                    <td>{{ $payment->created_at }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p>Tidak ada pembayaran untuk pesanan ini.</p>
                @endif
            </div>
            

            <div class="ticket-section mt-4">
                <!-- Tombol Cetak Tiket jika status pembayaran 'completed' -->
                @if ($pesan->payments->where('status', 'completed')->isNotEmpty())
                    <a href="{{ route('tiket.print', ['id' => $pesan->id]) }}" class="btn btn-success mt-3">Cetak
                        Tiket</a>
                    <p class="mt-3 text-success">Pembayaran selesai. Tiket dapat dicetak.</p>
                @else
                    <p class="mt-3 text-danger">Tiket tidak dapat dicetak sebelum pembayaran selesai.</p>
                @endif

                <!-- Menampilkan countdown jika status pembayaran belum 'completed' -->
                @if ($pesan->payments->where('status', 'completed')->isEmpty())
                    @php
                        // Mengatur deadline 24 jam dari waktu saat ini
                        $deadline = now()->addDay()->timestamp;
                        $now = now()->timestamp;
                    @endphp

                    @if ($now < $deadline)
                        <p class="countdown" id="countdown" data-deadline="{{ $deadline }}"></p>
                    @else
                        <p class="mt-3 text-danger">Waktu untuk melakukan pembayaran telah habis.</p>
                    @endif
                @else
                    <p>Tidak ada detail pemesanan ditemukan.</p>
                @endif
            </div>

        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const countdownElement = document.getElementById('countdown');
            if (countdownElement) {
                const deadline = parseInt(countdownElement.getAttribute('data-deadline'));
                const now = Math.floor(Date.now() / 1000);
                const timeRemaining = deadline - now;
    
                if (timeRemaining > 0) {
                    const updateCountdown = () => {
                        const now = Math.floor(Date.now() / 1000);
                        const timeRemaining = deadline - now;
    
                        if (timeRemaining <= 0) {
                            countdownElement.innerHTML = 'Waktu untuk melakukan pembayaran telah habis.';
                            countdownElement.classList.add('text-danger');
                            return;
                        }
    
                        const hours = Math.floor(timeRemaining / 3600);
                        const minutes = Math.floor((timeRemaining % 3600) / 60);
                        const seconds = timeRemaining % 60;
    
                        countdownElement.innerHTML = `${hours} jam ${minutes} menit ${seconds} detik`;
                        countdownElement.classList.remove('text-danger');
                    };
    
                    updateCountdown();
                    setInterval(updateCountdown, 1000);
                } else {
                    countdownElement.innerHTML = 'Waktu untuk melakukan pembayaran telah habis.';
                    countdownElement.classList.add('text-danger');
                }
            }
        });
    </script>
    
    <style>
        .ticket {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 20px;
            background: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .ticket-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .ticket-body {
            font-family: Arial, sans-serif;
        }

        .ticket-section {
            margin-bottom: 20px;
        }

        .ticket-section h3 {
            margin-top: 0;
            margin-bottom: 10px;
            font-size: 1.25rem;
            border-bottom: 1px solid #ddd;
            padding-bottom: 5px;
        }

        .table {
            margin-bottom: 0;
        }
    </style>
