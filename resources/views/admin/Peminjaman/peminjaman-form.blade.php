@extends('admin.admin-dashboard')

@section('content')
    <div class="page-content">
        <!--breadcrumb-->
        <x-breadcrumb sub="Peminjaman" icon="bx bx-dna" subsub="{{ isset($edit) ? 'Edit' : 'Tambah' }}" />

        <!--end breadcrumb-->
        <div class="container">
            <div class="main-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Form {{ isset($edit) ? 'Edit' : 'Tambah' }} Peminjaman</h4>
                            </div>
                            <div class="card-body">
                                <form id="myForm"
                                    action="{{ isset($edit) ? route('peminjaman.update', $edit->id) : route('peminjaman.store') }}"
                                    method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @if (isset($edit))
                                        @method('PATCH')
                                        <input type="hidden" value="{{ $edit->id }}" name="id" />
                                    @endif
                                    @if (Auth::user()->role == 'admin' || Auth::user()->role == 'petugas')
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Nama Peminjam</h6>
                                            </div>
                                            <div class="form-group col-sm-9 text-secondary">
                                                <select name="user_id" class="form-control">
                                                    <option value="">Pilih Nama Peminjam</option>
                                                    @foreach ($users as $user)
                                                        <option value="{{ $user->id }}"
                                                            {{ old('user_id', isset($edit) ? $edit->user_id : '') == $user->id ? 'selected' : '' }}>
                                                            {{ $user->name }}
                                                        </option>
                                                    @endforeach

                                                </select>
                                            </div>
                                        </div>
                                    @endif
                                    @if (Auth::check() && Auth::user()->role == 'user')
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Nama Peminjam</h6>
                                            </div>
                                            <div class="form-group col-sm-9 text-secondary">
                                                <select name="user_id" class="form-control" readonly>
                                                    <option value="{{ Auth::id() }}" selected>{{ Auth::user()->name }}
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Nama Buku</h6>
                                        </div>
                                        <div class="form-group col-sm-9 text-secondary">
                                            <select name="buku_id" class="form-control">
                                                <option value="">Pilih Nama Buku</option>
                                                @foreach ($buku as $b)
                                                    @if ($b->stok > 0)
                                                        <option value="{{ $b->id }}"
                                                            {{ $b->id == old('buku_id', isset($edit) ? $edit->buku_id : '') ? 'selected' : '' }}>
                                                            {{ $b->judul }}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Tanggal Peminjaman</h6>
                                        </div>
                                        <div class="form-group col-sm-9 text-secondary">
                                            <input type="date" name="tanggal_pinjaman" class="form-control"
                                                value="{{ old('tanggal_pinjaman', isset($edit) ? $edit->tanggal_pinjaman : '') }}"
                                                placeholder="Tanggal Peminjaman" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Tanggal Pengembalian</h6>
                                        </div>
                                        <div class="form-group col-sm-9 text-secondary">
                                            <input type="date" name="tanggal_pengembalian" class="form-control"
                                                value="{{ old('tanggal_pengembalian', isset($edit) ? $edit->tanggal_pengembalian : '') }}"
                                                placeholder="Tanggal Pengembalian" />
                                        </div>
                                    </div>
                                    @if (Auth::user()->role == 'admin' || Auth::user()->role == 'petugas')
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Status Buku</h6>
                                            </div>
                                            <div class="form-group col-sm-9 text-secondary">
                                                <select name="status" class="form-control">
                                                    <option value="">Pilih Status Buku</option>
                                                    @foreach (['Ready', 'Booked', 'Dipinjam', 'Proses Pengembalian', 'Sudah Dikembalikan'] as $status)
                                                        <option value="{{ $status }}"
                                                            {{ old('status', isset($edit) ? $edit->status : '') == $status ? 'selected' : '' }}>
                                                            {{ $status }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    @endif
                                    @if (Auth::user()->role == 'user')
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Status Buku</h6>
                                            </div>
                                            <div class="form-group col-sm-9 text-secondary">
                                                <select name="status" class="form-control">
                                                    <option value="Booked" selected>Booked</option>
                                                    <option value="Dipinjam" selected>Dipinjam</option>
                                                    <option value="Proses Pengembalian" selected>Dikembalikan</option>
                                                </select>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="row">
                                        <div class="col-sm-3"></div>
                                        <div class="col-sm-9 text-secondary" style="text-align: right;">
                                            <input type="submit" class="btn btn-success px-4"
                                                value="{{ isset($edit) ? 'Ubah Peminjaman' : 'Tambah Peminjaman' }}" />
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#myForm').validate({
                rules: {
                    nama_jurusan: {
                        required: true,
                    },
                    kode_jurusan: {
                        required: true,
                    },
                    deskripsi: {
                        required: true,
                    },
                },
                messages: {
                    nama_jurusan: {
                        required: 'Masukkan Nama Jurusan',
                    },
                    kode_jurusan: {
                        required: 'Masukkan Kode Jurusan',
                    },
                    deskripsi: {
                        required: 'Masukkan Deskripsi Jurusan',
                    },
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                },
            });
        });
    </script>
@endsection
