<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Guru;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            // Ambil data dari model Kelas
            $data = Kelas::with('waliKelas')->get(); // Mengambil data kelas beserta relasi dengan wali kelas

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('wali_kelas', function ($row) {
                    return $row->waliKelas->nama_lengkap; // Tampilkan nama wali kelas
                })
                ->addColumn('action', function ($row) {
                    $detailRoute = route('daftar-kelas.show', $row->id); // Route Detail Kelas
                    $editRoute = route('daftar-kelas.edit', $row->id);   // Route Edit Kelas
                    $deleteRoute = route('daftar-kelas.destroy', $row->id); // Route Delete Kelas
    
                    return Helper::actionButtons($detailRoute, $editRoute, $deleteRoute);
                })
                ->rawColumns(['action', 'wali_kelas'])
                ->make(true);
        }

        return view('daftar-kelas.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $guruOptions = Guru::pluck('nama_lengkap', 'id'); // Pilihan wali kelas untuk dropdown
        return view('daftar-kelas.form', compact('guruOptions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data yang masuk
        $validatedData = $request->validate([
            'nama_kelas' => 'required|string|max:200',
            'tingkat' => 'required|string|in:X,XI,XII',
            'wali_kelas_id' => 'required|exists:tb_guru,id',
        ]);

        try {
            // Simpan data kelas
            $kelas = new Kelas();
            $kelas->nama_kelas = $validatedData['nama_kelas'];
            $kelas->tingkat = $validatedData['tingkat'];
            $kelas->wali_kelas_id = $validatedData['wali_kelas_id'];
            $kelas->save();

            return redirect()->route('daftar-kelas.index')->with('success', 'Data kelas berhasil disimpan.');
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
            $kelas = Kelas::with('waliKelas')->findOrFail($id);
            return view('daftar-kelas.detail', compact('kelas'));
        } catch (\Exception $e) {
            return redirect()->route('daftar-kelas.index')->withErrors(['error' => 'Data tidak ditemukan: ' . $e->getMessage()]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $guruOptions = Guru::pluck('nama_lengkap', 'id');
        $kelas = Kelas::findOrFail($id);
        return view('daftar-kelas.form', compact('guruOptions', 'kelas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi data yang masuk
        $validatedData = $request->validate([
            'nama_kelas' => 'required|string|max:200',
            'tingkat' => 'required|string|in:X,XI,XII',
            'wali_kelas_id' => 'required|exists:tb_guru,id',
        ]);

        try {
            // Ambil data kelas berdasarkan ID
            $kelas = Kelas::findOrFail($id);

            // Update data kelas
            $kelas->nama_kelas = $validatedData['nama_kelas'];
            $kelas->tingkat = $validatedData['tingkat'];
            $kelas->wali_kelas_id = $validatedData['wali_kelas_id'];
            $kelas->save();

            return redirect()->route('daftar-kelas.index')->with('success', 'Data kelas berhasil diperbarui.');
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
            $kelas = Kelas::findOrFail($id);
            $kelas->delete();

            return redirect()->route('daftar-kelas.index')->with('success', 'Data kelas berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('daftar-kelas.index')->withErrors(['error' => 'Terjadi kesalahan saat menghapus data: ' . $e->getMessage()]);
        }
    }
}
