<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OperatorAuthController extends Controller
{
    public function create()
    {
        return view('auth.operator.login');
    }

    public function store(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        if (Auth::guard('operator')->attempt(['username' => $credentials['username'], 'password' => $credentials['password']])) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        return back()->withErrors([
            'username' => 'Username atau password salah.',
        ]);
    }

    public function destroy(Request $request)
    {
        Auth::guard('operator')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('operator.login');
    }
}
