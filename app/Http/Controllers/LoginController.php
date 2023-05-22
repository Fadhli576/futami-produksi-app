<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function authanticate(Request $request)
    {

        $login = $request->validate([
            'no_hp' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($login)) {
            $request->session()->regenerate();
            if (Auth::user()->role_id == '2' || Auth::user()->role == '3') {
                Alert::success('Sukses', 'Login sukses');
                return redirect()->intended('/dashboard');
            } else {
                Alert::success('Sukses', 'Login sukses');
                return redirect()->intended('/dashboard');
            }
        }
        Alert::error('Gagal', 'Login gagal, cek no hp atau password anda');
        return redirect('/login');
    }

    public function logout(Request $request)
{
    Auth::logout();
    Alert::success('Sukses', 'Logout sukses');
    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect('/');
}
}
