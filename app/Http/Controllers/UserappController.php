<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserappController extends Controller
{
    public function daftar(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8',
            ]);
    
            // Buat pengguna baru
            $user = User::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => bcrypt($validatedData['password']), // Enkripsi password
            ]);
    
            return response()->json(['message' => 'Registrasi berhasil'], 201);
        } catch (\Exception $e) {
            // Tangani pengecualian di sini
            return response()->json(['message' => 'Registrasi gagal'], 500);
        }
    }
    

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            return response()->json([
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
            ]);
        }

        return response()->json(['message' => 'Login failed'], 401);
    }

    
}
