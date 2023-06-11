<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\stokHadiah;
use App\Models\customer;
use App\Models\riwayatRedeem;
use App\Models\DetailRedeem;
use Illuminate\Support\Facades\Session;

class redeemPoinController extends Controller
{
    protected $stokHadiah;

    public function __construct(){
        $this->stokHadiah = new stokHadiah();
    }

    public function home(){
        Session::forget('cart_hadiah');
        return view('/5_Redeem_poin/Redeem_poin');
    }

    public function index(){
        return view('/5_Redeem_poin/Redeem_poin');
    }

    public function addToCart($barcode){
        $product = stokHadiah::where('barcode', $barcode)->first();
    
        if(!$product) {
            return session()->flash('error', ' Barcode salah!!'); 
        }
    
        $qtyInStock = $product->qty;
    
        $cart = session()->get('cart_hadiah');
    
        if($qtyInStock <= 0){
            return session()->flash('error', ' Stok '. $product->nama_barang. ' sudah habis!!'); 
        }
    
        //Jika sudah terdapat produk yang sama
        $requestedQuantity = 1;
        if(isset($cart[$barcode])) {
            $requestedQuantity = $cart[$barcode]['quantity'] + 1;
        }
        if($requestedQuantity > $qtyInStock){
            return session()->flash('error', ' Stok '.$product->nama_barang.' hanya '.$qtyInStock.' pc(s)!!');
        }
    
        //Jika cart_hadiah kosong
        if(!$cart) {
            $cart = [
                $barcode => [
                    "nama_barang" => $product->nama_barang,
                    "quantity" => 1,
                    "poin" => $product->poin
                    ]
                ];
    
            return session()->put('cart_hadiah', $cart);
            return session()->flash('error', ' Stok '.$product->nama_barang.' hanya pc(s)'); 
        }
    
        //Menambah qty
        if(isset($cart[$barcode])) {
            $cart[$barcode]['quantity']++;
    
            return session()->put('cart_hadiah', $cart);
        }
    
        // if item not exist in cart then add to cart with quantity = 1
        $cart[$barcode] = [
            "nama_barang" => $product->nama_barang,        
            "quantity" => 1,        
            "poin" => $product->poin 
        ];
    
        return session()->put('cart_hadiah', $cart);
    }

    public function remove(Request $request){
        if($request->id) {
            $cart = session()->get('cart_hadiah');

            unset($cart[$request->id]);

            return session()->put('cart_hadiah', $cart);
        }
    }

    public function update_cart(Request $request){
        if($request->id and $request->quantity){
            $cart = session()->get('cart_hadiah');

            $cart[$request->id]["quantity"] = $request->quantity;

            session()->put('cart_hadiah', $cart);
            session()->flash('success', 'Cart updated successfully');
        }
    }

    public function checkout(Request $request){
        $cart = session()->get('cart_hadiah', []);
        $grandtotal = 0;

        foreach ($cart as $produk) {
            $total = $produk['quantity'] * $produk['poin'];
            $grandtotal += $total;
        }

        if(isset($request->nomor_hp)){
            $nomor_hp = $request->nomor_hp;
            $customer = customer::where('no_telp', $nomor_hp)-> first();
            if($request->poin <= $customer->poin){
                $customer->poin -= $grandtotal;
                $customer->save(); 
            }else{
                return redirect()->back()->with('error', ' Poin Customer tidak cukup');
            }  
        }else{
            return redirect()->back()->with('error', ' Nomor Handphone Tidak Boleh Kosong');
        }

        $riwayat_redeem = new riwayatRedeem();
        $riwayat_redeem->tanggal = now();
        $riwayat_redeem->nama_customer = $customer->nama_customer;
        $riwayat_redeem->nomor_telepon = $nomor_hp;
        $riwayat_redeem->poin = $grandtotal;
        $riwayat_redeem->save();
    
        foreach ($cart as $produk) {
            $detail_redeem = new DetailRedeem();
            $detail_redeem->id_redeem = $riwayat_redeem->id;
            $detail_redeem->produk = $produk['nama_barang'];
            $detail_redeem->jumlah = $produk['quantity'];
            $detail_redeem->poin = $produk['poin'];
            $detail_redeem->total = $produk['quantity'] * $produk['poin'];
            $total = $detail_redeem->total;
            $grandtotal += $total;
            $detail_redeem->save();
            $stok_hadiah = stokHadiah::where('nama_barang', $produk['nama_barang'])->first();
            $stok_hadiah->qty -= $produk['quantity'];
            $stok_hadiah->save();
        }

        session()->forget('cart_hadiah');
        return redirect()-> route('redeem_poin')-> with('pesan', ' Sisa poin : ' . $customer->poin);
    }
}