<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HadiahModel;

class HadiahController extends Controller
{
    protected $hadiah;

    public function __construct(){
        $this->hadiah = new HadiahModel();
    }
}
