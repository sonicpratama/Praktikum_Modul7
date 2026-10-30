@extends('layouts.lapor')

@section('title', 'Detail Laporan')

@section('content')
<div class="max-w-4xl mx-auto bg-white rounded-2xl shadow p-8">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-slate-900">Detail Laporan #{{ $laporan->id }}</h1>
        <span class="px-4 py-1.5 rounded-full text-sm font-semibold
            {{ match($laporan->status) {
                'Diproses' => 'bg-amber-100 text-amber-700',
                'Selesai'  => 'bg-green-100 text-green-700',
                default    => 'bg-slate-200 text-slate-700' } }}">
            {{ $laporan->status }}
        </span>
    </div>

    <div class="grid md:grid-cols-2 gap-8">
        <div>
            <img src="{{ asset('storage/'.$laporan->foto) }}" alt="Foto banjir"
                 class="w-full rounded-xl object-cover">
        </div>

        <dl class="space-y-4 text-sm">
            <div><dt class="text-slate-500">Nama Pelapor</dt><dd class="font-semibold">{{ $laporan->nama_pelapor }}</dd></div>
            <div><dt class="text-slate-500">No. HP</dt><dd class="font-semibold">{{ $laporan->no_hp }}</dd></div>
            <div><dt class="text-slate-500">Kecamatan</dt><dd class="font-semibold">{{ $laporan->kecamatan }}</dd></div>
            <div><dt class="text-slate-500">Lokasi</dt><dd class="font-semibold">{{ $laporan->lokasi }}</dd></div>
            <div><dt class="text-slate-500">Tinggi Genangan</dt><dd class="font-semibold">{{ $laporan->tinggi_air }} cm</dd></div>
            <div><dt class="text-slate-500">Keterangan</dt><dd>{{ $laporan->keterangan ?: '-' }}</dd></div>
            <div><dt class="text-slate-500">Dilaporkan pada</dt><dd>{{ $laporan->created_at->format('d M Y, H:i') }}</dd></div>
        </dl>
    </div>

    <div class="mt-8 flex gap-3">
        <a href="{{ route('laporan.index') }}"
           class="px-5 py-2.5 rounded-xl border border-slate-300 text-sm font-semibold">← Kembali</a>
        <a href="{{ route('laporan.edit', $laporan) }}"
           class="px-5 py-2.5 rounded-xl bg-amber-500 text-white text-sm font-semibold">Edit</a>
    </div>
</div>
@endsection