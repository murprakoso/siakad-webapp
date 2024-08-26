<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class NilaiSiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Siswa::query(); // Mengambil data absensi beserta relasi dengan siswa

            return DataTables::of($data)
                ->addIndexColumn()
                // ->addColumn('siswa', function ($row) {
                //     return $row->siswa->nama_lengkap; // Tampilkan nama siswa
                // })
                ->addColumn('action', function ($row) {
                    $detailRoute = route('nilai-siswa.show', $row->id); // Route Detail Absensi
                    $editRoute = route('nilai-siswa.edit', $row->id);   // Route Edit Absensi
                    // $deleteRoute = route('absensi-siswa.destroy', $row->id); // Route Delete Absensi
    
                    return Helper::actionButtons($detailRoute, $editRoute, null);
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        // $kelas = Kelas::pluck('nama_kelas', 'id');
        $kelas = Kelas::all();
        return view('nilai-siswa.index', compact('kelas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
