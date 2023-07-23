<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\riwayatRedeem;
use Illuminate\Support\Facades\DB;

class riwayatRedeemController extends Controller
{
    protected $riwayatRedeem;
    
    public function __construct(){
        $this->riwayatRedeem = new riwayatRedeem();
    }

    public function index(){
        return view('6_Riwayat_redeem/riwayat_redeem', [
            'riwayatRedeem' => DB::table('riwayat_redeems')->orderByDesc('created_at')->paginate(10)
        ]);
    }

    public function detail($id_redeem){
        $detailRedeem = DB::table('detail_redeems')->where('id_redeem', $id_redeem)->get();
        $riwayatRedeem = DB::table('riwayat_redeems')->where('id', $id_redeem)->first();
        return view('6_Riwayat_redeem/detail_riwayat_redeem', [
            'detailRedeem' => $detailRedeem,
            'riwayatRedeem' => $riwayatRedeem
        ]);
    }

    public function search(Request $request){
	    $cari = $request->cari;
        
	    $customer = DB::table('riwayat_redeems')
	    ->where('nama_customer','like',"%".$cari."%")
        ->orWhere('nomor_telepon', 'like', "%$cari%")
        ->orderByDesc('created_at')
	    ->paginate(10);
        
        if ($customer->isEmpty()) {
            $message = "Maaf, Customer yang anda dicari tidak ada";
            return view('6_Riwayat_redeem/riwayat_redeem',[
                'message' => $message,
                'cari' => $cari
            ]);
        } else {
	    return view('6_Riwayat_redeem/riwayat_redeem',[
            'riwayatRedeem' => $customer,
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
            $posts = riwayatRedeem::whereBetween('created_at', [$startDate, $endDate])
                ->orderBy('created_at', 'desc')
                ->paginate(10);
        } else {
            $posts = riwayatRedeem::orderBy('created_at', 'desc')->paginate(10);
        };

        $posts->appends(['start_date' => $startDate, 'end_date' => $endDate]);
        
        return view('6_Riwayat_redeem/riwayat_redeem', [
            'riwayatRedeem' => $posts,
            'startDate' => $startDate,
            'endDate' => $viewEndDate
        ]);
    }
}
