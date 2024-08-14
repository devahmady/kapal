<div class="container py-3">
    <div class="text-center wow fadeInUp" data-wow-delay="0.1s" style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInUp;">
        <h6 class="section-title text-center text-primary text-uppercase">Page</h6>
        <h1 class="mb-5">Payment <span class="text-primary text-uppercase">Tiket</span></h1>
    </div>
    <p>Pesanan ID: {{ $pesan->id }}</p>

    <p>Total Harga: {{ $pesan->total_harga }}</p>

    <form action="{{ route('payment.process') }}" method="POST">
        @csrf
        <input type="hidden" name="pesan_id" value="{{ $pesan->id }}">

        <div class="form-group p-2">
            <label for="amount">Jumlah Pembayaran</label>
            <input type="text" id="amount" name="amount" class="form-control" value="{{ $pesan->total_harga }}">
        </div>

        <div class="form-group p-2">
            <label for="payment_method">Metode Pembayaran</label>
            <select id="payment_method" name="payment_method" class="form-control">
                <option value="bri">BRI</option>
                <option value="mandiri">Mandiri</option>
                <option value="bca">BCA</option>
            </select>
        </div>
        <div class="form-group p-2">
            <button type="submit" class="btn btn-success">Proses Pembayaran</button>
        </div>
    </form>
</div>
