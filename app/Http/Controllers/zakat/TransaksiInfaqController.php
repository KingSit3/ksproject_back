<?php

namespace App\Http\Controllers\zakat;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransaksiInfaqController extends Controller
{
  public function index(){
    $user = Auth::guard('sanctum')->user();

    if ($user->tokenCan('app:zakat')) {
       $transaksi = DB::connection('zakat')
                        ->table('transaksi_infaq')
                        ->paginate(10);

        return response($transaksi, 200);
    }

    return response("Dare?", 401);
  }

  public function store(Request $req){
    $user = Auth::guard('sanctum')->user();

    if ($user->tokenCan('app:zakat')) {
        $req->validate([
            'keterangan' => 'required',
            'jumlah' => 'required',
        ]);

        try {
            DB::connection('zakat')->table('transaksi_infaq')->insert([
                'ket' => $req['keterangan'],
                'jumlah' => $req['jumlah'],
                'updated_at' => now()
            ]);
            return response('berhasil', 201);

        } catch (QueryException $ex) {
            return response($ex, 400);
        }

    }

    return response('Dare?!', 401);
  }

  public function delete($id){
    $user = Auth::guard('sanctum')->user();

    if ($user->tokenCan('app:zakat')) {
        try {
            DB::connection('zakat')->table('transaksi_infaq')->where('id', $id)->delete();

            return response("Berhasil dihapus", 200);
        } catch (QueryException $ex) {
            return response($ex, 400);
        }
    }

    return response('Dare?!', 401);
  }

  public function update(Request $req, $id){
    $user = Auth::guard('sanctum')->user();

    if ($user->tokenCan('app:zakat')) {
        $req->validate([
          'keterangan' => 'required',
          'jumlah' => 'required',
        ]);

        try {
            DB::connection('zakat')->table('transaksi_infaq')->where('id', $id)->update([
              'ket' => $req['keterangan'],
              'jumlah' => $req['jumlah'],
              'updated_at' => now()
            ]);
            return response('berhasil', 201);

        } catch (QueryException $ex) {
            return response($ex, 400);
        }

    }

    return response('Dare?!', 401);
  }

  public function search(Request $req){

    $user = Auth::guard('sanctum')->user();

    $startDate = $req['startDate'] ? $req['startDate'].' 00:00:00' : Carbon::now()->startOfYear();
    $endDate = $req['endDate'] ? $req['endDate'].' 23:59:59' : now();

    if ($user->tokenCan('app:zakat')) {
       $transaksi = DB::connection('zakat')
                        ->table('transaksi_infaq')
                        ->whereBetween('created_at', [$startDate, $endDate])
                        ->paginate(10);

        return response($transaksi, 200);
    }

    return response("Dare?", 401);
  }

}
