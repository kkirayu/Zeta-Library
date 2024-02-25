@extends('admin.admin-dashboard')

@section('content')
    <div class="page-content">
        <!--breadcrumb-->
        <x-breadcrumb sub="Buku" icon="bx bx-dna" subsub="{{ isset($edit) ? 'Edit' : 'Tambah' }}" />

        <!--end breadcrumb-->
        <div class="container">
            <div class="main-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Form {{ isset($edit) ? 'Edit' : 'Tambah' }} User</h4>
                            </div>
                            <div class="card-body">
                                <form id="myForm" action="{{ isset($edit) ? route('user.update', $edit->id) : route('user.store') }}" method="POST">
                                    @csrf
                                    @if (isset($edit))
                                        @method('PATCH')
                                        <input type="hidden" value="{{ $edit->id }}" name="id" />
                                    @endif
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Nama User</h6>
                                        </div>
                                        <div class="form-group col-sm-9 text-secondary">
                                            <input type="text" name="name" class="form-control" value="{{ old('name', isset($edit) ? $edit->name : '') }}" placeholder="Nama User"/>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Email</h6>
                                        </div>
                                        <div class="form-group col-sm-9 text-secondary">
                                            <input type="email" name="email" class="form-control" value="{{ old('email', isset($edit) ? $edit->email : '') }}" placeholder="Email"/>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Password</h6>
                                        </div>
                                        <div class="form-group col-sm-9 text-secondary">
                                            <input type="password" name="password" class="form-control" value="{{ old('password', isset($edit) ? $edit->password : '') }}" placeholder="Password"/>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Role</h6>
                                        </div>
                                        <div class="form-group col-sm-9 text-secondary">
                                            <select name="role" class="form-control">
                                                <option value="admin" {{ old('role', isset($edit) ? $edit->role : '') == 'admin' ? 'selected' : '' }}>Admin</option>
                                                <option value="petugas" {{ old('role', isset($edit) ? $edit->role : '') == 'petugas' ? 'selected' : '' }}>Petugas</option>
                                                <option value="user" {{ old('role', isset($edit) ? $edit->role : '') == 'user' ? 'selected' : '' }}>User</option>
                                            </select>
                                        </div>
                                    </div>                                    
                                    <div class="row">
                                        <div class="col-sm-3"></div>
                                        <div class="col-sm-9 text-secondary" style="text-align: right;">
                                            <input type="submit" class="btn btn-success px-4" value="{{ isset($edit) ? 'Ubah User' : 'Tambah User' }}" />
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
        $(document).ready(function(){
            $('#myForm').validate({
                rules: {
                    nama_jurusan: {
                        required : true,
                    },
                    kode_jurusan: {
                        required : true,
                    },
                    deskripsi: {
                        required : true,
                    },
                },
                messages: {
                    nama_jurusan: {
                        required : 'Masukkan Nama Jurusan',
                    },
                    kode_jurusan: {
                        required : 'Masukkan Kode Jurusan',
                    },
                    deskripsi: {
                        required : 'Masukkan Deskripsi Jurusan',
                    },
                },
                errorElement: 'span',
                errorPlacement: function(error,element){
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass){
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass){
                    $(element).removeClass('is-invalid');
                },
            });
        });
    </script>
@endsection
