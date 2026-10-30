@extends('layouts.lapor')

@section('title', 'Form Laporan Banjir')
@section('main-class', '-mt-10 relative z-10')

@section('hero')
<section class="relative bg-slate-900 text-white overflow-hidden">
    <div class="absolute inset-0 bg-cover bg-center opacity-50"
     style="background-image: url('{{ asset('images/hero-1.jpg') }}')"></div>

    <div class="relative max-w-7xl mx-auto px-6 pt-20 pb-28">
        <p class="text-xs font-bold tracking-widest uppercase text-blue-0">
            Bersama lebih siaga, Bandung lebih aman
        </p>
        <h1 class="mt-5 text-5xl font-extrabold leading-tight">
            Laporkan <span class="text-sky-400">Banjir</span><br>di Sekitar Anda
        </h1>
        <p class="mt-6 max-w-xl text-lg text-slate-200">
            Mari lebih peduli terhadap daerahmu, laporkan kebanjiran disetiap titik yang ada.
        </p>
        <a href="#form"
           class="inline-block mt-8 bg-white text-slate-900 font-semibold px-6 py-3 rounded-xl hover:bg-slate-100">
            Buat Laporan
        </a>
    </div>
</section>
@endsection

@section('content')
@php
    $kecamatans = ['Arjasari','Baleendah','Banjaran','Bojongsoang','Cangkuang','Cicalengka','Cikancung',
        'Cilengkrang','Cileunyi','Cimaung','Cimenyan','Ciparay','Ciwidey','Dayeuhkolot','Ibun','Katapang',
        'Kertasari','Kutawaringin','Majalaya','Margaasih','Margahayu','Nagreg','Pacet','Pameungpeuk',
        'Pangalengan','Paseh','Pasirjambu','Rancabali','Rancaekek','Solokanjeruk','Soreang'];
    $input = 'w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-blue-500 focus:ring-blue-500';
@endphp

<div id="form" class="max-w-3xl mx-auto bg-white rounded-2xl shadow-lg p-8">
    <h2 class="text-xl font-bold text-slate-900">Form Laporan Banjir</h2>
    <p class="text-sm text-slate-500 mt-1">Silakan isi informasi kejadian banjir di wilayah Anda.</p>

    <form action="{{ route('lapor.store') }}" method="POST" enctype="multipart/form-data"
          class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-5">
        @csrf

        {{-- Nama --}}
        <div>
            <label class="block text-sm font-semibold mb-2">Nama Pelapor</label>
            <input type="text" name="nama_pelapor" value="{{ old('nama_pelapor') }}"
                   placeholder="Masukkan nama Anda" class="{{ $input }}">
            @error('nama_pelapor') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- No HP --}}
        <div>
            <label class="block text-sm font-semibold mb-2">No. HP</label>
            <input type="text" name="no_hp" value="{{ old('no_hp') }}"
                   placeholder="Contoh: 081234567890" class="{{ $input }}">
            @error('no_hp') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Kecamatan --}}
        <div>
            <label class="block text-sm font-semibold mb-2">Kecamatan</label>
            <select name="kecamatan" class="{{ $input }}">
                <option value="">Pilih Kecamatan</option>
                @foreach ($kecamatans as $k)
                    <option value="{{ $k }}" @selected(old('kecamatan') === $k)>{{ $k }}</option>
                @endforeach
            </select>
            @error('kecamatan') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Lokasi (Desa/Kelurahan) --}}
        <div>
            <label class="block text-sm font-semibold mb-2">Desa / Kelurahan</label>
            <input type="text" name="lokasi" value="{{ old('lokasi') }}"
                   placeholder="Contoh: Desa Andir, RT 02/RW 05" class="{{ $input }}">
            @error('lokasi') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Tinggi air --}}
        <div>
            <label class="block text-sm font-semibold mb-2">Tinggi Genangan Air (cm)</label>
            <input type="number" name="tinggi_air" value="{{ old('tinggi_air') }}" min="1"
                   placeholder="Contoh: 50" class="{{ $input }}">
            @error('tinggi_air') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Foto --}}
        <div>
            <label class="block text-sm font-semibold mb-2">Foto Bukti (jpg/png, maks 2 MB)</label>
            <input type="file" name="foto" accept=".jpg,.jpeg,.png"
                   class="w-full text-sm border border-slate-200 rounded-xl p-2.5
                          file:mr-3 file:rounded-lg file:border-0 file:bg-blue-50 file:px-4 file:py-2
                          file:text-blue-700 file:font-semibold">
            @error('foto') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Keterangan --}}
        <div class="md:col-span-2">
            <label class="block text-sm font-semibold mb-2">Keterangan (opsional)</label>
            <textarea name="keterangan" rows="3" placeholder="Ceritakan kondisi banjir..."
                      class="{{ $input }}">{{ old('keterangan') }}</textarea>
            @error('keterangan') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="md:col-span-2">
            <button type="submit"
                    class="w-full bg-blue-700 hover:bg-blue-800 text-white font-bold py-3.5 rounded-xl">
                Kirim Laporan
            </button>
        </div>
    </form>
</div>
@endsection