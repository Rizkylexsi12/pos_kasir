@extends('0_Layout.layout')

@section('judul')
    | Edit Stok Hadiah
@endsection

@section('nama_menu')
<section class="content-header">
    <div class="container-fluid">
    <div class="row mb-0 mt-0">
        <div class="col-sm-15 row mb-0 mt-0">
            <h3 class="row mb-0 mt-0">Edit Stok Hadiah</h3>
        </div>
    </div>
    </div>
</section>
@endsection

@section('content')
<form action="/stok_hadiah/update/{{ $stokHadiah->id }}" method="post" enctype="multipart/form-data">
    @csrf

    <div class="content">
        <div  class="row">
            <div class="col-6 mt-3">
                <div class="form-group">
                    <label>Barcode</label>
                    <input type="number" name="barcode" class="form-control" value="{{ $stokHadiah-> barcode }}">
                    <div class="text-danger">
                        @error('barcode')
                            {{  $message }}
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label>Nama Barang</label>
                    <input type="text" name="nama_barang" class="form-control" value="{{ $stokHadiah-> nama_barang }}">
                    <div class="text-danger">
                        @error('nama_barang')
                            {{  $message }}
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label>Poin</label>
                    <input type="number" name="poin" class="form-control" value="{{ $stokHadiah-> poin }}">
                    <div class="text-danger">
                        @error('poin')
                            {{  $message }}
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label>QTY</label>
                    <input type="number" name="qty" class="form-control" value="{{ $stokHadiah-> qty }}">
                    <div class="text-danger">
                        @error('qty')
                            {{  $message }}
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <button class="btn btn-success btn-md">Simpan</button>
                    <a href="/stok_hadiah" class="btn btn-danger btn-md ml-2">Batal</a>
                </div> 
            </div>
        </div>
    </div>
</form>
@endsection