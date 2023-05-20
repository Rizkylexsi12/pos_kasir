<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\redeemPoin;
use App\Models\stokHadiah;

class redeemPoinController extends Controller
{
    protected $stokHadiah;

    public function __construct(){
        $this->stokHadiah = new stokHadiah();
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
    
            return session()->put('cart', $cart);
        }
    
        // if item not exist in cart then add to cart with quantity = 1
        $cart[$barcode] = [
            "nama_barang" => $product->nama_barang,        
            "quantity" => 1,        
            "poin" => $product->poin 
        ];
    
        return session()->put('cart', $cart);
    }

    public function remove(Request $request){
        if($request->id) {
            $cart = session()->get('cart_hadiah');

            unset($cart[$request->id]);

            return session()->put('cart_hadiah', $cart);
        }
    }
}
