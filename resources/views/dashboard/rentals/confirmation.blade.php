@extends('dashboard.layout.main')

@can('admin')
    @section('title', 'Konfirmasi Rental')
@endcan

@can('cust')
    @section('title', 'Detail Penyewaan')
@endcan
@section('container')
    <div class="container-fluid">
        @can('admin')
            <h3 class="mb-4 fw-bold" style="color: var(--navy)">
                {{ $rental->status == 'Menunggu Pembayaran' ? 'Konfirmasi Pembayaran' : 'Detail Penyewaan' }} <span
                    style="font-size: 0.7em">#{{ $rental->transaction_number }}</span></h3>
        @endcan
        @can('cust')
            <h3 class="mb-4 fw-bold" style="color: var(--navy)">
                Detail Penyewaan <span style="font-size: 0.7em">#{{ $rental->transaction_number }}</span></h3>
        @endcan
        <div class="card shadow">
            <div class="card-header py-3">
                <p class="text-warning m-0 fw-bold">
                    @can('admin')
                        {{ $rental->status == 'Menunggu Pembayaran' ? 'Payment Confirmation' : 'Rental Detail' }}
                    @endcan

                    @can('cust')
                        Rental Detail
                    @endcan

                    @switch($rental->status)
                        @case('Menunggu Pembayaran')
                            <span class="ms-2 badge text-bg-warning">{{ $rental->status }}</span>
                        @break

                        @case('Pembayaran Dikonfirmasi')
                            <span class="ms-2 badge text-bg-primary">{{ $rental->status }}</span>
                        @break

                        @case('Pesanan Dibatalkan')
                            <span class="ms-2 badge text-bg-danger">{{ $rental->status }}</span>
                        @break

                        @case('Dalam Penyewaan')
                            <span class="ms-2 badge text-bg-success">{{ $rental->status }}</span>
                        @break

                        @case('Penyewaan Selesai')
                            <span class="ms-2 badge text-bg-secondary">{{ $rental->status }}</span>
                        @break

                        @default
                    @endswitch
                </p>
            </div>
            <div class="card-body" style="color: var(--navy)">
                @can('admin')
                    <h6 class="fw-bold text-dark">Nama</h6>
                    <p>{{ $rental->name ? $rental->name : $rental->user->name }}</p>
                    <h6 class="fw-bold text-dark">Durasi</h6>
                    <p>{{ Carbon\Carbon::parse($rental->start_date)->translatedFormat('d F Y') }} sampai
                        {{ Carbon\Carbon::parse($rental->end_date)->translatedFormat('d F Y') }}</p>
                @endcan
                <h6 class="fw-bold text-dark mt-3 mb-4">Peralatan yang akan disewa</h6>
                <div class="row mb-3">
                    @foreach ($rental->items as $item)
                        <div class="col-md-6 mb-2">
                            <div class="row">
                                <div class="col-4">
                                    @if ($item->equipment->image)
                                        <img src="{{ asset('storage/' . $item->equipment->image) }}" class="img-fluid"
                                            alt="">
                                    @else
                                        <img src="{{ asset('img/default.png') }}" class="img-fluid" alt="">
                                    @endif
                                </div>
                                <div class="col-8">
                                    <h6 class="fw-bold text-dark">Nama Barang</h6>
                                    <p>{{ $item->equipment->name }}</p>
                                    <h6 class="fw-bold text-dark">Jumlah</h6>
                                    <p>{{ $item->quantity }}</p>
                                    <h6 class="fw-bold text-dark">Harga per Hari</h6>
                                    <p>Rp.{{ number_format($item->equipment->price_per_day, 2, ',', '.') }}</p>
                                    <h6 class="fw-bold text-dark">Total</h6>
                                    <p>Rp.{{ number_format($item->equipment->price_per_day * $item->quantity, 2, ',', '.') }}
                                    </p>
                                </div>
                            </div>
                            <hr>
                        </div>
                    @endforeach
                </div>

                @can('cust')
                    <h6 class="fw-bold text-dark">Durasi</h6>
                    <p>{{ Carbon\Carbon::parse($rental->start_date)->translatedFormat('d F Y') }} sampai
                        {{ Carbon\Carbon::parse($rental->end_date)->translatedFormat('d F Y') }}</p>
                @endcan

                <div class="text-end">
                    <h5 class="fw-bold text-dark mb-1">Total Keseluruhan</h5>
                    <p style="font-size: 1.2em">Rp.{{ number_format($rental->total, 2, ',', '.') }}</p>
                    @can('admin')

                        @if ($rental->status == 'Pesanan Dibatalkan' || $rental->status == 'Penyewaan Selesai')
                            <a class="btn btn-secondary" href="/dashboard/rental-log">Kembali</a>
                        @else
                            <a class="btn btn-secondary" href="/dashboard/rentals">Kembali</a>
                        @endif

                        @if ($rental->status == 'Menunggu Pembayaran')
                            <a class="btn btn-success" href="{{ route('rental-confirm', $rental->id) }}">Konfirmasi</a>
                        @endif
                    @endcan
                    @can('cust')
                        <a class="btn btn-secondary" href="/dashboard/rentals">Kembali</a>
                    @endcan

                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection
