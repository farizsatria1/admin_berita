<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login()
    {
        // Periksa apakah pengguna sudah masuk (authenticated)
        if (Auth::check()) {
            if (Auth::user()->role == 'admin') {
                return redirect()->route('berita.index');
            } else {
                return view('login');
            }
        } else {
            return view('login');
        }
    }

    public function actionlogin(Request $request)
    {
        // Validasi input form login
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        // Coba melakukan autentikasi pengguna
        if (Auth::attempt($credentials)) {
            // Periksa peran pengguna setelah berhasil login
            if (Auth::user()->role == 'admin') {
                return redirect()->route('berita.index')->with('success','Anda berhasil Login'); // Ganti 'berita.index' dengan rute yang sesuai untuk admin
            } else {
                return view('login');
            }
        } else {
            // Jika autentikasi gagal, kembalikan ke halaman login
            return redirect()->route('login')->with('error', 'Email atau password salah');
        }
    }

    public function actionlogout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
