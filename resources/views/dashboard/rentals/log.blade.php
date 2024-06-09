@extends('dashboard.layout.main')

@section('title', 'Log Sewa Peralatan')
@section('container')
    <div class="container-fluid">
        <h3 class="mb-4 fw-bold" style="color: var(--navy)">Log Rental Peralatan</h3>
        <div class="card shadow">
            <div class="card-header py-3">
                <p class="text-warning m-0 fw-bold">Rentals Log</p>
            </div>
            <div class="card-body">
                <!-- Form Add Start-->

                <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                    <table class="table my-0 display" id="myTable" style="width: 100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Penyewa</th>
                                <th>Tanggal Mulai</th>
                                <th>Tanggal Akhir</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Peralatan yang Disewa</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rentals as $r)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $r->name ? $r->name : $r->user->name }}</td>
                                    <td>{{ $r->start_date }}</td>
                                    <td>{{ $r->end_date }}</td>
                                    <td>Rp.{{ number_format($r->total, 2, ',', '.') }}</td>
                                    <td>
                                        @switch($r->status)
                                            @case('Menunggu Pembayaran')
                                                <span class="badge text-bg-warning">{{ $r->status }}</span>
                                            @break

                                            @case('Pembayaran Dikonfirmasi')
                                                <span class="badge text-bg-primary">{{ $r->status }}</span>
                                            @break

                                            @case('Pesanan Dibatalkan')
                                                <span class="badge text-bg-danger">{{ $r->status }}</span>
                                            @break

                                            @case('Dalam Penyewaan')
                                                <span class="badge text-bg-success">{{ $r->status }}</span>
                                            @break

                                            @case('Penyewaan Selesai')
                                                <span class="badge text-bg-secondary">{{ $r->status }}</span>
                                            @break

                                            @default
                                        @endswitch
                                    </td>
                                    <td>
                                        <a class="btn btn-primary" href="{{ route('rental-detail', $r->id) }}">
                                            <i class="fa solid fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
