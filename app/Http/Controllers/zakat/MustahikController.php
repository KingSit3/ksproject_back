<?php

namespace App\Http\Controllers\zakat;

use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
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
                    ->paginate(2);

        return response($mustahik, 200);
      }

      return response('Forbidden', 403);
      
    }

    public function store(Request $req)
    {
      $user = Auth::guard('sanctum')->user();

      if ($user->tokenCan('app:zakat')){
        $req->validate([
          'namaKeluarga' => 'required',
          'alamat' => 'required',
          'rt' => 'required',
          'rw' => 'required',
          'kecamatan' => 'required',
          'kelurahan' => 'required',
          'jumlahAnggotaKeluarga' => 'required',
        ]);

        try {
          DB::connection('zakat')->table('mustahik')->insert([
            'nama_keluarga' => $req['namaKeluarga'],
            'alamat' => $req['alamat'],
            'rt' => $req['rt'],
            'rw' => $req['rw'],
            'kecamatan' => $req['kecamatan'],
            'kelurahan' => $req['kelurahan'],
            'jumlah_anggota_keluarga' => $req['jumlahAnggotaKeluarga'],
          ]);
          return response($req, 201);

        } catch (QueryException $ex) {
          return response($ex, 400);
        }
      }
      return response('Dare?', 401);
    }

    public function deleted()
    {
      // get id from Sanctum Middleware with guard helper
      $user = Auth::guard('sanctum')->user();
      
      if ($user->tokenCan('app:zakat')) {
        $mustahik = DB::connection('zakat')->table('mustahik')
                    ->where('deleted_at', '!=', NULL)
                    ->paginate(10);

        return response($mustahik, 200);
      }

      return response('Forbidden', 403);
      
    }
}
