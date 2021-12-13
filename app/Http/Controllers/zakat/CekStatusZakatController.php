<?php

namespace App\Http\Controllers\zakat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Routing\Middleware\ThrottleRequests;
use Illuminate\Support\Facades\DB;

class CekStatusZakatController extends Controller
{
    public function index($noTelp){

        $muzaki = DB::connection('zakat')
                        ->table('fitrah')
                        ->where('deleted_at', '=', null)
                        ->where('no_telp', '=', $noTelp)
                        ->get();

        return response($muzaki, 200);
    }
}
