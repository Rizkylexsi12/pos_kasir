<?php

namespace App\Http\Controllers;
use App\Models\RiwayatPenjualan;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class riwayatpenjualanController extends Controller
{
    protected $riwayatpenjualan;
    
    public function __construct(){
        $this->riwayatpenjualan = new RiwayatPenjualan();
    }

    public function index(){
        return view('2_Riwayat_penjualan/riwayat_penjualan', [
            'riwayatpenjualan' => DB::table('riwayat_penjualans')->orderByDesc('created_at')->paginate(10)
        ]);
    }

    public function detail($id_penjualan)
    {
        $detailPenjualan = DB::table('detail_penjualans')->where('id_penjualan', $id_penjualan)->get();
        $riwayatpenjualan = DB::table('riwayat_penjualans')->where('id', $id_penjualan)->first();
        return view('2_Riwayat_penjualan/detail_penjualan', [
            'detailpenjualan' => $detailPenjualan,
            'riwayatpenjualan' => $riwayatpenjualan
        ]);
    }

    public function search(Request $request){
	    $cari = $request->cari;
        
	    $customer = DB::table('riwayat_penjualans')
	    ->where('nama_pembeli','like',"%".$cari."%")
        ->orWhere('nomor_telepon', 'like', "%$cari%")
	    ->paginate(10);
        
        if ($customer->isEmpty()) {
            $message = "Maaf, Customer yang anda dicari tidak ada";
            return view('2_Riwayat_penjualan/riwayat_penjualan',[
                'message' => $message,
                'cari' => $cari
            ]);
        } else {
	    return view('2_Riwayat_penjualan/riwayat_penjualan',[
            'riwayatpenjualan' => $customer,
            'cari' => $cari
        ]);
        }
    }
    
    public function filterDate(Request $request){
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $endDate = date('Y-m-d', strtotime($endDate . ' +1 day'));
        $viewEndDate = date('Y-m-d', strtotime($endDate . ' -1 day'));

        if ($startDate && $endDate) {
            // $posts->appends(['start_date' => $startDate, 'end_date' => $endDate])
            $posts = RiwayatPenjualan::whereBetween('created_at', [$startDate, $endDate])
                ->orderBy('created_at', 'desc')
                ->paginate(10);
        } else {
            $posts = RiwayatPenjualan::orderBy('created_at', 'desc')->paginate(10);
        };

        $posts->appends(['start_date' => $startDate, 'end_date' => $endDate]);
        
        return view('2_Riwayat_penjualan/riwayat_penjualan', [
            'riwayatpenjualan' => $posts,
            'startDate' => $startDate,
            'endDate' => $viewEndDate
        ]);
    }
}