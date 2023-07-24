@extends('0_Layout.layout')

@section('judul')
    | Stok Barang
@endsection

@section('nama_menu')
<section class="content-header">
    <div class="container-fluid">
    <div class="row mb-0 mt-0">
        <div class="col-sm-15 row mb-0 mt-0">
            <h3 class="row mb-0 mt-0">Stok Barang</h3>
        </div>
    </div>
    </div>
</section>
@endsection

@section('content')
    <div class="row mb-3">
      <form action="{{ route('stok_barang.search') }}" method="GET" class="pl-2 mt-4">
        <input type="text" name="cari" placeholder="Cari Barang / Barcode" value="{{ !empty($cari) ? $cari : '' }}">
        <input type="submit" value="Search" class="ml-2">
      </form>
      <div class="ml-auto">
        <a href="{{ route('stok_barang.create') }}" class="btn btn-primary btn-success mt-3 mr-3"> + Add Barang </a>
      </div>
    </div>
    @if(session('pesan'))
      <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <h4><i class="icon fa fa-check"></i>{{ session('pesan') }}</h4>
      </div>
    @endif
    @if(isset($message))
      <div class="alert alert-danger">{{ $message }}</div>
    @else
    <table class="table table-bordered table-striped table-sm table-hover">
        <thead>
            <tr>
                <th class="text-center">No.</th>
                <th class="text-center">Barcode</th>
                <th class="text-center">Nama Barang</th>
                <th class="text-center">Harga Beli</th>
                <th class="text-center">Harga Jual</th>
                <th class="text-center">Qty</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($stok as $data)
            @php
              $loopNumber = ($stok->currentPage() - 1) * $stok->perPage() + $loop->iteration;
            @endphp
            <tr>
                <td class="text-center" width="60">{{ $loopNumber }}</td>
                <td class="text-center" width="150">{{ $data->barcode }}</td>
                <td><a href="/stok_barang/detail/{{ $data-> id }}">{{ $data->nama_barang }}</a></td>
                <td class="text-center" width="150">Rp{{ number_format($data->harga_beli) }}</td>
                <td class="text-center" width="150"> Rp{{ number_format($data->harga_barang) }}</a></td>
                <td class="text-center" width="60">{{ $data->qty }}</td>
                <td class="text-center" width="150">
                    <a href="/stok_barang/edit/{{ $data->id }}" class="btn btn-sm btn-primary">Edit</a>
                    <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#delete{{ $data->id }}">
                        Hapus
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="row">
      <div>
        {{ $stok -> links() }}
      </div>
      <span class="ml-3">Jumlah total data : {{ $stok->total() }}</span>
    </div>
  
    @foreach ($stok as $data)
    <div class="modal fade" id="delete{{ $data->id }}">
        <div class="modal-dialog modal-sm modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Delete</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p class="text-center">Apakah anda yakin ingin menghapus <b> {{ $data->nama_barang }} </b>?</p>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
              <a href="/stok_barang/delete/{{ $data->id }}" class="btn btn-danger pl-4 pr-4">Ya</a>
            </div>
          </div>
        </div>
      </div>
    @endforeach
  @endif
@endsection