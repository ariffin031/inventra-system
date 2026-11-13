<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'INVENTRA') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-slate-100">

<div x-data="{ sidebarOpen: false }" class="min-h-screen">

    <!-- Mobile Overlay -->
    <div
        x-show="sidebarOpen"
        @click="sidebarOpen = false"
        class="fixed inset-0 z-40 bg-slate-950/50 lg:hidden"
        style="display: none;"
    ></div>

    <!-- SIDEBAR -->
    <aside
        :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
        class="fixed inset-y-0 left-0 z-50 flex w-64 flex-col bg-slate-950 text-white transition-transform duration-300"
    >

        <!-- Logo -->
        <div class="flex h-20 items-center gap-3 border-b border-white/10 px-6">
            <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-blue-600">
                <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"
                        d="M3 7l9-5 9 5-9 5-9-5zM3 7v10l9 5 9-5V7M12 12v10"/>
                </svg>
            </div>

            <div>
                <h1 class="text-xl font-bold tracking-wider">INVENTRA</h1>
                <p class="text-[10px] tracking-wide text-slate-400">
                    INVENTORY MANAGEMENT
                </p>
            </div>
        </div>

        <!-- Navigation -->
        <div class="flex-1 overflow-y-auto px-4 py-6">

            <p class="mb-3 px-3 text-[10px] font-semibold uppercase tracking-widest text-slate-500">
                Menu Utama
            </p>

            <nav class="space-y-1">

                <a href="{{ route('dashboard') }}"
                   class="flex items-center gap-3 rounded-lg bg-blue-600 px-3 py-3 text-sm font-medium text-white shadow-lg shadow-blue-900/30">

                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"
                            d="M3 13h8V3H3v10zm10 8h8V11h-8v10zM3 21h8v-6H3v6zm10-12h8V3h-8v6z"/>
                    </svg>

                    Dashboard
                </a>

                <p class="mb-2 mt-7 px-3 text-[10px] font-semibold uppercase tracking-widest text-slate-500">
                    Manajemen Inventaris
                </p>

                @php
                    $menus = [
                        ['name' => 'Kategori Alat', 'icon' => 'M4 6h16M4 12h16M4 18h16'],
                        ['name' => 'Data Inventaris', 'icon' => 'M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4'],
                        ['name' => 'Unit dan QR Code', 'icon' => 'M3 3h7v7H3zM14 3h7v7h-7zM3 14h7v7H3zM14 14h3v3h-3zM19 14h2v7h-7v-2'],
                    ];
                @endphp

                @foreach ($menus as $menu)
                    <div class="flex cursor-not-allowed items-center gap-3 rounded-lg px-3 py-3 text-sm text-slate-400">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"
                                d="{{ $menu['icon'] }}"/>
                        </svg>
                        {{ $menu['name'] }}
                        <span class="ml-auto text-[9px] text-slate-600">SEGERA</span>
                    </div>
                @endforeach

                <p class="mb-2 mt-7 px-3 text-[10px] font-semibold uppercase tracking-widest text-slate-500">
                    Transaksi
                </p>

                @foreach (['Peminjaman', 'Pengembalian', 'Pemeliharaan'] as $menu)
                    <div class="flex cursor-not-allowed items-center gap-3 rounded-lg px-3 py-3 text-sm text-slate-400">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"
                                d="M12 6v12m-6-6h12"/>
                        </svg>
                        {{ $menu }}
                        <span class="ml-auto text-[9px] text-slate-600">SEGERA</span>
                    </div>
                @endforeach

                <p class="mb-2 mt-7 px-3 text-[10px] font-semibold uppercase tracking-widest text-slate-500">
                    Administrasi
                </p>

                @if (Auth::user()->role?->slug === 'administrator')
    <a href="{{ route('admin.users.index') }}"
       class="flex items-center gap-3 rounded-lg px-3 py-3 text-sm text-slate-300 hover:bg-white/10 hover:text-white {{ request()->routeIs('admin.users.*') ? 'bg-blue-600 text-white' : '' }}">

        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"
                d="M17 20h5v-2a4 4 0 00-5-3.87M9 20H2v-2a4 4 0 017-2.65M15 20v-2a6 6 0 00-12 0v2m12-10a4 4 0 11-8 0 4 4 0 018 0zm6-3a4 4 0 11-8 0 4 4 0 018 0z"/>
        </svg>

        <span>Manajemen Pengguna</span>
    </a>
