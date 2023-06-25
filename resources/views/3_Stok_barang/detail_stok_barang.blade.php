@extends('0_Layout.layout')

@section('judul')
    | Detail Stok Barang
@endsection

@section('nama_menu')
<section class="content-header">
    <div class="container-fluid">
    <div class="row mb-0 mt-0">
        <div class="col-sm-15 row mb-0 mt-0">
            <h3 class="row mb-0 mt-0">Detail Stok Barang</h3>
        </div>
    </div>
    </div>
</section>
@endsection

@section('content')
    <table class="table">
        <tr>
            <th width="150px">Barcode</th>
            <th width="30px">:</th>
            <th>{{ $stok->barcode }}</th>
        </tr>
        <tr>
            <th width="150px">Nama Barang</th>
            <th width="30px">:</th>
            <th>{{ $stok->nama_barang }}</th>
        </tr>
        <tr>
            <th width="150px">Harga Beli</th>
            <th width="30px">:</th>
            <th>Rp{{ number_format($stok-> harga_beli) }}</th>
        </tr>
        <tr>
            <th width="150px">Harga Jual</th>
            <th width="30px">:</th>
            <th>Rp {{ number_format($stok-> harga_barang) }}</th>
        </tr>
        <tr>
            <th width="100px">Qty</th>
            <th width="30px">:</th>
            <th>{{ $stok->qty }}</th>
        </tr>
        <tr>
            <th><a href="/stok_barang" class="btn btn-success btn-md">Kembali</a></th>
            <th></th>
            <th></th>
        </tr>
        
    </table>
@endsection