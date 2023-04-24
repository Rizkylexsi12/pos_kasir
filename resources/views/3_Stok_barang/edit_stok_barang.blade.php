@extends('Layout.layout')

@section('judul')
    | Edit Stok Barang
@endsection

@section('nama_menu')
<section class="content-header">
    <div class="container-fluid">
    <div class="row mb-0 mt-0">
        <div class="col-sm-15 row mb-0 mt-0">
            <h3 class="row mb-0 mt-0">Edit Stok Barang</h3>
        </div>
    </div>
    </div>
</section>
@endsection

@section('content')
<form action="/stok_barang/update/{{ $stok-> id }}" method="post" enctype="multipart/form-data">
    @csrf

    <div class="content">
        <div  class="row">
            <div class="col-6">
                <div class="form-group">
                    <label>Barcode</label>
                    <input type="number" name="barcode" class="form-control" value="{{ $stok-> barcode }}">
                    <div class="text-danger">
                        @error('barcode')
                            {{  $message }}
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label>Nama Barang</label>
                    <input type="text" name="nama_barang" class="form-control" value="{{ $stok-> nama_barang }}">
                    <div class="text-danger">
                        @error('nama_barang')
                            {{  $message }}
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label>Harga Beli</label>
                    <input type="number" name="harga_beli" class="form-control" value="{{ $stok->harga_beli }}">
                    <div class="text-danger">
                        @error('harga_beli')
                            {{  $message }}
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label>Harga Jual</label>
                    <input type="number" name="harga_barang" class="form-control" value="{{ $stok-> harga_barang }}">
                    <div class="text-danger">
                        @error('harga_barang')
                            {{  $message }}
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label>QTY</label>
                    <input type="number" name="qty" class="form-control" value="{{ $stok-> qty }}">
                    <div class="text-danger">
                        @error('qty')
                            {{  $message }}
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <button class="btn btn-success btn-sm">Simpan</button>
                    <a href="/stok_barang" class="btn btn-danger btn-sm">Cancel</a>
                </div> 
            </div>
        </div>
    </div>
</form>
@endsection