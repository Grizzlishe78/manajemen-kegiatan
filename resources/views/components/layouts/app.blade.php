<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Manajemen Kegiatan' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 font-sans antialiased">
    <div class="flex h-screen bg-gray-100">
        <aside class="w-64 flex-shrink-0 bg-white border-r">
            <div class="p-6">
                <h1 class="text-2xl font-bold text-gray-800">Manajegiatan</h1>
            </div>
            <nav class="mt-6">
                <a href="{{ route('laporan') }}" class="flex items-center px-6 py-3 text-gray-700 {{ request()->routeIs('laporan') ? 'bg-gray-200' : '' }} hover:bg-gray-200">
                    <span class="mx-3">Dashboard</span>
                </a>
                <a href="{{ route('kegiatan.index') }}" class="flex items-center px-6 py-3 text-gray-700 {{ request()->routeIs('kegiatan.index') ? 'bg-gray-200' : '' }} hover:bg-gray-200">
                    <span class="mx-3">Kegiatan</span>
                </a>
                <a href="{{ route('anggota.index') }}" class="flex items-center px-6 py-3 text-gray-700 {{ request()->routeIs('anggota.index') ? 'bg-gray-200' : '' }} hover:bg-gray-200">
                    <span class="mx-3">Anggota</span>
                </a>
                <a href="{{ route('organisasi.index') }}" class="flex items-center px-6 py-3 text-gray-700 {{ request()->routeIs('organisasi.index') ? 'bg-gray-200' : '' }} hover:bg-gray-200">
                    <span class="mx-3">Organisasi</span>
                </a>
            </nav>
        </aside>

        <main class="flex-1 overflow-y-auto">
            <div class="p-8">
                {{ $slot }}
            </div>
        </main>
    </div>
</body>
</html>