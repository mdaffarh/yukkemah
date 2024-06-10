@extends('dashboard.layout.main')

@section('title', 'Pelanggan')
@section('container')
    <div class="container-fluid">
        <h3 class="mb-4 fw-bold" style="color: var(--navy)">Tabel Pelanggan</h3>
        <div class="card shadow">
            <div class="card-header py-3">
                <p class="text-warning m-0 fw-bold">Customers Info</p>
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
                                        Tambah Data Pelanggan</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="/dashboard/users" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="mb-3">
                                            <label class="form-label">Username</label>
                                            <input type="text"
                                                class="form-control text-primary-emphasis  @error('username') is-invalid @enderror"
                                                name="username" value="{{ old('username') }}">
                                            @error('username')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Password</label>
                                            <input type="text"
                                                class="form-control text-primary-emphasis  @error('password') is-invalid @enderror"
                                                name="password" value="{{ old('password') }}">
                                            @error('password')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Nama Pelanggan</label>
                                            <input type="text"
                                                class="form-control text-primary-emphasis  @error('name') is-invalid @enderror"
                                                name="name" value="{{ old('name') }}">
                                            @error('name')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Jenis Kelamin</label>
                                            <div class="form-check">
                                                <input class="form-check-input @error('gender') is-invalid @enderror"
                                                    type="radio" name="gender" value="Laki-laki"
                                                    {{ old('gender') == 'Laki-laki' ? 'checked' : '' }}>
                                                <label class="fw-normal">
                                                    Laki-laki
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input @error('gender') is-invalid @enderror"
                                                    type="radio" name="gender" value="Perempuan"
                                                    {{ old('gender') == 'Perempuan' ? 'checked' : '' }}>
                                                <label class="fw-normal">
                                                    Perempuan
                                                </label>
                                            </div>
                                            @error('gender')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Email</label>
                                            <input type="email"
                                                class="form-control text-primary-emphasis  @error('email') is-invalid @enderror"
                                                name="email" value="{{ old('email') }}">
                                            @error('email')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Alamat</label>
                                            <textarea name="address" class="form-control" cols="50" @error('address') is-invalid @enderror>{{ old('address') }}</textarea>
                                            @error('address')
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
                                <th>Nama Pelanggan</th>
                                <th>Jenis Kelamin</th>
                                <th>Email</th>
                                <th>Alamat</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $u)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $u->name }}</td>
                                    <td>{{ $u->gender }}</td>
                                    <td>{{ $u->email }}</td>
                                    <td>{{ $u->address }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            {{-- View Detail Button End --}}
                                            {{-- View Detail Button --}}
                                            <button type="button" class="btn btn-lg btn-warning" data-bs-toggle="modal"
                                                data-bs-target="#detail{{ $u->id }}">
                                                <span data-bs-toggle="tooltip" data-bs-title="Lihat User">
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
                                            <button type="button" class="btn btn-lg btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#edit{{ $u->id }}">
                                                <span data-bs-toggle="tooltip" data-bs-title="Edit Data">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-pencil-fill"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z" />
                                                    </svg>
                                                </span>
                                            </button>
                                            {{-- Update Button End --}}

                                            {{-- Delete Button --}}
                                            <button type="button" class="btn btn-lg btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#delete{{ $u->id }}">
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
                                {{-- Modal Detail User --}}
                                <div class="modal fade" id="detail{{ $u->id }}" data-bs-backdrop="static"
                                    data-bs-keyboard="false" tabindex="-1" aria-labelledby="detailLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5 fw-bold" style="color: var(--navy);"
                                                    id="detailLabel">Data User Pelanggan</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="mb-3">
                                                        <label class="form-label fw-bold">Username</label>
                                                        <h5>{{ $u->username }}
                                                        </h5>
                                                    </div>
                                                    {{-- <div class="mb-3">
                                                        <label class="form-label fw-bold">Password</label>
                                                        <h5>{{ $u->password }}
                                                        </h5>
                                                    </div> --}}
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

                                {{-- Modal Delete --}}
                                <div class="modal fade" id="delete{{ $u->id }}" data-bs-backdrop="static"
                                    data-bs-keyboard="false" tabindex="-1" aria-labelledby="detailLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5 fw-bold" style="color: var(--navy);"
                                                    id="deleteLabel">Hapus Data Pelanggan</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body text-center">
                                                <img src="{{ asset('img/deleteConfirm.png') }}" class="w-75 img-fluid">
                                                <h3 class="fw-bold" style="color: var(--navy)">Anda yakin untuk menghapus
                                                    data ini?</h3>
                                            </div>
                                            <div class="modal-footer">
                                                <form action="/dashboard/users/{{ $u->id }}" method="POST">
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

                                <!-- Modal Edit Start-->
                                <div class="modal fade" id="edit{{ $u->id }}" data-bs-backdrop="static"
                                    data-bs-keyboard="false" tabindex="-1" aria-labelledby="editLable"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5 fw-bold" style="color: var(--navy);"
                                                    id="editLable">
                                                    Edit Data Pelanggan</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="/dashboard/users/{{ $u->id }}" method="POST"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    @method('put')
                                                    <div class="mb-3">
                                                        <label class="form-label">Username</label>
                                                        <input type="text"
                                                            class="form-control text-primary-emphasis  @error('username') is-invalid @enderror"
                                                            name="username"
                                                            value="{{ $u->username ? $u->username : old('username') }}">
                                                        @error('username')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Password</label>
                                                        <input type="text"
                                                            class="form-control text-primary-emphasis  @error('password') is-invalid @enderror"
                                                            name="password"
                                                            value="{{ $u->password ? $u->password : old('password') }}">
                                                        @error('password')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Nama Pelanggan</label>
                                                        <input type="text"
                                                            class="form-control text-primary-emphasis  @error('name') is-invalid @enderror"
                                                            name="name"
                                                            value="{{ $u->name ? $u->name : old('name') }}">
                                                        @error('name')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Jenis Kelamin</label>
                                                        <div class="form-check">
                                                            <input
                                                                class="form-check-input @error('gender') is-invalid @enderror"
                                                                type="radio" name="gender" value="Laki-laki"
                                                                {{ ($u->gender ? $u->gender : old('gender')) == 'Laki-laki' ? 'checked' : '' }}>
                                                            <label class="fw-normal">
                                                                Laki-laki
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input
                                                                class="form-check-input @error('gender') is-invalid @enderror"
                                                                type="radio" name="gender" value="Perempuan"
                                                                {{ ($u->gender ? $u->gender : old('gender')) == 'Perempuan' ? 'checked' : '' }}>
                                                            <label class="fw-normal">
                                                                Perempuan
                                                            </label>
                                                        </div>
                                                        @error('gender')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Email</label>
                                                        <input type="email"
                                                            class="form-control text-primary-emphasis  @error('email') is-invalid @enderror"
                                                            name="email"
                                                            value="{{ $u->email ? $u->email : old('email') }}">
                                                        @error('email')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Alamat</label>
                                                        <textarea name='address' class="form-control" cols="50" @error('address') is-invalid @enderror>{{ $u->address ? $u->address : old('address') }}</textarea>
                                                        @error('address')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
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
                                {{-- Modal Edit End --}}
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
                                        Nama Pelanggan
                                    </strong>
                                </td>
                                <td>
                                    <strong>
                                        Jenis Kelamin
                                    </strong>
                                </td>
                                <td>
                                    <strong>
                                        Email
                                    </strong>
                                </td>
                                <td>
                                    <strong>
                                        Alamat
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
