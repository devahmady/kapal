<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Tiket Kapal</title>
    <link rel="stylesheet" href="styles.css">
</head>
<script>
    function printTicket() {
        window.print();
    }
</script>
<style>
 body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
}

.ticket {
    width: 90%;
    max-width: 600px;
    margin: 20px auto;
    padding: 20px;
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    border: 2px solid #3498db; /* Border garis pada keseluruhan tiket */
}

.ticket-header {
    text-align: center;
    margin-bottom: 20px;
    border-bottom: 2px solid #3498db; /* Border bawah header */
    padding-bottom: 10px;
}

.ticket-header h1 {
    font-size: 24px;
    color: #2c3e50;
}

.ticket-subtitle {
    font-size: 16px;
    color: #7f8c8d;
}

.ticket-body {
    margin-top: 20px;
}

.ticket-info, .ticket-details {
    margin-bottom: 20px;
    border: 1px solid #3498db; /* Border pada bagian info dan detail */
    padding: 10px;
    border-radius: 5px;
}

.ticket-info h2, .ticket-details h2 {
    font-size: 20px;
    color: #2c3e50;
    border-bottom: 2px solid #3498db; /* Border bawah judul */
    padding-bottom: 10px;
    margin-bottom: 10px;
}

.ticket-info p, .ticket-details p {
    font-size: 16px;
    margin: 5px 0;
}

.ticket-info p strong, .ticket-details p strong {
    color: #2c3e50;
}

.ticket-footer {
    text-align: center;
    margin-top: 20px;
}

.ticket-footer p {
    font-size: 14px;
    color: #7f8c8d;
}

.ticket-footer a {
    color: #3498db;
    text-decoration: none;
}

.ticket-footer a:hover {
    text-decoration: underline;
}

.print-button {
    text-align: center;
    margin-top: 20px;
}

.print-button button {
    background-color: #3498db;
    color: #fff;
    border: none;
    border-radius: 5px;
    padding: 10px 20px;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.print-button button:hover {
    background-color: #2980b9;
}


</style>
<body>
    <div class="ticket">
        <header class="ticket-header">
            <h1>E-Tiket Kapal</h1>
            <p class="ticket-subtitle">Perjalanan Anda Bersama Kami</p>
        </header>
{{-- @dd($payment) --}}
        <div class="ticket-body">
            <div class="ticket-info">
                <h2>Informasi Tiket</h2>
                <p><strong>Nomor Booking:</strong> {{ $payment->booking_id }}</p>
                <p><strong>Nama Penumpang:</strong> {{ $payment->user->name }}</p>
                <p><strong>Jenis Penumpang:</strong> {{ $booking->category->name ?? 'Kategori tidak tersedia' }}</p>
                <p><strong>Tanggal Perjalanan:</strong> {{ $booking->booking_date ?? 'none' }}</p>
            </div>

            <div class="ticket-details">
                <h2>Detail Perjalanan</h2>
                <p><strong>Rute:</strong> {{ $booking->route->start_point }} - {{ $booking->route->end_point }}</p>
                <p><strong>Waktu Berangkat:</strong>  <td>{{ \Carbon\Carbon::createFromFormat('H:i:s', $booking->route->jam)->format('g:i A') }}</td></p>
                {{-- <p><strong>Waktu Tiba:</strong> 16:00 WIB</p> --}}
                <p><strong>Nama Kapal:</strong> {{ $booking->transportation->type }}</p>
            </div>

            <div class="ticket-footer">
                <p>Terima kasih telah memilih kami!</p>
                <p>Untuk pertanyaan lebih lanjut, hubungi kami di <a href="mailto:support@kapal.com">support@kapal.com</a>.</p>
            </div>

            <div class="print-button">
                <button onclick="printTicket()">Cetak Tiket</button>
            </div>
        </div>
    </div>
</body>
</html>
