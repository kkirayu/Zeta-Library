@extends('admin.admin-dashboard')

@section('content')
    <div class="page-content">
        <x-breadcrumb sub="Produk" icon="bx bx-barcode" subsub="Detail" />

        <div class="card radius-10">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <h5 class="mb-0">Detail User</h5>
                    </div>
                </div>
                <hr>


                <div class="row g-0">
                    <div class="col-md-8">
                        <div class="card-body">
                            <h4 class="card-title">{{ $show->name }}</h4>
                            <p class="card-text fs-6 mb-0"><b>Email</b></p>
                            <p class="card-text fs-6">{{ $show->email }}</p>
                            <dl class="row">
                                <dt class="col-sm-3">Role</dt>
                                <p class="">{{ $show->role }}</p>
                                
                                <dt class="col-sm-3">Buku yang Dipinjam</dt>
                                @if ($peminjamans->isNotEmpty())
                                    <ul>
                                        @foreach ($peminjamans as $peminjaman)
                                            <li>{{ $peminjaman->buku->judul }}</li>
                                        @endforeach
                                    </ul>
                                @else
                                    <p>Pengguna ini belum meminjam buku.</p>
                                @endif

                            </dl>
                        </div>
                    </div>
                </div>
                <hr />
            </div>
        </div>
    </div>
@endsection
