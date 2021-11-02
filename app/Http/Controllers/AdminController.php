<?php

namespace App\Http\Controllers;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
   public function index()
   {
    // get id from Sanctum Middleware with guard helper
    $user = Auth::guard('sanctum')->user();
    
    if ($user->tokenCan('app:zakat') && $user->tokenCan('zakat:admin')) {
      $admin = DB::table('users')->get();

      return response($admin, 200);
    }
    return response('Forbidden', 403);
  }

  public function store(Request $req){

    $user = Auth::guard('sanctum')->user();
    
    if ($user->tokenCan('app:zakat') && $user->tokenCan('zakat:admin')) {
      $req->validate([
        'name' => 'required',
        'email' => 'required|unique:users,email',
        'password' => 'required|min:5',
        'role' => 'required'
      ]);
      
      try {
        DB::table('users')->insert([
          'name' => $req['name'],
          'email' => $req['email'],
          'password' => Hash::make($req['password']),
          'role' => $req['role'],
        ]);

        return response('Berhasil', 201);

      } catch (QueryException $ex) {
        return response('Ups, Something went wrong', 400);
      }
    }
    return response('Forbidden', 403);
  }

  public function delete($id){
    $user = Auth::guard('sanctum')->user();
    if ($user->tokenCan('app:zakat') && $user->tokenCan('zakat:admin')) {

      try {
        DB::table('users')->where('id', $id)->delete();

        return response('Data berhasil dihapus', 200);

      } catch (QueryException $ex) {
        return response($ex, 400);
      }

    }
    return response('Forbidden' ,403);
  }

  public function update(Request $req, $id){
    $user = Auth::guard('sanctum')->user();
    if ($user->tokenCan('app:zakat') && $user->tokenCan('zakat:admin')) {
      $req->validate([
        'name' => 'required',
        'email' => ['required', 'email', Rule::unique('users',  'email')->ignore($id)],
        'password' => 'required|min:5',
        'role' => 'required'
      ]);

      try {
        DB::table('users')->where('id', $id)->update([
          'name' => $req['name'],
          'email' => $req['email'],
          'password' => Hash::make($req['password']),
          'role' => $req['role'],
        ]);

        return response('Data berhasil Diubah', 200);

      } catch (QueryException $ex) {
        return response($ex, 400);
      }

    }
    return response('Forbidden' ,403);
  }
}
