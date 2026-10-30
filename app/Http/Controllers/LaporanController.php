<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LaporanController extends Controller
{
    public function index()
    {
        $laporans = Laporan::latest()->paginate(10);

        return view('laporan.index', compact('laporans'));
    }

    // Tambah data dilakukan warga lewat form publik
    public function create()
    {
        return redirect()->route('lapor.create');
    }

    public function store(Request $request)
    {
        return redirect()->route('lapor.create');
    }

    public function show(Laporan $laporan)
    {
        return view('laporan.show', compact('laporan'));
    }

    public function edit(Laporan $laporan)
    {
        return view('laporan.edit', compact('laporan'));
    }

    public function update(Request $request, Laporan $laporan)
    {
        $validated = $request->validate([
            'nama_pelapor' => 'required|string|max:100',
            'no_hp'        => 'required|string|max:20',
            'lokasi'       => 'required|string|max:255',
            'kecamatan'    => 'required|string|max:100',
            'tinggi_air'   => 'required|integer|min:1',
            'keterangan'   => 'nullable|string',
            'status'       => 'required|in:Menunggu,Diproses,Selesai',
            'foto'         => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'required' => ':attribute wajib diisi.',
            'image'    => ':attribute harus berupa gambar.',
            'mimes'    => ':attribute harus berformat jpg, jpeg, atau png.',
            'max'      => ':attribute maksimal :max KB.',
            'integer'  => ':attribute harus berupa angka.',
            'min'      => ':attribute minimal :min.',
            'in'       => ':attribute tidak valid.',
        ], [
            'nama_pelapor' => 'Nama pelapor',
            'no_hp'        => 'No. HP',
            'lokasi'       => 'Desa/Kelurahan',
            'kecamatan'    => 'Kecamatan',
            'tinggi_air'   => 'Tinggi genangan',
            'keterangan'   => 'Keterangan',
            'foto'         => 'Foto',
            'status'       => 'Status',
        ]);

        // Jika ada foto baru: hapus foto lama, lalu simpan yang baru
        if ($request->hasFile('foto')) {
            if ($laporan->foto) {
                Storage::disk('public')->delete($laporan->foto);
            }
            $validated['foto'] = $request->file('foto')->store('laporan', 'public');
        }

        $laporan->update($validated);

        return redirect()->route('laporan.index')
            ->with('success', 'Laporan berhasil diperbarui.');
    }

    public function destroy(Laporan $laporan)
    {
        // Hapus file foto dari storage ikut laporan
        if ($laporan->foto) {
            Storage::disk('public')->delete($laporan->foto);
        }

        $laporan->delete();

        return redirect()->route('laporan.index')
            ->with('success', 'Laporan berhasil dihapus.');
    }
}