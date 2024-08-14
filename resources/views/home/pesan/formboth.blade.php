<div class="container py-3">
    <div class="text-center wow fadeInUp" data-wow-delay="0.1s" style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInUp;">
        <h6 class="section-title text-center text-primary text-uppercase">Formulir Penumpang dan Kendaraan</h6>
        <h1 class="mb-5">Isi Data Penumpang dan Kendaraan</h1>
    </div>

    <form action="{{ route('pesan.store.both', ['id' => $pesan->id]) }}" method="POST">
        @csrf
        <input type="hidden" name="route_id" value="{{ $pesan->route_id }}">
        <input type="hidden" name="jumlah_tiket" value="{{ $jumlah_tiket }}">
    
        @for ($i = 0; $i < $jumlah_tiket; $i++)
            <div class="penumpang-form-group">
                <h4>Penumpang {{ $i + 1 }}</h4>
    
                <!-- Data Penumpang -->
                <div class="form-group p-2">
                    <label for="penumpang_id_{{ $i }}">Penumpang</label>
                    <select id="penumpang_id_{{ $i }}" name="penumpangs[{{ $i }}][penumpang_id]" class="form-control">
                        <option value="">Pilih Penumpang</option>
                        @foreach ($penumpangs as $penumpang)
                            <option value="{{ $penumpang->id }}">
                                {{ $penumpang->level }}
                            </option>
                        @endforeach
                    </select>
                </div>
    
                <div class="form-group p-2">
                    <label for="penumpang_name_{{ $i }}">Nama Penumpang</label>
                    <input type="text" id="penumpang_name_{{ $i }}" name="penumpangs[{{ $i }}][name]" class="form-control">
                </div>
    
                <div class="form-group p-2">
                    <label for="penumpang_email_{{ $i }}">Email Penumpang</label>
                    <input type="email" id="penumpang_email_{{ $i }}" name="penumpangs[{{ $i }}][email]" class="form-control">
                </div>
    
                <!-- Data Kendaraan -->
                <div class="form-group p-2">
                    <label for="kendaraan_id_{{ $i }}">Kendaraan</label>
                    <select id="kendaraan_id_{{ $i }}" name="kendaraans[{{ $i }}][kendaraan_id]" class="form-control">
                        <option value="">Pilih Kendaraan</option>
                        @foreach ($kendaraans as $kendaraan)
                            <option value="{{ $kendaraan->id }}">
                                {{ $kendaraan->type }}
                            </option>
                        @endforeach
                    </select>
                </div>
    
                <div class="form-group p-2">
                    <label for="kendaraan_plat_{{ $i }}">Plat Kendaraan</label>
                    <input type="text" id="kendaraan_plat_{{ $i }}" name="kendaraans[{{ $i }}][plat]" class="form-control">
                </div>
            </div>
        @endfor
    
        <div class="form-group p-2">
            <button type="submit" class="btn btn-success">Simpan Data Penumpang dan Kendaraan</button>
        </div>
    </form>
    
</div>
