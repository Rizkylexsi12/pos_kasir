<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class riwayatRedeem extends Model
{
    public function alldata(){
        return DB::table('riwayat_redeems')->get();
    }
}
