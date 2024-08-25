<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class SiswaAuthController extends Controller
{
    public function create()
    {
        return view('auth.siswa.login');
    }

    public function store(Request $request)
    {
        $credentials = $request->validate([
            'nisn' => 'required|string',
            'password' => 'required|string',
        ]);

        if (Auth::guard('siswa')->attempt(['nisn' => $credentials['nisn'], 'password' => $credentials['password']])) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        return back()->withErrors([
            'nisn' => 'NISN atau password salah.',
        ]);
    }

    public function destroy(Request $request)
    {
        Auth::guard('siswa')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('siswa.login');
    }
}
