<!DOCTYPE html>
<html>
<head>
    <title>Tiket Pemesanan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
            background-color: #f9f9f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            width: 100%;
            max-width: 400px;
            margin: auto;
            padding: 20px;
            background: #fff;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
            border-radius: 8px;
            border: 1px dashed #ddd;
        }
        h1 {
            text-align: center;
            color: #4CAF50;
            margin-bottom: 20px;
            font-size: 16px;
        }
        .info {
            margin-bottom: 20px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f5f5f5;
            font-size: 14px;
        }
        .info p {
            margin: 5px 0;
        }
        .info strong {
            display: inline-block;
            width: 150px;
            font-weight: bold;
            color: #333;
        }
        .payments, .passengers {
            margin-top: 20px;
        }
        .passengers h3 {
            font-size: 16px;
            margin-bottom: 10px;
            color: #4CAF50;
            border-bottom: 1px solid #ddd;
            padding-bottom: 5px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            font-size: 14px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #ddd;
        }
        .receipt-footer {
            text-align: center;
            font-size: 12px;
            color: #777;
            margin-top: 20px;
            border-top: 1px dashed #ddd;
            padding-top: 10px;
        }
        @media (max-width: 768px) {
            .info strong {
                width: auto;
                display: inline;
            }
            table, th, td {
                font-size: 12px;
            }
        }
        @media (max-width: 480px) {
            .container {
                padding: 10px;
            }
            h1 {
                font-size: 14px;
            }
            .info strong {
                width: auto;
            }
            table, th, td {
                font-size: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Detail Tiket Pemesanan</h1>
        
        <div class="info">
            <p><strong>ID Pemesanan:</strong> {{ $pesan->id }}</p>
            <p><strong>Nama Pengguna:</strong> {{ $pesan->user->name }}</p>
            <p><strong>Email Pengguna:</strong> {{ $pesan->user->email }}</p>
            <p><strong>Tanggal Pemesanan:</strong> {{ \Carbon\Carbon::parse($pesan->booking)->format('d-m-Y') }}</p>
            <p><strong>Total Harga:</strong> {{ number_format($pesan->total_harga, 2, ',', '.') }}</p>
            <p><strong>Jumlah Tiket:</strong> {{ $pesan->jumlah_tiket }}</p>
            <p><strong>Rute:</strong> {{ $pesan->route->start_point ?? 'N/A' }} - {{ $pesan->route->end_point ?? 'N/A' }}</p>
        </div>

        <div class="passengers">
            <h3>Data Penumpang:</h3>
            <table>
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pesan->dataPenumpang as $b)
                    <tr>
                        <td>{{ $b->name ?? 'N/A' }}</td>
                        <td>{{ $b->email ?? 'N/A' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="receipt-footer">
            <p>Harap tunjukkan tiket ini saat check-in.</p>
            <p>Terima kasih telah menggunakan layanan kami.</p>
        </div>
    </div>
</body>
</html>
