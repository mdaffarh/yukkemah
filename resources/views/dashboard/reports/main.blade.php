<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}-{{ Carbon\Carbon::now() }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ public_path() . '/css/bootstrap.min.css' }}">
    <style>
        table td,
        table th,
        table tr {
            border: 1px solid rgb(92, 92, 92) !important;
            font-family: Arial, Helvetica, sans-serif !important;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col">
                <img src="{{ public_path() . '/img/yukkemah.png' }}" style="width: 120px;" class="img-fluid">
            </div>
            <div class="text-center mt-3 col">
                <p class="fw-bold m-0" style="font-weight: bold!important">{{ $title }}</p>

                @if (!$start_date && !$end_date)
                    <p>Semua Waktu</p>
                @endif

                @if ($start_date && $end_date)
                    <p>{{ Carbon\Carbon::parse($start_date)->translatedFormat('d F Y') }}-
                        {{ Carbon\Carbon::parse($end_date)->translatedFormat('d F Y') }}</p>
                @endif

                @if ($start_date && !$end_date)
                    <p>Mulai {{ Carbon\Carbon::parse($start_date)->translatedFormat('d F Y') }}</p>
                @endif

                @if (!$start_date && $end_date)
                    <p>Sampai {{ Carbon\Carbon::parse($end_date)->translatedFormat('d F Y') }}</p>
                @endif
            </div>
            <div class="col">

            </div>
        </div>
        @if ($type == 'Keuangan')
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th scope="col" style="text-align: center!important">No</th>
                        <th scope="col">No Transaksi</th>
                        <th scope="col">Waktu Pembayaran</th>
                        <th scope="col">Total</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    @php
                        $total = 0;
                    @endphp
                    @foreach ($data as $d)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $d->rental->transaction_number }}</td>
                            <td>{{ Carbon\Carbon::parse($d->payment_date)->translatedFormat('H:i, d F Y') }}</td>
                            <td>Rp.{{ number_format($d->total, 2, ',', '.') }}</td>
                        </tr>
                        @php
                            $total += $d->total;
                        @endphp
                    @endforeach
                    <tr>
                        <th scope="row" colspan="3">Total</th>
                        <td class="fw-bold">Rp.{{ number_format($total, 2, ',', '.') }}</td>
                    </tr>

                </tbody>
            </table>
        @endif
        @if ($type == 'Top10')
            <table class="table table-striped table-bordered" border="1">
                <thead>
                    <tr>
                        <th scope="col" style="text-align: center!important">No</th>
                        <th scope="col">No Transaksi</th>
                        <th scope="col">Nama Cust</th>
                        <th scope="col">Tanggal Mulai</th>
                        <th scope="col">Tanggal Selesai</th>
                        <th scope="col">Total</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    @foreach ($data as $d)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $d->transaction_number }}</td>
                            <td>{{ $d->user_id ? $d->user->name : $d->name }}</td>
                            <td>{{ Carbon\Carbon::parse($d->start_date)->translatedFormat('d F Y') }}</td>
                            <td>{{ Carbon\Carbon::parse($d->end_date)->translatedFormat('d F Y') }}</td>
                            <td>Rp.{{ number_format($d->total, 2, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
        @if ($type == 'Pelanggan')
            <table class="table table-striped table-bordered" border="1">
                <thead>
                    <tr>
                        <th scope="col" style="text-align: center!important">No</th>
                        <th scope="col">Nama Cust</th>
                        <th scope="col">Banyak Transaksi</th>
                        <th scope="col">Total</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    @foreach ($data as $d)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $d->user->name }}</td>
                            <td>{{ $d->times }}x</td>
                            <td>Rp.{{ number_format($d->total, 2, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</body>

</html>
