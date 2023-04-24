<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Customer;
use Illuminate\Http\Request;

class dataCustomerController extends Controller
{
    protected $dataCustomermodel;

    public function __construct(){
        $this->dataCustomermodel = new customer();
    }

    public function index(){
        return view('4_Data_customer/data_customer', [
            'customer' => DB::table('customers')->paginate(10)
        ]);
    }

    public function add(){
        return view('4_Data_customer/add_customer');
    }

    public function insert(){
        Request()->validate([
            'nama_customer' => 'required|max:255',
            // 'nama_anak' => 'required',
            // 'alamat' => 'required',
            'no_telp' => 'required'
        ],[
            'nama_customer.required' => 'Wajib diisi!!',
            'nama_anak.required' => 'Wajib diisi!!',
            'alamat.required' => 'Wajib diisi!!',
            'no_telp.required' => 'Wajib diisi!!'
        ]);

        $data = [
            'nama_customer' => Request()-> nama_customer,
            'nama_anak' => Request()-> nama_anak,
            'alamat' => Request()-> alamat,
            'no_telp' => Request()-> no_telp,
        ];

        $this->dataCustomermodel->addData($data);
        return redirect()-> route('data_customer')-> with('pesan','Data Berhasil ditambahkan!!');
    }

    public function detail($id_customer){
        if(!$this->dataCustomermodel->detailData($id_customer)){
            abort(404);
        }
        
        $data = [
            'customer' => $this->dataCustomermodel->detailData($id_customer)
        ];

        return view('4_Data_customer/detail_customer', $data);
    }

    public function edit($id_customer){
        if(!$this->dataCustomermodel->detailData($id_customer)){
            abort(404);
        }

        $data = [
            'customer' => $this->dataCustomermodel->detailData($id_customer)
        ];

        return view('4_Data_customer/edit_customer', $data);
    }

    public function update($id_customer){
        Request()->validate([
            'nama_customer' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required',
        ],[
            'nama_customer.required' => 'Wajib diisi!!',
            'alamat.required' => 'Wajib diisi!!',
            'no_telp.required' => 'Wajib diisi!!'
        ]);

        $data = [
            'nama_customer' => Request()-> nama_customer,
            'nama_anak' => Request()-> nama_anak,
            'alamat' => Request()-> alamat,
            'no_telp' => Request()-> no_telp,
        ];

        $this->dataCustomermodel->editData($id_customer, $data);
        return redirect()-> route('data_customer')-> with('pesan','Data Berhasil diupdate!!');
    }

    public function delete($id_customer){
        $this->dataCustomermodel->deleteData($id_customer);

        return redirect()->route('data_customer')->with('pesan', 'Data berhasil dihapus!!');
    }

    public function search(Request $request){
	    $cari = $request->cari;
        
	    $customers = DB::table('customers')
	    ->where('nama_customer','like',"%".$cari."%")
        ->orWhere('nama_anak', 'like', "%$cari%")
	    ->paginate(10);
        
        if ($customers->isEmpty()) {
            $message = "Maaf, Customer yang anda dicari tidak ada";
            return view('4_Data_customer/data_customer',[
                'message' => $message,
                'cari' => $cari
            ]);
        } else {
	    return view('4_Data_customer/data_customer',[
            'customer' => $customers,
            'cari' => $cari
        ]);
        }
    }
}
