<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Http\Request;

class LaporanWargaController extends Controller
{
    public function create()
    {
        return view('warga.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_pelapor' => 'required|string|max:100',
            'no_hp'        => 'required|string|max:20',
            'lokasi'       => 'required|string|max:255',
            'kecamatan'    => 'required|string|max:100',
            'tinggi_air'   => 'required|integer|min:1',
            'keterangan'   => 'nullable|string',
            'foto'         => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'required' => ':attribute wajib diisi.',
            'image'    => ':attribute harus berupa gambar.',
            'mimes'    => ':attribute harus berformat jpg, jpeg, atau png.',
            'max'      => ':attribute maksimal :max KB.',
            'integer'  => ':attribute harus berupa angka.',
            'min'      => ':attribute minimal :min.',
        ], [
            'nama_pelapor' => 'Nama pelapor',
            'no_hp'        => 'No. HP',
            'lokasi'       => 'Desa/Kelurahan',
            'kecamatan'    => 'Kecamatan',
            'tinggi_air'   => 'Tinggi genangan',
            'keterangan'   => 'Keterangan',
            'foto'         => 'Foto',
        ]);

        $validated['foto'] = $request->file('foto')->store('laporan', 'public');

        Laporan::create($validated);

        return redirect()->route('lapor.create')
            ->with('success', 'Laporan berhasil dikirim. Terima kasih!');
    }
}