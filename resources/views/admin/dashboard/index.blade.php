@extends('admin.app.content')
@section('content')
    <div class="mb-6 grid grid-cols-1 gap-6 text-white sm:grid-cols-2 xl:grid-cols-6">
        <!-- Total Income -->
        <div class="panel bg-gradient-to-r from-cyan-500 to-cyan-400">
            <div class="flex justify-between">
                <div class="text-md font-semibold ltr:mr-1 rtl:ml-1">Income</div>
            </div>
            <div class="mt-5 flex items-center">
                <div class="text-3xl font-bold ltr:mr-3 rtl:ml-3">
                    Rp. {{ number_format($totalConfirmedPrice, 2, '.', ',') }}
                </div>
            </div>
        </div>

        <!-- Total Pending -->
        <div class="panel bg-gradient-to-r from-violet-500 to-violet-400">
            <div class="flex justify-between">
                <div class="text-md font-semibold ltr:mr-1 rtl:ml-1">Pending</div>
            </div>
            <div class="mt-5 flex items-center">
                <div class="text-3xl font-bold ltr:mr-3 rtl:ml-3">Rp. {{ number_format($totalPendingPrice, 2, '.', ',') }}</div>
            </div>
        </div>

        <!-- Recent Transactions Confirmed -->
        <div class="panel">
            <div class="mb-5 text-lg font-bold">Recent Transactions Confirmed</div>
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th class="ltr:rounded-l-md rtl:rounded-r-md">ID</th>
                            <th>Payment Date</th>
                            <th>Penumpang</th>
                            <th>Tujuan</th>
                            <th>Amount</th>
                            <th class="text-center ltr:rounded-r-md rtl:rounded-l-md">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($confirmed as $payment)
                            <tr>
                                <td class="font-semibold">{{ $loop->iteration }}</td>
                                <td class="whitespace-nowrap">{{ $payment->created_at->format('d-m-Y') }}</td>
                                <td class="whitespace-nowrap">{{ $payment->pesan->user->name ?? 'Unknown' }}</td>
                                <td class="whitespace-nowrap">{{ $payment->pesan->route->end_point ?? 'Unknown' }}</td>
                                <td>Rp. {{ number_format($payment->amount, 2, '.', ',') }}</td>
                                <td class="text-center">
                                    <span class="badge rounded-full 
                                        @if ($payment->status == 'pending') bg-warning/20 text-warning 
                                        @elseif ($payment->status == 'completed') bg-success/20 text-success 
                                        @elseif ($payment->status == 'cancelled') bg-danger/20 text-danger 
                                        @else bg-secondary/20 text-secondary @endif
                                        hover:top-0">
                                        {{ ucfirst($payment->status) }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No confirmed transactions available.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Recent Transactions Pending -->
        <div class="panel">
            <div class="mb-5 text-lg font-bold">Recent Transactions Pending</div>
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th class="ltr:rounded-l-md rtl:rounded-r-md">ID</th>
                            <th>Payment Date</th>
                            <th>Penumpang</th>
                            <th>Tujuan</th>
                            <th>Amount</th>
                            <th class="text-center ltr:rounded-r-md rtl:rounded-l-md">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pending as $payment)
                            <tr>
                                <td class="font-semibold">{{ $loop->iteration }}</td>
                                <td class="whitespace-nowrap">{{ $payment->created_at->format('d-m-Y') }}</td>
                                <td class="whitespace-nowrap">{{ $payment->pesan->user->name ?? 'Unknown' }}</td>
                                <td class="whitespace-nowrap">{{ $payment->pesan->route->end_point ?? 'Unknown' }}</td>
                                <td>Rp. {{ number_format($payment->amount, 2, '.', ',') }}</td>
                                <td class="text-center">
                                    <span class="badge rounded-full 
                                        @if ($payment->status == 'pending') bg-warning/20 text-warning 
                                        @elseif ($payment->status == 'completed') bg-success/20 text-success 
                                        @elseif ($payment->status == 'cancelled') bg-danger/20 text-danger 
                                        @else bg-secondary/20 text-secondary @endif
                                        hover:top-0">
                                        {{ ucfirst($payment->status) }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No pending transactions available.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
