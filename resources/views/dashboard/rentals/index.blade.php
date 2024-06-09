@extends('dashboard.layout.main')

@section('title', 'Sewa Peralatan')
@section('container')
    <div class="container-fluid">
        <h3 class="mb-4 fw-bold" style="color: var(--navy)">Rental Peralatan</h3>
        <div class="card shadow">
            <div class="card-header py-3">
                <p class="text-warning m-0 fw-bold">Rentals</p>
            </div>
            <div class="card-body">
                <!-- Form Add Start-->
                <div class="d-flex flex-row-reverse">
                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#formAdd">
                        Tambah Rental
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="formAdd" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                        aria-labelledby="formAddLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5 fw-bold" style="color: var(--navy);" id="formAddLabel">
                                        Tambah Rental Peralatan</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="/dashboard/rentals" method="POST">
                                        @csrf

                                        <div class="mb-3" id="selectUser">
                                            <label class="form-label">Nama (Terdaftar)</label>
                                            <select name="user_id"
                                                class="select select2add form-control text-primary-emphasis"
                                                style="width: 100%">
                                                <option value="" disabled selected></option>
                                                @foreach ($users as $u)
                                                    <option value="{{ $u->id }}"
                                                        {{ old('user_id') == $u->id ? 'selected' : '' }}>
                                                        {{ $u->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3" id="inputName">
                                            <label class="form-label">Nama</label>
                                            <input type="text"
                                                class="form-control text-primary-emphasis  @error('name') is-invalid @enderror"
                                                name="name" value="{{ old('name') }}">
                                            @error('name')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <input type="checkbox" id="toggleCheckbox"> Terdaftar
                                        </div>

                                        {{-- Select Peralatan --}}
                                        <div class="d-flex justify-content-between mb-3">
                                            <label class="form-label">Peralatan</label>
                                            <div>
                                                <button type="button" class="btn btn-success"
                                                    id="add-button">Tambah</button>
                                            </div>
                                        </div>
                                        <div id="equipment-container" class="mb-3">
                                            <div class="input-group mb-1 equipment-item">
                                                <select name="equipment_id[]"
                                                    class="select form-control text-primary-emphasis" style="width: 50%"
                                                    aria-placeholder="Pilih salah satu">
                                                    <option value="" disabled selected></option>
                                                    @foreach ($equipments as $e)
                                                        <option value="{{ $e->id }}"
                                                            {{ old('equipment_id') == $e->id ? 'selected' : '' }}>
                                                            {{ $e->name }} (Stok: {{ $e->stock }})
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <input type="number" class="form-control text-primary-emphasis"
                                                    name="quantity[]" placeholder="Jumlah" value="{{ old('quantity[]') }}"
                                                    min="1" required>
                                                <button type="button"
                                                    class="btn btn-danger remove-button-add">Hapus</button>

                                            </div>
                                            @error('error')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror

                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Tanggal Mulai</label>
                                            <input type="date" class="form-control text-primary-emphasis"
                                                name="start_date" value="{{ old('start_date') }}">
                                            @error('start_date')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Tanggal Akhir</label>
                                            <input type="date" class="form-control text-primary-emphasis" name="end_date"
                                                value="{{ old('end_date') }}">
                                            @error('end_date')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-success text-white">Submit</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    {{-- Form Add End --}}
                </div>

                <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                    <table class="table my-0 display" id="myTable" style="width: 100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>No Transaksi</th>
                                <th>Nama Penyewa</th>
                                <th>Tanggal Mulai</th>
                                <th>Tanggal Akhir</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rentals as $r)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $r->transaction_number }}</td>
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

                                            @case('Dalam Penyewaan')
                                                <span class="badge text-bg-success">{{ $r->status }}</span>
                                            @break

                                            @default
                                        @endswitch
                                    </td>
                                    <td>
                                        <div class="btn-group-vertical" role="group">

                                            @if ($r->status == 'Menunggu Pembayaran')
                                                <a href="{{ route('rental-confirmation', $r->id) }}"
                                                    class="btn btn-sm btn-success text-light"
                                                    role="button">Konfirmasi</a>

                                                <button type="button" class="btn btn-sm btn-danger"
                                                    data-bs-toggle="modal" data-bs-target="#cancel{{ $r->id }}">
                                                    Batal
                                                </button>

                                                <button type="button" class="btn btn-sm btn-primary"
                                                    data-bs-toggle="modal" data-bs-target="#edit{{ $r->id }}"
                                                    onclick="select2Enabler('edit{{ $r->id }}')">
                                                    Edit
                                                </button>
                                            @endif
                                            @if ($r->status == 'Pembayaran Dikonfirmasi')
                                                <a href="{{ route('rental-handover', $r->id) }}"
                                                    class="btn btn-sm btn-info" role="button">Penyerahan Barang</a>
                                            @endif
                                            @if ($r->status == 'Dalam Penyewaan')
                                                <a href="{{ route('rental-return', $r->id) }}"
                                                    class="btn btn-sm btn-secondary" role="button">Pengembalian</a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>

                                {{-- Modal Cancel --}}
                                <div class="modal fade" id="cancel{{ $r->id }}" data-bs-backdrop="static"
                                    data-bs-keyboard="false" tabindex="-1" aria-labelledby="detailLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5 fw-bold" style="color: var(--navy);"
                                                    id="cancelLabel">Batalkan Pesanan</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body text-center">
                                                <img src="{{ asset('img/deleteConfirm.png') }}" class="w-75 img-fluid">
                                                <h3 class="fw-bold" style="color: var(--navy)">Anda yakin untuk
                                                    membatalkan pesanan ini?</h3>
                                            </div>
                                            <div class="modal-footer">
                                                <a class="btn btn-danger"
                                                    href="{{ route('rental-cancel', $r->id) }}">Batal</a>
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Batal</button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                {{-- Modal Cancel End --}}

                                <!-- Modal Edit Start-->
                                <div class="modal fade" id="edit{{ $r->id }}" data-bs-backdrop="static"
                                    data-bs-keyboard="false" tabindex="-1" aria-labelledby="formAddLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5 fw-bold" style="color: var(--navy);"
                                                    id="formAddLabel">
                                                    Edit Rental Peralatan</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="/dashboard/rentals/{{ $r->id }}" method="POST">
                                                    @csrf
                                                    @method('put')

                                                    <div class="mb-3" id="selectUser{{ $r->id }}">
                                                        <label class="form-label">Nama (Terdaftar)</label>
                                                        <select name="user_id"
                                                            class="select select2 form-control text-primary-emphasis"
                                                            style="width: 100%">
                                                            <option value="" disabled selected></option>
                                                            @foreach ($users as $u)
                                                                <option value="{{ $u->id }}"
                                                                    {{ old('user_id') == $u->id || $r->user_id == $u->id ? 'selected' : '' }}>
                                                                    {{ $u->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="mb-3" id="inputName{{ $r->id }}">
                                                        <label class="form-label">Nama</label>
                                                        <input type="text"
                                                            class="form-control text-primary-emphasis  @error('name') is-invalid @enderror"
                                                            name="name"
                                                            value="{{ $r->name ? $r->name : old('name') }}">
                                                        @error('name')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <input type="checkbox" id="toggleCheckbox{{ $r->id }}"
                                                            {{ $r->user_id > 0 ? 'checked' : ' ' }}> Terdaftar
                                                    </div>

                                                    {{-- Select Peralatan --}}
                                                    <div class="d-flex justify-content-between mb-3">
                                                        <label class="form-label">Peralatan</label>
                                                        <div>
                                                            <button type="button" class="btn btn-success"
                                                                id="add-button{{ $r->id }}">Tambah</button>

                                                        </div>
                                                    </div>
                                                    <div id="equipment-container{{ $r->id }}" class="mb-3">
                                                        @foreach ($r->items as $item)
                                                            <div
                                                                class="input-group mb-1 equipment-item{{ $r->id }}">
                                                                <select name="equipment_id[]"
                                                                    class="select form-control text-primary-emphasis"
                                                                    style="width: 50%"
                                                                    aria-placeholder="Pilih salah satu">
                                                                    <option value="" disabled selected></option>
                                                                    @foreach ($equipments as $e)
                                                                        <option value="{{ $e->id }}"
                                                                            {{ $item->equipment_id == $e->id || old('equipment_id') == $e->id ? 'selected' : '' }}>
                                                                            {{ $e->name }} (Stok:
                                                                            {{ $e->stock }})
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                                <input type="number"
                                                                    class="form-control text-primary-emphasis"
                                                                    name="quantity[]" placeholder="Jumlah"
                                                                    value="{{ $item->quantity ? $item->quantity : old('quantity') }}"
                                                                    min="1" required>
                                                                <button type="button"
                                                                    class="btn btn-danger
                                                                    remove-button"
                                                                    data-rental-id="{{ $r->id }}">Hapus</button>
                                                            </div>
                                                        @endforeach
                                                        @error('error')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Tanggal Mulai</label>
                                                        <input type="date" class="form-control text-primary-emphasis"
                                                            name="start_date"
                                                            value="{{ $r->start_date ? $r->start_date : old('start_date') }}">
                                                        @error('start_date')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Tanggal Akhir</label>
                                                        <input type="date" class="form-control text-primary-emphasis"
                                                            name="end_date"
                                                            value="{{ $r->end_date ? $r->end_date : old('end_date') }}">
                                                        @error('end_date')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger"
                                                    data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-success text-white">Submit</button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                {{-- Form Edit End --}}
                                <script>
                                    $('#add-button{{ $r->id }}').click(function() {
                                        var newItem = $('.equipment-item{{ $r->id }}').first().clone();
                                        newItem.find('select').val('').trigger('change');
                                        newItem.find('input').val('');
                                        $('#equipment-container{{ $r->id }}').append(newItem);
                                    });

                                    // Event listener for removing equipment item
                                    $(document).on('click', '.remove-button', function() {
                                        var rentalId = $(this).data('rental-id');
                                        var equipmentItem = $(this).closest('.equipment-item' + rentalId);
                                        if ($('.equipment-item' + rentalId).length > 1) {
                                            equipmentItem.remove();
                                        }
                                    });


                                    // Edit
                                    const selectUser{{ $r->id }} = $('#selectUser{{ $r->id }}');
                                    const inputName{{ $r->id }} = $('#inputName{{ $r->id }}');

                                    // Fungsi untuk menampilkan atau menyembunyikan elemen
                                    function toggleElements{{ $r->id }}() {
                                        if ($('#toggleCheckbox{{ $r->id }}').is(':checked')) {
                                            selectUser{{ $r->id }}.show();
                                            inputName{{ $r->id }}.hide();
                                        } else {
                                            selectUser{{ $r->id }}.hide();
                                            inputName{{ $r->id }}.show();
                                        }
                                    }

                                    // Jalankan fungsi saat halaman dimuat
                                    toggleElements{{ $r->id }}();

                                    // Tambahkan event listener pada checkbox
                                    $('#toggleCheckbox{{ $r->id }}').change(toggleElements{{ $r->id }});
                                </script>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function select2Enabler() {
            $(document).ready(function() {
                $('.select2add').select2({
                    dropdownParent: $('#formAdd'),
                    theme: 'bootstrap-5',
                    placeholder: 'Pilih salah satu'
                });
            });
        }

        $(document).ready(function() {
            // Event listener for adding new equipment item
            $('#add-button').click(function() {
                var newItem = $('.equipment-item').first().clone();
                newItem.find('select').val('').trigger('change');
                newItem.find('input').val('');
                $('#equipment-container').append(newItem);
            });

            $(document).on('click', '.remove-button-add', function() {
                if ($('.equipment-item').length > 1) {
                    $(this).closest('.equipment-item').remove();
                }
            });
            // Event listener for removing equipment item
            $(document).ready(function() {
                // Event listener for adding equipment item
                $('.add-button').click(function() {
                    var newItem = $('.equipment-item').first().clone();
                    newItem.find('select').val('').trigger('change');
                    newItem.find('input').val('');
                    $('#equipment-container').append(newItem);
                });

                // Event listener for removing equipment item
                $(document).on('click', '.remove-button', function() {
                    if ($('.equipment-item').length > 1) {
                        $(this).closest('.equipment-item').remove();
                    }
                });
            });

            // Modal show when error
            @if ($errors->any())
                @if (session('modal_id'))
                    var modalId = "{{ session('modal_id') }}";
                    $('#' + modalId).modal('show');
                @endif
            @endif

            // Checkbox Toggle
            const selectUser = $('#selectUser');
            const inputName = $('#inputName');

            // Fungsi untuk menampilkan atau menyembunyikan elemen
            function toggleElements() {
                if ($('#toggleCheckbox').is(':checked')) {
                    selectUser.show();
                    inputName.hide();
                } else {
                    selectUser.hide();
                    inputName.show();
                }
            }

            // Jalankan fungsi saat halaman dimuat
            toggleElements();

            // Tambahkan event listener pada checkbox
            $('#toggleCheckbox').change(toggleElements);

        });
    </script>
@endsection
