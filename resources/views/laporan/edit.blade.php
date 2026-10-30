@extends('layouts.lapor')

@section('title', 'Edit Laporan')

@section('content')
@php
    $input = 'w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-blue-500 focus:ring-blue-500';
    $kecamatans = ['Arjasari','Baleendah','Banjaran','Bojongsoang','Cangkuang','Cicalengka','Cikancung',
        'Cilengkrang','Cileunyi','Cimaung','Cimenyan','Ciparay','Ciwidey','Dayeuhkolot','Ibun','Katapang',
        'Kertasari','Kutawaringin','Majalaya','Margaasih','Margahayu','Nagreg','Pacet','Pameungpeuk',
        'Pangalengan','Paseh','Pasirjambu','Rancabali','Rancaekek','Solokanjeruk','Soreang'];
@endphp

<div class="max-w-3xl mx-auto bg-white rounded-2xl shadow-lg p-8">
    <h1 class="text-xl font-bold text-slate-900">Edit Laporan #{{ $laporan->id }}</h1>

    <form action="{{ route('laporan.update', $laporan) }}" method="POST" enctype="multipart/form-data"
          class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-5">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-sm font-semibold mb-2">Nama Pelapor</label>
            <input type="text" name="nama_pelapor" value="{{ old('nama_pelapor', $laporan->nama_pelapor) }}" class="{{ $input }}">
            @error('nama_pelapor') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-semibold mb-2">No. HP</label>
            <input type="text" name="no_hp" value="{{ old('no_hp', $laporan->no_hp) }}" class="{{ $input }}">
            @error('no_hp') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-semibold mb-2">Kecamatan</label>
            <select name="kecamatan" class="{{ $input }}">
                <option value="">Pilih Kecamatan</option>
                @foreach ($kecamatans as $k)
                    <option value="{{ $k }}" @selected(old('kecamatan', $laporan->kecamatan) === $k)>{{ $k }}</option>
                @endforeach
            </select>
            @error('kecamatan') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-semibold mb-2">Desa / Kelurahan</label>
            <input type="text" name="lokasi" value="{{ old('lokasi', $laporan->lokasi) }}" class="{{ $input }}">
            @error('lokasi') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-semibold mb-2">Tinggi Genangan Air (cm)</label>
            <input type="number" name="tinggi_air" min="1" value="{{ old('tinggi_air', $laporan->tinggi_air) }}" class="{{ $input }}">
            @error('tinggi_air') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-semibold mb-2">Status Penanganan</label>
            <select name="status" class="{{ $input }}">
                @foreach (['Menunggu', 'Diproses', 'Selesai'] as $s)
                    <option value="{{ $s }}" @selected(old('status', $laporan->status) === $s)>{{ $s }}</option>
                @endforeach
            </select>
            @error('status') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="md:col-span-2">
            <label class="block text-sm font-semibold mb-2">Keterangan</label>
            <textarea name="keterangan" rows="3" class="{{ $input }}">{{ old('keterangan', $laporan->keterangan) }}</textarea>
            @error('keterangan') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="md:col-span-2">
            <label class="block text-sm font-semibold mb-2">Foto Saat Ini</label>
            <img src="{{ asset('storage/'.$laporan->foto) }}" class="h-40 rounded-xl object-cover mb-3">

            <label class="block text-sm font-semibold mb-2">Ganti Foto (kosongkan jika tidak diganti)</label>
            <input type="file" name="foto" accept=".jpg,.jpeg,.png"
                   class="w-full text-sm border border-slate-200 rounded-xl p-2.5
                          file:mr-3 file:rounded-lg file:border-0 file:bg-blue-50 file:px-4 file:py-2
                          file:text-blue-700 file:font-semibold">
            @error('foto') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="md:col-span-2 flex gap-3">
            <a href="{{ route('laporan.index') }}"
               class="px-6 py-3 rounded-xl border border-slate-300 text-sm font-semibold">Batal</a>
            <button type="submit"
                    class="flex-1 bg-blue-700 hover:bg-blue-800 text-white font-bold py-3 rounded-xl">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection