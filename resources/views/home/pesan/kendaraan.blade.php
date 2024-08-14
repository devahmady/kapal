<div class="container py-3">
    <div class="text-center wow fadeInUp" data-wow-delay="0.1s" style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInUp;">
        <h6 class="section-title text-center text-primary text-uppercase">Formulir Kendaraan</h6>
        <h1 class="mb-5">Isi Data Kendaraan</h1>
    </div>

    <form action="{{ route('pesan.store.kendaraan', ['id' => $pesan->id]) }}" method="POST">
        @csrf
        <input type="hidden" name="route_id" value="{{ $pesan->route_id }}">
        <input type="hidden" name="jumlah_tiket" value="{{ $jumlah_tiket }}">

        @for ($i = 0; $i < $jumlah_tiket; $i++)
            <div class="kendaraan-form-group">
                <h4>Kendaraan {{ $i + 1 }}</h4>

                <!-- Data Kendaraan -->
                <div class="form-group p-2">
                    <label for="kendaraan_id_{{ $i }}">Kendaraan</label>
                    <select id="kendaraan_id_{{ $i }}" name="kendaraans[{{ $i }}][kendaraan_id]" class="form-control" required>
                        <option value="">Pilih Kendaraan</option>
                        @foreach ($kendaraans as $kendaraan)
                            <option value="{{ $kendaraan->id }}" data-harga="{{ $kendaraan->harga }}">
                                {{ $kendaraan->type }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group p-2">
                    <label for="kendaraan_plat_{{ $i }}">Plat Kendaraan</label>
                    <input type="text" id="kendaraan_plat_{{ $i }}" name="kendaraans[{{ $i }}][plat]" class="form-control" required>
                </div>
            </div>
        @endfor

        <div class="form-group p-2">
            <button type="submit" class="btn btn-success">Simpan Data Kendaraan</button>
        </div>
    </form>
</div>
