@extends('Layout.layout')

@section('judul')
    | Detail Customer
@endsection

@section('nama_menu')
<section class="content-header">
    <div class="container-fluid">
    <div class="row mb-0 mt-0">
        <div class="col-sm-15 row mb-0 mt-0">
            <h3 class="row mb-0 mt-0">Detail Customer</h3>
        </div>
    </div>
    </div>
</section>
@endsection

@section('content')
    <table class="table">
        <tr>
            <th width="150px">Nama Customer</th>
            <th width="30px">:</th>
            <th>{{ $customer-> nama_customer }}</th>
        </tr>
        <tr>
            <th width="100px">Alamat</th>
            <th width="30px">:</th>
            <th>{{ $customer-> alamat }}</th>
        </tr>
        <tr>
            <th width="100px">No. Telp</th>
            <th width="30px">:</th>
            <th>{{ $customer-> no_telp }}</th>
        </tr>
        <tr>
            <th width="100px">Poin</th>
            <th width="30px">:</th>
            <th>{{ $customer-> poin }}</th>
        </tr>
        <tr>
            <th><a href="/data_customer" class="btn btn-success btn-sm">Kembali</a></th>
        </tr>
        
    </table>
@endsection