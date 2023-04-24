<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class customer extends Model
{
    public function alldata(){
        return DB::table('customers')->get();
    }

    public function addData($data){
        return DB::table('customers')->insert($data);
    }

    public function deleteData($id){
        DB::table('customers')
        -> where('id', $id)
        -> delete();
    }

    public function detailData($id){
        return DB::table('customers')->where('id', $id)-> first();
    }

    public function editData($id, $data){
        return DB::table('customers')->where('id', $id)->update($data);
    }
}
