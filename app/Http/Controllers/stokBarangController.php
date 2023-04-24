<?php

namespace App\Http\Controllers;
use App\Models\stok;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\RiwayatPenjualan;
use App\Models\DetailPenjualan;
use App\Models\customer;
use Illuminate\Support\Facades\Session;

class stokBarangController extends Controller
{
    protected $stok;

    public function __construct(){
        $this->stok = new stok();
    }

    public function home(){
        Session::forget('cart');
        return view('1_Input_penjualan/input_penjualan');
    }

    public function index(){
        return view('3_Stok_barang/stok_barang', [
            'stok' => DB::table('stoks')->paginate(10)
        ]);
    }

    public function add(){
        return view('3_Stok_barang/add_stok_barang');
    }

    public function insert(){
        Request()->validate([
            'barcode' => 'required',
            'nama_barang' => 'required|max:255',
            'harga_beli' => 'required',
            'harga_barang' => 'required',
            'qty' => 'required',
        ],[
            'barcode.required' => 'Wajib diisi!!',
            'nama_barang.required' => 'Wajib diisi!!',
            'harga_beli' => 'Wajib diisi!!',
            'harga_barang.required' => 'Wajib diisi!!',
            'qty.required' => 'Wajib diisi!!'
        ]);

        $data = [
            'barcode' => Request()-> barcode,
            'nama_barang' => Request()-> nama_barang,
            'harga_beli' => Request()->harga_beli,
            'harga_barang' => Request()-> harga_barang,
            'qty' => Request()-> qty,
        ];

        $this->stok->addData($data);
        return redirect()-> route('stok_barang')-> with('pesan','Data Berhasil ditambahkan!!');
    }

    public function detail($id){
        if(!$this->stok->detailData($id)){
            abort(404);
        }
        
        $data = [
            'stok' => $this->stok->detailData($id)
        ];

        return view('3_Stok_barang/detail_stok_barang', $data);
    }

    public function edit($id){
        if(!$this->stok->detailData($id)){
            abort(404);
        }

        $data = [
            'stok' => $this->stok->detailData($id)
        ];

        return view('3_Stok_barang/edit_stok_barang', $data);
    }

    public function update($id){
        Request()->validate([
            'barcode' => 'required',
            'nama_barang' => 'required|max:255',
            'harga_beli' => 'required',
            'harga_barang' => 'required',
            'qty' => 'required',
        ],[
            'barcode.required' => 'Wajib diisi!!',
            'nama_barang.required' => 'Wajib diisi!!',
            'harga_beli' => 'Wajib diisi!!',
            'harga_barang.required' => 'Wajib diisi!!',
            'qty.required' => 'Wajib diisi!!'
        ]);

        $data = [
            'barcode' => Request()-> barcode,
            'nama_barang' => Request()-> nama_barang,
            'harga_beli' => Request()->harga_beli,
            'harga_barang' => Request()-> harga_barang,
            'qty' => Request()-> qty,
        ];

        $this->stok->editData($id, $data);
        return redirect()-> route('stok_barang')-> with('pesan','Data Berhasil diupdate!!');
    }

    public function delete($id){
        $this->stok->deleteData($id);

        return redirect()->route('stok_barang')->with('pesan', 'Data berhasil dihapus');
    }

    public function addToCarts($barcode){
        $product = stok::where('barcode', $barcode)->first();
         
        if(!$product) {
            abort(404);
        }

        $cekstok = $product->qty;
    
        $cart = session()->get('cart');

        if($cekstok <= 0){
            return session()->flash('error', 'Stok '. $product->nama_barang. ' tidak cukup'); 
        }else{
            // if cart is empty then this the first product
            if(!$cart) {
                $cart = [
                    $barcode => [
                        "nama_barang" => $product->nama_barang,
                        "quantity" => 1,
                        "harga_barang" => $product->harga_barang
                        ]
                    ];

                return session()->put('cart', $cart);  
            }
    
            // if cart not empty then check if this product exist then increment quantity
            if(isset($cart[$barcode])) {
                $cart[$barcode]['quantity']++;
            
                return session()->put('cart', $cart);
            }
    
            // if item not exist in cart then add to cart with quantity = 1
            $cart[$barcode] = [
                "nama_barang" => $product->nama_barang,        
                "quantity" => 1,        
                "harga_barang" => $product->harga_barang 
            ];
    
            return session()->put('cart', $cart);
        }
    }

