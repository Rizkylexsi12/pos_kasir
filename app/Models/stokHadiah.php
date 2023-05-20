<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class stokHadiah extends Model 
{
    protected $table = 'stok_hadiah';
    protected $guarded = [];

    public function alldata(){
        return $this->paginate(10);
    }

    public function addData($data){
        return $this->create($data);
    }

    public function detailData($id){
        return $this->find($id);
    }

    public function editData($id, $data){
        $stokHadiah = $this->find($id);
        $stokHadiah->update($data);
        return $stokHadiah;
    }

    public function deleteData($id){
        return $this->destroy($id);
    }
}