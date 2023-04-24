@extends('Layout.layout')

@section('judul')
    | Data Customer
@endsection

@section('nama_menu')
<section class="content-header">
    <div class="container-fluid">
    <div class="row mb-0 mt-0">
        <div class="col-sm-15 row mb-0 mt-0">
            <h3 class="row mb-0 mt-0">Data Customer</h3>
        </div>
    </div>
    </div>
</section>
@endsection

@section('content')
    <div class="mb-2 mt-2">
      <a href="/data_customer/add" class="btn btn-primary btn-success"> + Add Customer </a>
    </div>
    <div class="row mb-2">
      <form action="/data_customer/cari" method="GET" class="pl-2">
        <input type="text" name="cari" placeholder="Cari Customer / Anak Cust." value="{{ !empty($cari) ? $cari : '' }}">
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
    <table class="table table-bordered table-hover table-sm table-striped">
        <thead>
            <tr>
                <th class="text-center">No.</th>
                <th class="text-center">Nama Customer</th>
                <th class="text-center">Nama Anak</th>
                <th class="text-center">Alamat</th>
                <th class="text-center">No. Telp</th>
                <th class="text-center">Poin</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($customer as $no => $data)
            <tr>
                <td class="text-center" width="60">{{ ++$no + ($customer->currentPage()-1) * $customer->perPage() }}</td>
                <td class="text-decoration-underline" width="300"><a href="/data_customer/detail/{{ $data-> id }}">{{ $data->nama_customer }}</a></td>
                <td>{{ $data->nama_anak }}</td>
                <td>{{ $data->alamat }}</td>
                <td class="text-center" width="80">{{ $data->no_telp }}</td>
                <td class="text-center" width="80">{{ $data->poin }}</td>
                <td class="text-center" width="130">
                    <a href="/data_customer/edit/{{ $data-> id }}" class="btn btn-sm btn-primary">Edit</a>
                    <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#delete{{ $data->id }}">
                        Delete
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $customer -> links() }}

    @foreach ($customer as $data)
    <div class="modal fade" id="delete{{ $data->id }}">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Delete</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>Ingin menghapus <b> {{ $data->nama_customer }} </b>?</p>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
              <a href="/data_customer/delete/{{ $data->id }}" class="btn btn-danger">Ya</a>
            </div>
          </div>
        </div>
      </div>
      @endforeach
      @endif      
@endsection