    public function addToCart($barcode){
        $product = stok::where('barcode', $barcode)->first();
    
        if(!$product) {
            return session()->flash('error', ' Barcode salah!!'); 
        }
    
        $qtyInStock = $product->qty;
    
        $cart = session()->get('cart');
    
        if($qtyInStock <= 0){
            return session()->flash('error', ' Stok '. $product->nama_barang. ' sudah habis!!'); 
        }
    
        // check if requested quantity exceeds stock quantity
        $requestedQuantity = 1;
        if(isset($cart[$barcode])) {
            $requestedQuantity = $cart[$barcode]['quantity'] + 1;
        }
        if($requestedQuantity > $qtyInStock){
            return session()->flash('error', ' Stok '.$product->nama_barang.' hanya '.$qtyInStock.' pc(s)!!');
        }
    
        // if cart is empty then this the first product
        if(!$cart) {
            $cart = [
                $barcode => [
                    "nama_barang" => $product->nama_barang,
                    "quantity" => 1,
                    "harga_barang" => $product->harga_barang
                    ]
                ];
    
            return session()->put('cart', $cart);
            return session()->flash('error', ' Stok '.$product->nama_barang.' hanya pc(s)'); 
        }
    
        // if cart not empty then check if this product exist then increment quantity
        if(isset($cart[$barcode])) {
            $cart[$barcode]['quantity']++;
    
            return session()->put('cart', $cart);
        }
    
        // if item not exist in cart then add to cart with quantity = 1
        $cart[$barcode] = [
            "nama_barang" => $product->nama_barang,        
            "quantity" => 1,        
            "harga_barang" => $product->harga_barang 
        ];
    
        return session()->put('cart', $cart);
    }
    

    public function remove(Request $request){
        if($request->id) {
            $cart = session()->get('cart');

            unset($cart[$request->id]);

            return session()->put('cart', $cart);
        }
    }

    public function update_cart(Request $request){
        if($request->id and $request->quantity){
            $cart = session()->get('cart');

            $cart[$request->id]["quantity"] = $request->quantity;

            session()->put('cart', $cart);
            session()->flash('success', 'Cart updated successfully');
        }
    }

    public function checkout(Request $request){
        // Ambil data penjualan dari session
        $cart = session()->get('cart', []);

        $nomor_hp = isset($request->nomor_hp) && !empty($request->nomor_hp) ? $request->nomor_hp : "000";
        $uang_bayar = $request->bayar;
        $grandtotal = 0;
        
        foreach ($cart as $produk) {
            $total = $produk['quantity'] * $produk['harga_barang'];
            $grandtotal += $total;
        }

        if($uang_bayar < $grandtotal){
            return redirect()-> route('input_penjualan')-> with('warning', ' Uang bayar kurang dari total belanja');
        }else{
            $customer = customer::where('no_telp', $nomor_hp)-> first();
            if (!$customer) {
                $customer = new customer();
                $customer->no_telp = $nomor_hp;
                $customer->save();
            }

            $pointsToAdd = isset($request->poin) && !empty($request->poin) ? $request->poin : "0";
            if ($pointsToAdd >= 0) {
                $customer->poin += $pointsToAdd;
                $customer->save();
            }
        
            // Simpan riwayat penjualan ke dalam tabel "riwayat_penjualan"
            $riwayat_penjualan = new RiwayatPenjualan;
            $riwayat_penjualan->tanggal = now();
            $riwayat_penjualan->nama_pembeli = $customer->nama_customer;
            $riwayat_penjualan->nomor_telepon = $nomor_hp;
            $riwayat_penjualan->poin = $pointsToAdd;
            $riwayat_penjualan->save();
        
            // Simpan detail penjualan ke dalam tabel "detail_penjualan"
            foreach ($cart as $produk) {
                $detail_penjualan = new DetailPenjualan;
                $detail_penjualan->id_penjualan = $riwayat_penjualan->id;
                $detail_penjualan->produk = $produk['nama_barang'];
                $detail_penjualan->jumlah = $produk['quantity'];
                $detail_penjualan->harga = $produk['harga_barang'];
                $detail_penjualan->total = $produk['quantity'] * $produk['harga_barang'];
                // $total = $detail_penjualan->total;
                // $grandtotal += $total;
                $detail_penjualan->save();
                $stok_barang = stok::where('nama_barang', $produk['nama_barang'])->first();
                $stok_barang->qty -= $produk['quantity'];
                $stok_barang->save();
            }

            session()->forget('cart');
            return redirect()-> route('input_penjualan')-> with('pesan', 'Uang Kembali : Rp' . number_format($uang_bayar - $grandtotal));
        }
    }

    public function search(Request $request){
	    $cari = $request->cari;
        
	    $barang = DB::table('stoks')
	                ->where('nama_barang','like',"%".$cari."%")
                    ->orWhere('barcode', 'like', "%$cari%")
	                ->paginate(10);
        
        if ($barang->isEmpty()) {
            $message = "Maaf, Barang yang anda dicari tidak ada";
            return view('3_Stok_barang/stok_barang',[
                'message' => $message,
                'cari' => $cari
            ]);
        } else {
	    return view('3_Stok_barang/stok_barang',[
            'stok' => $barang,
            'cari' => $cari
        ]);
        }
    }
}