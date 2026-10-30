@extends('layouts.lapor')

@section('title', 'Daftar Laporan')

@section('content')
@php
    $badge = fn ($s) => match ($s) {
        'Diproses' => 'bg-amber-100 text-amber-700',
        'Selesai'  => 'bg-green-100 text-green-700',
        default    => 'bg-slate-200 text-slate-700',
    };
@endphp

<div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-bold text-slate-900">Daftar Laporan Banjir</h1>
    <span class="text-sm text-slate-500">Total: {{ $laporans->total() }} laporan</span>
</div>

<div class="bg-white rounded-2xl shadow overflow-x-auto">
    <table class="w-full text-sm text-left">
        <thead class="bg-slate-100 text-slate-600 uppercase text-xs">
            <tr>
                <th class="px-4 py-3">#</th>
                <th class="px-4 py-3">Foto</th>
                <th class="px-4 py-3">Pelapor</th>
                <th class="px-4 py-3">Lokasi</th>
                <th class="px-4 py-3">Tinggi Air</th>
                <th class="px-4 py-3">Status</th>
                <th class="px-4 py-3 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
            @forelse ($laporans as $i => $l)
                <tr class="hover:bg-slate-50">
                    <td class="px-4 py-3">{{ $laporans->firstItem() + $i }}</td>
                    <td class="px-4 py-3">
                        <img src="{{ asset('storage/'.$l->foto) }}" alt="Foto"
                             class="h-14 w-20 object-cover rounded-lg">
                    </td>
                    <td class="px-4 py-3">
                        <div class="font-semibold">{{ $l->nama_pelapor }}</div>
                        <div class="text-xs text-slate-500">{{ $l->no_hp }}</div>
                    </td>
                    <td class="px-4 py-3">
                        <div>{{ $l->lokasi }}</div>
                        <div class="text-xs text-slate-500">Kec. {{ $l->kecamatan }}</div>
                    </td>
                    <td class="px-4 py-3">{{ $l->tinggi_air }} cm</td>
                    <td class="px-4 py-3">
                        <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $badge($l->status) }}">
                            {{ $l->status }}
                        </span>
                    </td>
                    <td class="px-4 py-3">
                        <div class="flex items-center justify-center gap-2">
                            <a href="{{ route('laporan.show', $l) }}"
                               class="px-3 py-1.5 rounded-lg bg-sky-100 text-sky-700 text-xs font-semibold">Detail</a>
                            <a href="{{ route('laporan.edit', $l) }}"
                               class="px-3 py-1.5 rounded-lg bg-amber-100 text-amber-700 text-xs font-semibold">Edit</a>
                            <form action="{{ route('laporan.destroy', $l) }}" method="POST"
                                  onsubmit="return confirm('Yakin hapus laporan ini? Foto juga akan dihapus.')">
                                @csrf
                                @method('DELETE')
                                <button class="px-3 py-1.5 rounded-lg bg-red-100 text-red-700 text-xs font-semibold">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="px-4 py-10 text-center text-slate-400">Belum ada laporan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-6">
    {{ $laporans->links() }}
</div>
@endsection