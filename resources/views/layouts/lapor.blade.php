<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'LaporBanjir') - BPBD Kabupaten Bandung</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 text-slate-800 antialiased">

    {{-- NAVBAR --}}
    <header class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">

            <a href="{{ route('lapor.create') }}" class="flex items-center gap-3">
                <img src="{{ asset('images/logo-bpbd.png') }}" alt="BPBD" class="h-11 w-11 object-contain"
                     onerror="this.style.display='none'">
                <div class="leading-tight">
                    <div class="font-bold text-slate-900">BPBD</div>
                    <div class="text-xs text-slate-500 uppercase">Kabupaten Bandung</div>
                </div>
                <span class="hidden sm:block border-l border-slate-200 pl-3 ml-1 text-xl font-extrabold text-slate-900">
                    Lapor<span class="text-blue-600">Banjir</span>
                </span>
            </a>

            <nav class="hidden md:flex items-center gap-2 text-sm font-medium">
                <a href="{{ route('lapor.create') }}"
                   class="px-5 py-2 rounded-full {{ request()->routeIs('lapor.create') ? 'bg-blue-100 text-blue-700' : 'text-slate-700 hover:bg-slate-100' }}">
                    Form Laporan
                </a>
                @auth
                    <a href="{{ route('laporan.index') }}"
                       class="px-5 py-2 rounded-full {{ request()->routeIs('laporan.*') ? 'bg-blue-100 text-blue-700' : 'text-slate-700 hover:bg-slate-100' }}">
                        Daftar Laporan
                    </a>
                @endauth
            </nav>

            <div class="flex items-center gap-3">
                @auth
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="text-sm font-medium text-slate-600 hover:text-red-600">Keluar</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-medium text-slate-600 hover:text-blue-700">
                        Login Petugas
                    </a>
                @endauth
                <a href="{{ route('lapor.create') }}"
                   class="bg-slate-900 hover:bg-slate-800 text-white text-sm font-semibold px-5 py-3 rounded-xl">
                    Buat Laporan
                </a>
            </div>
        </div>
    </header>

    {{-- HERO (opsional, diisi dari halaman yang butuh) --}}
    @yield('hero')

    {{-- KONTEN --}}
    <main class="max-w-7xl mx-auto px-6 pb-16 @yield('main-class', 'py-10')">

        {{-- Pesan berhasil --}}
        @if (session('success'))
            <div class="mb-6 max-w-3xl mx-auto rounded-xl bg-green-50 border border-green-200 text-green-800 px-5 py-4 text-sm font-medium">
                ✅ {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </main>

    <footer class="text-center text-xs text-slate-400 pb-8">
        © {{ date('Y') }} BPBD Kabupaten Bandung — LaporBanjir
    </footer>
</body>
</html>