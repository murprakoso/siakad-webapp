<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Guru;
use App\Models\Mapel;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class MapelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            // Ambil data dari model Mapel
            $data = Mapel::with('guru')->get(); // Mengambil data mapel beserta relasi dengan guru

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('guru', function ($row) {
                    return $row->guru->nama_lengkap; // Tampilkan nama guru
                })
                ->addColumn('action', function ($row) {
                    $detailRoute = route('data-mapel.show', $row->id); // Route Detail Mapel
                    $editRoute = route('data-mapel.edit', $row->id);   // Route Edit Mapel
                    $deleteRoute = route('data-mapel.destroy', $row->id); // Route Delete Mapel
    
                    return Helper::actionButtons($detailRoute, $editRoute, $deleteRoute);
                })
                ->rawColumns(['action', 'guru'])
                ->make(true);
        }

        return view('data-mapel.index');
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $guruOptions = Guru::pluck('nama_lengkap', 'id'); // Pilihan guru untuk dropdown
        return view('data-mapel.form', compact('guruOptions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data yang masuk
        $validatedData = $request->validate([
            'id_guru' => 'required|exists:tb_guru,id',
            'kode_mapel' => 'required|string|max:20|unique:tb_mapel,kode_mapel',
            'nama_mapel' => 'required|string|max:200',
            'jurusan' => 'nullable|in:IPA,IPS',
        ]);

        try {
            // Simpan data mapel
            $mapel = new Mapel();
            $mapel->id_guru = $validatedData['id_guru'];
            $mapel->kode_mapel = $validatedData['kode_mapel'];
            $mapel->nama_mapel = $validatedData['nama_mapel'];
            $mapel->jurusan = $validatedData['jurusan'];
            $mapel->save();

            return redirect()->route('data-mapel.index')->with('success', 'Data mapel berhasil disimpan.');
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
            $mapel = Mapel::with('guru')->findOrFail($id);
            return view('data-mapel.detail', compact('mapel'));
        } catch (\Exception $e) {
            return redirect()->route('data-mapel.index')->withErrors(['error' => 'Data tidak ditemukan: ' . $e->getMessage()]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $guruOptions = Guru::pluck('nama_lengkap', 'id');
        $data_mapel = Mapel::findOrFail($id);
        return view('data-mapel.form', compact('guruOptions', 'data_mapel'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi data yang masuk
        $validatedData = $request->validate([
            'id_guru' => 'required|exists:tb_guru,id',
            'kode_mapel' => 'required|string|max:20|unique:tb_mapel,kode_mapel,' . $id,
            'nama_mapel' => 'required|string|max:200',
            'jurusan' => 'nullable|in:IPA,IPS',
        ]);

        try {
            // Ambil data mapel berdasarkan ID
            $mapel = Mapel::findOrFail($id);

            // Update data mapel
            $mapel->id_guru = $validatedData['id_guru'];
            $mapel->kode_mapel = $validatedData['kode_mapel'];
            $mapel->nama_mapel = $validatedData['nama_mapel'];
            $mapel->jurusan = $validatedData['jurusan'];
            $mapel->save();

            return redirect()->route('data-mapel.index')->with('success', 'Data mapel berhasil diperbarui.');
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
            $mapel = Mapel::findOrFail($id);
            $mapel->delete();

            return redirect()->route('data-mapel.index')->with('success', 'Data mapel berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('data-mapel.index')->withErrors(['error' => 'Terjadi kesalahan saat menghapus data: ' . $e->getMessage()]);
        }
    }
}
