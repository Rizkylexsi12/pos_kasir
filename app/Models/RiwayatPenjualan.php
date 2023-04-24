<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RiwayatPenjualan extends Model
{
    public function alldata(){
        return DB::table('riwayat_penjualans')->get();
    }
}
