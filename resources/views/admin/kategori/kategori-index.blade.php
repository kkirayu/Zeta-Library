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
                        <h5 class="mb-0">List Kategori</h5>
                    </div>
                    <div class="font-22 ms-auto">
                        <div class="btn-group">
                            <button type="button" onclick="window.location.href='{{ route('kategori.create') }}'"
                                class="btn btn-primary">Tambah Kategori</button>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" width="100%">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Kategori</th>
                                <th>Deskripsi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kategori as $index => $kategori)
                                <tr>
                                    <td width="5%">{{ $index + 1 }}</td>
                                    <td width="35%">{{ $kategori->nama_kategori }}</td>
                                    <td width="50%">{{ $kategori->deskripsi }}</td>
                                    <td width="10%">
                                        <div class="d-flex order-actions">
                                            <a href="{{ route('kategori.edit', encrypt($kategori->id)) }}"
                                                class="ms-1 text-white" style="background: #0d6efd" data-toggle="tooltip"
                                                title="Edit"><i class="bx bx-edit"></i></a>
                                            <a href="{{ route('kategori.destroy', encrypt($kategori->id)) }}"
                                                class="ms-1 text-white" style="background: #0d6efd" data-toggle="tooltip"
                                                title="Delete"><i class="bx bx-trash"></i></a>
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
