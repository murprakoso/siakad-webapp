<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Show the form for editing the profile.
     */
    public function edit()
    {
        return view('profile.edit');
    }

    /**
     * Update the profile in storage.
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        // Validasi input
        $validatedData = $request->validate([
            'username' => 'required|string|max:255|unique:tb_users,username,' . $user->id,
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'no_hp' => 'nullable|string|max:20',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        try {
            // Update data user
            $user->username = $validatedData['username'];
            $user->nama_lengkap = $validatedData['nama_lengkap'];
            // $user->email = $validatedData['email'] ?? $user->email;
            // $user->no_hp = $validatedData['no_hp'] ?? $user->no_hp;
            $user->email = $validatedData['email'];
            $user->no_hp = $validatedData['no_hp'];

            // Update foto jika diupload
            if ($request->hasFile('foto')) {
                // Hapus foto lama jika ada
                if ($user->foto) {
                    Storage::delete($user->foto);
                }
                $user->foto = $request->file('foto')->store('profile_photos', 'public');
            }

            // Simpan data
            $user->save();

            return redirect()->route('profile.edit')->with('success', 'Profil berhasil diperbarui.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage()]);
        }
    }
}
