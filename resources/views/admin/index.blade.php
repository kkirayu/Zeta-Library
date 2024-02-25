@extends('admin.admin-dashboard')

@section('content')
    <div class="page-content">

        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">

            <div class="col">
                @php
                    $totalBuku = App\Models\Buku::count();
                @endphp

                <div class="card radius-10 bg-gradient-orange">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <h5 class="mb-0 text-white">{{ $totalBuku }}</h5>
                            <div class="ms-auto">
                                <i class='bx bx-barcode fs-3 text-white'></i>
                            </div>
                        </div>
                        <div class="progress my-3 bg-light-transparent" style="height:3px;">
                            <div class="progress-bar bg-white" role="progressbar" style="width: {{ $totalBuku }}%"
                                aria-valuenow="{{ $totalBuku }}" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="d-flex align-items-center text-white">
                            <p class="mb-0">Total Buku</p>
                        </div>
                    </div>
                </div>
            </div>

            @php
                $user = Auth::user();
                $totalBukuDipinjam = App\Models\Peminjaman::where('user_id', $user->id)->count();
            @endphp

            <div class="col">
                <div class="card radius-10 bg-gradient-ohhappiness">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <h5 class="mb-0 text-white">{{ $totalBukuDipinjam }}</h5>
                            <div class="ms-auto">
                                <i class='bx bx-barcode fs-3 text-white'></i>
                            </div>
                        </div>
                        <div class="progress my-3 bg-light-transparent" style="height:3px;">
                            <div class="progress-bar bg-white" role="progressbar" style="width: {{ $totalBukuDipinjam }}%"
                                aria-valuenow="{{ $totalBukuDipinjam }}" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="d-flex align-items-center text-white">
                            <p class="mb-0">Total Buku yang Dipinjam oleh {{ $user->name }}</p>
                        </div>
                    </div>
                </div>
            </div>

            @php
                $totalBukuTidakTersedia = App\Models\Buku::where('stok', 0)->count();
            @endphp

            <div class="col">
                <div class="card radius-10 bg-gradient-orange">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <h5 class="mb-0 text-white">{{ $totalBukuTidakTersedia }}</h5>
                            <div class="ms-auto">
                                <i class='bx bx-barcode fs-3 text-white'></i>
                            </div>
                        </div>
                        <div class="progress my-3 bg-light-transparent" style="height:3px;">
                            <div class="progress-bar bg-white" role="progressbar"
                                style="width: {{ $totalBukuTidakTersedia }}%" aria-valuenow="{{ $totalBukuTidakTersedia }}"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="d-flex align-items-center text-white">
                            <p class="mb-0">Buku yang Tidak Tersedia</p>
                        </div>
                    </div>
                </div>
            </div>


{{-- 
            @php
                $totalBukuTidakDipinjam = App\Models\Buku::whereDoesntHave('peminjamans', function ($query) {
                    $query->where('status', 'Dipinjam')->orWhere('status', 'Booked')->orWhere('status', 'Proses Pengembalian');
                })
                    ->orWhereHas('peminjamans', function ($query) {
                        $query->where('status', 'Ready');
                    })
                    ->count();
            @endphp


            <div class="col">
                <div class="card radius-10 bg-gradient-orange">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <h5 class="mb-0 text-white">{{ $totalBukuTidakDipinjam }}</h5>
                            <div class="ms-auto">
                                <i class='bx bx-barcode fs-3 text-white'></i>
                            </div>
                        </div>
                        <div class="progress my-3 bg-light-transparent" style="height:3px;">
                            <div class="progress-bar bg-white" role="progressbar"
                                style="width: {{ $totalBukuTidakDipinjam }}%"
                                aria-valuenow="{{ $totalBukuTidakDipinjam }}" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="d-flex align-items-center text-white">
                            <p class="mb-0">Buku Tersedia</p>
                        </div>
                    </div>
                </div>
            </div> --}}

            @php
                $totalBukuTersedia = App\Models\Buku::where('stok', '>', 0)->count();
            @endphp

            <div class="col">
                <div class="card radius-10 bg-gradient-orange">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <h5 class="mb-0 text-white">{{ $totalBukuTersedia }}</h5>
                            <div class="ms-auto">
                                <i class='bx bx-barcode fs-3 text-white'></i>
                            </div>
                        </div>
                        <div class="progress my-3 bg-light-transparent" style="height:3px;">
                            <div class="progress-bar bg-white" role="progressbar" style="width: {{ $totalBukuTersedia }}%"
                                aria-valuenow="{{ $totalBukuTersedia }}" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="d-flex align-items-center text-white">
                            <p class="mb-0">Buku yang Tersedia</p>
                        </div>
                    </div>
                </div>
            </div>


        </div><!--end row-->

        <div class="">
            @if (Auth::user()->role == 'user')
                <div class="">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <h5 class="mb-0">List Buku Zeta Library</h5>
                            </div>
                            <div class="font-22 ms-auto">
                            </div>
                        </div>
                        <hr>
                        <div class="table-responsive">
                            <table id="example" class="table table-striped table-bordered" width="100%">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Cover</th>
                                        <th>Judul</th>
                                        <th>Penulis</th>
                                        <th>Penerbit</th>
                                        <th>Tahun Terbit</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($buku as $index => $buku)
                                    <tr>
                                        <td width="5%">{{ $index + 1 }}</td> 
                                        <td width="20%">
                                            <div class="d-flex align-items-center">
                                                <div class="recent-product-img">
                                                    <img src="{{ asset($buku->photo) }}" alt="">
                                                </div>
                                            </div>
                                        </td>                                        
                                        <td width="35%">{{ $buku->judul }}</td>
                                        <td width="50%">{{ $buku->penulis }}</td>
                                        <td width="50%">{{ $buku->penerbit }}</td>
                                        <td width="50%">{{ $buku->tahun_terbit }}</td>
                                        <td width="2%">
                                            @if ($buku->stok == 0)
                                                <span class="badge bg-danger text-white">Tidak Tersedia</span>
                                            @elseif ($buku->stok > 0)
                                                <span class="badge bg-success text-white">Tersedia</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif
        </div>

    </div>
@endsection
