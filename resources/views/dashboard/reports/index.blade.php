@extends('dashboard.layout.main')

@section('title', 'Report')
@section('container')
    <div class="container-fluid">
        <h3 class="mb-4 fw-bold" style="color: var(--navy)">Report</h3>
        <div class="card shadow">
            <div class="card-header py-3">
                <p class="text-warning m-0 fw-bold">Reports</p>
            </div>
            <div class="card-body">
                <form action="{{ route('report-filter') }}" method="POST" class="col-md-10" target="_blank">
                    @csrf

                    <div class="mb-3">
                        <label for="form-label">Jenis Report</label>
                        <select class="select form-control" name="report_type" id="" required style="width: 100%">
                            <option value="" disabled selected></option>
                            <option value="Keuangan" {{ old('report_type') == 'Keuangan' ? 'selected' : ' ' }}>Report
                                Keuangan</option>
                            <option value="Top10" {{ old('report_type') == 'Top10' ? 'selected' : ' ' }}>Report Top 10
                                Transaksi</option>
                            <option value="Pelanggan" {{ old('report_type') == 'Pelanggan' ? 'selected' : ' ' }}>Report
                                Pelanggan</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="form-label">Tanggal Awal</label>
                        <input type="date" name="start_date" id="" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="form-label">Tanggal Akhir</label>
                        <input type="date" name="end_date" id="" class="form-control">
                    </div>
                    <div class="form-check mb-3">
                        <label class="form-check-label" for="flexCheckChecked">
                            Download PDF?
                        </label>
                        <input class="form-check-input" type="checkbox" value="1" name="download">
                    </div>
                    <p class="d-inline">*Kosongkan Tanggal Awal dan Akhir untuk range semua tanggal</p>
                    <p class="mb-3">*Kosongkan Tanggal Awal / Akhir untuk range dengan batas tanggal awal atau akhir
                        tersebut.</p>
                    <div class="text-end">
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('.select').select2({
                dropdownParent: $('.card-body'),
                theme: 'bootstrap-5',
                placeholder: 'Pilih salah satu'
            });
        });
    </script>
@endsection
