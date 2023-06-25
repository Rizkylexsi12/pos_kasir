@extends('0_Layout.layout')

@section('judul')
    | Riwayat Penjualan
@endsection

@section('nama_menu')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-0 mt-0">
            <div class="col-sm-15 row mb-0 mt-0">
                <h3 class="row mb-0 mt-0">Riwayat Penjualan</h3>
            </div>
        </div>
    </div>
</section>
@endsection

@section('content')
<div class="row mb-2">
    <form action="/riwayat_penjualan/cari" method="GET" class="pl-2 col-sm-8 mt-3">
      <input type="text" name="cari" placeholder="Cari Customer" value="{{ !empty($cari) ? $cari : '' }}">
      <input type="submit" value="Search" class="ml-2">
    </form>
    <form action="{{ route('filterDate') }}" method="GET" class="pl-2 col-sm-4 mt-3">
        <input type="date" id="start_date" name="start_date" value="{{ !empty($startDate) ? $startDate : ''  }}">
        <label for="end_date" class="ml-2 mr-2">-</label>
        <input type="date" id="end_date" name="end_date" value="{{ !empty($endDate) ? $endDate : '' }}">
        <input type="submit" class="ml-2" value="Filter">
        {{-- <button type="submit">Filter</button> --}}
    </form>
</div>
{{-- <div>
    
</div> --}}
    @if(isset($message))
      <div class="alert alert-danger">{{ $message }}</div>
    @else
    <table class="table table-bordered table-striped table-sm table-hover mt-3">
        <thead>
            <tr>
                <th class="text-center">No.</th>
                <th class="text-center">Nama Customer</th>
                <th class="text-center">Nomor Customer</th>
                <th class="text-center">Poin</th>
                <th class="text-center">Tanggal Pembelian</th>
            </tr>
        </thead>
        <tbody>
            <?php $no=1; ?>
            @foreach ($riwayatpenjualan as $no => $data)
            <tr>
                <td class="text-center" width="30">{{ ++$no + ($riwayatpenjualan->currentPage()-1) * $riwayatpenjualan->perPage() }}</td>
                <td width="300"><a href="/riwayat_penjualan/detail/{{ $data->id }}">{{ $data->nama_pembeli }}</td>
                <td class="text-center" width="60">{{ $data->nomor_telepon }}</td>
                <td class="text-center" width="60">{{ $data->poin }}</td>
                <td class="text-center" width="200">{{ \Carbon\Carbon::parse($data->created_at)->addHours(7) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $riwayatpenjualan -> links() }}
    @endif
@endsection