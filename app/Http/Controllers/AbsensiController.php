<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Absensi;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class AbsensiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            // Ambil data dari model Absensi
            $data = Siswa::query(); // Mengambil data absensi beserta relasi dengan siswa

            return DataTables::of($data)
                ->addIndexColumn()
                // ->addColumn('siswa', function ($row) {
                //     return $row->siswa->nama_lengkap; // Tampilkan nama siswa
                // })
                ->addColumn('action', function ($row) {
                    $detailRoute = route('absensi-siswa.show', $row->id); // Route Detail Absensi
                    $editRoute = route('absensi-siswa.edit', $row->id);   // Route Edit Absensi
                    // $deleteRoute = route('absensi-siswa.destroy', $row->id); // Route Delete Absensi
    
                    return Helper::actionButtons($detailRoute, $editRoute, null);
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('data-absensi.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $siswaOptions = Siswa::pluck('nama_lengkap', 'id'); // Pilihan siswa untuk dropdown
        return view('data-absensi.form', compact('siswaOptions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data yang masuk
        $validatedData = $request->validate([
            'id_siswa' => 'required|exists:tb_siswa,id',
            'tanggal' => 'required|date',
            'status' => 'required|in:hadir,izin,sakit,alpha', // Ubah sesuai dengan status yang valid
        ]);

        try {
            // Simpan data absensi
            $absensi = new Absensi();
            $absensi->id_siswa = $validatedData['id_siswa'];
            $absensi->tanggal = $validatedData['tanggal'];
            $absensi->status = $validatedData['status'];
            $absensi->save();

            return redirect()->route('data-absensi.index')->with('success', 'Data absensi berhasil disimpan.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // try {
        $absensi = Absensi::with('siswa')->findOrFail($id);
        return view('data-absensi.detail', compact('absensi'));
        // } catch (\Exception $e) {
        //     return redirect()->route('absensi-siswa.index')->withErrors(['error' => 'Data tidak ditemukan: ' . $e->getMessage()]);
        // }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $siswaOptions = Siswa::pluck('nama_lengkap', 'id');
        $absensi = Absensi::findOrFail($id);
        return view('data-absensi.form', compact('siswaOptions', 'absensi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi data yang masuk
        $validatedData = $request->validate([
            'id_siswa' => 'required|exists:tb_siswa,id',
            'tanggal' => 'required|date',
            'status' => 'required|in:hadir,izin,sakit,alpha', // Ubah sesuai dengan status yang valid
        ]);

        try {
            // Ambil data absensi berdasarkan ID
            $absensi = Absensi::findOrFail($id);

            // Update data absensi
            $absensi->id_siswa = $validatedData['id_siswa'];
            $absensi->tanggal = $validatedData['tanggal'];
            $absensi->status = $validatedData['status'];
            $absensi->save();

            return redirect()->route('data-absensi.index')->with('success', 'Data absensi berhasil diperbarui.');
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
            $absensi = Absensi::findOrFail($id);
            $absensi->delete();

            return redirect()->route('data-absensi.index')->with('success', 'Data absensi berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('data-absensi.index')->withErrors(['error' => 'Terjadi kesalahan saat menghapus data: ' . $e->getMessage()]);
        }
    }
}
