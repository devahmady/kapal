<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proses Pembayaran</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container py-3">
    <h1>Proses Pembayaran</h1>
    <p>Pesanan ID: {{ $pesan->id }}</p>
    <p>Nama:</p>
    <ul>
        @foreach ($pesans as $pesanItem)
            <li>{{ $pesanItem->name }}</li>
        @endforeach
    </ul>
    <p>Total Harga: {{ $pesan->total_harga }}</p>

    <form action="{{ route('payment.process') }}" method="POST">
        @csrf
        <input type="hidden" name="pesan_id" value="{{ $pesan->id }}">
        
        <div class="form-group">
            <label for="amount">Jumlah Pembayaran</label>
            <input type="text" id="amount" name="amount" class="form-control" value="{{ $pesan->total_harga }}">
        </div>

        <div class="form-group">
            <label for="payment_method">Metode Pembayaran</label>
            <select id="payment_method" name="payment_method" class="form-control">
                <option value="credit_card">Kartu Kredit</option>
                <option value="bank_transfer">Transfer Bank</option>
                <option value="paypal">PayPal</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Proses Pembayaran</button>
    </form>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
