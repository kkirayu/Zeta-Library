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
                                <h4>Form {{ isset($edit) ? 'Edit' : 'Tambah' }} Buku</h4>
                            </div>
                            <div class="card-body">
                                <form id="myForm" action="{{ isset($edit) ? route('buku.update', $edit->id) : route('buku.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @if (isset($edit))
                                        @method('PATCH')
                                        <input type="hidden" value="{{ $edit->id }}" name="id" />
                                        <input type="hidden" value="{{ $edit->photo }}" name="photoLama" />
                                    @endif
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Judul Buku</h6>
                                        </div>
                                        <div class="form-group col-sm-9 text-secondary">
                                            <input type="text" name="judul" class="form-control" value="{{ old('judul', isset($edit) ? $edit->judul : '') }}" placeholder="Judul Buku"/>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Penulis</h6>
                                        </div>
                                        <div class="form-group col-sm-9 text-secondary">
                                            <input type="text" name="penulis" class="form-control" value="{{ old('penulis', isset($edit) ? $edit->penulis : '') }}" placeholder="Penulis"/>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Penerbit</h6>
                                        </div>
                                        <div class="form-group col-sm-9 text-secondary">
                                            <input type="text" name="penerbit" class="form-control" value="{{ old('penerbit', isset($edit) ? $edit->penerbit : '') }}" placeholder="penerbit"/>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Kategori Buku</h6>
                                        </div>
                                        <div class="form-group col-sm-9 text-secondary">
                                            <select name="kategori" class="form-control">
                                                <option value="">Pilih Kategori</option>
                                                @foreach($kategoriBuku as $kategori)
                                                    <option value="{{ $kategori->id }}" {{ old('id', isset($edit) ? $edit->id : '') == $kategori->id ? 'selected' : '' }}>
                                                        {{ $kategori->nama_kategori }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>                                    
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Tahun Terbit</h6>
                                        </div>
                                        <div class="form-group col-sm-9 text-secondary">
                                            <input type="date" name="tahun_terbit" class="form-control" value="{{ old('tahun_terbit', isset($edit) ? $edit->tahun_terbit : '') }}" placeholder="Tahun Terbit"/>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Photo<i style="color: red">*</i></h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="file" name="{{ isset($edit) ? 'photos' : 'photo' }}"
                                                class="form-control" id="photo1" />
                                            <small class="text-muted">Accepted formats: PNG, JPG, JPEG.</small>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Stok</h6>
                                        </div>
                                        <div class="form-group col-sm-9 text-secondary">
                                            <input type="number" name="stok" class="form-control" value="{{ old('stok', isset($edit) ? $edit->stok : '') }}" placeholder="Stok"/>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-3"></div>
                                        <div class="col-sm-9 text-secondary" style="text-align: right;">
                                            <input type="submit" class="btn btn-success px-4" value="{{ isset($edit) ? 'Ubah Buku' : 'Tambah Buku' }}" />
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
