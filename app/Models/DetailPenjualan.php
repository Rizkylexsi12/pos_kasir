<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DetailPenjualan extends Model
{
    public function alldata(){
        return DB::table('detail_penjualans')->get();
    }
}
