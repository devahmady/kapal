<div class="container py-3">
    <div class="text-center wow fadeInUp" data-wow-delay="0.1s"
        style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInUp;">
        <h6 class="section-title text-center text-primary text-uppercase">Our Team</h6>
        <h1 class="mb-5">Explore Our <span class="text-primary text-uppercase">Staffs</span></h1>
    </div>
    <form action="{{ route('booking.store') }}" method="POST">
        @csrf
        <div class="form-group p-2">
            <label for="route_id">Tujuan</label>
            <select name="route_id" id="route_id" class="form-control" required>
                <option value="">Pilih Tujuan</option>
                @foreach ($routes as $route)
                    <option value="{{ $route->id }}" data-price="{{ $route->price }}">{{ $route->end_point }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group p-2">
            <label for="category_id">Kategory</label>
            <select name="category_id" id="category_id" class="form-control" required>
                <option value="">Pilih Kategory</option>
                @foreach ($category as $b)
                    <option value="{{ $b->id }}">{{ $b->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group p-2">
            <label for="passenger_type_id">Jasa</label>
            <select name="passenger_type_id" id="passenger_type_id" class="form-control" required>
                <option value="">Pilih Jasa</option>
                @foreach ($passengerTypes as $passengerType)
                    <option value="{{ $passengerType->id }}" data-price="{{ $passengerType->price }}">
                        {{ $passengerType->type }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group p-2">
            <label for="transportation_id">Transportation</label>
            <select name="transportation_id" id="transportation_id" class="form-control" required>
                <option value="">Pilih Transportation</option>
                @foreach ($transportations as $transportation)
                    <option value="{{ $transportation->id }}" data-price="{{ $transportation->price }}">
                        {{ $transportation->type }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group p-2">
            <label for="bank_id">Bank</label>
            <select name="bank_id" id="bank_id" class="form-control" required>
                <option value="" disabled selected>Pilih bank</option>
                @foreach ($banks as $bank)
                    <option value="{{ $bank->id }}">{{ $bank->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group p-2">
            <label for="booking_date">Booking Date</label>
            <input type="date" name="booking_date" id="booking_date" class="form-control" required>
        </div>
        <div class="form-group p-2">
            <label for="total_price">Total Price</label>
            <input type="number" name="total_price" id="total_price" class="form-control" step="0.01" value="0"
                readonly>
        </div>
        <div class="form-group p-2">
            <button type="submit" class="btn btn-primary ">Simpan</button>
        </div>
    </form>

</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        function updatePrice() {
            var routeId = $('#route_id').val();

            if (routeId) {
                $.ajax({
                    url: '{{ route('getPrice') }}',
                    type: 'GET',
                    data: {
                        route_id: routeId
                    },
                    success: function(response) {
                        if (response.price !== undefined) {
                            $('#total_price').val(response.price);
                        } else {
                            $('#total_price').val(
                            '0'); // Set default value to 0 if no valid response
                        }
                    },
                    error: function(xhr) {
                        console.error('Error:', xhr.responseText);
                        $('#total_price').val('0'); // Set default value to 0 on error
                    }
                });
            } else {
                $('#total_price').val('0'); // Set default value to 0 if no route selected
            }
        }

        $('#route_id').on('change', updatePrice);

        // Initialize price on page load
        updatePrice();
    });
</script>
