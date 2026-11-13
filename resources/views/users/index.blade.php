<x-app-layout>

    <div class="mx-auto max-w-7xl space-y-6">

        {{-- HEADER --}}
        <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
            <div>
                <h1 class="text-2xl font-bold text-slate-800">
                    Manajemen Pengguna
                </h1>
                <p class="mt-1 text-sm text-slate-500">
                    Kelola akun, persetujuan pendaftaran, dan hak akses pengguna INVENTRA.
                </p>
            </div>
        </div>

        {{-- FLASH MESSAGE --}}
        @if (session('success'))
            <div class="rounded-lg border border-green-200 bg-green-50 p-4 text-sm text-green-700">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="rounded-lg border border-red-200 bg-red-50 p-4 text-sm text-red-700">
                {{ session('error') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="rounded-lg border border-red-200 bg-red-50 p-4 text-sm text-red-700">
                <ul class="list-inside list-disc">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- STATISTIK --}}
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">

            <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
                <p class="text-sm text-slate-500">Total Pengguna</p>
                <h2 class="mt-3 text-3xl font-bold text-blue-600">
                    {{ number_format($totalUsers) }}
                </h2>
            </div>

            <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
                <p class="text-sm text-slate-500">Menunggu Persetujuan</p>
                <h2 class="mt-3 text-3xl font-bold text-yellow-600">
                    {{ number_format($pendingUsers) }}
                </h2>
            </div>

            <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
                <p class="text-sm text-slate-500">Pengguna Aktif</p>
                <h2 class="mt-3 text-3xl font-bold text-green-600">
                    {{ number_format($activeUsers) }}
                </h2>
            </div>

            <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
                <p class="text-sm text-slate-500">Pendaftaran Ditolak</p>
                <h2 class="mt-3 text-3xl font-bold text-red-600">
                    {{ number_format($rejectedUsers) }}
                </h2>
            </div>

        </div>

        {{-- PENCARIAN DAN FILTER --}}
        <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">

            <form method="GET"
                  action="{{ route('admin.users.index') }}"
                  class="grid grid-cols-1 gap-4 md:grid-cols-3">

                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700">
                        Cari Pengguna
                    </label>

                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Nama atau email..."
                        class="w-full rounded-lg border-slate-300 text-sm focus:border-blue-500 focus:ring-blue-500"
                    >
                </div>

                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700">
                        Filter Status
                    </label>

                    <select
                        name="status"
                        class="w-full rounded-lg border-slate-300 text-sm focus:border-blue-500 focus:ring-blue-500"
                    >
                        <option value="">Semua Status</option>

                        <option value="pending" @selected(request('status') === 'pending')>
                            Menunggu Persetujuan
                        </option>

                        <option value="active" @selected(request('status') === 'active')>
                            Aktif
                        </option>

                        <option value="rejected" @selected(request('status') === 'rejected')>
                            Ditolak
                        </option>
                    </select>
                </div>

                <div class="flex items-end gap-2">
                    <button
                        type="submit"
                        class="rounded-lg bg-blue-700 px-5 py-2.5 text-sm font-semibold text-white hover:bg-blue-800"
                    >
                        Cari
                    </button>

                    <a
                        href="{{ route('admin.users.index') }}"
                        class="rounded-lg border border-slate-300 px-5 py-2.5 text-sm text-slate-600 hover:bg-slate-50"
                    >
                        Reset
                    </a>
                </div>

            </form>

        </div>

        {{-- TABEL PENGGUNA --}}
        <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">

            <div class="border-b border-slate-100 p-5">
                <h3 class="font-bold text-slate-800">
                    Daftar Pengguna
                </h3>

                <p class="mt-1 text-xs text-slate-500">
                    Data akun yang terdaftar di sistem INVENTRA.
                </p>
            </div>

            <div class="overflow-x-auto">

                <table class="w-full text-left text-sm">

                    <thead class="bg-slate-50 text-xs uppercase text-slate-500">
                        <tr>
                            <th class="px-5 py-4">Pengguna</th>
                            <th class="px-5 py-4">Tipe</th>
                            <th class="px-5 py-4">Role</th>
                            <th class="px-5 py-4">Status</th>
                            <th class="px-5 py-4">Terdaftar</th>
                            <th class="px-5 py-4">Tindakan</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-slate-100">

                        @forelse ($users as $user)

                            <tr class="hover:bg-slate-50">

                                {{-- NAMA DAN EMAIL --}}
                                <td class="px-5 py-4">
                                    <div class="font-semibold text-slate-800">
                                        {{ $user->name }}
                                    </div>

                                    <div class="mt-1 text-xs text-slate-500">
                                        {{ $user->email }}
                                    </div>
                                </td>

                                {{-- TIPE PENGGUNA --}}
                                <td class="px-5 py-4 text-slate-600">
                                    {{ ucfirst($user->user_type) }}
                                </td>

                                {{-- ROLE --}}
                                <td class="px-5 py-4 text-slate-600">
                                    {{ $user->role?->name ?? 'Belum ditentukan' }}
                                </td>

                                {{-- STATUS --}}
                                <td class="px-5 py-4">

                                    @if ($user->registration_status === 'active')
                                        <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                                            Aktif
                                        </span>

                                    @elseif ($user->registration_status === 'pending')
                                        <span class="rounded-full bg-yellow-100 px-3 py-1 text-xs font-semibold text-yellow-700">
                                            Pending
                                        </span>

                                    @else
                                        <span class="rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-700">
                                            Ditolak
                                        </span>
                                    @endif

                                </td>

                                {{-- TANGGAL DAFTAR --}}
                                <td class="px-5 py-4 text-xs text-slate-500">
                                    {{ $user->created_at?->format('d/m/Y') ?? '-' }}
                                </td>

                                {{-- TINDAKAN --}}
                                <td class="px-5 py-4">

                                    @if ($user->registration_status === 'pending' && $user->id !== auth()->id())

                                        <div class="flex min-w-48 flex-col gap-2">

                                            {{-- FORM PERSETUJUAN --}}
                                            <form
                                                method="POST"
                                                action="{{ route('admin.users.approve', $user) }}"
                                                class="flex flex-col gap-2"
                                            >
                                                @csrf
                                                @method('PATCH')

                                                <select
                                                    name="role_id"
                                                    required
                                                    class="w-full rounded-lg border-slate-300 text-xs focus:border-blue-500 focus:ring-blue-500"
                                                >
                                                    <option value="">Pilih Role</option>

                                                    @foreach ($roles->where('slug', '!=', 'administrator') as $role)
                                                        <option value="{{ $role->id }}">
                                                            {{ $role->name }}
                                                        </option>
                                                    @endforeach

                                                </select>

                                                <button
                                                    type="submit"
                                                    onclick="return confirm('Setujui pendaftaran pengguna ini?')"
                                                    class="w-full rounded-lg bg-green-600 px-3 py-2.5 text-xs font-semibold text-white hover:bg-green-700"
                                                >
                                                    ✓ Setujui Pendaftaran
                                                </button>

                                            </form>

                                            {{-- FORM PENOLAKAN --}}
                                            <form
                                                method="POST"
                                                action="{{ route('admin.users.reject', $user) }}"
                                                onsubmit="return confirm('Tolak pendaftaran pengguna ini?')"
                                            >
                                                @csrf
                                                @method('PATCH')

                                                <button
                                                    type="submit"
                                                    class="w-full rounded-lg bg-red-50 px-3 py-2.5 text-xs font-semibold text-red-600 hover:bg-red-100"
                                                >
                                                    Tolak Pendaftaran
                                                </button>

                                            </form>

                                        </div>

                                    @else

                                        <span class="text-xs text-slate-400">
                                            Tidak ada tindakan
                                        </span>

                                    @endif

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="6" class="px-5 py-12 text-center">
                                    <p class="font-medium text-slate-600">
                                        Belum ada pengguna ditemukan.
                                    </p>

                                    <p class="mt-1 text-xs text-slate-400">
                                        Data pengguna akan muncul di sini setelah registrasi.
                                    </p>
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

            {{-- PAGINATION --}}
            <div class="border-t border-slate-100 p-5">
                {{ $users->links() }}
            </div>

        </div>

    </div>

</x-app-layout>
