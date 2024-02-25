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
                            <h5 class="mb-0">List User</h5>
                        </div>
                        <div class="font-22 ms-auto">
                            <div class="btn-group">
                                <button type="button" onclick="window.location.href='{{ route('user.create') }}'"
                                    class="btn btn-primary">Tambah User</button>
                            </div>
                            <div class="btn-group">

                                <button type="button" class="btn btn-success" data-toggle="modal"
                                    data-target="#importModal">Import Excel</button>

                                <!-- Modal -->
                                <div class="modal fade" id="importModal" tabindex="-1" role="dialog"
                                    aria-labelledby="importModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="importModalLabel">Import Excel</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered" width="100%">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($user as $index => $user)
                                    <tr>
                                        <td width="5%">{{ $index + 1 }}</td>
                                        <td width="35%">{{ $user->name }}</td>
                                        <td width="50%">{{ $user->email }}</td>
                                        <td width="50%">{{ $user->role }}</td>
                                        <td width="10%">
                                            <div class="d-flex order-actions">
                                                <a href="{{ route('user.show', encrypt($user->id)) }}"
                                                    class="ms-1 text-white" style="background: #0d6efd"
                                                    data-toggle="tooltip" title="Detail"><i
                                                        class="bx bx-info-circle"></i></a>
                                                @if (Auth::user()->role == 'admin')
                                                    <a href="{{ route('user.edit', encrypt($user->id)) }}"
                                                        class="ms-1 text-white" style="background: #0d6efd"
                                                        data-toggle="tooltip" title="Edit"><i class="bx bx-edit"></i></a>
                                                    <a href="{{ route('user.destroy', encrypt($user->id)) }}"
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
