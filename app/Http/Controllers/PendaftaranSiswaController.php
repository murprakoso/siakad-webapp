<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Agama;
use App\Models\PendaftaranSiswa;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Storage;
use Yajra\DataTables\DataTables;

class PendaftaranSiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            // Mengambil data pendaftaran siswa baru beserta relasi ke tabel siswa
            $data = PendaftaranSiswa::with('siswa');

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('foto', function ($row) {
                    // Jika ada foto, tampilkan dengan tag img, jika tidak tampilkan gambar default
                    if ($row->siswa && $row->siswa->foto) {
                        // Mengambil URL foto dari penyimpanan publik
                        // $fotoUrl = Storage::disk('public')->url($row->siswa->foto);
                        $fotoUrl = asset('storage/' . $row->siswa->foto);
                    } else {
                        // Jika tidak ada foto, gunakan gambar default
                        $fotoUrl = asset('dist/img/undraw_profile.svg');
                    }

                    // Tampilkan gambar dengan class thumbnail
                    return "<img src='{$fotoUrl}' alt='Foto Siswa' class='img-thumbnail' style='max-width: 100px; max-height: 100px;'>";
                })
                ->addColumn('status', function ($row) {
                    // Tentukan warna badge berdasarkan status dengan menggunakan if-else
                    $badgeColor = '';
                    if ($row->status === 'diterima') {
                        $badgeColor = 'badge-success';
                    } elseif ($row->status === 'ditolak') {
                        $badgeColor = 'badge-danger';
                    } elseif ($row->status === 'terdaftar') {
                        $badgeColor = 'badge-primary';
                    } else {
                        $badgeColor = 'badge-secondary';
                    }

                    // Tampilkan status dengan badge Bootstrap
                    return "<span class='badge {$badgeColor}'>" . ucfirst($row->status) . "</span>";
                })
                ->addColumn('action', function ($row) {
                    $detailRoute = route('pendaftaran-siswa.show', $row->id); // Route Detail
                    $editRoute = route('pendaftaran-siswa.edit', $row->id);   // Route Edit
                    $deleteRoute = route('pendaftaran-siswa.destroy', $row->id); // Route Delete
    
                    return Helper::actionButtons($detailRoute, $editRoute, $deleteRoute);
                })
                ->rawColumns(['action', 'foto', 'status'])
                ->make(true);
        }
        return view('pendaftaran-siswa.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $agamaOptions = Agama::pluck('agama', 'id');
        return view('pendaftaran-siswa.form', compact('agamaOptions'));
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
            // 'tanggal_masuk' => 'nullable|date',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
            'id_agama' => 'required|exists:tb_agama,id',
            'tempat_lahir' => 'nullable|string|max:255',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'nullable|string|max:500',
            'no_hp' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255|unique:tb_siswa,email',
            'asal_sekolah' => 'required|string|max:255',
            // 'jurusan' => 'nullable|in:IPA,IPS',
            'status' => 'required|in:aktif,non-aktif',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        try {
            // Simpan data siswa
            $siswa = new Siswa();
            $siswa->nama_lengkap = $validatedData['nama_lengkap'];
            $siswa->nisn = $validatedData['nisn'];
            $siswa->password = Hash::make($validatedData['password']);
            // $siswa->tanggal_masuk = $validatedData['tanggal_masuk'];
            $siswa->jenis_kelamin = $validatedData['jenis_kelamin'];
            $siswa->id_agama = $validatedData['id_agama'];
            $siswa->tempat_lahir = $validatedData['tempat_lahir'];
            $siswa->tanggal_lahir = $validatedData['tanggal_lahir'];
            $siswa->alamat = $validatedData['alamat'];
            $siswa->no_hp = $validatedData['no_hp'];
            $siswa->email = $validatedData['email'];
            $siswa->asal_sekolah = $validatedData['asal_sekolah'];
            // $siswa->jurusan = $validatedData['jurusan'];
            $siswa->status = $validatedData['status'];

            // Simpan file foto jika ada
            if ($request->hasFile('foto')) {
                $fotoPath = $request->file('foto')->store('foto_siswa', 'public');
                $siswa->foto = $fotoPath;
            }

            $siswa->save();

            // Simpan data pendaftaran siswa baru
            PendaftaranSiswa::create([
                'id_siswa' => $siswa->id,
                'tanggal_pendaftaran' => now(),
                'status' => 'terdaftar',
            ]);

            return redirect()->route('pendaftaran-siswa.index')->with('success', 'Data siswa berhasil disimpan.');
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
            $siswa = PendaftaranSiswa::with('siswa')->findOrFail($id);
            $siswa->tanggal_lahir = \Carbon\Carbon::parse($siswa->tanggal_lahir)->format('d-m-Y');
            return view('pendaftaran-siswa.detail', compact('siswa'));
        } catch (\Exception $e) {
            return redirect()->route('pendaftaran-siswa.index')->withErrors(['error' => 'Data tidak ditemukan: ' . $e->getMessage()]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $agamaOptions = Agama::pluck('agama', 'id');
        $data_siswa = PendaftaranSiswa::with('siswa')->findOrFail($id);
        // dd($data_siswa);
        return view('pendaftaran-siswa.form', compact('agamaOptions', 'data_siswa'));
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
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
            'id_agama' => 'required|exists:tb_agama,id',
            'tempat_lahir' => 'nullable|string|max:255',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'nullable|string|max:500',
            'no_hp' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255|unique:tb_siswa,email,' . $id,
            'asal_sekolah' => 'required|string|max:255',
            'status' => 'required|in:aktif,non-aktif',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        try {
            // Temukan data siswa yang akan diupdate
            $siswa = Siswa::findOrFail($id);
            $siswa->nama_lengkap = $validatedData['nama_lengkap'];
            $siswa->nisn = $validatedData['nisn'];

            // Update password jika diberikan
            if (!empty($validatedData['password'])) {
                $siswa->password = Hash::make($validatedData['password']);
            }

            $siswa->jenis_kelamin = $validatedData['jenis_kelamin'];
            $siswa->id_agama = $validatedData['id_agama'];
            $siswa->tempat_lahir = $validatedData['tempat_lahir'];
            $siswa->tanggal_lahir = $validatedData['tanggal_lahir'];
            $siswa->alamat = $validatedData['alamat'];
            $siswa->no_hp = $validatedData['no_hp'];
            $siswa->email = $validatedData['email'];
            $siswa->asal_sekolah = $validatedData['asal_sekolah'];
            $siswa->status = $validatedData['status'];

            // Simpan file foto jika ada
            if ($request->hasFile('foto')) {
                // Hapus foto lama jika ada
                if ($siswa->foto) {
                    Storage::disk('public')->delete($siswa->foto);
                }

                $fotoPath = $request->file('foto')->store('foto_siswa', 'public');
                $siswa->foto = $fotoPath;
            }

            $siswa->save();

            return redirect()->route('pendaftaran-siswa.index')->with('success', 'Data siswa berhasil diperbarui.');
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
            $pendaftaranSiswa = PendaftaranSiswa::findOrFail($id);

            // Hapus data terkait jika diperlukan
            // Misalnya, jika ada file atau relasi yang perlu dihapus, tambahkan di sini

            $pendaftaranSiswa->delete();

            return redirect()->route('pendaftaran-siswa.index')->with('success', 'Data pendaftaran siswa berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('pendaftaran-siswa.index')->withErrors(['error' => 'Terjadi kesalahan saat menghapus data: ' . $e->getMessage()]);
        }
    }
}
