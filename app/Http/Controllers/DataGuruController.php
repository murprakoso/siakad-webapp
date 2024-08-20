<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Agama;
use App\Models\Guru;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class DataGuruController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            // Ambil data dari model Guru
            $data = Guru::query();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $detailRoute = route('data-guru.show', $row->id); // Route Detail Guru
                    $editRoute = route('data-guru.edit', $row->id);   // Route Edit Guru
                    $deleteRoute = route('data-guru.destroy', $row->id); // Route Delete Guru
    
                    return Helper::actionButtons($detailRoute, $editRoute, $deleteRoute);
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('data-guru.index');
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $agamaOptions = Agama::pluck('agama', 'id');
        return view('data-guru.form', compact('agamaOptions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data yang masuk
        $validatedData = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:tb_guru,username',
            'password' => 'required|string|min:6',
            'nip' => 'nullable|string|max:20|unique:tb_guru,nip',
            'jabatan_akademik' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'id_agama' => 'required|exists:tb_agama,id',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'nullable|string|max:500',
            'no_hp' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255|unique:tb_guru,email',
            'status' => 'required|in:Aktif,Non-aktif',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        try {
            // Simpan data guru
            $guru = new Guru();
            $guru->nama_lengkap = $validatedData['nama_lengkap'];
            $guru->username = $validatedData['username'];
            $guru->password = Hash::make($validatedData['password']);
            $guru->nip = $validatedData['nip'];
            $guru->jabatan_akademik = $validatedData['jabatan_akademik'];
            $guru->jenis_kelamin = $validatedData['jenis_kelamin'];
            $guru->id_agama = $validatedData['id_agama'];
            $guru->tempat_lahir = $validatedData['tempat_lahir'];
            $guru->tanggal_lahir = $validatedData['tanggal_lahir'];
            $guru->alamat = $validatedData['alamat'];
            $guru->no_hp = $validatedData['no_hp'];
            $guru->email = $validatedData['email'];
            $guru->status = $validatedData['status'];

            // Simpan file foto jika ada
            if ($request->hasFile('foto')) {
                $fotoPath = $request->file('foto')->store('foto_guru', 'public');
                $guru->foto = $fotoPath;
            }

            $guru->save();

            return redirect()->route('data-guru.index')->with('success', 'Data guru berhasil disimpan.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage()]);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $guru = Guru::findOrFail($id);
            $guru->tanggal_lahir = \Carbon\Carbon::parse($guru->tanggal_lahir)->format('d-m-Y');
            return view('data-guru.detail', compact('guru'));
        } catch (\Exception $e) {
            return redirect()->route('data-guru.index')->withErrors(['error' => 'Data tidak ditemukan: ' . $e->getMessage()]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $agamaOptions = Agama::pluck('agama', 'id');
        $data_guru = Guru::findOrFail($id);
        return view('data-guru.form', compact('agamaOptions', 'data_guru'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi data yang masuk
        $validatedData = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:tb_guru,username,' . $id,
            'password' => 'nullable|string|min:6',
            'nip' => 'nullable|string|max:20|unique:tb_guru,nip,' . $id,
            'jabatan_akademik' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'id_agama' => 'required|exists:tb_agama,id',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'nullable|string|max:500',
            'no_hp' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255|unique:tb_guru,email,' . $id,
            'status' => 'required|in:Aktif,Non-aktif',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        try {
            // Ambil data guru berdasarkan ID
            $guru = Guru::findOrFail($id);

            // Update data guru
            $guru->nama_lengkap = $validatedData['nama_lengkap'];
            $guru->username = $validatedData['username'];
            $guru->nip = $validatedData['nip'];
            $guru->jabatan_akademik = $validatedData['jabatan_akademik'];
            $guru->jenis_kelamin = $validatedData['jenis_kelamin'];
            $guru->id_agama = $validatedData['id_agama'];
            $guru->tempat_lahir = $validatedData['tempat_lahir'];
            $guru->tanggal_lahir = $validatedData['tanggal_lahir'];
            $guru->alamat = $validatedData['alamat'];
            $guru->no_hp = $validatedData['no_hp'];
            $guru->email = $validatedData['email'];
            $guru->status = $validatedData['status'];

            // Update password hanya jika diisi
            if (!empty($validatedData['password'])) {
                $guru->password = Hash::make($validatedData['password']);
            }

            // Jika ada update foto, hapus foto lama dan simpan foto baru
            if ($request->hasFile('foto')) {
                // Hapus foto lama jika ada
                if ($guru->foto && Storage::disk('public')->exists($guru->foto)) {
                    Storage::disk('public')->delete($guru->foto);
                }

                // Simpan foto baru
                $fotoPath = $request->file('foto')->store('foto_guru', 'public');
                $guru->foto = $fotoPath;
            }

            // Simpan perubahan
            $guru->save();

            return redirect()->route('data-guru.index')->with('success', 'Data guru berhasil diperbarui.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Terjadi kesalahan saat memperbarui data: ' . $e->getMessage()]);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $guru = Guru::findOrFail($id);

            if ($guru->foto) {
                Storage::disk('public')->delete($guru->foto);
            }

            $guru->delete();

            return redirect()->route('data-guru.index')->with('success', 'Data guru berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('data-guru.index')->withErrors(['error' => 'Terjadi kesalahan saat menghapus data: ' . $e->getMessage()]);
        }
    }
}