@endif

                <div class="flex cursor-not-allowed items-center gap-3 rounded-lg px-3 py-3 text-sm text-slate-400">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"
                            d="M15 17h5l-1.4-1.4A2 2 0 0118 14.2V11a6 6 0 00-12 0v3.2a2 2 0 01-.6 1.4L4 17h5m6 0a3 3 0 11-6 0"/>
                    </svg>
                    Notifikasi
                    <span class="ml-auto text-[9px] text-slate-600">SEGERA</span>
                </div>

                <div class="flex cursor-not-allowed items-center gap-3 rounded-lg px-3 py-3 text-sm text-slate-400">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"
                            d="M9 12l2 2 4-4m5-3v8a2 2 0 01-1 1.73l-6 3.46a2 2 0 01-2 0l-6-3.46A2 2 0 013 15V7a2 2 0 011-1.73l6-3.46a2 2 0 012 0l6 3.46A2 2 0 0121 7z"/>
                    </svg>
                    Log Aktivitas
                    <span class="ml-auto text-[9px] text-slate-600">SEGERA</span>
                </div>

            </nav>
        </div>

        <!-- Sidebar Footer -->
        <div class="border-t border-white/10 p-4">
            <p class="text-xs text-slate-500">INVENTRA System</p>
            <p class="mt-1 text-[10px] text-slate-600">Version 1.0.0</p>
        </div>

    </aside>

    <!-- MAIN CONTENT -->
    <div class="min-h-screen lg:pl-64">

        <!-- HEADER -->
        <header class="sticky top-0 z-30 flex h-20 items-center justify-between border-b border-slate-200 bg-white px-4 shadow-sm sm:px-8">

            <div class="flex items-center gap-3">

                <button
                    @click="sidebarOpen = !sidebarOpen"
                    class="rounded-lg p-2 text-slate-600 hover:bg-slate-100 lg:hidden"
                >
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>

                <div>
                    <h2 class="text-lg font-bold text-slate-800">
                        {{ $header ?? 'Dashboard' }}
                    </h2>
                    <p class="hidden text-xs text-slate-500 sm:block">
                        Inventory & Laboratory Management System
                    </p>
                </div>
            </div>

            <!-- User Profile -->
            <div class="flex items-center gap-3">

                <div class="hidden text-right sm:block">
                    <p class="text-sm font-semibold text-slate-800">
                        {{ Auth::user()->name }}
                    </p>
                    <p class="text-xs text-slate-500">
                        {{ Auth::user()->role?->name ?? 'Pengguna' }}
                    </p>
                </div>

                <div class="flex h-10 w-10 items-center justify-center rounded-full bg-blue-100 font-bold text-blue-700">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>

                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open"
                        class="rounded-lg p-2 text-slate-500 hover:bg-slate-100">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>

                    <div
                        x-show="open"
                        @click.outside="open = false"
                        x-transition
                        style="display: none;"
                        class="absolute right-0 mt-2 w-48 rounded-xl border border-slate-200 bg-white py-2 shadow-xl"
                    >
                        <a href="{{ route('profile.edit') }}"
                           class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-50">
                            Profil Saya
                        </a>

                        <div class="my-1 border-t border-slate-100"></div>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="w-full px-4 py-2 text-left text-sm text-red-600 hover:bg-red-50">
                                Keluar
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </header>

        <!-- PAGE CONTENT -->
        <main class="p-4 sm:p-8">
            {{ $slot }}
        </main>

    </div>

</div>

</body>
</html>
