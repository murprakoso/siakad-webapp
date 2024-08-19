<?php

namespace App\Http\Controllers;

use App\Models\Agama;
use App\Models\Siswa;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DataSiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('data-siswa.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $agamaOptions = Agama::pluck('agama', 'id');
        return view('data-siswa.form', compact('agamaOptions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data yang masuk
        $validatedData = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'nisn' => 'required|string|max:20|unique:tb_siswa,nisn',
            'password' => 'required|string|min:6',
            'tanggal_masuk' => 'nullable|date',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
            'id_agama' => 'required|exists:tb_agama,id',
            'tempat_lahir' => 'nullable|string|max:255',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'nullable|string|max:500',
            'no_hp' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255|unique:tb_siswa,email',
            'asal_sekolah' => 'required|string|max:255',
            'jurusan' => 'required|in:IPA,IPS',
            'status' => 'required|in:aktif,non-aktif',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        try {
            // Simpan data siswa
            $siswa = new Siswa();
            $siswa->nama_lengkap = $validatedData['nama_lengkap'];
            $siswa->nisn = $validatedData['nisn'];
            $siswa->password = Hash::make($validatedData['password']);
            $siswa->tanggal_masuk = $validatedData['tanggal_masuk'];
            $siswa->jenis_kelamin = $validatedData['jenis_kelamin'];
            $siswa->id_agama = $validatedData['id_agama'];
            $siswa->tempat_lahir = $validatedData['tempat_lahir'];
            $siswa->tanggal_lahir = $validatedData['tanggal_lahir'];
            $siswa->alamat = $validatedData['alamat'];
            $siswa->no_hp = $validatedData['no_hp'];
            $siswa->email = $validatedData['email'];
            $siswa->asal_sekolah = $validatedData['asal_sekolah'];
            $siswa->jurusan = $validatedData['jurusan'];
            $siswa->status = $validatedData['status'];

            // Simpan file foto jika ada
            if ($request->hasFile('foto')) {
                $fotoPath = $request->file('foto')->store('foto_siswa', 'public');
                $siswa->foto = $fotoPath;
            }

            $siswa->save();

            return redirect()->route('data-siswa.index')->with('success', 'Data siswa berhasil disimpan.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi data yang masuk
        $validatedData = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'nisn' => 'required|string|max:20|unique:tb_siswa,nisn,' . $id,
            'password' => 'nullable|string|min:6',
            'tanggal_masuk' => 'nullable|date',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
            'id_agama' => 'required|exists:tb_agama,id',
            'tempat_lahir' => 'nullable|string|max:255',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'nullable|string|max:500',
            'no_hp' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255|unique:tb_siswa,email,' . $id,
            'asal_sekolah' => 'required|string|max:255',
            'jurusan' => 'required|in:IPA,IPS',
            'status' => 'required|in:aktif,non-aktif',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        try {
            // Ambil data siswa berdasarkan ID
            $siswa = Siswa::findOrFail($id);

            // Update data siswa
            $siswa->nama_lengkap = $validatedData['nama_lengkap'];
            $siswa->nisn = $validatedData['nisn'];

            // Update password hanya jika diisi
            if (!empty($validatedData['password'])) {
                $siswa->password = Hash::make($validatedData['password']);
            }

            $siswa->tanggal_masuk = $validatedData['tanggal_masuk'];
            $siswa->jenis_kelamin = $validatedData['jenis_kelamin'];
            $siswa->id_agama = $validatedData['id_agama'];
            $siswa->tempat_lahir = $validatedData['tempat_lahir'];
            $siswa->tanggal_lahir = $validatedData['tanggal_lahir'];
            $siswa->alamat = $validatedData['alamat'];
            $siswa->no_hp = $validatedData['no_hp'];
            $siswa->email = $validatedData['email'];
            $siswa->asal_sekolah = $validatedData['asal_sekolah'];
            $siswa->jurusan = $validatedData['jurusan'];
            $siswa->status = $validatedData['status'];

            // Jika ada update foto, hapus foto lama dan simpan foto baru
            if ($request->hasFile('foto')) {
                // Hapus foto lama jika ada
                if ($siswa->foto && Storage::disk('public')->exists($siswa->foto)) {
                    Storage::disk('public')->delete($siswa->foto);
                }

                // Simpan foto baru
                $fotoPath = $request->file('foto')->store('foto_siswa', 'public');
                $siswa->foto = $fotoPath;
            }

            // Simpan perubahan
            $siswa->save();

            return redirect()->route('data-siswa.index')->with('success', 'Data siswa berhasil diperbarui.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Terjadi kesalahan saat memperbarui data: ' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
