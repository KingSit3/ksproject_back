<?php

namespace App\Http\Controllers\zakat;

use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDF;

class FitrahController extends Controller
{
    public function index($jenis)
    {
      // get id from Sanctum Middleware with guard helper
      $user = Auth::guard('sanctum')->user();
      
      if ($user->tokenCan('app:zakat')) {
        $fitrah = DB::connection('zakat')->table('fitrah')
                    ->where(['jenis' => $jenis, 'deleted_at' => null])
                    ->paginate(10);

        return response($fitrah, 200);
      }

      return response('Forbidden', 403);
      
    }

    public function store(Request $req)
    {
      // get id from Sanctum Middleware with guard helper
      $user = Auth::guard('sanctum')->user();
      
      if ($user->tokenCan('app:zakat')){
        $req->validate([
          'nama' => 'required|max:100',
          'jenis' => 'required|max:5',
          'jumlah' => 'required|numeric',
          'no_telp' => 'max:25',
        ]);
  
        try {
          DB::connection('zakat')->table('fitrah')->insert([
            'nama' => $req['nama'],
            'no_telp' => $req['no_telp'],
            'jenis' => $req['jenis'],
            'jumlah' => $req['jumlah'],
            'created_at' => now(),
            'updated_at' => now(),
          ]);
          return response('Data Disimpan', 201);
  
        } catch (QueryException $ex) {
          return response($ex, 400);
        }
      }
      return response('Forbidden', 403);

    }

    public function search($jenis, $keyword)
    {
      // get id from Sanctum Middleware with guard helper
      $user = Auth::guard('sanctum')->user();
      if ($user->tokenCan('app:zakat')){
        $fitrah = DB::connection('zakat')->table('fitrah')->where([
                                              'jenis' => $jenis, 
                                              'deleted_at' => null,
                                            ])
                                    ->where('nama', 'like', '%'.$keyword.'%')
                                    ->paginate(10);
  
        return response($fitrah, 200);
      }
      return response('Forbidden', 403);
    }

    public function searchDeleted($keyword)
    {
      // get id from Sanctum Middleware with guard helper
      $user = Auth::guard('sanctum')->user();
      if ($user->tokenCan('app:zakat') && $user->tokenCan('zakat:admin')){
        $fitrah = DB::connection('zakat')->table('fitrah')
                      ->where('deleted_at', '!=', null)
                      ->where('nama', 'like', '%'.$keyword.'%')
                      ->paginate(10);
  
        return response($fitrah, 200);
      }
      return response('Forbidden', 403);
    }

    public function update(Request $req, $id)
    {
      // get id from Sanctum Middleware with guard helper
      $user = Auth::guard('sanctum')->user();
      if ($user->tokenCan('app:zakat')){
        $req->validate([
          'nama' => 'required|max:100',
          'jenis' => 'required|max:5',
          'jumlah' => 'required|numeric',
          'no_telp' => 'max:25'
        ]);
  
        try {
          DB::connection('zakat')->table('fitrah')->where('id', $id)->update([
            'nama' => $req['nama'],
            'no_telp' => $req['no_telp'],
            'jenis' => $req['jenis'],
            'jumlah' => $req['jumlah'],
            'updated_at' => now(),
          ]);
          return response('Data Disimpan', 201);
  
        } catch (QueryException $ex) {
          return response($ex, 400);
        }
      }
      return response('Forbidden', 403);
    }

    public function softDelete($id)
    {
      // get id from Sanctum Middleware with guard helper
      $user = Auth::guard('sanctum')->user();
      if ($user->tokenCan('app:zakat')){
        try {
  
          DB::connection('zakat')->table('fitrah')->where('id', $id)->update([
            'deleted_at' => now()
          ]);
          return response('Data berhasil terhapus', 200);
  
        } catch (QueryException $ex) {
          return response('Ups, Something went wrong '.$ex, 400);
        }
      }
      return response('Forbidden', 403);

      
    }

    public function deleted()
    {
      // get id from Sanctum Middleware with guard helper
      $user = Auth::guard('sanctum')->user();
      if ($user->tokenCan('app:zakat') && $user->tokenCan('zakat:admin')){
        $deletedFitrah = DB::connection('zakat')->table('fitrah')->where('deleted_at', '!=', null)->paginate(10);
  
        return response($deletedFitrah, 200);
      }
      return response('Forbidden', 403);
    }

    public function restore($id)  
    {
      // get id from Sanctum Middleware with guard helper
      $user = Auth::guard('sanctum')->user();
      if ($user->tokenCan('app:zakat') && $user->tokenCan('zakat:admin')){
        try {
          DB::connection('zakat')->table('fitrah')->where('id', '=', $id)->update([
            'deleted_at' => null
          ]);
  
          return response('success', 200);
  
        } catch (QueryException $ex) {
          return response('Ups Something wen wrong error:'.$ex, 400);
        }
      }
      return response('Forbidden', 403);

    }

    public function export(){
      $currentYear = date('Y');

      $zakatUang = DB::connection('zakat')->table('fitrah')
                        ->where('jenis', 'uang')
                        ->where('deleted_at',  '=', null)
                        ->whereYear('updated_at', '=', date('Y'))
                        ->sum('jumlah');
      $zakatBeras = DB::connection('zakat')->table('fitrah')
                        ->where('jenis', 'beras')
                        ->where('deleted_at',  '=', null)
                        ->whereYear('updated_at', '=', date('Y'))
                        ->sum('jumlah');

      $totalMuzakki = DB::connection('zakat')->table('fitrah')
                        ->where('deleted_at', '=' , null)
                        ->whereYear('updated_at', '=', $currentYear)
                        ->count();
      $dataZakat = DB::connection('zakat')->table('fitrah')
      ->where('deleted_at',  '=', null)
      ->whereYear('updated_at', '=', date('Y'))
      ->get();

      $data = [
        'year' => $currentYear,
        'totalMuzakki' => $totalMuzakki,
        'totalZakatUang' => 'Rp.'.number_format($zakatUang,0, ',' , '.'),
        'totalZakatBeras' => $zakatBeras,
        'dataZakat' => $dataZakat
      ];

      // return view('zakat.fitrah', $data);

      $pdf = PDF::loadView('zakat.fitrah', $data);
      return $pdf->download('Fitrah Al-Istiqomah - '.$currentYear.'.pdf');
    }
}

