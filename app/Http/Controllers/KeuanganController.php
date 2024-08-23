<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Keuangan;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class KeuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            // Ambil data dari model Keuangan beserta relasi siswa
            $data = Keuangan::with('siswa')->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('siswa', function ($row) {
                    return $row->siswa->nama_lengkap; // Tampilkan nama siswa
                })
                ->addColumn('jumlah_pembayaran', function ($row) {
                    // Format jumlah pembayaran dengan helper
                    return Helper::formatCurrency($row->jumlah_pembayaran);
                })
                ->addColumn('status_pembayaran', function ($row) {
                    $statusOptions = Keuangan::getStatusOptions();
                    $statusLabel = $statusOptions[$row->status_pembayaran] ?? ucfirst($row->status_pembayaran);

                    // Tentukan warna badge berdasarkan status pembayaran dengan menggunakan if-else
                    $badgeColor = '';
                    if ($row->status_pembayaran === 'lunas') {
                        $badgeColor = 'badge-success';
                    } elseif ($row->status_pembayaran === 'menunggak') {
                        $badgeColor = 'badge-danger';
                    } elseif ($row->status_pembayaran === 'belum_bayar') {
                        $badgeColor = 'badge-warning';
                    } else {
                        $badgeColor = 'badge-secondary';
                    }

                    // Tampilkan status pembayaran dengan badge Bootstrap
                    return "<span class='badge {$badgeColor}'>{$statusLabel}</span>";
                })
                ->addColumn('action', function ($row) {
                    $detailRoute = route('data-keuangan-siswa.show', $row->id); // Route Detail Keuangan
                    $editRoute = route('data-keuangan-siswa.edit', $row->id);   // Route Edit Keuangan
                    $deleteRoute = route('data-keuangan-siswa.destroy', $row->id); // Route Delete Keuangan
    
                    return Helper::actionButtons($detailRoute, $editRoute, $deleteRoute);
                })
                ->rawColumns(['action', 'siswa', 'status_pembayaran'])
                ->make(true);
        }

        return view('data-keuangan-siswa.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $siswaOptions = Siswa::pluck('nama_lengkap', 'id'); // Pilihan siswa untuk dropdown
        $statusOptions = Keuangan::getStatusOptions();
        return view('data-keuangan-siswa.form', compact('siswaOptions', 'statusOptions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data yang masuk
        $validatedData = $request->validate([
            'id_siswa' => 'required|exists:tb_siswa,id',
            'jumlah_pembayaran' => 'required|numeric|min:0',
            'tanggal_pembayaran' => 'required|date',
            'status_pembayaran' => 'required|in:belum_bayar,lunas,menunggak',
        ]);

        try {
            // Simpan data keuangan siswa
            $keuangan = new Keuangan();
            $keuangan->id_siswa = $validatedData['id_siswa'];
            $keuangan->jumlah_pembayaran = $validatedData['jumlah_pembayaran'];
            $keuangan->tanggal_pembayaran = $validatedData['tanggal_pembayaran'];
            $keuangan->status_pembayaran = $validatedData['status_pembayaran'];
            $keuangan->save();

            return redirect()->route('data-keuangan-siswa.index')->with('success', 'Data keuangan siswa berhasil disimpan.');
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
            $keuangan = Keuangan::with('siswa')->findOrFail($id);
            $keuangan->tanggal_pembayaran = \Carbon\Carbon::parse($keuangan->tanggal_pembayaran)->format('d-m-Y');
            return view('data-keuangan-siswa.detail', compact('keuangan'));
        } catch (\Exception $e) {
            return redirect()->route('data-keuangan-siswa.index')->withErrors(['error' => 'Data tidak ditemukan: ' . $e->getMessage()]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $siswaOptions = Siswa::pluck('nama_lengkap', 'id');
        $keuangan = Keuangan::findOrFail($id);
        $statusOptions = Keuangan::getStatusOptions();
        return view('data-keuangan-siswa.form', compact('siswaOptions', 'keuangan', 'statusOptions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi data yang masuk
        $validatedData = $request->validate([
            'id_siswa' => 'required|exists:tb_siswa,id',
            'jumlah_pembayaran' => 'required|numeric|min:0',
            'tanggal_pembayaran' => 'required|date',
            'status_pembayaran' => 'required|in:belum_bayar,lunas,menunggak',
        ]);

        try {
            // Ambil data keuangan berdasarkan ID
            $keuangan = Keuangan::findOrFail($id);

            // Update data keuangan siswa
            $keuangan->id_siswa = $validatedData['id_siswa'];
            $keuangan->jumlah_pembayaran = $validatedData['jumlah_pembayaran'];
            $keuangan->tanggal_pembayaran = $validatedData['tanggal_pembayaran'];
            $keuangan->status_pembayaran = $validatedData['status_pembayaran'];
            $keuangan->save();

            return redirect()->route('data-keuangan-siswa.index')->with('success', 'Data keuangan siswa berhasil diperbarui.');
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
            $keuangan = Keuangan::findOrFail($id);
            $keuangan->delete();

            return redirect()->route('data-keuangan-siswa.index')->with('success', 'Data keuangan siswa berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('data-keuangan-siswa.index')->withErrors(['error' => 'Terjadi kesalahan saat menghapus data: ' . $e->getMessage()]);
        }
    }
}
