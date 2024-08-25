<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class GuruAuthController extends Controller
{
    public function create()
    {
        return view('auth.guru.login');
    }

    public function store(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        if (Auth::guard('guru')->attempt(['username' => $credentials['username'], 'password' => $credentials['password']])) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        return back()->withErrors([
            'username' => 'Username atau password salah.',
        ]);
    }

    public function destroy(Request $request)
    {
        Auth::guard('guru')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('guru.login');
    }
}
