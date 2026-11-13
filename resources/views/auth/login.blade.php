<x-guest-layout>

    <!-- Logo dan Judul -->
    <div class="mb-6 text-center">
        <h1 class="text-2xl font-bold text-gray-800">
            INVENTRA
        </h1>
        <p class="mt-1 text-sm text-gray-500">
            Inventory & Laboratory Management System
        </p>
        <p class="mt-2 text-sm text-gray-600">
            Silakan masuk menggunakan akun Anda.
        </p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <!-- Pesan Registrasi Berhasil -->
    @if (session('status') === 'registration-pending')
        <div class="mb-4 rounded-lg bg-blue-50 border border-blue-200 p-4 text-sm text-blue-700">
            <strong>Registrasi berhasil!</strong>
            <p class="mt-1">
                Akun Anda sedang menunggu persetujuan Administrator INVENTRA.
                Silakan tunggu hingga akun Anda diaktifkan.
            </p>
        </div>
    @endif

    <!-- Pesan Akun Pending -->
    @if (session('status') === 'account-pending')
        <div class="mb-4 rounded-lg bg-yellow-50 border border-yellow-200 p-4 text-sm text-yellow-700">
            <strong>Akun belum aktif.</strong>
            <p class="mt-1">
                Akun Anda masih menunggu persetujuan Administrator.
                Anda belum dapat mengakses sistem INVENTRA.
            </p>
        </div>
    @endif

    <!-- Pesan Akun Ditolak -->
    @if (session('status') === 'account-rejected')
        <div class="mb-4 rounded-lg bg-red-50 border border-red-200 p-4 text-sm text-red-700">
            <strong>Pendaftaran belum disetujui.</strong>
            <p class="mt-1">
                Silakan hubungi Administrator INVENTRA untuk informasi lebih lanjut.
            </p>
        </div>
    @endif

    <!-- Pesan Verifikasi Email -->
    @if (session('status') === 'verification-link-sent')
        <div class="mb-4 rounded-lg bg-green-50 border border-green-200 p-4 text-sm text-green-700">
            Tautan verifikasi email baru telah dikirim ke alamat email Anda.
        </div>
    @endif

    <!-- Form Login -->
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />

            <x-text-input
                id="email"
                class="block mt-1 w-full"
                type="email"
                name="email"
                :value="old('email')"
                required
                autofocus
                autocomplete="username"
            />

            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input
                id="password"
                class="block mt-1 w-full"
                type="password"
                name="password"
                required
                autocomplete="current-password"
            />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input
                    id="remember_me"
                    type="checkbox"
                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                    name="remember"
                >

                <span class="ms-2 text-sm text-gray-600">
                    Ingat saya
                </span>
            </label>
        </div>

        <!-- Tombol Login -->
        <div class="flex items-center justify-between mt-6">

            @if (Route::has('password.request'))
                <a
                    class="underline text-sm text-gray-600 hover:text-gray-900"
                    href="{{ route('password.request') }}"
                >
                    Lupa password?
                </a>
            @endif

            <x-primary-button>
                Masuk
            </x-primary-button>

        </div>
    </form>

    <!-- Link Registrasi -->
    <div class="mt-6 text-center">
        <p class="text-sm text-gray-600">
            Belum memiliki akun?

            <a
                href="{{ route('register') }}"
                class="font-semibold text-indigo-600 hover:text-indigo-800"
            >
                Daftar sekarang
            </a>
        </p>
    </div>

    <!-- Footer -->
    <div class="mt-8 border-t pt-4 text-center">
        <p class="text-xs text-gray-400">
            INVENTRA &copy; {{ date('Y') }}
        </p>
        <p class="text-xs text-gray-400">
            Inventory & Laboratory Management System
        </p>
    </div>

</x-guest-layout>
