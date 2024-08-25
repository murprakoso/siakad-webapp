<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        if (Auth::guard('siswa')->check()) {
            $user = Auth::guard('siswa')->user();
        } elseif (Auth::guard('guru')->check()) {
            $user = Auth::guard('guru')->user();
        } elseif (Auth::guard('operator')->check()) {
            $user = Auth::guard('operator')->user();
        } else {
            return redirect()->url('/');
        }

        // Mengirim data user ke view
        return view('dashboard.index', compact('user'));
    }
}
