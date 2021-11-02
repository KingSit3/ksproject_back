<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(Request $req)
    {
      $req->validate([
        'email' => 'required|email',
        'password' => 'required',
      ]);

      $user = User::where('email', $req->email)->first();
      
      if ($user) {
        $userRole = ($user['role'] == 0 ? ['app:zakat', 'zakat:admin'] : ['app:zakat', 'zakat:staff']);
        if (Hash::check($req['password'], $user['password'])) {
          
          DB::table('users')->where('id', $user['id'])->update([
            'last_login' => now()
          ]);

          return response([  
                            'name' => $user['name'],
                            'role' => ($user['role'] == 1) ? 'staff' : 'admin' ,
                            'token' => $user->createToken('Kingsit_Approve_this', $userRole)->plainTextToken
                          ], 200) ;
        }
      }

      return response('Dare?!', 418);
    }

    public function logout(Request $req)
    {
      $user = User::where('name', $req->name)->first();

      $user->tokens()->delete();
    }
}
