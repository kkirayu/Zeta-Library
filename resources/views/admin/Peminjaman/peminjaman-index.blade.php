@extends('admin.admin-dashboard')

@section('content')
    <div class="page-content">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
            integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
        </script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
        </script>
        </body>

        </html>

        <div class="page-content">
            <!--breadcrumb-->


            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <h5 class="mb-0">Data Peminjaman</h5>
                        </div>
                        <div class="font-22 ms-auto">
                            <div class="btn-group">
                                <button type="button" onclick="window.location.href='{{ route('peminjaman.create') }}'"
                                    class="btn btn-primary">Tambah Data Pinjaman</button>
                            </div>
                            <div class="btn-group">
                                <button type="button" onclick="window.location.href='{{ route('export.pinjaman') }}'"
                                    class="btn btn-primary">Export Excel</button>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered" width="100%">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Peminjam</th>
                                    <th>Buku</th>
                                    <th>Tanggal Pinjaman</th>
                                    <th>Tanggal Dikembalikan</th>
                                    <th>Tanggal Pengembalian</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($peminjaman as $index => $peminjaman)
                                    <tr>
                                        <td width="5%">{{ $index + 1 }}</td>
                                        <td width="20%">{{ $peminjaman->user->name }}</td>
                                        <td width="20%">{{ $peminjaman->buku->judul }}</td>
                                        <td width="20%">{{ $peminjaman->tanggal_pinjaman }}</td>
                                        <td width="10%">{{ $peminjaman->tanggal_dikembalikan }}</td>
                                        <td width="10%">{{ $peminjaman->tanggal_pengembalian }}</td>
                                        @if (Auth::user()->role == 'admin' || Auth::user()->role == 'petugas')
                                        <td width="20%"> <!-- Adjusted width for status column -->
                                            <form action="{{ route('update.status', $peminjaman->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <select name="status"
                                                    class="form-control
                                                    {{ $peminjaman->status == 'Ready' ? 'bg-primary' : '' }}
                                                    {{ $peminjaman->status == 'Booked' ? 'bg-warning' : '' }}
                                                    {{ $peminjaman->status == 'Dipinjam' ? 'bg-danger' : '' }}
                                                    {{ $peminjaman->status == 'Proses Pengembalian' ? 'bg-info' : '' }}
                                                    {{ $peminjaman->status == 'Sudah Dikembalikan' ? 'bg-success' : '' }}"
                                                    onchange="this.form.submit()">
                                                    <option value="Ready"
                                                        class="{{ $peminjaman->status == 'Ready' ? 'bg-primary' : '' }}"
                                                        {{ $peminjaman->status == 'Ready' ? 'selected' : '' }}>Ready
                                                    </option>
                                                    <option value="Booked"
                                                        class="{{ $peminjaman->status == 'Booked' ? 'bg-warning' : '' }}"
                                                        {{ $peminjaman->status == 'Booked' ? 'selected' : '' }}>Booked
                                                    </option>
                                                    <option value="Dipinjam"
                                                        class="{{ $peminjaman->status == 'Dipinjam' ? 'bg-warning' : '' }}"
                                                        {{ $peminjaman->status == 'Dipinjam' ? 'selected' : '' }}>Dipinjam
                                                    </option>
                                                    <option value="Proses Pengembalian"
                                                        class="{{ $peminjaman->status == 'Proses Pengembalian' ? 'bg-info' : '' }}"
                                                        {{ $peminjaman->status == 'Proses Pengembalian' ? 'selected' : '' }}>
                                                        Proses Pengembalian</option>
                                                    <option value="Sudah Dikembalikan"
                                                        class="{{ $peminjaman->status == 'Sudah Dikembalikan' ? 'bg-success' : '' }}"
                                                        {{ $peminjaman->status == 'Sudah Dikembalikan' ? 'selected' : '' }}>
                                                        Sudah Dikembalikan</option>
                                                </select>
                                            </form>
                                        </td>
                                        @endif
                                        @if (Auth::user()->role == 'user')
                                        <td width="20%"> 
                                            <form action="{{ route('update.status', $peminjaman->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <select name="status"
                                                    class="form-control
                                                    {{ $peminjaman->status == 'Ready' ? 'bg-primary' : '' }}
                                                    {{ $peminjaman->status == 'Booked' ? 'bg-warning' : '' }}
                                                    {{ $peminjaman->status == 'Dipinjam' ? 'bg-danger' : '' }}
                                                    {{ $peminjaman->status == 'Proses Pengembalian' ? 'bg-info' : '' }}
                                                    {{ $peminjaman->status == 'Sudah Dikembalikan' ? 'bg-success' : '' }}"
                                                    onchange="this.form.submit()" disabled>
                                                    <option value="Ready"
                                                        class="{{ $peminjaman->status == 'Ready' ? 'bg-primary' : '' }}"
                                                        {{ $peminjaman->status == 'Ready' ? 'selected' : '' }}>Ready
                                                    </option>
                                                    <option value="Booked"
                                                        class="{{ $peminjaman->status == 'Booked' ? 'bg-warning' : '' }}"
                                                        {{ $peminjaman->status == 'Booked' ? 'selected' : '' }}>Booked
                                                    </option>
                                                    <option value="Dipinjam"
                                                        class="{{ $peminjaman->status == 'Dipinjam' ? 'bg-warning' : '' }}"
                                                        {{ $peminjaman->status == 'Dipinjam' ? 'selected' : '' }}>Dipinjam
                                                    </option>
                                                    <option value="Proses Pengembalian"
                                                        class="{{ $peminjaman->status == 'Proses Pengembalian' ? 'bg-info' : '' }}"
                                                        {{ $peminjaman->status == 'Proses Pengembalian' ? 'selected' : '' }}>
                                                        Proses Pengembalian</option>
                                                    <option value="Sudah Dikembalikan"
                                                        class="{{ $peminjaman->status == 'Sudah Dikembalikan' ? 'bg-success' : '' }}"
                                                        {{ $peminjaman->status == 'Sudah Dikembalikan' ? 'selected' : '' }}>
                                                        Sudah Dikembalikan</option>
                                                </select>
                                            </form>
                                        </td>
                                        @endif
                                        <td width="10%">
                                            <div class="d-flex order-actions">
                                                <a href="{{ route('peminjaman.edit', encrypt($peminjaman->id)) }}"
                                                    class="ms-1 text-white" style="background: #0d6efd"
                                                    data-toggle="tooltip" title="Edit"><i class="bx bx-edit"></i></a>
                                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'petugas')
                                                    <a href="{{ route('peminjaman.destroy', encrypt($peminjaman->id)) }}"
                                                        class="ms-1 text-white" style="background: #0d6efd"
                                                        data-toggle="tooltip" title="Delete"><i class="bx bx-trash"></i></a>
                                                @endif
                                            </div>
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
