@extends('Layout.layout')

@section('judul')
    | Input Penjualan
@endsection

@section('nama_menu')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-0 mt-0">
                <div class="col-sm-15 row mb-0 mt-0">
                    <h3 class="row mb-0 mt-0">Input Penjualan</h3>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('content')
<!-- Input cart -->
    @if (session('pesan'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-check"></i>{{ session('pesan') }}</h4>
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="fa fa-exclamation-triangle"></i>{{ session('error') }}</h4>
        </div>
    @endif
    @if (session('warning'))
        <div class="alert alert-warning alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="fa fa-exclamation-triangle"></i>{{ session('warning') }}</h4>
        </div>
    @endif
    <section class="content-header border">
        <table class="table table-bordered table-striped table-sm table-hover col-3">
            <thead>
                <tr>
                    <th class="text-center">Kode Barang</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="text-center">
                        <input type="text" class="col-12" name="barcode">
                    </td>
                </tr>              
            </tbody>
        </table>
    </section>
<!-- list Cart -->
    <form action="{{ route('checkout') }}" method="POST">
        @csrf
        <?php $Grandtotal = 0 ?> 
        <?php $total = 0 ?>
        <?php $totalqty = 0 ?>

        @if(session('cart'))
            <section class="content-header border">
                <h2>List Pembelian</h2>
                <div class="row">
                    <table class="table table-bordered table-striped table-sm table-hover col-md-10">
                        <thead>
                            <tr>
                                <th class="text-center">Nama Barang</th>
                                <th class="text-center">Qty</th>
                                <th class="text-center">Harga</th>
                                <th class="text-center">Total</th>
                                <th class="text-center" width="300">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(session('cart') as $id => $details)
                            <?php $Grandtotal += $details['harga_barang'] * $details['quantity'] ?>
                            <?php $total = $details['harga_barang'] * $details['quantity'] ?>
                            <?php $totalqty += $details['quantity'] ?>
                                <tr>
                                    <td>{{ $details['nama_barang'] }}</td>
                                    <td width="150" class="text-center"><input type="number" class="col-6 quantity" value="{{ $details['quantity'] }}" name="quantity[{{ $id }}]"></td>
                                    <td width="150" class="text-center">Rp {{ number_format($details['harga_barang']) }}</td>
                                    <td width="150" class="text-center"><input type="text" class="col-12" value="Rp {{ number_format($total) }}" readonly></td>
                                    <td class="text-center actions" width="100">
                                        <button data-id="{{ $id }}" class="update-cart"><i class="fas fa-sync"></i></button>
                                        <button data-id="{{ $id }}" class="remove-from-cart"><i class="nav-icon fas fa-trash-alt"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <td>No. hp : <input type="number" class="col-9" name="nomor_hp"></td>
                                <td class="text-center" style="font-size: 20px">Total : &nbsp;<b>{{ $totalqty }} pc(s)</b></td>
                                <td colspan="2" class="text-center" style="font-size: 25px">Total Bayar : <b>Rp {{ number_format($Grandtotal) }}</b></td>
                                <td rowspan="2" class="text-danger">*Pastikan untuk selalu refresh item ketika terjadi penambahan/pengurangan qty</td>
                            </tr>
                            <tr>
                                <td class="text-center">Poin : <input type="text" class="col-4" name="poin"></td>
                                <td class="text-center"></td>
                                <td colspan="2" class="text-center">Bayar : <input type="number" class="col-6" name="bayar"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div>
                    <div class="col-lg-3 col-sm-12 col-12 text-center checkout">
                        <button type="submit" class="btn btn-primary btn-block">Checkout</button>
                    </div>
                </div>
            </section>
        @endif
    </form>
@endsection

@section('scripts')
    <script type="text/javascript">
        $(".update-cart").click(function (e){
            e.preventDefault();
            var _this = $(this);

            $.ajax({
            url: '{{ url('update-cart') }}',
            method: "patch",
            data: {_token: '{{ csrf_token() }}', id: _this.attr("data-id"), quantity: _this.parents("tr").find(".quantity").val()},
            success: function (response) {
                window.location.reload();
            }
            });
        });

        $(".remove-from-cart").click(function (e){
            e.preventDefault();
            var _this = $(this);

            if(confirm("Apakah anda yakin?")){
                $.ajax({
                    url: '{{ url('remove-from-cart') }}',
                    method: "DELETE",
                    data: {_token: '{{ csrf_token() }}', id: _this.attr("data-id")},
                    success: function (response) {
                        window.location.reload();
                    }
                });
            }
        });

        $("input[name='barcode']").focus(); 
        $("input[name='barcode']").keypress(function(e){
            if(e.which == 13){
                e.preventDefault();

                var barcode = $(this).val();
                var url = "{{ url('/add-to-cart/') }}" + "/" + barcode;
                var _this = $(this);
                
                $.ajax({
                    url: url,
                    method: "GET",
                    data: {_token: '{{ csrf_token() }}'},
                    success: function (response) {
                        window.location.reload();
                        _this.val('');
                    }
                });
            }
        });
    </script>
@endsection