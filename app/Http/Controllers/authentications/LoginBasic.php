<?php

namespace App\Http\Controllers\authentications;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginBasic extends Controller
{
  
  public function index()
  {
    return view('content.authentications.auth-login-basic');
  }

  public  function login(LoginRequest $request)
  {
    $userData = $request->only('email', 'password');

    if (Auth::attempt($userData)) {
      return view('content/dashboard/welcome');
    }else{
        return back()->withErrors(['password' => 'Սխալ մուտքանուն կամ գաղտնաբառ'])->withInput();
    }
  }

  public function logout(Request $request) {
    Auth::logout();

    return redirect('/');
  }
}