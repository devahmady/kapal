
    <div class="container mt-5 py-3">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s" style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInUp;">
            <h6 class="section-title text-center text-primary text-uppercase">Our Team</h6>
            <h1 class="mb-5">Explore Our <span class="text-primary text-uppercase">Staffs</span></h1>
        </div>

        <!-- Display success message if any -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Display validation errors if any -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Payment ID</th>
                    <th>Booking ID</th>
                    <th>Bank</th>
                    <th>Amount</th>
                    <th>Payment Method</th>
                    <th>Status</th>
                    <th>Booking Date</th>
                   
                </tr>
            </thead>
            <tbody>
                @forelse ($payments as $payment)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        <a href="{{ route('history.show', $payment->booking_id) }}" target="_blank">
                            {{ $payment->booking_id }}
                        </a>
                    </td>
                    <td>{{ $payment->bank->name }}</td>
                    <td>Rp. {{ number_format($payment->amount , 2, '.', ',') }}</td>
                    <td>{{ $payment->payment_method }}</td>
                    <td>{{ ucfirst($payment->booking->status) }}</td>
                    <td>{{ $payment->booking->booking_date ?? 'none' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="9">No payments found.</td>
                </tr>
            @endforelse
            
            </tbody>
        </table>
    </div>

