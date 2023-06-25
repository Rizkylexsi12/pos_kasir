@extends('0_Layout.layout')

@section('judul')
    | Riwayat Redeem
@endsection

@section('nama_menu')
<section class="content-header">
    <div class="container-fluid">
    <div class="row mb-0 mt-0">
        <div class="col-sm-15 row mb-0 mt-0">
            <h3 class="row mb-0 mt-0"><h3 class="row mb-0 mt-0 pl-3">Detail Redeem</h3>
        </div>
    </div>
    </div>
</section>
@endsection

@section('content')
<div class="row mb-2">
    <table class="table">
        <tr>
            <th width="150px">Nama Customer</th>
            <th width="30px">:</th>
            <th>{{ $riwayatRedeem->nama_customer }}</th>
        </tr>
        <tr>
            <th width="150px">No. Telp</th>
            <th width="30px">:</th>
            <th>{{ $riwayatRedeem->nomor_telepon }}</th>
        </tr>
        <tr>
            <th width="150px">Tanggal Redeem</th>
            <th width="30px">:</th>
            <th>{{ \Carbon\Carbon::parse($riwayatRedeem->created_at)->addHours(7) }}</th>
        </tr>
    </table>
</div>
    <table class="table table-bordered table-striped table-sm table-hover">
        <thead>
            <tr>
                <th class="text-center">No.</th>
                <th class="text-center">Nama Barang</th>
                <th class="text-center">Poin</th>
                <th class="text-center">Qty</th>
                <th class="text-center">Total</th>
            </tr>
        </thead>
        <tbody>
            <?php $no=1; ?>
            <?php $Grandtotal=0; ?>
            <?php $totalPcs=0; ?>
            @foreach ($detailRedeem as $data)
            <?php 
                $Grandtotal += $data->total;
                $totalPcs += $data->jumlah;
            ?>
            <tr>
                <td class="text-center" width="20">{{ $no++ }}</td>
                <td class="text-center" width="150">{{ $data->produk }}</td>
                <td class="text-center" width="30">{{ number_format($data->poin) }}</td>
                <td class="text-center" width="30">{{ number_format($data->jumlah) }}</td>
                <td class="text-center" width="30">{{ number_format($data->total) }}</td>
            </tr>
            @endforeach
            <tr>
                <td colspan="2"></td>
                <td class="text-right" width="30">Total : </td>
                <td class="text-center" width="30"><b>{{ number_format($totalPcs) }} Pc(s)</b></td>
                <td class="text-center" width="30"><b>{{ number_format($Grandtotal) }} Poin</b></td>
            </tr>
        </tbody>
    </table>
    <a href="/riwayat_redeem" class="btn btn-success btn-md">Kembali</a>
@endsection