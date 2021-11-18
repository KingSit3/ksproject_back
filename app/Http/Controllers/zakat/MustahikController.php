<?php

namespace App\Http\Controllers\zakat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MustahikController extends Controller
{
    public function index()
    {
      // get id from Sanctum Middleware with guard helper
      $user = Auth::guard('sanctum')->user();
      
      if ($user->tokenCan('app:zakat')) {
        $mustahik = DB::connection('zakat')->table('mustahik')
                    ->where('deleted_at', '=', NULL)
                    ->paginate(10);

        return response($mustahik, 200);
      }

      return response('Forbidden', 403);
      
    }
}
