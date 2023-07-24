<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Customer extends Model
{
    protected $table = 'customers';

    public function alldata(){
        return $this->paginate(10);
        // return DB::table('customers')->get();
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
