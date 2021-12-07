<?php

namespace App\Http\Controllers\zakat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TransaksiInfaqController extends Controller
{
    public function index(){
      return response('Transaksi Infaq', 200);
    }
}
