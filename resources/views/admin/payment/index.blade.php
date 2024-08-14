@extends('admin.app.content')

@section('content')
<style>
    .option-pending { background-color: #f0ad4e; color: #fff; }
    .option-confirmed { background-color: #5bc0de; color: #fff; }
    .option-cancelled { background-color: #d9534f; color: #fff; }
</style>

<div class="panel h-full w-full">
    <div class="mb-5 flex items-center justify-between">
        <h5 class="text-lg font-semibold dark:text-white-light">Recent Orders</h5>
    </div>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Tujuan</th>
                    <th>Harga</th>
                    <th>Status</th>
                    <th>Update</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($payments as $payment)
                    <tr class="group text-white-dark hover:text-black dark:hover:text-white-light/90">
                        <td class="text-primary">{{ $loop->iteration }}</td>
                        <td class="text-primary">{{ $payment->pesan->user->name ?? 'Unknown' }}</td>
                        <td><a href="apps-invoice-preview.html">{{ $payment->pesan->route->end_point ?? 'Unknown' }}</a></td>
                        <td class="text-primary">Rp. {{ number_format($payment->amount, 2, '.', ',') }}</td>
                        <td>
                            @php
                                $status = $payment->status;
                                $badgeClass = 'option-' . $status;
                            @endphp
                            <span class="badge {{ $badgeClass }} shadow-md dark:group-hover:bg-transparent" id="status-{{ $payment->id }}">
                                {{ ucfirst($status) }}
                            </span>
                        </td>
                        <td>
                            <select class="form-select" data-id="{{ $payment->id }}">
                                <option value="pending" {{ $status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="completed" {{ $status == 'completed' ? 'selected' : '' }}>Confirmed</option>
                                <option value="cancelled" {{ $status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                        </td>
                      <td>
                        <form id="form-delete-{{ $payment->id }}" action="{{ route('pemesanan.delete', $payment->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn-delete" data-id="{{ $payment->id }}" title="Hapus">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500">
                                    <path d="M20.5001 6H3.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                                    <path d="M18.8334 8.5L18.3735 15.3991C18.1965 18.054 18.108 19.3815 17.243 20.1907C16.378 21 15.0476 21 12.3868 21H11.6134C8.9526 21 7.6222 21 6.75719 20.1907C5.89218 19.3815 5.80368 18.054 5.62669 15.3991L5.16675 8.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                                    <path opacity="0.5" d="M9.5 11L10 16" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                                    <path opacity="0.5" d="M14.5 11L14 16" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                                    <path opacity="0.5" d="M6.5 6C6.55588 6 6.58382 6 6.60915 5.99936C7.43259 5.97849 8.15902 5.45491 8.43922 4.68032C8.44784 4.65649 8.45667 4.62999 8.47434 4.57697L8.57143 4.28571C8.65431 4.03708 8.69575 3.91276 8.75071 3.8072C8.97001 3.38607 9.37574 3.09364 9.84461 3.01877C9.96213 3 10.0932 3 10.3553 3H13.6447C13.9068 3 14.0379 3 14.1554 3.01877C14.6243 3.09364 15.03 3.38607 15.2493 3.8072C15.3043 3.91276 15.3457 4.03708 15.4286 4.28571L15.5257 4.57697C15.5433 4.62992 15.5522 4.65651 15.5608 4.68032C15.841 5.45491 16.5674 5.97849 17.3909 5.99936C17.4162 6 17.4441 6 17.5 6" stroke="currentColor" stroke-width="1.5"></path>
                                </svg>
                            </button>
                        </form>
                      </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
