@extends('dashboard.layout.main')

@section('title', 'Log Sewa Peralatan')
@section('container')
    <div class="container-fluid">
        <h3 class="mb-4 fw-bold" style="color: var(--navy)">Log Pembayaran</h3>
        <div class="card shadow">
            <div class="card-header py-3">
                <p class="text-warning m-0 fw-bold">Payments Log</p>
            </div>
            <div class="card-body">
                <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                    <table class="table my-0 display" id="myTable" style="width: 100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>No Transaksi</th>
                                <th>Waktu Pembayaran</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($payments as $p)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $p->rental->transaction_number }}</td>
                                    <td>{{ Carbon\Carbon::parse($p->payment_date)->translatedFormat('H:i, d F Y') }}</td>

                                    <td>Rp.{{ number_format($p->total, 2, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
