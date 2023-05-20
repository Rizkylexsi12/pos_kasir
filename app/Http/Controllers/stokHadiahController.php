<?php

namespace App\Http\Controllers;

use App\Models\stokHadiah;
use Illuminate\Http\Request;

class stokHadiahController extends Controller
{
    protected $stokHadiah;

    public function __construct(){
        $this->stokHadiah = new stokHadiah();
    }

    public function index(){
        return view('7_Stok_hadiah/stok_hadiah', [
            'stokHadiah' => $this->stokHadiah->alldata()
        ]);
    }

    public function insert(){
        Request()->validate([
            'barcode' => 'required',
            'nama_barang' => 'required|max:255',
            'poin' => 'required',
            'qty' => 'required',
        ],[
            'barcode.required' => 'Wajib diisi!!',
            'nama_barang.required' => 'Wajib diisi!!',
            'poin.required' => 'Wajib diisi!!',
            'qty.required' => 'Wajib diisi!!'
        ]);

        $data = [
            'barcode' => Request()-> barcode,
            'nama_barang' => Request()-> nama_barang,
            'poin' => Request()-> poin,
            'qty' => Request()-> qty,
        ];

        $this->stokHadiah->addData($data);
        return redirect()-> route('stok_hadiah')-> with('pesan','Data Berhasil ditambahkan!!');
    }

    public function detail($id){
        if(!$this->stokHadiah->detailData($id)){
            abort(404);
        }
        
        $data = [
            'stokHadiah' => $this->stokHadiah->detailData($id)
        ];

        return view('7_Stok_hadiah/detail_stok_hadiah', $data);
    }

    public function edit($id){
        if(!$this->stokHadiah->detailData($id)){
            abort(404);
        }
        
        $data = [
            'stokHadiah' => $this->stokHadiah->detailData($id)
        ];

        return view('7_Stok_hadiah/edit_stok_hadiah', $data);
    }

    public function update($id){
        Request()->validate([
            'barcode' => 'required',
            'nama_barang' => 'required|max:255',
            'poin' => 'required',
            'qty' => 'required',
        ],[
            'barcode.required' => 'Wajib diisi!!',
            'nama_barang.required' => 'Wajib diisi!!',
            'poin.required' => 'Wajib diisi!!',
            'qty.required' => 'Wajib diisi!!'
        ]);

        $data = [
            'barcode' => Request()-> barcode,
            'nama_barang' => Request()-> nama_barang,
            'poin' => Request()-> poin,
            'qty' => Request()-> qty,
        ];

        $this->stokHadiah->editData($id, $data);
        return redirect()-> route('stok_hadiah')-> with('pesan','Data Berhasil diupdate!!');
    }

    public function delete($id){
        $this->stokHadiah->deleteData($id);

        return redirect()->route('stok_hadiah')->with('pesan', 'Data berhasil dihapus!!');
    }

    public function search(Request $request){
	    $cari = $request->cari;
        
        $barang = stokHadiah::where('nama_barang', 'like', '%' . $cari . '%')
                ->orWhere('barcode', 'like', '%' . $cari . '%')
                ->orWhere('poin', 'like', '%' . $cari . '%')
                ->paginate(10);
        
        if ($barang->isEmpty()) {
            $message = "Maaf, Hadiah yang anda dicari tidak ada";
            return view('7_Stok_hadiah/stok_hadiah',[
                'message' => $message,
                'cari' => $cari
            ]);
        } else {
	    return view('7_Stok_hadiah/stok_hadiah',[
            'stokHadiah' => $barang,
            'cari' => $cari
        ]);
        }
    }
}