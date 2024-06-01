@extends('dashboard.layout.main')

@section('container')
    <div class="container-fluid">
        <h3 class="mb-4 fw-bold" style="color: var(--navy)">Tabel Peralatan</h3>
        <div class="card shadow">
            <div class="card-header py-3">
                <p class="text-warning m-0 fw-bold">Equipments Info</p>
            </div>
            <div class="card-body">
                <!-- Form Add Start-->
                <div class="d-flex flex-row-reverse">
                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#formAdd"
                        onclick="select2Enabler('formAdd')">
                        Tambah Data
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="formAdd" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                        aria-labelledby="formAddLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5 fw-bold" style="color: var(--navy);" id="formAddLabel">
                                        Tambah Data Peralatan</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="/dashboard/equipments" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="mb-3">
                                            <label class="form-label">Nama Peralatan</label>
                                            <input type="text"
                                                class="form-control text-primary-emphasis  @error('name') is-invalid @enderror"
                                                name="name" value="{{ old('name') }}">
                                            @error('name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Harga per Hari</label>
                                            <input type="number" class="form-control text-primary-emphasis"
                                                name="price_per_day" min="0">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Deksripsi</label>
                                            <input type="text" class="form-control text-primary-emphasis"
                                                name="description">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Gambar</label>
                                            <img class="img-preview mb-3 col-sm-3 img-fluid" id="book-image-add-preview">
                                            <input type="file" class="form-control text-primary-emphasis" name="image"
                                                id="book-image-add"
                                                onchange="previewImage('book-image-add','book-image-add-preview')">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Stok</label>
                                            <input type="number" class="form-control text-primary-emphasis" name="stock"
                                                min="0">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Kategori</label>
                                            <select name="category_id" class="select form-control text-primary-emphasis"
                                                style="width: 100%">
                                                <option value="" disabled selected></option>
                                                @foreach ($categories as $c)
                                                    <option value="{{ $c->id }}">{{ $c->name }}</option>
                                                @endforeach
                                            </select>
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
                                <th>Nama Barang</th>
                                <th>Harga Sewa</th>
                                <th>Deskripsi</th>
                                <th>Kategori</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($equipments as $e)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $e->name }}</td>
                                    <td>{{ $e->price_per_day }}</td>
                                    <td>{{ $e->description }}</td>
                                    <td>
                                        @if ($e->category->name)
                                            {{ $e->category->name }}
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            {{-- View Detail Button --}}
                                            <button type="button" class="btn btn-lg btn-warning" data-bs-toggle="modal"
                                                data-bs-target="#detail{{ $e->id }}">
                                                <span data-bs-toggle="tooltip" data-bs-title="Lihat Detail">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                                        <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0" />
                                                        <path
                                                            d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7" />
                                                    </svg>
                                                </span>
                                            </button>
                                            {{-- View Detail Button End --}}

                                            {{-- Update Button --}}
                                            <button type="button" class="btn btn-lg btn-primary"
                                                data-bs-toggle="tooltip" data-bs-title="Edit Data">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                                    <path
                                                        d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z" />
                                                </svg>
                                                <path
                                                    d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z" />
                                                <path
                                                    d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0" />
                                                </svg>
                                            </button>
                                            {{-- Update Button End --}}

                                            {{-- Delete Button --}}
                                            <button type="button" class="btn btn-lg btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#delete{{ $e->id }}">
                                                <span data-bs-toggle="tooltip" data-bs-title="Hapus Data">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                        <path
                                                            d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0" />
                                                    </svg>
                                                </span>
                                            </button>
                                            {{-- Delete Button End --}}

                                        </div>
                                    </td>
                                </tr>
                                {{-- Modal Detail --}}
                                <div class="modal fade" id="detail{{ $e->id }}" data-bs-backdrop="static"
                                    data-bs-keyboard="false" tabindex="-1" aria-labelledby="detailLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5 fw-bold" style="color: var(--navy);"
                                                    id="detailLabel">Detail Data Peralatan</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="col-md-6">
                                                    <img class="mb-3 img-fluid"
                                                        @if ($e->image) src="{{ asset('storage/' . $e->image) }}"
                                                                @else
                                                                    src="{{ asset('img/default.png') }}" @endif>
                                                </div>
                                                <div class="mb-3">
                                                    <h5 class="fw-bold">{{ $e->name }}</h5>
                                                </div>
                                                <div class="mb-3">
                                                    <p>{{ $e->description }}</p>
                                                </div>
                                                <div class="row">
                                                    <div class="mb-3 col-6">
                                                        <label class="form-label fw-bold">Harga per Hari</label>
                                                        <h5>{{ number_format($e->price_per_day, 0, ',', '.') }}
                                                        </h5>
                                                    </div>
                                                    <div class="mb-3 col-6">
                                                        <label class="form-label fw-bold">Kategori</label>
                                                        <h5>{{ $e->category->name }}</h5>
                                                    </div>
                                                    <div class="mb-3 col-6">
                                                        <label class="form-label fw-bold">Stok</label>
                                                        <h5>{{ $e->stock }}</h5>
                                                    </div>
                                                    <div class="mb-3 col-6">
                                                        <label class="form-label fw-bold">Sedang Disewa</label>
                                                        <h5>{{ $e->on_rent }}</h5>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Tutup</button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                {{-- Modal Detail End --}}

                                {{-- Modal Delete --}}
                                <div class="modal fade" id="delete{{ $e->id }}" data-bs-backdrop="static"
                                    data-bs-keyboard="false" tabindex="-1" aria-labelledby="detailLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5 fw-bold" style="color: var(--navy);"
                                                    id="deleteLabel">Hapus Data Peralatan</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body text-center">
                                                <img src="{{ asset('img/deleteConfirm.png') }}" class="w-75 img-fluid">
                                                <h3 class="fw-bold" style="color: var(--navy)">Anda yakin untuk menghapus
                                                    data ini?</h3>
                                            </div>
                                            <div class="modal-footer">
                                                <form action="/dashboard/equipments/{{ $e->id }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                                </form>
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Batal</button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                {{-- Modal Delete End --}}
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td>
                                    <strong>
                                        No
                                    </strong>
                                </td>
                                <td>
                                    <strong>
                                        Nama Barang
                                    </strong>
                                </td>
                                <td>
                                    <strong>
                                        Harga Sewa
                                    </strong>
                                </td>
                                <td>
                                    <strong>
                                        Deskripsi
                                    </strong>
                                </td>
                                <td>
                                    <strong>
                                        Kategori
                                    </strong>
                                </td>
                                <td>
                                    <strong>
                                        Action
                                    </strong>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            @if ($errors->any())
                @if (session('modal_id'))
                    var modalId = "{{ session('modal_id') }}";
                    $('#' + modalId).modal('show');
                @endif
            @endif
        });
    </script>
@endsection
