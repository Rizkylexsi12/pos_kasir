@extends('Layout.layout')

@section('judul')
    | Stok Hadiah
@endsection

@section('nama_menu')
    <section class="content-header">
        <div class="container-fluid">
        <div class="row mb-0 mt-0">
            <div class="col-sm-15 row mb-0 mt-0">
                <h3 class="row mb-0 mt-0">Stok Hadiah</h3>
            </div>
        </div>
        </div>
    </section>
@endsection

@section('content')
    <div class="mb-2 mt-2">
      <a href="" class="btn btn-primary btn-success"> + Add Barang </a>
    </div>
    <div class="row mb-2">
      <form action="" method="GET" class="pl-2">
        <input type="text" name="cari" placeholder="Cari Barang / Barcode">
        <input type="submit" value="Search">
      </form>
    </div>
    @if (session('pesan'))
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
                    <th class="text-center">Qty</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="text-center" width="60">1.</td>
                    <td class="text-center" width="150">12233</td>
                    <td>testing</td>
                    <td class="text-center" width="60">5</td>
                    <td class="text-center" width="150">
                        <a href="" class="btn btn-sm btn-primary">Edit</a>
                        <button type="button" class="btn btn-sm btn-danger" data-toggle="modal">
                            Delete
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    @endif
@endsection