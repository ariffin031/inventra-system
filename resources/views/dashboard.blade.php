<x-app-layout>

    @php
        $totalUnits = $totalUnits ?? 0;

        $goodPercent = $totalUnits > 0
            ? round(($goodUnits / $totalUnits) * 100)
            : 0;

        $fairPercent = $totalUnits > 0
            ? round(($fairUnits / $totalUnits) * 100)
            : 0;

        $damagedPercent = $totalUnits > 0
            ? round(($damagedUnits / $totalUnits) * 100)
            : 0;
    @endphp

    <div class="mx-auto max-w-7xl space-y-8">

        <!-- Heading -->
        <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
            <div>
                <h1 class="text-2xl font-bold text-slate-800">
                    Dashboard Administrator
                </h1>
                <p class="mt-1 text-sm text-slate-500">
                    Selamat datang di sistem INVENTRA. Berikut ringkasan pengelolaan inventaris laboratorium.
                </p>
            </div>

            <div class="text-sm text-slate-500">
                {{ now()->format('d/m/Y') }}
            </div>
        </div>

        <!-- Welcome Banner -->
        <div class="relative overflow-hidden rounded-2xl bg-gradient-to-r from-blue-900 to-blue-700 p-6 text-white shadow-lg sm:p-8">

            <div class="relative z-10 max-w-2xl">
                <p class="text-sm font-medium text-blue-200">
                    INVENTORY & LABORATORY MANAGEMENT SYSTEM
                </p>

                <h2 class="mt-3 text-2xl font-bold sm:text-3xl">
                    Selamat datang, {{ Auth::user()->name }}!
                </h2>

                <p class="mt-3 text-sm leading-relaxed text-blue-100">
                    Kelola seluruh aset, fasilitas, peminjaman, pengembalian,
                    dan pemeliharaan alat laboratorium sekolah melalui satu sistem terintegrasi.
                </p>

                <div class="mt-6 inline-flex items-center gap-2 rounded-lg bg-white/15 px-4 py-2 text-sm">
                    <span class="h-2 w-2 rounded-full bg-green-400"></span>
                    Sistem INVENTRA aktif
                </div>
            </div>

            <div class="absolute -right-10 -top-16 h-64 w-64 rounded-full border-[30px] border-white/10"></div>
            <div class="absolute -bottom-32 right-32 h-64 w-64 rounded-full border-[30px] border-white/10"></div>

        </div>

        <!-- Inventory Statistics -->
        <div>
            <div class="mb-4">
                <h3 class="font-bold text-slate-800">Ringkasan Inventaris</h3>
                <p class="text-sm text-slate-500">
                    Statistik aktual berdasarkan database INVENTRA.
                </p>
            </div>

            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 xl:grid-cols-4">

                <!-- Total Jenis -->
                <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
                    <div class="flex items-center justify-between">
                        <div class="rounded-xl bg-blue-100 p-3 text-blue-700">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"
                                    d="M3 7l9-4 9 4-9 4-9-4zm0 0v10l9 4 9-4V7M12 11v10"/>
                            </svg>
                        </div>
                        <span class="text-xs font-medium text-blue-600">JENIS ALAT</span>
                    </div>

                    <h3 class="mt-5 text-3xl font-bold text-slate-800">
                        {{ number_format($totalTools) }}
                    </h3>
                    <p class="mt-1 text-sm text-slate-500">Total Jenis Inventaris</p>
                </div>

                <!-- Available -->
                <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
                    <div class="flex items-center justify-between">
                        <div class="rounded-xl bg-green-100 p-3 text-green-700">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"
                                    d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <span class="text-xs font-medium text-green-600">TERSEDIA</span>
                    </div>

                    <h3 class="mt-5 text-3xl font-bold text-slate-800">
                        {{ number_format($availableUnits) }}
                    </h3>
                    <p class="mt-1 text-sm text-slate-500">Unit Tersedia</p>
                </div>

                <!-- Borrowed -->
                <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
                    <div class="flex items-center justify-between">
                        <div class="rounded-xl bg-orange-100 p-3 text-orange-700">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"
                                    d="M8 7V3m8 4V3M5 11h14M5 5h14a2 2 0 012 2v12a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2z"/>
                            </svg>
                        </div>
                        <span class="text-xs font-medium text-orange-600">DIPINJAM</span>
                    </div>

                    <h3 class="mt-5 text-3xl font-bold text-slate-800">
                        {{ number_format($borrowedUnits) }}
                    </h3>
                    <p class="mt-1 text-sm text-slate-500">Unit Sedang Dipinjam</p>
                </div>

                <!-- Maintenance -->
                <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
                    <div class="flex items-center justify-between">
                        <div class="rounded-xl bg-red-100 p-3 text-red-700">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"
                                    d="M14.7 6.3a5 5 0 00-6.4 6.4L3 18l3 3 5.3-5.3a5 5 0 006.4-6.4l-3.2 3.2-3-3 3.2-3.2z"/>
                            </svg>
                        </div>
                        <span class="text-xs font-medium text-red-600">PERBAIKAN</span>
                    </div>

                    <h3 class="mt-5 text-3xl font-bold text-slate-800">
                        {{ number_format($maintenanceUnits) }}
                    </h3>
                    <p class="mt-1 text-sm text-slate-500">Unit Dalam Perbaikan</p>
                </div>

            </div>
        </div>

        <!-- Additional Statistics -->
        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">

            <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
                <p class="text-sm text-slate-500">Peminjaman Menunggu Persetujuan</p>
                <h3 class="mt-2 text-2xl font-bold text-orange-600">
                    {{ number_format($pendingBorrowings) }}
                </h3>
            </div>

            <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
                <p class="text-sm text-slate-500">Laporan Pemeliharaan Aktif</p>
                <h3 class="mt-2 text-2xl font-bold text-red-600">
                    {{ number_format($activeMaintenance) }}
                </h3>
            </div>

        </div>

        <!-- Inventory Condition -->
        <div class="grid grid-cols-1 gap-6 xl:grid-cols-3">

            <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm xl:col-span-2">

                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="font-bold text-slate-800">Kondisi Inventaris</h3>
                        <p class="mt-1 text-xs text-slate-500">
                            Total {{ number_format($totalUnits) }} unit fisik terdaftar.
                        </p>
                    </div>
                    <span class="rounded-lg bg-slate-100 px-3 py-2 text-xs text-slate-500">
                        Semua Unit
                    </span>
                </div>

                <div class="mt-8 space-y-6">

                    <!-- Good -->
                    <div>
                        <div class="mb-2 flex justify-between text-sm">
                            <span class="font-medium text-slate-600">Baik</span>
                            <span class="text-slate-500">
                                {{ number_format($goodUnits) }} Unit ({{ $goodPercent }}%)
                            </span>
                        </div>
                        <div class="h-3 overflow-hidden rounded-full bg-slate-100">
                            <div class="h-full rounded-full bg-green-500"
                                style="width: {{ $goodPercent }}%"></div>
                        </div>
                    </div>

                    <!-- Fair -->
                    <div>
                        <div class="mb-2 flex justify-between text-sm">
                            <span class="font-medium text-slate-600">Perlu Perhatian</span>
                            <span class="text-slate-500">
                                {{ number_format($fairUnits) }} Unit ({{ $fairPercent }}%)
                            </span>
                        </div>
                        <div class="h-3 overflow-hidden rounded-full bg-slate-100">
                            <div class="h-full rounded-full bg-yellow-500"
                                style="width: {{ $fairPercent }}%"></div>
                        </div>
                    </div>

                    <!-- Damaged -->
                    <div>
                        <div class="mb-2 flex justify-between text-sm">
                            <span class="font-medium text-slate-600">Rusak</span>
                            <span class="text-slate-500">
                                {{ number_format($damagedUnits) }} Unit ({{ $damagedPercent }}%)
                            </span>
                        </div>
                        <div class="h-3 overflow-hidden rounded-full bg-slate-100">
                            <div class="h-full rounded-full bg-red-500"
                                style="width: {{ $damagedPercent }}%"></div>
                        </div>
                    </div>

                </div>

            </div>

            <!-- Account Information -->
            <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">

                <h3 class="font-bold text-slate-800">Informasi Sistem</h3>
                <p class="mt-1 text-xs text-slate-500">
                    Informasi akun Administrator.
                </p>

                <div class="mt-6 space-y-5">

                    <div>
                        <p class="text-xs text-slate-400">Nama Pengguna</p>
                        <p class="mt-1 text-sm font-semibold text-slate-800">
                            {{ Auth::user()->name }}
                        </p>
                    </div>

                    <div>
                        <p class="text-xs text-slate-400">Email</p>
                        <p class="mt-1 break-all text-sm font-semibold text-slate-800">
                            {{ Auth::user()->email }}
                        </p>
                    </div>

                    <div>
                        <p class="text-xs text-slate-400">Hak Akses</p>
                        <p class="mt-1 text-sm font-semibold text-blue-700">
                            {{ Auth::user()->role?->name ?? 'Pengguna' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-xs text-slate-400">Status Akun</p>
                        <span class="mt-1 inline-flex rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                            Aktif
                        </span>
                    </div>

                </div>
            </div>

        </div>

        <!-- Recent Activities -->
        <div class="rounded-xl border border-slate-200 bg-white shadow-sm">

            <div class="border-b border-slate-100 p-6">
                <h3 class="font-bold text-slate-800">Aktivitas Terbaru</h3>
                <p class="mt-1 text-xs text-slate-500">
                    Lima aktivitas terakhir sistem INVENTRA.
                </p>
            </div>

            @forelse ($recentActivities as $activity)

                <div class="flex items-start gap-4 border-b border-slate-100 p-5 last:border-0">

                    <div class="rounded-full bg-blue-100 p-3 text-blue-700">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"
                                d="M12 8v4l3 2m6-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>

                    <div class="min-w-0 flex-1">
                        <p class="text-sm font-semibold text-slate-800">
                            {{ $activity->activity }}
                        </p>

                        <p class="mt-1 text-sm text-slate-500">
                            {{ $activity->description }}
                        </p>

                        <p class="mt-2 text-xs text-slate-400">
                            {{ $activity->user?->name ?? 'Sistem' }}
                            &bull;
                            {{ $activity->created_at?->format('d/m/Y H:i') }}
                        </p>
                    </div>

                </div>

            @empty

                <div class="p-10 text-center">
                    <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-full bg-slate-100">
                        <svg class="h-7 w-7 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"
                                d="M12 8v4l3 2m6-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>

                    <p class="mt-4 font-medium text-slate-700">
                        Belum ada aktivitas
                    </p>

                    <p class="mt-1 text-sm text-slate-400">
                        Aktivitas sistem akan muncul di sini.
                    </p>
                </div>

            @endforelse

        </div>

        <!-- Footer -->
        <div class="pb-4 text-center text-xs text-slate-400">
            INVENTRA &copy; {{ date('Y') }} - Inventory & Laboratory Management System
        </div>

    </div>

</x-app-layout>
