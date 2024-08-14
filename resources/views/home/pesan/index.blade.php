<div class="container py-3">
    <div class="text-center wow fadeInUp" data-wow-delay="0.1s" style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInUp;">
        <h6 class="section-title text-center text-primary text-uppercase">Page</h6>
        <h1 class="mb-5">Search  <span class="text-primary text-uppercase">Tiket</span></h1>
    </div>

    <form action="{{ route('pesan.search') }}" method="POST">
        @csrf
        <div class="form-group p-3">
            <label for="start_point">Rute Awal</label>
            <input type="text" id="start_point" name="start_point" class="form-control">
        </div>

        <div class="form-group p-3">
            <label for="end_point">Rute Tujuan</label>
            <input type="text" id="end_point" name="end_point" class="form-control">
        </div>

        <div class="form-group p-3">
            <label for="jam">Tanggal Berangkat</label>
            <input type="date" id="jam" name="jam" class="form-control">
        </div>
        <div class="form-group p-3">
            <button type="submit" class="btn btn-primary">Cari Rute</button>
        </div>
    </form>

</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.full.min.js"></script>
<script>
    $(document).ready(function() {
        $('#name').select2();

        $('#name').change(function() {
            let selectedValues = $(this).val() || []; // Handle empty array
            let types = [];
            let dynamicFields = '';
            let selectedDataDisplay = '<h4>Data yang Dipilih:</h4><ul>';

            // Debugging
            console.log('Selected Values:', selectedValues);

            // Mengambil semua elemen option untuk mendapatkan jenis tiket
            $('#name option').each(function() {
                // Debugging untuk melihat data-type
                console.log('Option Value:', $(this).val());
                console.log('Option Data-Type:', $(this).data('type'));

                if (selectedValues.includes($(this).val())) {
                    let type = $(this).data('type');
                    if (type && !types.includes(type)) {
                        types.push(type);
                    }
                }
            });

            // Debugging
            console.log('Selected Types:', types);

            if (types.includes('penumpang')) {
                dynamicFields += `
                    <div class="form-group">
                        <label for="penumpang_id">Pilih Penumpang</label>
                        <select id="penumpang_id" name="penumpang_id" class="form-control">
                            <option value="">Pilih Penumpang</option>
                            @foreach ($penumpangs as $penumpang)
                                <option value="{{ $penumpang->id }}">{{ $penumpang->type }}</option>
                            @endforeach
                        </select>
                    </div>
                `;
                selectedDataDisplay += '<li>Penumpang</li>';
            }

            if (types.includes('kendaraan')) {
                dynamicFields += `
                    <div class="form-group">
                        <label for="kendaraan_id">Pilih Kendaraan</label>
                        <select id="kendaraan_id" name="kendaraan_id" class="form-control">
                            <option value="">Pilih Kendaraan</option>
                            @foreach ($kendaraans as $kendaraan)
                                <option value="{{ $kendaraan->id }}">{{ $kendaraan->type }}</option>
                            @endforeach
                        </select>
                    </div>
                `;
                selectedDataDisplay += '<li>Kendaraan</li>';
            }

            selectedDataDisplay += '</ul>';
            $('#selected_data').html(selectedDataDisplay); // Menampilkan data yang dipilih

            if (dynamicFields) {
                $('#dynamic_form_fields').html(dynamicFields).removeClass('d-none');
            } else {
                $('#dynamic_form_fields').addClass('d-none');
            }
        });
    });
</script>
