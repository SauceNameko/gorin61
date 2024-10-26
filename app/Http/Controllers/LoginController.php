<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //
    public function login()
    {
        return view("login");
    }
    public function check(Request $request)
    {
        $user = $request->only(["email", "password"]);
        if (Auth::attempt($user)) {
            $request->session()->regenerate();
            return redirect(route("dashboard"));
        }
        return back()->with(["message" => "メールアドレスまたはパスワードが正しくありません"]);
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->flush();
        return redirect(route("login"));
    }
}
