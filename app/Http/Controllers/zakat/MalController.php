<?php

namespace App\Http\Controllers\zakat;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MalController extends Controller
{
    public function index($jenis)
    {
      $user = Auth::guard('sanctum')->user();
      if ($user->tokenCan('app:zakat')){
        $mal = DB::connection('zakat')
                      ->table('mal')
                      ->join('users', 'mal.user_id', '=', 'users.id')
                      ->select('mal.*', 'users.name')
                      ->where(['jenis' => $jenis, 'deleted_at' => null])
                      ->paginate(10);
  
        return response($mal, 200);
      }
      return response('Forbidden', 403);
    }

    public function store(Request $req)
    {
      $user = Auth::guard('sanctum')->user();
      if ($user->tokenCan('app:zakat')){
        $req->validate(
          // Rules
          [
          'nama' => 'required|max:100',
          'jenis' => 'required|max:50',
          'data' => 'required',
          'total' => 'required',
          ]
        );
  
        try {
          $user = User::create([
            'name' => $req['nama'],
            'role' => 2,
          ]);

          DB::connection('zakat')->table('mal')->insert([
            'user_id' => $user->id,
            'jenis' => $req['jenis'],
            'data' => json_encode($req['data']),
            'total' => $req['total'],
            'created_at' => now(),
            'updated_at' => now(),
          ]);
          return response('Data Berhasil Disimpan', 201);
  
        } catch (QueryException $ex) {
          return response($ex, 400);
        }
      }
      return response('Forbidden', 403);
    }

    public function search($jenis, $keyword)
    {
      $user = Auth::guard('sanctum')->user();
      if ($user->tokenCan('app:zakat')){
        $mal = DB::connection('zakat')
                  ->table('mal')
                  ->join('users', 'mal.user_id', '=', 'users.id')
                  ->select('mal.*', 'users.name')
                  ->where([
                    'jenis' => $jenis, 
                    'deleted_at' => null,
                  ])
                  ->where('name', 'like', '%'.$keyword.'%')
                  ->paginate(10);
  
        return response($mal, 200);
      }
      return response('Forbidden', 403);
    }

    public function softDelete($id)
    {
      $user = Auth::guard('sanctum')->user();
      if ($user->tokenCan('app:zakat')){
        try {
          DB::connection('zakat')->table('mal')->where('id', $id)->update([
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
      $user = Auth::guard('sanctum')->user();
      if ($user->tokenCan('app:zakat') && $user->tokenCan('zakat:admin')){
        $deletedMal = DB::connection('zakat')
                        ->table('mal')
                        ->where('deleted_at', '!=', null)
                        ->join('users', 'mal.user_id', '=', 'users.id')
                        ->select('mal.*', 'users.name')
                        ->paginate(10);
  
        return response($deletedMal, 200);
      }
      return response('Forbidden', 403);
    }

    public function searchDeleted($keyword)
    {
      $user = Auth::guard('sanctum')->user();
      if ($user->tokenCan('app:zakat') && $user->tokenCan('zakat:admin')){
        $mal = DB::connection('zakat')
                      ->table('mal')
                      ->join('users', 'mal.user_id', '=', 'users.id')
                      ->select('mal.*', 'users.name')
                      ->where('deleted_at', '!=', null)
                      ->where('name', 'like', '%'.$keyword.'%')
                      ->paginate(10);
        return response($mal, 200);
      }
      return response('Forbidden', 403);
    }

    public function restore($id)  
    {
      $user = Auth::guard('sanctum')->user();
      if ($user->tokenCan('app:zakat') && $user->tokenCan('zakat:admin')){
        try {
          DB::connection('zakat')->table('mal')->where('id', '=', $id)->update([
            'deleted_at' => null
          ]);
  
          return response('success', 200);
  
        } catch (QueryException $ex) {
          return response('Ups Something wen wrong error:'.$ex, 400);
        }
      }
      return response('Forbidden', 403);
    }
}