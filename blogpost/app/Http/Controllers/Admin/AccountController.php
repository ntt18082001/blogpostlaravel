<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function login()
    {
        if(Auth::check()){
            return view('Admin.index');
        }
        return view("Admin.account.login");
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.account.login');
    }
    function auth(Request $request)
    {
        $user = User::where('username', '=', $request->username)->first();
        $loginFail = redirect()
            ->back()
            ->with("login-err-msg", "Account is not valid!");
        if ($user == null) {
            return $loginFail;
        }
        $userData = [
            'username' => $request->username,
            'password' => $request->password
        ];
        if (Auth::attempt($userData)) {
            $request->session()->regenerate();
            return redirect()->route("admin.home.index");
        } else {
            return $loginFail;
        }
    }
}
