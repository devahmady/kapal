<div class="container py-3">
    <div class="text-center wow fadeInUp" data-wow-delay="0.1s" style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInUp;">
        <h6 class="section-title text-center text-primary text-uppercase">Page</h6>
        <h1 class="mb-5">Booking <span class="text-primary text-uppercase">Tiket</span></h1>
    </div>

    @if ($routes->isNotEmpty())
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Rute</th>
                    <th>Jam</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($routes as $route)
                    <tr>
                        <td>{{ $route->start_point }} - {{ $route->end_point }}</td>
                        <td>{{ $route->jam }}</td>
                        <td>
                            <form action="{{ route('pesan.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="route_id" value="{{ $route->id }}">

                                <div class="form-group p-2">
                                    <label for="penumpang_id">Penumpang</label>
                                    <select id="penumpang_id" name="penumpang_id" class="form-control">
                                        <option value="">Pilih Penumpang</option>
                                        @foreach ($penumpangs as $penumpang)
                                            <option value="{{ $penumpang->id }}" data-harga="{{ $penumpang->harga }}">
                                                {{ $penumpang->level }} ({{ $penumpang->harga }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group p-2">
                                    <label for="kendaraan_id">Kendaraan</label>
                                    <select id="kendaraan_id" name="kendaraan_id" class="form-control">
                                        <option value="">Pilih Kendaraan</option>
                                        @foreach ($kendaraans as $kendaraan)
                                            <option value="{{ $kendaraan->id }}" data-harga="{{ $kendaraan->harga }}">
                                                {{ $kendaraan->type }} ({{ $kendaraan->harga }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group p-2">
                                    <label for="jumlah_tiket">Jumlah Tiket</label>
                                    <input type="number" id="jumlah_tiket" name="jumlah_tiket" class="form-control" value="1" min="1">
                                </div>

                                <div class="form-group p-2">
                                    <label for="total_harga">Total Harga</label>
                                    <input type="number" id="total_harga" name="total_harga" class="form-control" readonly>
                                </div>

                                <div class="form-group p-2">
                                    <label for="bank_id">Bank</label>
                                    <select id="bank_id" name="bank_id" class="form-control">
                                        @foreach ($banks as $bank)
                                            <option value="{{ $bank->id }}">{{ $bank->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group p-2">
                                    <button type="submit" class="btn btn-success">Pesan Sekarang</button>
                                </div>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Tidak ada rute yang ditemukan.</p>
    @endif
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const penumpangSelect = document.getElementById('penumpang_id');
        const kendaraanSelect = document.getElementById('kendaraan_id');
        const jumlahTiketInput = document.getElementById('jumlah_tiket');
        const totalHargaInput = document.getElementById('total_harga');

        function calculateTotal() {
            const penumpangPrice = parseFloat(penumpangSelect.options[penumpangSelect.selectedIndex]?.dataset.harga) || 0;
            const kendaraanPrice = parseFloat(kendaraanSelect.options[kendaraanSelect.selectedIndex]?.dataset.harga) || 0;
            const jumlahTiket = parseInt(jumlahTiketInput.value) || 1;

            const totalPrice = (penumpangPrice + kendaraanPrice) * jumlahTiket;
            totalHargaInput.value = totalPrice.toFixed(2);
        }

        penumpangSelect.addEventListener('change', calculateTotal);
        kendaraanSelect.addEventListener('change', calculateTotal);
        jumlahTiketInput.addEventListener('input', calculateTotal);
    });
</script>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
