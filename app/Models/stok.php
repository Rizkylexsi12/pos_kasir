<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class stok extends Model
{
    public function alldata(){
        return DB::table('stoks')->get();
    }

    public function addData($data){
        return DB::table('stoks')->insert($data);
    }

    public function deleteData($id){
        return DB::table('stoks')
                -> where('id', $id)
                -> delete();
    }

    public function detailData($id){
        return DB::table('stoks')->where('id', $id)-> first();
    }

    public function editData($id, $data){
        return DB::table('stoks')->where('id', $id)->update($data);
    }
}