@extends('0_Layout.layout')

@section('judul')
    | Detail Stok Hadiah
@endsection

@section('nama_menu')
<section class="content-header">
    <div class="container-fluid">
    <div class="row mb-0 mt-0">
        <div class="col-sm-15 row mb-0 mt-0">
            <h3 class="row mb-0 mt-0">Detail Stok Hadiah</h3>
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
            <th>{{ $stokHadiah->barcode }}</th>
        </tr>
        <tr>
            <th width="150px">Nama Barang</th>
            <th width="30px">:</th>
            <th>{{ $stokHadiah->nama_barang }}</th>
        </tr>
        <tr>
            <th width="150px">Poin</th>
            <th width="30px">:</th>
            <th>{{ $stokHadiah->poin }}</th>
        </tr>
        <tr>
            <th width="100px">Qty</th>
            <th width="30px">:</th>
            <th>{{ $stokHadiah->qty }}</th>
        </tr>
        <tr>
            <th><a href="/stok_hadiah" class="btn btn-success btn-sm">Kembali</a></th>
            <th></th>
            <th></th>
        </tr>
        
    </table>
@endsection