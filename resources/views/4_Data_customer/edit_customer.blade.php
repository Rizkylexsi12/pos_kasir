@extends('Layout.layout')

@section('judul')
    | Edit Customer
@endsection

@section('nama_menu')
<section class="content-header">
    <div class="container-fluid">
    <div class="row mb-0 mt-0">
        <div class="col-sm-15 row mb-0 mt-0">
            <h3 class="row mb-0 mt-0">Edit Customer</h3>
        </div>
    </div>
    </div>
</section>
@endsection

@section('content')
<form action="/data_customer/update/{{ $customer-> id }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="content">
        <div  class="row">
            <div class="col-6">
                <div class="form-group">
                    <label>Nama Customer</label>
                    <input type="text" name="nama_customer" class="form-control" value="{{ $customer-> nama_customer }}">
                    <div class="text-danger">
                        @error('nama_customer')
                            {{  $message }}
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label>Nama Anak</label>
                    <input type="text" name="nama_anak" class="form-control" value="{{ $customer-> nama_anak }}">
                    <div class="text-danger">
                        @error('nama_anak')
                            {{  $message }}
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label>Alamat</label>
                    <input type="text" name="alamat" class="form-control" value="{{ $customer-> alamat }}">
                    <div class="text-danger">
                        @error('alamat')
                            {{  $message }}
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label>No. Telp</label>
                    <input type="text" name="no_telp" class="form-control" value="{{ $customer-> no_telp }}">
                    <div class="text-danger">
                        @error('no_telp')
                            {{  $message }}
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <button class="btn btn-success btn-sm">Simpan</button>
                    <a href="/data_customer" class="btn btn-danger btn-sm">Cancel</a>
                </div> 
            </div>
        </div>
    </div>
</form>
@endsection