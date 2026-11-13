<?php

namespace App\Http\Controllers;

use App\Models\Tool;
use App\Models\ToolUnit;
use App\Models\Borrowing;
use App\Models\MaintenanceLog;
use App\Models\ActivityLog;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        return view('dashboard', [
            // Jumlah jenis inventaris
            'totalTools' => Tool::count(),

            // Statistik unit alat
            'totalUnits' => ToolUnit::count(),

            'availableUnits' => ToolUnit::where(
                'status',
                'available'
            )->count(),

            'borrowedUnits' => ToolUnit::where(
                'status',
                'borrowed'
            )->count(),

            'maintenanceUnits' => ToolUnit::where(
                'status',
                'maintenance'
            )->count(),

            // Kondisi fisik unit
            'goodUnits' => ToolUnit::where(
                'physical_condition',
                'good'
            )->count(),

            'fairUnits' => ToolUnit::where(
                'physical_condition',
                'fair'
            )->count(),

            'damagedUnits' => ToolUnit::where(
                'physical_condition',
                'damaged'
            )->count(),

            // Peminjaman yang menunggu persetujuan
            'pendingBorrowings' => Borrowing::where(
                'status',
                'pending'
            )->count(),

            // Pemeliharaan yang masih berlangsung
            'activeMaintenance' => MaintenanceLog::whereIn(
                'status',
                ['reported', 'in_progress']
            )->count(),

            // Aktivitas terbaru
            'recentActivities' => ActivityLog::with('user')
                ->latest()
                ->take(5)
                ->get(),
        ]);
    }
}
