@extends('0_Layout.layout')

@section('judul')
    | Riwayat Redeem
@endsection

@section('nama_menu')
<section class="content-header">
    <div class="container-fluid">
    <div class="row mb-0 mt-0">
        <div class="col-sm-15 row mb-0 mt-0">
            <h3 class="row mb-0 mt-0"><h3 class="row mb-0 mt-0 pl-3">Detail Redeem ({{ $riwayatRedeem->nama_customer }} / {{ $riwayatRedeem->nomor_telepon }} / {{ \Carbon\Carbon::parse($riwayatRedeem->created_at)->addHours(7) }})</h3>
        </div>
    </div>
    </div>
</section>
@endsection

@section('content')
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
            @foreach ($detailRedeem as $data)
            <?php $Grandtotal += $data->total ?>
            <tr>
                <td class="text-center" width="30">{{ $no++ }}</td>
                <td class="text-center" width="80">{{ $data->produk }}</td>
                <td class="text-center" width="60">{{ number_format($data->poin) }}</td>
                <td class="text-center" width="60">{{ $data->jumlah }}</td>
                <td class="text-center" width="60">{{ number_format($data->total) }}</td>
            </tr>
            @endforeach
            <tr>
                <td colspan="3"></td>
                <td class="text-right" width="60">Total Redeem Poin: </td>
                <td class="text-center" width="60"><b>{{ number_format($Grandtotal) }}</b></td>
            </tr>
        </tbody>
    </table>
    <a href="/riwayat_redeem" class="btn btn-success btn-sm">Kembali</a>
@endsection