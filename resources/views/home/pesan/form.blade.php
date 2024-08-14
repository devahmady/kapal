<div class="container py-3">
    <div class="text-center wow fadeInUp" data-wow-delay="0.1s"
        style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInUp;">
        <h6 class="section-title text-center text-primary text-uppercase">Page</h6>
        <h1 class="mb-5">Formulir Data <span class="text-primary text-uppercase">Tiket</span></h1>
    </div>


    <form action="{{ route('pesan.save') }}" method="POST">
        @csrf
        <input type="hidden" name="pesan_id" value="{{ $pesan->id }}">
        @for ($i = 0; $i < $jumlah_tiket; $i++)
            <div class="form-group p-2">
                <h3>Tiket {{ $i + 1 }}</h3>
                <label for="name{{ $i }}">Nama</label>
                <input type="text" id="name{{ $i }}" name="names[]" class="form-control" required>

                <label for="email{{ $i }}">Email</label>
                <input type="email" id="email{{ $i }}" name="emails[]" class="form-control" required>
            </div>
        @endfor
        <div class="form-group p-2">
            <button type="submit" class="btn btn-success">Simpan Pemesanan</button>
        </div>
    </form>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
