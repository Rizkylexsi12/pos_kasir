<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stok extends Model
{
    protected $table = 'stoks';

    public function alldata(){
        return $this->paginate(10);
    }

    public function addData($data){
        return $this->insert($data);
    }

    public function deleteData($id){
        return $this->where('id', $id)->delete();
    }

    public function detailData($id){
        return $this->where('id', $id)->first();
    }

    public function editData($id, $data){
        return $this->where('id', $id)->update($data);
    }
}