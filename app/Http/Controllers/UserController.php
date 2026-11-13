<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Menampilkan daftar pengguna.
     */
    public function index(Request $request): View
    {
        $query = User::with('role')->latest();

        if ($request->filled('status')) {
            $query->where('registration_status', $request->status);
        }

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        return view('users.index', [
            'users' => $query->paginate(10)->withQueryString(),
            'roles' => Role::orderBy('name')->get(),
            'totalUsers' => User::count(),
            'pendingUsers' => User::where('registration_status', 'pending')->count(),
            'activeUsers' => User::where('registration_status', 'active')->count(),
            'rejectedUsers' => User::where('registration_status', 'rejected')->count(),
        ]);
    }

    /**
     * Menyetujui pendaftaran pengguna.
     */
    public function approve(Request $request, User $user): RedirectResponse
    {
        $validated = $request->validate([
            'role_id' => ['required', 'integer', 'exists:roles,id'],
        ]);

        if ($user->registration_status !== 'pending') {
            return back()->with('error', 'Akun ini tidak sedang menunggu persetujuan.');
        }

        if ($user->id === auth()->id()) {
            return back()->with('error', 'Anda tidak dapat mengubah status akun sendiri.');
        }

        $administratorRoleId = Role::where('slug', 'administrator')->value('id');

        if ((int) $validated['role_id'] === (int) $administratorRoleId) {
            return back()->with('error', 'Role Administrator tidak dapat diberikan melalui persetujuan registrasi biasa.');
        }

        DB::transaction(function () use ($user, $validated) {
            $user->update([
                'role_id' => $validated['role_id'],
                'registration_status' => 'active',
            ]);
        });

        return back()->with('success', 'Pendaftaran pengguna berhasil disetujui.');
    }

    /**
     * Menolak pendaftaran pengguna.
     */
    public function reject(User $user): RedirectResponse
    {
        if ($user->registration_status !== 'pending') {
            return back()->with('error', 'Akun ini tidak sedang menunggu persetujuan.');
        }

        if ($user->id === auth()->id()) {
            return back()->with('error', 'Anda tidak dapat menolak akun sendiri.');
        }

        $user->update([
            'registration_status' => 'rejected',
        ]);

        return back()->with('success', 'Pendaftaran pengguna berhasil ditolak.');
    }
}
