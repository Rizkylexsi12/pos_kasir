<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RiwayatPenjualanController;
use App\Http\Controllers\StokBarangController;
use App\Http\Controllers\DataCustomerController;
use App\Http\Controllers\RedeemPoinController;
use App\Http\Controllers\RiwayatRedeemController;
use App\Http\Controllers\StokHadiahController;

Route::view('/', '1_Input_penjualan/input_penjualan') ->name('input_penjualan');
// Route::get('/', [stokBarangController::class, 'home']);

Route::controller(RiwayatPenjualanController::class)->group(function() {
    Route::get('/riwayat_penjualan',[RiwayatPenjualanController::class, 'index'])->name('riwayat_penjualan.index');
    Route::get('/riwayat_penjualan/detail/{id_penjualan}', [RiwayatPenjualanController::class, 'detail']);
    Route::get('/riwayat_penjualan/cari', [RiwayatPenjualanController::class, 'search']);
    Route::get('/riwayat_penjualan/filterdate', [RiwayatPenjualanController::class, 'filterDate'])->name('filterDate');
});

Route::controller(StokBarangController::class)->group(function(){
    Route::get('/stok_barang', [StokBarangController::class, 'index'])->name('stok_barang.index');
    Route::get('/stok_barang/create', [StokBarangController::class, 'create'])->name('stok_barang.create');
    Route::post('/stok_barang/store', [StokBarangController::class, 'store'])->name('stok_barang.store');
    Route::get('/stok_barang/detail/{id}', [StokBarangController::class, 'detail'])->name('stok_barang.detail');
    Route::get('/stok_barang/edit/{id}', [StokBarangController::class, 'edit'])->name('stok_barang.edit');
    Route::post('/stok_barang/update/{id}', [StokBarangController::class, 'update'])->name('stok_barang.update');
    Route::get('/stok_barang/delete/{id}', [StokBarangController::class, 'delete'])->name('stok_barang.delete');
    Route::get('/stok_barang/search', [StokBarangController::class, 'search'])->name('stok_barang.search');
    Route::get('/add-to-cart/{barcode}', [StokBarangController::class, 'addToCart'])->name('addToCart');
    Route::delete('remove-from-cart', [StokBarangController::class, 'removeFromCart'])->name('removeFromCart');
    Route::patch('update-cart', [StokBarangController::class, 'update_cart'])->name('updateCart');
    Route::post('/checkout', [StokBarangController::class, 'checkout'])->name('checkout');
});

Route::controller(DataCustomerController::class)->group(function(){
    Route::get('/data_customer', [DataCustomerController::class, 'index'])->name('data_customer.index');
    Route::get('/data_customer/add', [DataCustomerController::class, 'add']);
    Route::post('/data_customer/insert', [DataCustomerController::class, 'insert']);
    Route::get('/data_customer/detail/{id_customer}', [DataCustomerController::class, 'detail']);
    Route::get('/data_customer/edit/{id_customer}', [DataCustomerController::class, 'edit']);
    Route::post('/data_customer/update/{id_customer}', [DataCustomerController::class, 'update']);
    Route::get('/data_customer/delete/{id_customer}', [DataCustomerController::class, 'delete']);
    Route::get('/data_customer/cari', [DataCustomerController::class, 'search']);
});

Route::controller(RedeemPoinController::class)->group(function(){
    Route::get('/redeem_poin', [RedeemPoinController::class, 'index'])->name('redeem_poin.index');
    // Route::get('/redeem_poin', [RedeemPoinController::class, 'home']);
    Route::get('/add-to-redeem/{barcode}', [RedeemPoinController::class, 'addToCart']);
    Route::patch('update-cart_hadiah', [RedeemPoinController::class, 'update_cart']);
    Route::delete('remove-from-cart-hadiah', [RedeemPoinController::class, 'remove']);
    Route::post('/checkout_hadiah', [RedeemPoinController::class, 'checkout'])->name('checkout_hadiah');
});

Route::controller(StokHadiahController::class)->group(function(){
    Route::get('/stok_hadiah', [StokHadiahController::class, 'index'])->name('stok_hadiah.index');
    Route::view('/stok_hadiah/add', '7_Stok_hadiah/add_stok_hadiah');
    Route::post('/stok_hadiah/insert', [StokHadiahController::class, 'insert']);
    Route::get('/stok_hadiah/detail/{id}', [StokHadiahController::class, 'detail']);
    Route::get('/stok_hadiah/edit/{id}', [StokHadiahController::class, 'edit']);
    Route::post('/stok_hadiah/update/{id}', [StokHadiahController::class, 'update']);
    Route::get('/stok_hadiah/delete/{id}', [StokHadiahController::class, 'delete']);
    Route::get('/stok_hadiah/cari', [StokHadiahController::class, 'search']);
});

Route::controller(RiwayatRedeemController::class)->group(function() {
    Route::get('/riwayat_redeem',[RiwayatRedeemController::class, 'index'])->name('riwayat_redeem.index');
    Route::get('/riwayat_redeem/detail/{id_redeem}', [RiwayatRedeemController::class, 'detail']);
    Route::get('/riwayat_redeem/cari', [RiwayatRedeemController::class, 'search']);
    Route::get('/riwayat_redeem/filterdate', [RiwayatRedeemController::class, 'filterDate'])->name('filterDate_redeem');
});