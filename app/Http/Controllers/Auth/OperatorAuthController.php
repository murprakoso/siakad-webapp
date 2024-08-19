<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
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
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            // $request->validate([
            'username' => 'required|string|max:255',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::where('username', $request->username)->first();

        if (!$user) {
            // Jika username tidak ditemukan
            return back()->withErrors([
                'username' => 'Username tidak ditemukan.',
            ])->withInput();
        }

        if (auth()->attempt($request->only('username', 'password'))) {
            $request->session()->regenerate();

            return redirect()->intended('/dashboard');
        }

        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ]);
    }
}
